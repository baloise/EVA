<?php

    //General Contents
    function calcActualSalary($w1, $cycle){

        //Lohn 1. Cycle -> IT
        if($cycle == 1){

            if($w1*100 < 61.24){
                return 1300;
            } else if ($w1*100 < 62.49){
                return 1312.5;
            } else if ($w1*100 < 64.99){
                return 1325;
            } else if ($w1*100 < 69.99){
                return 1375;
            } else if ($w1*100 < 77.49){
                return 1425;
            } else if ($w1*100 < 84.99){
                return 1500;
            } else if ($w1*100 <= 100){
                return 1600;
            } else {
                return false;
            }

        //Lohn 2. & 3. Cycle -> IT
        } else if ($cycle == 2 || $cycle == 3){

            if($w1*100 < 61.24){
                return 1400;
            } else if ($w1*100 < 62.49){
                return 1425;
            } else if ($w1*100 < 64.99){
                return 1450;
            } else if ($w1*100 < 69.99){
                return 1500;
            } else if ($w1*100 < 77.49){
                return 1600;
            } else if ($w1*100 < 84.99){
                return 1750;
            } else if ($w1*100 <= 100){
                return 1900;
            } else {
                return false;
            }

        //Lohn 4. & 5. Cycle -> KV
        } else if ($cycle == 4 || $cycle == 5){

            if($w1*100 < 61.24){
                return 1200;
            } else if ($w1*100 < 62.49){
                return 1225;
            } else if ($w1*100 < 64.99){
                return 1250;
            } else if ($w1*100 < 69.99){
                return 1300;
            } else if ($w1*100 < 77.49){
                return 1400;
            } else if ($w1*100 < 84.99){
                return 1550;
            } else if ($w1*100 <= 100){
                return 1700;
            } else {
                return false;
            }

        } else if($cycle == 6){

            if($w1*100 < 61.24){
                return 1300;
            } else if ($w1*100 < 62.49){
                return 1312.5;
            } else if ($w1*100 < 64.99){
                return 1325;
            } else if ($w1*100 < 69.99){
                return 1375;
            } else if ($w1*100 < 77.49){
                return 1425;
            } else if ($w1*100 < 84.99){
                return 1500;
            } else if ($w1*100 <= 100){
                return 1600;
            } else {
                return false;
            }

        //Lohn 2. & 3. Cycle -> MT
        } else if ($cycle == 7 || $cycle == 8){

            if($w1*100 < 61.24){
                return 1400;
            } else if ($w1*100 < 62.49){
                return 1425;
            } else if ($w1*100 < 64.99){
                return 1450;
            } else if ($w1*100 < 69.99){
                return 1500;
            } else if ($w1*100 < 77.49){
                return 1600;
            } else if ($w1*100 < 84.99){
                return 1750;
            } else if ($w1*100 <= 100){
                return 1900;
            } else {
                return false;
            }


        } else {
            return 0;
        }

    }

    function calculateEndSum($c1, $c2, $c3, $malus){

        $caller = 3;
        $cycleTmpCalc = (($c1+$c2+$c3));
        if($c1 < 0){$caller -= 1;}
        if($c2 < 0){$caller -= 1;}
        if($c3 < 0){$caller -= 1;}

        if($caller > 0){
            return ($cycleTmpCalc/$caller) -$malus/100;
        } else {
            return 0;
        }

    }

    function calcTotalPercentAvg($cTY3, $semC, $cTP){
        if($cTY3 != 0){
            if($semC != 0){
                return ($cTY3 +  2*($cTP/$semC) )/3;
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
    function generateSemesterIT($semesterID, $semesterName, $userID, $mysqli, $translate, $cycleID){

        $deadlineEntry = "0";

        if(calculateDeadline($semesterID, $userID, $mysqli) >= 0){
            $deadlineEntry = round((calculateDeadline($semesterID, $userID, $mysqli)*100), 2) . " %";
        } else {
            $deadlineEntry = "-";
        }

        $semester = '

            <!-- SEMESTER -->

            <div class="row">
                <div class="col-lg-12 card highlighter" style="background-color: #e0e0e0;">

                    <div class="row semesterHeader" userID="'.$userID.'" semesterID="'.$semesterID.'" onclick="toggleSemester('.$userID.', '.$semesterID.', '.$cycleID.');">
                        <div class="col-10">
                            <h2>'.$translate[38].' '.$semesterName.'</h2>
                        </div>
                        <div class="col-2 text-right">
                            <span><b>'. round((LITcalculateSemester($semesterID, $userID, $mysqli)*100), 2) .' %</b></span>
                            <i class="fa fa-chevron-down" style="margin-top: 5px;" aria-hidden="true"></i>
                        </div>
                    </div>

                    <div class="row semesterContent" userID="'.$userID.'" semesterID="'.$semesterID.'" cycleID="'.$cycleID.'">
                        <div class="col-12">
                            <hr/>
                        </div>
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-12">

                                    <!-- BERECHNUNGEN -->

                                    <div class="col-lg-12 card highlighter">
                                        <br/>
                                        <table class="table calcTable">
                                            <tr>
                                                <td><b>'.$translate[126].'</b></td>
                                                <td class="calcTableResult"><b>'. round((LITcalcInformatik($semesterID, $userID, $mysqli)*100), 2) .' %</b></td>
                                            </tr>
                                            <tr>
                                                <td>'.$translate[127].'</td>
                                                <td class="calcTableResult"> '. round((calcSchool($semesterID, $userID, $mysqli, 0)*100), 2) .' %</td>
                                            </tr>
                                            <tr>
                                                <td>'.$translate[128].'</td>
                                                <td class="calcTableResult">'. round((LITcalculatePresentation($semesterID, $userID, $mysqli)*100), 2) .' %</td>
                                            </tr>
                                        </table>
                                    </div>

                                    <div class="col-lg-12 card highlighter">
                                        <br/>
                                        <table class="table calcTable">
                                            <tr>
                                                <td><b>'.$translate[129].'</b></td>
                                                <td class="calcTableResult"><b>'. round((calcSchool($semesterID, $userID, $mysqli, 1)*100), 2) .' %</b></td>
                                            </tr>
                                            <tr>
                                                <td>'.$translate[130].'</td>
                                                <td class="calcTableResult">'. round((calcSchool($semesterID, $userID, $mysqli, 1)*100), 2) .' %</td>
                                            </tr>
                                        </table>
                                    </div>

                                    <div class="col-lg-12 card highlighter" style="margin-bottom: 20px;">
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

    function generateEntryIT($totalMalus, $aS, $cT1, $cT2, $cT3, $cT4, $sL, $translate){

        if($totalMalus > 0){
            $malusEntry = '
            <tr style="color:red;">
                <td><b>'.$translate[8].'</b></td>
                <td class="calcTableResult"><b>'. round($totalMalus, 2) .' %</b></td>
            </tr>
            ';
        } else {
            $malusEntry = '';
        }

        $entry = '
            <!-- PER AJAX CALLEN -->

            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-12">

                        <div class="row" style="margin-top:20px;">
                            <div class="col-lg-4 text-center">
                                <span class="salaryText">'.$aS.'</span>
                                '.$translate[132].'<br />
                                <b>'. round(($cT1*100), 2) .' %</b>
                            </div>
                            <div class="col-lg-8">
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
                                    '.$malusEntry.'
                                </table>
                            </div>
                        </div>

                        <!-- SEMESTER -->

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

        //-------------------------------------------- Einen drittel berechnen --------------------------------------------

        //Prozent-Zwischenspeicher-Variabeln initialisieren
        $cycleTotalMalusY3 = 0;

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

                $malusSql = "SELECT weight FROM `tb_malus` WHERE tb_semester_ID = ".$row["ID"]." AND tb_user_ID = $userID;";
                $malusResult = $mysqli->query($malusSql);
                if (isset($malusResult) && $malusResult->num_rows > 0) {
                    while($malusRow = $malusResult->fetch_assoc()) {
                        $cycleTotalMalusY3 += $malusRow["weight"];
                    }
                }

                $semesterList .= generateSemesterIT($row['ID'], $row['semester'], $userID, $mysqli, $translate, $_POST['cycleID']);

                if(LITcalculateSemester($row['ID'], $userID, $mysqli) > 0){
                    $cycleTotalPercent = ($cycleTotalPercent + LITcalculateSemester($row['ID'], $userID, $mysqli));
                    $semesterCountSemester += 1;
                }

                if(LITcalcInformatik($row['ID'], $userID, $mysqli) > 0){
                    $cycleTotalItPercent = $cycleTotalItPercent + LITcalcInformatik($row['ID'], $userID, $mysqli);
                    $semesterCountInformatik += 1;
                }

                if(calcSchool($row['ID'], $userID, $mysqli, 1) > 0){
                    $cycleTotalSchoolPercent = $cycleTotalSchoolPercent + calcSchool($row['ID'], $userID, $mysqli, 1);
                    $semesterCountSchool += 1;
                }

                if(LITcalcBetieb($row['ID'], $userID, $mysqli) > 0){
                    $cycleTotalBetriebPercent = $cycleTotalBetriebPercent + LITcalcBetieb($row['ID'], $userID, $mysqli);
                    $semesterCountBetrieb += 1;
                }

            }
        }

        if($cycleTotalMalusY3>0){
            $cycleTotalMalusY3 = $cycleTotalMalusY3/$semesterCountSemester;
        }

        $cycleTotalItY3 = calcNeededAverages($semesterCountInformatik, $cycleTotalItPercent);
        $cycleTotalSchoolY3 = calcNeededAverages($semesterCountSchool, $cycleTotalSchoolPercent);
        $cycleTotalBetriebY3 = calcNeededAverages($semesterCountBetrieb, $cycleTotalBetriebPercent);
        $cycleTotalPercentY3 = calculateEndSum($cycleTotalItY3,$cycleTotalSchoolY3,$cycleTotalBetriebY3,0);

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
        $cycleTotalMalus = 0;

        $result = $mysqli->query($sql2);

        if (isset($result) && $result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {

                $malusSql = "SELECT weight FROM `tb_malus` WHERE tb_semester_ID = ".$row["ID"]." AND tb_user_ID = $userID;";
                $malusResult = $mysqli->query($malusSql);
                if (isset($malusResult) && $malusResult->num_rows > 0) {
                    while($malusRow = $malusResult->fetch_assoc()) {
                        $cycleTotalMalus += $malusRow["weight"];
                    }
                }

                $semesterList .= generateSemesterIT($row['ID'], $row['semester'], $userID, $mysqli, $translate, $_POST['cycleID']);

                if(LITcalculateSemester($row['ID'], $userID, $mysqli) > 0){
                    $cycleTotalPercent = ($cycleTotalPercent + LITcalculateSemester($row['ID'], $userID, $mysqli));
                    $semesterCountSemester += 1;
                }

                if(LITcalcInformatik($row['ID'], $userID, $mysqli) > 0){
                    $cycleTotalItPercent = $cycleTotalItPercent + LITcalcInformatik($row['ID'], $userID, $mysqli);
                    $semesterCountInformatik += 1;
                }

                if(calcSchool($row['ID'], $userID, $mysqli, 1) > 0){
                    $cycleTotalSchoolPercent = $cycleTotalSchoolPercent + calcSchool($row['ID'], $userID, $mysqli, 1);
                    $semesterCountSchool += 1;
                }

                if(LITcalcBetieb($row['ID'], $userID, $mysqli) > 0){
                    $cycleTotalBetriebPercent = $cycleTotalBetriebPercent + LITcalcBetieb($row['ID'], $userID, $mysqli);
                    $semesterCountBetrieb += 1;
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
        if($cycleTotalMalus>0){
            $cycleTotalMalus = $cycleTotalMalus/$semesterCountSemester;
        }

        $totalMalus = ($cycleTotalMalusY3+2*($cycleTotalMalus))/3;
        $cycleTotalPercentAverage = calculateEndSum($cycleTotalItPercentAverage,$cycleTotalSchoolPercentAverage,$cycleTotalBetriebPercentAverage,$totalMalus);
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
                "TotalPercent" => round($cycleTotalPercentAverage*100, 2),
                "TotalIT" => round($cycleTotalItPercentAverage*100, 2),
                "TotalSchool" => round($cycleTotalSchoolPercentAverage*100, 2),
                "TotalBetrieb" => round($cycleTotalBetriebPercentAverage*100, 2),
                "TotalMalus" => round($totalMalus, 2)
            );

            return $cvsValues;

        } else {
            echo generateEntryIT($totalMalus, $actualSalary, $cycleTotalPercentAverage, $cycleTotalItPercentAverage, $cycleTotalSchoolPercentAverage, $cycleTotalBetriebPercentAverage, $semesterList, $translate);
        }


    }



    //Generate LKVB-Contents
    function generateSemesterLKVB($semesterID, $semesterName, $userID, $mysqli, $translate, $cycleID){

        $deadlineEntry = "0";
        if(calculateDeadline($semesterID, $userID, $mysqli) >= 0){
            $deadlineEntry = round((calculateDeadline($semesterID, $userID, $mysqli)*100), 2) . " %";
        } else {
            $deadlineEntry = "-";
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
                <div class="col-lg-12 card highlighter" style="background-color: #e0e0e0;">
                    <div class="row semesterHeader" userID="'.$userID.'" semesterID="'.$semesterID.'" onclick="toggleSemester('.$userID.', '.$semesterID.', '.$cycleID.');">
                        <div class="col-10">
                            <h2>'.$translate[38].' '.$semesterName.'</h2>
                        </div>
                        <div class="col-2 text-right">
                            <span><b>'. round((LKVBcalculateSemester($semesterID, $userID, $mysqli)*100), 2) .' %</b></span>
                            <i class="fa fa-chevron-down" style="margin-top: 5px;" aria-hidden="true"></i>
                        </div>
                    </div>
                    <div class="row semesterContent" userID="'.$userID.'" semesterID="'.$semesterID.'" cycleID="'.$cycleID.'">
                        <div class="col-12">
                            <hr/>
                        </div>
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-12">

                                    <!-- BERECHNUNGEN -->

                                    <div class="col-lg-12 card highlighter">
                                        <br/>
                                        <table class="table calcTable">
                                            <tr>
                                                <td><b>'.$translate[135].'</b></td>
                                                <td class="calcTableResult"><b>'. round((LKVBcalculateBetriebPerform($semesterID, $userID, $mysqli)*100), 2) .' %</b></td>
                                            </tr>

                                            '.$performBetrieb.'

                                        </table>
                                    </div>

                                    <div class="col-lg-12 card highlighter">
                                        <br/>
                                        <table class="table calcTable">
                                            <tr>
                                                <td><b>'.$translate[129].'</b></td>
                                                <td class="calcTableResult"><b>'. round((calcSchool($semesterID, $userID, $mysqli, 1)*100), 2) .' %</b></td>
                                            </tr>
                                            <tr>
                                                <td>'.$translate[130].'</td>
                                                <td class="calcTableResult">'. round((calcSchool($semesterID, $userID, $mysqli, 1)*100), 2) .' %</td>
                                            </tr>
                                        </table>
                                    </div>

                                    <div class="col-lg-12 card highlighter" style="padding-bottom: 20px;">
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

    function generateEntryLKVB($totalMalus, $aS, $cT1, $cT2, $cT3, $cT4, $sL, $translate){

        if($totalMalus > 0){
            $malusEntry = '
            <tr style="color:red;">
                <td><b>'.$translate[8].'</b></td>
                <td class="calcTableResult"><b>'. round($totalMalus, 2) .' %</b></td>
            </tr>
            ';
        } else {
            $malusEntry = '';
        }

        $entry = '
            <!-- PER AJAX CALLEN -->

            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-12">

                        <div class="row" style="margin-top:20px;">
                            <div class="col-lg-4 text-center">
                                <span class="salaryText">'.$aS.'</span>
                                '.$translate[132].'<br />
                                <b>'. round(($cT1*100), 2) .' %</b>
                            </div>
                            <div class="col-lg-8">
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
                                    '.$malusEntry.'
                                </table>
                            </div>
                        </div>

                        <!-- SEMESTER -->

                        '.$sL.'

                        <!-- SEMESTER ENDE -->

                        </div>
                    </div>
                </div>

            <!-- PER AJAX CALLEN ENDE -->

        ';

        return $entry;

    };



    //Generate MT-Contents
    function generateSemesterMT($semesterID, $semesterName, $userID, $mysqli, $translate, $cycleID){

        $deadlineEntry = "0";

        if(calculateDeadline($semesterID, $userID, $mysqli) >= 0){
            $deadlineEntry = round((calculateDeadline($semesterID, $userID, $mysqli)*100), 2) . " %";
        } else {
            $deadlineEntry = "-";
        }

        $semester = '

            <!-- SEMESTER -->

            <div class="row">
                <div class="col-lg-12 card highlighter" style="background-color: #e0e0e0;">

                    <div class="row semesterHeader" userID="'.$userID.'" semesterID="'.$semesterID.'" onclick="toggleSemester('.$userID.', '.$semesterID.', '.$cycleID.');">
                        <div class="col-10">
                            <h2>'.$translate[38].' '.$semesterName.'</h2>
                        </div>
                        <div class="col-2 text-right">
                            <span><b>'. round((LITcalculateSemester($semesterID, $userID, $mysqli)*100), 2) .' %</b></span>
                            <i class="fa fa-chevron-down" style="margin-top: 5px;" aria-hidden="true"></i>
                        </div>
                    </div>

                    <div class="row semesterContent" userID="'.$userID.'" semesterID="'.$semesterID.'" cycleID="'.$cycleID.'">
                        <div class="col-12">
                            <hr/>
                        </div>
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-12">

                                    <!-- BERECHNUNGEN -->

                                    <div class="col-lg-12 card highlighter">
                                        <br/>
                                        <table class="table calcTable">
                                            <tr>
                                                <td><b>'.$translate[126].'</b></td>
                                                <td class="calcTableResult"><b>'. round((LMTcalcMedien($semesterID, $userID, $mysqli)*100), 2) .' %</b></td>
                                            </tr>
                                            <tr>
                                                <td>'.$translate[127].'</td>
                                                <td class="calcTableResult"> '. round((calcSchool($semesterID, $userID, $mysqli, 0)*100), 2) .' %</td>
                                            </tr>
                                        </table>
                                    </div>

                                    <div class="col-lg-12 card highlighter">
                                        <br/>
                                        <table class="table calcTable">
                                            <tr>
                                                <td><b>'.$translate[129].'</b></td>
                                                <td class="calcTableResult"><b>'. round((calcSchool($semesterID, $userID, $mysqli, 1)*100), 2) .' %</b></td>
                                            </tr>
                                            <tr>
                                                <td>'.$translate[130].'</td>
                                                <td class="calcTableResult">'. round((calcSchool($semesterID, $userID, $mysqli, 1)*100), 2) .' %</td>
                                            </tr>
                                        </table>
                                    </div>

                                    <div class="col-lg-12 card highlighter" style="margin-bottom: 20px;">
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

    function generateEntryMT($totalMalus, $aS, $cT1, $cT2, $cT3, $cT4, $sL, $translate){

        if($totalMalus > 0){
            $malusEntry = '
            <tr style="color:red;">
                <td><b>'.$translate[8].'</b></td>
                <td class="calcTableResult"><b>'. round($totalMalus, 2) .' %</b></td>
            </tr>
            ';
        } else {
            $malusEntry = '';
        }

        $entry = '
            <!-- PER AJAX CALLEN -->

            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-12">

                        <div class="row" style="margin-top:20px;">
                            <div class="col-lg-4 text-center">
                                <span class="salaryText">'.$aS.'</span>
                                '.$translate[132].'<br />
                                <b>'. round(($cT1*100), 2) .' %</b>
                            </div>
                            <div class="col-lg-8">
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
                                    '.$malusEntry.'
                                </table>
                            </div>
                        </div>

                        <!-- SEMESTER -->

                        '.$sL.'

                        <!-- SEMESTER ENDE -->

                        </div>
                    </div>
                </div>

            <!-- PER AJAX CALLEN ENDE -->

        ';

        return $entry;

    };

    function cycleContentMT($mysqli, $sql1, $sql2, $userID, $translate){

        //Gemeinsame Variabeln
        $semesterList = "";

        //-------------------------------------------- Einen 3. berechnen --------------------------------------------

        //Prozent-Zwischenspeicher-Variabeln inizialisieren
        $cycleTotalMalusY3 = 0;

        //Prozentzähler inizialisieren
        $cycleTotalPercent = 0;
        $cycleTotalMedienPercent = 0;
        $cycleTotalSchoolPercent = 0;
        $cycleTotalBetriebPercent = 0;

        //Semesterzähler inizialisieren
        $semesterCountSemester = 0;
        $semesterCountSchool = 0;
        $semesterCountBetrieb = 0;
        $semesterCountMedien = 0;

        $result = $mysqli->query($sql1);

        if (isset($result) && $result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {

                $malusSql = "SELECT weight FROM `tb_malus` WHERE tb_semester_ID = ".$row["ID"]." AND tb_user_ID = $userID;";
                $malusResult = $mysqli->query($malusSql);
                if (isset($malusResult) && $malusResult->num_rows > 0) {
                    while($malusRow = $malusResult->fetch_assoc()) {
                        $cycleTotalMalusY3 += $malusRow["weight"];
                    }
                }

                $semesterList .= generateSemesterMT($row['ID'], $row['semester'], $userID, $mysqli, $translate, $_POST['cycleID']);

                if(LITcalculateSemester($row['ID'], $userID, $mysqli) > 0){
                    $cycleTotalPercent = ($cycleTotalPercent + LITcalculateSemester($row['ID'], $userID, $mysqli));
                    $semesterCountSemester += 1;
                }

                if(LMTcalcMedien($row['ID'], $userID, $mysqli) > 0){
                    $cycleTotalMedienPercent = $cycleTotalMedienPercent + LMTcalcMedien($row['ID'], $userID, $mysqli);
                    $semesterCountMedien += 1;
                }

                if(calcSchool($row['ID'], $userID, $mysqli, 1) > 0){
                    $cycleTotalSchoolPercent = $cycleTotalSchoolPercent + calcSchool($row['ID'], $userID, $mysqli, 1);
                    $semesterCountSchool += 1;
                }

                if(LITcalcBetieb($row['ID'], $userID, $mysqli) > 0){
                    $cycleTotalBetriebPercent = $cycleTotalBetriebPercent + LITcalcBetieb($row['ID'], $userID, $mysqli);
                    $semesterCountBetrieb += 1;
                }

            }
        }

        if($cycleTotalMalusY3>0){
            $cycleTotalMalusY3 = $cycleTotalMalusY3/$semesterCountSemester;
        }

        $cycleTotalMedienY3 = calcNeededAverages($semesterCountMedien, $cycleTotalMedienPercent);
        $cycleTotalSchoolY3 = calcNeededAverages($semesterCountSchool, $cycleTotalSchoolPercent);
        $cycleTotalBetriebY3 = calcNeededAverages($semesterCountBetrieb, $cycleTotalBetriebPercent);
        $cycleTotalPercentY3 = calculateEndSum($cycleTotalMedienY3,$cycleTotalSchoolY3,$cycleTotalBetriebY3,0);

        //-------------------------------------------- Zwei 3. berechnen --------------------------------------------

        //Semesterzähler zurücksetzen
        $semesterCountSemester = 0;
        $semesterCountSchool = 0;
        $semesterCountBetrieb = 0;
        $semesterCountMedien = 0;

        //Prozentzähler zurücksetzen
        $cycleTotalPercent = 0;
        $cycleTotalMedienPercent = 0;
        $cycleTotalSchoolPercent = 0;
        $cycleTotalBetriebPercent = 0;
        $cycleTotalMalus = 0;

        $result = $mysqli->query($sql2);

        if (isset($result) && $result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {

                $malusSql = "SELECT weight FROM `tb_malus` WHERE tb_semester_ID = ".$row["ID"]." AND tb_user_ID = $userID;";
                $malusResult = $mysqli->query($malusSql);
                if (isset($malusResult) && $malusResult->num_rows > 0) {
                    while($malusRow = $malusResult->fetch_assoc()) {
                        $cycleTotalMalus += $malusRow["weight"];
                    }
                }

                $semesterList .= generateSemesterMT($row['ID'], $row['semester'], $userID, $mysqli, $translate, $_POST['cycleID']);

                if(LITcalculateSemester($row['ID'], $userID, $mysqli) > 0){
                    $cycleTotalPercent = ($cycleTotalPercent + LITcalculateSemester($row['ID'], $userID, $mysqli));
                    $semesterCountSemester += 1;
                }

                if(LMTcalcMedien($row['ID'], $userID, $mysqli) > 0){
                    $cycleTotalMedienPercent = $cycleTotalMedienPercent + LMTcalcMedien($row['ID'], $userID, $mysqli);
                    $semesterCountMedien += 1;
                }

                if(calcSchool($row['ID'], $userID, $mysqli, 1) > 0){
                    $cycleTotalSchoolPercent = $cycleTotalSchoolPercent + calcSchool($row['ID'], $userID, $mysqli, 1);
                    $semesterCountSchool += 1;
                }

                if(LITcalcBetieb($row['ID'], $userID, $mysqli) > 0){
                    $cycleTotalBetriebPercent = $cycleTotalBetriebPercent + LITcalcBetieb($row['ID'], $userID, $mysqli);
                    $semesterCountBetrieb += 1;
                }

            }
        }

        //Medien Durschni tt berechnen
        $cycleTotalMedienPercentAverage = calcTotalPercentAvg($cycleTotalMedienY3, $semesterCountMedien, $cycleTotalMedienPercent);

        //Schulnoten Durchschni tt berechnen
        $cycleTotalSchoolPercentAverage = calcTotalPercentAvg($cycleTotalSchoolY3, $semesterCountSchool, $cycleTotalSchoolPercent);

        //Betrieb Durchschni tt berechnen
        $cycleTotalBetriebPercentAverage = calcTotalPercentAvg($cycleTotalBetriebY3, $semesterCountBetrieb, $cycleTotalBetriebPercent);

        //Gesamtdurchschni tt berechnen
        if($cycleTotalMalus>0){
            $cycleTotalMalus = $cycleTotalMalus/$semesterCountSemester;
        }

        $totalMalus = ($cycleTotalMalusY3+2*($cycleTotalMalus))/3;
        $cycleTotalPercentAverage = calculateEndSum($cycleTotalMedienPercentAverage,$cycleTotalSchoolPercentAverage,$cycleTotalBetriebPercentAverage,$totalMalus);
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
                case 6:
                    $translateCycle = "5 & 6";
                    break;
                case 7:
                    $translateCycle = "7";
                    break;
                case 8:
                    $translateCycle = "8";
                    break;
            }

            $cvsValues = array(
                "UserID" => $userID,
                "Cycle" => $translateCycle,
                "Salary" => $actualSalary,
                "TotalPercent" => round($cycleTotalPercentAverage*100, 2),
                "TotalMedien" => round($cycleTotalMedienPercentAverage*100, 2),
                "TotalSchool" => round($cycleTotalSchoolPercentAverage*100, 2),
                "TotalBetrieb" => round($cycleTotalBetriebPercentAverage*100, 2),
                "TotalMalus" => round($totalMalus, 2)
            );

            return $cvsValues;

        } else {
            echo generateEntryMT($totalMalus, $actualSalary, $cycleTotalPercentAverage, $cycleTotalMedienPercentAverage, $cycleTotalSchoolPercentAverage, $cycleTotalBetriebPercentAverage, $semesterList, $translate);
        }


    }

?>
