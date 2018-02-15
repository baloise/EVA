<?php include("../session/session.php"); ?>
<?php include("../../database/connect.php"); ?>
<?php if($session_usergroup == 1) : ?>

    <head>
        <link rel="stylesheet" href="modul/leistungslohn/leistungslohn.css"/>
    </head>

    <h1 class="mt-5">Leistungslohn</h1>
    
    <?php
    
        $groups = "";
    
        //GRUPPEN
    
        $sql = "SELECT grou.ID AS groupID, grou.name AS groupName FROM `tb_group` AS grou WHERE grou.ID IN (3,4,5);";
        $result = $mysqli->query($sql);
        
        if (isset($result) && $result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                
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
                        
                        $usersEntry = '
                            <div class="row">
                                <div class="col-lg-12 card">
                                    <div class="row userHeader" userID="'.$userID.'" onclick="toggleUser('.$userID.');">
                                        <div class="col-10">
                                            <h2>'.$userFirstname.' '.$userLastname.' ('.$userBkey.')</h2>
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
                                                
                                                    <div class="row">
                                                        <div class="col-lg-12 card">
                                                            <div class="row cycleHeader" userID="'.$userID.'" cycleID="1" onclick="toggleCycle('.$userID.', 1);">
                                                                <div class="col-10">
                                                                    <h2>Jahr 3</h2>
                                                                </div>
                                                                <div class="col-2 text-right">
                                                                    <i class="fa fa-chevron-down" style="margin-top: 5px;" aria-hidden="true"></i>
                                                                </div>
                                                            </div>
                                                            <div class="row cycleContent" userID="'.$userID.'" cycleID="1">
                                                                
                                                                <div class="col-12 text-center loading">
                                                                    <img src="img/loading2_big.gif"/>
                                                                </div>
                                                                
                                                                <!-- AJAX CALL -->
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="row">
                                                        <div class="col-lg-12 card">
                                                            <div class="row cycleHeader" userID="'.$userID.'" cycleID="2" onclick="toggleCycle('.$userID.', 2);">
                                                                <div class="col-10">
                                                                    <h2>Semester 7</h2>
                                                                </div>
                                                                <div class="col-2 text-right">
                                                                    <i class="fa fa-chevron-down" style="margin-top: 5px;" aria-hidden="true"></i>
                                                                </div>
                                                            </div>
                                                            <div class="row cycleContent" userID="'.$userID.'" cycleID="2">
                                                                
                                                                <div class="col-12 text-center loading">
                                                                    <img src="img/loading2_big.gif"/>
                                                                </div>
                                                                
                                                                <!-- AJAX CALL -->
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="row">
                                                        <div class="col-lg-12 card">
                                                            <div class="row cycleHeader" userID="'.$userID.'" cycleID="3" onclick="toggleCycle('.$userID.', 3);">
                                                                <div class="col-10">
                                                                    <h2>Semester 8</h2>
                                                                </div>
                                                                <div class="col-2 text-right">
                                                                    <i class="fa fa-chevron-down" style="margin-top: 5px;" aria-hidden="true"></i>
                                                                </div>
                                                            </div>
                                                            <div class="row cycleContent" userID="'.$userID.'" cycleID="3">
                                                                
                                                                <div class="col-12 text-center loading">
                                                                    <img src="img/loading2_big.gif"/>
                                                                </div>
                                                                
                                                                <!-- AJAX CALL -->
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
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
                                    <h2>'.$groupName.'</h2>
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
            echo "Keine Gruppen gefunden.";
        }
        
        //GRUPPEN ENDE
        
        
    
    ?>
    
    <!-- GRUPPEN -->
    
    <div class="row">
        <div class="col-lg-12 card">
            <div class="row groupHeader" groupID="1" onclick="toggleGroup(1);">
                <div class="col-10">
                    <h2>Informatiker</h2>
                </div>
                <div class="col-2 text-right">
                    <i class="fa fa-chevron-down" style="margin-top: 5px;" aria-hidden="true"></i>
                </div>
            </div>
            <div class="row groupContent" groupID="1">
                <div class="col-12">
                    <hr/>
                </div>
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-12">
                            
                            <!-- LEHRLINGE -->
                            
                            <div class="row">
                                <div class="col-lg-12 card">
                                    <div class="row userHeader" userID="1" onclick="toggleUser(1);">
                                        <div class="col-10">
                                            <h2>Elia Reutlinger</h2>
                                        </div>
                                        <div class="col-2 text-right">
                                            <i class="fa fa-chevron-down" style="margin-top: 5px;" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                    <div class="row userContent" userID="1">
                                        <div class="col-12">
                                            <hr/>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    
                                                    <!-- BERECHNUNGSZYKLEN -->
                                                    
                                                    <div class="row">
                                                        <div class="col-lg-12 card">
                                                            <div class="row cycleHeaderExam" userID="1" cycleID="1" onclick="toggleCycleExam(1, 1);">
                                                                <div class="col-10">
                                                                    <h2>Jahr 3</h2>
                                                                </div>
                                                                <div class="col-2 text-right">
                                                                    <i class="fa fa-chevron-down" style="margin-top: 5px;" aria-hidden="true"></i>
                                                                </div>
                                                            </div>
                                                            <div class="row cycleContentExam" userID="1" cycleID="1">
                                                                <div class="col-12">
                                                                    <hr/>
                                                                </div>
                                                                
                                                                <!-- PER AJAX CALLEN -->
                                                            
                                                                    <div class="col-lg-12">
                                                                        <div class="row">
                                                                            <div class="col-lg-12">
                                                                                
                                                                                Leistungslohn anhand aktueller Werte: <b>1500.-</b> (88.9%)<br/>
                                                                                <i>(Durchschnitt Semester 1-4)</i>
                                                                                
                                                                                <!-- SEMESTER -->
                                                        
                                                                                <div class="row">
                                                                                    <div class="col-lg-12 card">
                                                                                        <div class="row semesterHeader" userID="1" semesterID="1" onclick="toggleSemester(1, 1);">
                                                                                            <div class="col-10">
                                                                                                <h2>Semester 1</h2>
                                                                                            </div>
                                                                                            <div class="col-2 text-right">
																								<span><b>88.9%</b></span>
                                                                                                <i class="fa fa-chevron-down" style="margin-top: 5px;" aria-hidden="true"></i>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="row semesterContent" userID="1" semesterID="1">
                                                                                            <div class="col-12">
                                                                                                <hr/>
                                                                                            </div>
                                                                                            <div class="col-lg-12">
                                                                                                <div class="row">
                                                                                                    <div class="col-lg-12">
                                                                                                        
                                                                                                        <!-- BERECHNUNGEN -->
                                                                                                        
                                                                                                        <div class="col-lg-12 card">
                                                                                                            <br/>
                                                                                                            <table class="table calcTable">
																												<tr>
                                                                                                                    <td><b>Leistung Informatik</b></td>
                                                                                                                    <td class="calcTableResult"><b>90%</b></td>
                                                                                                                </tr>
                                                                                                                <tr>
                                                                                                                    <td>Notenschnitt Informatik-Module und ÜKs</td>
                                                                                                                    <td class="calcTableResult">90%</td>
                                                                                                                </tr>
                                                                                                            </table>
                                                                                                        </div>
                                                                                                        
                                                                                                        <div class="col-lg-12 card">
                                                                                                            <br/>
                                                                                                            <table class="table calcTable">
																												<tr>
                                                                                                                    <td><b>Leistung Schule</b></td>
                                                                                                                    <td class="calcTableResult"><b>90%</b></td>
                                                                                                                </tr>
                                                                                                                <tr>
                                                                                                                    <td>Notenschnitt Schulfächer und ÜKs</td>
                                                                                                                    <td class="calcTableResult">90%</td>
                                                                                                                </tr>
                                                                                                            </table>
                                                                                                        </div>
                                                                                                        
                                                                                                        <div class="col-lg-12 card">
                                                                                                            <br/>
                                                                                                            <table class="table calcTable">
																												<tr>
																													<td><b>Verhalten Betrieb</b></td>
                                                                                                                    <td class="calcTableResult"><b>87.5%</b></td>
																												</tr>
                                                                                                                <tr>
                                                                                                                    <td>Verhaltensziele</td>
                                                                                                                    <td class="calcTableResult">80%</td>
                                                                                                                </tr>
                                                                                                                <tr>
                                                                                                                    <td>Terminmanagement</td>
                                                                                                                    <td class="calcTableResult">95%</td>
                                                                                                                </tr>
                                                                                                            </table>
                                                                                                        </div>
                                                                                                        
                                                                                                        <!-- BERECHNUNGEN ENDE -->
                                                                                                        
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                
                                                                                <!-- SEMESTER ENDE -->
                                                                                
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                
                                                                <!-- PER AJAX CALLEN ENDE -->
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <!-- BERECHNUNGSZYKLEN ENDE -->
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- LEHRLINGE ENDE -->
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- GRUPPEN ENDE -->
    
    <script type="text/javascript" src="modul/leistungslohn/leistungslohn.js"></script> 
    
    
<?php elseif($session_usergroup == 3) : ?>

    <h1 class="mt-5">Leistungslohn</h1>
    <p>Sie sind Informatik-Lehrling</p>

<?php elseif($session_usergroup == 4) : ?>

    <h1 class="mt-5">Leistungslohn</h1>
    <p>Sie sind KV-Lehrling Versicherung</p>

<?php elseif($session_usergroup == 5) : ?>

    <h1 class="mt-5">Leistungslohn</h1>
    <p>Sie sind KV-Lehrling Bank</p>
    
<?php else : ?>
    
    <br/><br/>
    
    <div class='alert alert-danger'>
        <strong>Fehler </strong> Sie haben keine Berechtigungen zu diesem Modul.
        Falls Sie das für einen Fehler halten, wenden Sie sich bitte an einen <a href='mailto:elia.reutlinger@baloise.ch'>Administrator</a>.
    </div>
    
<?php endif; ?>