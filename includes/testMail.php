<?php

    $t = time();
    mail($_GET['to'], 'Test-E-Mail', $t, 'FROM: test@eva.ch');
    echo "Sent email with timestamp ".$t;
?>
