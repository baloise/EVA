<?php

    ini_set('display_errors', 1);

    $t = time();
    mail($_GET['to'], 'Test-E-Mail', $t, 'FROM: b028178@baloise.ch');
    echo "Sent email with timestamp ".$t;
    
?>
