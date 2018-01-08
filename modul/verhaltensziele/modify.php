<?php

    include("../session/session.php");
    include("./../../database/connect.php");

    if($_POST['todo'] == "checkAndDelete"){
        //TODO
    }
    
    if($_POST['todo'] == "check"){
        //TODO
    }
    
    if($_POST['todo'] == "addEntry"){
        
        $error = "";
        $userid = $session_userid;
        $stage = $_POST['fstage'];
        $points = $_POST['fpoints'];
        $pa = $_POST['fpa'];
        
        if(!isset($userid)){
            $error = $error . "Kein User in Session.<br/>";
        }
        
        if(!isset($stage)){
            $error = $error . "Bitte Stage-Titel angeben.<br/>";
        }
        
        if(!isset($points)){
            $error = $error . "Bitte Punktzahl angeben.<br/>";
        }
        
        if(!isset($pa)){
            $error = $error . "Bitte PA angeben.<br/>";
        }
        
        if($error){
            echo $error;
        } else {
            
            $stmt = $mysqli->prepare("SELECT tb_group_ID FROM `tb_user` WHERE id = ?");
            $stmt->bind_param("s", $pa);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if($result->num_rows != 1){
                
                $error = $error . "Die PA-Eingabe ist ungültig";
                echo $error;
                
            } else {
                
                $row = $result->fetch_assoc();
                
                if($row['tb_group_ID'] == 2){
                    
                    $stmt = $mysqli->prepare("INSERT INTO `tb_behaviorgrade` (`tb_userLL_ID`, `tb_userPA_ID`, `stageName`, `points`) VALUES (?, ?, ?, ?);");
                    $stmt->bind_param("iisi", $userid, $pa, $stage, $points);
                    $stmt->execute();
                    
                } else {
                    $error = $error . "Der Ausgewähle User ist kein PA";
                    echo $error;
                }
                
            }

        }
         
    }

?>