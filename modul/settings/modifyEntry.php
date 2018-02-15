<?php

    include("../session/session.php");
    include("../../database/connect.php");
    
    if(isset($_POST['doEntry']) && isset($_POST['navItemID'])) {
        
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