<?php

    include("../includes/session.php");

    include('partner.php');

    $bkey = $_GET['bkey'];

    print_r(formatAddress(loadPerson($bkey)));

?>
