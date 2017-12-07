<?php
    
    if(!isset($_SESSION['user'])){
        session_start();
    }
    
    session_regenerate_id();
    
    if(isset($_SESSION['user']['usergroup'])){
        $usergroup = $_SESSION['user']['usergroup'];
    }
    
    if(isset($_SESSION['user']['username'])){
        $username = $_SESSION['user']['username'];
    } else {
        header("Location: login.php");
    }
?>