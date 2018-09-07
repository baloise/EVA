<?php include("../../includes/session.php"); ?>
<?php include("../../database/connect.php"); ?>
<?php include("../../includes/alerts.php"); ?>

<?php if($session_usergroup == 1) : ?>

    <head>
        <style>
            .searchRow, button {
                box-shadow: 0 1px 2px rgba(0,0,0,0.15);
                transition: box-shadow 0.3s ease-in-out;
            }
            .searchRow:hover, button:hover {
                box-shadow: 0 5px 15px rgba(0,0,0,0.3);
            }
        </style>
    </head>

    <?php

        $sql ="SELECT us.ID, us.mail, us.bKey, gr.name, us.firstname, us.lastname, us.deleted, us.lastLogin, us.tb_semester_ID AS usGroupID, gr.ID AS groupID FROM `tb_user` AS us JOIN tb_group AS gr ON gr.ID = us.tb_group_ID ORDER BY us.creationDate DESC";
        $sql2 ="SELECT ID, name FROM tb_group";

        $groups = "";
        $generatedList = "";

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

                    $semesters = "";
                    $sql3 = "SELECT ID, semester FROM `tb_semester` WHERE tb_group_ID = ". $row['groupID'];
                    $result3 = $mysqli->query($sql3);
                    if ($result3->num_rows > 0) {
                        while($row3 = $result3->fetch_assoc()) {
                            if($row3['ID'] == $row['usGroupID']){
                                $semesters .= "<option selected value='". $row3['ID'] ."'>". $row3["semester"] ."</option>";
                            } else {
                                $semesters .= "<option value='". $row3['ID'] ."'>". $row3["semester"] ."</option>";
                            }
                        }
                    } else {
                        $semesters = "-";
                    }

                    if($row['lastLogin'] == ""){
                        $lastlogin = "-";
                    } else {
                        $lastlogin = date_format(new DateTime($row['lastLogin']), 'd.m.Y H:i');
                    }

                    $generateDiv = '
                    <div id="'. $row['ID'] .'_FUserRow" class="searchRow row card" style="padding-top:10px; padding-left: 10px; padding-right: 15px; margin-bottom: 10px;">

                        <div class="row userHeader searchFor" userID="'. $row['ID'] .'" style="height: 30px;">
                            <div class="col-7" style="cursor: pointer;">
                                <h2 id="'. $row['ID'] .'_FNameHeader">'.$row['firstname'].' '.$row['lastname'].'</h2>
                            </div>
                            <div class="col-5 text-right" style="cursor: pointer;">
                                '.$row['bKey'].' | <span id="'. $row['ID'] .'_FGroupHeader">'.$translate[$row['name']].'</span>
                            </div>
                        </div>

                        <div class="row userContent" userID="'. $row['ID'] .'" style="padding: 15px; display:none;">

                            <div class="col-12">
                                <i class="fa fa-eye" aria-hidden="true"></i> '.$lastlogin.'
                            </div>

                            <div class="col-12">
                                <hr />
                            </div>
                            <div class="col-lg-4">
                                '.$translate[41].'
                                <input type="text" class="form-control fFirstname" id="'. $row['ID'] .'_fFirstname" userID="'. $row['ID'] .'" value="'.$row['firstname'].'"/>
                            </div>
                            <div class="col-lg-4">
                                '.$translate[42].'
                                <input type="text" class="form-control fLastname" id="'. $row['ID'] .'_fLastname" userID="'. $row['ID'] .'" value="'.$row['lastname'].'"/>
                            </div>
                            <div class="col-lg-4">
                                '.$translate[40].'
                                <select class="form-control fGroup" id="'. $row['ID'] .'_fGroup" userID="'. $row['ID'] .'">
                                    <option value="'.$row['groupID'].'">'.$translate[$row['name']].'</option>
                                    '.$groups.'
                                </select>
                            </div>
                            <div class="col-12">
                                <br />
                            </div>
                            <div class="col-lg-6">
                                '.$translate[255].'
                                <input type="text" class="form-control fMail" id="'. $row['ID'] .'_fMail" value="'. $row['mail'] .'"/>
                            </div>
                            <div class="col-lg-3">
                                '.$translate[139].'
                                <select class="form-control fLanguage" id="'. $row['ID'] .'_fLanguage">
                                    <option value="de">'.$translate[140].'</option>
                                    <option value="it">'.$translate[141].'</option>
                                    <option value="fr">'.$translate[142].'</option>
                                </select>
                            </div>
                            <div class="col-lg-3">
                                '.$translate[38].'
                                <select class="form-control fSemester" id="'. $row['ID'] .'_fSemester">
                                    <option></option>
                                    '.$semesters.'
                                </select>
                            </div>
                            <div class="col-12">
                                <hr />
                            </div>';
                            if($row['groupID'] != 1){
                                $generateDiv .= '
                                <div class="col-lg-4">
                                    <button class="btn btn-block btn-lg btn-success fSave" userID="'. $row['ID'] .'"><span class="fa fa-floppy-o" aria-hidden="true"></span> '.$translate[254].'</button>
                                </div>
                                <div class="col-lg-4">
                                    <button class="btn btn-block btn-lg btn-danger fDelete" bkey="'.$row['bKey'].'" userID="'. $row['ID'] .'"><span class="fa fa-trash-o" aria-hidden="true"></span> '.$translate[97].'</button>
                                </div>
                                <div class="col-lg-4">
                                    <button class="btn btn-block btn-lg btn-warning fLogin" bkey="'.$row['bKey'].'" userID="'. $row['ID'] .'"><i class="fa fa-exchange" aria-hidden="true"></i> Re-Login</button>
                                </div>';
                            } else {
                                $generateDiv .= '
                                <div class="col-lg-6">
                                    <button class="btn btn-block btn-lg btn-success fSave" userID="'. $row['ID'] .'"><span class="fa fa-floppy-o" aria-hidden="true"></span> '.$translate[254].'</button>
                                </div>
                                <div class="col-lg-6">
                                    <button class="btn btn-block btn-lg btn-danger fDelete" bkey="'.$row['bKey'].'" userID="'. $row['ID'] .'"><span class="fa fa-trash-o" aria-hidden="true"></span> '.$translate[97].'</button>
                                </div>';
                            }
                            $generateDiv .= '
                            <br/>
                        </div>
                    </div>
                    ';

                    $generatedList .= $generateDiv;
                }
            }
        } else {
            $generatedList.= $translate[100] .".";
        }

    ?>

    <h1 class="mt-5"><?php echo $translate[4];?></h1>

    <div class="row">
        <div class="col-6">
            <button data-toggle="modal" data-target="#addUserModal" style="padding-top: 4px; padding-bottom: 5px;" class="btn btn-block btn-lg btn-primary">
                <span class="fa fa-plus" aria-hidden="true"></span> <?php echo $translate[43];?>
            </button>
        </div>
        <div class="col-6">
            <div class="form-group">
                <i class="fa fa-search" style="position: absolute; padding: 10px; right: 15px;" aria-hidden="true"></i>
                <input type="text" class="form-control" id="searchInput" placeholder="">
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="addUserModal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><?php echo $translate[43];?></h4>
                </div>
                <div class="modal-body">
                    <div class="row" id="addUserForm">
                        <div class="col-lg-6">
                            <label for="usrFormBkey">B-Key:</label>
                            <input type="text" class="form-control addUserInput" id="usrFormBkey" maxlength="7" required>
                        </div>
                        <div class="col-lg-6">
                            <label for="usrFormGroup"><?php echo $translate[40];?>:</label>
                            <select class="form-control addUserInput" id="usrFormGroup" required><option value=""></option><?php echo $groups; ?></select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" href="#" id="addUser" class="btn btn-primary"><?php echo $translate[44];?></button>
                    <button type="button" data-dismiss="modal" class="btn btn-default"><?php echo $translate[33];?></button>
                </div>
            </div>
        </div>
    </div>

    <div class="usersBox" id="searchList">

        <?php echo $generatedList; ?>

    </div>


    <?php

        $sql ="SELECT us.ID, us.mail, us.bKey, gr.name, us.firstname, us.lastname, us.deleted FROM `tb_user` AS us JOIN tb_group AS gr ON gr.ID = us.tb_group_ID";
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
                        <td><input fType="4" usrid="'. $row['ID'] .'" class="form-control changeInTable" type="text" value="'. $row['mail'] .'"></input></td>
                        <td><span class="fa fa-trash-o" bkey="'. $row['bKey'] .'" id="'. $row['ID'] .'" aria-hidden="true"></span></td>
                    </tr>
                    ';

                    //echo $generateDiv;
                }
            }
        } else {
            //echo $translate[100] .".";
        }

    ?>

    <script type="text/javascript">
        /** global: translate */
        var translate = {};
        <?php
            foreach ($translate as $key => $value) {
                echo ("translate['".$key."'] = '".$value."';");
            };
        ?>;
    </script>

    <script type="text/javascript" src="js/searchFunction.min.js"></script>
    <script type="text/javascript" src="modul/benutzerverwaltung/benutzerverwaltung.min.js"></script>

<?php else : ?>

    <br/><br/>

    <div class='alert alert-danger'>
        <strong><?php echo $translate[95];?> </strong> <?php echo $translate[94];?>.
    </div>

<?php endif; ?>
