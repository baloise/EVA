<?php

    include("../../../includes/session.php");
    include("./../../../database/connect.php");
    include("./../../../database/partner.php");
    include('../../../includes/testInput.php');

    if($session_usergroup != 1){
        die("Sie haben keine Berechtigungen zu diesem Modul");
    }

    if(isset($_POST['action'])){

        if($_POST['action'] == "resetSemester"){

            $userid = test_input($_POST['userid']);
            $semester = test_input($_POST['semester']);

            $stmt['1'] = $mysqli->prepare("DELETE FROM `tb_als` WHERE `tb_user_ID` = ? AND `tb_semester_ID` = ?");
            $stmt['2'] = $mysqli->prepare("DELETE FROM `tb_behaviorgrade` WHERE `tb_userLL_ID` = ? AND `tb_semester_ID` = ?");
            $stmt['3'] = $mysqli->prepare("DELETE FROM `tb_malus` WHERE `tb_user_ID` = ? AND `tb_semester_ID` = ?");
            $stmt['4'] = $mysqli->prepare("DELETE FROM `tb_pe` WHERE `tb_user_ID` = ? AND `tb_semester_ID` = ?");
            $stmt['5'] = $mysqli->prepare("DELETE FROM `tb_presentation` WHERE `tb_user_ID` = ? AND `tb_semester_ID` = ?");
            $stmt['6'] = $mysqli->prepare("DELETE FROM `tb_stao` WHERE `tb_user_ID` = ? AND `tb_semester_ID` = ?");
            $stmt['7'] = $mysqli->prepare("DELETE FROM `tb_uek` WHERE `tb_user_ID` = ? AND `tb_semester_ID` = ?");

            $stmt['8'] = $mysqli->prepare("
                DELETE grades FROM tb_subject_grade AS grades
                INNER JOIN tb_user_subject AS subjects
                ON grades.tb_user_subject_ID = subjects.ID
                WHERE subjects.tb_user_ID = ? AND subjects.tb_semester_ID = ?
            ");

            $stmt['9'] = $mysqli->prepare("DELETE FROM `tb_user_subject` WHERE `tb_user_ID` = ? AND `tb_semester_ID` = ?");

            $stmt['10'] = $mysqli->prepare("
                DELETE checks FROM tb_deadline_check AS checks
                INNER JOIN tb_deadline AS deadlines
                ON checks.tb_deadline_ID = deadlines.ID
                WHERE checks.tb_user_ID = ? AND deadlines.tb_semester_ID = ?
            ");

            for ($i = 1; $i < 11; $i++) {
                $stmt[$i]->bind_param("ss", $userid, $semester);
                $stmt[$i]->execute();
            }

        } else if($_POST['action'] == "add"){

            $error = "";

            $bkey = test_input($_POST['bkey']);
            $group = test_input($_POST['group']);

            if(strlen($bkey) != 7){
                $error = $error . "<li>".$translate[257]."</li>";
            }

            if(!$group){
                $error = $error . "<li>".$translate[258]."</li>";
            }

            $stmt = $mysqli->prepare("SELECT id, deleted FROM `tb_user` WHERE bKey = ?");
            $stmt->bind_param("s", $bkey);
            $stmt->execute();
            $result = $stmt->get_result();

            if($error){

                echo $error;

            } else {

                if($result->num_rows > 1){

                    $error = $error . "<li>".$translate[259]."</li>";
                    echo $error;

                }  else if ($result->num_rows == 1) {

                    $row = $result->fetch_assoc();

                    if($row['deleted'] == 1){


                            $stmt = $mysqli->prepare("UPDATE `tb_user` SET deleted = NULL, tb_group_id = ? WHERE bkey = ?;");
                            $stmt->bind_param("is", $group, $bkey);
                            $stmt->execute();


                    } else {

                        $error = $error . "<li>".$translate['259']."</li>";
                        echo $error;

                    }

                } else {

                        $userInfoArray = loadPerson($bkey);

                        if(isset($userInfoArray['firstname']) || isset($userInfoArray['lastname'])){

                            $stmt = $mysqli->prepare("REPLACE INTO `tb_user` (`bKey`, `tb_group_ID`, `firstname`, `lastname`, `mail`) VALUES (?, ?, ?, ?, ?);");
                            $stmt->bind_param("sssss", $bkey, $group, $userInfoArray['firstname'], $userInfoArray['lastname'], $userInfoArray['email']);

                        } else {

                            $stmt = $mysqli->prepare("REPLACE INTO `tb_user` (`bKey`, `tb_group_ID`) VALUES (?, ?);");
                            $stmt->bind_param("ss", $bkey, $group);

                        }

                        $stmt->execute();

                }

            }

        } else if($_POST['action'] == "delete"){

            $userid = test_input($_POST['userid']);

            $stmt = $mysqli->prepare("UPDATE `tb_user` SET `deleted` = 1 WHERE `tb_user`.`ID` = ?");
            $stmt->bind_param("s", $userid);
            $stmt->execute();

        } else if($_POST['action'] == "change"){

            $userid = test_input($_POST['userID']);
            $fFirstname = test_input($_POST['fFirstname']);
            $fLastname = test_input($_POST['fLastname']);
            $fGroup = test_input($_POST['fGroup']);
            $fMail = test_input($_POST['fMail']);
            $fLanguage = test_input($_POST['fLanguage']);
            $fSemester = test_input($_POST['fSemester']);

            if($fSemester != ""){
                $stmt = $mysqli->prepare("UPDATE tb_user SET firstname = ?, lastname = ?, mail = ?, tb_group_ID = ?, language = ?, tb_semester_ID = ? WHERE ID = ?");
                $rc = $stmt->bind_param("sssisii", $fFirstname, $fLastname, $fMail, $fGroup, $fLanguage, $fSemester, $userid);
            } else {
                $stmt = $mysqli->prepare("UPDATE tb_user SET firstname = ?, lastname = ?, mail = ?, tb_group_ID = ?, language = ? WHERE ID = ?");
                $rc = $stmt->bind_param("sssisi", $fFirstname, $fLastname, $fMail, $fGroup, $fLanguage, $userid);
            }


            if ( false===$stmt ) {
                die('prepare() failed: ' . htmlspecialchars($mysqli->error));
            }

            if ( false===$rc ) {
                die('bind_param() failed: ' . htmlspecialchars($stmt->error));
            }

            $rc = $stmt->execute();
            if ( false===$rc ) {
                die('execute() failed: ' . htmlspecialchars($stmt->error));
            }

            $stmt->close();

        } else {
            echo "<li>".$translate[260]."</li>";
        }
    }
?>
