<?php

    include("../session/session.php");
    include("./../../database/connect.php");
    
    $error = "";
    
    $cycleID = $_POST['cycleID'];
    $userID = $_POST['userID'];
    
    if($session_usergroup == 1){
    
        function LITcalculateSemester(){
            
            $LITinformatik = LITcalcInformatik();
            $LITschule = LITcalcSchool();
            $LITbetrieb = LITcalcBetieb();
            
            return ( ($LITinformatik/3) + ($LITschule/3) + ($LITbetrieb/3) );
            
        }
        
        function LITcalcInformatik(){
            
            $LITmodule = LITcalculateSemesterModule();
            $LITpresentation = LITcalculatePresentation();
            
            if($LITpresentation){
                return ( (($LITmodule/3)*2) + (($LITpresentation/3)*1) );
            } else {
                return ($LITmodule);
            }
            
        }
        
        function LITcalcBetieb(){
            
            $LITbehavior = LITcalculateBehavior();
            $LITdeadline = LITcalculateDeadline();
            
            return ( (($LITbehavior/3)*2) + (($LITdeadline/3)*1) );
            
        }
        
        function LITcalcSchool(){
			
			if($cycleID == 1){
				
				$LITsemester1 = LITcalculateSchool($semester);
				$LITsemester1 = LITcalculateSchool($semester);
				$LITsemester2 = LITcalculateSchool($semester);
				$LITsemester3 = LITcalculateSchool($semester);
				
			}
			
        }
		
		function LITcalculateSemesterSchool($semester){
			
			$sql = "SELECT subject.ID AS subjectID, subject.correctedGrade AS correction FROM `tb_user_subject` AS subject WHERE subject.tb_user_ID = $userID AND subject.tb_semester_ID = $semester";
			
		}
        
        function LITcalculateSemesterModule(){
            
        }
        
        function LITcalculateBehavior(){
            
        }
        
        function LITcalculateDeadline(){
            
        }
        
        function LITcalculatePresentation(){
            
        }
           
    
        //LOGIC
        
        if($cycleID == 1){
            
            echo LITcalculateSemester();
            
        } else if ($cycleID == 2){
            
            
            
        } else if ($cycleID == 3){
            
            
            
        } else {
            $error = $error . "Falschen bzw. unbekannter Rechnungszyklus angegeben.";
        }
    
    } else {
        echo "Keine Berechtigungen auf die Funktion.";
    }

?>