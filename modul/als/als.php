<?php include("../session/session.php"); ?>
<?php include("../../database/connect.php"); ?>

<?php if($session_usergroup == 1) : ?>

    <h1 class="mt-5">ALS</h1>
    
    <head>
        <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.css">
	</head>

    <?php
		
		$sql = "SELECT pr.`title`, pr.`points`, pr.`creationDate`, pr.ID, pr.performance FROM `tb_als` AS pr
                LEFT JOIN tb_user AS us ON us.ID = pr.tb_user_ID
                WHERE us.deleted IS NULL ORDER BY pr.`creationDate` DESC LIMIT 400;";
        
        $entryList = "";
        
        $result = $mysqli->query($sql);
        if ($result->num_rows > 0) {
            
            $i = 1;
            
            while($row = $result->fetch_assoc()) {
                
                $dateSet =  date("d.m.Y", strtotime($row['creationDate']));
                
                $sql2 = "SELECT us.firstname, us.lastname FROM `tb_als` AS pr
                LEFT JOIN tb_user AS us ON pr.`tb_user_ID` = us.ID WHERE pr.ID = " . $row['ID'];
                $result2 = $mysqli->query($sql2);
                $row2 = $result2->fetch_assoc();
                
                if($row['performance'] == 1){
                    $performance = $translate["Leistungsziele"];
                } else {
                    $performance = $translate["Verhaltensziele"];
                }
                
                $listEntry = '
                <tr>
                    <td><button entryID="'. $row['ID'] .'"  entryPoints="'. $row['points'] .'" entryLL="'. $row2['firstname'] .' '. $row2['lastname'] .'" type="button" class="btn btn-warning checkEntry" style="padding-bottom: 0px; padding-top: 0px;"><b>!</b></button></td>
                    <th scope="row">'.$i.'</th>
                    <td>'. $row['title'] .'</td>
                    <td>'. $row['points'] .'</td>
                    <td>'. $row2['firstname'] .' '. $row2['lastname'] .'</td>
                    <td>'.$performance.'</td>
                    <td>'. $dateSet .' </td>
                </tr>';
                
                $entryList = $entryList . $listEntry;
                $i = $i + 1;
                
            }
        } else {
            $entryList = $translate["Noch keine Einträge"];
        }
    
    ?>
    
    <div id="loadingTable">
        <img class="img-responsive" src="img/loading2.gif"/>
    </div>
    
    <table class="table" id="dtmake" style="display: none;">
        <thead>
            <tr>
                <th></th>
                <th>#</th>
                <th><?php echo $translate["ALS-Titel"]; ?></th>
                <th><?php echo $translate["Punktzahl"]; ?></th>
                <th><?php echo $translate["Lernende/r"]; ?></th>
                <th><?php echo $translate["Typ"]; ?></th>
                <th><?php echo $translate["Erstellungsdatum"]; ?></th>
            </tr>
        </thead>
        <tbody>
            <?php
                if($entryList){
                    echo $entryList;
                } else {
                    echo "<tr><td colspan='7' align='center'>". $translate["Bisher keine Einträge"]."</td></tr>";
                }
            ?>
        </tbody>
    </table>
	
	<div class="alert alert-success" id="checkedNotif" style="display: none; margin-bottom: 0px;"></div><br/>
    <div id="checkEntryForm" style="display: none;">
        <hr/>
        <div class="alert alert-danger" id="error" style="display: none;" role="alert"></div>
        <h3><?php echo $translate["Eintrag beanstanden"];?></h3>
        <div class="row">
            <div class="col-lg-6">
                <label for="fcheckEntryPoints"><?php echo $translate["Punktzahl"];?></label>
                <input class="form-control" type="text" id="fcheckEntryPoints" value="" disabled/>
            </div>
            <div class="col-lg-6">
                <label for="fcheckEntryLL"><?php echo $translate["Lernende/r"];?></label>
                <input class="form-control" type="text" id="fcheckEntryLL" value="" disabled/>
            </div>
        </div>
        <br/>
        <div class="row">
            <div class="col-lg-12">
                <label for="fcheckEntryReason"><?php echo $translate["Begründung"];?></label>
                <textarea class="form-control" id="fcheckEntryReason"></textarea><br/>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <button type="button" entryID="" id="fsend" class="btn btn-primary"><?php echo $translate["Abschicken"];?></button>
                <?php if($session_usergroup == 1){echo '<button type="button" entryID="" id="fsendAndDelete" class="btn btn-danger">'.$translate["Abschicken"].' & '.$translate["Eintrag löschen"].'</button>';} ?>
            </div>
            <div class="col-lg-6">
                <button type="button" style="float: right;" id="finterrupt" class="btn btn-secondary"><?php echo $translate["Abbrechen"];?></button>
            </div>
        </div>
        <br/>
        <div class="row">
            <div class="col-lg-12">
                <p><?php echo $translate["Beim Abschicken werden die verantwortlichen Personen per E-Mail benachrichtigt, um den Eintrag zu überprüfen."];?></p>
            </div>
        </div>
    </div>
    
    <script type="text/javascript">
        $(document).ready(function() {
            $.getScript( "//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js", function() {
                $("#dtmake").dataTable({
                    "columnDefs": [{
                        "targets": 0,
                        "orderable": false
                    }],
                    "language": {
                        "sEmptyTable":      "<?php echo $translate["Keine Daten in der Tabelle vorhanden"];?>",
                        "sInfo":            "_START_ <?php echo $translate["bis"];?> _END_ <?php echo $translate["von"];?> _TOTAL_ <?php echo $translate["Einträgen"];?>",
                        "sInfoEmpty":       "0 <?php echo $translate["bis"];?> 0 <?php echo $translate["von"];?> 0 <?php echo $translate["Einträgen"];?>",
                        "sInfoFiltered":    "(gefiltert von _MAX_ Einträgen)",
                        "sInfoPostFix":     "",
                        "sInfoThousands":   ".",
                        "sLengthMenu":      "_MENU_ <?php echo $translate["Einträge anzeigen"];?>",
                        "sLoadingRecords":  "Wird geladen...",
                        "sProcessing":      "Bitte warten...",
                        "sSearch":          "",
                        "sZeroRecords":     "<?php echo $translate["Keine Einträge vorhanden"];?>.",
                        "oPaginate": {
                            "sFirst":       "<?php echo $translate["Erste"];?>",
                            "sPrevious":    "<?php echo $translate["Zurück"];?>",
                            "sNext":        "<?php echo $translate["Nächste"];?>",
                            "sLast":        "<?php echo $translate["Letzte"];?>"
                        },
                        "oAria": {
                            "sSortAscending":  ": aktivieren, um Spalte aufsteigend zu sortieren",
                            "sSortDescending": ": aktivieren, um Spalte absteigend zu sortieren"
                        },
                        select: {
                                rows: {
                                _: '%d Zeilen ausgewählt',
                                0: 'Zum Auswählen auf eine Zeile klicken',
                                1: '1 Zeile ausgewählt'
                                }
                        }
                    }
                });
                $('#users_filter input').attr('placeholder', '<?php echo $translate["Suchen"];?>');
                $('#users_filter input').addClass('form-control');
                $('#loadingTable').slideUp("fast", function(){
                    $("#dtmake").slideDown( "slow" );
                });   
            });
        });
    </script>

