<?php include("../session/session.php"); ?>
<?php include("../../database/connect.php"); ?>
<?php if($session_usergroup == 1) : ?>


    <head>
        <link rel="stylesheet" href="modul/benutzerverwaltung/benutzerverwaltung.css"/>
        <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.css">
	</head>



    <h1 class="mt-5"><?php echo $translate[4];?></h1>

    <div class="alert alert-warning" role="alert" id="warning" style="display: none;">
        <strong><?php echo $translate[97];?></strong> <?php echo $translate[98];?>: <span id="useridWarn"></span>
        <button type="button" id="warnButton" style="background-color: inherit; color: #856404;" class="btn btn-warning"><?php echo $translate[99];?></button>
    </div>

    <div id="userTable" style="display: none;">
        <table id="users" class="display" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>B-Key</th>
                    <th><?php echo $translate[40];?></th>
                    <th><?php echo $translate[41];?></th>
                    <th><?php echo $translate[42];?></th>
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
                            $groups = $groups . "<option value='". $row['ID'] ."'>". $translate[$row["name"]] ."</option>";
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
                                    <td><select fType="1" usrid="'. $row['ID'] .'" class="form-control" disabled><option>'. $translate[$row['name']] .'</option>'.$groups.'</select></td>
                                    <td><input fType="2" usrid="'. $row['ID'] .'" class="form-control changeInTable" type="text" value="'. $row['firstname'] .'"></input></td>
                                    <td><input fType="3" usrid="'. $row['ID'] .'" class="form-control changeInTable" type="text" value="'. $row['lastname'] .'"></input></td>
                                    <td><span class="fa fa-trash-o" bkey="'. $row['bKey'] .'" id="'. $row['ID'] .'" aria-hidden="true"></span></td>
                                </tr>
                                ';

                                echo $generateDiv;
                            }
                        }
                    } else {
                        echo $translate[100] .".";
                    }

                ?>
            </tbody>
        </table>
    </div>

    <div class="alert alert-success" id="changesSaveNotif" style="display: none;">
        <strong></strong> <?php echo $translate[101];?>!
    </div>

    <div id="loadingTable">
        <img class="img-responsive" src="img/loading2_big.svg"/>
    </div>

    <div id="editForm">
        <hr/>
        <br/>
        <h2><?php echo $translate[43];?>:</h2>
        <form>
            <div class="alert alert-danger" id="error" style="display: none;"></div>
            <div class="alert alert-success" id="userAddedNotif" style="display: none;">
                <strong></strong> <?php echo $translate[102];?>.
            </div>
            <div class="row" id="addUserForm">
                <div class="col-lg-2">
                    <label for="usrFormBkey">B-Key:</label>
                    <input type="text" class="form-control addUserInput" id="usrFormBkey" maxlength="7" required>
                </div>
                <div class="col-lg-3">
                    <label for="usrFormGroup"><?php echo $translate[40];?>:</label>
                    <select class="form-control addUserInput" id="usrFormGroup" required><option value=""></option><?php echo $groups; ?></select>
                </div>
                <div class="col-lg-3">
                    <label for="usrFormFirstname"><?php echo $translate[41];?>:</label>
                    <input type="text" class="form-control addUserInput" id="usrFormFirstname">
                </div>
                <div class="col-lg-3">
                    <label for="usrFormLastname"><?php echo $translate[42];?>:</label>
                    <input type="text" class="form-control addUserInput" id="usrFormLastname">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <br/>
                    <button type="submit" href="#" id="addUser" class="btn btn-primary"><?php echo $translate[44];?></a>
                </div>
            </div>
        </form>
    </div>


    <script type="text/javascript">
        var translate = {};
        <?php
            foreach ($translate as $key => $value) {
                echo ("translate['".$key."'] = '".$value."';");
            };
        ?>;
    </script>
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
                        "sEmptyTable":      "<?php echo $translate[86];?>",
                        "sInfo":            "_START_ <?php echo $translate[23];?> _END_ <?php echo $translate[24];?> _TOTAL_ <?php echo $translate[25];?>",
                        "sInfoEmpty":       "0 <?php echo $translate[23];?> 0 <?php echo $translate[24];?> 0 <?php echo $translate[25];?>",
                        "sInfoFiltered":    "(gefiltert von _MAX_ Einträgen)",
                        "sInfoPostFix":     "",
                        "sInfoThousands":   ".",
                        "sLengthMenu":      "_MENU_ <?php echo $translate[17];?>",
                        "sLoadingRecords":  "Wird geladen...",
                        "sProcessing":      "Bitte warten...",
                        "sSearch":          "",
                        "sZeroRecords":     "<?php echo $translate[87];?>.",
                        "oPaginate": {
                            "sFirst":       "<?php echo $translate[88];?>",
                            "sPrevious":    "<?php echo $translate[26];?>",
                            "sNext":        "<?php echo $translate[27];?>",
                            "sLast":        "<?php echo $translate[89];?>"
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
                $('#users_filter input').attr('placeholder', 'Suchen').addClass('form-control');
                $('#loadingTable').slideUp("fast", function(){
                    $("#userTable").slideDown( "slow" );
                });
            });
        });
    </script>

<?php else : ?>

    <br/><br/>

    <div class='alert alert-danger'>
        <strong><?php echo $translate[95];?> </strong> <?php echo $translate[94];?>.
    </div>

<?php endif; ?>
