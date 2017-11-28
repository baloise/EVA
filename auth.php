<?php
    session_start();
    function isDevelopment() {
        // TODO : implement me
        return true;
    }
    
    function loginMedusaToken($token) {
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
