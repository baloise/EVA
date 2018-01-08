<?php

    include("../session/session.php");
    include("./../../database/connect.php");
    
    if(isset($_POST['action'])){
        
        if($_POST['action'] == "add"){
            
            $error = "";
            
            if(strlen($_POST['bkey']) != 7){
                $error = $error . "Der B-Key muss aus 7 Zeichen bestehen.<br/>";
            }
            
            if(!$_POST['group']){
                $error = $error . "Bitte Gruppe auswählen.<br/>";
            }

            
            $stmt = $mysqli->prepare("SELECT id, deleted FROM `tb_user` WHERE bKey = ?");
            $stmt->bind_param("s", $_POST['bkey']);
            $stmt->execute();
            $result = $stmt->get_result();

            if($error){
                
                echo $error;
                
            } else {
                
                if($result->num_rows > 1){
                    
                    $error = $error . "User wurde bereits mehrmal in Datenbank eingetragen. <br/>";
                    echo $error;
                    
                }  else if ($result->num_rows == 1) {
                    
                    $row = $result->fetch_assoc();
                    
                    if($row['deleted'] == 1){
                        
                            
                            $stmt = $mysqli->prepare("UPDATE `tb_user` SET deleted = NULL, tb_group_id = ? WHERE bkey = ?;");
                            $stmt->bind_param("is", $_POST['group'], $_POST['bkey']);
                            $stmt->execute();
                            
                        
                    } else {
                        
                        $error = $error . "User existiert bereits.<br/>";
                        echo $error;
                        
                    }
                     
                } else {
                            
                        $stmt = $mysqli->prepare("REPLACE INTO `tb_user` (`bKey`, `tb_group_ID`, `firstname`, `lastname`) VALUES (?, ?, ?, ?);");
                        $stmt->bind_param("ssss", $_POST['bkey'], $_POST['group'], $_POST['firstname'],  $_POST['lastname']);
                        $stmt->execute();
                            
                }
                
            }
                    
        }
            
        
        if($_POST['action'] == "delete"){
            
            $stmt = $mysqli->prepare("UPDATE `tb_user` SET `deleted` = 1 WHERE `tb_user`.`ID` = ?");
            $stmt->bind_param("s", $_POST['userid']);
            $stmt->execute();

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
        
    } 


?>