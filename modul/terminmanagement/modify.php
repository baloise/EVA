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
            $sql = "";

            if($_POST['fType'] == 1){

                $sql = "UPDATE `tb_deadline` SET `title_".$_POST['lang']."` = ? WHERE ID = ?";

            }

            if ($_POST['fType'] == 2){

                $sql = "UPDATE `tb_deadline` SET `description_".$_POST['lang']."` = ? WHERE ID = ?";

            }

            if ($_POST['fType'] == 3){

                $sql = "UPDATE `tb_deadline` SET `date` = ? WHERE ID = ?";

            }

            if ($_POST['fType'] == 4){

                $sql = "UPDATE `tb_deadline` SET `tb_semester_ID` = ? WHERE ID = ?";

            }

            $stmt = $mysqli->prepare($sql);
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

            $title_de = test_input($_POST['title_de']);
            $title_fr = test_input($_POST['title_fr']);
            $title_it = test_input($_POST['title_it']);

            $description_de = test_input($_POST['description_de']);
            $description_fr = test_input($_POST['description_fr']);
            $description_it = test_input($_POST['description_it']);

            $deadline = test_input($_POST['deadline']);
            $semester = test_input($_POST['semester']);
            $error = "";

            if(!$deadline){
                $error = $error . "Bitte Deadline angeben. <br/>";
            }

            if(!$semester){
                $error = $error . "Bitte Semester angeben. <br/>";
            }

            if($error){
                echo $error;
            } else {

                $stmt = $mysqli->prepare("INSERT INTO `tb_deadline` (`title_de`, `title_fr`, `title_it`, `description_de`, `description_fr`, `description_it`, `date`, `tb_semester_ID`) VALUES (?, ?, ?, ?, ?, ?, ?, ?);");
                $stmt->bind_param("sssssssi", $title_de, $title_fr, $title_it, $description_de, $description_fr, $description_it, $deadline, $semester);
                $stmt->execute();

            }


        } else if($_POST['todo'] == "deleteDid"){

            $did = test_input($_POST['did']);

            if($did){


                $stmt = $mysqli->prepare("DELETE FROM `tb_deadline_check` WHERE `tb_deadline_ID` = ?");
                $stmt->bind_param("i", $did);
                $stmt->execute();

                $stmt = $mysqli->prepare("DELETE FROM `tb_deadline` WHERE `ID` = ?");
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
