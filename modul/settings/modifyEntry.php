<?php

    include("../../database/connect.php");
    
    if(isset($_POST['doEntry']) && isset($_POST['navItemID'])) {
        
        if($_POST['doEntry'] == "delete"){
            
            $stmt = $mysqli->prepare("DELETE FROM `tb_ind_nav` WHERE ID = ?");
            $stmt->bind_param('s', $_POST['navItemID']);
            $stmt->execute();
    
        }
        
        if($_POST['doEntry'] == "moveUp"){
            
            $stmt = $mysqli->prepare("UPDATE `tb_ind_nav` SET position = (position-1) WHERE ID = ?");
            $stmt->bind_param('s', $_POST['navItemID']);
            $stmt->execute();
            $stmt->close();
            
        }
        
        if($_POST['doEntry'] == "moveDown"){
            
        }
        
        if($_POST['doEntry'] == "add"){
            
            $stmt = $mysqli->prepare("INSERT INTO `tb_ind_nav` (`tb_user_ID`, `tb_modul_ID`) VALUES (?, ?);");
            $stmt->bind_param('ss', $_POST['userID'], $_POST['navItemID']);
            $stmt->execute();
            
        }
        
    }

?>