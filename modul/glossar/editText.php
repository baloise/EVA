<?php

    include("../../includes/session.php");
    include("../../database/connect.php");

    if($session_usergroup != 1 && $session_usergroup != 2){
        die($translate[145]);
    }

    $newText = $_POST['newText'];
    $lang = $_POST['textId'];

    if($lang == 'ger'){
        $stmt = $mysqli->prepare("UPDATE `tb_text` SET de = ? WHERE `tb_text`.`type` = 'glossar';");
    } else if($lang == 'ita'){
        $stmt = $mysqli->prepare("UPDATE `tb_text` SET it = ? WHERE `tb_text`.`type` = 'glossar';");
    } else if($lang == 'fra'){
        $stmt = $mysqli->prepare("UPDATE `tb_text` SET fr = ? WHERE `tb_text`.`type` = 'glossar';");
    } else {
        echo "Error";
    }

    $stmt->bind_param('s', $newText);
    $stmt->execute();

?>
