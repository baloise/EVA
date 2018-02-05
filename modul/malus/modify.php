<?php

    include("../session/session.php");
    include("./../../database/connect.php");

    //Werte trimmen und auf richtigkeit prüfen
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    
    //TODO: e-mail functionalities
    
    if($session_usergroup != 1){
        echo "Ihrem Account fehlen die Berechtigungen für diese Aktion. <br/>";
    } else {
        
        if($_POST['todo'] == "addEntry"){
        
            $error = "";
            $fselUser = test_input($_POST['fselUser']);
            $fweigth = test_input($_POST['fweigth']);
            $freasoning = test_input($_POST['freasoning']);
            
            if(!isset($fselUser)){
                $error = $error . "Bitte Lehrling angeben.<br/>";
            }
            
            if(!isset($fweigth)){
                $error = $error . "Bitte Gewichtung angeben.<br/>";
            }
            
            if(!isset($freasoning)){
                $error = $error . "Bitte Begründung angeben.<br/>";
            }
            
            if($error){
                echo $error;
            } else {
                    
                $stmt = $mysqli->prepare("INSERT INTO `tb_malus` (`description`, `tb_user_ID`, `weight`) VALUES (?, ?, ?);");
                $stmt->bind_param("sii", $freasoning, $fselUser, $fweigth);
                $stmt->execute();
    
            }
             
        }
        
        if($_POST['todo'] == "deleteEntry"){
            
            $error = "";
            $fentryId = test_input($_POST['fentryId']);
            
            if(!isset($fentryId)){
                $error = $error . "Kein Eintrag angegeben.<br/>";
            }
            
            if($error){
                echo $error;
            } else {
                    
                $stmt = $mysqli->prepare("DELETE FROM `tb_malus` WHERE `tb_malus`.`ID` = ?");
                $stmt->bind_param("i", $fentryId);
                $stmt->execute();
    
            }
            
        }
        
    }

?>