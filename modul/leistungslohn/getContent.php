<?php

    include("../../includes/session.php");
    include("./../../database/connect.php");

    if($session_usergroup == 1 || $session_usergroup == 3 || $session_usergroup == 4 || $session_usergroup == 5){

        function fetchColumn( $result, $column = 0 ) {
            return array_column(mysqli_fetch_all($result), $column);
        }

        function averagePoints( $points, $maxPoints, $rowMapper = null) {
            $rowMapper = $rowMapper == null ?  function($p) { return $p;} : $rowMapper;
            $points = array_map ($rowMapper, $points);
            $sum = array_sum($points);
            return  $sum == 0 ? null : ($sum / count($points)) / $maxPoints;
        }

        //ALS-Verhaltensziele fuer Lehrling KV
        function LKVBcalcBehavior($semesterID, $userID, $mysqli){

            $sql = "SELECT points FROM `tb_als` WHERE tb_user_ID = $userID AND tb_semester_ID = $semesterID AND performance IS NULL;";
            $points = fetchColumn($mysqli->query($sql));
            return averagePoints($points, 54);

        }

        //ÜK
        function LKBcalcUek($semesterID, $userID, $mysqli){

            $sql = "SELECT grade FROM `tb_uek` WHERE tb_user_ID = $userID AND tb_semester_ID = $semesterID";
            $points = fetchColumn($mysqli->query($sql));
            return averagePoints($points, 1, function($grade){return ($grade-1)/5;});

        }

        //ALS-Leistungsziele
        function LKVBcalcPerform($semesterID, $userID, $mysqli){

            $sql = "SELECT points FROM `tb_als` WHERE tb_user_ID = $userID AND tb_semester_ID = $semesterID AND performance = 1;";
            $points = fetchColumn($mysqli->query($sql));
            return averagePoints($points, 54);

        }

        //PE
        function LKVcalcPe($semesterID, $userID, $mysqli){

            $sql = "SELECT points FROM `tb_pe` WHERE tb_user_ID = $userID AND tb_semester_ID = $semesterID;";
            $points = fetchColumn($mysqli->query($sql));
            return averagePoints($points, 72);

        }

        //Stao
        function LKVcalcStao($semesterID, $userID, $mysqli){

            $sql = "SELECT points FROM `tb_stao` WHERE tb_user_ID = $userID AND tb_semester_ID = $semesterID;";
            $points = fetchColumn($mysqli->query($sql));
            return averagePoints($points, 100);

        }

        //Fach ausrechnen
        function calculateSubject($subjectID, $mysqli){

            $sql = "SELECT grade, weighting FROM `tb_subject_grade` WHERE tb_user_subject_ID = $subjectID";
            $grades = fetchColumn($mysqli->query($sql));
            $weights = fetchColumn($mysqli->query($sql), 1);
            return array_sum($grades) / array_sum($weights) * 100;

        }

        //Verhaltensziele
        function LITcalculateBehavior($semesterID, $userID, $mysqli){

            $sql = "SELECT points FROM `tb_behaviorgrade` WHERE tb_semester_ID = $semesterID AND tb_userLL_ID = $userID;";
            $points = fetchColumn($mysqli->query($sql));
            return averagePoints($points, 72);

        }

        //Fachvortrag
        function LITcalculatePresentation($semesterID, $userID, $mysqli){

            $sql = "SELECT points FROM `tb_presentation` WHERE tb_user_ID = $userID AND tb_semester_ID = $semesterID;";
            $points = fetchColumn($mysqli->query($sql));
            return averagePoints($points, 1, function($point){return $point/72;});

        }

        //echo LITcalculatePresentation(26, 4, $mysqli);

        //Terminmanagement
        function calculateDeadline($semesterID, $userID, $mysqli){

            $sql = "SELECT ID FROM tb_dontcountsem WHERE tb_semester_ID = $semesterID";
            $result = $mysqli->query($sql);
            if ($result->num_rows == 0) {

                $sql = "SELECT ID, date FROM tb_deadline WHERE tb_semester_ID = $semesterID";

                $result = $mysqli->query($sql);

                $passes = 0;
                $countDeadlines = 0;
                $countUserChecks = 0;
                $today = date("Y-m-d");

                if (isset($result) && $result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {

                        if($row['date'] < $today){

                            $countDeadlines = $countDeadlines + 1;

                            $sql2 = "SELECT * FROM tb_deadline_check WHERE tb_deadline_ID = ".$row['ID']." AND tb_user_ID = " .$userID;
                            $result2 = $mysqli->query($sql2);
                            if (isset($result2) && $result2->num_rows > 0) {
                                $countUserChecks = $countUserChecks + 1;
                            }

                        }

                    }

                }

                $passes = $countDeadlines - $countUserChecks;

                if($countDeadlines > 0){
                    switch ($passes) {
                        case 0:
                            return 1;
                        case 1:
                            return 0.5;
                        default :
                            return 0;
                    }
                } else {
                    return -1;
                }

            } else {
                return -1;
            }

        }

        //Verhalten Betrieb KV
        function LKVBcalculateBetriebBehave($semesterID, $userID, $mysqli){

            $LKVBbehavior = LKVBcalcBehavior($semesterID, $userID, $mysqli);
            $LKVBdeadline = calculateDeadline($semesterID, $userID, $mysqli);

            if($LKVBbehavior != 0 && $LKVBdeadline >=0){
                return ( $LKVBdeadline + $LKVBbehavior*2 )/3;
            } else if ($LKVBdeadline >=0) {
                return ($LKVBdeadline);
            } else if ($LKVBbehavior != 0) {
                return ($LKVBbehavior);
            }

        }

        //Leistung Betrieb KV
        function LKVBcalculateBetriebPerform($semesterID, $userID, $mysqli){

            $i = 0;
            $coSu = 0;

            if(LKVBcalcPerform($semesterID, $userID, $mysqli) > 0){ $coSu = $coSu + LKVBcalcPerform($semesterID, $userID, $mysqli); $i = $i + 1; }
            if(LKBcalcUek($semesterID, $userID, $mysqli) > 0){ $coSu = $coSu + LKBcalcUek($semesterID, $userID, $mysqli); $i = $i + 1; }
            if(LKVcalcPe($semesterID, $userID, $mysqli) > 0){ $coSu = $coSu + LKVcalcPe($semesterID, $userID, $mysqli); $i = $i + 1; }
            if(LKVcalcStao($semesterID, $userID, $mysqli) > 0){ $coSu = $coSu + LKVcalcStao($semesterID, $userID, $mysqli); $i = $i + 1; }

            switch ($i) {
                case 0:
                    return 0;
                    break;
                default:
                    return $coSu/$i;
            }

        }

        //Notenschnitt Informatik-Module
        function LITcalculateModule($semesterID, $userID, $mysqli){

            $sql = "SELECT ID, correctedGrade FROM `tb_user_subject` WHERE tb_user_ID = $userID AND school = 0 AND tb_semester_ID = $semesterID;";
			$result = $mysqli->query($sql);

            $countPercentage = 0;
            $countSubjects = 0;

            if (isset($result) && $result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {

                    if($row['correctedGrade']){

                        $grade = $row['correctedGrade'];
                        $percentage = ($grade-1) / 5;

                    } else {

                        $grade = calculateSubject($row['ID'], $mysqli);
                        $percentage = ($grade-1) / 5;

                    }

                    $countPercentage = $countPercentage + $percentage;
                    $countSubjects = $countSubjects + 1;

                }
            }

            if($countPercentage != 0){
                return ($countPercentage / $countSubjects);
            }

        }

        //Leistung Informatik
        function LITcalcInformatik($semesterID, $userID, $mysqli){

            $LITmodule = LITcalculateModule($semesterID, $userID, $mysqli);
            $LITpresentation = LITcalculatePresentation($semesterID, $userID, $mysqli);

            if($LITpresentation != 0 & $LITmodule != 0){
                return ( (($LITmodule/3)*2) + (($LITpresentation/3)*1) );
            } else if ($LITmodule != 0) {
                return ($LITmodule);
            } else if ($LITpresentation != 0) {
                return ($LITpresentation);
            }

        }

        //Verhalten Betrieb
        function LITcalcBetieb($semesterID, $userID, $mysqli){

            $LITbehavior = LITcalculateBehavior($semesterID, $userID, $mysqli);
            $LITdeadline = calculateDeadline($semesterID, $userID, $mysqli);

            if($LITbehavior > 0 && $LITdeadline >= 0){
                return ((($LITdeadline)) + (($LITbehavior)*2))/3;
            } else if ($LITdeadline >= 0) {
                return ($LITdeadline);
            } else if ($LITbehavior != 0) {
                return ($LITbehavior);
            }

        }

        //Leistung Schule
        function calcSchool($semesterID, $userID, $mysqli){

            $sql = "SELECT ID, correctedGrade FROM `tb_user_subject` WHERE tb_user_ID = $userID AND school = 1 AND tb_semester_ID = $semesterID;";
			      $result = $mysqli->query($sql);

            $countPercentage = 0;
            $countSubjects = 0;

            if (isset($result) && $result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {

                    if($row['correctedGrade']){

                        $grade = $row['correctedGrade'];
                        $percentage = ($grade-1) / 5;

                    } else {

                        $grade = calculateSubject($row['ID'], $mysqli);
                        $percentage = ($grade-1) / 5;

                    }

                    $countPercentage = $countPercentage + $percentage;
                    $countSubjects = $countSubjects + 1;

                }
            }

            if($countPercentage > 0){
                return ($countPercentage / $countSubjects);
            } else if ($countSubjects == 0){
                return 0;
            } else {
                return ($countPercentage / $countSubjects);
            }

        }

        //Gesamtes Semester berechnen bzw. Durchschnitt Verhalten, Schule und Leistung
        function LKVBcalculateSemester($semesterID, $userID, $mysqli){

            $coSu = 0;
            $i = 0;

            if(calcSchool($semesterID, $userID, $mysqli) > 0){ $coSu = $coSu + calcSchool($semesterID, $userID, $mysqli); $i = $i + 1; }
            if(LKVBcalculateBetriebPerform($semesterID, $userID, $mysqli) > 0){ $coSu = $coSu + LKVBcalculateBetriebPerform($semesterID, $userID, $mysqli); $i = $i + 1; }
            if(LKVBcalculateBetriebBehave($semesterID, $userID, $mysqli) > 0){ $coSu = $coSu + LKVBcalculateBetriebBehave($semesterID, $userID, $mysqli); $i = $i + 1; }

            switch ($i) {
                case 0:
                    return 0;
                    break;
                default:
                    return $coSu/$i;
            }

        }

        //Gesamtes Semester berechnen bzw. Durchschnitt Verhalten, Schule und Informatik
        function LITcalculateSemester($semesterID, $userID, $mysqli){

            $coSu = 0;
            $i = 0;

            if(LITcalcInformatik($semesterID, $userID, $mysqli) > 0){ $coSu = $coSu + LITcalcInformatik($semesterID, $userID, $mysqli); $i = $i + 1; }
            if(calcSchool($semesterID, $userID, $mysqli) > 0){ $coSu = $coSu + calcSchool($semesterID, $userID, $mysqli); $i = $i + 1; }
            if(LITcalcBetieb($semesterID, $userID, $mysqli) > 0){ $coSu = $coSu + LITcalcBetieb($semesterID, $userID, $mysqli); $i = $i + 1; }

            switch ($i) {
                case 0:
                    return 0;
                    break;
                default:
                    return $coSu/$i;
            }

        }


    } else {
        echo "Keine Berechtigungen auf die Funktion.";
    }

?>
