<?php

    header('Content-Type: text/csv; utf-8');
    header("Content-Disposition: attachment; filename=Eva-Generated Salarys.csv");
    header("Pragma: no-cache");
    header("Expires: 0");

    include("createContent.php");
    include("./../../../database/partner.php");
    include("./../../../database/connect.php");
    include("./../../../includes/session.php");

    $handle = fopen("php://output", "w");
    $csvHeaders = array("F_UserID", "F_Lohnzyklus", "F_Lohn", "F_RelResultat", "F_TotalBetrieb", "F_TotalSchule", "F_TotalVerhalten","F_TotalMalus", "F_bKey", "F_Vorname", "F_Nachname", "F_Strasse", "F_Ort", "F_eMail", "F_Anrede");
    fputcsv($handle, $csvHeaders, ";");

    $i = 0;

    if($session_usergroup != 1){
        echo "Ihrem Account fehlen die Berechtigungen für diese Aktion. <br/>";
        die();
    }

    foreach ($_POST['userArray'] as $user) {

        $salaryInfo = "";
        $userInfo = "";

        $_POST['cycleID'] = $user[2];
        $_POST['userID'] = $user[1];
        $_POST['forCSV'] = true;

        $salaryInfo = doCreateContent();
        $userInfo = loadPerson($user[0]);

        $sql = "SELECT language FROM `tb_user` WHERE ID = " . $_POST['userID'];
        $result = $mysqli->query($sql);
        if (isset($result) && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if($row['language'] == "it"){
                if($userInfo['gender'] == 2){
                    $userInfo['gender'] = "Signora";
                } else {
                    $userInfo['gender'] = "Signor";
                }
            } else if($row['language'] == "fr"){
                if($userInfo['gender'] == 2){
                    $userInfo['gender'] = "Madame";
                } else {
                    $userInfo['gender'] = "Monsieur";
                }
            } else {
                if($userInfo['gender'] == 2){
                    $userInfo['gender'] = "Frau";
                } else {
                    $userInfo['gender'] = "Herr";
                }
            }
        }

        $i += 1;

        if(is_array($salaryInfo) && is_array($userInfo)){
            $userInfos = array_merge($salaryInfo, $userInfo);
            fputcsv($handle, $userInfos, ";");
        }

    }

?>
