<?php

    include("../session/session.php");
    include("../../database/connect.php");

    if($session_usergroup != 1){
        die($translate[145]);
    }

    $lang = $_POST['lang'];
    $contents = $_POST['contents'];
    $textID = $_POST['textID'];

    if($lang){

        if($lang = 'de'){
            $stmt = $mysqli->prepare("UPDATE `tb_text` SET de = ? WHERE `tb_text`.`ID` = ?;");
        } else if($lang = 'it'){
            $stmt = $mysqli->prepare("UPDATE `tb_text` SET it = ? WHERE `tb_text`.`ID` = ?;");
        } else if($lang = 'fr'){
            $stmt = $mysqli->prepare("UPDATE `tb_text` SET fr = ? WHERE `tb_text`.`ID` = ?;");
        } else {
            echo "Error";
        }

        $stmt->bind_param('si', $contents, $textID);
        $stmt->execute();

    }

?>
