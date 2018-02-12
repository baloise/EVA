<?php include("session/session.php"); ?>
<?php include("../database/connect.php"); ?>

<?php if($session_usergroup == 1) : //HR ?>

    <h1 class="mt-5">Notensammlung</h1>
    <h3>Lehrlinge</h3>
    
    <?php
    
        $sql1 = "SELECT ID, bKey FROM `tb_user` WHERE tb_group_ID = 3 OR tb_group_ID = 4;";
        $sql2 = "SELECT subjectName, ID, tb_semester_ID, correctedGrade FROM `tb_user_subject` WHERE tb_user_ID = ? ORDER BY creationDate DESC;";
        $sql3 = "";
        $sql4 = "";
    
    ?>
    
    <div class="row">
        <div class="card col-lg-12 userGradeBox">
            <div class="row userGradesHead" containerID="2">
                <div class="col-lg-4"><b>Elia Reutlinger</b></div>
                <div class="col-lg-4">Schnitt: 5.0</div>
                <div class="col-lg-4 text-right"><i class="fa fa-chevron-down toggleDetails" style="margin-top: 5px;" aria-hidden="true"></i></div>
            </div>
            <div class="row">
                <div class="col-lg-12 detailedGrades" containerID="2">
                    <div class="card">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Fach/Modul</th>
                                    <th scope="col">Noten unter 4</th>
                                    <th scope="col">Semester</th>
                                    <th scope="col">Schnitt</th>
                                    <th scope="col">Korrektur</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">M151</th>
                                    <td>1</td>
                                    <td>1</td>
                                    <td>5.5</td>
                                    <td>
                                        <div class="row">
                                            <div class="col-lg-10">
                                                <input placeholder="Schnitt" type="number" class="form-control"/>
                                            </div>
                                            <div class="col-lg-2" style="padding-left: 0;">
                                                <button type="button" class="btn btn-secondary"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">M151</th>
                                    <td>1</td>
                                    <td>1</td>
                                    <td>5.5</td>
                                    <td>
                                        <div class="row">
                                            <div class="col-lg-10">
                                                <input placeholder="Schnitt" type="number" class="form-control"/>
                                            </div>
                                            <div class="col-lg-2" style="padding-left: 0;">
                                                <button type="button" class="btn btn-secondary"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">M151</th>
                                    <td>1</td>
                                    <td>1</td>
                                    <td>5.5</td>
                                    <td>
                                        <div class="row">
                                            <div class="col-lg-10">
                                                <input placeholder="Schnitt" type="number" class="form-control"/>
                                            </div>
                                            <div class="col-lg-2" style="padding-left: 0;">
                                                <button type="button" class="btn btn-secondary"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <hr/>
                    <div class="row">
                        <div class="col-lg-12">
                            <h3>Noten unter 4</h3>
                            <div class="row gradeBelow">
                                <div class="col-lg-2">
                                    <b>M151</b>
                                </div>
                                <div class="col-lg-2">
                                    <b>Note:</b> 3.5
                                </div>
                                <div class="col-lg-2">
                                    <b>Semester:</b> 1
                                </div>
                                <div class="col-lg-6">
                                    <b>Begründung:</b> Lorem Ipsum döner sit ahmed
                                </div>
                            </div>
                            <div class="row gradeBelow">
                                <div class="col-lg-2">
                                    <b>M151</b>
                                </div>
                                <div class="col-lg-2">
                                    <b>Note:</b> 3.5
                                </div>
                                <div class="col-lg-2">
                                    <b>Semester:</b> 1
                                </div>
                                <div class="col-lg-6">
                                    <b>Begründung:</b> Lorem Ipsum döner sit ahmed
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <hr/>
                            <div class="row">
                                <div class="col-lg-4">
                                    Gesamtschnitt (alle Semester): 5.2
                                </div>
                                <div class="col-lg-4">
                                    Fächer/Module: 13
                                </div>
                                <div class="col-lg-4">
                                    Schnitt
                                    <select>
                                        <option>Semester 1</option>
                                        <option>Semester 2</option>
                                    </select>
                                    : 5.0
                                </div>
                                <br/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script type="text/javascript" src="modul/noten/noten.js"></script>  
    
<?php elseif($session_usergroup == 2) : ?>

    <h1 class="mt-5">Alle PA-Module</h1>
    <p>Sie sind Praxisausbildner</p>
    
    
