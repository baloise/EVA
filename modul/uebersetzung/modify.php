<?php

    include("../../includes/session.php");
    include("../../database/connect.php");

    if($session_usergroup != 1){
        die("Sie haben keine Berechtigungen zu diesem Modul");
    }

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    if(isset($_POST['toDo'])) {

        if($_POST['toDo'] == "changeTra"){

            $entryID = test_input($_POST['entryID']);
            $entryGer = test_input($_POST['entryGer']);
            $entryIta = test_input($_POST['entryIta']);
            $entryFra = test_input($_POST['entryFra']);

            if(isset($entryID)){

                $stmt = $mysqli->prepare("UPDATE `tb_translation` SET `de` = ?, `it` = ?, `fr` = ? WHERE `tb_translation`.`ID` = ?;");
                $stmt->bind_param('sssi', $entryGer, $entryIta, $entryFra, $entryID);
                $stmt->execute();

            } else {
                echo "ERROR";
            }

        }

    }

?>
