<?php

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    echo 'Die aktuelle PHP Version ist ' . phpversion();

?>

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

    $uploaddir = 'upload/';
    $uploadfile = $uploaddir . test_input(basename($_FILES['userfile']['name']));
    $group = test_input($_POST['group']);
    $lang = test_input($_POST['lang']);

    if(strtolower(pathinfo($uploadfile,PATHINFO_EXTENSION)) != "pdf"){
        echo "The File you uploaded doesn't end on .pdf<br/>";
        echo "Failed to transmit Data. <a onclick='window.history.back();'>Go Back</a>";
        die();
    }

    if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {

        $pathToFile = "modul/reglement/" .$uploadfile;

        $sql = "UPDATE `tb_text` SET $lang = ? WHERE `type` = 'reglement' AND `tb_group_ID` = ?;";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param('si', $pathToFile, $group);
        $stmt->execute();

        header('Location: ' . $_SERVER['HTTP_REFERER']);

    } else {

        echo "ERROR: Failed to transmit Data.";

    }

?>
