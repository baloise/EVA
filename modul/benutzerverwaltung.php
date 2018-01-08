<?php include("session/session.php"); ?>
<?php include("../database/connect.php"); ?>
<?php if($session_usergroup == 1) : ?>

    
    <head>
        <link rel="stylesheet" href="modul/benutzerverwaltung/benutzerverwaltung.css"/>
        <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.css">
	</head>
    
    
    
    <h1 class="mt-5">Benutzerverwaltung</h1>
    
    <div class="alert alert-warning" role="alert" id="warning" style="display: none;">
        <strong>Benutzer löschen</strong> Bitte bestätigen Sie ihre auswahl: <span id="useridWarn"></span>
        <button type="button" id="warnButton" style="background-color: inherit; color: #856404;" class="btn btn-warning">Bestätigen</button>
    </div>
    
    <div id="userTable" style="display: none;">
        <table id="users" class="display" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>B-Key</th>
                    <th>Gruppe</th>
                    <th>Vorname</th>
                    <th>Nachname</th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="userTableBody">
                <?php
                
                    $sql ="SELECT us.ID, us.bKey, gr.name, us.firstname, us.lastname, us.deleted FROM `tb_user` AS us JOIN tb_group AS gr ON gr.ID = us.tb_group_ID";
                    $sql2 ="SELECT ID, name FROM tb_group";
                    
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
                            if($row['deleted'] != 1){
                                $generateDiv = '
                                <tr id="rowID'. $row['ID'] .'">
                                    <td>'. $row['ID'] .' </td>
                                    <td>'. $row['bKey'] .'</td>
                                    <td><select fType="1" usrid="'. $row['ID'] .'" class="form-control" disabled><option>'. $row['name'] .'</option>'.$groups.'</select></td>
                                    <td><input fType="2" usrid="'. $row['ID'] .'" class="form-control changeInTable" type="text" value="'. $row['firstname'] .'"></input></td>
                                    <td><input fType="3" usrid="'. $row['ID'] .'" class="form-control changeInTable" type="text" value="'. $row['lastname'] .'"></input></td>
                                    <td><span class="fa fa-trash-o" bkey="'. $row['bKey'] .'" id="'. $row['ID'] .'" aria-hidden="true"></span></td>
                                </tr>
                                ';
                                    
                                echo $generateDiv;
                            }
                        }
                    } else {
                        echo "Keine Daten gefunden.";
                    }
                
                ?>
            </tbody>
        </table>
    </div>
    
    <div class="alert alert-success" id="changesSaveNotif" style="display: none;">
        <strong></strong> Änderungen wurden gespeichert!
    </div>
    
    <div id="loadingTable">
        <img class="img-responsive" src="img/loading2.gif"/>
    </div>
    
    <div id="editForm">
        <hr/>
        <br/>
        <h2>Benutzer hinzufügen:</h2>
        <form>
            <div class="alert alert-danger" id="error" style="display: none;"></div>
            <div class="alert alert-success" id="userAddedNotif" style="display: none;">
                <strong></strong> Benutzer wurde hinzugefügt.
            </div>
            <div class="row" id="addUserForm">
                <div class="col-lg-2">
                    <label for="usrFormBkey">B-Key:</label>
                    <input type="text" class="form-control addUserInput" id="usrFormBkey" maxlength="7" required>
                </div>
                <div class="col-lg-3">
                    <label for="usrFormGroup">Gruppe:</label>
                    <select class="form-control addUserInput" id="usrFormGroup" required><option value=""></option><?php echo $groups; ?></select>
                </div>
                <div class="col-lg-3">
                    <label for="usrFormFirstname">Vorname:</label>
                    <input type="text" class="form-control addUserInput" id="usrFormFirstname">
                </div>
                <div class="col-lg-3">
                    <label for="usrFormLastname">Nachname:</label>
                    <input type="text" class="form-control addUserInput" id="usrFormLastname">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <br/>
                    <button type="submit" href="#" id="addUser" class="btn btn-primary">Hinzufügen</a>
                </div>
            </div>
        </form>
    </div>
    
    
    
    <script type="text/javascript">
        $(document).ready(function() {
            $.getScript( "modul/benutzerverwaltung/benutzerverwaltung.js");
            $.getScript( "//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js", function() {
                $("#users").dataTable({
                    "columnDefs": [{
                        "targets": 5,
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
            
            
        } );
    </script>
    
      
<?php elseif($session_usergroup == 2 || $session_usergroup == 3 || $session_usergroup == 4 || $session_usergroup == 5) : ?>

    <br/><br/>

    <div class='alert alert-danger'>
        <strong>Fehler </strong> Sie haben keine Berechtigungen auf dieses Modul.
        Falls Sie dies für einen Fehler halten, wenden Sie sich bitte an einen <a href='mailto:elia.reutlinger@baloise.ch'>Administrator</a>.
    </div>
    
<?php else : ?>
    
    <br/><br/>
    
    <div class='alert alert-danger'>
        <strong>Fehler </strong> Ihr Account wurde keiner Gruppe zugewiesen.
        Bitte wenden Sie sich an einen <a href='mailto:elia.reutlinger@baloise.ch'>Administrator</a>.
    </div>
    
<?php endif; ?>