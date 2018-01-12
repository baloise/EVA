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
    
    if($_POST['todo'] == "checkAndDelete"){
		
		$error = "";
		$userid = $session_userid;
		$reason = test_input($_POST['reason']);
		$entryid = test_input($_POST['entryID']);
        
		if(!$reason){
			$error = $error . "Bitte eine Begründung angeben. <br/>";
		}
		
		if(!$entryid){
			$error = $error . "Die ID des Eintrags konnte nicht übergeben werden. <br/>";
		}
		
		if($error){
			
			echo $error;
			
		} else {
		
			$stmt = $mysqli->prepare("SELECT bKey FROM tb_user WHERE id = ? AND tb_group_ID = 1");
			$stmt->bind_param("i", $userid);
			$stmt->execute();
			$result = $stmt->get_result();
				
			if($result->num_rows != 1){
				
				$error = $error . "Ihrem Account fehlen die Berechtigungen für diese Aktion. <br/>";
				echo $error;
				
			} else {
				
				$stmt = $mysqli->prepare("DELETE FROM `tb_presentation` WHERE `tb_presentation`.`ID` = ?");
				$stmt->bind_param("i", $entryid);
				$stmt->execute();
				
				//TODO Mails versenden
				
			}
			
		}
		
    }
    
    if($_POST['todo'] == "check"){
        
		$error = "";
		$userid = $session_userid;
		$reason = test_input($_POST['reason']);
		$entryid = test_input($_POST['entryID']);
		
		if(!$reason){
			$error = $error . "Bitte eine Begründung angeben. <br/>";
		}
		
		if(!$entryid){
			$error = $error . "Die ID des Eintrags konnte nicht übergeben werden. <br/>";
		}
		
		if($error){
			
			echo $error;
			
		} else {
		
			$stmt = $mysqli->prepare("SELECT bKey FROM tb_user WHERE id = ? AND tb_group_ID = 1 OR id = ? AND tb_group_ID = 2");
			$stmt->bind_param("ii", $userid, $userid);
			$stmt->execute();
			$result = $stmt->get_result();
				
			if($result->num_rows != 1){
				
				$error = $error . "Ihrem Account fehlen die Berechtigungen für diese Aktion. <br/>";
				echo $error;
				
			} else {
				
				//TODO Mails versenden
				
			}
			
		}
		
    }
    
    if($_POST['todo'] == "addEntry"){
        
        $error = "";
        $userid = $session_userid;
        $title = test_input($_POST['fTitle']);
        $points = test_input($_POST['fpoints']);
        
        if(!isset($userid)){
            $error = $error . "Kein User in Session.<br/>";
        }
        
        if(!isset($title)){
            $error = $error . "Bitte Stage-Titel angeben.<br/>";
        }
        
        if(!isset($points)){
            $error = $error . "Bitte Punktzahl angeben.<br/>";
        }
        
        if($error){
            echo $error;
        } else {
                
            $stmt = $mysqli->prepare("INSERT INTO `tb_presentation` (`tb_user_ID`, `title`, `points`) VALUES (?, ?, ?);");
            $stmt->bind_param("isi", $userid, $title, $points);
            $stmt->execute();

        }
         
    }

?>