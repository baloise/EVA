<?php

    include("../session/session.php");
    include("./../../database/connect.php");
    
    if(isset($_POST['action'])){
        
        if($_POST['action'] == "add"){
            
            $stmt = $mysqli->prepare("REPLACE INTO `tb_user` (`bKey`, `tb_group_ID`, `firstname`, `lastname`) VALUES (?, ?, ?, ?);");
            $stmt->bind_param("ssss", $_POST['bkey'], $_POST['group'], $_POST['firstname'],  $_POST['lastname']);
            $stmt->execute();
            $stmt->close();
            $mysqli->close();
            echo "Success";
        }
        
        if($_POST['action'] == "delete"){
            
            
            $stmt = $mysqli->prepare("UPDATE `tb_user` SET `deleted` = 1 WHERE `tb_user`.`ID` = ?");
            $stmt->bind_param("s", $_POST['userid']);
            $stmt->execute();
            $stmt->close();
            $mysqli->close();
            echo "Success";
        }
        
        if($_POST['action'] == "change"){

            if($_POST['fType'] == 1){
                
                $stmt = $mysqli->prepare("UPDATE `tb_user` SET `tb_group_ID` = ? WHERE `tb_user`.`ID` = ?");
                $stmt->bind_param("ss", $_POST['content'], $_POST['userid']);
                
            }
            
            if ($_POST['fType'] == 2){
                
                $stmt = $mysqli->prepare("UPDATE `tb_user` SET `firstname` = ? WHERE `tb_user`.`ID` = ?");
                $stmt->bind_param("ss", $_POST['content'], $_POST['userid']);
                
            }
            
            if ($_POST['fType'] == 3){
                
                $stmt = $mysqli->prepare("UPDATE `tb_user` SET `lastname` = ? WHERE `tb_user`.`ID` = ?");
                $stmt->bind_param("ss", $_POST['content'], $_POST['userid']);
                
            } 
            
            $stmt->execute();
            $stmt->close();
            $mysqli->close();
            echo "Success";
            
        }
        
    } else {
        echo "ungültiger Aufruf";
        foreach ($_POST as $key => $value) {
            echo '<p>'.$key.'</p>';
            foreach($value as $k => $v) {
                echo '<p>'.$k.'</p>';
                echo '<p>'.$v.'</p>';
                echo '<hr />';
            }
        }
    }

?>