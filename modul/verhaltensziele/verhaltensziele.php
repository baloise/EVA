<?php include("../session/session.php"); ?>
<?php include("../../database/connect.php"); ?>

<?php if($session_usergroup == 1 || $session_usergroup == 2) : //HR & PA ?>


    <head>
        <link rel="stylesheet" href="modul/benutzerverwaltung/benutzerverwaltung.css"/>
        <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.css">
	</head>

    <?php
		
		if($session_usergroup == 1){
			$sql = "SELECT bh.`stageName`, bh.`points`, bh.`creationDate`, us.firstname, us.lastname, bh.ID FROM `tb_behaviorgrade` AS bh
                LEFT JOIN tb_user AS us ON bh.`tb_userPA_ID` = us.ID
                WHERE us.deleted IS NULL ORDER BY bh.`creationDate` DESC LIMIT 800";
		} else {
			$sql = "SELECT bh.`stageName`, bh.`points`, bh.`creationDate`, us.firstname, us.lastname, bh.ID FROM `tb_behaviorgrade` AS bh
                LEFT JOIN tb_user AS us ON bh.`tb_userPA_ID` = us.ID
				WHERE bh.`tb_userPA_ID` = $session_userid AND us.deleted IS NULL ORDER BY bh.`creationDate` DESC LIMIT 800";
		} 
        
        $entryList = "";
        
        $result = $mysqli->query($sql);
        if ($result->num_rows > 0) {
            
            $i = 1;
            
            while($row = $result->fetch_assoc()) {
                
                $dateSet =  date("d.m.Y", strtotime($row['creationDate']));
                
                $sql2 = "SELECT bh.`stageName`, bh.`points`, bh.`creationDate`, us.firstname, us.lastname, bh.ID FROM `tb_behaviorgrade` AS bh
                LEFT JOIN tb_user AS us ON bh.`tb_userLL_ID` = us.ID WHERE bh.ID = ".$row['ID'];
                $result2 = $mysqli->query($sql2);
                $row2 = $result2->fetch_assoc();
                
                $listEntry = '
                <tr>
                    <td><button entryID="'. $row['ID'] .'"  entryPoints="'. $row['points'] .'" entryLL="'. $row2['firstname'] .' '. $row2['lastname'] .'" entryPA="'. $row['firstname'] .' '. $row['lastname'] .'" type="button" class="btn btn-warning checkEntry" style="padding-bottom: 0px; padding-top: 0px;"><b>!</b></button></td>
                    <th scope="row">'.$i.'</th>
                    <td>'. $row['stageName'] .'</td>
                    <td>'. $row['points'] .'</td>
                    <td>'. $row['firstname'] .' '. $row['lastname'] .'</td>
                    <td>'. $row2['firstname'] .' '. $row2['lastname'] .'</td>
                    <td>'. $dateSet .' </td>
                </tr>';
                
                $entryList = $entryList . $listEntry;
                $i = $i + 1;
                
            } 
        } else {
            $entryList = "Noch keine Einträge vorhanden.";
        }
    
    ?>

    <h1 class="mt-5">Verhaltensziele</h1>
    <p>Punktszahlen der Feedbacks zu Stagen. Eingetragen von den Lehrlingen.</p>
    
    <div id="loadingTable">
        <img class="img-responsive" src="img/loading2.gif"/>
    </div>
    
    <table class="table" id="dtmake" style="display: none;">
        <thead>
            <tr>
                <th></th>
                <th>#</th>
                <th>Stage</th>
                <th>Punktzahl</th>
                <th>PA</th>
                <th>Lehrling</th>
                <th>Erstellungsdatum</th>
            </tr>
        </thead>
        <tbody>
            <?php
                if($entryList){
                    echo $entryList;
                } else {
                    echo "<tr><td colspan='7' align='center'>Bisher keine Einträge<td></tr>";
                }
            ?>
        </tbody>
    </table>
	
	<div class="alert alert-success" id="checkedNotif" style="display: none; margin-bottom: 0px;"></div><br/>
    <div id="checkEntryForm" style="display: none;">
        <hr/>
        <div class="alert alert-danger" id="error" style="display: none;" role="alert"></div>
        <h3>Eintrag beanstanden</h3>
        <div class="row">
            <div class="col-lg-4">
                <label for="fcheckEntryPoints">Punktzahl</label>
                <input class="form-control" type="text" id="fcheckEntryPoints" value="" disabled/>
            </div>
            <div class="col-lg-4">
                <label for="fcheckEntryLL">Lehrling</label>
                <input class="form-control" type="text" id="fcheckEntryLL" value="" disabled/>
            </div>
            <div class="col-lg-4">
                <label for="fcheckEntryPA">PA</label>
                <input class="form-control" type="text" id="fcheckEntryPA" value="" disabled/>
            </div>
        </div>
        <br/>
        <div class="row">
            <div class="col-lg-12">
                <label for="fcheckEntryReason">Begründung</label>
                <textarea class="form-control" id="fcheckEntryReason"></textarea><br/>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <button type="button" entryID="" id="fsend" class="btn btn-primary">Abschicken</button>
                <?php if($session_usergroup == 1){echo '<button type="button" entryID="" id="fsendAndDelete" class="btn btn-danger">Abschicken & Eintrag löschen</button>';} ?>
            </div>
            <div class="col-lg-6">
                <button type="button" style="float: right;" id="finterrupt" class="btn btn-secondary">Abbrechen</button>
            </div>
        </div>
        <br/>
        <div class="row">
            <div class="col-lg-12">
                <p>Beim Abschicken werden die verantwortlichen Personen per E-Mail benachrichtigt, um den Eintrag zu überprüfen.</p>
            </div>
        </div>
    </div>
    
    <script type="text/javascript">
        $(document).ready(function() {
            $.getScript( "modul/benutzerverwaltung/benutzerverwaltung.js");
            $.getScript( "//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js", function() {
                $("#dtmake").dataTable({
                    "columnDefs": [{
                        "targets": 0,
                        "orderable": false
                    }],
                    "language": {
                        "sEmptyTable":      "Keine Daten in der Tabelle vorhanden",
                        "sInfo":            "_START_ bis _END_ von _TOTAL_ Einträgen",
                        "sInfoEmpty":       "0 bis 0 von 0 Einträgen",
                        "sInfoFiltered":    "(gefiltert von _MAX_ Einträgen)",
                        "sInfoPostFix":     "",
                        "sInfoThousands":   ".",
                        "sLengthMenu":      "_MENU_ Einträge anzeigen",
                        "sLoadingRecords":  "Wird geladen...",
                        "sProcessing":      "Bitte warten...",
                        "sSearch":          "",
                        "sZeroRecords":     "Keine Einträge vorhanden.",
                        "oPaginate": {
                            "sFirst":       "Erste",
                            "sPrevious":    "Zurück",
                            "sNext":        "Nächste",
                            "sLast":        "Letzte"
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
                $('#dtmake_filter label').attr('placeholder', 'Suchen');
                $('#dtmake_filter input').attr('placeholder', 'Suchen');
                $('#dtmake_filter input').addClass('form-control');
                $('#loadingTable').slideUp("fast", function(){
                    $("#dtmake").slideDown( "slow" );
                });
                
                
            });
            
            
        } );
    </script>

<?php elseif($session_usergroup == 3 || $session_usergroup == 4) : //IT-Lehrling & KV-Lehrling ?>

    <?php
        
        $date = date('d.m.Y');
        $paList = "";
        $sql = "SELECT firstname, lastname, id FROM tb_user WHERE tb_group_ID = 2;";
        
        $result = $mysqli->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
    
                $paListEntry = '<option value="'.$row["id"].'">'.$row["firstname"].' '.$row["lastname"].'</option>';
                $paList = $paList . utf8_encode($paListEntry);
    
            }
        }
        
        $sql = "SELECT bh.`stageName`, bh.`points`, bh.`creationDate`, us.firstname, us.lastname, bh.ID, sem.semester FROM `tb_behaviorgrade` AS bh
                LEFT JOIN tb_user AS us ON bh.`tb_userPA_ID` = us.ID
                INNER JOIN tb_semester AS sem ON sem.ID = bh.tb_semester_ID
                WHERE `tb_userLL_ID`= $session_userid;";
        
        $entryList = "";
        
        $result = $mysqli->query($sql);
        if ($result->num_rows > 0) {
            
            $i = 1;
            
            while($row = $result->fetch_assoc()) {
                
                $dateSet =  date("d.m.Y", strtotime($row['creationDate']));
                
                $listEntry = '
                <tr>
                    <th scope="row">'.$i.'</th>
                    <td>'. $row['stageName'] .'</td>
                    <td>'. $row['points'] .'</td>
                    <td>'. $row['firstname'] .' '. $row['lastname'] .'</td>
                    <td>'. $row['semester'] .'</td>
                    <td>'. $dateSet .' </td>
                </tr>';
                
                $entryList = $entryList . $listEntry;
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
            $semList = "<option>Keine Semester vorhanden.</option>";
        }
        
    ?>

    <h1 class="mt-5">Verhaltensziele</h1>
    <div class="alert alert-danger" id="error" style="display: none;" role="alert"></div>
    <p>Diese Punktzahlen sind Leistungslohnrelevant. Bitte achte auf die Korrektheit deiner Einträge, es können Stichproben durchgeführt werden.</p>
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Stage</th>
                <th>Punktzahl</th>
                <th>PA</th>
                <th>Semester</th>
                <th>Erstellungsdatum</th>
            </tr>
        </thead>
        <tbody>
            <?php if($entryList){echo $entryList;}else{echo "Du hast bisher nichts eingetragen.";} ?>
            <tr id="newEntry">
                <th scope="row" style="padding-top: 20px;">#</th>
                <td><input class="form-control" type="text" id="fStage"/></td>
                <td><input class="form-control" type="number" id="fPoints"/></td>
                <td>
                    <select class="form-control" id="fPa">
                        <option></option>
                        <?php echo $paList; ?>
                    </select>
                </td>
                <td>
                    <select class="form-control" id="fSem">
                        <option></option>
                        <?php echo $semList; ?>
                    </select>
                </td>
                <td style="padding-top: 20px;"><?php echo $date; ?></td>
            </tr>
            <tr>
                <td colspan="6" align="center">
                    <div class="alert alert-success" id="addedNotif" style="display: none; margin-bottom: 0px;">
                        <strong></strong> Eintrag wurde hinzugefügt.
                    </div><br/>
                    <div class="alert alert-warning" id="warnEntry" style="display: none; margin-bottom: 0px;">
                        Sind alle Angaben korrekt? Du kannst den Eintrag nach dem Bestätigen nicht mehr bearbeiten <strong>
                        <i class="fa fa-arrow-right" aria-hidden="true"></i> Es können Stichproben durchgeführt werden.</strong>
                    </div><br/>
                    <button id="addNewEntryButton" type="button" class="btn btn-primary">Eintrag hinzufügen</button>
                </td>
            </tr>
        </tbody>
    </table>

<?php elseif($session_usergroup == 5) :  //Superuser?>

    <h1 class="mt-5">Verhaltensziele</h1>
    <p>Sie sind Superuser. Sie können nichts.</p>

<?php else : //No Usergroup ?>
    
    <br/><br/>
    
    <div class='alert alert-danger'>
        <strong>Fehler </strong> Ihr Account wurde keiner Gruppe zugewiesen.
        Bitte wenden Sie sich an einen <a href='mailto:elia.reutlinger@baloise.ch'>Administrator</a>.
    </div>
    
<?php endif; ?>

<script type="text/javascript" src="modul/verhaltensziele/verhaltensziele.js"></script>