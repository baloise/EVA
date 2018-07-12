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

    <h1 class="mt-5"><?php echo $translate[4];?></h1>

    <div class="row">
        <div class="col-6">
            <button style="padding-top: 4px; padding-bottom: 5px;" class="btn btn-block btn-lg btn-default"><span class="fa fa-plus" aria-hidden="true"></span> Benutzer hinzufügen</button>
        </div>
        <div class="col-6">
            <div class="form-group">
                <i class="fa fa-search" style="position: absolute; padding: 10px; right: 15px;" aria-hidden="true"></i>
                <input type="text" class="form-control" id="searchInput" placeholder="">
            </div>
        </div>
    </div>

    <div class="usersBox" id="searchList">

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
                        <div class="searchRow row card" style="padding-top:10px; padding-left: 10px; padding-right: 15px; margin-bottom: 10px;">

                            <div class="row userHeader searchFor" userID="'. $row['ID'] .'" style="height: 30px; cursor: pointer;">
                                <div class="col-7">
                                    <h2 class="">'.$row['firstname'].' '.$row['lastname'].'</h2>
                                </div>
                                <div class="col-5 text-right">
                                    '.$row['bKey'].' | '.$translate[$row['name']].'
                                </div>
                            </div>

                            <div class="row userContent" userID="'. $row['ID'] .'" style="padding: 15px; display:none;">

                                <div class="col-12">
                                    Zuletzt angemeldet: Vor 13 Minuten
                                </div>

                                <div class="col-12">
                                    <hr />
                                </div>
                                <div class="col-lg-4">
                                    Vorname
                                    <input type="text" class="form-control" value="'.$row['firstname'].'"/>
                                </div>
                                <div class="col-lg-4">
                                    Nachname
                                    <input type="text" class="form-control" value="'.$row['lastname'].'"/>
                                </div>
                                <div class="col-lg-4">
                                    Gruppe
                                    <select class="form-control">
                                        <option>'.$translate[$row['name']].'</option>
                                        '.$groups.'
                                    </select>
                                </div>
                                <div class="col-12">
                                    <br />
                                </div>
                                <div class="col-lg-6">
                                    E-Mail
                                    <input type="text" class="form-control" value="'. $row['mail'] .'"/>
                                </div>
                                <div class="col-lg-3">
                                    Sprache
                                    <select class="form-control">
                                        <option>Deutsch</option>
                                        <option>Italienisch</option>
                                        <option>Französisch</option>
                                    </select>
                                </div>
                                <div class="col-lg-3">
                                    Semester
                                    <select class="form-control">
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <hr />
                                </div>
                                <div class="col-lg-6">
                                    <button class="btn btn-block btn-lg btn-success"><span class="fa fa-plus" aria-hidden="true"></span> Änderungen speichern</button>
                                </div>
                                <div class="col-lg-6">
                                    <button class="btn btn-block btn-lg btn-danger"><span class="fa fa-trash-o" aria-hidden="true"></span> Benutzer löschen</button>
                                </div>
                                <br/>
                            </div>
                        </div>
                        ';

                        echo $generateDiv;
                    }
                }
            } else {
                echo $translate[100] .".";
            }

        ?>



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
        var translate = {};
        <?php
            foreach ($translate as $key => $value) {
                echo ("translate['".$key."'] = '".$value."';");
            };
        ?>;
    </script>

    <script type="text/javascript" src="modul/benutzerverwaltung/benutzerverwaltungNEU.js"></script>

<?php else : ?>

    <br/><br/>

    <div class='alert alert-danger'>
        <strong><?php echo $translate[95];?> </strong> <?php echo $translate[94];?>.
    </div>

<?php endif; ?>
