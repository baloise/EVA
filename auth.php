<?php
    session_start();
    function isDevelopment() {
        // TODO : implement me
        return true;
    }
    
    function loginMedusaToken($token) {
        //$token = "H4sIAAAAAAAAAGVWS27bMBBtTtBTdOcFScmWjSALUh9alSURImUH7qZF47YBigRIHKAX7L1KZdN5wyUpzofvM9Tb48OdEWori%2B3ty%2FPvy%2BvdpMvGvVx%2BPP7xYy82q%2F9r5%2Fs5rOB7Ici6cspoDwEubOkBo5SziuycfEOXZl5KtDQkSOF8SavK3ZBh0o2zkux0Y%2B%2B0p1nK0emqZ2lLR9MabXVVe7iObIeG5u3ncz3g%2FdwR1iZMCFBWIECidxKrYsqlsRM0toAoBWzUx9BjmS3lqdPHiKIjO9PJ16yxtYSUGm661KQZzXl0QkjGwppDwcSxzlnKHYqpp%2BerVrWsh36ymDAXGIBqCzaoqUIsMWWlJReor0vJulxjUSWQL3O0DIcN4y%2Fcl9CnbHS5JzvNIcye0hFlH%2FGnhJ1bcEHQZoarLX0xys9t7fCElAmF1GxRjayxqN%2BpmjCoZbxHWrd4X4Q0thFKtJESvqU5ohvtyE6cOkN2rIZOl0GUM9ANfs927DtorfLR%2F%2BxAjfAxAt5dhwIP3R7NvzcYMU5U0PWxHlp9SHwZIMZ6sHJUKONkkT1T5EYhAWI4lAlpGbvull1OwbrvsC3XdRNs%2BIpNnII2VeueD%2B3ugEPMdo6q4rM%2BRw94HtTQoN6Ms6bSimbVB4poPVS6ThBuEYwo%2BzUDo0rg4qNK0rnt%2B%2FuQPjDMbTs%2BHmHyRIl3M8XcOi8ELRJt1Pq2QtTrUvHGNqwMwrwfutXr9eX56SeLy1g32usEBDYdxFQ2yRmmxTx9JnI8kdGscxfHvkbGovMoY1FL%2BLpn%2BMvwDkIOnSZT3cDTYs15GpOaIbkan%2BP3ocQyzJoLRKZkZkztW2S4VjhW%2Bs5aTMoerdhJCywvO74qMWti%2BCIhhiuHghgfNqcnhqJGNdqTTXJmnBm0jZsYXvooV59yoTZCZSv9dv11ebo%2Bfv92vTxM8e8Tn3cG5WL%2FyrA5FVBtbFAKdrjA7zkNjn93h7HDhxt1tTypCg8gVfHCrbz98OHm683HL3%2F%2FAcGVK41bCwAA";
        $decoded = explode(";", file_get_contents('compress.zlib://data:who/cares;base64,'. urldecode($token)));
        $_SESSION["usr"] = explode("=", $decoded[0])[1];
        $_SESSION["roles"] = explode(",",explode("=", $decoded[1])[1]);
    }
    
    function loginLDAP($usr, $pwd) {
        // TODO wollen wir das wirklich implementieren?
    }    
    
    if(!isset($_SESSION["usr"])) {
        if(isset($_COOKIE["MedusaToken"])) {
            loginMedusaToken($_COOKIE["MedusaToken"]);
        } else if(isset($_POST["USR"])){
            $_SESSION["usr"] = $_POST["USR"];
            if(isDevelopment()) {
                $_SESSION["roles"] = explode(",",$_POST["PWD"]);
            } else {
                loginLDAP($_POST["USR"], $_POST["PWD"]);
            }
        } else {
            include("loginForm.php");
            die();
        }     
    }
    // TODO find better logging ;-)
    echo("<br/><pre>");
    echo('usr : '.$_SESSION["usr"]."\nroles: ");
    print_r($_SESSION["roles"]);
    echo("\n</pre>");
?>