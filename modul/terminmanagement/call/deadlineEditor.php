<?php include("../../../includes/session.php"); ?>
<?php include("../../../database/connect.php"); ?>

<?php if($session_usergroup == 1) : ?>

    <div class="row">
        <div class="col-12">

            </br>

            <?php

                $sql ="
                SELECT
                    dead.ID AS did, dead.title_de AS Dtitel_de, dead.title_fr AS Dtitel_fr, dead.title_it AS Dtitel_it,
                    dead.description_de AS Dbeschreibung_de, dead.description_fr AS Dbeschreibung_fr, dead.description_it AS Dbeschreibung_it,
                    dead.date AS Ddeadline, sem.ID AS Sid, sem.semester AS Ssemester, grou.ID AS Gid, grou.name AS Gname
                FROM `tb_deadline` AS dead

                INNER JOIN tb_semester AS sem ON dead.tb_semester_ID = sem.ID
                INNER JOIN tb_group AS grou ON grou.ID = sem.tb_group_ID
                ORDER BY Gid ASC, Ssemester ASC;

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
                    $groups = $translate[123];
                }

                $oldSem = "";
                $oldGroup = "";

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
                            $listSemsInList = $translate[91].".";
                        }

                        $generateDiv = "";

                        if($row['Ssemester'] != $oldSem){

                            if($oldSem != ""){
                                $generateDiv = $generateDiv . "</div>";
                            }

                            if($row['Gid'] != $oldGroup){

                                if($oldGroup != ""){
                                    $generateDiv .= '</div>';
                                }

                                $generateDiv = $generateDiv . '

                                    <br />
                                    <div class="row editGroupToggler" onclick="toggleEdit('.$row['Gid'].');" style="cursor:pointer;">
                                        <div class="col-1 text-center">
                                            <i class="fa fa-chevron-down" style="margin-top: 5px;" aria-hidden="true"></i>
                                        </div>
                                        <div class="col-10">
                                            <h2>'.$translate[$row['Gname']].'</h2>
                                        </div>

                                    </div>


                                    <div class="toggleEditGroup" style="display:none;" id="'.$row['Gid'].'">
                                ';

                                $oldGroup = $row['Gid'];

                            }

                            $generateDiv = $generateDiv . '
                            <div class="deadlineListToggler" style="cursor:pointer;" semID="'.$row['Ssemester'].'">
                                <br />
                                <div class="row">
                                    <div class="col-10">
                                        <h2>'.$translate[38].' '.$row['Ssemester'].'</h2>
                                    </div>
                                    <div class="col-2 text-right">
                                        <i class="fa fa-chevron-down" style="margin-top: 5px;" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="deadlineList" style="display:none;" semID="'.$row['Ssemester'].'">';

                            $oldSem = $row['Ssemester'];

                        }

                        $translateTitle = "";
                        if($row['Dtitel_' . $session_language]){
                            $translateTitle = $row['Dtitel_' . $session_language];
                        } else {
                            $translateTitle = $row['Dtitel_de'];
                        }

                        $generateDiv = $generateDiv .'
                        <div class="row rowID'. $row['did'] .'" style="max-width: 98%; margin-left: auto; margin-right: auto;">
                            <div class="col-12 card highlighter" style="padding-top:10px; padding-bottom:10px; margin-bottom:20px;">
                                <div class="deadlineHead row" style="cursor:pointer;" did="'. $row['did'] .'">
                                    <div class="col-10">
                                        <h2>'. $translateTitle .' ('.$translate[$row['Gname']].')</h2>
                                    </div>
                                    <div class="col-2 text-right">
                                        <i class="fa fa-chevron-down" style="margin-top: 5px;" aria-hidden="true"></i>
                                    </div>
                                </div>
                                <div class="deadlineContent row" style="display:none;" did="'. $row['did'] .'">
                                    <div class="col-12">
                                        <hr/>
                                    </div>
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-12 text-center">
                                                <h3>'.$translate[55].'</h3>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4 text-center">
                                                <label for="">'.$translate[140].'</label>
                                                <input fType="1" lang="de" did="'. $row['did'] .'" class="form-control changeInTable" type="text" value="'. $row['Dtitel_de'] .'"></input>
                                            </div>
                                            <div class="col-lg-4 text-center">
                                                <label for="">'.$translate[142].'</label>
                                                <input fType="1" lang="fr" did="'. $row['did'] .'" class="form-control changeInTable" type="text" value="'. $row['Dtitel_fr'] .'"></input>
                                            </div>
                                            <div class="col-lg-4 text-center">
                                                <label for="">'.$translate[141].'</label>
                                                <input fType="1" lang="it" did="'. $row['did'] .'" class="form-control changeInTable" type="text" value="'. $row['Dtitel_it'] .'"></input>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 text-center" style="margin-top:30px;">
                                                <h3>'.$translate[82].'</h3>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4 text-center">
                                                <textarea style="min-height: 100px; max-width: 98%;" fType="2" lang="de" did="'. $row['did'] .'" class="form-control changeInTable">'. $row['Dbeschreibung_de'] .'</textarea>
                                            </div>
                                            <div class="col-lg-4 text-center">
                                                <textarea style="min-height: 100px; max-width: 98%;" fType="2" lang="fr" did="'. $row['did'] .'" class="form-control changeInTable">'. $row['Dbeschreibung_fr'] .'</textarea>
                                            </div>
                                            <div class="col-lg-4 text-center">
                                                <textarea style="min-height: 100px; max-width: 98%;" fType="2" lang="it" did="'. $row['did'] .'" class="form-control changeInTable">'. $row['Dbeschreibung_it'] .'</textarea>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <hr/>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <label for="">'.$translate[83].'</label>
                                                <input fType="3" did="'. $row['did'] .'" class="form-control changeInTable" type="text" value="'. $row['Ddeadline'] .'"></input>
                                            </div>
                                            <div class="col-lg-4">
                                                <label for="">'.$translate[40].'</label>
                                                <select fType="5" class="form-control updateSems" did="'. $row['did'] .'"><option value="'. $row['Gid'] .'">'. $translate[$row['Gname']] .'</option>'.$groups.'</select>
                                            </div>
                                            <div class="col-lg-4">
                                                <label for="">'.$translate[38].'</label>
                                                <select fType="4" class="form-control changeInTable inTableSelect" did="'. $row['did'] .'"><option value="'. $row['Sid'] .'">'. $row['Ssemester'] .'</option>'.$listSemsInList.'</select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <hr />
                                            </div>
                                            <div class="col-lg-6">
                                                <button class="btn btn-block btn-lg btn-success fSave" did="'. $row['did'] .'"><span class="fa fa-floppy-o" aria-hidden="true"></span> '.$translate[254].'</button>
                                            </div>
                                            <div class="col-lg-6">
                                                <button class="btn btn-block btn-lg btn-danger fDelete" did="'. $row['did'] .'"><span class="fa fa-trash-o" aria-hidden="true"></span> '.$translate[122].'</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        ';

                        echo $generateDiv;

                    }
                } else {
                    $generateDiv = $translate[100];
                    echo $generateDiv;
                }

            ?>

        </div>
    </div>
    <div class="col-12">
        <div class="col-12" style="margin-bottom:20px;">
            <hr/>
            <div class="row" id="toggleDeadlineAdder">
                <div class="col-12" style="cursor:pointer;">
                    <h1 style="padding-top:10px;"><i class="fa fa-plus-square-o" aria-hidden="true"></i> <?php echo $translate[144];?></h1>
                </div>
            </div>
            <div id="deadlineAdder" style="display:none;">

                <div class="row">
                    <div class="col-12 text-center">
                        <h3><?php echo $translate[55];?></h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 text-center">
                        <label for=""><?php echo $translate[140];?></label>
                        <input class="form-control " type="text" id="fTitle_de" placeholder="<?php echo $translate[55];?>" required></input>
                    </div>
                    <div class="col-lg-4 text-center">
                        <label for=""><?php echo $translate[142];?></label>
                        <input class="form-control " type="text" id="fTitle_fr" placeholder="<?php echo $translate[55];?>" required></input>
                    </div>
                    <div class="col-lg-4 text-center">
                        <label for=""><?php echo $translate[141];?></label>
                        <input class="form-control " type="text" id="fTitle_it" placeholder="<?php echo $translate[55];?>" required></input>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 text-center" style="margin-top:30px;">
                        <h3><?php echo $translate[82];?></h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 text-center">
                        <textarea style="min-height: 100px; max-width: 98%;" class="form-control" id="fDescription_de" placeholder="<?php echo $translate[82];?>" ></textarea>
                    </div>
                    <div class="col-lg-4 text-center">
                        <textarea style="min-height: 100px; max-width: 98%;" class="form-control" id="fDescription_fr" placeholder="<?php echo $translate[82];?>" ></textarea>
                    </div>
                    <div class="col-lg-4 text-center">
                        <textarea style="min-height: 100px; max-width: 98%;" class="form-control" id="fDescription_it" placeholder="<?php echo $translate[82];?>" ></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <hr/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <label for=""><?php echo $translate[83];?></label>
                        <input class="form-control" id="fDeadline" type="text" placeholder="<?php echo $translate[83];?>" required></input>
                    </div>
                    <div class="col-lg-4">
                        <label for=""><?php echo $translate[40];?></label>
                        <select class="form-control updateSems" did="newDID"><option></option><?php echo $groups; ?></select>
                    </div>
                    <div class="col-lg-4">
                        <label for=""><?php echo $translate[38];?></label>
                        <select class="form-control inTableSelect" did="newDID" id="fSemester" disabled required><option></option></select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 text-center">
                        <br/>
                        <button type="button" class="btn btn-block highlighter" id="addNewdid"><i class="fa fa-plus" aria-hidden="true"></i></button>
                    </div>
                </div>

            </div>

        </div>
    </div>

    <script type="text/javascript">
        var translate = {};
        <?php
            foreach ($translate as $key => $value) {
                echo ("translate['".$key."'] = '".$value."';");
            };
        ?>;
    </script>
    <script type="text/javascript" src="modul/terminmanagement/js/deadlineEditor.min.js"></script>

<?php else : ?>

    <br/><br/>

    <div class='alert alert-danger'>
        <strong><?php echo $translate[95];?> </strong> <?php echo $translate[94];?>.
    </div>

<?php endif; ?>
