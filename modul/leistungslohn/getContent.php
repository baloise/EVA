<?php

    include("../session/session.php");
    include("./../../database/connect.php");
    
    $error = "";
    
    if($session_usergroup == 1 || $session_usergroup == 3 || $session_usergroup == 4 || $session_usergroup == 5){
    
        //ALS-Verhaltensziele
        function LKVBcalcBehavior($semesterID, $userID, $mysqli){
            
            $sql = "SELECT * FROM `tb_als` WHERE tb_user_ID = $userID AND tb_semester_ID = $semesterID AND performance IS NULL;";
            
            $result = $mysqli->query($sql);
          
            $countPoints = 0;
            $countForms = 0;
            
            if (isset($result) && $result->num_rows > 0) {
                
                while($row = $result->fetch_assoc()) {
                    
                    $countPoints = $countPoints + $row['points'];
                    $countForms = $countForms + 1;
                        
                }
                
                if($countPoints > 0){
                    return (($countPoints/$countForms)/54);   
                }
            
            }
        }
        
        //ALS-Leistungsziele
        function LKVBcalcPerform($semesterID, $userID, $mysqli){
            
            $sql = "SELECT * FROM `tb_als` WHERE tb_user_ID = $userID AND tb_semester_ID = $semesterID AND performance = 1;";
            
            $result = $mysqli->query($sql);
          
            $countPoints = 0;
            $countForms = 0;
            
            if (isset($result) && $result->num_rows > 0) {
                
                while($row = $result->fetch_assoc()) {
                    
                    $countPoints = $countPoints + $row['points'];
                    $countForms = $countForms + 1;
                        
                }
                
                if($countPoints > 0){
                    return (($countPoints/$countForms)/54);
                }
            
            }
            
        }
        
        //ÜK
        function LKBcalcUek($semesterID, $userID, $mysqli){
            
            $sql = "SELECT * FROM `tb_uek` WHERE tb_user_ID = $userID AND tb_semester_ID = $semesterID";
            
            $result = $mysqli->query($sql);
          
            $countPoints = 0;
            $countForms = 0;
            
            if (isset($result) && $result->num_rows > 0) {
                
                while($row = $result->fetch_assoc()) {
                    
                    $countPoints = $countPoints + $row['grade']/6;
                    $countForms = $countForms + 1;
                        
                }
                
                if($countPoints > 0){
                    return (($countPoints/$countForms));
                }
            
            }
            
        }
        
        //PE
        function LKVcalcPe($semesterID, $userID, $mysqli){
            
            $sql = "SELECT * FROM `tb_pe` WHERE tb_user_ID = $userID AND tb_semester_ID = $semesterID;";
            
            $result = $mysqli->query($sql);
          
            $countPoints = 0;
            $countForms = 0;
            
            if (isset($result) && $result->num_rows > 0) {
                
                while($row = $result->fetch_assoc()) {
                    
                    $countPoints = $countPoints + $row['points'];
                    $countForms = $countForms + 1;
                        
                }
                
                if($countPoints > 0){
                    return (($countPoints/$countForms)/72);
                }
            
            }
            
        }
        
        //Stao
        function LKVcalcStao($semesterID, $userID, $mysqli){
            
            $sql = "SELECT * FROM `tb_stao` WHERE tb_user_ID = $userID AND tb_semester_ID = $semesterID;";
            
            $result = $mysqli->query($sql);
          
            $countPoints = 0;
            $countForms = 0;
            
            if (isset($result) && $result->num_rows > 0) {
                
                while($row = $result->fetch_assoc()) {
                    
                    $countPoints = $countPoints + $row['points'];
                    $countForms = $countForms + 1;
                        
                }
                
                if($countPoints > 0){
                    return (($countPoints/$countForms)/100);
                }
            
            }
            
        }
        
        //
        function calculateSubject($subjectID, $mysqli){
            
            $sql = "SELECT grade, weighting FROM `tb_subject_grade` WHERE tb_user_subject_ID = $subjectID";
            $result = $mysqli->query($sql);
            
            $grades = 0;
            $weights = 0;
            
            if (isset($result) && $result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    
                    $grades = $grades + $row['grade'];
                    $weights = $weights + $row['weighting'];
                    
                }
                
                return (($grades/$weights)*100);
                
            }
            
        }
        
        //Verhaltensziele
        function LITcalculateBehavior($semesterID, $userID, $mysqli){
            
            //TODO Alle Verhaltensziele-Einträge des Users X im Semester Y zusammenzählen & Durchschnitt returnen (in Prozent von 72)
            $sql = "SELECT points FROM `tb_behaviorgrade` WHERE tb_semester_ID = $semesterID AND tb_userLL_ID = $userID;";
            
            $result = $mysqli->query($sql);
          
            $countPoints = 0;
            $countForms = 0;
            
            if (isset($result) && $result->num_rows > 0) {
                
                while($row = $result->fetch_assoc()) {
                    
                    $countPoints = $countPoints + $row['points'];
                    $countForms = $countForms + 1;
                        
                }
                
                return (($countPoints/$countForms)/72);
                
            }
            
        }
        
        //Terminmanagement 
        function calculateDeadline($semesterID, $userID, $mysqli){
            
            //TODO: Alle Deadlines des Users des Users Suchen und Testen ob diese erfüllt wurden oder nicht.
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
                
            if($passes == 0){
                return 1;
            } else if($passes == 1){
                return 0.5;
            } else if($passes > 1){
                return 0;
            }
            
        }
        
        //Verhalten Betrieb KV
        function LKVBcalculateBetriebBehave($semesterID, $userID, $mysqli){
            
            $LKVBbehavior = LKVBcalcBehavior($semesterID, $userID, $mysqli);
            $LKVBdeadline = calculateDeadline($semesterID, $userID, $mysqli);
            
            if($LKVBbehavior != 0 & $LKVBdeadline != 0){
                return ((($LKVBdeadline) + ($LKVBbehavior*2))/3);
            } else if ($LKVBdeadline != 0) {
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
        
        //Fachvortrag
        function LITcalculatePresentation($semesterID, $userID, $mysqli){
            
            $sql = "SELECT points FROM `tb_presentation` WHERE tb_user_ID = $userID AND tb_semester_ID = $semesterID;";
            $result = $mysqli->query($sql);
          
            $countPercentage = 0;
            $countPresentations = 0;
          
            if (isset($result) && $result->num_rows > 0) {
                
                while($row = $result->fetch_assoc()) {
                
                    $points = $row['points'];
                    $countPercentage = $countPercentage + ($points / 84);
                    $countPresentations = $countPresentations + 1;
                
                }
                
                if($countPercentage != 0){
                    return ($countPercentage/$countPresentations);
                };
                
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
                        $percentage = $grade / 6;
                        
                    } else {
                        
                        $grade = calculateSubject($row['ID'], $mysqli);
                        $percentage = $grade / 6;
                        
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
            
            if($LITbehavior != 0 & $LITdeadline != 0){
                return ( (($LITdeadline/3)*2) + (($LITbehavior/3)*1) );
            } else if ($LITdeadline != 0) {
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
                        $percentage = $grade / 6;
                        
                    } else {
                        
                        $grade = calculateSubject($row['ID'], $mysqli);
                        $percentage = $grade / 6;
                        
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