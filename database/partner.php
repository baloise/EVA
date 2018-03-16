<?php

    if($session_usergroup != 1){
        die("Sie haben keine Berechtigungen zu diesem Modul");
    }

    function formatAddress($person){
        return  trim ("{$person['firstname']} {$person['lastname']}\n{$person['street']}\n{$person['city']}");
    }

    function loadPerson($bkey) {
        return array(
            "firstname" => 'Maxli',
            "lastname" => 'Mustermann',
            "street" => 'Lange Strasse 354',
            "city" =>  'CH-4002 Basel'
        );
    }

    

?>
