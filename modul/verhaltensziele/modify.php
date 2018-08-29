<?php

    include("../../includes/session.php");
    include("./../../database/connect.php");
    include('../../includes/testInput.php');

    if($session_usergroup != 3 && $session_usergroup != 1 && $session_usergroup != 2){
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
                $stmt = $mysqli->prepare("SELECT tb_userLL_ID, tb_userPA_ID, stageName FROM `tb_behaviorgrade` WHERE ID = ?;");
                $stmt->bind_param("i", $entryid);
                $stmt->execute();
                $result = $stmt->get_result();
                $userInfo = $result->fetch_array(MYSQLI_NUM);

				$stmt = $mysqli->prepare("DELETE FROM `tb_behaviorgrade` WHERE `tb_behaviorgrade`.`ID` = ?");
				$stmt->bind_param("i", $entryid);
				$stmt->execute();

                //SENDMAIL
                include("../../includes/generateMail.php");
                $msgcontent = array('{title}' => $userInfo[2], '{reason}' => $reason);
                $subject = strtr($translate[208], $msgcontent);
                $message = strtr($translate[209], $msgcontent);
                sendMail($subject, $message, $session_userid, $userInfo[0], $session_appinfo, $mysqli, $translate);
                sendMail($subject, $message, $session_userid, $userInfo[1], $session_appinfo, $mysqli, $translate);

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
                $stmt = $mysqli->prepare("SELECT tb_userLL_ID, tb_userPA_ID, stageName FROM `tb_behaviorgrade` WHERE ID = ?;");
                $stmt->bind_param("i", $entryid);
                $stmt->execute();
                $result = $stmt->get_result();
                $userInfo = $result->fetch_array(MYSQLI_NUM);

                //SENDMAIL
                include("../../includes/generateMail.php");
                $msgcontent = array('{title}' => $userInfo[2], '{reason}' => $reason);
                $subject = strtr($translate[210], $msgcontent);
                $message = strtr($translate[211], $msgcontent);
                sendMail($subject, $message, $session_userid, $userInfo[0], $session_appinfo, $mysqli, $translate);
                sendMail($subject, $message, $session_userid, $userInfo[1], $session_appinfo, $mysqli, $translate);
                sendMail($subject, $message, $session_userid, "hr", $session_appinfo, $mysqli, $translate);

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

                    str_replace(",",".",$points);

                    $stmt = $mysqli->prepare("INSERT INTO `tb_behaviorgrade` (`tb_userLL_ID`, `tb_userPA_ID`, `stageName`, `points`, `tb_semester_ID`) VALUES (?, ?, ?, ?, ?);");
                    $stmt->bind_param("iisii", $userid, $pa, $stage, $points, $semester);
                    $stmt->execute();

                    if($semester > $session_semesterid){
                        $stmt = $mysqli->prepare("UPDATE `tb_user` SET `tb_semester_ID` = ? WHERE `tb_user`.`ID` = ?");
                        $stmt->bind_param("ii", $semester, $session_userid);
                        $stmt->execute();
                        $_SESSION['user']['semester'] = $semester;
                        $session_semesterid = $semester;
                    }

                    //GET SENDMAIL PARAMETERS
                    $stmt = $mysqli->prepare("SELECT firstname, lastname FROM `tb_user` WHERE ID = ?");
                    $stmt->bind_param("i", $userid);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $userInfo = $result->fetch_array(MYSQLI_NUM);

                    //SENDMAIL
                    include("../../includes/generateMail.php");
                    $msgcontent = array('{firstname}' => $userInfo[0], '{lastname}' => $userInfo[1], '{stageName}' => $stage, '{stagePoints}' => $points);
                    $subject = strtr($translate[212], $msgcontent);
                    $message = strtr($translate[213], $msgcontent);
                    sendMail($subject, $message, $session_userid, $pa, $session_appinfo, $mysqli, $translate);
                    sendMail($subject, $message, $session_userid, "hr", $session_appinfo, $mysqli, $translate);

                } else {
                    $error = $error . "Der Ausgewähle User ist kein PA";
                    echo $error;
                }

            }

        }

    }

?>
