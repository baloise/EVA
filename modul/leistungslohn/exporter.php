<?php include("../../includes/session.php"); ?>
<?php include("../../database/connect.php"); ?>
<?php if($session_usergroup == 1) : ?>

    <div class="col-12">

        <?php

            $sql = "SELECT us.ID, us.bKey, us.tb_group_ID, us.tb_semester_ID, sem.semester, us.firstname, us.lastname FROM `tb_user` AS us
                    LEFT JOIN tb_semester AS sem ON sem.ID = us.tb_semester_ID
                    WHERE us.tb_group_ID IN (3, 4, 5, 6) AND us.deleted IS NULL;";
            $result = $mysqli->query($sql);

            $listLLIT = "";
            $listLLKVV = "";
            $listLLKVB = "";
            $listLLMT = "";

            if (isset($result) && $result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {

                    if($row['tb_group_ID'] == 3){

                        $entry = '
                        <tr class="userEntry LIT" userID="'.$row['ID'].'" bKey="'.$row['bKey'].'">
                            <td>'.$row['firstname'].' '.$row['lastname'].' ('.$row['bKey'].')</td>
                        ';
                        if($row['semester'] > 0){
                            $entry .= '<td class="text-center">'.$row['semester'].'</td>';
                        } else {
                            $entry .= '<td class="text-center alert-warning"><i>???</i></td>';
                        }

                        if($row['semester'] <= 3){
                            $entry .= '
                                <td class="text-center alert-warning cycleChecker" userID="'.$row['ID'].'" ><input class="form-check-input" cycleID="1" type="checkbox" value="1"></td>
                                <td class="text-center alert-warning cycleChecker" userID="'.$row['ID'].'" ><input class="form-check-input" cycleID="2" type="checkbox" value="2"></td>
                                <td class="text-center alert-warning cycleChecker" userID="'.$row['ID'].'" ><input class="form-check-input" cycleID="3" type="checkbox" value="3"></td>
                            ';
                        } else if ($row['semester'] <= 4 && $row['semester'] > 0){
                            $entry .= '
                                <td class="text-center cycleChecker" userID="'.$row['ID'].'" ><input class="form-check-input" cycleID="1" type="checkbox" value="1" checked></td>
                                <td class="text-center cycleChecker" userID="'.$row['ID'].'" ><input class="form-check-input" cycleID="2" type="checkbox" value="2"></td>
                                <td class="text-center cycleChecker" userID="'.$row['ID'].'" ><input class="form-check-input" cycleID="3" type="checkbox" value="3"></td>
                            ';
                        } else if ($row['semester'] <= 6 && $row['semester'] > 0){
                            $entry .= '
                                <td class="text-center cycleChecker" userID="'.$row['ID'].'" ><input class="form-check-input" cycleID="1" type="checkbox" value="1"></td>
                                <td class="text-center cycleChecker" userID="'.$row['ID'].'" ><input class="form-check-input" cycleID="2" type="checkbox" value="2" checked></td>
                                <td class="text-center cycleChecker" userID="'.$row['ID'].'" ><input class="form-check-input" cycleID="3" type="checkbox" value="3"></td>
                            ';
                        } else if ($row['semester'] == 7 && $row['semester'] > 0){
                            $entry .= '
                                <td class="text-center cycleChecker" userID="'.$row['ID'].'" ><input class="form-check-input" cycleID="1" type="checkbox" value="1"></td>
                                <td class="text-center cycleChecker" userID="'.$row['ID'].'" ><input class="form-check-input" cycleID="2" type="checkbox" value="2"></td>
                                <td class="text-center cycleChecker" userID="'.$row['ID'].'" ><input class="form-check-input" cycleID="3" type="checkbox" value="3" checked></td>
                            ';
                        } else {
                            $entry .= '
                                <td class="text-center alert-warning cycleChecker" userID="'.$row['ID'].'" ><input class="form-check-input" cycleID="1" type="checkbox" value="1"></td>
                                <td class="text-center alert-warning cycleChecker" userID="'.$row['ID'].'" ><input class="form-check-input" cycleID="2" type="checkbox" value="2"></td>
                                <td class="text-center alert-warning cycleChecker" userID="'.$row['ID'].'" ><input class="form-check-input" cycleID="3" type="checkbox" value="3"></td>
                            ';
                        }

                        $listLLIT .= $entry . '</tr>';

                    } else if ($row['tb_group_ID'] == 4){

                        $entry = '
                        <tr class="userEntry LKVV" userID="'.$row['ID'].'" bKey="'.$row['bKey'].'">
                            <td>'.$row['firstname'].' '.$row['lastname'].' ('.$row['bKey'].')</td>
                        ';
                        if($row['semester'] > 0){
                            $entry .= '<td class="text-center">'.$row['semester'].'</td>';
                        } else {
                            $entry .= '<td class="text-center alert-warning"><i>???</i></td>';
                        }

                        if($row['semester'] <= 3){
                            $entry .= '
                                <td class="text-center alert-warning cycleChecker" userID="'.$row['ID'].'" ><input class="form-check-input" cycleID="1" type="checkbox" value="1"></td>
                                <td class="text-center alert-warning cycleChecker" userID="'.$row['ID'].'" ><input class="form-check-input" cycleID="2" type="checkbox" value="2"></td>
                                <td class="text-center alert-warning cycleChecker" userID="'.$row['ID'].'" ><input class="form-check-input" cycleID="3" type="checkbox" value="3"></td>
                            ';
                        } else if ($row['semester'] < 5 && $row['semester'] > 0){
                            $entry .= '
                                <td class="text-center cycleChecker" userID="'.$row['ID'].'"><input class="form-check-input" cycleID="4" type="checkbox" value="4" checked></td>
                                <td class="text-center cycleChecker" userID="'.$row['ID'].'"><input class="form-check-input" cycleID="5" type="checkbox" value="5"></td>
                            ';
                        } else if ($row['semester'] <= 6 && $row['semester'] > 0){
                            $entry .= '
                                <td class="text-center cycleChecker" userID="'.$row['ID'].'"><input class="form-check-input" cycleID="4" type="checkbox" value="4"></td>
                                <td class="text-center cycleChecker" userID="'.$row['ID'].'"><input class="form-check-input" cycleID="5" type="checkbox" value="5" checked></td>
                            ';
                        } else {
                            $entry .= '
                                <td class="text-center alert-warning cycleChecker" userID="'.$row['ID'].'"><input class="form-check-input" cycleID="4" type="checkbox" value="4"></td>
                                <td class="text-center alert-warning cycleChecker" userID="'.$row['ID'].'"><input class="form-check-input" cycleID="5" type="checkbox" value="5"></td>
                            ';
                        }

                        $listLLKVV .= $entry . '</tr>';

                    } else if($row['tb_group_ID'] == 5) {

                        $entry = '
                        <tr class="userEntry LKVB" userID="'.$row['ID'].'" bKey="'.$row['bKey'].'">
                            <td>'.$row['firstname'].' '.$row['lastname'].' ('.$row['bKey'].')</td>
                        ';
                        if($row['semester'] > 0){
                            $entry .= '<td class="text-center">'.$row['semester'].'</td>';
                        } else {
                            $entry .= '<td class="text-center alert-warning"><i>???</i></td>';
                        }

                        if($row['semester'] <= 3){
                            $entry .= '
                                <td class="text-center alert-warning cycleChecker" userID="'.$row['ID'].'" ><input class="form-check-input" cycleID="1" type="checkbox" value="1"></td>
                                <td class="text-center alert-warning cycleChecker" userID="'.$row['ID'].'" ><input class="form-check-input" cycleID="2" type="checkbox" value="2"></td>
                                <td class="text-center alert-warning cycleChecker" userID="'.$row['ID'].'" ><input class="form-check-input" cycleID="3" type="checkbox" value="3"></td>
                            ';
                        } else if($row['semester'] < 5 && $row['semester'] > 0){
                            $entry .= '
                                <td class="text-center cycleChecker" userID="'.$row['ID'].'"><input class="form-check-input" cycleID="4" type="checkbox" value="4" checked></td>
                                <td class="text-center cycleChecker" userID="'.$row['ID'].'"><input class="form-check-input" cycleID="5" type="checkbox" value="5"></td>
                            ';
                        } else if ($row['semester'] <= 6 && $row['semester'] > 0){
                            $entry .= '
                                <td class="text-center cycleChecker" userID="'.$row['ID'].'"><input class="form-check-input" cycleID="4" type="checkbox" value="4"></td>
                                <td class="text-center cycleChecker" userID="'.$row['ID'].'"><input class="form-check-input" cycleID="5" type="checkbox" value="5" checked></td>
                            ';
                        } else {
                            $entry .= '
                                <td class="text-center alert-warning cycleChecker" userID="'.$row['ID'].'"><input class="form-check-input" cycleID="4" type="checkbox" value="4"></td>
                                <td class="text-center alert-warning cycleChecker" userID="'.$row['ID'].'"><input class="form-check-input" cycleID="5" type="checkbox" value="5"></td>
                            ';
                        }

                        $listLLKVB .= $entry . '</tr>';

                    } else if($row['tb_group_ID'] == 6){

                        $entry = '
                        <tr class="userEntry LMT" userID="'.$row['ID'].'" bKey="'.$row['bKey'].'">
                            <td>'.$row['firstname'].' '.$row['lastname'].' ('.$row['bKey'].')</td>
                        ';
                        if($row['semester'] > 0){
                            $entry .= '<td class="text-center">'.$row['semester'].'</td>';
                        } else {
                            $entry .= '<td class="text-center alert-warning"><i>???</i></td>';
                        }

                        if($row['semester'] <= 3){
                            $entry .= '
                                <td class="text-center alert-warning cycleChecker" userID="'.$row['ID'].'" ><input class="form-check-input" cycleID="6" type="checkbox" value="6"></td>
                                <td class="text-center alert-warning cycleChecker" userID="'.$row['ID'].'" ><input class="form-check-input" cycleID="7" type="checkbox" value="7"></td>
                                <td class="text-center alert-warning cycleChecker" userID="'.$row['ID'].'" ><input class="form-check-input" cycleID="8" type="checkbox" value="8"></td>
                            ';
                        } else if ($row['semester'] <= 4 && $row['semester'] > 0){
                            $entry .= '
                                <td class="text-center cycleChecker" userID="'.$row['ID'].'" ><input class="form-check-input" cycleID="6" type="checkbox" value="6" checked></td>
                                <td class="text-center cycleChecker" userID="'.$row['ID'].'" ><input class="form-check-input" cycleID="7" type="checkbox" value="7"></td>
                                <td class="text-center cycleChecker" userID="'.$row['ID'].'" ><input class="form-check-input" cycleID="8" type="checkbox" value="8"></td>
                            ';
                        } else if ($row['semester'] <= 6 && $row['semester'] > 0){
                            $entry .= '
                                <td class="text-center cycleChecker" userID="'.$row['ID'].'" ><input class="form-check-input" cycleID="6" type="checkbox" value="6"></td>
                                <td class="text-center cycleChecker" userID="'.$row['ID'].'" ><input class="form-check-input" cycleID="7" type="checkbox" value="7" checked></td>
                                <td class="text-center cycleChecker" userID="'.$row['ID'].'" ><input class="form-check-input" cycleID="8" type="checkbox" value="8"></td>
                            ';
                        } else if ($row['semester'] == 7 && $row['semester'] > 0){
                            $entry .= '
                                <td class="text-center cycleChecker" userID="'.$row['ID'].'" ><input class="form-check-input" cycleID="6" type="checkbox" value="6"></td>
                                <td class="text-center cycleChecker" userID="'.$row['ID'].'" ><input class="form-check-input" cycleID="7" type="checkbox" value="7"></td>
                                <td class="text-center cycleChecker" userID="'.$row['ID'].'" ><input class="form-check-input" cycleID="8" type="checkbox" value="8" checked></td>
                            ';
                        } else {
                            $entry .= '
                                <td class="text-center alert-warning cycleChecker" userID="'.$row['ID'].'" ><input class="form-check-input" cycleID="6" type="checkbox" value="6"></td>
                                <td class="text-center alert-warning cycleChecker" userID="'.$row['ID'].'" ><input class="form-check-input" cycleID="7" type="checkbox" value="7"></td>
                                <td class="text-center alert-warning cycleChecker" userID="'.$row['ID'].'" ><input class="form-check-input" cycleID="8" type="checkbox" value="8"></td>
                            ';
                        }

                        $listLLMT .= $entry . '</tr>';

                    }

                }
            }

        ?>

        <div class="row">
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th style="border-top:none;" scope="col" rowspan="2"><?php echo $translate[190]; ?></th>
                        <th style="border-top:none;" scope="col" class="text-center" rowspan="2"><?php echo $translate[38]; ?></th>
                        <th style="border-top:none;" class="text-center" scope="col" colspan="3"><?php echo $translate[47]; ?></th>
                    </tr>
                    <tr>
                        <th class="text-center" scope="col"><?php echo $translate[48]." 3"; ?></th>
                        <th class="text-center" scope="col"><?php echo $translate[38]." 7"; ?></th>
                        <th class="text-center" scope="col"><?php echo $translate[38]." 8"; ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php echo $listLLIT; ?>
                </tbody>
            </table>
        </div>
        <div class="row">
            <div class="col-lg-3">
                <button id="LIT" class="getCSV btn-block btn btn-lg btn-default highlighter"><i class="fa fa-cogs" aria-hidden="true"></i> Export CSV</button>
            </div>
            <div class="col-lg-3">
                <button onclick="window.location.href='modul/leistungslohn/Serienbrief.docx'" class="btn-block btn btn-lg btn-default highlighter"><i class="fa fa-download" aria-hidden="true"></i> Download Template</button>
            </div>
            <div class="col-lg-6">
                <p class="getCSVnotif" style="padding-top: 10px; display:none; font-size: larger; color: grey;">
                    <b><i>Please wait, your file is getting prepared...</i></b>
                </p>
            </div>
        </div>

        <div class="row">
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th style="border-top:none;" scope="col" rowspan="2"><?php echo $translate[190]; ?></th>
                        <th style="border-top:none;" scope="col" class="text-center" rowspan="2"><?php echo $translate[38]; ?></th>
                        <th style="border-top:none;" class="text-center" scope="col" colspan="3"><?php echo $translate[47]; ?></th>
                    </tr>
                    <tr>
                        <th class="text-center" scope="col"><?php echo $translate[48]." 3"; ?></th>
                        <th class="text-center" scope="col"><?php echo $translate[38]." 7"; ?></th>
                        <th class="text-center" scope="col"><?php echo $translate[38]." 8"; ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php echo $listLLMT; ?>
                </tbody>
            </table>
        </div>
        <div class="row">
            <div class="col-lg-3">
                <button id="LMT" class="getCSV btn-block btn btn-lg btn-default highlighter"><i class="fa fa-cogs" aria-hidden="true"></i> Export CSV</button>
            </div>
            <div class="col-lg-3">
                <button onclick="window.location.href='modul/leistungslohn/Serienbrief.docx'" class="btn-block btn btn-lg btn-default highlighter"><i class="fa fa-download" aria-hidden="true"></i> Download Template</button>
            </div>
            <div class="col-lg-6">
                <p class="getCSVnotif" style="padding-top: 10px; display:none; font-size: larger; color: grey;">
                    <b><i>Please wait, your file is getting prepared...</i></b>
                </p>
            </div>
        </div>

        <div class="row">
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th style="border-top:none;" scope="col" rowspan="2"><?php echo $translate[192]; ?></th>
                        <th style="border-top:none;" scope="col" class="text-center" rowspan="2"><?php echo $translate[38]; ?></th>
                        <th style="border-top:none;" class="text-center" scope="col" colspan="2"><?php echo $translate[47]; ?></th>
                    </tr>
                    <tr>
                        <th class="text-center" scope="col"><?php echo $translate[38]." 5"; ?></th>
                        <th class="text-center" scope="col"><?php echo $translate[38]." 6"; ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php echo $listLLKVB; ?>
                </tbody>
            </table>
        </div>
        <div class="row">
            <div class="col-lg-3">
                <button id="LKVB" class="getCSV btn-block btn btn-lg btn-default highlighter"><i class="fa fa-cogs" aria-hidden="true"></i> Export CSV</button>
            </div>
            <div class="col-lg-3">
                <button onclick="window.location.href='modul/leistungslohn/Serienbrief.docx'" class="btn-block btn btn-lg btn-default highlighter"><i class="fa fa-download" aria-hidden="true"></i> Download Template</button>
            </div>
            <div class="col-lg-6">
                <p class="getCSVnotif" style="padding-top: 10px; display:none; font-size: larger; color: grey;">
                    <b><i>Please wait, your file is getting prepared...</i></b>
                </p>
            </div>
        </div>

        <div class="row">
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th style="border-top:none;" scope="col" rowspan="2"><?php echo $translate[191]; ?></th>
                        <th style="border-top:none;" scope="col" class="text-center" rowspan="2"><?php echo $translate[38]; ?></th>
                        <th style="border-top:none;" class="text-center" scope="col" colspan="2"><?php echo $translate[47]; ?></th>
                    </tr>
                    <tr>
                        <th class="text-center" scope="col"><?php echo $translate[38]." 5"; ?></th>
                        <th class="text-center" scope="col"><?php echo $translate[38]." 6"; ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php echo $listLLKVV; ?>
                </tbody>
            </table>
        </div>
        <div class="row">
            <div class="col-lg-3">
                <button id="LKVV" class="getCSV btn-block btn btn-lg btn-default highlighter"><i class="fa fa-cogs" aria-hidden="true"></i> Export CSV</button>
            </div>
            <div class="col-lg-3">
                <button onclick="window.location.href='modul/leistungslohn/Serienbrief.docx'" class="btn-block btn btn-lg btn-default highlighter"><i class="fa fa-download" aria-hidden="true"></i> Download Template</button>
            </div>
            <div class="col-lg-6">
                <p class="getCSVnotif" style="padding-top: 10px; display:none; font-size: larger; color: grey;">
                    <b><i>Please wait, your file is getting prepared...</i></b>
                </p>
            </div>
        </div>

    </div>

    <script type="text/javascript" src="modul/leistungslohn/js/exporter.js"></script>

<?php else : ?>

    <br/><br/>

    <div class='alert alert-danger'>
        <strong><?php echo $translate[95];?> </strong> <?php echo $translate[94];?>
    </div>

<?php endif; ?>
