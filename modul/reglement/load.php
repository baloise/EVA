<?php

    include("../session/session.php");
    include("../../database/connect.php");

    if($session_usergroup != 1){
        die($translate[145]);
    }

    $groupID = $_POST['group'];
    $lang = $_POST['lang'];

    $stmt = $mysqli->prepare("SELECT * FROM `tb_text` WHERE tb_group_ID = ?");
    $stmt->bind_param('i', $groupID);
    $stmt->execute();

    $result = $stmt->get_result();
    while ($row = $result->fetch_array(MYSQLI_NUM)){

        if($lang == "de"){
            $contents = array($row[0], $row[3]);
        } else if($lang == "it"){
            $contents = array($row[0], $row[4]);
        } else if($lang == "fr"){
            $contents = array($row[0], $row[5]);
        }
    }

    $js_array = json_encode($contents);
    echo $js_array;

?>
