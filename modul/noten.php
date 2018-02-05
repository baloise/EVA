<?php include("session/session.php"); ?>
<?php if($session_usergroup == 1) : ?>

    <h1 class="mt-5">Alle HR-Module</h1>
    <p>Sie sind Nachwuchsentwicklung</p>
      
<?php elseif($session_usergroup == 2) : ?>

    <h1 class="mt-5">Alle PA-Module</h1>
    <p>Sie sind Praxisausbildner</p>
    
<?php elseif($session_usergroup == 3) : ?>

    <h1 class="mt-5">Notensammlung</h1>
    <p></p>
    <div class="row">
        
        <div class="col-lg-1"></div>
        <div class="card col-lg-10" style="padding: 20px;margin: 5px;">
            <div class="row">
                <div class="col-lg-6">
                    <h2>Mathematik</h2>
                </div>
                <div class="col-lg-6" style="text-align: right;">
                    <h2>Schnitt: 5.5</h2>
                </div>
            </div>
            <br/>
            
            <div class="row">
                <div class="col-lg-11" style="margin-left: auto; margin-right: auto;">
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
                            <tr>
                                <td>12.12.12</td>
                                <td>Lolalte</td>
                                <td>5.5</td>
                                <td>100%</td>
                                <td><span class="fa fa-trash-o delGrade" gradeId="'. $row['ID'] .'" aria-hidden="true" style="cursor: pointer;"></span></td>
                            </tr>
                            <tr>
                                <td>12.12.12</td>
                                <td>Lolalte</td>
                                <td>5.5</td>
                                <td>100%</td>
                                <td><span class="fa fa-trash-o delGrade" gradeId="'. $row['ID'] .'" aria-hidden="true" style="cursor: pointer;"></span></td>
                            </tr>
                            <tr>
                                <td>12.12.12</td>
                                <td>Lolalte</td> 
                                <td>5.5</td>
                                <td>100%</td>
                                <td><span class="fa fa-trash-o delGrade" gradeId="'. $row['ID'] .'" aria-hidden="true" style="cursor: pointer;"></span></td>
                            </tr>
                            <tr>
                                <td>12.12.12</td>
                                <td>Lolalte</td>
                                <td>5.5</td>
                                <td>100%</td>
                                <td><span class="fa fa-trash-o delGrade" gradeId="'. $row['ID'] .'" aria-hidden="true" style="cursor: pointer;"></span></td>
                            </tr>
                            <tr>
                                <td><button type="button" fSubject="'. $row['ID'] .'" class="btn addGrade" style="padding-bottom: 0px; padding-top: 0px; margin-top: 5px;"><span class="fa fa-plus" aria-hidden="true" style="cursor: pointer;"></span></button></td>
                                <td><input class="form-control fgradeTitle" type="text" placeholder="Titel"/></td>
                                <td><input class="form-control fgradeNote" type="number" placeholder="Note"/></td>
                                <td><input class="form-control fgradeWeight" type="number" placeholder="Gewichtung (in %)"/></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>  
                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-2">
                    <a href="#">
                        <span class="fa fa-trash-o delSubject" subjectId="'. $row['ID'] .'" aria-hidden="true" style="cursor: pointer; font-size: larger;"></span> Fach löschen
                    </a>
                </div>
                <div class="col-lg-10" style="text-align: right;">
                    Semester 5/8
                </div>
            </div>
        </div>
        
        <div class="col-lg-1"></div>
        <div class="card col-lg-10" style="padding: 20px;margin: 5px;">
            <div class="row">
                <div class="col-lg-6">
                    <h2>Mathematik</h2>
                </div>
                <div class="col-lg-6" style="text-align: right;">
                    <h2>Schnitt: 5.5</h2>
                </div>
            </div>
            <br/>
            
            <div class="row">
                <div class="col-lg-11" style="margin-left: auto; margin-right: auto;">
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
                            <tr>
                                <td>12.12.12</td>
                                <td>Lolalte</td>
                                <td>5.5</td>
                                <td>100%</td>
                                <td><span class="fa fa-trash-o delGrade" gradeId="'. $row['ID'] .'" aria-hidden="true" style="cursor: pointer;"></span></td>
                            </tr>
                            <tr>
                                <td>12.12.12</td>
                                <td>Lolalte</td>
                                <td>5.5</td>
                                <td>100%</td>
                                <td><span class="fa fa-trash-o delGrade" gradeId="'. $row['ID'] .'" aria-hidden="true" style="cursor: pointer;"></span></td>
                            </tr>
                            <tr>
                                <td>12.12.12</td>
                                <td>Lolalte</td> 
                                <td>5.5</td>
                                <td>100%</td>
                                <td><span class="fa fa-trash-o delGrade" gradeId="'. $row['ID'] .'" aria-hidden="true" style="cursor: pointer;"></span></td>
                            </tr>
                            <tr>
                                <td>12.12.12</td>
                                <td>Lolalte</td>
                                <td>5.5</td>
                                <td>100%</td>
                                <td><span class="fa fa-trash-o delGrade" gradeId="'. $row['ID'] .'" aria-hidden="true" style="cursor: pointer;"></span></td>
                            </tr>
                            <tr>
                                <td><button type="button" fSubject="'. $row['ID'] .'" class="btn addGrade" style="padding-bottom: 0px; padding-top: 0px; margin-top: 5px;"><span class="fa fa-plus" aria-hidden="true" style="cursor: pointer;"></span></button></td>
                                <td><input class="form-control fgradeTitle" type="text" placeholder="Titel"/></td>
                                <td><input class="form-control fgradeNote" type="number" placeholder="Note"/></td>
                                <td><input class="form-control fgradeWeight" type="number" placeholder="Gewichtung (in %)"/></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>  
                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-2">
                    <a href="#">
                        <span class="fa fa-trash-o delSubject" subjectId="'. $row['ID'] .'" aria-hidden="true" style="cursor: pointer; font-size: larger;"></span> Fach löschen
                    </a>
                </div>
                <div class="col-lg-10" style="text-align: right;">
                    Semester 5/8
                </div>
            </div>
        </div>
        
        <div class="col-lg-1"></div>
        <div class="card col-lg-10" style="padding: 20px;margin: 5px;">
            <div class="row">
                <div class="col-lg-6">
                    <h2>Mathematik</h2>
                </div>
                <div class="col-lg-6" style="text-align: right;">
                    <h2>Schnitt: 5.5</h2>
                </div>
            </div>
            <br/>
            
            <div class="row">
                <div class="col-lg-11" style="margin-left: auto; margin-right: auto;">
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
                            <tr>
                                <td>12.12.12</td>
                                <td>Lolalte</td>
                                <td>5.5</td>
                                <td>100%</td>
                                <td><span class="fa fa-trash-o delGrade" gradeId="'. $row['ID'] .'" aria-hidden="true" style="cursor: pointer;"></span></td>
                            </tr>
                            <tr>
                                <td>12.12.12</td>
                                <td>Lolalte</td>
                                <td>5.5</td>
                                <td>100%</td>
                                <td><span class="fa fa-trash-o delGrade" gradeId="'. $row['ID'] .'" aria-hidden="true" style="cursor: pointer;"></span></td>
                            </tr>
                            <tr>
                                <td>12.12.12</td>
                                <td>Lolalte</td> 
                                <td>5.5</td>
                                <td>100%</td>
                                <td><span class="fa fa-trash-o delGrade" gradeId="'. $row['ID'] .'" aria-hidden="true" style="cursor: pointer;"></span></td>
                            </tr>
                            <tr>
                                <td>12.12.12</td>
                                <td>Lolalte</td>
                                <td>5.5</td>
                                <td>100%</td>
                                <td><span class="fa fa-trash-o delGrade" gradeId="'. $row['ID'] .'" aria-hidden="true" style="cursor: pointer;"></span></td>
                            </tr>
                            <tr>
                                <td><button type="button" fSubject="'. $row['ID'] .'" class="btn addGrade" style="padding-bottom: 0px; padding-top: 0px; margin-top: 5px;"><span class="fa fa-plus" aria-hidden="true" style="cursor: pointer;"></span></button></td>
                                <td><input class="form-control fgradeTitle" type="text" placeholder="Titel"/></td>
                                <td><input class="form-control fgradeNote" type="number" placeholder="Note"/></td>
                                <td><input class="form-control fgradeWeight" type="number" placeholder="Gewichtung (in %)"/></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>  
                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-2">
                    <a href="#">
                        <span class="fa fa-trash-o delSubject" subjectId="'. $row['ID'] .'" aria-hidden="true" style="cursor: pointer; font-size: larger;"></span> Fach löschen
                    </a>
                </div>
                <div class="col-lg-10" style="text-align: right;">
                    Semester 5/8
                </div>
            </div>
        </div>
        
        
        <!-- Neues Fach hinzufügen -->
        <hr/>
        <div class="col-lg-1"></div>
        <div class="col-lg-10 card" style="padding: 20px;margin: 5px;">
            <div class="row">
                <div class="col-lg-6">
                    <input type="text" class="form-control" placeholder="Fach">
                </div>
                <div class="col-lg-6">
                    <input type="number" class="form-control" placeholder="Zählt in Semester">
                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-12" style="margin-top: 10px;">
                    <button type="button" class="btn col-lg-12"><span class="fa fa-plus" aria-hidden="true" style="cursor: pointer;"></span><b> Neues Fach hinzufügen</b></button>
                </div>
            </div>
        </div>
    </div>
    
    

<?php elseif($session_usergroup == 4) : ?>

    <h1 class="mt-5">Alle KV-Module</h1>
    <p>Sie sind KV-Lehrling</p>

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