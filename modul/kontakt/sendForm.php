<?php

    include('../../includes/testInput.php');

    if (file_exists("../../database/connect.php")) {
        include("../../database/connect.php");
    } else if (file_exists("database/connect.php")){
        include("database/connect.php");
    }

    $fname = test_input($_POST['fname']);
    $lname = test_input($_POST['lname']);
    $email = test_input($_POST['email']);
    $subj = test_input($_POST['subj']);
    $message = test_input($_POST['message']);

    $sql = "SELECT mail_support, mail_hr, title FROM `tb_appinfo`";
    $result = $mysqli->query($sql);

    $subject = "New Message";
    $receiver = "";

    if (isset($result) && $result->num_rows == 1) {

        $row = $result->fetch_assoc();

        if($subj == "generalhr"){
            $receiver = $row['mail_hr'];
            $subject = "General Request from " . $row['title'];
        } else if ($subj == "generalit"){
            $receiver = $row['mail_support'];
            $subject = "General Request from " . $row['title'];
        } else if ($subj == "suggest"){
            $receiver = $row['mail_support'];
            $subject = "New Suggestion for " . $row['title'];
        } else if ($subj == "feedback"){
            $receiver = $row['mail_support'] .", ". $row['mail_hr'];
            $subject = "New Feedback for " . $row['title'];
        } else if ($subj == "support"){
            $receiver = $row['mail_support'];
            $subject = "Product-Support Request from " . $row['title'];
        } else if ($subj == "error"){
            $receiver = $row['mail_support'] .", ". $row['mail_hr'];
            $subject = "Error Report from " . $row['title'];
        }


    }

    $header = 'From: ' . $email . "\r\n" .
        'Reply-To: ' . $email . "\r\n" .
        'X-Mailer: PHP/' . phpversion();

    $message = $message . "\r\n \r\n" . "FROM: ". $fname . " " . $lname;

    mail($receiver, $subject, $message, $header);

?>
