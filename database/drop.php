<?php

    include('connect.php');

    $sql = "DROP DATABASE db_eva";

    $mysqli->query($sql);

    echo "Done";

?>
