<?php

    include("../../../includes/session.php");

    if($session_usergroup == 1 || $session_usergroup == 3 || $session_usergroup == 4 || $session_usergroup == 5){

        include("getContent.php");
        include("calcCycles.php");

        //Cycles and Calculations
        function doCreateContent() {

            include("../../../includes/session.php");
            include("./../../../database/connect.php");

            if($session_usergroup == 1){
                $userID = $_POST['userID'];
            } else {
                $userID = $session_userid;
            }

            // --------------------------------- CYCLE IT 1 ------------------------------------------
            if($_POST['cycleID'] == 1){

                $sql = "SELECT sem.* FROM `tb_semester` as sem INNER JOIN tb_user as us ON us.tb_group_ID = sem.tb_group_ID WHERE us.ID = $userID LIMIT 4";
                $result = $mysqli->query($sql);

                $semesterList = "";

                $semesterCountSemester = 0;
                $semesterCountSchool = 0;
                $semesterCountBetrieb = 0;
                $semesterCountInformatik = 0;

                $cycleTotalPercent = 0;
                $cycleTotalItPercent = 0;
                $cycleTotalSchoolPercent = 0;
                $cycleTotalBetriebPercent = 0;
                $cycleTotalMalus = 0;
                $actualSalary = 0;

                if (isset($result) && $result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {

                        $malus = 0;

                        $malusSql = "SELECT weight FROM `tb_malus` WHERE tb_semester_ID = ".$row["ID"]." AND tb_user_ID = $userID;";
                        $malusResult = $mysqli->query($malusSql);
                        if (isset($malusResult) && $malusResult->num_rows > 0) {
                            while($malusRow = $malusResult->fetch_assoc()) {
                                $malus = $malus + $malusRow["weight"];
                            }
                        }

                        if(isset($malus)){
                            $cycleTotalMalus += $malus;
                        }

                        $semesterList = $semesterList . generateSemesterIT($row['ID'], $row['semester'], $userID, $mysqli, $translate, $malus);

                        if(LITcalculateSemester($row['ID'], $userID, $mysqli) != 0){
                            $cycleTotalPercent = ($cycleTotalPercent + LITcalculateSemester($row['ID'], $userID, $mysqli)) - ($malus/100);
                            $semesterCountSemester = $semesterCountSemester + 1;
                        }

                        if(LITcalcInformatik($row['ID'], $userID, $mysqli) != 0){
                            $cycleTotalItPercent = $cycleTotalItPercent + LITcalcInformatik($row['ID'], $userID, $mysqli);
                            $semesterCountInformatik = $semesterCountInformatik + 1;
                        }

                        if(calcSchool($row['ID'], $userID, $mysqli) != 0){
                            $cycleTotalSchoolPercent = $cycleTotalSchoolPercent + calcSchool($row['ID'], $userID, $mysqli);
                            $semesterCountSchool = $semesterCountSchool + 1;
                        }

                        if(LITcalcBetieb($row['ID'], $userID, $mysqli) != 0){
                            $cycleTotalBetriebPercent = $cycleTotalBetriebPercent + LITcalcBetieb($row['ID'], $userID, $mysqli);
                            $semesterCountBetrieb = $semesterCountBetrieb + 1;
                        }

                    }
                }

                $cycleTotalItPercentAverage = calcNeededAverages($semesterCountInformatik, $cycleTotalItPercent);
                $cycleTotalSchoolPercentAverage = calcNeededAverages($semesterCountSchool, $cycleTotalSchoolPercent);
                $cycleTotalBetriebPercentAverage = calcNeededAverages($semesterCountBetrieb, $cycleTotalBetriebPercent);
                $cycleTotalPercentAverage = calcNeededAverages($semesterCountSemester, $cycleTotalPercent);

                $actualSalary = calcActualSalary($cycleTotalPercentAverage, $_POST['cycleID']);

                if(isset($_POST['forCSV']) && $_POST['forCSV'] == true){

                    $translateCycle = "kommenden Semester";

                    switch ($_POST['cycleID']) {
                        case 1:
                            $translateCycle = "5 & 6";
                            break;
                        case 2:
                            $translateCycle = "7";
                            break;
                        case 3:
                            $translateCycle = "8";
                            break;
                        case 4:
                            $translateCycle = "5";
                            break;
                        case 5:
                            $translateCycle = "6";
                            break;
                    }

                    $cvsValues = array(
                        "UserID" => $userID,
                        "Cycle" => $translateCycle,
                        "Salary" => $actualSalary,
                        "TotalPercent" => round($cycleTotalPercentAverage, 2),
                        "TotalIT" => round($cycleTotalItPercentAverage, 2),
                        "TotalSchool" => round($cycleTotalSchoolPercentAverage, 2),
                        "TotalBetrieb" => round($cycleTotalBetriebPercentAverage, 2),
                        "TotalMalus" => $cycleTotalMalus
                    );
                    return $cvsValues;
                } else {
                    echo generateEntryIT($actualSalary, $cycleTotalPercentAverage, $cycleTotalItPercentAverage, $cycleTotalSchoolPercentAverage, $cycleTotalBetriebPercentAverage, $semesterList, $translate);
                }

            }

            // --------------------------------- CYCLE IT 2&3 ------------------------------------------

            if($_POST['cycleID'] == 2){

                $sql1 = "SELECT sem.* FROM `tb_semester` as sem INNER JOIN tb_user as us ON us.tb_group_ID = sem.tb_group_ID WHERE us.ID = $userID LIMIT 4";
                $sql2 = "SELECT sem.* FROM `tb_semester` as sem INNER JOIN tb_user as us ON us.tb_group_ID = sem.tb_group_ID WHERE us.ID = $userID LIMIT 4, 2";
                return cycleContentIT($mysqli, $sql1, $sql2, $userID, $translate);

            }

            if($_POST['cycleID'] == 3){

                $sql1 = "SELECT sem.* FROM `tb_semester` as sem INNER JOIN tb_user as us ON us.tb_group_ID = sem.tb_group_ID WHERE us.ID = $userID LIMIT 4, 2";
                $sql2 = "SELECT sem.* FROM `tb_semester` as sem INNER JOIN tb_user as us ON us.tb_group_ID = sem.tb_group_ID WHERE us.ID = $userID LIMIT 6, 1";
                return cycleContentIT($mysqli, $sql1, $sql2, $userID, $translate);

            }

            // --------------------------------- CYCLE KV 4&5 ------------------------------------------
            if($_POST['cycleID'] == 4 || $_POST['cycleID'] == 5){

                if($_POST['cycleID'] == 4){
                    $sql = "SELECT sem.* FROM `tb_semester` as sem INNER JOIN tb_user as us ON us.tb_group_ID = sem.tb_group_ID WHERE us.ID = $userID LIMIT 4";
                } else if ($_POST['cycleID'] == 5){
                    $sql = "SELECT sem.* FROM `tb_semester` as sem INNER JOIN tb_user as us ON us.tb_group_ID = sem.tb_group_ID WHERE us.ID = $userID LIMIT 5";
                }

                $result = $mysqli->query($sql);

                $semesterList = "";

                $semesterCountTotal = 0;
                $semesterCountPerform = 0;
                $semesterCountSchool = 0;
                $semesterCountBehave = 0;

                $cycleTotalPercent = 0;
                $cycleTotalPerformPercent = 0;
                $cycleTotalSchoolPercent = 0;
                $cycleTotalBehavePercent = 0;
                $cycleTotalMalus = 0;
                $actualSalary = 0;

                if (isset($result) && $result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {

                        $malus = 0;

                        $malusSql = "SELECT weight FROM `tb_malus` WHERE tb_semester_ID = ".$row["ID"]." AND tb_user_ID = $userID;";
                        $malusResult = $mysqli->query($malusSql);
                        if (isset($malusResult) && $malusResult->num_rows > 0) {
                            while($malusRow = $malusResult->fetch_assoc()) {
                                $malus += $malusRow["weight"];
                            }
                        }

                        if(isset($malus)){
                            $cycleTotalMalus += $malus;
                        }

                        $semesterList .= generateSemesterLKVB($row['ID'], $row['semester'], $userID, $mysqli, $translate, $malus);

                        if(LKVBcalculateSemester($row['ID'], $userID, $mysqli) != 0){
                            $cycleTotalPercent += (LKVBcalculateSemester($row['ID'], $userID, $mysqli)) - ($malus/100);
                            $semesterCountTotal += 1;
                        }

                        if(LKVBcalculateBetriebPerform($row['ID'], $userID, $mysqli) != 0){
                            $cycleTotalPerformPercent += LKVBcalculateBetriebPerform($row['ID'], $userID, $mysqli);
                            $semesterCountPerform += 1;
                        }

                        if(calcSchool($row['ID'], $userID, $mysqli) != 0){
                            $cycleTotalSchoolPercent += calcSchool($row['ID'], $userID, $mysqli);
                            $semesterCountSchool += 1;
                        }

                        if(LKVBcalculateBetriebBehave($row['ID'], $userID, $mysqli) != 0){
                            $cycleTotalBehavePercent += LKVBcalculateBetriebBehave($row['ID'], $userID, $mysqli);
                            $semesterCountBehave += 1;
                        }

                    }
                }

                $cycleTotalPerformPercentAverage = calcNeededAverages($semesterCountPerform, $cycleTotalPerformPercent);
                $cycleTotalSchoolPercentAverage = calcNeededAverages($semesterCountSchool, $cycleTotalSchoolPercent);
                $cycleTotalBehavePercentAverage = calcNeededAverages($semesterCountBehave, $cycleTotalBehavePercent);
                $cycleTotalPercentAverage = calcNeededAverages($semesterCountTotal, $cycleTotalPercent);

                $actualSalary = calcActualSalary($cycleTotalPercentAverage, $_POST['cycleID']);

                if(isset($_POST['forCSV']) && $_POST['forCSV'] == true){

                    if($_POST['cycleID'] < 6 && $_POST['cycleID'] > 0){

                        $translateCycle = "kommenden Semester";

                        switch ($_POST['cycleID']) {
                            case 1:
                                $translateCycle = "5 & 6";
                                break;
                            case 2:
                                $translateCycle = "7";
                                break;
                            case 3:
                                $translateCycle = "8";
                                break;
                            case 4:
                                $translateCycle = "5";
                                break;
                            case 5:
                                $translateCycle = "6";
                                break;
                        }

                        $cvsValues = array(
                            "UserID" => $userID,
                            "Cycle" => $translateCycle,
                            "Salary" => $actualSalary,
                            "TotalPercent" => round($cycleTotalPercentAverage, 2),
                            "TotalPerform" => round($cycleTotalPerformPercentAverage, 2),
                            "TotalSchool" => round($cycleTotalSchoolPercentAverage, 2),
                            "TotalBehave" => round($cycleTotalBehavePercentAverage, 2),
                            "TotalMalus" => $cycleTotalMalus
                        );
                        return $cvsValues;

                    } else {
                        return false;
                    }

                } else {
                    echo generateEntryLKVB($actualSalary, $cycleTotalPercentAverage, $cycleTotalPerformPercentAverage, $cycleTotalSchoolPercentAverage, $cycleTotalBehavePercentAverage, $semesterList, $translate);
                }

            }

        }
    }

    if(isset($_POST['cycleID'])){
        doCreateContent();
    }

?>
