<?php

function teste($expected, $actual, $comment = "") {
    if($expected != $actual) echo "{$expected} != {$actual} {$comment}\n";
}
?>