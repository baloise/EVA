<?php include("session/session.php"); ?>
<?php include("../database/connect.php"); ?>
<?php if($session_usergroup == 1) : ?>

    <?php
    
        $sql = "SELECT ID, firstname, lastname FROM `tb_user` WHERE tb_group_ID = 3 OR tb_group_ID = 4 AND deleted IS NULL";
        
        $result = $mysqli->query($sql);
        if ($result->num_rows > 0) {
            
            $llist = "";
            
            while($row = $result->fetch_assoc()) {
                
                $entry = "<option value='". $row['ID'] ."'>". $row['firstname'] ." ". $row['lastname'] ."</option>";
                
                $llist = $llist . $entry;
                
            }
        
        } else {
            $llist = "Keine Lehrlinge im System";
        }
        
        $entryList = "Noch keine Einträge";
        
        $sql = "SELECT ml.`description`, ml.`creationDate`, ml.weight, ml.ID FROM `tb_malus` AS ml
                LEFT JOIN tb_user AS us ON us.ID = ml.tb_user_ID
                WHERE us.deleted IS NULL ORDER BY ml.`creationDate` DESC LIMIT 400;";
        
        $entryList = "";
        
        $result = $mysqli->query($sql);
        if ($result->num_rows > 0) {
            
            while($row = $result->fetch_assoc()) {
                
                $dateSet =  date("d.m.Y", strtotime($row['creationDate']));
                
                $sql2 = "SELECT us.firstname, us.lastname FROM `tb_malus` AS ml
                LEFT JOIN tb_user AS us ON ml.`tb_user_ID` = us.ID WHERE ml.ID = " . $row['ID'];
                $result2 = $mysqli->query($sql2);
                $row2 = $result2->fetch_assoc();
                
                $listEntry = '
                <tr class="lEntry" entryID="'. $row['ID'] .'">
                    <td><span class="fa fa-trash-o delEntry" entryID="'. $row['ID'] .'" aria-hidden="true" style="cursor: pointer;"></span></td>
                    <th scope="row">'. $row['ID'] .'</th>
                    <td>'. $row['weight'] .' %</td>
                    <td>'. $row2['firstname'] .' '. $row2['lastname'] .'</td>
                    <td>'. $row['description'] .'</td>
                    <td>'. $dateSet .' </td>
                </tr>';
                
                $entryList = $entryList . $listEntry;
                
            }
        } else {
            $entryList = "Noch keine Einträge";
        }
    
    ?>
    
    <head>
        <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.css">
	</head>

    <h1 class="mt-5">Malus</h1>
    <p>Malus-Werte für Lehrlinge definieren.</p>
    <div class="alert alert-danger" id="error" style="display: none;" role="alert"></div>
    <div class="alert alert-success" id="addedNotif" style="display: none; margin-bottom: 0px;">
        <strong></strong> Eintrag wurde hinzugefügt.
    </div><br/>
    <div class="col-lg-12 card">
        <div class="row">
            <div class="col-lg-12">
                <br/>
                <h3>Neuen Malus eintragen</h3>
                <hr/>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <label for="fselUser">Lehrling:</label>
                <select id="fselUser" class="form-control">
                    <option></option>
                    <?php echo $llist; ?>
                </select>
            </div>
            <div class="col-lg-6">
                <label for="fweigth">Gewichtung:</label>
                <input id="fweigth" class="form-control" type="text" placeholder="%"/>
            </div>
        </div>
        <br/>
        <div class="row">
            <div class="col-lg-12">
                <label for="freasoning">Begründung</label>
                <textarea id="freasoning" class="form-control"></textarea>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <br/>
                <button type="button" id="fsenMal" class="btn btn-primary">Abschicken</button>
                <br/><br/>
            </div>
        </div>
    </div>
    
    <div class="col-lg-12">
        <hr/>
        <h3>Definierte Werte</h3>
        <br/>
    </div>
    
    <div id="loadingTable">
        <img class="img-responsive" src="img/loading2.gif"/>
    </div>
    
    <table class="table" id="dtmake" style="display: none;">
        <thead>
            <tr>
                <th></th>
                <th>#</th>
                <th>Gewichtung</th>
                <th>Lehrling</th>
                <th>Begründung</th>
                <th>Erstellungsdatum</th>
            </tr>
        </thead>
        <tbody>
            <?php
                if($entryList){
                    echo $entryList;
                } else {
                    echo "<tr><td colspan='7' align='center'>Bisher keine Einträge</td></tr>";
                }
            ?>
        </tbody>
    </table>
    
    <script type="text/javascript">
        $(document).ready(function() {
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
      
    <script type="text/javascript" src="modul/malus/malus.js"></script>  
    
<?php elseif($session_usergroup != 1) : ?>

    <h1 class="mt-5">Berechtigung fehlt</h1>
    <p>Sie haben keine Berechtigungen für dieses Modul. Falls dies ein Fehler ist, wenden Sie sich an einen <a href='mailto:elia.reutlinger@baloise.ch'>Administrator</a>.</p>
    
<?php else : ?>
    
    <br/><br/>
    
    <div class='alert alert-danger'>
        <strong>Fehler </strong> Ihr Account wurde keiner Gruppe zugewiesen.
        Bitte wenden Sie sich an einen <a href='mailto:elia.reutlinger@baloise.ch'>Administrator</a>.
    </div>
    
<?php endif; ?>