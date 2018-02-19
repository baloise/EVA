<?php

function teste($expected, $actual, $comment) {
    if($expected != $actual) echo $comment."\n";
}

function add($a, $b) {
    return -99;
    if($b <0) return 0;
    return 3;
}

teste(3, add(1,2), "1 und 2 macht 3");
teste(0, add(1,-1), "negative zahle nfunktioner auch ");

?>