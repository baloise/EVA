<?php

    header('Content-Type: text/csv; utf-8');
    header("Content-Disposition: attachment; filename=leistungslöhne.csv");
    header("Pragma: no-cache");
    header("Expires: 0");

    include("createContent.php");
    include("./../../../database/partner.php");
    include("./../../../includes/session.php");

    $handle = fopen("php://output", "w");
    $csvHeaders = array("Benutzer_ID", "Lohnzyklus", "effektiver_Lohn", "relevantes_Resultat", "Total_Leistung_Betrieb", "Total_Leistung_Schule", "Total_Verhalten_Betrieb","Malus_Verhalten", "B-Key", "Vorname", "Nachname", "Strasse", "Ort", "E-Mail", "Anrede");
    fputcsv($handle, $csvHeaders, ";");

    $i = 0;

    foreach ($_POST['userArray'] as $user) {

        $salaryInfo = "";
        $userInfo = "";

        $_POST['cycleID'] = $user[2];
        $_POST['userID'] = $user[1];
        $_POST['forCSV'] = true;

        $salaryInfo = doCreateContent();
        $userInfo = loadPerson($user[0]);

        $i += 1;

        if(is_array($salaryInfo) && is_array($userInfo)){
            $userInfos = array_merge($salaryInfo, $userInfo);
            fputcsv($handle, $userInfos, ";");
        }

    }

?>
