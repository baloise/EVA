<?php

    header('Content-Type: text/json; utf-8');
    //header("Content-Disposition: attachment; filename=evaGrades.json");
    //header("Pragma: no-cache");
    //header("Expires: 0");

    include("./../../../database/connect.php");
    include("./../../../includes/session.php");

    //$handle = fopen("php://output", "w");


    $sql1 = "SELECT us.*, ss.ID AS subSemId, ss.semester AS subSemName FROM `tb_user_subject` AS us
        INNER JOIN tb_semester AS ss ON ss.ID = us.tb_semester_ID
        WHERE us.tb_user_ID = $session_userid
        ORDER BY ss.semester DESC, us.`creationDate` DESC";
    $result = $mysqli->query($sql1);

    $currentSems = "";
    $retEcho = "";

    if (isset($result) && $result->num_rows > 0) {

        $retEcho.= '{
    "Title": "Eva Grades List Export",
    "Date": "'.date('d.m.Y H:i:s').'",
    "Entries": [';

        while($row = $result->fetch_assoc()) {

            if($row['subSemName'] != $currentSems){
                if($currentSems != ""){
                    $retEcho.= '
        ]
    },';
    $retEcho.= '
    {
        "Semester": "'.$row['subSemName'].'",
        "Semester ID": "'.$row['subSemId'].'",
        "Subjects": [';
                    $currentSems = $row['subSemName'];
                } else {
                    $retEcho.= '
    {
        "Semester": "'.$row['subSemName'].'",
        "Semester ID": "'.$row['subSemId'].'",
        "Subjects": [';
                    $currentSems = $row['subSemName'];
                }

            } else {
                $retEcho.= ',';
            }

            $retEcho.= '
        {
            "Subject Name": "'.$row['subjectName'].'",
            "Subject ID": "'.$row['ID'].'",
            "Grades": [';

            $sql2 = "SELECT * FROM `tb_subject_grade` WHERE tb_user_subject_ID = ". $row['ID'];
            $result2 = $mysqli->query($sql2);

            if (isset($result2) && $result2->num_rows > 0) {

                $i = 0;

                while($row2 = $result2->fetch_assoc()) {

                    $retEcho.= '
            {
                "GradeID": "'.$row2['ID'].'",
                "Title": "'.$row2['title'].'",
                "Score": "'.$row2['grade'].'",
                "Weight": "'.$row2['weighting'].'"
            }';

                    $i++;

                    if($i < $result2->num_rows){
                        $retEcho.= ',';
                    }

                }
            }


            $retEcho.= "
            ]
        }";

        }

        $retEcho.= "
        ]
    }";

    $retEcho.= "
    ]
}";

    }

    echo $retEcho;

?>