<?php elseif($session_usergroup == 4 || $session_usergroup == 5) : ?>

    <h1 class="mt-5"><?php echo $translate["ALS"]; ?></h1>
    
    <?php
        
        $sql = "SELECT pres.*, sem.semester FROM `tb_als` AS pres
                INNER JOIN tb_semester AS sem ON sem.ID = pres.tb_semester_ID
                WHERE `tb_user_ID`= $session_userid;";
        
        $entryListPerf = "";
        $entryList = "";
        
        $result = $mysqli->query($sql);
        if ($result->num_rows > 0) {
            
            $i = 1;
            
            while($row = $result->fetch_assoc()) {
                
                $dateSet =  date("d.m.Y", strtotime($row['creationDate']));
                
                $listEntry = '
                <tr>
                    <th scope="row">'.$i.'</th>
                    <td>'. $row['title'] .'</td>
                    <td>'. $row['points'] .'</td>
                    <td>'. $row['semester'] .'</td>
                    <td>'. $dateSet .' </td>
                </tr>';
                
                
                if($row['performance'] == 1){
                    $entryListPerf = $entryListPerf . $listEntry;
                } else {
                    $entryList = $entryList . $listEntry;
                }
                
                $i = $i + 1;
                
            }
        }
        
        $semList = "";
        $semSql = "SELECT ID, semester FROM `tb_semester` WHERE tb_group_ID = $session_usergroup";
        $semResult = $mysqli->query($semSql);
        if ($semResult->num_rows > 0) {
            while($semRow = $semResult->fetch_assoc()) {
                $semList = $semList . "<option value='". $semRow['ID'] ."'>". $semRow['semester'] ."</option>";
            }
        } else {
            $semList = "<option>". $translate["Keine Semester vorhanden"] .".</option>";
        }
        
    ?>
    
    <p><?php echo $translate["Diese Punktzahlen sind Leistungslohnrelevant. Bitte achte auf die Korrektheit deiner Einträge, es können Stichproben durchgeführt werden."];?></p>
    
    <div class="alert alert-danger" id="errorPerf" style="display: none;" role="alert"></div>
    <div class="card col-12" style="padding-top: 15px; margin-bottom: 10px;">
        <h2><?php echo $translate["ALS-Leistungsziele"]; ?></h2>
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th><?php echo $translate["ALS-Titel"];?></th>
                    <th><?php echo $translate["Punktzahl"];?></th>
                    <th><?php echo $translate["Semester"];?></th>
                    <th><?php echo $translate["Erstellungsdatum"];?></th>
                </tr>
            </thead>
            <tbody>
                <?php if($entryListPerf){echo $entryListPerf;} else {echo $translate["Du hast bisher nichts eingetragen."];} ?>
                <tr id="newEntry">
                    <th scope="row" style="padding-top: 20px;">#</th>
                    <td><input class="form-control" type="text" id="fTitlePerf"/></td>
                    <td><input class="form-control" type="number" id="fPointsPerf"/></td>
                    <td>
                        <select class="form-control" id="fSemPerf">
                            <option></option>
                            <?php echo $semList; ?>
                        </select>
                    </td>
                    <td style="padding-top: 20px;"><?php echo date("d.m.Y"); ?></td>
                </tr>
                <tr>
                    <td colspan="6" align="center">
                        <div class="alert alert-success" id="addedNotifPerf" style="display: none; margin-bottom: 0px;">
                            <strong></strong> <?php echo $translate["Eintrag wurde hinzugefügt"];?>.
                        </div><br/>
                        <div class="alert alert-warning" id="warnEntryPerf" style="display: none; margin-bottom: 0px;">
                            <?php echo $translate["Sind alle Angaben korrekt? Du kannst den Eintrag nach dem Bestätigen nicht mehr bearbeiten"];?> <strong>
                            <i class="fa fa-arrow-right" aria-hidden="true"></i> <?php echo $translate["Es können Stichproben durchgeführt werden"];?>.</strong>
                        </div><br/>
                        <button id="addNewEntryButtonPerf" type="button" class="btn btn-primary"><?php echo $translate["Eintrag hinzufügen"];?></button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    
    <div class="alert alert-danger" id="error" style="display: none;" role="alert"></div>
    <div class="card col-12" style="padding-top: 15px;">
        <h2><?php echo $translate["ALS-Verhaltensziele"];?>:</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th><?php echo $translate["ALS-Titel"];?></th>
                    <th><?php echo $translate["Punktzahl"];?></th>
                    <th><?php echo $translate["Semester"];?></th>
                    <th><?php echo $translate["Erstellungsdatum"];?></th>
                </tr>
            </thead>
            <tbody>
                <?php if($entryList){echo $entryList;} else {echo $translate["Du hast bisher nichts eingetragen"];} ?>
                <tr id="newEntry">
                    <th scope="row" style="padding-top: 20px;">#</th>
                    <td><input class="form-control" type="text" id="fTitle"/></td>
                    <td><input class="form-control" type="number" id="fPoints"/></td>
                    <td>
                        <select class="form-control" id="fSem">
                            <option></option>
                            <?php echo $semList; ?>
                        </select>
                    </td>
                    <td style="padding-top: 20px;"><?php echo date("d.m.Y"); ?></td>
                </tr>
                <tr>
                    <td colspan="6" align="center">
                        <div class="alert alert-success" id="addedNotif" style="display: none; margin-bottom: 0px;">
                            <strong></strong> <?php echo $translate["Eintrag wurde hinzugefügt"];?>.
                        </div><br/>
                        <div class="alert alert-warning" id="warnEntry" style="display: none; margin-bottom: 0px;">
                            <?php echo $translate[""];?> <strong>
                            <i class="fa fa-arrow-right" aria-hidden="true"></i> <?php echo $translate["Es können Stichproben durchgeführt werden"];?>.</strong>
                        </div><br/>
                        <button id="addNewEntryButton" type="button" class="btn btn-primary"><?php echo $translate["Eintrag hinzufügen"];?></button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    
<?php else : ?>
    
    <br/><br/>
    
    <div class='alert alert-danger'>
        <strong><?php echo $translate["Fehler"];?> </strong> <?php echo $translate["Ihr Account wurde keiner Gruppe zugewiesen, oder Ihnen fehlen Rechte"];?>.
    </div>
    
<?php endif; ?>

<script type="text/javascript" src="modul/als/als.js"></script>