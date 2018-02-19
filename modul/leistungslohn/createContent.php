<?php

    include("../session/session.php");
    include("./../../database/connect.php");
    include("getContent.php");
    
    if($session_usergroup == 1 || $session_usergroup == 3){
        
        //Generate IT-Contents
        function generateSemesterIT($semesterID, $semesterName, $userID, $mysqli){
            
            $semester = '
                    
                <!-- SEMESTER -->
                                                    
                <div class="row">
                    <div class="col-lg-12 card" style="background-color: #F1F4FB;">
                        <div class="row semesterHeader" userID="'.$userID.'" semesterID="'.$semesterID.'" onclick="toggleSemester('.$userID.', '.$semesterID.');">
                            <div class="col-10">
                                <h2>Semester '.$semesterName.'</h2>
                            </div>
                            <div class="col-2 text-right">
                                <span><b>'. round((LITcalculateSemester($semesterID, $userID, $mysqli)*100), 2) .' %</b></span>
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
                                        
                                        <div class="col-lg-12 card">
                                            <br/>
                                            <table class="table calcTable">
                                                <tr>
                                                    <td><b>Leistung Informatik</b></td>
                                                    <td class="calcTableResult"><b>'. round((LITcalcInformatik($semesterID, $userID, $mysqli)*100), 2) .' %</b></td>
                                                </tr>
                                                <tr>
                                                    <td>Notenschnitt Informatik-Module und ÜKs</td>
                                                    <td class="calcTableResult"> '. round((LITcalculateModule($semesterID, $userID, $mysqli)*100), 2) .' %</td>
                                                </tr>
                                                <tr>
                                                    <td>Fachvorträge</td>
                                                    <td class="calcTableResult">'. round((LITcalculatePresentation($semesterID, $userID, $mysqli)*100), 2) .' %</td>
                                                </tr>
                                            </table>
                                        </div>
                                        
                                        <div class="col-lg-12 card">
                                            <br/>
                                            <table class="table calcTable">
                                                <tr>
                                                    <td><b>Leistung Schule</b></td>
                                                    <td class="calcTableResult"><b>'. round((calcSchool($semesterID, $userID, $mysqli)*100), 2) .' %</b></td>
                                                </tr>
                                                <tr>
                                                    <td>Notenschnitt Schulfächer und ÜKs</td>
                                                    <td class="calcTableResult">'. round((calcSchool($semesterID, $userID, $mysqli)*100), 2) .' %</td>
                                                </tr>
                                            </table>
                                        </div>
                                        
                                        <div class="col-lg-12 card">
                                            <br/>
                                            <table class="table calcTable">
                                                <tr>
                                                    <td><b>Verhalten Betrieb</b></td>
                                                    <td class="calcTableResult"><b>'. round((LITcalcBetieb($semesterID, $userID, $mysqli)*100), 2) .' %</b></td>
                                                </tr>
                                                <tr>
                                                    <td>Verhaltensziele</td>
                                                    <td class="calcTableResult">'. round((LITcalculateBehavior($semesterID, $userID, $mysqli)*100), 2) .' %</td>
                                                </tr>
                                                <tr>
                                                    <td>Terminmanagement</td>
                                                    <td class="calcTableResult">'. round((calculateDeadline($semesterID, $userID, $mysqli)*100), 2) .' %</td>
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
        
        function generateEntryIT($aS, $cT1, $cT2, $cT3, $cT4, $sL){
            
            $entry = '
                <!-- PER AJAX CALLEN -->
                                                            
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-12">
                            
                            Leistungslohn anhand aktueller Werte: <b>'.$aS.'.-</b> ('. round(($cT1*100), 2) .' %)<br/>
                            
                            <!-- BERECHNUNGEN -->
                            
                             <div class="col-lg-12 card">
                                <br/>
                                <table class="table calcTable">
                                    <tr>
                                        <td><b>Leistung Informatik</b></td>
                                        <td class="calcTableResult"><b>'. round(($cT2*100), 2) .' %</b></td>
                                    </tr>
                                    <tr>
                                        <td><b>Leistung Schule</b></td>
                                        <td class="calcTableResult"><b>'. round(($cT3*100), 2) .' %</b></td>
                                    </tr>
                                    <tr>
                                        <td><b>Verhalten Betrieb</b></td>
                                        <td class="calcTableResult"><b>'. round(($cT4*100), 2) .' %</b></td>
                                    </tr>
                                </table>
                            </div>
                            
                            <!-- BERECHNUNGEN ENDE -->
                            
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
        
        
        
        
        
        //Generate LKVB-Contents
        function generateSemesterLKVB($semesterID, $semesterName, $userID, $mysqli){
            
            $performBetrieb = "";
            
            if(LKVBcalcPerform($semesterID, $userID, $mysqli) > 0){
                $performBetrieb = $performBetrieb . "<tr><td>ALS - Leistungsziele</td><td class='calcTableResult'>" . round((LKVBcalcPerform($semesterID, $userID, $mysqli)*100), 2) . " %</td></tr>";
            } else if (LKBcalcUek($semesterID, $userID, $mysqli) > 0){
                $performBetrieb = $performBetrieb . "<tr><td>Überbetriebliche Kurse</td><td class='calcTableResult'>" . round((LKBcalcUek($semesterID, $userID, $mysqli)*100), 2) . " %</td></tr>";
            } else if (LKVcalcStao($semesterID, $userID, $mysqli) > 0){
                $performBetrieb = $performBetrieb . "<tr><td>STAO</td><td class='calcTableResult'>" . round((LKVcalcStao($semesterID, $userID, $mysqli)*100), 2) . " %</td></tr>";
            } else if (LKVcalcPe($semesterID, $userID, $mysqli) > 0){
                $performBetrieb = $performBetrieb . "<tr><td>PE</td><td class='calcTableResult'>" . round((LKVcalcPe($semesterID, $userID, $mysqli)*100), 2) . " %</td></tr>";
            } else {
                $performBetrieb = $performBetrieb . "<tr><td colspan='2' style='text-align:center;'>Bisher keine Daten</td></tr>";
            }
            
            $semester = '
                    
                <!-- SEMESTER -->
                                                    
                <div class="row">
                    <div class="col-lg-12 card" style="background-color: #F1F4FB;">
                        <div class="row semesterHeader" userID="'.$userID.'" semesterID="'.$semesterID.'" onclick="toggleSemester('.$userID.', '.$semesterID.');">
                            <div class="col-10">
                                <h2>Semester '.$semesterName.'</h2>
                            </div>
                            <div class="col-2 text-right">
                                <span><b>'. round((LITcalculateSemester($semesterID, $userID, $mysqli)*100), 2) .' %</b></span>
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
                                        
                                        <div class="col-lg-12 card">
                                            <br/>
                                            <table class="table calcTable">
                                                <tr>
                                                    <td><b>Leistung Betrieb</b></td>
                                                    <td class="calcTableResult"><b>'. round((LKVBcalculateBetriebPerform($semesterID, $userID, $mysqli)*100), 2) .' %</b></td>
                                                </tr>
                                                
                                                '.$performBetrieb.'
                                                
                                            </table>
                                        </div>
                                        
                                        <div class="col-lg-12 card">
                                            <br/>
                                            <table class="table calcTable">
                                                <tr>
                                                    <td><b>Leistung Schule</b></td>
                                                    <td class="calcTableResult"><b>'. round((calcSchool($semesterID, $userID, $mysqli)*100), 2) .' %</b></td>
                                                </tr>
                                                <tr>
                                                    <td>Notenschnitt Schulfächer</td>
                                                    <td class="calcTableResult">'. round((calcSchool($semesterID, $userID, $mysqli)*100), 2) .' %</td>
                                                </tr>
                                            </table>
                                        </div>
                                        
                                        <div class="col-lg-12 card">
                                            <br/>
                                            <table class="table calcTable">
                                                <tr>
                                                    <td><b>Verhalten Betrieb</b></td>
                                                    <td class="calcTableResult"><b>'. round((LKVBcalculateBetriebBehave($semesterID, $userID, $mysqli)*100), 2) .' %</b></td>
                                                </tr>
                                                <tr>
                                                    <td>ALS - Verhaltensziele</td>
                                                    <td class="calcTableResult">'. round((LKVBcalcBehavior($semesterID, $userID, $mysqli)*100), 2) .' %</td>
                                                </tr>
                                                <tr>
                                                    <td>Terminmanagement</td>
                                                    <td class="calcTableResult">'. round((calculateDeadline($semesterID, $userID, $mysqli)*100), 2) .' %</td>
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
        
        function generateEntryLKVB($aS, $cT1, $cT2, $cT3, $cT4, $sL){
            
            $entry = '
                <!-- PER AJAX CALLEN -->
                                                            
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-12">
                            
                            Leistungslohn anhand aktueller Werte: <b>'.$aS.'.-</b> ('. round(($cT1*100), 2) .' %)<br/>
                            
                            <!-- BERECHNUNGEN -->
                            
                             <div class="col-lg-12 card">
                                <br/>
                                <table class="table calcTable">
                                    <tr>
                                        <td><b>Leistung Betrieb</b></td>
                                        <td class="calcTableResult"><b>'. round(($cT2*100), 2) .' %</b></td>
                                    </tr>
                                    <tr>
                                        <td><b>Leistung Schule</b></td>
                                        <td class="calcTableResult"><b>'. round(($cT3*100), 2) .' %</b></td>
                                    </tr>
                                    <tr>
                                        <td><b>Verhalten Betrieb</b></td>
                                        <td class="calcTableResult"><b>'. round(($cT4*100), 2) .' %</b></td>
                                    </tr>
                                </table>
                            </div>
                            
                            <!-- BERECHNUNGEN ENDE -->
                            
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
                return 1500;
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
            
            $semesterCount = 0;
            $cycleTotalPercent = 0;
            $cycleTotalItPercent = 0;
            $cycleTotalSchoolPercent = 0;
            $cycleTotalBetriebPercent = 0;
            $actualSalary = 0;
            
            if (isset($result) && $result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    
                    $semesterCount = $semesterCount + 1;
                    
                    $semesterList = $semesterList . generateSemesterIT($row['ID'], $row['semester'], $userID, $mysqli);
                    
                    if(LITcalculateSemester($row['ID'], $userID, $mysqli) != 0){
                        $cycleTotalPercent = $cycleTotalPercent + LITcalculateSemester($row['ID'], $userID, $mysqli);   
                    } else {
                        $cycleTotalPercent = $cycleTotalPercent + 1;
                    }
                    
                    if(LITcalcInformatik($row['ID'], $userID, $mysqli) != 0){
                        $cycleTotalItPercent = $cycleTotalItPercent + LITcalcInformatik($row['ID'], $userID, $mysqli);
                    } else {
                        $cycleTotalItPercent = $cycleTotalItPercent + 1;
                    }
                    
                    if(calcSchool($row['ID'], $userID, $mysqli) != 0){
                        $cycleTotalSchoolPercent = $cycleTotalSchoolPercent + calcSchool($row['ID'], $userID, $mysqli);
                    } else {
                        $cycleTotalSchoolPercent = $cycleTotalSchoolPercent + 1;
                    }
                    
                    if(LITcalcBetieb($row['ID'], $userID, $mysqli) != 0){
                        $cycleTotalBetriebPercent = $cycleTotalBetriebPercent + LITcalcBetieb($row['ID'], $userID, $mysqli);
                    } else {
                        $cycleTotalBetriebPercent = $cycleTotalBetriebPercent + 1;
                    }
                    
                }
            }
            
            $cycleTotalItPercentAverage = $cycleTotalItPercent / $semesterCount;
            $cycleTotalSchoolPercentAverage = $cycleTotalSchoolPercent / $semesterCount;
            $cycleTotalBetriebPercentAverage = $cycleTotalBetriebPercent / $semesterCount;
            $cycleTotalPercentAverage = ($cycleTotalItPercentAverage + $cycleTotalSchoolPercentAverage + $cycleTotalBetriebPercentAverage)/3;
            
            $actualSalary = calcActualSalaryIT($cycleTotalPercentAverage);
            
            echo generateEntryIT($actualSalary, $cycleTotalPercentAverage, $cycleTotalItPercentAverage, $cycleTotalSchoolPercentAverage, $cycleTotalBetriebPercentAverage, $semesterList);
            
        }
        
        // --------------------------------- CYCLE 2 ------------------------------------------
        if($_POST['cycleID'] == 2){
            
            $sql = "SELECT * FROM `tb_semester` WHERE tb_group_ID = 3 LIMIT 4";
            $result = $mysqli->query($sql);
            
            $semesterList = "";
            
            $semesterCount = 0;
            $cycleTotalPercent = 0;
            $cycleTotalItY3 = 0;
            $cycleTotalSchoolY3 = 0;
            $cycleTotalBetriebY3 = 0;
            $actualSalary = 0;
            
            $cycleTotalPercent = 0;
            $cycleTotalItPercent = 0;
            $cycleTotalSchoolPercent = 0;
            $cycleTotalBetriebPercent = 0;
            
            if (isset($result) && $result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    
                    $semesterCount = $semesterCount + 1;
                    
                    $semesterList = $semesterList . generateSemesterIT($row['ID'], $row['semester'], $userID, $mysqli);
                    
                    if(LITcalculateSemester($row['ID'], $userID, $mysqli) != 0){
                        $cycleTotalPercent = $cycleTotalPercent + LITcalculateSemester($row['ID'], $userID, $mysqli);   
                    } else {
                        $cycleTotalPercent = $cycleTotalPercent + 1;
                    }
                    
                    if(LITcalcInformatik($row['ID'], $userID, $mysqli) != 0){
                        $cycleTotalItPercent = $cycleTotalItPercent + LITcalcInformatik($row['ID'], $userID, $mysqli);
                    } else {
                        $cycleTotalItPercent = $cycleTotalItPercent + 1;
                    }
                    
                    if(calcSchool($row['ID'], $userID, $mysqli) != 0){
                        $cycleTotalSchoolPercent = $cycleTotalSchoolPercent + calcSchool($row['ID'], $userID, $mysqli);
                    } else {
                        $cycleTotalSchoolPercent = $cycleTotalSchoolPercent + 1;
                    }
                    
                    if(LITcalcBetieb($row['ID'], $userID, $mysqli) != 0){
                        $cycleTotalBetriebPercent = $cycleTotalBetriebPercent + LITcalcBetieb($row['ID'], $userID, $mysqli);
                    } else {
                        $cycleTotalBetriebPercent = $cycleTotalBetriebPercent + 1;
                    }
                    
                }
            }
            
            $cycleTotalItY3 = $cycleTotalItPercent / $semesterCount;
            $cycleTotalSchoolY3 = $cycleTotalSchoolPercent / $semesterCount;
            $cycleTotalBetriebY3 = $cycleTotalBetriebPercent / $semesterCount;
            $cycleTotalPercentY3 = ($cycleTotalItY3 + $cycleTotalSchoolY3 + $cycleTotalBetriebY3)/3;
            
            $sql = "SELECT * FROM `tb_semester` WHERE tb_group_ID = 3 LIMIT 4, 2";
            $result = $mysqli->query($sql);
            
            $semesterCount = 0;
            $cycleTotalPercent = 0;
            $cycleTotalItPercent = 0;
            $cycleTotalSchoolPercent = 0;
            $cycleTotalBetriebPercent = 0;
            
            if (isset($result) && $result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    
                    $semesterCount = $semesterCount + 1;
                    
                    $semesterList = $semesterList . generateSemesterIT($row['ID'], $row['semester'], $userID, $mysqli);
                    
                    if(LITcalculateSemester($row['ID'], $userID, $mysqli) != 0){
                        $cycleTotalPercent = $cycleTotalPercent + LITcalculateSemester($row['ID'], $userID, $mysqli);   
                    } else {
                        $cycleTotalPercent = $cycleTotalPercent + 1;
                    }
                    
                    if(LITcalcInformatik($row['ID'], $userID, $mysqli) != 0){
                        $cycleTotalItPercent = $cycleTotalItPercent + LITcalcInformatik($row['ID'], $userID, $mysqli);
                    } else {
                        $cycleTotalItPercent = $cycleTotalItPercent + 1;
                    }
                    
                    if(calcSchool($row['ID'], $userID, $mysqli) != 0){
                        $cycleTotalSchoolPercent = $cycleTotalSchoolPercent + calcSchool($row['ID'], $userID, $mysqli);
                    } else {
                        $cycleTotalSchoolPercent = $cycleTotalSchoolPercent + 1;
                    }
                    
                    if(LITcalcBetieb($row['ID'], $userID, $mysqli) != 0){
                        $cycleTotalBetriebPercent = $cycleTotalBetriebPercent + LITcalcBetieb($row['ID'], $userID, $mysqli);
                    } else {
                        $cycleTotalBetriebPercent = $cycleTotalBetriebPercent + 1;
                    }
                    
                }
            }
            
            $cycleTotalItPercentAverage = (($cycleTotalItY3/3)) + ((($cycleTotalItPercent/$semesterCount)/3)*2);
            $cycleTotalSchoolPercentAverage = (($cycleTotalSchoolY3/3)) + ((($cycleTotalSchoolPercent/$semesterCount)/3)*2);
            $cycleTotalBetriebPercentAverage = (($cycleTotalBetriebY3/3)) + ((($cycleTotalBetriebPercent/$semesterCount)/3)*2);
            $cycleTotalPercentAverage = ($cycleTotalItPercentAverage + $cycleTotalSchoolPercentAverage + $cycleTotalBetriebPercentAverage)/3;
            
            $actualSalary = calcActualSalaryIT($cycleTotalPercentAverage);
            
            echo generateEntryIT($actualSalary, $cycleTotalPercentAverage, $cycleTotalItPercentAverage, $cycleTotalSchoolPercentAverage, $cycleTotalBetriebPercentAverage, $semesterList);
            
            
        }
        
        // --------------------------------- CYCLE 3 ------------------------------------------
        if($_POST['cycleID'] == 3){
            
            $sql = "SELECT * FROM `tb_semester` WHERE tb_group_ID = 3 LIMIT 4, 2";
            $result = $mysqli->query($sql);
            
            $semesterList = "";
            
            $semesterCount = 0;
            $cycleTotalPercent = 0;
            $cycleTotalItY3 = 0;
            $cycleTotalSchoolY3 = 0;
            $cycleTotalBetriebY3 = 0;
            $actualSalary = 0;
            
            $cycleTotalPercent = 0;
            $cycleTotalItPercent = 0;
            $cycleTotalSchoolPercent = 0;
            $cycleTotalBetriebPercent = 0;
            
            if (isset($result) && $result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    
                    $semesterCount = $semesterCount + 1;
                    
                    $semesterList = $semesterList . generateSemesterIT($row['ID'], $row['semester'], $userID, $mysqli);
                    
                    if(LITcalculateSemester($row['ID'], $userID, $mysqli) != 0){
                        $cycleTotalPercent = $cycleTotalPercent + LITcalculateSemester($row['ID'], $userID, $mysqli);   
                    } else {
                        $cycleTotalPercent = $cycleTotalPercent + 1;
                    }
                    
                    if(LITcalcInformatik($row['ID'], $userID, $mysqli) != 0){
                        $cycleTotalItPercent = $cycleTotalItPercent + LITcalcInformatik($row['ID'], $userID, $mysqli);
                    } else {
                        $cycleTotalItPercent = $cycleTotalItPercent + 1;
                    }
                    
                    if(calcSchool($row['ID'], $userID, $mysqli) != 0){
                        $cycleTotalSchoolPercent = $cycleTotalSchoolPercent + calcSchool($row['ID'], $userID, $mysqli);
                    } else {
                        $cycleTotalSchoolPercent = $cycleTotalSchoolPercent + 1;
                    }
                    
                    if(LITcalcBetieb($row['ID'], $userID, $mysqli) != 0){
                        $cycleTotalBetriebPercent = $cycleTotalBetriebPercent + LITcalcBetieb($row['ID'], $userID, $mysqli);
                    } else {
                        $cycleTotalBetriebPercent = $cycleTotalBetriebPercent + 1;
                    }
                    
                }
            }
            
            $cycleTotalItY3 = $cycleTotalItPercent / $semesterCount;
            $cycleTotalSchoolY3 = $cycleTotalSchoolPercent / $semesterCount;
            $cycleTotalBetriebY3 = $cycleTotalBetriebPercent / $semesterCount;
            $cycleTotalPercentY3 = ($cycleTotalItY3 + $cycleTotalSchoolY3 + $cycleTotalBetriebY3)/3;
            
            $sql = "SELECT * FROM `tb_semester` WHERE tb_group_ID = 3 LIMIT 6, 1";
            $result = $mysqli->query($sql);
            
            $semesterCount = 0;
            $cycleTotalPercent = 0;
            $cycleTotalItPercent = 0;
            $cycleTotalSchoolPercent = 0;
            $cycleTotalBetriebPercent = 0;
            
            if (isset($result) && $result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    
                    $semesterCount = $semesterCount + 1;
                    
                    $semesterList = $semesterList . generateSemesterIT($row['ID'], $row['semester'], $userID, $mysqli);
                    
                    if(LITcalculateSemester($row['ID'], $userID, $mysqli) != 0){
                        $cycleTotalPercent = $cycleTotalPercent + LITcalculateSemester($row['ID'], $userID, $mysqli);   
                    } else {
                        $cycleTotalPercent = $cycleTotalPercent + 1;
                    }
                    
                    if(LITcalcInformatik($row['ID'], $userID, $mysqli) != 0){
                        $cycleTotalItPercent = $cycleTotalItPercent + LITcalcInformatik($row['ID'], $userID, $mysqli);
                    } else {
                        $cycleTotalItPercent = $cycleTotalItPercent + 1;
                    }
                    
                    if(calcSchool($row['ID'], $userID, $mysqli) != 0){
                        $cycleTotalSchoolPercent = $cycleTotalSchoolPercent + calcSchool($row['ID'], $userID, $mysqli);
                    } else {
                        $cycleTotalSchoolPercent = $cycleTotalSchoolPercent + 1;
                    }
                    
                    if(LITcalcBetieb($row['ID'], $userID, $mysqli) != 0){
                        $cycleTotalBetriebPercent = $cycleTotalBetriebPercent + LITcalcBetieb($row['ID'], $userID, $mysqli);
                    } else {
                        $cycleTotalBetriebPercent = $cycleTotalBetriebPercent + 1;
                    }
                    
                }
            }
            
            $cycleTotalItPercentAverage = (($cycleTotalItY3/3)) + ((($cycleTotalItPercent/$semesterCount)/3)*2);
            $cycleTotalSchoolPercentAverage = (($cycleTotalSchoolY3/3)) + ((($cycleTotalSchoolPercent/$semesterCount)/3)*2);
            $cycleTotalBetriebPercentAverage = (($cycleTotalBetriebY3/3)) + ((($cycleTotalBetriebPercent/$semesterCount)/3)*2);
            $cycleTotalPercentAverage = ($cycleTotalItPercentAverage + $cycleTotalSchoolPercentAverage + $cycleTotalBetriebPercentAverage)/3;
            
            $actualSalary = calcActualSalaryIT($cycleTotalPercentAverage);
            
            echo generateEntryIT($actualSalary, $cycleTotalPercentAverage, $cycleTotalItPercentAverage, $cycleTotalSchoolPercentAverage, $cycleTotalBetriebPercentAverage, $semesterList);
            
            
        } 
        
        
        // --------------------------------- CYCLE 4 ------------------------------------------
        if($_POST['cycleID'] == 4){
            
            $sql = "SELECT * FROM `tb_semester` WHERE tb_group_ID = 4 LIMIT 4";
            $result = $mysqli->query($sql);
            
            $semesterList = "";
            
            $semesterCount = 0;
            $cycleTotalPercent = 0;
            $cycleTotalItPercent = 0;
            $cycleTotalSchoolPercent = 0;
            $cycleTotalBetriebPercent = 0;
            $actualSalary = 0;
            
            if (isset($result) && $result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    
                    $semesterCount = $semesterCount + 1;
                    
                    $semesterList = $semesterList . generateSemesterLKVB($row['ID'], $row['semester'], $userID, $mysqli);
                    
                    if(LKVBcalculateSemester($row['ID'], $userID, $mysqli) != 0){
                        $cycleTotalPercent = $cycleTotalPercent + LKVBcalculateSemester($row['ID'], $userID, $mysqli);   
                    } else {
                        $cycleTotalPercent = $cycleTotalPercent + 1;
                    }
                    
                    if(LKVBcalculateBetriebPerform($row['ID'], $userID, $mysqli) != 0){
                        $cycleTotalItPercent = $cycleTotalItPercent + LKVBcalculateBetriebPerform($row['ID'], $userID, $mysqli);
                    } else {
                        $cycleTotalItPercent = $cycleTotalItPercent + 1;
                    }
                    
                    if(calcSchool($row['ID'], $userID, $mysqli) != 0){
                        $cycleTotalSchoolPercent = $cycleTotalSchoolPercent + calcSchool($row['ID'], $userID, $mysqli);
                    } else {
                        $cycleTotalSchoolPercent = $cycleTotalSchoolPercent + 1;
                    }
                    
                    if(LKVBcalculateBetriebBehave($row['ID'], $userID, $mysqli) != 0){
                        $cycleTotalBetriebPercent = $cycleTotalBetriebPercent + LKVBcalculateBetriebBehave($row['ID'], $userID, $mysqli);
                    } else {
                        $cycleTotalBetriebPercent = $cycleTotalBetriebPercent + 1;
                    }
                    
                }
            }
            
            $cycleTotalItPercentAverage = $cycleTotalItPercent / $semesterCount;
            $cycleTotalSchoolPercentAverage = $cycleTotalSchoolPercent / $semesterCount;
            $cycleTotalBetriebPercentAverage = $cycleTotalBetriebPercent / $semesterCount;
            $cycleTotalPercentAverage = ($cycleTotalItPercentAverage + $cycleTotalSchoolPercentAverage + $cycleTotalBetriebPercentAverage)/3;
            
            $actualSalary = calcActualSalaryLKVB($cycleTotalPercentAverage);
            
            echo generateEntryLKVB($actualSalary, $cycleTotalPercentAverage, $cycleTotalItPercentAverage, $cycleTotalSchoolPercentAverage, $cycleTotalBetriebPercentAverage, $semesterList);
            
        }
    
    }

?>