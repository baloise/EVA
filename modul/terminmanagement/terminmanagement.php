<?php include("../session/session.php"); ?>
<?php include("../../database/connect.php"); ?>
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

    <h1 class="mt-5"><?php echo $translate["Terminmanagement"];?></h1>
    <p></p>
    
    <?php echo $listEntries; ?>
    
    <div class="row">
        <div class="col-12">
            <h1 class="mt-5"><?php echo $translate["Termine bearbeiten"];?></h1>
            
            <div class="alert alert-warning" role="alert" id="warning" style="display: none;">
                <strong><?php echo $translate["Termin löschen"];?></strong> <?php echo $translate["Bitte bestätigen Sie ihre auswahl"];?>:
                <button type="button" id="warnButton" style="background-color: inherit; color: #856404;" class="btn btn-warning"><?php echo $translate["Bestätigen"];?></button>
            </div>
            
            <div id="userTable" style="display: none;">
                <table id="users" class="display" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th><?php echo $translate["Titel"];?></th>
                            <th><?php echo $translate["Beschreibung"];?></th>
                            <th><?php echo $translate["Deadline"];?></th>
                            <th><?php echo $translate["Gruppe"];?></th>
                            <th><?php echo $translate["Semester"];?></th>
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
                                    $groups = $groups . "<option value='". $row['ID'] ."'>". $translate[$row["name"]] ."</option>";
                                }
                            } else {
                                $groups = $translate["Keine Gruppen gefunden"];
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
                                        $listSemsInList = $translate["Keine weiteren Semester vohanden"].".";
                                    }
                                    
                                    $generateDiv = '
                                    <tr class="rowID'. $row['did'] .'">
                                        <td>'. $row['did'] .' </td>
                                        <td><input fType="1" did="'. $row['did'] .'" class="form-control changeInTable" type="text" value="'. $row['Dtitel'] .'"></input></td>
                                        <td><textarea fType="2" did="'. $row['did'] .'" class="form-control changeInTable">'. $row['Dbeschreibung'] .'</textarea></td>
                                        <td><input fType="3" did="'. $row['did'] .'" class="form-control changeInTable" type="date" value="'. $row['Ddeadline'] .'"></input></td>
                                        <td><select fType="5" class="form-control changeInTable updateSems" did="'. $row['did'] .'"><option value="'. $row['Gid'] .'">'. $translate[$row['Gname']] .'</option>'.$groups.'</select></td>
                                        <td><select fType="4" class="form-control changeInTable inTableSelect" did="'. $row['did'] .'"><option value="'. $row['Sid'] .'">'. $row['Ssemester'] .'</option>'.$listSemsInList.'</select></td>
                                        <td class="text-center"><span style="cursor: pointer;" class="fa fa-trash-o removeDid" did="'. $row['did'] .'" aria-hidden="true"></span></td>
                                    </tr>
                                    ';
                                            
                                    echo $generateDiv;

                                }
                            } else {
                                $generateDiv = "<tr><td colspan='6'> ".$translate["Keine Daten gefunden"].". </td></tr>";
                                echo $generateDiv;
                            }
                        
                        ?>
                    
                    <tr id="rowID'. $row['did'] .'">
                        <td>Neu</td>
                        <td><input class="form-control " type="text" id="fTitle" placeholder="<?php echo $translate["Titel"];?>" required></input></td>
                        <td><textarea class="form-control" id="fDescription" placeholder="<?php echo $translate["Beschreibung"];?>" ></textarea></td>
                        <td><input class="form-control" id="fDeadline" type="date" placeholder="<?php echo $translate["Deadline"];?>" required></input></td>
                        <td><select class="form-control updateSems"><option></option><?php echo $groups; ?></select></td>
                        <td><select class="form-control" id="fSemester" disabled required><option></option></select></td>
                        <td><button type="button" class="btn" id="addNewdid"><i class="fa fa-plus" aria-hidden="true"></i></button></td>
                    </tr>
                    </tbody>
                </table>
            </div>
            
            <div class="alert alert-success" id="changesSaveNotif" style="display: none;">
                <strong></strong> <?php echo $translate["Änderungen wurden gespeichert"];?>!
            </div>
            
            <div id="loadingTable">
                <img class="img-responsive" src="img/loading2.gif"/>
            </div>
            
            <div class="alert alert-success col-lg-10" id="addedNotif" style="display: none; margin-bottom: 0px;">
                <strong></strong> <?php echo $translate["Termin wurde hinzugefügt"];?>.
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
                    $("#userTable").slideDown( "slow" );
                });   
            });
        });
    </script>

    <script type="text/javascript" src="modul/terminmanagement/modifyhr.js"></script> 
    
    
