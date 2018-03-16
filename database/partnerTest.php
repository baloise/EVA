<?php

    include('partner.php');

    $bkey = $_GET['bkey'];

    print_r(formatAddress(loadPerson($bkey)));

?>
