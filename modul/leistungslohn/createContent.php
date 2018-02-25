<?php

    include("../session/session.php");
    include("./../../database/connect.php");
    include("getContent.php");

    if($session_usergroup == 1 || $session_usergroup == 3 || $session_usergroup == 4 || $session_usergroup == 5){

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

            if(is_numeric(calculateDeadline($semesterID, $userID, $mysqli))){
              $deadlineEntry = round((calculateDeadline($semesterID, $userID, $mysqli)*100), 2);
            }

            $semester = '

                <!-- SEMESTER -->

                <div class="row">
                    <div class="col-lg-12 card bg-color">
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
                                                    <td class="calcTableResult">'. $deadlineEntry .' %</td>
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

        function calcActualSalaryIT($w1){
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
                return 1500;
            }
        }

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

            if($semesterCountInformatik != 0){
                $cycleTotalItY3 = ($cycleTotalItPercent / $semesterCountInformatik);
            } else {
                $cycleTotalItY3 = 0;
            }

            if($semesterCountSchool != 0){
                $cycleTotalSchoolY3 = ($cycleTotalSchoolPercent / $semesterCountSchool);
            } else {
                $cycleTotalSchoolY3 = 0;
            }

            if($semesterCountBetrieb != 0){
                $cycleTotalBetriebY3 = ($cycleTotalBetriebPercent / $semesterCountBetrieb);
            } else {
                $cycleTotalBetriebY3 = 0;
            }

            if($semesterCountSemester != 0){
                $cycleTotalPercentY3 = ($cycleTotalPercent / $semesterCountSemester);
            } else {
                $cycleTotalPercentY3 = 0;
            }

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
            if($cycleTotalItY3 != 0){
                if($semesterCountInformatik != 0){
                    $cycleTotalItPercentAverage = (($cycleTotalItY3)) + ((($cycleTotalItPercent/$semesterCountInformatik)/3)*2);
                } else {
                    $cycleTotalItPercentAverage = $cycleTotalItY3;
                }
            } else {
                if($semesterCountInformatik != 0){
                    $cycleTotalItPercentAverage = (($cycleTotalItPercent/$semesterCountInformatik));
                } else {
                    $cycleTotalItPercentAverage = 0;
                }
            }

            //Schulnoten Durchschnitt berechnen
            if($cycleTotalSchoolY3 != 0){
                if($semesterCountSchool != 0){
                    $cycleTotalSchoolPercentAverage = (($cycleTotalSchoolY3)/3) + ((($cycleTotalSchoolPercent/$semesterCountSchool)/3)*2);
                } else {
                    $cycleTotalSchoolPercentAverage = $cycleTotalSchoolY3;
                }
            } else {
                if($semesterCountSchool != 0){
                    $cycleTotalSchoolPercentAverage = (($cycleTotalSchoolPercent/$semesterCountSchool));
                } else {
                    $cycleTotalSchoolPercentAverage = 0;
                }
            }

            //Betrieb Durchschnitt berechnen
            if($cycleTotalBetriebY3 != 0){
                if($semesterCountBetrieb != 0){
                    $cycleTotalBetriebPercentAverage = (($cycleTotalBetriebY3)/3) + ((($cycleTotalBetriebPercent/$semesterCountBetrieb)/3)*2);
                } else {
                    $cycleTotalBetriebPercentAverage = $cycleTotalBetriebY3;
                }
            } else {
                if($semesterCountBetrieb != 0){
                    $cycleTotalBetriebPercentAverage = (($cycleTotalBetriebPercent/$semesterCountBetrieb));
                } else {
                    $cycleTotalBetriebPercentAverage = 0;
                }
            }

            //Gesamtdurchschnitt berechnen
            if($cycleTotalPercentY3 != 0){
                if($semesterCountSemester != 0){
                    $cycleTotalPercentAverage = (($cycleTotalPercentY3)/3) + ((($cycleTotalPercent/$semesterCountSemester)/3)*2);
                } else {
                    $cycleTotalPercentAverage = $cycleTotalPercentY3;
                }
            } else {
                if($semesterCountSemester != 0){
                    $cycleTotalPercentAverage = (($cycleTotalPercent/$semesterCountSemester));
                } else {
                    $cycleTotalPercentAverage = 0;
                }
            }

            $actualSalary = calcActualSalaryIT($cycleTotalPercentAverage);

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
            if(is_numeric(calculateDeadline($semesterID, $userID, $mysqli))){
                $deadlineEntry = round((calculateDeadline($semesterID, $userID, $mysqli)*100), 2);
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
                                                    <td class="calcTableResult">'. $deadlineEntry .' %</td>
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

        function calcActualSalaryLKVB($w1){

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

        }


        if($session_usergroup == 1){
            $userID = $_POST['userID'];
        } else {
            $userID = $session_userid;
        }

        // --------------------------------- CYCLE 1 ------------------------------------------
        if($_POST['cycleID'] == 1){

            $sql = "SELECT * FROM `tb_semester` WHERE tb_group_ID = 3 LIMIT 4";
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

            if($semesterCountInformatik != 0){
                $cycleTotalItPercentAverage = ($cycleTotalItPercent / $semesterCountInformatik);
            } else {
                $cycleTotalItPercentAverage = 0;
            }

            if($semesterCountSchool != 0){
                $cycleTotalSchoolPercentAverage = ($cycleTotalSchoolPercent / $semesterCountSchool);
            } else {
                $cycleTotalSchoolPercentAverage = 0;
            }

            if($semesterCountBetrieb != 0){
                $cycleTotalBetriebPercentAverage = ($cycleTotalBetriebPercent / $semesterCountBetrieb);
            } else {
                $cycleTotalBetriebPercentAverage = 0;
            }

            if($semesterCountSemester != 0){
                $cycleTotalPercentAverage = ($cycleTotalPercent / $semesterCountSemester);
            } else {
                $cycleTotalPercentAverage = 0;
            }

            $actualSalary = calcActualSalaryIT($cycleTotalPercentAverage);

            echo generateEntryIT($actualSalary, $cycleTotalPercentAverage, $cycleTotalItPercentAverage, $cycleTotalSchoolPercentAverage, $cycleTotalBetriebPercentAverage, $semesterList, $translate);

        }

        // --------------------------------- CYCLE 2&3 ------------------------------------------

        if($_POST['cycleID'] == 2){

            $sql1 = "SELECT * FROM `tb_semester` WHERE tb_group_ID = 3 LIMIT 4";
            $sql2 = "SELECT * FROM `tb_semester` WHERE tb_group_ID = 3 LIMIT 4, 2";
            cycleContentIT($mysqli, $sql1, $sql2, $userID, $translate);

        }

        if($_POST['cycleID'] == 3){

            $sql1 = "SELECT * FROM `tb_semester` WHERE tb_group_ID = 3 LIMIT 4, 2";
            $sql2 = "SELECT * FROM `tb_semester` WHERE tb_group_ID = 3 LIMIT 6, 1";
            cycleContentIT($mysqli, $sql1, $sql2, $userID, $translate);

        }

        // --------------------------------- CYCLE 4 AND 5 ------------------------------------------
        if($_POST['cycleID'] == 4 || $_POST['cycleID'] == 5){

            if($_POST['cycleID'] == 4){
                $sql = "SELECT * FROM `tb_semester` WHERE tb_group_ID = 4 LIMIT 4";
            } else if ($_POST['cycleID'] == 5){
                $sql = "SELECT * FROM `tb_semester` WHERE tb_group_ID = 4 LIMIT 5";
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
                            $malus = $malus + $malusRow["weight"];
                        }
                    }

                    $semesterList = $semesterList . generateSemesterLKVB($row['ID'], $row['semester'], $userID, $mysqli, $translate, $malus);

                    if(LKVBcalculateSemester($row['ID'], $userID, $mysqli) != 0){
                        $cycleTotalPercent = $cycleTotalPercent + (LKVBcalculateSemester($row['ID'], $userID, $mysqli)) - ($malus/100);
                        $semesterCountTotal = $semesterCountTotal + 1;
                    }

                    if(LKVBcalculateBetriebPerform($row['ID'], $userID, $mysqli) != 0){
                        $cycleTotalPerformPercent = $cycleTotalPerformPercent + LKVBcalculateBetriebPerform($row['ID'], $userID, $mysqli);
                        $semesterCountPerform = $semesterCountPerform + 1;
                    }

                    if(calcSchool($row['ID'], $userID, $mysqli) != 0){
                        $cycleTotalSchoolPercent = $cycleTotalSchoolPercent + calcSchool($row['ID'], $userID, $mysqli);
                        $semesterCountSchool = $semesterCountSchool + 1;
                    }

                    if(LKVBcalculateBetriebBehave($row['ID'], $userID, $mysqli) != 0){
                        $cycleTotalBehavePercent = $cycleTotalBehavePercent + LKVBcalculateBetriebBehave($row['ID'], $userID, $mysqli);
                        $semesterCountBehave = $semesterCountBehave + 1;
                    }

                }
            }

            if($semesterCountPerform != 0){
                $cycleTotalPerformPercentAverage = $cycleTotalPerformPercent / $semesterCountPerform;
            } else {
                $cycleTotalPerformPercentAverage = 0;
            }

            if($semesterCountSchool != 0){
                $cycleTotalSchoolPercentAverage = $cycleTotalSchoolPercent / $semesterCountSchool;
            } else {
                $cycleTotalSchoolPercentAverage = 0;
            }

            if($semesterCountBehave != 0){
                $cycleTotalBehavePercentAverage = $cycleTotalBehavePercent / $semesterCountBehave;
            } else {
                $cycleTotalBehavePercentAverage = 0;
            }

            if($semesterCountTotal != 0){
                $cycleTotalPercentAverage = $cycleTotalPercent / $semesterCountTotal;
            } else {
                $cycleTotalPercentAverage = 0;
            }

            $actualSalary = calcActualSalaryLKVB($cycleTotalPercentAverage);

            echo generateEntryLKVB($actualSalary, $cycleTotalPercentAverage, $cycleTotalPerformPercentAverage, $cycleTotalSchoolPercentAverage, $cycleTotalBehavePercentAverage, $semesterList, $translate);

        }

    }

?>
