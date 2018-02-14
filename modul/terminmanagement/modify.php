<?php

    include("../session/session.php");
    include("./../../database/connect.php");
    
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    
    if($session_usergroup == 1){
        
        $todo = test_input($_POST['todo']);
        
        if($_POST['todo'] == "addEntry" || $_POST['todo'] == "deleteEntry"){
            
            $userid = test_input($_POST['userid']);
            $deadlineid = test_input($_POST['deadlineid']);
            $error = "";
            
            if(!isset($userid)){
                $error = $error . "Keine Benutzer-ID übergeben";
            }
            
            if(!isset($deadlineid)){
                $error = $error . "Keine Termin-ID übergeben";
            }
            
            if($error){
                echo $error;
            } else {
                
                if($todo == "addEntry"){
                    $stmt = $mysqli->prepare("INSERT INTO `tb_deadline_check` (`tb_deadline_ID`, `tb_user_ID`) VALUES (?, ?);");
                } else if ($todo == "deleteEntry"){
                    $stmt = $mysqli->prepare("DELETE FROM `tb_deadline_check` WHERE `tb_deadline_ID` = ? AND `tb_user_ID` = ?");
                }
                
                $stmt->bind_param("ii", $deadlineid, $userid);
                $stmt->execute();
            }
            
        } else if($_POST['todo'] == "editList"){
            
            $did = test_input($_POST['did']);
            $content = test_input($_POST['content']);
        
            if($_POST['fType'] == 1){
                
                $stmt = $mysqli->prepare("UPDATE `tb_deadline` SET `title` = ? WHERE ID = ?");
                
            }
            
            if ($_POST['fType'] == 2){
                
                $stmt = $mysqli->prepare("UPDATE `tb_deadline` SET `description` = ? WHERE ID = ?");
                
            }
            
            if ($_POST['fType'] == 3){
                
                $stmt = $mysqli->prepare("UPDATE `tb_deadline` SET `date` = ? WHERE ID = ?");
                
            }
            
            if ($_POST['fType'] == 4){
                
                $stmt = $mysqli->prepare("UPDATE `tb_deadline` SET `tb_semester_ID` = ? WHERE ID = ?");
                
            } 
            
            $stmt->bind_param("si", $content, $did);
            $stmt->execute();
            $stmt->close();
            $mysqli->close();
            
        } else if($_POST['todo'] == "getSemester"){
            
            $selGroup = test_input($_POST['selGroup']);
            
            $stmt = $mysqli->prepare("SELECT se.ID, se.semester FROM `tb_group` AS grou 
                                        INNER JOIN tb_semester AS se ON se.tb_group_ID = grou.ID
                                        WHERE grou.ID = ?;");
            $stmt->bind_param("i", $selGroup);
            $stmt->execute();
            
            $result = $stmt->get_result();
            while ($row = $result->fetch_array(MYSQLI_NUM)){
                echo "<option value='". $row[0] ."'>". $row[1] ."</option>";
            }
            
        } else if($_POST['todo'] == "addDid"){
            
            $title = test_input($_POST['title']);
            $description = test_input($_POST['description']);
            $deadline = test_input($_POST['deadline']);
            $semester = test_input($_POST['semester']);
            $error = "";
            
            if(!$title){
                $error = $error . "Bitte Titel angeben. <br/>";
            }
            
            if(!$deadline){
                $error = $error . "Bitte Deadline angeben. <br/>";
            }
            
            if(!$semester){
                $error = $error . "Bitte Semester angeben. <br/>";
            }
            
            if($error){
                echo $error;
            } else {
                
                $stmt = $mysqli->prepare("INSERT INTO `tb_deadline` (`title`, `description`, `date`, `tb_semester_ID`) VALUES (?, ?, ?, ?);");
                $stmt->bind_param("sssi", $title, $description, $deadline, $semester);
                $stmt->execute();
                
            }
            
            
        } else if($_POST['todo'] == "deleteDid"){
            
            $did = test_input($_POST['did']);
            
            if($did){
                
                
                $stmt = $mysqli->prepare("DELETE FROM `tb_deadline_check` WHERE `tb_deadline_ID` = ?");
                $stmt->bind_param("i", $did);
                $stmt->execute();
                
                
            } else {
                echo "Keine Termin-ID übergeben.";
            }
            
        } else {
            echo "Ungültige Anweisung übergeben.";
        }
        
    } else {
        echo "Keine Berechtigungen auf diese Funktionen";
    }

?>
