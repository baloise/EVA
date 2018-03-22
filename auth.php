<?php

    session_start();
    session_regenerate_id();

	if (empty($_SESSION['user'])) {

		header('Location: login.php?error=user');

	} else {

        $username = $_SESSION['user']['username'];

        include("database/connect.php");

        $sql = "SELECT tb_group_id, deleted, id, language, tb_semester_ID FROM tb_user WHERE bKey = '$username'";
        $result = $mysqli->query($sql);

        if ($result->num_rows == 1) {

            $row = $result->fetch_assoc();

            if($row['deleted'] == 1){
                 header("Location: login.php?error=userdeleted");
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

                $_SESSION['appinfo'] = $appinfo;

                header("Location: index.php");
            }

        } else {
            header("Location: login.php?error=user");
        }
    }

?>
