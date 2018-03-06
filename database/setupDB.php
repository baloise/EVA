<?php

    $_db_host = "localhost";
    $_db_username = "root";
    $_db_passwort = "";

    $sql = 'show databases';
    $results = $mysqli->query($sql);

?>
<h4>Available Databases:</h4>

<ul>
    <?php while ($row = $results->fetch_assoc()) : ?>
        <li><?= $row['Database'] ?></li>
    <?php endwhile ?>
</ul>
