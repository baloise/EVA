<?php

    ini_set('display_errors', 1);

    include("../includes/session.php");

    include('partner.php');

    $bkey = $_GET['bkey'];

    try {
        print_r((loadPerson($bkey)));
    } catch(Exception $e) {
        print_r($e);
    }



?>