<?php elseif($session_usergroup == 3 || $session_usergroup == 4) : //LLKV&IT ?>

    <?php
        
        
        //---------------------------------- Bestehende Fächer generieren ---------------------------------------
        $sql = "SELECT us.*  FROM `tb_user_subject` AS us
            INNER JOIN tb_semester AS ss ON ss.ID = us.tb_semester_ID
            WHERE us.tb_user_ID = $session_userid
            ORDER BY ss.semester DESC, us.`creationDate` DESC";
            
        $result = $mysqli->query($sql);
        $subjects = "";
        
        if (isset($result) && $result->num_rows > 0) {
            
            while($row = $result->fetch_assoc()) {
                
                $sql3 = "SELECT * FROM `tb_semester` WHERE tb_group_ID = $session_usergroup";
                $result3 = $mysqli->query($sql3);
                $semesterList = "";
                
                if (isset($result3) && $result3->num_rows > 0) {
                    
                    while($row3 = $result3->fetch_assoc()) {
                        if($row3['ID'] == $row['tb_semester_ID']){
                            $subjectSemester = "Semester: " . $row3['semester'];
                        }
                        $semesterList = $semesterList . "<option value='". $row3['ID'] ."'>". $row3['semester'] ."</option>";
                    }
                
                }
                
                $subjectId = $row['ID'];
                $grades = "";
                $average = "";
                
                $sql2 = "SELECT * FROM `tb_subject_grade` WHERE tb_user_subject_ID = $subjectId;";
                $result2 = $mysqli->query($sql2);
                
                if (isset($result2) && $result2->num_rows > 0) {
                    $i = 0;
                    $allGrades = 0;
                    $allWeight = 0;
                    
                    $grades = $grades . '
                        <div class="alert alert-danger" fSubject="'. $row['ID'] .'" id="error" style="display: none;" role="alert"></div>
                        <table class="table table-responsive">
                            <thead>
                                <tr>
                                    <th>Datum</th>
                                    <th>Titel</th>
                                    <th>Note</th>
                                    <th>Gewichtung</th>
                                    <th></th>
                                </tr>
                            </thead>    
                            <tbody>
                    ';
                    
                    while($row2 = $result2->fetch_assoc()) {
                        
                        $i = $i + 1;
                        $allGrades = $allGrades + ($row2['grade']*($row2['weighting']));
                        $allWeight = $allWeight + $row2['weighting'];
                        
                        $gradeEntry = '
                            <tr gradeId="'. $row2['ID'] .'" class="gradeEntry">
                                <td>' . date('d.m.Y', strtotime($row2['creationDate'])) . '</td>
                                <td>' . $row2['title'] . '</td>
                                <td>' . $row2['grade'] . '</td>
                                <td>' . $row2['weighting'] . ' %</td>
                                <td><span class="fa fa-trash-o delGrade" gradeId="'. $row2['ID'] .'" aria-hidden="true" style="cursor: pointer;"></span></td>
                            </tr>
                        ';
                        
                        $grades = $grades . $gradeEntry;     
                             
                    }
                    
                    $grades = $grades . '
                            <tr>
                                <td><button type="button" fSubject="'. $row['ID'] .'" class="btn addGrade" style="padding-bottom: 0px; padding-top: 0px; margin-top: 5px;"><span class="fa fa-plus" aria-hidden="true" style="cursor: pointer;"></span></button></td>
                                <td><input fSubject="'. $row['ID'] .'" class="form-control fgradeTitle" type="text" placeholder="Titel"/></td>
                                <td><input fSubject="'. $row['ID'] .'" class="form-control fgradeNote" min="1" max="6" type="number" placeholder="Note"/></td>
                                <td><input fSubject="'. $row['ID'] .'" class="form-control fgradeWeight" min="1" type="number" placeholder="Gewichtung (in %)"/></td>
                                <td></td>
                            </tr>
                            <tr class="badDay" fSubject="'. $row['ID'] .'" style="display:none">
                                <td colspan="5"><textarea fSubject="'. $row['ID'] .'" placeholder="Begründung Note unter 4.0" class="form-control fgradeReason"></textarea></td>
                            </tr>
                        </tbody>
                    </table>  
                    ';
                    
                    if (isset($allGrades)){
                        $average = '<h2>Schnitt: ' . floor(($allGrades / $allWeight) * 100) / 100 . '</h2>';
                    }
                    
                } else {
                    $grades = '
                    <p>Noch keine Noten vorhanden. Note Eintragen:</p>
                    <div class="alert alert-danger" fSubject="'. $row['ID'] .'" id="error" style="display: none;" role="alert"></div>
                    <table>
                        <tbody>
                            <tr>
                                <td><button type="button" fSubject="'. $row['ID'] .'" class="btn addGrade" style="padding-bottom: 0px; padding-top: 0px; margin-top: 5px;"><span class="fa fa-plus" aria-hidden="true" style="cursor: pointer;"></span></button></td>
                                <td><input fSubject="'. $row['ID'] .'" class="form-control fgradeTitle" type="text" placeholder="Titel"/></td>
                                <td><input fSubject="'. $row['ID'] .'" class="form-control fgradeNote" min="1" max="6" type="number" placeholder="Note"/></td>
                                <td><input fSubject="'. $row['ID'] .'" class="form-control fgradeWeight" min="1" type="number" placeholder="Gewichtung (in %)"/></td>
                                <td></td>
                            </tr>
                            <tr class="badDay" fSubject="'. $row['ID'] .'" style="display:none">
                                <td colspan="5"><textarea fSubject="'. $row['ID'] .'" placeholder="Begründung Note unter 4.0" class="form-control fgradeReason"></textarea></td>
                            </tr>
                        </tbody>
                    </table>
                    <br/>
                    ';
                }
                
                $subjectEntry = '
                    <div fSubject="'. $row['ID'] .'" class="col-lg-1 delSubTag"></div>
                    <div fSubject="'. $row['ID'] .'" class="card col-lg-10 delSubTag" style="padding: 20px;margin: 5px;">
                        <div class="row">
                            <div class="col-lg-6">
                                <h2>'. $row['subjectName'] .'</h2>
                            </div>
                            <div class="col-lg-6" style="text-align: right;">
                                '. $average .'
                            </div>
                        </div>
                        <br/>
                        
                        <div class="row">
                            <div class="col-lg-11" style="margin-left: auto; margin-right: auto;">
                            '. $grades .'
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-lg-6">
                                <a href="#" class="deleteSubject" subjectId="'. $row['ID'] .'">
                                    <span class="fa fa-trash-o delSubject" subjectId="'. $row['ID'] .'" aria-hidden="true" style="cursor: pointer; font-size: larger;"></span> Fach löschen
                                </a>
                            </div>
                            <div class="col-lg-6" style="text-align: right;">
                                '. $subjectSemester .'
                            </div>
                        </div>
                    </div>
                ';
                     
                $subjects = $subjects . $subjectEntry;
                            
            }
        } else {
            $subjects = "<p>Noch keine Fächer vorhanden.</p>";
            
            $sql3 = "SELECT * FROM `tb_semester` WHERE tb_group_ID = $session_usergroup";
            $result3 = $mysqli->query($sql3);
            $semesterList = "";
                
            if (isset($result3) && $result3->num_rows > 0) {
                    
                while($row3 = $result3->fetch_assoc()) {
                    $semesterList = $semesterList . "<option value='". $row3['ID'] ."'>". $row3['semester'] ."</option>";
                }
            }
        }
        
        //---------------------------------- Bestehende Fächer generieren ende ---------------------------------------
        
        
        
    ?>

    <h1 class="mt-5">Notensammlung</h1>
    <p></p>
    <div class="row">
        <div class="col-lg-1"></div>
        <div class="alert alert-success col-lg-10" id="addedNotif" style="display: none; margin-bottom: 0px;">
            <strong></strong> Eintrag wurde hinzugefügt.
        </div>
    </div>
    <div class="row">
        
        <?php echo $subjects; ?>
        
        <!-- Neues Fach hinzufügen -->
        <hr/>
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-1"></div>
                <div class="alert alert-success col-lg-10" id="addedNotif2" style="display: none; margin-bottom: 0px;">
                    <strong></strong> Fach wurde hinzugefügt.
                </div>
            </div>
        </div>
        <div class="col-lg-1"></div>
        <div class="col-lg-10 card" style="padding: 20px;margin: 5px;">
            <div class="row">
                <div class="col-lg-6">
                    <input type="text" id="newSubNam" class="form-control" placeholder="Fach">
                </div>
                <div class="col-lg-6">
                    <select class="form-control" id="newSubSem" placeholder="Zählt in Semester">
                        <option>Semester:</option>
                        <?php echo $semesterList; ?>
                    </select>
                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-12" style="margin-top: 10px;">
                    <button type="button" class="btn col-lg-12" id="addSubject">
                        <span class="fa fa-plus" aria-hidden="true" style="cursor: pointer;"></span><b> Neues Fach hinzufügen</b>
                    </button>
                    <br/><br/>
                    <div class="alert alert-danger" id="errorForm" style="display: none;" role="alert"></div>
                </div>
            </div>
        </div>
    </div>
    
    <script type="text/javascript" src="modul/noten/noten.js"></script>  

<?php elseif($session_usergroup == 5) : ?>

    <h1 class="mt-5">Alle Module</h1>
    <p>Sie sind Superuser</p>
    
<?php else : ?>
    
    <br/><br/>
    
    <div class='alert alert-danger'>
        <strong>Fehler </strong> Ihr Account wurde keiner Gruppe zugewiesen.
        Bitte wenden Sie sich an einen <a href='mailto:elia.reutlinger@baloise.ch'>Administrator</a>.
    </div>
    
<?php endif; ?>