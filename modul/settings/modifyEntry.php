<?php

    include("../../includes/session.php");
    include("../../database/connect.php");

    if($session_usergroup != 1 && $session_usergroup != 2 && $session_usergroup != 3 && $session_usergroup != 4 && $session_usergroup != 5){
        die("Sie haben keine Berechtigungen zu diesem Modul");
    }

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    if(isset($_POST['doEntry'])) {

        if($_POST['doEntry'] == "changeLang"){

            $newLang = test_input($_POST['newLang']);

            $stmt = $mysqli->prepare("UPDATE `tb_user` SET `language` = ? WHERE `tb_user`.`ID` = ? AND `tb_user`.`tb_group_ID` = ?;");
            $stmt->bind_param('sii', $newLang, $session_userid, $session_usergroup);
            $stmt->execute();

        }

        if($_POST['doEntry'] == "changeColor"){

            $stmt = $mysqli->prepare("REPLACE INTO `tb_ind_design` VALUES ('NULL', ?, ?, ?, ?, ?);");

            if ( false===$stmt ) {
                die('prepare() failed: ' . htmlspecialchars($mysqli->error));
            }

            $akzentfarbe = test_input($_POST['akzentfarbe']);
            $hintergrund = test_input($_POST['hintergrund']);
            $link = test_input($_POST['link']);
            $schrift = test_input($_POST['schrift']);

            $rc = $stmt->bind_param('ssssi', $akzentfarbe, $hintergrund, $link, $schrift,$session_userid);
            if ( false===$rc ) {
                die('bind_param() failed: ' . htmlspecialchars($stmt->error));
            }

            $rc = $stmt->execute();
            if ( false===$rc ) {
                die('execute() failed: ' . htmlspecialchars($stmt->error));
            }

        }

        if($_POST['doEntry'] == "deleteColor"){

            $stmt = $mysqli->prepare("DELETE FROM `tb_ind_design` WHERE tb_user_ID = ?");
            $stmt->bind_param('i', $session_userid);
            $stmt->execute();

        }

        if($_POST['doEntry'] == "delete"){

            $navItemId = test_input($_POST['navItemID']);

            $stmt = $mysqli->prepare("DELETE FROM `tb_ind_nav` WHERE ID = ?");
            $stmt->bind_param('s', $navItemId);
            $stmt->execute();

        }

        if($_POST['doEntry'] == "add"){

            $userID = test_input($_POST['userID']);
            $navItemId = test_input($_POST['navItemID']);

            $stmt = $mysqli->prepare("INSERT INTO `tb_ind_nav` (`tb_user_ID`, `tb_modul_ID`) VALUES (?, ?);");
            $stmt->bind_param('ss', $userID, $navItemId);
            $stmt->execute();

            $stmt = $mysqli->prepare("SELECT indnav.ID, modu.title, modu.file_path FROM `tb_ind_nav` AS indnav
                                INNER JOIN tb_modul AS modu ON modu.ID = indnav.tb_modul_ID
                                WHERE indnav.tb_user_ID = ? ORDER BY ID DESC LIMIT 1;");
            $stmt->bind_param('i', $session_userid);
            $stmt->execute();

            $result = $stmt->get_result();
            while ($row = $result->fetch_array(MYSQLI_NUM)){
                $naventry = '<li style="display: none;" class="nav-item"><a class="nav-link" navlinkid="'. $row[0] .'" href="'.$row[2].'">'. $translate[$row[1]] .'</a></li>';
                echo $naventry;
            }

        }

    }

?>
