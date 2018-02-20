<?php
    
    if(!isset($_SESSION['user'])){
        session_start();
    }
    
    session_regenerate_id();
    
    if(isset($_SESSION['user']['username'])  && isset($_SESSION['user']['id']) && isset($_SESSION['user']['usergroup']) && isset($_SESSION['user']['language']) && isset($_SESSION['translations'])){
        
        $session_username = $_SESSION['user']['username'];
        $session_userid = $_SESSION['user']['id'];
        $session_usergroup = $_SESSION['user']['usergroup'];
        $session_language =$_SESSION['user']['language'];
        $translate = $_SESSION['translations'];
        
    } else {
        header("Location: ./login.php");
        exit();
    }
    
    if($session_usergroup != 5 && $session_usergroup != 1 && $session_usergroup != 2 && $session_usergroup != 3 && $session_usergroup != 4){
        die("Sie haben keine Berechtigungen zu diesem Modul");
    }
    
?>