<?php elseif($session_usergroup == 3 || $session_usergroup == 4 || $session_usergroup == 5) : ?>

    <h1 class="mt-5"><?php echo $translate["Terminmanagement"];?></h1>
    
    
    
    <?php
    
        $sql = "SELECT * FROM `tb_semester` AS sem WHERE sem.tb_group_ID = $session_usergroup";
        $result = $mysqli->query($sql);
        
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                
                $semesterid = $row['ID'];
                $semesterTitle = $row['semester'];
                $today = date("Y-m-d");
                $entriesBefore = "";
                $entriesPassed = "";
                
                $sql2 = "SELECT * FROM `tb_deadline` WHERE tb_semester_ID = $semesterid;";
                $result2 = $mysqli->query($sql2);
        
                if ($result2->num_rows > 0) {
                    while($row2 = $result2->fetch_assoc()) {
                        
                        $deadlineID = $row2['ID'];
                        $deadlineTitle = $row2['title'];
                        $deadlineDescription = $row2['description'];
                        $deadlineDate = $row2['date'];
                        
                        $sql3 = "SELECT * FROM `tb_deadline_check` WHERE tb_deadline_ID = $deadlineID AND tb_user_ID = $session_userid;";
                        $result3 = $mysqli->query($sql3);
                        
                        if ($result3->num_rows > 0) {

                            $entry = '
                                <div class="row">
                                    <div class="col-lg-12 card alert-success" style="padding-top: 10px; margin-bottom: 10px;">
                                        <h3>'.$deadlineTitle.'</h3>
                                        <p>'.$deadlineDescription.'</p>
                                        <p>'.$translate["Ablaufdatum"].': <b>'.date("d.m.Y", strtotime($deadlineDate)).'</b></p>
                                    </div>
                                </div>
                            ';
                            if($deadlineDate < $today){
                                $entriesPassed = $entriesPassed . $entry;
                            } else {
                                $entriesBefore = $entriesBefore . $entry;
                            }
                            
                        } else {
                            if($deadlineDate < $today){
                                
                                $entry = '
                                    <div class="row">
                                        <div class="col-lg-12 card alert-danger" style="padding-top: 10px; margin-bottom: 10px;">
                                            <h3>'.$deadlineTitle.'</h3>
                                            <p>'.$deadlineDescription.'</p>
                                            <p>'.$translate["Ablaufdatum"].': <b>'.date("d.m.Y", strtotime($deadlineDate)).'</b></p>
                                        </div>
                                    </div>
                                ';
                                
                                $entriesPassed = $entriesPassed . $entry;
                                
                            } else {
                                $entry = '
                                    <div class="row">
                                        <div class="col-lg-12 card" style="padding-top: 10px; margin-bottom: 10px;">
                                            <h3>'.$deadlineTitle.'</h3>
                                            <p>'.$deadlineDescription.'</p>
                                            <p>'.$translate["Ablaufdatum"].': <b>'.date("d.m.Y", strtotime($deadlineDate)).'</b></p>
                                        </div>
                                    </div>
                                ';
                                
                                $entriesBefore = $entriesBefore . $entry;
                                
                            }
                        }
                        
                    }
                } else {
                    $entriesBefore = $translate["Keine Einträge"];
                    $entriesPassed = $translate["Keine Einträge"];
                }
                
                
            
                $entry = '
                    <div class="divtoggler" subSemid="'.$semesterid.'" style="cursor:pointer;">
                        <hr/>
                        <div class="row">
                            <div class="col-lg-10">
                                <h2>'.$translate["Semester"].' '.$semesterTitle.'</h2>
                            </div>
                            <div class="col-lg-2 text-right">
                                <i class="fa fa-chevron-down toggleDetails" style="margin-top: 5px;" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                    <div class="divtogglercontent" style="display:none;" subSemid="'.$semesterid.'">
                        <div class="row">
                            <div class="col-12">
                                <hr/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <h2>'.$translate["Bevorstehende Termine"].':</h2>
                            </div>
                            <div class="col-12">
                                '.$entriesBefore.'
                            </div>
                            <div class="col-12">
                                <br/><br/>
                                <h2>'.$translate["Vergangene Termine"].':</h2>
                            </div>
                            <div class="col-12">
                                '.$entriesPassed.'
                            </div>
                        </div>
                    </div>
                ';
                
                echo $entry;
            
            }
        }
        
    
    ?>
    
    <script type="text/javascript" src="modul/terminmanagement/modifyll.js"></script> 
    
<?php else : ?>
    
    <br/><br/>
    
    <div class='alert alert-danger'>
        <strong><?php echo $translate["Fehler"];?> </strong> <?php echo $translate["Ihr Account wurde keiner Gruppe zugewiesen, oder Ihnen fehlen Rechte"];?>.
    </div>
    
<?php endif; ?>