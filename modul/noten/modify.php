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

    if(isset($_POST['todo'])){
        
        if($_POST['todo'] == "addGrade"){
            
            $error = "";
            $title = test_input($_POST['title']);
            $grade = test_input($_POST['grade']);
            $weight = test_input($_POST['weight']);
            $subject = test_input($_POST['subjectId']);
            
            if(!$title){
                $error = $error . "Bitte Titel angeben";
            }
            
            if(!$grade || $grade < 1 || $grade > 6){
                $error = $error . "Bitte korrekte Note angeben";
            }
            
            if(!$weight || $weight < 1){
                $error = $error . "Bitte korrekte Gewichtung angeben";
            }
            
            if(!$subject){
                $error = $error . "Fehler: Kein Fach übergeben";
            }
            
            $stmt = $mysqli->prepare("SELECT * FROM `tb_user_subject` WHERE ID = ? AND tb_user_ID = ?;");
            $stmt->bind_param("ss", $subject, $session_userid);
            $stmt->execute();
            $result = $stmt->get_result();
            if(!$result->fetch_array(MYSQLI_NUM)){
                $error = $error . "Berechtigungsfehler";
            }
            $stmt->close();
            
            if($error){
                echo $error;
            } else {
                $stmt = $mysqli->prepare("INSERT INTO `tb_subject_grade` (`title`, `grade`, `weighting`, `notes`, `tb_user_subject_ID`) VALUES (?, ?, ?, NULL, ?);");
                $stmt->bind_param("sdii", $title, $grade, $weight, $subject);
                $stmt->execute();
            }
            
            
        } else if($_POST['todo'] == "deleteGrade"){
            
            $error = "";
            $gradeId = test_input($_POST['gradeId']);
            
            if(!$gradeId){
                $error = $error . "Keine Note angegeben.<br/>";
            }
            
            $stmt = $mysqli->prepare("SELECT sg.ID FROM `tb_subject_grade` AS sg INNER JOIN tb_user_subject AS us ON us.ID = sg.tb_user_subject_ID WHERE sg.ID = ? && us.tb_user_ID = ?");
            $stmt->bind_param("ss", $gradeId, $session_userid);
            $stmt->execute();
            $result = $stmt->get_result();
            if(!$result->fetch_array(MYSQLI_NUM)){
                $error = $error . "Berechtigungsfehler";
            }
            $stmt->close();
            
            if($error){
                echo $error;
            } else {
                $stmt = $mysqli->prepare("DELETE FROM `tb_subject_grade` WHERE `tb_subject_grade`.`ID` = ?;");
                $stmt->bind_param("i", $gradeId);
                $stmt->execute();
            }
            
        } else if($_POST['todo'] == "addSubject"){
            
            $error = "";
            $subName = test_input($_POST['subName']);
            $subSem = test_input($_POST['subSem']);
            
            if(!$subName){
                $error = $error . "Bitte Fach angeben.<br/>";
            }
            
            if(!$subSem){
                $error = $error . "Bitte Semester angeben.<br/>";
            }
            
            $stmt = $mysqli->prepare("SELECT * FROM `tb_semester` WHERE ID = ? AND tb_group_ID = ?");
            $stmt->bind_param("ss", $subSem, $session_usergroup);
            $stmt->execute();
            $result = $stmt->get_result();
            if(!$result->fetch_array(MYSQLI_NUM)){
                $error = $error . "Berechtigungsfehler";
            }
            $stmt->close();
            
            if($error){
                echo $error;
            } else {
                $stmt = $mysqli->prepare("INSERT INTO `tb_user_subject` (`subjectName`, `tb_user_ID`, `tb_semester_ID`) VALUES (?, ?, ?);");
                $stmt->bind_param("sii", $subName, $session_userid, $subSem);
                $stmt->execute();
            }
            
        } else if($_POST['todo'] == "deleteSubject"){
            
            $error = "";
            $subject = test_input($_POST['subId']);
            
            if(!$subject){
                $error = $error . "Kein Fach gegeben.";
            }
            
            $stmt = $mysqli->prepare("SELECT * FROM `tb_user_subject` WHERE ID = ? AND tb_user_ID = ?;");
            $stmt->bind_param("ss", $subject, $session_userid);
            $stmt->execute();
            $result = $stmt->get_result();
            if(!$result->fetch_array(MYSQLI_NUM)){
                $error = $error . "Berechtigungsfehler";
            }
            $stmt->close();
            
            if($error){
                echo $error;
            } else {
                
                $stmt = $mysqli->prepare("DELETE FROM `tb_subject_grade` WHERE `tb_user_subject_ID` = ?;");
                $stmt->bind_param("i", $subject);
                $stmt->execute();
                
                $stmt = $mysqli->prepare("DELETE FROM `tb_user_subject` WHERE `ID` = ?");
                $stmt->bind_param("i", $subject);
                $stmt->execute();
                
            }
            
        } else {
            echo "Fehlerhafte Anweisung übergeben: '" . $_POST['todo'] . "'";
        }
        
    } else {
        echo "Keine Anweisung übergeben.";
    }
    
?>