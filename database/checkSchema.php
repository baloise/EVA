<?php include("connect.php"); ?>
<?php
    ini_set('display_errors', 1);

    print_r($_SERVER['SCRIPT_FILENAME']);

    function getCurrentSchemaVersion() {
        //SELECT schemaversion from appinfo
        $ret = 1;
        echo "existing schema is $ret <br/>";
        return $ret;
    }
    function mustUpdate() {
        return true;
    }
    function update($file) {
        $tokens=  explode(".", $file);
        echo "Datatype: " . $tokens[sizeof($tokens)-1]."<br/>";
        echo "Fileversion: " . $tokens[sizeof($tokens)-2]."<br/>";
        echo "updating $file <br/>";
    }

    $folder = 'C:/Users/Elia/Documents/workplace_web/EVA/database/';
    $folder = $folder . 'importScripts';
    $schemaVersionIs = getCurrentSchemaVersion();
    foreach (scandir ($folder) as  $file) {
        if(mustUpdate($file, $schemaVersionIs)) {
            update($file);
        }
        echo "$file <br/>";
    }
    $schemaVersionIs = 1;  //SELECT schemaversion from appinfo
?>
