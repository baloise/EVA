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

        if($_POST['todo'] == "getSemester"){

            $selUser = test_input($_POST['selUser']);

            $stmt = $mysqli->prepare("SELECT se.ID, se.semester FROM `tb_user` AS us
                                        INNER JOIN tb_group AS gr ON us.tb_group_ID = gr.ID
                                        INNER JOIN tb_semester AS se ON se.tb_group_ID = gr.ID
                                        WHERE us.ID = ?;");
            $stmt->bind_param("i", $selUser);
            $stmt->execute();

            $result = $stmt->get_result();
            while ($row = $result->fetch_array(MYSQLI_NUM)){
                echo "<option value='". $row[0] ."'>". $row[1] ."</option>";
            }

        } else if($_POST['todo'] == "addEntry"){

            $error = "";

            $fselUser = test_input($_POST['fselUser']);
            $fweigth = test_input($_POST['fweigth']);
            $freasoning = test_input($_POST['freasoning']);
            $semester = test_input($_POST['fselsem']);

            if(!isset($semester)){
                $error = $error . "Kein Semester Angegeben.<br/>";
            }

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

                $stmt = $mysqli->prepare("INSERT INTO `tb_malus` (`description`, `tb_user_ID`, `weight`, `tb_semester_ID`) VALUES (?, ?, ?, ?);");
                $stmt->bind_param("siii", $freasoning, $fselUser, $fweigth, $semester);
                $stmt->execute();

                //SENDMAIL
                include("../../modul/mail/generateMail.php");
                $subject = "Neuer Malus hinzugefügt";
                $message = "
                Du hast einen Malus erhalten! Dieser wird ab sofort
                in der Lohnberechnung berücksichtigt und ist unter 'Leistungslohn'
                ersichtlich.<br/><br/>
                Malus-Gewichtung: <b>$fweigth</b> %<br/>
                Begründung:<br/>$freasoning<br/>
                ";
                sendMail($subject, $message, $fselUser, $session_appinfo, $mysqli);

            }

        } else if($_POST['todo'] == "deleteEntry"){

            $error = "";
            $fentryId = test_input($_POST['fentryId']);
            $fselUser = test_input($_POST['$fselUser']);

            if(!isset($fentryId)){
                $error = $error . "Kein Eintrag angegeben.<br/>";
            }

            if($error){
                echo $error;
            } else {

                $stmt = $mysqli->prepare("DELETE FROM `tb_malus` WHERE `tb_malus`.`ID` = ?");
                $stmt->bind_param("i", $fentryId);
                $stmt->execute();

                //SENDMAIL
                include("../../modul/mail/generateMail.php");
                $subject = "Malus gelöscht";
                $message = "
                Ein Malus wurde aus deinem Profil entfernt und entsprechend in der Lohnberechnung angepasst.
                ";
                sendMail($subject, $message, $fselUser, $session_appinfo, $mysqli);

            }

        } else {
            echo "Unbekannter Befehl: " . $_POST['todo'];
        }

    }

?>
