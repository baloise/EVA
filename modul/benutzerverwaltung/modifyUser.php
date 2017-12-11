<?php

    include("../session/session.php");
    include("./../../database/connect.php");
    
    if(isset($_GET['action'])){
        if($_GET['action'] == "add"){
            
            
            $stmt = $mysqli->prepare("REPLACE INTO `tb_user` (`bKey`, `tb_group_ID`) VALUES (?, ?);");
            $stmt->bind_param("ss", $_GET['bkey'], $_GET['group']);
            $stmt->execute();
            $stmt->close();
            $mysqli->close();
        }
    } else {
        echo "ungültiger Aufruf";
    }

?>