<?php

header("Content-Type: application/json", true);

include("../../database/connect.php");

if(isset($_POST['doEntry']) && isset($_POST['pos'])) {
    
    if($_POST['doEntry'] == "delete"){
        echo($_POST['doEntry']);
        $stmt = $mysqli->prepare("DELETE FROM `tb_ind_nav` WHERE ID = ?");
        $stmt->bind_param('s', $_POST['navItemID']);
        $stmt->execute();
        $stmt->close();

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
        
    }
    
}

?>