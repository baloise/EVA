<?php

    header('Content-Type: text/xml; utf-8');
    header("Content-Disposition: attachment; filename=evaGrades.xml");
    header("Pragma: no-cache");
    header("Expires: 0");

    include("./../../../database/connect.php");
    include("./../../../includes/session.php");

    $handle = fopen("php://output", "w");


    $sql1 = "SELECT us.*, ss.ID AS subSemId, ss.semester AS subSemName FROM `tb_user_subject` AS us
        INNER JOIN tb_semester AS ss ON ss.ID = us.tb_semester_ID
        WHERE us.tb_user_ID = $session_userid
        ORDER BY ss.semester ASC, us.`creationDate` DESC";
    $result = $mysqli->query($sql1);

    $currentSems = "";

    if (isset($result) && $result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {

            if($row['subSemName'] != $currentSems){
                if($currentSems != ""){
                    echo "</semester>";
                    echo "<semester name='".$row['subSemName']."'>";
                    $currentSems = $row['subSemName'];
                } else {
                    echo "<semester name='".$row['subSemName']."'>";
                    $currentSems = $row['subSemName'];
                }

            }

            echo "<subject name='".$row['subjectName']."' semester='".$row['subSemId']."'>";

            $sql2 = "SELECT * FROM `tb_subject_grade` WHERE tb_user_subject_ID = ". $row['ID'];
            $result2 = $mysqli->query($sql2);

            if (isset($result2) && $result->num_rows > 0) {
                while($row2 = $result2->fetch_assoc()) {
                    echo "<grade id='".$row2['ID']."'>";

                    echo "<title>".$row2['title']."</title>";
                    echo "<score>".$row2['grade']."</score>";
                    echo "<weight>".$row2['weighting']."</weight>";

                    echo "</grade>";
                }
            }


            echo "</subject>";

        }

        echo "</semester>";

    }

?>
