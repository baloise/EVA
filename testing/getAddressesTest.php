<?php
include ("ichbinkeinTestframework.php");
include ("getAddresses.php");

$person = array(
            "firstname" => 'Maxli',
            "lastname" => 'Mustermann',
            "street" => 'Lange Strasse 354',
            "city" =>  'CH-4002 Basel'
        );



teste("Maxli Mustermann\nLange Strasse 354\nCH-4003 Basel", formatAddress($person) , "Maxli wohnt in Basel");

?>