<?php

    include("../session/session.php");
    include("./../../database/connect.php");
    
    if($session_usergroup != 1){
        echo "Sie haben keine Berechtigungen zu diesem Modul";
    }
    
    function designDeadlineEntry($state, $id, $title, $date, $usrid, $translate){
            
        if($state == 0){
            $entryDiv = '<div class="col-lg-3 col-sm-6 card deadline text-center" uid="'.$usrid.'" did="'.$id.'" style="cursor: pointer;" onclick="modifyEntry('.$id.', '.$usrid.', 0);" >';
        } else if ($state == 1){
            $entryDiv = '<div class="col-lg-3 col-sm-6 card deadline text-center alert-success" uid="'.$usrid.'" did="'.$id.'" style="cursor: pointer;" onclick="modifyEntry('.$id.', '.$usrid.', 1);">';
        } else if ($state == 2){
            $entryDiv = '<div class="col-lg-3 col-sm-6 card deadline text-center alert-danger" uid="'.$usrid.'" did="'.$id.'" style="cursor: pointer;" onclick="modifyEntry('.$id.', '.$usrid.', 2);">';
        } else {
            
        }
            
        $entry = '
            <b>'.$title.'</b>
            <br/><br/>
            <i>'.$translate["Bis"].' '.date('d.m.Y', strtotime($date)).'</i>
        </div>
        ';
            
        return $entryDiv . $entry;
            
    }
        
    function designSemesterEntry($usrid, $semid, $semtitle, $deadEntries, $translate){
        
        if($deadEntries){
            
            $entry = '
            <div class="card col-12 inCard">
                <div class="row deadlineHeader" deadlineSemesterID="'.$semid.'" userId="'.$usrid.'" onclick="expandDeadlines('.$semid.', '.$usrid.');">
                    <div class="col-10">
                        <b>'.$translate["Semester"].' '.$semtitle.'</b>
                    </div>
                    <div class="col-2 text-right">
                        <i class="fa fa-chevron-down toggleDetails" style="margin-top: 5px;" aria-hidden="true"></i>
                    </div>
                </div>
                        
                <div class="deadlineContent" deadlineSemesterID="'.$semid.'" userId="'.$usrid.'" style="display: none;">
                    <div class="row">
                        <div class="col-lg-12">
                            <hr/>
                        </div>
                    </div>
                     <div class="row">
                                
                        '.$deadEntries.'
                                
                    </div>
                </div>
                                            
            </div>
            ';
                
            return $entry;
        
        }
        
    };
    
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    
    
    
    
    if($session_usergroup == 1){
        
        //Lists of Entries
        $deadlineEntries = "";
        $semesterEntries = "";
        
        $error="";
        $userid = test_input($_POST['userid']);
        
        if(!isset($userid)){
            $error = $error . $translate["Keine Benutzer-ID vorhanden"];
        }
        
        if($error){
            echo $error;
        } else {    
            
            $stmt = $mysqli->prepare("SELECT sem.semester, sem.ID FROM `tb_semester` AS sem
                    INNER JOIN tb_user AS us ON us.tb_group_ID = sem.tb_group_ID
                    WHERE us.ID = ?");
            
            $stmt->bind_param("i", $userid);
            $stmt->execute();
            
            $result = $stmt->get_result();
            while ($row = $result->fetch_array(MYSQLI_NUM)){
                
                $semesterid = $row[1];
                $semesterTitle = $row[0];
                
                $stmt2 = $mysqli->prepare("SELECT * FROM `tb_deadline` WHERE tb_semester_ID = ?;");
                $stmt2->bind_param("i", $semesterid);
                $stmt2->execute();
                $result2 = $stmt2->get_result();
                
                if($result2->num_rows > 0){
                    while ($row2 = $result2->fetch_array(MYSQLI_NUM)){
                    
                        $deadlineID = $row2[0];
                        $deadlineTitle = $row2[1];
                        $deadlineDate = $row2[3];
                        
                        $stmt3 = $mysqli->prepare("SELECT * FROM `tb_deadline_check` WHERE tb_deadline_ID = ? && tb_user_ID = ?;");
                        $stmt3->bind_param("ii", $deadlineID, $userid);
                        $stmt3->execute();
                        $stmt3 = $stmt3->get_result();
                        
                        if($stmt3->num_rows > 0){
                            $deadlineState = "1";   
                        } else {
                            $today = date("Y-m-d");
                            if($deadlineDate < $today){
                                $deadlineState = "2";   
                            } else {
                                $deadlineState = "0";
                            }
                        }
                        
                        $deadlineEntries = $deadlineEntries .  designDeadlineEntry($deadlineState, $deadlineID, $deadlineTitle, $deadlineDate, $userid, $translate);
                        
                    }   
                } else {
                    $deadlineEntries = "";
                }
                
                $semesterEntries = $semesterEntries . designSemesterEntry($userid, $semesterid, $semesterTitle, $deadlineEntries, $translate);
                
            }
            
            echo $semesterEntries;
            
        }

           
    } else {
        echo $translate["Sie haben keinen Zugriff auf diese Funktionen"].".";
    }
    
?>