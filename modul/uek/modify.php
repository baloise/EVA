<?php

    include("../../includes/session.php");
    include("./../../database/connect.php");

    //Werte trimmen und auf richtigkeit prüfen
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    if($session_usergroup != 5 && $session_usergroup != 1){
        die("Sie haben keine Berechtigungen zu diesem Modul");
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

                //GET SENDMAIL PARAMETERS
                $stmt = $mysqli->prepare("SELECT tb_user_ID, title FROM `tb_uek` WHERE ID = ?;");
                $stmt->bind_param("i", $entryid);
                $stmt->execute();
                $result = $stmt->get_result();
                $userInfo = $result->fetch_array(MYSQLI_NUM);

                //SENDMAIL
                include("../../includes/generateMail.php");
                $msgcontent = array('{title}' => $userInfo[1], '{reason}' => $reason);
                $subject = strtr($translate[232], $msgcontent);
                $message = strtr($translate[233], $msgcontent);
                sendMail($subject, $message, $session_userid, $userInfo[0], $session_appinfo, $mysqli, $translate);

				$stmt = $mysqli->prepare("DELETE FROM `tb_uek` WHERE `tb_uek`.`ID` = ?");
				$stmt->bind_param("i", $entryid);
				$stmt->execute();

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

                //GET SENDMAIL PARAMETERS
                $stmt = $mysqli->prepare("SELECT tb_user_ID, title FROM `tb_uek` WHERE ID = ?;");
                $stmt->bind_param("i", $entryid);
                $stmt->execute();
                $result = $stmt->get_result();
                $userInfo = $result->fetch_array(MYSQLI_NUM);

                //SENDMAIL
                include("../../includes/generateMail.php");
                $msgcontent = array('{title}' => $userInfo[1], '{reason}' => $reason);
                $subject = strtr($translate[234], $msgcontent);
                $message = strtr($translate[235], $msgcontent);
                sendMail($subject, $message, $session_userid, $userInfo[0], $session_appinfo, $mysqli, $translate);

			}

		}

    }

    if($_POST['todo'] == "addEntry"){

        $error = "";
        $userid = $session_userid;
        $title = test_input($_POST['fTitle']);
        $points = test_input($_POST['fpoints']);
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

        if(!isset($title)){
            $error = $error . "Bitte ÜK-Titel angeben.<br/>";
        }

        if(!isset($points)){
            $error = $error . "Bitte Punktzahl angeben.<br/>";
        }

        if($error){
            echo $error;
        } else {

            if($semester > $session_semesterid){
                $stmt = $mysqli->prepare("UPDATE `tb_user` SET `tb_semester_ID` = ? WHERE `tb_user`.`ID` = ?");
                $stmt->bind_param("ii", $semester, $session_userid);
                $stmt->execute();
                $_SESSION['user']['semester'] = $semester;
                $session_semesterid = $semester;
            }

            $stmt = $mysqli->prepare("INSERT INTO `tb_uek` (`tb_user_ID`, `title`, `grade`, `tb_semester_ID`) VALUES (?, ?, ?,?);");
            $stmt->bind_param("isii", $userid, $title, $points, $semester);
            $stmt->execute();

            //GET SENDMAIL PARAMETERS
            $stmt = $mysqli->prepare("SELECT firstname, lastname FROM `tb_user` WHERE ID = ?");
            $stmt->bind_param("i", $userid);
            $stmt->execute();
            $result = $stmt->get_result();
            $userInfo = $result->fetch_array(MYSQLI_NUM);

            //SENDMAIL
            include("../../includes/generateMail.php");
            $msgcontent = array('{firstname}' => $userInfo[0], '{lastname}' => $userInfo[1], '{title}' => $title, '{points}' => $points);
            $subject = strtr($translate[236], $msgcontent);
            $message = strtr($translate[237], $msgcontent);
            sendMail($subject, $message, $session_userid, "hr", $session_appinfo, $mysqli, $translate);

        }

    }

?>
