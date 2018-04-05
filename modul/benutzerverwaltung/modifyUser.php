<?php

    include("../../includes/session.php");
    include("./../../database/connect.php");
    include("./../../database/partner.php");

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    if($session_usergroup != 1){
        die("Sie haben keine Berechtigungen zu diesem Modul");
    }

    if(isset($_POST['action'])){

        if($_POST['action'] == "add"){

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

            $userid = test_input($_POST['userid']);
            $content = test_input($_POST['content']);

            if($_POST['fType'] == 1){

                $stmt = $mysqli->prepare("UPDATE `tb_user` SET `tb_group_ID` = ? WHERE `tb_user`.`ID` = ?");
                $stmt->bind_param("ss", $content, $userid);

            }

            if ($_POST['fType'] == 2){

                $stmt = $mysqli->prepare("UPDATE `tb_user` SET `firstname` = ? WHERE `tb_user`.`ID` = ?");
                $stmt->bind_param("ss", $content, $userid);

            }

            if ($_POST['fType'] == 3){

                $stmt = $mysqli->prepare("UPDATE `tb_user` SET `lastname` = ? WHERE `tb_user`.`ID` = ?");
                $stmt->bind_param("ss", $content, $userid);

            }

            if ($_POST['fType'] == 4){

                $stmt = $mysqli->prepare("UPDATE `tb_user` SET `mail` = ? WHERE `tb_user`.`ID` = ?");
                $stmt->bind_param("ss", $content, $userid);

            }

            $stmt->execute();
            $stmt->close();
            $mysqli->close();

        } else {
            echo "<li>".$translate[260]."</li>";
        }
    }
?>
