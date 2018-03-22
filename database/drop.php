<?php

    include('connect.php');
    include('../includes/session.php');

    $sql = "DROP DATABASE db_eva";

    $mysqli->query($sql);

    echo "Done";

?>
