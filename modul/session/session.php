<?php
    
    if(!isset($_SESSION['user'])){
        session_start();
    }
    
    session_regenerate_id();
    
    if(isset($_SESSION['user']['username'])  && isset($_SESSION['user']['id']) && isset($_SESSION['user']['usergroup'])){
        
        $session_username = $_SESSION['user']['username'];
        $session_userid = $_SESSION['user']['id'];
        $session_usergroup = $_SESSION['user']['usergroup'];
        
    } else {
        header("Location: ./login.php");
        exit();
    }
?>