<?php

    if(!isset($_SESSION['user'])){

        session_start();

    }

    if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 900)) {

        session_destroy();
        echo '<script type="text/javascript">parent.window.location.reload();</script>';
        exit();

    } else {

        if (!headers_sent()) {
            session_regenerate_id();
        }

        $_SESSION['LAST_ACTIVITY'] = time();

        if(isset($_SESSION['user']['username'])  && isset($_SESSION['user']['id']) && isset($_SESSION['user']['usergroup']) && isset($_SESSION['user']['language']) && isset($_SESSION['translations']) && isset($_SESSION['appinfo'])){

            //Muss bei änderungen manuell im Kontakt-Modul angepasst werden
            $session_username = $_SESSION['user']['username'];
            $session_userid = $_SESSION['user']['id'];
            $session_usergroup = $_SESSION['user']['usergroup'];
            $session_language = $_SESSION['user']['language'];
            $translate = $_SESSION['translations'];
            $session_semesterid = $_SESSION['user']['semester'];

            $session_appinfo = $_SESSION['appinfo'];

        } else {
            if(isset($_GET['page'])){
                header("Location: ./login.php?redirect=".$_GET['page']);
            } else {
                header("Location: ./login.php");
            }
            exit();
        }

        if($session_usergroup != 5 && $session_usergroup != 1 && $session_usergroup != 2 && $session_usergroup != 3 && $session_usergroup != 4 && $session_usergroup != 6){
            die("You are not member of any group");
        }

    }

?>
