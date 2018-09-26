<?php

    include("../../../includes/session.php");
    include("./../../../database/connect.php");

    if($session_usergroup == 1 || $session_usergroup == 3 || $session_usergroup == 4 || $session_usergroup == 5){

        function fetchColumn($result, $column = 0) {
            return array_column(mysqli_fetch_all($result), $column);
        }

        function averagePoints($points, $maxPoints, $rowMapper = null) {
            $rowMapper = $rowMapper == null ?  function($p) {return $p;} : $rowMapper;
            $points = array_map ($rowMapper, $points);
            $sum = array_sum($points);
            return  $sum == 0 ? null : ($sum / count($points)) / $maxPoints;
        }

        //ALS-Verhaltensziele fuer Lehrling KV
        function LKVBcalcBehavior($semesterID, $userID, $mysqli){

            $sql = "SELECT points FROM `tb_als` WHERE tb_user_ID = $userID AND tb_semester_ID = $semesterID AND performance IS NULL;";
            $points = fetchColumn($mysqli->query($sql));

            $chooseMaxPoints = "SELECT gr.ID AS groupID FROM `tb_semester` AS sem INNER JOIN tb_group AS gr ON gr.ID = sem.tb_group_ID WHERE sem.ID = $semesterID";
            $resultchoose = $mysqli->query($chooseMaxPoints);
            $rowchoose = $resultchoose->fetch_assoc();

            if($rowchoose['groupID'] == 5){
                return averagePoints($points, 72);
            } else {
                return averagePoints($points, 54);
            }

        }

        //ALS-Leistungsziele
        function LKVBcalcPerform($semesterID, $userID, $mysqli){

            $sql = "SELECT points FROM `tb_als` WHERE tb_user_ID = $userID AND tb_semester_ID = $semesterID AND performance = 1;";
            $points = fetchColumn($mysqli->query($sql));

            $chooseMaxPoints = "SELECT gr.ID AS groupID FROM `tb_semester` AS sem INNER JOIN tb_group AS gr ON gr.ID = sem.tb_group_ID WHERE sem.ID = $semesterID";
            $resultchoose = $mysqli->query($chooseMaxPoints);
            $rowchoose = $resultchoose->fetch_assoc();

            if($rowchoose['groupID'] == 5){
                return averagePoints($points, 72);
            } else {
                return averagePoints($points, 54);
            }

        }

        //ÜK
        function LKBcalcUek($semesterID, $userID, $mysqli){

            $sql = "SELECT grade FROM `tb_uek` WHERE tb_user_ID = $userID AND tb_semester_ID = $semesterID";
            $points = fetchColumn($mysqli->query($sql));
            return averagePoints($points, 1, function($grade){return ($grade-1)/5;});

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
            $gradesList = fetchColumn($mysqli->query($sql));
            $weights = fetchColumn($mysqli->query($sql), 1);
            $grades = array_map(function($grade, $weight) {return $grade * $weight;}, $gradesList, $weights);

            if(count($grades) > 0){

                $chooseMaxPoints = "SELECT weight FROM `tb_user_subject` WHERE ID = $subjectID";
                $resultchoose = $mysqli->query($chooseMaxPoints);
                $rowchoose = $resultchoose->fetch_assoc();
                $rowchoose = $rowchoose['weight'];
                $calcGrade = array_sum($grades) / array_sum($weights);

                if(!$rowchoose){
                    $out['avgSubjGrade'] = ($calcGrade * 100)/100;
                    $out['subWeight'] = 100;
                } else {
                    $out['avgSubjGrade'] = ($calcGrade * $rowchoose)/100;
                    $out['subWeight'] = $rowchoose;
                }

                return $out;

            } else {
                $out['avgSubjGrade'] = 0;
                $out['subWeight'] = 0;
                return $out;
            }
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
            return averagePoints($points, 1, function($point){return $point/84;});

        }

        //Terminmanagement
        function calculateDeadline($semesterID, $userID, $mysqli){

            $sql = "SELECT ID FROM tb_dontcountsem WHERE tb_semester_ID = $semesterID AND tb_user_ID = $userID";
            $result = $mysqli->query($sql);
            if ($result->num_rows <= 0) {

                $sql = "SELECT ID, date, tb_semester_ID FROM tb_deadline WHERE tb_semester_ID = $semesterID";
                $result = $mysqli->query($sql);

                $userCurrSem = 1;
                $sqlUserSem = "SELECT tb_semester_ID FROM tb_user WHERE ID = $userID";
                $resultUserSem = $mysqli->query($sqlUserSem);

                if (isset($resultUserSem) && $resultUserSem->num_rows > 0) {
                    $rowUserSem = $resultUserSem->fetch_assoc();
                    $userCurrSem = $rowUserSem['tb_semester_ID'];
                }
                
                $countDeadlines = 0;
                $countUserChecks = 0;

                if (isset($result) && $result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {

                        if($row['tb_semester_ID'] <= $userCurrSem){

                            $countDeadlines = $countDeadlines + 1;

                            $sql2 = "SELECT * FROM tb_deadline_check WHERE tb_deadline_ID = ".$row['ID']." AND tb_user_ID = " .$userID;
                            $result2 = $mysqli->query($sql2);
                            if (isset($result2) && $result2->num_rows > 0) {
                                $countUserChecks = $countUserChecks + 1;
                            }

                        }

                    }

                }

                if($countDeadlines > 0){
                    // LB - https://github.com/baloise/EVA/issues/173
                    $notreached = ($countDeadlines - $countUserChecks) * 0.2;
                    if ($notreached > 1) $notreached = 1;
                    return 1 - $notreached;
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

        //Leistung Informatik
        function LITcalcInformatik($semesterID, $userID, $mysqli){

            $LITmodule = calcSchool($semesterID, $userID, $mysqli, 0);
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

        //Leistung bzw Noten Schule/Module
        function calcSchool($semesterID, $userID, $mysqli, $subType){

            $sql = "SELECT ID, correctedGrade FROM `tb_user_subject` WHERE tb_user_ID = $userID AND school = $subType AND tb_semester_ID = $semesterID;";
			$result = $mysqli->query($sql);

            $countPercentage = 0;
            $countGrades = 0;

            if (isset($result) && $result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {

                    if($row['correctedGrade']){

                        $grade = $row['correctedGrade'];
                        $percentage = ($grade-1) / 5;

                    } else {

                        $subData = calculateSubject($row['ID'], $mysqli);
                        $grade = $subData['avgSubjGrade'];
                        $percentage = $subData['subWeight']/100;

                    }

                    if($grade > 0 && $percentage > 0){
                        $countPercentage = $countPercentage + $percentage;
                        $countGrades = $countGrades + $grade;
                    }

                }
            }

            if($countPercentage > 0){

                return (($countGrades / $countPercentage)-1)/5;

            } else if ($countGrades <= 0){
                return 0;
            } else {
                return (($countGrades / $countPercentage)-1)/5;
            }

        }

        //Gesamtes Semester berechnen bzw. Durchschnitt Verhalten, Schule und Leistung
        function LKVBcalculateSemester($semesterID, $userID, $mysqli){

            $coSu = 0;
            $i = 0;

            if(calcSchool($semesterID, $userID, $mysqli, 1) > 0){ $coSu = $coSu + calcSchool($semesterID, $userID, $mysqli, 1); $i = $i + 1; }
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

            if(LITcalcInformatik($semesterID, $userID, $mysqli) > 0){
                $coSu = $coSu + LITcalcInformatik($semesterID, $userID, $mysqli);
                $i = $i + 1;
            }
            if(calcSchool($semesterID, $userID, $mysqli, 1) > 0){ $coSu = $coSu + calcSchool($semesterID, $userID, $mysqli, 1); $i = $i + 1; }
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
