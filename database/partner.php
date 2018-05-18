<?php

    function loadPerson($bkey) {
        $personArray = array(
            "bkey" => $bkey,
            "firstname" => "Max",
            "lastname" => "Muster",
            "street" => "Teststrasse 99",
            "city" => "Alabama",
            "email" => "max.must@er.com",
            "gender" => "1"
        );
        return $personArray;
    }

?>
