<?php

    $_db_host = "DB_HOST";
    $_db_username = "DB_USER";
    $_db_passwort = "DB_PASS";

    $sql = 'show databases';
    $results = $mysqli->query($sql);

?>
<h4>Available Databases:</h4>

<ul>
    <?php while ($row = $results->fetch_assoc()) : ?>
        <li><?= $row['Database'] ?></li>
    <?php endwhile ?>
</ul>
