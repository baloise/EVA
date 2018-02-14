<?php include("session/session.php"); ?>
<?php include("../database/connect.php"); ?>
<?php if($session_usergroup == 1) : ?>

    <head>
        <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.css">
	</head>

    <?php
    
        $listEntries = "";
    
        $sql = "SELECT ID, bKey, firstname, lastname FROM `tb_user` WHERE tb_group_ID IN (3, 4, 5) AND deleted IS NULL;";
        $result = $mysqli->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                
                $entry = '
                <div class="row">
                    <div class="card col-lg-12 userContentBox">
                        <div class="row header" userId="'.$row['ID'].'">
                            <div class="col-10">
                                <b>'.$row['firstname'].' '.$row['lastname'].' ('.$row['bKey'].')</b>
                            </div>
                            <div class="col-2 text-right">
                                <i class="fa fa-chevron-down" style="margin-top: 5px;" aria-hidden="true"></i>
                            </div>
                        </div>
                        <div class="row detailed" userId="'.$row['ID'].'" style="display: none;">
                            <div class="col-lg-12">
                                <hr/>
                            </div>
                            <div class="col-lg-12">
                                <div class="row loadContent" userId="'.$row['ID'].'" loaded="0">
                                    
                                    <div class="col-12 text-center">
                                        <img src="img/loading2_big.gif"/>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                ';
                
                $listEntries = $listEntries . $entry;
                
            }
        } else {
            $listEntries = "Keine Lehrlinge gefunden.";
        }
    
    ?>

    <h1 class="mt-5">Terminmanagement</h1>
    <p></p>
    
    <?php echo $listEntries; ?>
    
    <div class="row">
        <div class="col-12">
            <h1 class="mt-5">Termine bearbeiten</h1>
            
            <div class="alert alert-warning" role="alert" id="warning" style="display: none;">
                <strong>Termin löschen</strong> Bitte bestätigen Sie ihre auswahl:
                <button type="button" id="warnButton" style="background-color: inherit; color: #856404;" class="btn btn-warning">Bestätigen</button>
            </div>
            
            <div id="userTable" style="display: none;">
                <table id="users" class="display" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Titel</th>
                            <th>Beschreibung</th>
                            <th>Deadline</th>
                            <th>Gruppe</th>
                            <th>Semester</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="userTableBody">
                        <?php
                        
                            $sql ="
                            SELECT dead.ID AS did, dead.title AS Dtitel, dead.description AS Dbeschreibung, dead.date AS Ddeadline, sem.ID AS Sid, sem.semester AS Ssemester, grou.ID AS Gid, grou.name AS Gname FROM `tb_deadline` AS dead
                            INNER JOIN tb_semester AS sem ON dead.tb_semester_ID = sem.ID
                            INNER JOIN tb_group AS grou ON grou.ID = sem.tb_group_ID
                            ";
                            $sql2 ="SELECT ID, name FROM tb_group WHERE ID IN (3,4,5)";
                            
                            $groups = "";
                            
                            $result = $mysqli->query($sql);
                            $result2 = $mysqli->query($sql2);
                            
                            if ($result2->num_rows > 0) {
                                while($row = $result2->fetch_assoc()) {
                                    $groups = $groups . "<option value='". $row['ID'] ."'>". $row["name"] ."</option>";
                                }
                            } else {
                                $groups = "Keine Gruppen gefunden";
                            }
                
                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    
                                    $listSemsInList = "";
                                    
                                    $sql3 ="SELECT * FROM `tb_semester` WHERE tb_group_ID =" . $row['Gid'];
                                    $result3 = $mysqli->query($sql3);
                                    if ($result3->num_rows > 0) {
                                        while($row3 = $result3->fetch_assoc()) {
                                            $listSemsInList = $listSemsInList . "<option value='". $row3['ID'] ."'>". $row3["semester"] ."</option>";
                                        }
                                    } else {
                                        $listSemsInList = "Keine weiteren Semester vohanden.";
                                    }
                                    
                                    $generateDiv = '
                                    <tr id="rowID'. $row['did'] .'">
                                        <td>'. $row['did'] .' </td>
                                        <td><input fType="1" did="'. $row['did'] .'" class="form-control changeInTable" type="text" value="'. $row['Dtitel'] .'"></input></td>
                                        <td><textarea fType="2" did="'. $row['did'] .'" class="form-control changeInTable">'. $row['Dbeschreibung'] .'</textarea></td>
                                        <td><input fType="3" did="'. $row['did'] .'" class="form-control changeInTable" type="date" value="'. $row['Ddeadline'] .'"></input></td>
                                        <td><select fType="5" class="form-control changeInTable updateSems" did="'. $row['did'] .'"><option value="'. $row['Gid'] .'">'. $row['Gname'] .'</option>'.$groups.'</select></td>
                                        <td><select fType="4" class="form-control changeInTable inTableSelect" did="'. $row['did'] .'"><option value="'. $row['Sid'] .'">'. $row['Ssemester'] .'</option>'.$listSemsInList.'</select></td>
                                        <td class="text-center"><span style="cursor: pointer;" class="fa fa-trash-o removeDid" did="'. $row['did'] .'" aria-hidden="true"></span></td>
                                    </tr>
                                    ';
                                            
                                    echo $generateDiv;

                                }
                            } else {
                                $generateDiv = "<tr><td colspan='6'> Keine Daten gefunden. </td></tr>";
                                echo $generateDiv;
                            }
                        
                        ?>
                    
                    <tr id="rowID'. $row['did'] .'">
                        <td>Neu</td>
                        <td><input class="form-control " type="text" id="fTitle" placeholder="Titel" required></input></td>
                        <td><textarea class="form-control" id="fDescription" placeholder="Beschreibung" ></textarea></td>
                        <td><input class="form-control" id="fDeadline" type="date" placeholder="Deadline" required></input></td>
                        <td><select class="form-control updateSems"><option></option><?php echo $groups; ?></select></td>
                        <td><select class="form-control" id="fSemester" disabled required><option></option></select></td>
                        <td><button type="button" class="btn" id="addNewdid"><i class="fa fa-plus" aria-hidden="true"></i></button></td>
                    </tr>
                    </tbody>
                </table>
            </div>
            
            <div class="alert alert-success" id="changesSaveNotif" style="display: none;">
                <strong></strong> Änderungen wurden gespeichert!
            </div>
            
            <div id="loadingTable">
                <img class="img-responsive" src="img/loading2.gif"/>
            </div>
            
            <div class="alert alert-success col-lg-10" id="addedNotif" style="display: none; margin-bottom: 0px;">
                <strong></strong> Termin wurde hinzugefügt.
            </div>
            
            <div class="alert alert-danger" id="error" style="display: none;" role="alert"></div
            
            
            
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            $.getScript( "//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js", function() {
                $("#users").dataTable({
                    "columnDefs": [{
                        "targets": 6,
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
                $('#users_filter label').attr('placeholder', 'Suchen');
                $('#users_filter input').attr('placeholder', 'Suchen');
                $('#users_filter input').addClass('form-control');
                $('#loadingTable').slideUp("fast", function(){
                    $("#userTable").slideDown( "slow" );
                });   
            });
        });
    </script>

    <script type="text/javascript" src="modul/terminmanagement/modifyhr.js"></script> 
    
<?php elseif($session_usergroup == 2) : ?>

    <h1 class="mt-5">Alle PA-Module</h1>
    <p>Sie sind Praxisausbildner</p>
    
<?php elseif($session_usergroup == 3) : ?>

    <h1 class="mt-5">Alle IT-Module</h1>
    <p>Sie sind Informatik-Lehrling</p>

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