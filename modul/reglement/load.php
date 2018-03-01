<?php

    include("../session/session.php");
    include("../../database/connect.php");

    if($session_usergroup != 1){
        die($translate[145]);
    }

    $groupID = $_POST['group'];
    $lang = $_POST['lang'];

    $stmt = $mysqli->prepare("SELECT * FROM `tb_reglement` WHERE tb_group_ID = ?");
    $stmt->bind_param('i', $groupID);
    $stmt->execute();

    $result = $stmt->get_result();
    while ($row = $result->fetch_array(MYSQLI_NUM)){
        if($lang == "de"){
            echo $row[2];
        } else if($lang == "it"){
            echo $row[3];
        } else if($lang == "fr"){
            echo $row[4];
        }
    }

?>
