<?php
    
    if(!isset($_SESSION['user'])){
        session_start();
    }
    
    session_regenerate_id();
    
    $usergroup = $_SESSION['user']['usergroup'];
    $username = $_SESSION['user']['username'];
?>