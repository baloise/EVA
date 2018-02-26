<?php include("../session/session.php"); ?>
<?php include("../../database/connect.php"); ?>
<?php if($session_usergroup == 1) : ?>

    <head>
        <link rel="stylesheet" href="modul/leistungslohn/leistungslohn.css"/>
    </head>

    <h1 class="mt-5"><?php echo $translate[7];?></h1>

    <div class="form-group">
        <i class="fa fa-search" style="position: absolute; padding: 10px; right: 15px;" aria-hidden="true"></i>
        <input type="text" class="form-control" id="searchInput" onkeyup="search()" placeholder="">
    </div>
    <div id="searchList">
    <?php

        $groups = "";

        //GRUPPEN

        $sql = "SELECT grou.ID AS groupID, grou.name AS groupName FROM `tb_group` AS grou WHERE grou.ID IN (3,4,5);";
        $groupResult = $mysqli->query($sql);

        if (isset($groupResult) && $groupResult->num_rows > 0) {
            while($row = $groupResult->fetch_assoc()) {

                $groupID = $row['groupID'];
                $groupName = $row['groupName'];

                $users = "";

                //LEHRLINGE

                $sql = "SELECT us.ID AS userID, us.firstname AS userFirstname, us.lastname AS userLastname, us.bKey AS userBkey FROM `tb_user` AS us WHERE us.tb_group_ID = ". $groupID ." AND deleted IS NULL";
                $result = $mysqli->query($sql);

                if (isset($result) && $result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {

                        $userID = $row['userID'];
                        $userFirstname = $row['userFirstname'];
                        $userLastname = $row['userLastname'];
                        $userBkey = $row['userBkey'];

                        if($groupID == 3){

                            $cycleList = '
                                <!-- BERECHNUNGSZYKLEN INFORMATIKER -->

                                <div class="row">
                                    <div class="col-lg-12 card">
                                        <div class="row cycleHeader" userID="'.$userID.'" cycleID="1" onclick="toggleCycle('.$userID.', 1);">
                                            <div class="col-10">
                                                <h2>'.$translate[47].' ' . $translate[48] .' 3</h2>
                                            </div>
                                            <div class="col-2 text-right">
                                                <i class="fa fa-chevron-down" style="margin-top: 5px;" aria-hidden="true"></i>
                                            </div>
                                        </div>
                                        <div class="row cycleContent" userID="'.$userID.'" cycleID="1">

                                            <div class="col-12 text-center loading">
                                                <img class="img-responsive" src="img/loading2_big.svg"/>
                                            </div>

                                            <!-- AJAX CALL -->

                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 card">
                                        <div class="row cycleHeader" userID="'.$userID.'" cycleID="2" onclick="toggleCycle('.$userID.', 2);">
                                            <div class="col-10">
                                                <h2>'.$translate[47].' '.$translate[38].' 7</h2>
                                            </div>
                                            <div class="col-2 text-right">
                                                <i class="fa fa-chevron-down" style="margin-top: 5px;" aria-hidden="true"></i>
                                            </div>
                                        </div>
                                        <div class="row cycleContent" userID="'.$userID.'" cycleID="2">

                                            <div class="col-12 text-center loading">
                                                <img class="img-responsive" src="img/loading2_big.svg"/>
                                            </div>

                                            <!-- AJAX CALL -->

                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 card">
                                        <div class="row cycleHeader" userID="'.$userID.'" cycleID="3" onclick="toggleCycle('.$userID.', 3);">
                                            <div class="col-10">
                                                <h2>'.$translate[47].' '.$translate[38].' 8</h2>
                                            </div>
                                            <div class="col-2 text-right">
                                                <i class="fa fa-chevron-down" style="margin-top: 5px;" aria-hidden="true"></i>
                                            </div>
                                        </div>
                                        <div class="row cycleContent" userID="'.$userID.'" cycleID="3">

                                            <div class="col-12 text-center loading">
                                                <img class="img-responsive" src="img/loading2_big.svg"/>
                                            </div>

                                            <!-- AJAX CALL -->

                                        </div>
                                    </div>
                                </div>

                                <!-- BERECHNUNGSZYKLEN INFORMATIKER ENDE -->
                            ';

                        } else if ($groupID == 4 || $groupID == 5){

                            $cycleList = '
                                <!-- BERECHNUNGSZYKLEN KV VERSICHERUNG -->

                                <div class="row">
                                    <div class="col-lg-12 card">
                                        <div class="row cycleHeader" userID="'.$userID.'" cycleID="4" onclick="toggleCycle('.$userID.', 4);">
                                            <div class="col-10">
                                                <h2>'.$translate[47].' '.$translate[38].' 5</h2>
                                            </div>
                                            <div class="col-2 text-right">
                                                <i class="fa fa-chevron-down" style="margin-top: 5px;" aria-hidden="true"></i>
                                            </div>
                                        </div>
                                        <div class="row cycleContent" userID="'.$userID.'" cycleID="4">

                                            <div class="col-12 text-center loading">
                                                <img class="img-responsive" src="img/loading2_big.svg"/>
                                            </div>

                                            <!-- AJAX CALL -->

                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 card">
                                        <div class="row cycleHeader" userID="'.$userID.'" cycleID="5" onclick="toggleCycle('.$userID.', 5);">
                                            <div class="col-10">
                                                <h2>'.$translate[47].' '.$translate[38].' 6</h2>
                                            </div>
                                            <div class="col-2 text-right">
                                                <i class="fa fa-chevron-down" style="margin-top: 5px;" aria-hidden="true"></i>
                                            </div>
                                        </div>
                                        <div class="row cycleContent" userID="'.$userID.'" cycleID="5">

                                            <div class="col-12 text-center loading">
                                                <img class="img-responsive" src="img/loading2_big.svg"/>
                                            </div>

                                            <!-- AJAX CALL -->

                                        </div>
                                    </div>
                                </div>

                                <!-- BERECHNUNGSZYKLEN KV VERSICHERUNG ENDE -->
                            ';

                        }

                        $usersEntry = '
                            <div class="row searchRow">
                                <div class="col-lg-12 card bg-color">
                                    <div class="row userHeader" userID="'.$userID.'" onclick="toggleUser('.$userID.');">
                                        <div class="col-10">
                                            <h2 class="searchFor">'.$userFirstname.' '.$userLastname.' ('.$userBkey.')</h2>
                                        </div>
                                        <div class="col-2 text-right">
                                            <i class="fa fa-chevron-down" style="margin-top: 5px;" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                    <div class="row userContent" userID="'.$userID.'">
                                        <div class="col-12">
                                            <hr/>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="row">
                                                <div class="col-lg-12">

                                                    <!-- BERECHNUNGSZYKLEN -->

                                                    '.$cycleList.'

                                                    <!-- BERECHNUNGSZYKLEN ENDE -->

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        ';

                        $users = $users . $usersEntry;

                    }
                 } else {
                    $users = "Keine Benutzer gefunden.";
                 }

                //LEHRLINGE ENDE

                $groupsEntry = '
                    <div class="row">
                        <div class="col-lg-12 card">
                            <div class="row groupHeader" groupID="'.$groupID.'" onclick="toggleGroup('.$groupID.');">
                                <div class="col-10">
                                    <h2>'.$translate[$groupName].'</h2>
                                </div>
                                <div class="col-2 text-right">
                                    <i class="fa fa-chevron-down" style="margin-top: 5px;" aria-hidden="true"></i>
                                </div>
                            </div>
                            <div class="row groupContent" groupID="'.$groupID.'">
                                <div class="col-12">
                                    <hr/>
                                </div>
                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            '.$users.'
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                ';

                $groups = $groups . $groupsEntry;

            }

            echo $groups;

        } else {
            echo $translate[100].".";
        }

        //GRUPPEN ENDE
    ?>

    </div>
    <br/>
    <hr/>
    <h2><?php echo $translate[106];?></h2>

    <script type="text/javascript">
        var translate = {};
        <?php
            foreach ($translate as $key => $value) {
                echo ("translate['".$key."'] = '".$value."';");
            };
        ?>;
    </script>
    <script type="text/javascript" src="modul/leistungslohn/leistungslohn.js"></script>

