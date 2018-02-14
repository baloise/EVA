<?php

    include("../session/session.php");
    include("./../../database/connect.php");
    
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    
    if(isset($_POST['action'])){
        
        if($_POST['action'] == "add"){
            
            $error = "";
            
            $bkey = test_input($_POST['bkey']);
            $group = test_input($_POST['group']);
            $firstname = test_input($_POST['firstname']);
            $lastname = test_input($_POST['lastname']);
            
            if(strlen($bkey) != 7){
                $error = $error . "Der B-Key muss aus 7 Zeichen bestehen.<br/>";
            }
            
            if(!$group){
                $error = $error . "Bitte Gruppe auswählen.<br/>";
            }

            $stmt = $mysqli->prepare("SELECT id, deleted FROM `tb_user` WHERE bKey = ?");
            $stmt->bind_param("s", $bkey);
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
                            $stmt->bind_param("is", $group, $bkey);
                            $stmt->execute();
                            
                        
                    } else {
                        
                        $error = $error . "User existiert bereits.<br/>";
                        echo $error;
                        
                    }
                     
                } else {
                            
                        $stmt = $mysqli->prepare("REPLACE INTO `tb_user` (`bKey`, `tb_group_ID`, `firstname`, `lastname`) VALUES (?, ?, ?, ?);");
                        $stmt->bind_param("ssss", $bkey, $group, $firstname, $lastname);
                        $stmt->execute();
                            
                }
                
            }
                    
        } else if($_POST['action'] == "delete"){
            
            $userid = test_input($_POST['userid']);
            
            $stmt = $mysqli->prepare("UPDATE `tb_user` SET `deleted` = 1 WHERE `tb_user`.`ID` = ?");
            $stmt->bind_param("s", $userid);
            $stmt->execute();

        } else if($_POST['action'] == "change"){

            $userid = test_input($_POST['userid']);
            $content = test_input($_POST['content']);
        
            if($_POST['fType'] == 1){
                
                $stmt = $mysqli->prepare("UPDATE `tb_user` SET `tb_group_ID` = ? WHERE `tb_user`.`ID` = ?");
                $stmt->bind_param("ss", $content, $userid);
                
            }
            
            if ($_POST['fType'] == 2){
                
                $stmt = $mysqli->prepare("UPDATE `tb_user` SET `firstname` = ? WHERE `tb_user`.`ID` = ?");
                $stmt->bind_param("ss", $content, $userid);
                
            }
            
            if ($_POST['fType'] == 3){
                
                $stmt = $mysqli->prepare("UPDATE `tb_user` SET `lastname` = ? WHERE `tb_user`.`ID` = ?");
                $stmt->bind_param("ss", $content, $userid);
                
            } 
            
            $stmt->execute();
            $stmt->close();
            $mysqli->close();
            
        } else {
            echo "Unbekannter Befehl übergeben";
        }
        
    } 


?>