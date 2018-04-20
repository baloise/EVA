<?php

    include("../../includes/session.php");
    include("./../../database/connect.php");
    include("getContent.php");

    if($session_usergroup == 1 || $session_usergroup == 3 || $session_usergroup == 4 || $session_usergroup == 5){

        //General Contents
        function calcActualSalary($w1, $cycle){

            //Lohn 1. Cycle -> IT
            if($cycle == 1){

                if($w1*100 < 70){
                    return 1300;
                } else if ($w1*100 < 72.99){
                    return 1350;
                } else if ($w1*100 < 75.99){
                    return 1400;
                } else if ($w1*100 < 78.99){
                    return 1450;
                } else if ($w1*100 < 81.99){
                    return 1500;
                } else if ($w1*100 < 84.99){
                    return 1550;
                } else if ($w1*100 >= 85){
                    return 1600;
                }

            //Lohn 2. Cycle -> IT
            } else if ($cycle == 2){

                if($w1*100 < 70){
                    return 1400;
                } else if ($w1*100 < 72.99){
                    return 1450;
                } else if ($w1*100 < 75.99){
                    return 1500;
                } else if ($w1*100 < 78.99){
                    return 1550;
                } else if ($w1*100 < 81.99){
                    return 1600;
                } else if ($w1*100 < 84.99){
                    return 1650;
                } else if ($w1*100 >= 85){
                    return 1900;
                }

            //Lohn 3. Cycle -> IT
            } else if ($cycle == 3){

                if($w1*100 < 70){
                    return 1400;
                } else if ($w1*100 < 72.99){
                    return 1250;
                } else if ($w1*100 < 75.99){
                    return 1300;
                } else if ($w1*100 < 78.99){
                    return 1350;
                } else if ($w1*100 < 81.99){
                    return 1400;
                } else if ($w1*100 < 84.99){
                    return 1450;
                } else if ($w1*100 >= 85){
                    return 1500;
                }

            //Lohn 4. Cycle -> KV
            } else if ($cycle == 4){


                if($w1*100 < 70){
                    return 1200;
                } else if ($w1*100 < 72.99){
                    return 1250;
                } else if ($w1*100 < 75.99){
                    return 1300;
                } else if ($w1*100 < 78.99){
                    return 1350;
                } else if ($w1*100 < 81.99){
                    return 1400;
                } else if ($w1*100 < 84.99){
                    return 1450;
                } else if ($w1*100 >= 85){
                    return 1600;
                }

            //Lohn 4. Cycle -> KV
            } else if ($cycle == 5){


                if($w1*100 < 70){
                    return 1200;
                } else if ($w1*100 < 72.99){
                    return 1250;
                } else if ($w1*100 < 75.99){
                    return 1300;
                } else if ($w1*100 < 78.99){
                    return 1350;
                } else if ($w1*100 < 81.99){
                    return 1400;
                } else if ($w1*100 < 84.99){
                    return 1450;
                } else if ($w1*100 >= 85){
                    return 1600;
                }

            } else {
                return 0;
            }

        }

        function calcTotalPercentAvg($cTY3, $semC, $cTP){
            if($cTY3 != 0){
                if($semC != 0){
                    return ($cTY3/3) + (($cTP/$semC)/3)*2;
                } else {
                    return $cTY3;
                }
            } else {
                return calcNeededAverages($semC, $cTP);
            }
        }

        function calcNeededAverages($c1, $c2){

            if($c1 != 0){
                return ($c2 / $c1);
            } else {
                return 0;
            }

        }

        //Generate IT-Contents
        function generateSemesterIT($semesterID, $semesterName, $userID, $mysqli, $translate, $malus){

            $malusEntry = "";
            $deadlineEntry = "0";

            if($malus > 0){
                $malusEntry = $malusEntry . '
                <div class="col-lg-12 text-center">
                    <h2><b>'.$translate[8].': '.$malus.' %</b></h2>
                </div>
                ';
            }

            $deadlineEntry = "0";
            if(calculateDeadline($semesterID, $userID, $mysqli) >= 0){
                $deadlineEntry = round((calculateDeadline($semesterID, $userID, $mysqli)*100), 2) . " %";
            } else {
                $deadlineEntry = "Keine Einträge";
            }

            $semester = '

                <!-- SEMESTER -->

                <div class="row">
                    <div class="col-lg-12 card">
                        <div class="row semesterHeader" userID="'.$userID.'" semesterID="'.$semesterID.'" onclick="toggleSemester('.$userID.', '.$semesterID.');">
                            <div class="col-10">
                                <h2>'.$translate[38].' '.$semesterName.'</h2>
                            </div>
                            <div class="col-2 text-right">
                                <span><b>'. bcadd(round((LITcalculateSemester($semesterID, $userID, $mysqli)*100), 2), ($malus*-1), 2) .' %</b></span>
                                <i class="fa fa-chevron-down" style="margin-top: 5px;" aria-hidden="true"></i>
                            </div>
                        </div>
                        <div class="row semesterContent" userID="'.$userID.'" semesterID="'.$semesterID.'">
                            <div class="col-12">
                                <hr/>
                            </div>
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-lg-12">

                                        <!-- BERECHNUNGEN -->

                                        '.$malusEntry.'

                                        <div class="col-lg-12 card">
                                            <br/>
                                            <table class="table calcTable">
                                                <tr>
                                                    <td><b>'.$translate[126].'</b></td>
                                                    <td class="calcTableResult"><b>'. round((LITcalcInformatik($semesterID, $userID, $mysqli)*100), 2) .' %</b></td>
                                                </tr>
                                                <tr>
                                                    <td>'.$translate[127].'</td>
                                                    <td class="calcTableResult"> '. round((LITcalculateModule($semesterID, $userID, $mysqli)*100), 2) .' %</td>
                                                </tr>
                                                <tr>
                                                    <td>'.$translate[128].'</td>
                                                    <td class="calcTableResult">'. round((LITcalculatePresentation($semesterID, $userID, $mysqli)*100), 2) .' %</td>
                                                </tr>
                                            </table>
                                        </div>

                                        <div class="col-lg-12 card">
                                            <br/>
                                            <table class="table calcTable">
                                                <tr>
                                                    <td><b>'.$translate[129].'</b></td>
                                                    <td class="calcTableResult"><b>'. round((calcSchool($semesterID, $userID, $mysqli)*100), 2) .' %</b></td>
                                                </tr>
                                                <tr>
                                                    <td>'.$translate[130].'</td>
                                                    <td class="calcTableResult">'. round((calcSchool($semesterID, $userID, $mysqli)*100), 2) .' %</td>
                                                </tr>
                                            </table>
                                        </div>

                                        <div class="col-lg-12 card">
                                            <br/>
                                            <table class="table calcTable">
                                                <tr>
                                                    <td><b>'.$translate[131].'</b></td>
                                                    <td class="calcTableResult"><b>'. round((LITcalcBetieb($semesterID, $userID, $mysqli)*100), 2) .' %</b></td>
                                                </tr>
                                                <tr>
                                                    <td>'.$translate[13].'</td>
                                                    <td class="calcTableResult">'. round((LITcalculateBehavior($semesterID, $userID, $mysqli)*100), 2) .' %</td>
                                                </tr>
                                                <tr>
                                                    <td>'.$translate[12].'</td>
                                                    <td class="calcTableResult">'. $deadlineEntry .'</td>
                                                </tr>
                                            </table>
                                        </div>

                                        <!-- BERECHNUNGEN ENDE -->

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SEMESTER ENDE -->

                ';

                return $semester;

        }

        function generateEntryIT($aS, $cT1, $cT2, $cT3, $cT4, $sL, $translate){

            $entry = '
                <!-- PER AJAX CALLEN -->

                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-12">

                            '.$translate[132].': <b>'.$aS.'.-</b> ('. round(($cT1*100), 2) .' %)<br/>

                            <!-- BERECHNUNGEN -->

                             <div class="col-lg-12 card">
                                <br/>
                                <table class="table calcTable">
                                    <tr>
                                        <td><b>'.$translate[126].'</b></td>
                                        <td class="calcTableResult"><b>'. round(($cT2*100), 2) .' %</b></td>
                                    </tr>
                                    <tr>
                                        <td><b>'.$translate[129].'</b></td>
                                        <td class="calcTableResult"><b>'. round(($cT3*100), 2) .' %</b></td>
                                    </tr>
                                    <tr>
                                        <td><b>'.$translate[131].'</b></td>
                                        <td class="calcTableResult"><b>'. round(($cT4*100), 2) .' %</b></td>
                                    </tr>
                                </table>
                            </div>

                            <!-- BERECHNUNGEN ENDE -->

                            <!-- SEMESTER -->
                            <hr/>
                            <h2>'.$translate[133].'</h2>

                            '.$sL.'

                            <!-- SEMESTER ENDE -->

                            </div>
                        </div>
                    </div>

                <!-- PER AJAX CALLEN ENDE -->

            ';

            return $entry;

        };

        function cycleContentIT($mysqli, $sql1, $sql2, $userID, $translate){

            //Gemeinsame Variabeln
            $semesterList = "";
            $actualSalary = 0;
            $totalMalus = 0;

            //-------------------------------------------- Einen drittel berechnen --------------------------------------------

            //Prozent-Zwischenspeicher-Variabeln initialisieren
            $cycleTotalPercentY3 = 0;
            $cycleTotalItY3 = 0;
            $cycleTotalSchoolY3 = 0;
            $cycleTotalBetriebY3 = 0;

            //Prozentzähler initialisieren
            $cycleTotalPercent = 0;
            $cycleTotalItPercent = 0;
            $cycleTotalSchoolPercent = 0;
            $cycleTotalBetriebPercent = 0;

            //Semesterzähler initialisieren
            $semesterCountSemester = 0;
            $semesterCountSchool = 0;
            $semesterCountBetrieb = 0;
            $semesterCountInformatik = 0;

            $result = $mysqli->query($sql1);

            if (isset($result) && $result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {

                    $malus = 0;

                    $malusSql = "SELECT weight FROM `tb_malus` WHERE tb_semester_ID = ".$row["ID"]." AND tb_user_ID = $userID;";
                    $malusResult = $mysqli->query($malusSql);
                    if (isset($malusResult) && $malusResult->num_rows > 0) {
                        while($malusRow = $malusResult->fetch_assoc()) {
                            $malus = $malus + $malusRow["weight"];
                            $totalMalus = $totalMalus + $malusRow["weight"];
                        }
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

            $cycleTotalItY3 = calcNeededAverages($semesterCountInformatik, $cycleTotalItPercent);
            $cycleTotalSchoolY3 = calcNeededAverages($semesterCountSchool, $cycleTotalSchoolPercent);
            $cycleTotalBetriebY3 = calcNeededAverages($semesterCountBetrieb, $cycleTotalBetriebPercent);
            $cycleTotalPercentY3 = calcNeededAverages($semesterCountSemester, $cycleTotalPercent);

            //-------------------------------------------- Zwei drittel berechnen --------------------------------------------

            //Semesterzähler zurücksetzen
            $semesterCountSemester = 0;
            $semesterCountSchool = 0;
            $semesterCountBetrieb = 0;
            $semesterCountInformatik = 0;

            //Prozentzähler zurücksetzen
            $cycleTotalPercent = 0;
            $cycleTotalItPercent = 0;
            $cycleTotalSchoolPercent = 0;
            $cycleTotalBetriebPercent = 0;

            $result = $mysqli->query($sql2);

            if (isset($result) && $result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {

                    $malus = 0;

                    $malusSql = "SELECT weight FROM `tb_malus` WHERE tb_semester_ID = ".$row["ID"]." AND tb_user_ID = $userID;";
                    $malusResult = $mysqli->query($malusSql);
                    if (isset($malusResult) && $malusResult->num_rows > 0) {
                        while($malusRow = $malusResult->fetch_assoc()) {
                            $malus = $malus + $malusRow["weight"];
                            $totalMalus = $totalMalus + $malusRow["weight"];
                        }
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

            //Informatik Durschnitt berechnen
            $cycleTotalItPercentAverage = calcTotalPercentAvg($cycleTotalItY3, $semesterCountInformatik, $cycleTotalItPercent);

            //Schulnoten Durchschnitt berechnen
            $cycleTotalSchoolPercentAverage = calcTotalPercentAvg($cycleTotalSchoolY3, $semesterCountSchool, $cycleTotalSchoolPercent);

            //Betrieb Durchschnitt berechnen
            $cycleTotalBetriebPercentAverage = calcTotalPercentAvg($cycleTotalBetriebY3, $semesterCountBetrieb, $cycleTotalBetriebPercent);

            //Gesamtdurchschnitt berechnen
            $cycleTotalPercentAverage = calcTotalPercentAvg($cycleTotalPercentY3, $semesterCountSemester, $cycleTotalPercent);

            //Leistungslohn anhand Berechnung finden
            $actualSalary = calcActualSalary($cycleTotalPercentAverage, $_POST['cycleID']);

            echo generateEntryIT($actualSalary, $cycleTotalPercentAverage, $cycleTotalItPercentAverage, $cycleTotalSchoolPercentAverage, $cycleTotalBetriebPercentAverage, $semesterList, $translate);

        }

        //Generate LKVB-Contents
        function generateSemesterLKVB($semesterID, $semesterName, $userID, $mysqli, $translate, $malus){

            $malusEntry = "";

            if($malus > 0){
                $malusEntry = $malusEntry . '
                <div class="col-lg-12 text-center">
                    <h2><b>'.$translate[8].': '.$malus.' %</b></h2>
                </div>
                ';
            }

            $deadlineEntry = "0";
            if(calculateDeadline($semesterID, $userID, $mysqli) >= 0){
                $deadlineEntry = round((calculateDeadline($semesterID, $userID, $mysqli)*100), 2) . " %";
            } else {
                $deadlineEntry = "Keine Einträge";
            }

            $performBetrieb = "";

            if(LKVBcalcPerform($semesterID, $userID, $mysqli)*100 > 0){
                $performBetrieb = $performBetrieb . "<tr><td>".$translate[36]."</td><td class='calcTableResult'>" . round((LKVBcalcPerform($semesterID, $userID, $mysqli)*100), 2) . " %</td></tr>";
            }

            if (LKBcalcUek($semesterID, $userID, $mysqli)*100 > 0){

                $performBetrieb = $performBetrieb . "<tr><td>".$translate[124]."</td><td class='calcTableResult'>" . round((LKBcalcUek($semesterID, $userID, $mysqli)*100), 2) . " %</td></tr>";
            }

            if (LKVcalcStao($semesterID, $userID, $mysqli)*100 > 0){
                $performBetrieb = $performBetrieb . "<tr><td>".$translate[10]."</td><td class='calcTableResult'>" . round((LKVcalcStao($semesterID, $userID, $mysqli)*100), 2) . " %</td></tr>";
            }

            if (LKVcalcPe($semesterID, $userID, $mysqli)*100 > 0){
                $performBetrieb = $performBetrieb . "<tr><td>".$translate[9]."</td><td class='calcTableResult'>" . round((LKVcalcPe($semesterID, $userID, $mysqli)*100), 2) . " %</td></tr>";
            }

            $semester = '

                <!-- SEMESTER -->

                <div class="row">
                    <div class="col-lg-12 card" style="background-color: #F1F4FB;">
                        <div class="row semesterHeader" userID="'.$userID.'" semesterID="'.$semesterID.'" onclick="toggleSemester('.$userID.', '.$semesterID.');">
                            <div class="col-10">
                                <h2>'.$translate[38].' '.$semesterName.'</h2>
                            </div>
                            <div class="col-2 text-right">
                                <span><b>'. bcadd(round((LKVBcalculateSemester($semesterID, $userID, $mysqli)*100), 2), $malus*-1, 2) .' %</b></span>
                                <i class="fa fa-chevron-down" style="margin-top: 5px;" aria-hidden="true"></i>
                            </div>
                        </div>
                        <div class="row semesterContent" userID="'.$userID.'" semesterID="'.$semesterID.'">
                            <div class="col-12">
                                <hr/>
                            </div>
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-lg-12">

                                        <!-- BERECHNUNGEN -->

                                        '.$malusEntry.'

                                        <div class="col-lg-12 card">
                                            <br/>
                                            <table class="table calcTable">
                                                <tr>
                                                    <td><b>'.$translate[135].'</b></td>
                                                    <td class="calcTableResult"><b>'. round((LKVBcalculateBetriebPerform($semesterID, $userID, $mysqli)*100), 2) .' %</b></td>
                                                </tr>

                                                '.$performBetrieb.'

                                            </table>
                                        </div>

                                        <div class="col-lg-12 card">
                                            <br/>
                                            <table class="table calcTable">
                                                <tr>
                                                    <td><b>'.$translate[129].'</b></td>
                                                    <td class="calcTableResult"><b>'. round((calcSchool($semesterID, $userID, $mysqli)*100), 2) .' %</b></td>
                                                </tr>
                                                <tr>
                                                    <td>'.$translate[130].'</td>
                                                    <td class="calcTableResult">'. round((calcSchool($semesterID, $userID, $mysqli)*100), 2) .' %</td>
                                                </tr>
                                            </table>
                                        </div>

                                        <div class="col-lg-12 card">
                                            <br/>
                                            <table class="table calcTable">
                                                <tr>
                                                    <td><b>'.$translate[131].'</b></td>
                                                    <td class="calcTableResult"><b>'. round((LKVBcalculateBetriebBehave($semesterID, $userID, $mysqli)*100), 2) .' %</b></td>
                                                </tr>
                                                <tr>
                                                    <td>'.$translate[37].'</td>
                                                    <td class="calcTableResult">'. round((LKVBcalcBehavior($semesterID, $userID, $mysqli)*100), 2) .' %</td>
                                                </tr>
                                                <tr>
                                                    <td>'.$translate[12].'</td>
                                                    <td class="calcTableResult">'. $deadlineEntry .' </td>
                                                </tr>
                                            </table>
                                        </div>

                                        <!-- BERECHNUNGEN ENDE -->

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SEMESTER ENDE -->

                ';

                return $semester;

        }

        function generateEntryLKVB($aS, $cT1, $cT2, $cT3, $cT4, $sL, $translate){

            $entry = '
                <!-- PER AJAX CALLEN -->

                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-12">

                            '.$translate[132].': <b>'.$aS.'.-</b> ('. round(($cT1*100), 2) .' %)<br/>

                            <!-- BERECHNUNGEN -->

                             <div class="col-lg-12 card">
                                <br/>
                                <table class="table calcTable">
                                    <tr>
                                        <td><b>'.$translate[135].'</b></td>
                                        <td class="calcTableResult"><b>'. round(($cT2*100), 2) .' %</b></td>
                                    </tr>
                                    <tr>
                                        <td><b>'.$translate[129].'</b></td>
                                        <td class="calcTableResult"><b>'. round(($cT3*100), 2) .' %</b></td>
                                    </tr>
                                    <tr>
                                        <td><b>'.$translate[131].'</b></td>
                                        <td class="calcTableResult"><b>'. round(($cT4*100), 2) .' %</b></td>
                                    </tr>
                                </table>
                            </div>

                            <!-- BERECHNUNGEN ENDE -->

                            <!-- SEMESTER -->

                            <hr/>
                            <h2>'.$translate[133].'</h2>

                            '.$sL.'

                            <!-- SEMESTER ENDE -->

                            </div>
                        </div>
                    </div>

                <!-- PER AJAX CALLEN ENDE -->

            ';

            return $entry;

        };

        //Cycles and Calculations

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

            echo generateEntryIT($actualSalary, $cycleTotalPercentAverage, $cycleTotalItPercentAverage, $cycleTotalSchoolPercentAverage, $cycleTotalBetriebPercentAverage, $semesterList, $translate);

        }

        // --------------------------------- CYCLE IT 2&3 ------------------------------------------

        if($_POST['cycleID'] == 2){

            $sql1 = "SELECT sem.* FROM `tb_semester` as sem INNER JOIN tb_user as us ON us.tb_group_ID = sem.tb_group_ID WHERE us.ID = $userID LIMIT 4";
            $sql2 = "SELECT sem.* FROM `tb_semester` as sem INNER JOIN tb_user as us ON us.tb_group_ID = sem.tb_group_ID WHERE us.ID = $userID LIMIT 4, 2";
            cycleContentIT($mysqli, $sql1, $sql2, $userID, $translate);

        }

        if($_POST['cycleID'] == 3){

            $sql1 = "SELECT sem.* FROM `tb_semester` as sem INNER JOIN tb_user as us ON us.tb_group_ID = sem.tb_group_ID WHERE us.ID = $userID LIMIT 4, 2";
            $sql2 = "SELECT sem.* FROM `tb_semester` as sem INNER JOIN tb_user as us ON us.tb_group_ID = sem.tb_group_ID WHERE us.ID = $userID LIMIT 6, 1";
            cycleContentIT($mysqli, $sql1, $sql2, $userID, $translate);

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

            echo generateEntryLKVB($actualSalary, $cycleTotalPercentAverage, $cycleTotalPerformPercentAverage, $cycleTotalSchoolPercentAverage, $cycleTotalBehavePercentAverage, $semesterList, $translate);

        }

    }

?>
