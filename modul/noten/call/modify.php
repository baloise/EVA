<?php

    include("../../../includes/session.php");
    include("./../../../database/connect.php");
    include('../../../includes/testInput.php');

    if($session_usergroup != 3 && $session_usergroup != 4 && $session_usergroup != 5 && $session_usergroup != 1){
        die("Sie haben keine Berechtigungen zu diesem Modul");
    }

    if(isset($_POST['todo'])){

        if($_POST['todo'] == "addGrade"){

            $error = "";
            $title = test_input($_POST['title']);
            $grade = test_input($_POST['grade']);
            $weight = test_input($_POST['weight']);
            $subject = test_input($_POST['subjectId']);
            $reason = test_input($_POST['reason']);

            if(!$title){
                $error = $error . "<li>" . $translate[172] . "</li>";
            }

            if(!$grade || $grade < 1 || $grade > 6){
                $error = $error . "<li>" . $translate[171] . "</li>";
            }

            if(!$weight || $weight < 1){
                $error = $error . "<li>" . $translate[173] . "</li>";
            }

            if(!$subject){
                $error = $error . "<li>" . $translate[163] . "</li>";
            }

            if($grade < 4){

                $sendmail = 1;

                if(!$reason){
                    $error = $error . "<li>" . $translate[174] . "</li>";
                }

            }

            $stmt = $mysqli->prepare("SELECT tb_semester_ID FROM `tb_user_subject` WHERE ID = ? AND tb_user_ID = ?;");
            $stmt->bind_param("ss", $subject, $session_userid);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_array(MYSQLI_NUM);
            if(!$row[0]){
                $error = $error . "Berechtigungsfehler";
            } else {
                if($row[0] > $session_semesterid){
                    $stmt = $mysqli->prepare("UPDATE `tb_user` SET `tb_semester_ID` = ? WHERE `tb_user`.`ID` = ?");
                    $stmt->bind_param("ii", $row[0], $session_userid);
                    $stmt->execute();
                    $_SESSION['user']['semester'] = $row[0];
                    $session_semesterid = $row[0];
                }
            }

            $stmt->close();

            if($error){
                echo $error;
            } else {
                $stmt = $mysqli->prepare("INSERT INTO `tb_subject_grade` (`title`, `grade`, `weighting`, `notes`, `tb_user_subject_ID`, reasoning) VALUES (?, ?, ?, NULL, ?, ?)");
                $stmt->bind_param("sddis", $title, $grade, $weight, $subject, $reason);
                $stmt->execute();

                if(isset($sendmail)){

                    $sql = "SELECT firstname, lastname, bKey FROM `tb_user` WHERE ID = $session_userid";
                    $result = $mysqli->query($sql);

                    if (isset($result) && $result->num_rows == 1) {
                        $userData = $result->fetch_assoc();

                        //SENDMAIL
                        include("../../includes/generateMail.php");
                        $msgcontent = array('{firstname}' => $userData['firstname'], '{lastname}' => $userData['lastname'], '{bkey}' => $userData['bKey'], '{gradeTitle}' => $title, '{grade}' => $grade, '{gradeWeight}' => $weight, '{gradeReason}' => $reason);
                        $subject = strtr($translate[202], $msgcontent);
                        $message = strtr($translate[203], $msgcontent);
                        sendMail($subject, $message, $session_userid, "hr", $session_appinfo, $mysqli, $translate);

                    }

                }

            }


        } else if($_POST['todo'] == "editGradeInForm"){

            $gradeId = test_input($_POST['gradeId']);
            $newTitle = test_input($_POST['title']);
            $newGrade = test_input($_POST['grade']);
            $newWeight = test_input($_POST['weight']);
            $error = "";

            $control = 'SELECT * FROM `tb_subject_grade` AS sg
                        INNER JOIN tb_user_subject AS usg ON sg.tb_user_subject_ID = usg.ID
                        INNER JOIN tb_user AS us ON us.ID = usg.tb_user_ID
                        WHERE us.ID = ? AND sg.ID = ?';
            $stmt = $mysqli->prepare($control);
            $stmt->bind_param("ii", $session_userid, $gradeId);
            $stmt->execute();
            $result = $stmt->get_result();

            if(!$result->fetch_array(MYSQLI_NUM)){
                $error = $error . "Berechtigungsfehler";
            }

            if(!isset($newTitle)){
                $error .= "<li>" . $translate[172] . "</li>";
            }

            if($error){
                echo $error;
            } else {

                $stmt = $mysqli->prepare('UPDATE `tb_subject_grade` SET `title` = ?, `grade` = ?, `weighting` = ? WHERE `tb_subject_grade`.`ID` = ?;');
                $stmt->bind_param("sddi", $newTitle, $newGrade, $newWeight, $gradeId);
                $stmt->execute();

            }

        } else if($_POST['todo'] == "correction"){

            $subjid = test_input($_POST['subid']);
            $corrgrade = test_input($_POST['corrGrade']);
            $error = "";

            $stmt = $mysqli->prepare("SELECT ID FROM `tb_user` WHERE ID = ? && tb_group_ID = 1");
            $stmt->bind_param("i", $session_userid);
            $stmt->execute();
            $result = $stmt->get_result();
            if(!$result->fetch_array(MYSQLI_NUM)){
                $error = $error . "Berechtigungsfehler";
            }
            $stmt->close();

            if($session_usergroup != 1){
                $error = $error . "Berechtigungsfehler";
            }

            if(!$subjid){
                $error = $error . "Keine Fach-ID angegeben.<br/>";
            }

            if(!$corrgrade || $corrgrade < 1 || $corrgrade > 6){
                $error = $error . "Keine/Ungültige Note angegeben.<br/>";
            }

            if($error){
                echo $error;
            } else {

                $stmt = $mysqli->prepare("UPDATE `tb_user_subject` SET `correctedGrade` = ? WHERE `tb_user_subject`.`ID` = ?;");
                $stmt->bind_param("di", $corrgrade, $subjid);
                $stmt->execute();

                $stmt = $mysqli->prepare("SELECT tb_user_ID, subjectName FROM `tb_user_subject` WHERE ID = ?;");
                $stmt->bind_param("i", $subjid);
                $stmt->execute();
                $result = $stmt->get_result();
                $userInfo = $result->fetch_array(MYSQLI_NUM);

                //SENDMAIL
                include("../../includes/generateMail.php");
                $msgcontent = array('{subjectName}' => $userInfo[1], '{newGrade}' => $corrgrade);
                $subject = strtr($translate[204], $msgcontent);
                $message = strtr($translate[205], $msgcontent);
                sendMail($subject, $message, $session_userid, $userInfo[0], $session_appinfo, $mysqli, $translate);

            }

        } else if($_POST['todo'] == "deleteGrade"){

            $error = "";
            $gradeId = test_input($_POST['gradeId']);

            if(!$gradeId){
                $error = $error . "Keine Note angegeben.<br/>";
            }

            $stmt = $mysqli->prepare("SELECT sg.ID FROM `tb_subject_grade` AS sg INNER JOIN tb_user_subject AS us ON us.ID = sg.tb_user_subject_ID WHERE sg.ID = ? && us.tb_user_ID = ?");
            $stmt->bind_param("ii", $gradeId, $session_userid);
            $stmt->execute();
            $result = $stmt->get_result();
            if(!$result->fetch_array(MYSQLI_NUM)){
                $error = $error . "Berechtigungsfehler";
            }
            $stmt->close();

            if($error){
                echo $error;
            } else {

                $stmt = $mysqli->prepare("SELECT grade, title, reasoning, weighting FROM `tb_subject_grade` WHERE ID = ? AND grade <= 4");
                $stmt->bind_param("s", $gradeId);
                $stmt->execute();
                $result = $stmt->get_result();
                $stmt->close();
                if($row = $result->fetch_array(MYSQLI_NUM)){

                    $sql = "SELECT firstname, lastname, bKey FROM `tb_user` WHERE ID = $session_userid";
                    $result = $mysqli->query($sql);

                    if (isset($result) && $result->num_rows == 1) {
                        $userData = $result->fetch_assoc();

                        //SENDMAIL
                        include("../../includes/generateMail.php");
                        $msgcontent = array('{firstname}' => $userData['firstname'], '{lastname}' => $userData['lastname'], '{bkey}' => $userData['bKey'], '{gradeTitle}' => $row[1], '{grade}'  => $row[0], '{gradeWeight}'  => $row[3], '{gradeReason}' => $row[2]);
                        $subject = strtr($translate[206], $msgcontent);
                        $message = strtr($translate[207], $msgcontent);
                        sendMail($subject, $message, $session_userid, "hr", $session_appinfo, $mysqli, $translate);

                    }

                }

                $stmt = $mysqli->prepare("DELETE FROM `tb_subject_grade` WHERE `tb_subject_grade`.`ID` = ?;");
                $stmt->bind_param("i", $gradeId);
                $stmt->execute();

            }

        } else if($_POST['todo'] == "addSubject"){

            $error = "";
            $subName = test_input($_POST['subName']);
            $subSem = test_input($_POST['subSem']);
            $subType = test_input($_POST['subType']);

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
                $stmt = $mysqli->prepare("INSERT INTO `tb_user_subject` (`subjectName`, `tb_user_ID`, `tb_semester_ID`, `school`) VALUES (?, ?, ?, ?);");
                $stmt->bind_param("siii", $subName, $session_userid, $subSem, $subType);
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
