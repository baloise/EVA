<?php include("../../includes/session.php"); ?>
<?php include("../../database/connect.php"); ?>
<?php include("../../includes/alerts.php"); ?>

<?php if($session_usergroup == 1) : //HR ?>

    <h1 class="mt-5"><?php echo $translate[2];?></h1>
    <h3><?php echo $translate[46];?></h3>

    <?php


        $llEntries = "";


        $sql1 = "SELECT ID, bKey, firstname, lastname, deleted FROM `tb_user` WHERE tb_group_ID IN (3, 4, 5) AND deleted IS NULL;";
        $result1 = $mysqli->query($sql1);
        if ($result1->num_rows > 0) {
            while($row1 = $result1->fetch_assoc()) {

                $llid = $row1['ID'];
                $llbkey = $row1['bKey'];
                $llfirst = $row1['firstname'];
                $lllast = $row1['lastname'];
                $llsubjs = 0;
                $llallavg = 0;
                $oldllsubsem = "";

                $gradesunderEntries = "";
                $subEntries = "";

                $sql2 = "SELECT us.subjectName, us.weight, us.ID, us.correctedGrade, sem.semester FROM `tb_user_subject` AS us
                        INNER JOIN tb_semester AS sem ON us.tb_semester_ID = sem.ID
                        WHERE us.tb_user_ID = $llid ORDER BY sem.semester DESC, us.creationDate DESC";

                $result2 = $mysqli->query($sql2);
                if ($result2->num_rows > 0) {
                    while($row2 = $result2->fetch_assoc()) {

                        $llsubname = $row2['subjectName'];
                        $llsubweight = $row2['weight'];
                        $llsubid = $row2['ID'];
                        $llsubsem = $row2['semester'];
                        $llsubcorrgrade = $row2['correctedGrade'];

                        if($llsubweight <= 0 || !is_numeric($llsubweight) || is_null($llsubweight)){
                            $llsubweight = 100;
                        }

                        $sql3 = "SELECT ID, grade, weighting FROM `tb_subject_grade` WHERE tb_user_subject_ID = $llsubid";
                        $result3 = $mysqli->query($sql3);
                        if ($result3->num_rows > 0) {

                            $llsubjs = $llsubjs + 1;
                            $countgrades = 0;
                            $grades = 0;
                            $weights = 0;

                            while($row3 = $result3->fetch_assoc()) {

                                $gradeid = $row3['ID'];
                                $grade = $row3['grade'];
                                $gradeweight = $row3['weighting'];

                                $grades = $grades + ($grade*$gradeweight);
                                $weights = $weights + $gradeweight;
                                $countgrades = $countgrades + 1;

                            }

                            $subgradeavg = round(($grades / $weights),2);
                            if($llsubcorrgrade){
                                $llallavg = $llallavg + $llsubcorrgrade;
                            } else {
                                $llallavg = $llallavg + $subgradeavg;
                            }

                        } else {

                            if($llsubcorrgrade){
                                $llsubjs = $llsubjs + 1;
                                $llallavg = $llallavg + $llsubcorrgrade;
                            }

                            $subgradeavg = $translate[107].".";
                            $countgrades = 0;
                        }

                        $countgradesunder = 0;

                        $sql4 = "SELECT grade, title, reasoning FROM `tb_subject_grade` WHERE tb_user_subject_ID = $llsubid AND grade <= 4";
                        $result4 = $mysqli->query($sql4);
                        if ($result4->num_rows > 0) {
                            while($row4 = $result4->fetch_assoc()) {

                                $gradesunderEntry = '
                                <div class="row gradeBelow">
                                    <div class="col-lg-12">
                                        <div class="card highlighter" style="padding-top: 10px;margin-bottom:10px;">
                                            <div class="row" style="padding:10px;">
                                                <div class="col-lg-12">
                                                    <div class="row">
                                                        <div class="col-lg-4">
                                                            <b>'. $llsubname .'</b>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <b>'.$translate[55].':</b> '. $row4['title'] .'
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <b>'.$translate[56].':</b> '. $row4['grade'] .'
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <b>'.$translate[30].':</b> '. $row4['reasoning'] .'<br/><br/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                ';

                                $countgradesunder = $countgradesunder + 1;
                                $gradesunderEntries = $gradesunderEntries . $gradesunderEntry;
                            }
                        } else {
                            $countgradesunder = 0;
                        }

                        if($llsubcorrgrade){
                            $subgradeavg = "<s>" . $subgradeavg . "</s> <b style='color:red;'>" . $llsubcorrgrade . "</b>";
                        }

                        if($llsubsem == $oldllsubsem){
                            $subEntry = '
                                <tr>
                                    <th scope="row">'. $llsubname .'</th>
                                    <td>'. $llsubweight .'%</td>
                                    <td>'. $countgrades .'</td>
                                    <td>'. $countgradesunder .'</td>
                                    <td class="subAvg" subjid="'. $llsubid .'">'. $subgradeavg .'</td>
                                    <td>
                                        <div class="row">
                                            <div class="col-lg-10 ie11fix">
                                                <input placeholder="'.$translate[52].'" subjid="'. $llsubid .'" type="number" class="form-control corrSubAvgNum"/>
                                            </div>
                                            <div class="col-lg-2" style="padding-left: 0;">
                                                <button type="button" subjid="'. $llsubid .'" class="btn btn-secondary corrSubAvg"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            ';

                        } else {
                            $subEntry = '
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-12 contentToggler" semID="'.$llsubsem.'" llID="'.$llid.'" style="margin-bottom: 10px; cursor: pointer">
                                <hr/>
                                <div class="row">
                                    <div class="col-10">
                                        <h2>'.$translate[38].' '.$llsubsem.'</h2>
                                    </div>
                                    <div class="col-2 text-right">
                                        <i class="fa fa-chevron-down toggleDetails" style="margin-top: 5px;" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="card toggleContent" semID="'.$llsubsem.'" llID="'.$llid.'" style="display:none;">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">'.$translate[114].'</th>
                                            <th scope="col">'.$translate[49].'</th>
                                            <th scope="col">'.$translate[2].'</th>
                                            <th scope="col">'.$translate[115].'</th>
                                            <th scope="col">'.$translate[52].'</th>
                                            <th scope="col">'.$translate[116].'</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">'. $llsubname .'</th>
                                            <td>'. $llsubweight .'%</td>
                                            <td>'. $countgrades .'</td>
                                            <td>'. $countgradesunder .'</td>
                                            <td class="subAvg" subjid="'. $llsubid .'">'. $subgradeavg .'</td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-lg-10 ie11fix">
                                                        <input placeholder="'.$translate[52].'" subjid="'. $llsubid .'" type="number" class="form-control corrSubAvgNum"/>
                                                    </div>
                                                    <div class="col-lg-2" style="padding-left: 0;">
                                                        <button type="button" subjid="'. $llsubid .'" class="btn btn-secondary corrSubAvg"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                            ';
                            $oldllsubsem = $llsubsem;
                        }


                        $subEntries = $subEntries . $subEntry;

                    }

                } else {
                    $subEntries = "<tr><td colspan='5'>".$translate[108].".</td><tr/>";
                }

                if($llsubjs > 0){
                    $calcavg = number_format((float)($llallavg/$llsubjs), 2, '.', '');
                    //$calcavg = "Alle Noten: ".$llallavg." | Anzahl Fächer:" .$llsubjs;
                } else {
                    $calcavg = $translate[100];
                }

                if($gradesunderEntries){
                    $gradesunderEntries = "<hr/><h3>".$translate[53]."</h3>" . $gradesunderEntries;
                }

                $llEntry = '
                <div class="row">
                    <div class="card col-lg-12 userContentBox highlighter">
                        <div class="row userGradesHead header" containerID="'. $llid .'" style="cursor:pointer;">
                            <div class="col-5"><b>'. $llfirst . ' ' . $lllast .' ('. $llbkey .')</b></div>
                            <div class="col-6 text-right">'.$translate[52].': '. $calcavg .'</div>
                            <div class="col-1 text-right"><i class="fa fa-chevron-down toggleDetails" style="margin-top: 5px;" aria-hidden="true"></i></div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 detailedGrades" containerID="'. $llid .'">
                                <div class="row">
                                    <div class="col-12">
                                        <hr/>
                                    </div>
                                </div>
                                <div class="xxx">
                                    <table>
                                        <tbody>

                                            '. $subEntries .'

                                        </tbody>
                                    </table>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        '. $gradesunderEntries .'
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <hr/>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                '.$translate[54].': '. $llsubjs .'
                                            </div>
                                            <br/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                ';

                $llEntries = $llEntries . $llEntry;

            }

        } else {
            $llEntries = $translate[104].". <br/>";
        }

        echo $llEntries;

    ?>


    <script type="text/javascript">
        var translate = {};
        <?php
            foreach ($translate as $key => $value) {
                echo ("translate['".$key."'] = '".$value."';");
            };
        ?>;
    </script>
    <script type="text/javascript" src="modul/noten/noten.min.js"></script>


