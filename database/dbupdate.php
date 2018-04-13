<?php include("connect.php"); ?>
<head>
    <style>
        body {
            font-family: 'Courier New', Courier, monospace;
            background-color: black;
            color: green;
        }
    </style>
</head>

<?php

    ini_set('display_errors', 1);

    function getCurrentSchemaVersion($mysqli) {
        //SELECT schemaversion from appinfo

        $sql = "SELECT db_vers FROM `tb_appinfo`";

        $result = $mysqli->query($sql);

        if ($result->num_rows > 0) {

            $row = $result->fetch_assoc();

            if(isset($row['db_vers'])){
                echo "<br/>Current DB Version:<b>". $row['db_vers']. "</b><br/>";
                return $row['db_vers'];
            } else {
                echo "<br/>Current DB Version:<b> No Version found. Using Version 0 as Default.</b><br/>";
                return 0;
            }

        } else {
            echo "<br/>Current DB Version:<b> No Version found. Using Version 0 as Default.</b><br/>";
            return 0;
        }

    }

    function mustUpdate($file, $schemaVersionIs) {

        $tokens=  explode(".", $file);

        if($tokens[sizeof($tokens)-1] == "sql" && is_numeric($tokens[sizeof($tokens)-2])){
            $newVers = intval($tokens[sizeof($tokens)-2]);
            echo "<br/>File: ".$file." | File-Version:". $newVers;
            if($newVers > $schemaVersionIs){
                return $newVers;
            }
        }

    }

    $folder = 'importScripts/';

    $schemaVersionIs = getCurrentSchemaVersion($mysqli);

    $allVers = Array();
    echo "<br/>--------------------------FOUND VERSIONS IN FILES--------------------------<br/>";
    foreach (scandir ($folder) as  $file) {
        if(null !== (mustUpdate($file, $schemaVersionIs))){
            array_push($allVers, mustUpdate($file, $schemaVersionIs));
        }
    }

    sort($allVers);

    echo "<br/><br/>----------------------TRYING TO IMPORT NEWEST VERSION----------------------<br/>";

    if(count($allVers) > 0){

        foreach ($allVers as $importFile){

            $sql = '';
            $sqlScript = $folder.'db.eva.'.$importFile.'.sql';
            echo '<br/>Importing: '.$sqlScript. "<br/>";

            mysqli_query($mysqli,'USE db_eva');
            foreach (file($sqlScript) as $line)	{

                $startWith = substr(trim($line), 0 ,2);
                $endWith = substr(trim($line), -1 ,1);

                if (empty($line) || $startWith == '--' || $startWith == '/*' || $startWith == '//') {
                    continue;
                }

                $sql = $sql . $line;
                if ($endWith == ';') {
                    echo "<br/>". $sql;
                    mysqli_query($mysqli,$sql) or die('<p style="color:red;">Problem in executing the SQL query:<br/><br/> <b>' . $sql. '</b></p>');
                    $sql= '';
                }
            }

            mysqli_query($mysqli,'UPDATE tb_appinfo SET db_vers='.$importFile.';');

            echo "<br/>success";

        }

    } else {
        echo "<br/>Newest Version already imported";
    }

    echo "<br/><br/>-------------------------------END OF SCRIPT-------------------------------<br/>";

?>
