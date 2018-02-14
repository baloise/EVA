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
				
				$stmt = $mysqli->prepare("DELETE FROM `tb_behaviorgrade` WHERE `tb_behaviorgrade`.`ID` = ?");
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
        $stage = test_input($_POST['fstage']);
        $points = test_input($_POST['fpoints']);
        $pa = test_input($_POST['fpa']);
        $semester = test_input($_POST['fsem']);
        
        if(!isset($semester)){
            $error = $error . "Kein Semester Angegeben.<br/>";
        } else {
            $stmtSem = $mysqli->prepare("SELECT ID FROM `tb_semester` WHERE tb_group_ID = ? AND ID = ?");
            $stmtSem->bind_param("ii", $session_usergroup, $semester);
            $stmtSem->execute();
            $resultSem = $stmtSem->get_result();
            if($resultSem->num_rows != 1){
                $error = $error . "Die Semester-Eingabe ist ungültig";
            }
        }
        
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
                    
                    $stmt = $mysqli->prepare("INSERT INTO `tb_behaviorgrade` (`tb_userLL_ID`, `tb_userPA_ID`, `stageName`, `points`, `tb_semester_ID`) VALUES (?, ?, ?, ?, ?);");
                    $stmt->bind_param("iisii", $userid, $pa, $stage, $points, $semester);
                    $stmt->execute();
                    
                } else {
                    $error = $error . "Der Ausgewähle User ist kein PA";
                    echo $error;
                }
                
            }

        }
         
    }

?>