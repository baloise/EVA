<?php include("connect.php"); ?>
<?php

    ini_set('display_errors', 1);

    function getCurrentSchemaVersion($mysqli) {
        //SELECT schemaversion from appinfo

        $sql = "SELECT db_vers FROM `tb_appinfo`";

        $result = $mysqli->query($sql);

        if ($result->num_rows > 0) {

            $row = $result->fetch_assoc();
            return $row['db_vers'];

        } else {
            return -1;
        }

    }

    function mustUpdate($file, $schemaVersionIs) {

        $tokens=  explode(".", $file);

        if($tokens[sizeof($tokens)-1] == "sql" && is_numeric($tokens[sizeof($tokens)-2])){
            $newVers = intval($tokens[sizeof($tokens)-2]);
            if($newVers > $schemaVersionIs){
                return $newVers;
            }
        }

    }

    $folder = 'importScripts/';

    $schemaVersionIs = getCurrentSchemaVersion($mysqli);

    $allVers = Array();

    foreach (scandir ($folder) as  $file) {
        if(null !== (mustUpdate($file, $schemaVersionIs))){
            array_push($allVers, mustUpdate($file, $schemaVersionIs));
        }
    }

    sort($allVers);

    foreach ($allVers as $importFile){

        $sql = '';
        $sqlScript = $folder.'db.eva.'.$importFile.'.sql';
        echo '<br/>Importing: '.$sqlScript;

        mysqli_query($mysqli,'USE db_eva');
        foreach (file($sqlScript) as $line)	{

            $startWith = substr(trim($line), 0 ,2);
            $endWith = substr(trim($line), -1 ,1);

            if (empty($line) || $startWith == '--' || $startWith == '/*' || $startWith == '//') {
                continue;
            }

            $sql = $sql . $line;
            if ($endWith == ';') {
                mysqli_query($mysqli,$sql) or die('<p>Problem in executing the SQL query:<br/><br/> <b>' . $sql. '</b></p>');
                $sql= '';
            }
        }

        mysqli_query($mysqli,'UPDATE tb_appinfo SET db_vers='.$importFile.';');

        echo "<br/>success";

    }

?>
