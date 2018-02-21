<?php include("../session/session.php"); ?>
<?php include("../../database/connect.php"); ?>
<?php if($session_usergroup == 1) : ?>

    <?php

        $sql = "SELECT ID, firstname, lastname FROM `tb_user` WHERE tb_group_ID IN (3, 4, 5) AND deleted IS NULL";

        $result = $mysqli->query($sql);
        if ($result->num_rows > 0) {

            $llist = "";

            while($row = $result->fetch_assoc()) {

                $entry = "<option value='". $row['ID'] ."'>". $row['firstname'] ." ". $row['lastname'] ."</option>";

                $llist = $llist . $entry;

            }

        } else {
            $llist = $translate["Keine Lehrlinge im System"];
        }


        $sql = "SELECT ml.`description`, ml.`creationDate`, ml.weight, ml.ID, us.firstname, us.lastname, sem.semester FROM `tb_malus` AS ml
                LEFT JOIN tb_user AS us ON us.ID = ml.tb_user_ID
                INNER JOIN tb_semester AS sem ON ml.tb_semester_ID = sem.ID
                WHERE us.deleted IS NULL ORDER BY ml.`creationDate` DESC LIMIT 400;";

        $entryList = "";

        $result = $mysqli->query($sql);
        if ($result->num_rows > 0) {

            while($row = $result->fetch_assoc()) {

                $dateSet =  date("d.m.Y", strtotime($row['creationDate']));


                $listEntry = '
                <tr class="lEntry" entryID="'. $row['ID'] .'">
                    <td><span class="fa fa-trash-o delEntry" entryID="'. $row['ID'] .'" aria-hidden="true" style="cursor: pointer;"></span></td>
                    <th scope="row">'. $row['ID'] .'</th>
                    <td>'. $row['firstname'] .' '. $row['lastname'] .'</td>
                    <td>'. $row['weight'] .' %</td>
                    <td>'. $row['description'] .'</td>
                    <td>'. $row['semester'] .'</td>
                    <td>'. $dateSet .' </td>
                </tr>';

                $entryList = $entryList . $listEntry;

            }
        } else {
            $entryList = $translate["Noch keine Einträge"];
        }

        $semList = "";

    ?>

    <head>
        <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.css">
	</head>

    <h1 class="mt-5"><?php echo $translate["Malus"];?></h1>
    <div class="alert alert-danger" id="error" style="display: none;" role="alert"></div>
    <div class="alert alert-success" id="addedNotif" style="display: none; margin-bottom: 0px;">
        <strong></strong> <?php echo $translate["Eintrag wurde hinzugefügt"];?>.
    </div><br/>
    <div class="col-lg-12 card">
        <div class="row">
            <div class="col-lg-12">
                <br/>
                <h3><?php echo $translate["Neuen Malus eintragen"];?></h3>
                <hr/>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <label for="fselUser"><?php echo $translate["Lernende/r"];?>:</label>
                <select id="fselUser" class="form-control">
                    <option></option>
                    <?php echo $llist; ?>
                </select>
            </div>
            <div class="col-lg-4">
                <label for="fsem"><?php echo $translate["Semester"];?>:</label>
                <select id="fsem" class="form-control" disabled>
                    <option></option>
                    <?php echo $semList; ?>
                </select>
            </div>
            <div class="col-lg-4">
                <label for="fweigth"><?php echo $translate["Gewichtung"];?>:</label>
                <input id="fweigth" class="form-control" type="text" placeholder="%"/>
            </div>
        </div>
        <br/>
        <div class="row">
            <div class="col-lg-12">
                <label for="freasoning"><?php echo $translate["Begründung"];?></label>
                <textarea id="freasoning" class="form-control"></textarea>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <br/>
                <button type="button" id="fsenMal" class="btn btn-primary"><?php echo $translate["Abschicken"];?></button>
                <br/><br/>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <hr/>
        <h3><?php echo $translate["Definierte Werte"];?></h3>
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
                <th><?php echo $translate["Lernende/r"];?></th>
                <th><?php echo $translate["Gewichtung"];?></th>
                <th><?php echo $translate["Begründung"];?></th>
                <th><?php echo $translate["Semester"];?></th>
                <th><?php echo $translate["Erstellungsdatum"];?></th>
            </tr>
        </thead>
        <tbody>
            <?php
                if($entryList){
                    echo $entryList;
                } else {
                    echo "<tr><td colspan='7' align='center'>".$translate["Bisher keine Einträge"]."</td></tr>";
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

    <script type="text/javascript">
        var translate = {};
        <?php
            foreach ($translate as $key => $value) {
                echo ("translate['".$key."'] = '".$value."';");
            };
        ?>;
    </script>
    <script type="text/javascript" src="modul/malus/malus.js"></script>

<?php else : ?>

    <br/><br/>

    <div class='alert alert-danger'>
        <strong><?php echo $translate["Fehler"];?> </strong> <?php echo $translate["Ihr Account wurde keiner Gruppe zugewiesen, oder Ihnen fehlen Rechte"];?>.
    </div>

<?php endif; ?>
