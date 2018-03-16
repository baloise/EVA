<?php

    include('connect.php');
    include('../includes/session.php');

    if($session_username != 'b000001'){
        die('Permission denied');
    }

    $sql = "DROP DATABASE db_eva";

    $mysqli->query($sql);

    echo "Done";

?>
