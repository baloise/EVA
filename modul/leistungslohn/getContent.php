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
            
            $LITmodule = LITcalculateModule();
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
            
        }
        
        function LITcalculateModule(){
            
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