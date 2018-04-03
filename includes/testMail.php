<?php

    ini_set('display_errors', 1);

    $t = time();
    mail($_GET['to'], 'Test-E-Mail', $t, 'FROM: test@eva.ch');
    echo "Sent email with timestamp ".$t;
    
?>