<?php elseif($session_usergroup == 3 || $session_usergroup == 4 || $session_usergroup == 5) : //LLKV&IT ?>

    <head>
        <style>
        .contentTogglerReady {
            height:60px;
            cursor: pointer;
        }
        </style>
    </head>

    <?php


        //---------------------------------- Bestehende Fächer generieren ---------------------------------------
        $sql = "SELECT us.*, ss.ID AS subSemId  FROM `tb_user_subject` AS us
            INNER JOIN tb_semester AS ss ON ss.ID = us.tb_semester_ID
            WHERE us.tb_user_ID = $session_userid
            ORDER BY ss.semester DESC, us.`creationDate` DESC";

        $result = $mysqli->query($sql);
        $subjects = "";
        $currentSem = "";
        $subSemId = "";

        if (isset($result) && $result->num_rows > 0) {

            while($row = $result->fetch_assoc()) {

                $sql3 = "SELECT * FROM `tb_semester` WHERE tb_group_ID = $session_usergroup";
                $result3 = $mysqli->query($sql3);
                $semesterList = "";

                if (isset($result3) && $result3->num_rows > 0) {

                    while($row3 = $result3->fetch_assoc()) {
                        if($row3['ID'] == $row['tb_semester_ID']){
                            $subjectSemester = $translate[38].": " . $row3['semester'];
                        }
                        $semesterList = $semesterList . "<option value='". $row3['ID'] ."'>". $row3['semester'] ."</option>";
                    }

                }

                $subjectId = $row['ID'];
                $subSemId = $row['subSemId'];
                $subType = $row['school'];

                if($subType == 0){
                    $subType = $translate[60];
                } else {
                    $subType = $translate[59];
                }

                $grades = "";
                $average = "";

                $sql2 = "SELECT * FROM `tb_subject_grade` WHERE tb_user_subject_ID = $subjectId;";
                $result2 = $mysqli->query($sql2);

                if (isset($result2) && $result2->num_rows > 0) {
                    $i = 0;
                    $allGrades = 0;
                    $allWeight = 0;

                    $grades = $grades . '
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>'.$translate[57].'</th>
                                    <th>'.$translate[55].'</th>
                                    <th>'.$translate[56].'</th>
                                    <th>'.$translate[49].'</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                    ';

                    while($row2 = $result2->fetch_assoc()) {

                        $i = $i + 1;
                        $allGrades = $allGrades + ($row2['grade']*($row2['weighting']));
                        $allWeight = $allWeight + $row2['weighting'];

                        $gradeEntry = '
                            <tr gradeId="'. $row2['ID'] .'" class="gradeEntry">
                                <td>' . date('d.m.Y', strtotime($row2['creationDate'])) . '</td>
                                <td class="inFormChange titleChange" gradeId="'. $row2['ID'] .'">' . $row2['title'] . '</td>
                                <td class="inFormChange gradeChange" gradeId="'. $row2['ID'] .'">' . $row2['grade'] . '</td>
                                <td class="inFormChange weightChange" gradeId="'. $row2['ID'] .'">' . $row2['weighting'] . ' %</td>
                                <td><i class="fa fa-pencil editGrade"  onclick="inFormChanges(this)" aria-hidden="true" gradeId="'. $row2['ID'] .'" style="cursor: pointer;"></i> <span class="fa fa-trash-o delGrade" gradeId="'. $row2['ID'] .'" aria-hidden="true" style="cursor: pointer;"></span></td>
                            </tr>
                        ';

                        $grades = $grades . $gradeEntry;

                    }

                    $grades = $grades . '
                            <tr>
                                <td></td>
                                <td><input fSubject="'. $row['ID'] .'" class="form-control fgradeTitle" type="text" placeholder="'.$translate[55].'"/></td>
                                <td><input fSubject="'. $row['ID'] .'" class="form-control fgradeNote" min="1" max="6" type="number" placeholder="'.$translate[56].'"/></td>
                                <td><input fSubject="'. $row['ID'] .'" class="form-control fgradeWeight" min="1" type="number" placeholder="'.$translate[49].' ('.$translate[109].')"/></td>
                                <td><button type="button" fSubject="'. $row['ID'] .'" class="btn addGrade highlighter" style="padding-bottom: 0px; padding-top: 0px; margin-top: 5px;"><span class="fa fa-plus" aria-hidden="true" style="cursor: pointer;"></span></button></td>
                            </tr>
                            <tr class="badDay" fSubject="'. $row['ID'] .'" style="display:none">
                                <td colspan="5"><textarea fSubject="'. $row['ID'] .'" placeholder="'.$translate[110].'" class="form-control fgradeReason"></textarea></td>
                            </tr>
                        </tbody>
                    </table>
                    ';

                    if (isset($allGrades)){
                        $unrounded = round(($allGrades / $allWeight),2);
                        $average = round(($allGrades / $allWeight),2) . ' ≈ ' . round($unrounded * 2) / 2;
                    }

                } else {
                    $grades = '
                    <p>'.$translate[61].'.</p>
                    <table style="width:100%;">
                        <tbody>
                            <tr>
                                <td></td>
                                <td><input fSubject="'. $row['ID'] .'" class="form-control fgradeTitle" type="text" placeholder="'.$translate[55].'"/></td>
                                <td><input fSubject="'. $row['ID'] .'" class="form-control fgradeNote" min="1" max="6" type="number" placeholder="'.$translate[56].'"/></td>
                                <td><input fSubject="'. $row['ID'] .'" class="form-control fgradeWeight" min="1" type="number" placeholder="'.$translate[49].' ('.$translate[109].')"/></td>
                                <td><button type="button" fSubject="'. $row['ID'] .'" class="btn addGrade highlighter" style="padding-bottom: 0px; padding-top: 0px; margin-top: 5px;"><span class="fa fa-plus" aria-hidden="true" style="cursor: pointer; padding: 5px;"></span></button></td>
                            </tr>
                            <tr class="badDay" fSubject="'. $row['ID'] .'" style="display:none">
                                <td colspan="5"><textarea fSubject="'. $row['ID'] .'" placeholder="'.$translate[110].'" class="form-control fgradeReason"></textarea></td>
                            </tr>
                        </tbody>
                    </table>
                    <br/>
                    ';
                }


                if($subSemId == $currentSem){
                    $sorterDiv = "";
                } else if($currentSem == ""){
                    $sorterDiv = "
                    <div class='col-lg-12'>
                        <div class='divtoggler' subSemid='".$subSemId."' style='cursor:pointer;'>
                            <hr/>
                            <div class='row'>
                                <div class='col-10'>
                                    <h2> " . $subjectSemester . " </h2>
                                </div>
                                <div class='col-2 text-right'>
                                    <i class='fa fa-chevron-down toggleDetails' style='margin-top: 5px;' aria-hidden='true'></i>
                                </div>
                            </div>
                        </div>
                        <div class='divtogglercontent' subSemid='".$subSemId."'>

                    ";
                } else {
                    $sorterDiv = "
                    </div>
                    <div class='divtoggler' subSemid='".$subSemId."' style='cursor:pointer;'>
                        <hr/>
                        <div class='row'>
                            <div class='col-10'>
                                <h2> " . $subjectSemester . " </h2>
                            </div>
                            <div class='col-2 text-right'>
                                <i class='fa fa-chevron-down toggleDetails' style='margin-top: 5px;' aria-hidden='true'></i>
                            </div>
                        </div>
                    </div>
                    <div class='divtogglercontent' style='display:none;' subSemid='".$subSemId."'>
                    ";
                }

                if(isset($_GET['subjectID'])){
                    if($row['ID'] == $_GET['subjectID']){
                        $hasToHide = "";
                        $shrimp = '';
                    } else {
                        $hasToHide = 'style="display:none;"';
                        $shrimp = 'contentTogglerReady';
                    }
                } else {
                    $hasToHide = 'style="display:none;"';
                    $shrimp = 'contentTogglerReady';
                }

                if($row['weight'] == NULL){
                    $row['weight'] = 100;
                }

                $subjectEntry = '
                    '. $sorterDiv .'
                        <div fSubject="'. $row['ID'] .'" class="card col-lg-10 delSubTag highlighter '.$shrimp.'" style="padding: 20px;margin-top: 5px; margin-left:auto; margin-right:auto;">
                            <div class="row">
                                <div class="col-6">
                                    <h2>'. $row['subjectName'] .'</h2>
                                </div>
                                <div class="col-6" style="text-align: right;">
                                    <b>'. $average .'</b> <i>('. $row['weight'] .'%)</i>
                                </div>
                            </div>
                            <br/>

                            <div class="row" id="contentToggler_'. $row['ID'] .'_1" '.$hasToHide.'>
                                <div class="col-lg-11" style="margin-left: auto; margin-right: auto;">
                                '. $grades .'
                                </div>
                            </div>

                            <div class="row" id="contentToggler_'. $row['ID'] .'_2" '.$hasToHide.'>
                                <div class="col-lg-6">
                                    <a href="#" class="deleteSubject" subjectId="'. $row['ID'] .'">
                                        <span class="fa fa-trash-o delSubject" subjectId="'. $row['ID'] .'" aria-hidden="true" style="cursor: pointer; font-size: larger;"></span> '.$translate[58].'
                                    </a>
                                </div>
                                <div class="col-lg-6" style="text-align: right;">
                                    '. $subjectSemester .' ('.$subType.')
                                </div>
                            </div>
                        </div>
                ';


                $currentSem = $subSemId;

                $subjects = $subjects . $subjectEntry;

            }
        } else {
            $subjects = "<p>".$translate[112].".</p>";

            $sql3 = "SELECT * FROM `tb_semester` WHERE tb_group_ID = $session_usergroup";
            $result3 = $mysqli->query($sql3);
            $semesterList = "";

            if (isset($result3) && $result3->num_rows > 0) {

                while($row3 = $result3->fetch_assoc()) {
                    $semesterList = $semesterList . "<option value='". $row3['ID'] ."'>". $row3['semester'] ."</option>";
                }
            }
        }

        //---------------------------------- Bestehende Fächer generieren ende ---------------------------------------



    ?>

    <h1 class="mt-5"><?php echo $translate[2];?></h1>
    <div class="col-12 text-right">
        <a href="#" id="exportGrades"><i class="fa fa-sign-out" aria-hidden="true"></i> Export</a>
    </div>
    <p></p>
    <div class="row">
            <?php echo $subjects; ?>
    </div>

        <!-- Neues Fach hinzufügen -->

            <hr/>
            <div class="col-lg-8 card" style="padding-top: 15px; margin: 5px; margin-left:auto; margin-right:auto;">

                <div class="row">
                    <div class="col-12">
                        <h2><?php echo $translate[63];?></h2>
                    </div>
                </div>

                <div class="row">

                    <div class="col-lg-4" style="margin-top: 10px;">
                        <input type="text" id="newSubNam" class="form-control" placeholder="<?php echo $translate[114];?>">
                    </div>

                    <div class="col-lg-4" style="margin-top: 10px;">
                        <input type="text" id="newSubWeight" class="form-control" placeholder="% <?php echo $translate[49];?>">
                    </div>

                    <div class="col-lg-4" style="margin-top: 10px;">
                        <select class="form-control" id="newSubSem" placeholder="<?php echo $translate[113];?>">
                            <option><?php echo $translate[38];?>:</option>
                            <?php echo $semesterList; ?>
                        </select>
                    </div>

                </div>

                <?php

                    if($session_usergroup == 3){
                        echo '
                        <div class="row" id="LIT">
                                <div class="col-lg-6" style="margin-top: 8px;">
                                    <button type="button" selected="" value="1" class="btn btnSelect btn-block highlighter">'.$translate[59].'</button>
                                </div>
                                <div class="col-lg-6" style="margin-top: 8px;">
                                    <button type="button" selected="" value="0" class="btn btnSelect btn-block highlighter">'.$translate[117].'</button>
                                </div>
                        </div>';
                    }

                ?>

                <div class="row">
                    <div class="col-lg-12 text-center" style="margin-top: 10px;">
                        <button type="button" class="btn btn-primary btn-block highlighter" id="addSubject">
                            <span class="fa fa-plus" aria-hidden="true" style="cursor: pointer;"></span> <?php echo $translate[63];?>
                        </button>
                        <br/><br/>
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
    <script type="text/javascript" src="modul/noten/noten.min.js"></script>

<?php else : ?>

    <br/><br/>

    <div class='alert alert-danger'>
        <strong><?php echo $translate[95];?> </strong> <?php echo $translate[94];?>.
    </div>

<?php endif; ?>
