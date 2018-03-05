<?php

    include("../session/session.php");
    include("../../database/connect.php");

    if($session_usergroup != 1){
        die($translate[145]);
    }

    $groupID = $_POST['group'];
    $lang = $_POST['lang'];
    $contents = $_POST['contents'];

    echo "LOL";

?>
