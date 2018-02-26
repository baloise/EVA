<?php include("../session/session.php"); ?>
<?php include("../../database/connect.php"); ?>
<?php if($session_usergroup == 1) : ?>

    <?php

        $listEntries = "";

        $sql = "SELECT ID, bKey, firstname, lastname FROM `tb_user` WHERE tb_group_ID IN (3, 4, 5) AND deleted IS NULL;";
        $result = $mysqli->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {

                $entry = '
                <div class="row searchRow">
                    <div class="card col-lg-12 userContentBox">
                        <div class="row header" userId="'.$row['ID'].'">
                            <div class="col-10">
                                <b class="searchFor">'.$row['firstname'].' '.$row['lastname'].' ('.$row['bKey'].')</b>
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
                                        <img class="img-responsive" src="img/loading2_big.svg"/>
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

    <h1 class="mt-5"><?php echo $translate[12];?></h1>
    <p></p>

    <div class="form-group">
        <i class="fa fa-search" style="position: absolute; padding: 10px; right: 15px;" aria-hidden="true"></i>
        <input type="text" class="form-control" id="searchInput" onkeyup="search()" placeholder="">
    </div>
    <div id="searchList" class="col-lg-12" style="max-height: 550px; overflow-y: auto; overflow-x: hidden;">
        <?php echo $listEntries; ?>
    </div>

    <div class="row">
        <div class="col-12">
            <h1 class="mt-5"><?php echo $translate[81];?></h1>

            <div class="alert alert-warning" role="alert" id="warning" style="display: none;">
                <strong><?php echo $translate[122];?></strong> <?php echo $translate[98];?>:
                <button type="button" id="warnButton" style="background-color: inherit; color: #856404;" class="btn btn-warning"><?php echo $translate[99];?></button>
            </div>

            </br>

            <?php

                $sql ="
                SELECT dead.ID AS did, dead.title_de AS Dtitel_de, dead.title_fr AS Dtitel_fr, dead.title_it AS Dtitel_it, dead.description_de AS Dbeschreibung_de, dead.description_fr AS Dbeschreibung_fr, dead.description_it AS Dbeschreibung_it, dead.date AS Ddeadline, sem.ID AS Sid, sem.semester AS Ssemester, grou.ID AS Gid, grou.name AS Gname FROM `tb_deadline` AS dead
                INNER JOIN tb_semester AS sem ON dead.tb_semester_ID = sem.ID
                INNER JOIN tb_group AS grou ON grou.ID = sem.tb_group_ID
                ORDER BY Ssemester ASC, Gid ASC;
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

                            $generateDiv = $generateDiv . '
                            <div class="deadlineListToggler" style="cursor:pointer;" semID="'.$row['Ssemester'].'">
                                <div class="row">
                                    <div class="col-12">
                                        <hr/>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-10">
                                        <h2>'.$translate[38].' '.$row['Ssemester'].'</h2>
                                    </div>
                                    <div class="col-2 text-right">
                                        <i class="fa fa-chevron-down" style="margin-top: 5px;" aria-hidden="true"></i>
                                    </div>
                                    <br/><br/><br/>
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
                            <div class="col-12 card" style="padding-top:10px; padding-bottom:10px; margin-bottom:20px;">
                                <div class="deadlineHead row" style="cursor:pointer;" did="'. $row['did'] .'">
                                    <div class="col-10">
                                        <h2>'. $translateTitle .'</h2>
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
                                                <input fType="3" did="'. $row['did'] .'" class="form-control changeInTable" type="date" value="'. $row['Ddeadline'] .'"></input>
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
                                            <div class="col-12 text-center">
                                                <span style="cursor: pointer; margin-top:10px; font-size:1.5rem;" class="fa fa-trash-o removeDid" did="'. $row['did'] .'" aria-hidden="true"></span>

                                                <div class="alert alert-success" id="changesSaveNotif'. $row['did'] .'" style="display: none; margin-top: 5px;">
                                                    <strong></strong>'.$translate[101].'!
                                                </div>

                                                <div id="loadingTable'. $row['did'] .'" style="display:none;">
                                                    <img class="img-responsive" src="img/loading2_big.svg"/>
                                                </div>
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
            <h1 class="mt-5"><?php echo $translate[144];?></h1>
            <div class="alert alert-danger" id="error" style="display: none;" role="alert"></div>
            <div class="alert alert-success col-lg-10" id="addedNotif" style="display: none; margin-bottom: 0px;">
                <strong></strong> <?php echo $translate[103];?>.
            </div>
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
                    <input class="form-control" id="fDeadline" type="date" placeholder="<?php echo $translate[83];?>" required></input>
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
                    <button type="button" class="btn btn-block" id="addNewdid"><i class="fa fa-plus" aria-hidden="true"></i></button>
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
    <script type="text/javascript" src="modul/terminmanagement/modifyhr.js"></script>


<?php elseif($session_usergroup == 3 || $session_usergroup == 4 || $session_usergroup == 5) : ?>

    <h1 class="mt-5"><?php echo $translate[12];?></h1>



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

                $sql2 = "SELECT ID, title_".$session_language.", title_de, description_".$session_language.", description_de, date, tb_semester_ID FROM `tb_deadline` WHERE tb_semester_ID = $semesterid;";
                $result2 = $mysqli->query($sql2);

                if ($result2->num_rows > 0) {
                    while($row2 = $result2->fetch_assoc()) {

                        $deadlineID = $row2['ID'];

                        $deadlineTitle = $row2['title_'.$session_language];
                        if(!$deadlineTitle){
                            $deadlineTitle = $row2['title_de'];
                        }

                        $deadlineDescription = $row2['description_'.$session_language];
                        if(!$deadlineDescription){
                            $deadlineDescription = $row2['description_de'];
                        }

                        $deadlineDate = $row2['date'];

                        $sql3 = "SELECT * FROM `tb_deadline_check` WHERE tb_deadline_ID = $deadlineID AND tb_user_ID = $session_userid;";
                        $result3 = $mysqli->query($sql3);

                        if ($result3->num_rows > 0) {

                            $entry = '
                                <div class="row">
                                    <div class="col-lg-12 card alert-success" style="padding-top: 10px; margin-bottom: 10px;">
                                        <h3>'.$deadlineTitle.'</h3>
                                        <p>'.$deadlineDescription.'</p>
                                        <p>'.$translate[80].': <b>'.date("d.m.Y", strtotime($deadlineDate)).'</b></p>
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
                                            <p>'.$translate[80].': <b>'.date("d.m.Y", strtotime($deadlineDate)).'</b></p>
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
                                            <p>'.$translate[80].': <b>'.date("d.m.Y", strtotime($deadlineDate)).'</b></p>
                                        </div>
                                    </div>
                                ';

                                $entriesBefore = $entriesBefore . $entry;

                            }
                        }

                    }
                } else {
                    $entriesBefore = $translate[123];
                    $entriesPassed = $translate[123];
                }



                $entry = '
                    <div class="divtoggler" subSemid="'.$semesterid.'" style="cursor:pointer;">
                        <hr/>
                        <div class="row">
                            <div class="col-lg-10">
                                <h2>'.$translate[38].' '.$semesterTitle.'</h2>
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
                                <h2>'.$translate[78].':</h2>
                            </div>
                            <div class="col-12">
                                '.$entriesBefore.'
                            </div>
                            <div class="col-12">
                                <br/><br/>
                                <h2>'.$translate[79].':</h2>
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
        <strong><?php echo $translate[95];?> </strong> <?php echo $translate[94];?>.
    </div>

<?php endif; ?>
