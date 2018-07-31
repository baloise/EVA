<?php include("../../includes/session.php"); ?>
<?php include("../../database/connect.php"); ?>
<?php include("../../includes/alerts.php"); ?>

<?php if($session_usergroup == 1) : ?>

    <?php

        $listEntries = "";

        $sql = "SELECT ID, bKey, firstname, lastname FROM `tb_user` WHERE tb_group_ID IN (3, 4, 5) AND deleted IS NULL;";
        $result = $mysqli->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {

                $entry = '
                <div class="row searchRow">
                    <div class="card col-lg-12 userContentBox highlighter">
                        <div class="row header" userId="'.$row['ID'].'" style="cursor:pointer;">
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
                                        <img class="img-responsive" src="img/loading2_big.svg" height="50px"/>
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
    <div id="searchList" class="col-lg-12" style="max-height: 900px; overflow-y: auto; overflow-x: hidden;">
        <?php echo $listEntries; ?>
    </div>

    <div class="row" id="getEditor">
        <div class="col-12" style="cursor:pointer;">
            <h1 style="padding-top:10px;"><i class="fa fa-pencil" aria-hidden="true"></i> <?php echo $translate[81];?></h1>
        </div>
    </div>
    <div id="editDeadlinesContent" loaded="false" style="display:none;">

    </div>

    <script type="text/javascript">
        var translate = {};
        <?php
            foreach ($translate as $key => $value) {
                echo ("translate['".$key."'] = '".$value."';");
            };
        ?>;
    </script>
    <script type="text/javascript" src="modul/terminmanagement/js/modifyhr.min.js"></script>


<?php elseif($session_usergroup == 3 || $session_usergroup == 4 || $session_usergroup == 5) : ?>

    <h1 class="mt-5"><?php echo $translate[12];?></h1>

    <?php

        $sql = "SELECT * FROM `tb_semester` AS sem WHERE sem.tb_group_ID = $session_usergroup";
        $result = $mysqli->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {

                $semesterid = $row['ID'];
                $semesterTitle = $row['semester'];
                $entries = "";

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
                                    <div class="col-lg-12 card alert-success highlighter" style="padding-top: 10px; margin-bottom: 10px;">
                                        <h3>'.$deadlineTitle.'</h3>
                                        <p>'.$deadlineDescription.'</p>
                                        <p>'.$translate[80].': <b>'.$deadlineDate.'</b></p>
                                    </div>
                                </div>
                            ';

                            $entries = $entries . $entry;

                        } else {

                            if($row2['tb_semester_ID'] < $session_semesterid){

                                $entry = '
                                    <div class="row">
                                        <div class="col-lg-12 card alert-danger highlighter" style="padding-top: 10px; margin-bottom: 10px; background-color: #F1F4FB;">
                                            <h3>'.$deadlineTitle.'</h3>
                                            <p>'.$deadlineDescription.'</p>
                                            <p>'.$translate[80].': <b>'.$deadlineDate.'</b></p>
                                        </div>
                                    </div>
                                ';

                                $entries = $entries . $entry;

                            } else {

                                $entry = '
                                    <div class="row">
                                        <div class="col-lg-12 card highlighter" style="padding-top: 10px; margin-bottom: 10px; background-color: #F1F4FB;">
                                            <h3>'.$deadlineTitle.'</h3>
                                            <p>'.$deadlineDescription.'</p>
                                            <p>'.$translate[80].': <b>'.$deadlineDate.'</b></p>
                                        </div>
                                    </div>
                                ';

                                $entries = $entries . $entry;

                            }

                        }

                    }
                } else {
                    $entries = $translate[123];
                }

                $istoggled = "";

                if($session_semesterid != $semesterid){
                    $istoggled = "style='display:none;'";
                }

                if(!$entries){
                    $entries = $translate[123];
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
                    <div class="divtogglercontent" '.$istoggled.' subSemid="'.$semesterid.'">
                        <div class="row">
                            <div class="col-12">
                                <h2>'.$translate[78].':</h2>
                            </div>
                            <div class="col-12">
                                '.$entries.'
                            </div>
                        </div>
                    </div>
                ';

                echo $entry;

            }
        }


    ?>

    <script type="text/javascript" src="modul/terminmanagement/js/modifyll.min.js"></script>

<?php else : ?>

    <br/><br/>

    <div class='alert alert-danger'>
        <strong><?php echo $translate[95];?> </strong> <?php echo $translate[94];?>.
    </div>

<?php endif; ?>
