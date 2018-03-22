<?php

    if(!isset($_SESSION['user'])){
        session_start();
    }

    if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
        session_unset();
        session_destroy();
    } else {

        session_regenerate_id();

        $_SESSION['LAST_ACTIVITY'] = time();

        if(isset($_SESSION['user']['username'])  && isset($_SESSION['user']['id']) && isset($_SESSION['user']['usergroup']) && isset($_SESSION['user']['language']) && isset($_SESSION['translations']) && isset($_SESSION['appinfo'])){

            $session_username = $_SESSION['user']['username'];
            $session_userid = $_SESSION['user']['id'];
            $session_usergroup = $_SESSION['user']['usergroup'];
            $session_language =$_SESSION['user']['language'];
            $translate = $_SESSION['translations'];
            $session_semesterid = $_SESSION['user']['semester'];

            $session_appinfo = $_SESSION['appinfo'];

        } else {
            header("Location: ./login.php");
            exit();
        }

        if($session_usergroup != 5 && $session_usergroup != 1 && $session_usergroup != 2 && $session_usergroup != 3 && $session_usergroup != 4){
            die("Sie haben keine Berechtigungen zu diesem Modul");
        }

    }

?>
