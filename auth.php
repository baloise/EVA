<?php

    session_start();
    session_regenerate_id();

    ini_set('display_errors', 1);

	if (empty($_GET['loginType'])) {

		header('Location: login.php?error=noType');

	} else {

        $username = "";

        if($_GET['loginType'] == "medusa"){

            $decoded = explode(";", file_get_contents('compress.zlib://data:who/cares;base64,'. $_COOKIE["MedusaToken"] ));
            $username = (explode("=", $decoded[0])[1]);

        } else {

            $username = $_POST['username'];
            $pass = "TODO";

        }

        include("database/connect.php");

        $sql = "SELECT tb_group_id, deleted, id, language, tb_semester_ID FROM tb_user WHERE bKey = '$username'";
        $result = $mysqli->query($sql);

        if ($result->num_rows == 1) {

            $row = $result->fetch_assoc();

            if($row['deleted'] == 1){
                 header("Location: login.php?error=userDeleted");
            } else {

                $_SESSION['user']['usergroup'] = $row['tb_group_id'];
                $_SESSION['user']['id'] = $row['id'];
                $_SESSION['user']['username'] = $username;
                $_SESSION['user']['semester'] = $row['tb_semester_ID'];

                if(isset($row['language'])){
                    $_SESSION['user']['language'] = $row['language'];
                } else {
                    $_SESSION['user']['language'] = "de";
                }

                $translations = array();

                $sql2 = "SELECT id, de, " . $_SESSION['user']['language'] . " FROM tb_translation";
                $result2 = $mysqli->query($sql2);

                if ($result2->num_rows > 0) {
                    while($row2 = $result2->fetch_assoc()) {

                        if(isset($row2[$_SESSION['user']['language']]) && !$row2[$_SESSION['user']['language']] == ""){
                            $content = str_replace("'", "\'", $row2[$_SESSION['user']['language']]);
                            $translations += [$row2['id'] => $content];
                        } else {
                            $translations += [$row2['id'] => $row2['de']];
                        }

                    }
                }

                $_SESSION['translations'] = $translations;

                $sql = "SELECT * FROM `tb_appinfo`;";
                $result = $mysqli->query($sql);

                if (isset($result) && $result->num_rows == 1) {
                    $appinfo = $result->fetch_assoc();
                }

                $updateLoginStamp = "UPDATE `tb_user` SET lastLogin=now() WHERE ID = ". $row['id'].";";
                $mysqli->query($updateLoginStamp);

                $_SESSION['appinfo'] = $appinfo;

                if(isset($_GET['redirect'])){
                    header("Location: index.php?page=".$_GET['redirect']);
                } else {
                    header("Location: index.php");
                }

            }

        } else {

            header("Location: login.php?error=userNotFound");

        }
    }

?>
