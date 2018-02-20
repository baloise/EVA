<?php

    include("../session/session.php");
    include("../../database/connect.php");

    if($session_usergroup != 1 && $session_usergroup != 2 && $session_usergroup != 3 && $session_usergroup != 4 && $session_usergroup != 5){
        die("Sie haben keine Berechtigungen zu diesem Modul");
    }

    if(isset($_POST['doEntry'])) {

        if($_POST['doEntry'] == "changeLang"){

            $stmt = $mysqli->prepare("UPDATE `tb_user` SET `language` = ? WHERE `tb_user`.`ID` = ? AND `tb_user`.`tb_group_ID` = ?;");
            $stmt->bind_param('sii', $_POST['newLang'], $session_userid, $session_usergroup);
            $stmt->execute();

        }

        if($_POST['doEntry'] == "delete"){

            $stmt = $mysqli->prepare("DELETE FROM `tb_ind_nav` WHERE ID = ?");
            $stmt->bind_param('s', $_POST['navItemID']);
            $stmt->execute();

        }

        if($_POST['doEntry'] == "add"){

            $stmt = $mysqli->prepare("INSERT INTO `tb_ind_nav` (`tb_user_ID`, `tb_modul_ID`) VALUES (?, ?);");
            $stmt->bind_param('ss', $_POST['userID'], $_POST['navItemID']);
            $stmt->execute();

            $stmt = $mysqli->prepare("SELECT indnav.ID, modu.title, modu.file_path FROM `tb_ind_nav` AS indnav
                                INNER JOIN tb_modul AS modu ON modu.ID = indnav.tb_modul_ID
                                WHERE indnav.tb_user_ID = ? ORDER BY ID DESC LIMIT 1;");
            $stmt->bind_param('i', $session_userid);
            $stmt->execute();

            $result = $stmt->get_result();
            while ($row = $result->fetch_array(MYSQLI_NUM)){
                $naventry = '<li style="display: none;" class="nav-item"><a class="nav-link" navlinkid="'. $row[0] .'" href="'.$row[2].'">'. $row[1] .'</a></li>';
                echo $naventry;
            }

        }

    }

?>
