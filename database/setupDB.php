<?php

    include('connect.php');
    $sql = 'show databases';
    $results = $mysqli->query($sql);

?>
<h4>Available Databases:</h4>

<ul>
    <?php while ($row = $results->fetch_assoc()) : ?>
        <li><?= $row['Database'] ?></li>
    <?php endwhile ?>
</ul>