<?php elseif($session_usergroup == 4 || $session_usergroup == 3 || $session_usergroup == 5) : ?>

    <head>
        <link rel="stylesheet" href="modul/leistungslohn/leistungslohn.css"/>
    </head>

    <h1 class="mt-5"><?php echo $translate[7];?></h1>

    <?php

    //LEHRLINGE

        $sql = "SELECT us.ID AS userID, us.firstname AS userFirstname, us.lastname AS userLastname, us.bKey AS userBkey FROM `tb_user` AS us WHERE us.ID = $session_userid";
        $result = $mysqli->query($sql);

        if (isset($result) && $result->num_rows == 1) {
            while($row = $result->fetch_assoc()) {

                $userID = $row['userID'];
                $userFirstname = $row['userFirstname'];
                $userLastname = $row['userLastname'];
                $userBkey = $row['userBkey'];

                if($session_usergroup == 3){

                    $cycleList = '
                        <!-- BERECHNUNGSZYKLEN INFORMATIKER -->

                        <div class="row">
                            <div class="col-lg-12 card">
                                <div class="row cycleHeader" userID="'.$userID.'" cycleID="1" onclick="toggleCycle('.$userID.', 1);">
                                    <div class="col-10">
                                        <h2>'.$translate[47].' '.$translate[47].' 3</h2>
                                    </div>
                                    <div class="col-2 text-right">
                                        <i class="fa fa-chevron-down" style="margin-top: 5px;" aria-hidden="true"></i>
                                    </div>
                                </div>
                                <div class="row cycleContent" userID="'.$userID.'" cycleID="1">

                                    <div class="col-12 text-center loading">
                                        <img class="img-responsive" src="img/loading2_big.svg"/>
                                    </div>

                                    <!-- AJAX CALL -->

                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12 card">
                                <div class="row cycleHeader" userID="'.$userID.'" cycleID="2" onclick="toggleCycle('.$userID.', 2);">
                                    <div class="col-10">
                                        <h2>'.$translate[47].' '.$translate[38].' 7</h2>
                                    </div>
                                    <div class="col-2 text-right">
                                        <i class="fa fa-chevron-down" style="margin-top: 5px;" aria-hidden="true"></i>
                                    </div>
                                </div>
                                <div class="row cycleContent" userID="'.$userID.'" cycleID="2">

                                    <div class="col-12 text-center loading">
                                        <img class="img-responsive" src="img/loading2_big.svg"/>
                                    </div>

                                    <!-- AJAX CALL -->

                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12 card">
                                <div class="row cycleHeader" userID="'.$userID.'" cycleID="3" onclick="toggleCycle('.$userID.', 3);">
                                    <div class="col-10">
                                        <h2>'.$translate[47].' '.$translate[38].' 8</h2>
                                    </div>
                                    <div class="col-2 text-right">
                                        <i class="fa fa-chevron-down" style="margin-top: 5px;" aria-hidden="true"></i>
                                    </div>
                                </div>
                                <div class="row cycleContent" userID="'.$userID.'" cycleID="3">

                                    <div class="col-12 text-center loading">
                                        <img class="img-responsive" src="img/loading2_big.svg"/>
                                    </div>

                                    <!-- AJAX CALL -->

                                </div>
                            </div>
                        </div>

                        <!-- BERECHNUNGSZYKLEN INFORMATIKER ENDE -->
                    ';

                } else if ($session_usergroup == 4 || $session_usergroup == 5){

                    $cycleList = '
                        <!-- BERECHNUNGSZYKLEN KV VERSICHERUNG -->

                        <div class="row">
                            <div class="col-lg-12 card">
                                <div class="row cycleHeader" userID="'.$userID.'" cycleID="4" onclick="toggleCycle('.$userID.', 4);">
                                    <div class="col-10">
                                        <h2>'.$translate[47].' '.$translate[38].' 5</h2>
                                    </div>
                                    <div class="col-2 text-right">
                                        <i class="fa fa-chevron-down" style="margin-top: 5px;" aria-hidden="true"></i>
                                    </div>
                                </div>
                                <div class="row cycleContent" userID="'.$userID.'" cycleID="4">

                                    <div class="col-12 text-center loading">
                                        <img class="img-responsive" src="img/loading2_big.svg"/>
                                    </div>

                                    <!-- AJAX CALL -->

                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12 card">
                                <div class="row cycleHeader" userID="'.$userID.'" cycleID="5" onclick="toggleCycle('.$userID.', 5);">
                                    <div class="col-10">
                                        <h2>'.$translate[47].' '.$translate[38].' 6</h2>
                                    </div>
                                    <div class="col-2 text-right">
                                        <i class="fa fa-chevron-down" style="margin-top: 5px;" aria-hidden="true"></i>
                                    </div>
                                </div>
                                <div class="row cycleContent" userID="'.$userID.'" cycleID="5">

                                    <div class="col-12 text-center loading">
                                        <img class="img-responsive" src="img/loading2_big.svg"/>
                                    </div>

                                    <!-- AJAX CALL -->

                                </div>
                            </div>
                        </div>

                        <!-- BERECHNUNGSZYKLEN KV VERSICHERUNG ENDE -->
                    ';

                }

                $sql2 = "SELECT mal.*, sem.semester FROM `tb_malus` AS mal
                        INNER JOIN tb_semester AS sem ON mal.tb_semester_ID = sem.ID
                        WHERE tb_user_ID = $session_userid ORDER BY tb_semester_ID";
                $result2 = $mysqli->query($sql2);

                $malusList = "";

                if (isset($result2) && $result2->num_rows > 0) {
                    while($row2 = $result2->fetch_assoc()) {

                        $malusList = $malusList . '
                        <div class="row">
                            <div class="col-2 text-center">
                                <h2>'.$row2["weight"].' %</h2>
                            </div>
                            <div class="col-10">
                                <b>'.$translate[113].': '.$row2["semester"].'</b><br/>
                                '.$row2["description"].'
                                <br/><br/>
                            </div>
                        </div>
                        ';

                    }
                } else {
                    $malusList = $translate[248];
                }

                $usersEntry = '
                    <div class="row">
                        <div class="col-lg-12 card" style="background-color: #F1F4FB;">
                            <div class="row" userID="'.$userID.'" onclick="toggleUser('.$userID.');">
                                <div class="col-10">
                                    <h2>'.$userFirstname.' '.$userLastname.' ('.$userBkey.')</h2>
                                </div>
                                <div class="col-2 text-right">
                                </div>
                            </div>
                            <div class="row" userID="'.$userID.'">
                                <div class="col-12">
                                    <hr/>
                                </div>
                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="col-lg-12">

                                            <!-- BERECHNUNGSZYKLEN -->

                                            '.$cycleList.'

                                            <!-- BERECHNUNGSZYKLEN ENDE -->

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <h1 class="mt-5">'.$translate[8].'</h1>
                        </div>
                        <div class="col-12">

                            '.$malusList.'

                        </div>
                    </div>
                ';

                echo $usersEntry;

            }
        } else {
            echo $translate[100].".";
        }

        //LEHRLINGE ENDE

    ?>

    <script type="text/javascript">
        var translate = {};
        <?php
            foreach ($translate as $key => $value) {
                echo ("translate['".$key."'] = '".$value."';");
            };
        ?>;
    </script>
    <script type="text/javascript" src="modul/leistungslohn/leistungslohn.js"></script>

<?php else : ?>

    <br/><br/>

    <div class='alert alert-danger'>
        <strong><?php echo $translate[95];?> </strong> <?php echo $translate[94];?>
    </div>

<?php endif; ?>
