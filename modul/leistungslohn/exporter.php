<?php include("../../includes/session.php"); ?>
<?php include("../../database/connect.php"); ?>
<?php if($session_usergroup == 1) : ?>

    <div class="col-12">

        <?php

            $sql = "SELECT us.ID, us.bKey, us.tb_group_ID, us.tb_semester_ID, sem.semester, us.firstname, us.lastname FROM `tb_user` AS us
                    LEFT JOIN tb_semester AS sem ON sem.ID = us.tb_semester_ID
                    WHERE us.tb_group_ID IN (3, 4, 5) AND us.deleted IS NULL;";
            $result = $mysqli->query($sql);

            $listLLIT = "";
            $listLLKV = "";

            if (isset($result) && $result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {

                    if($row['tb_group_ID'] == 3){

                        $entry = '
                        <tr class="userEntry" userID="'.$row['ID'].'" bKey="'.$row['bKey'].'">
                            <td>'.$row['firstname'].' '.$row['lastname'].' ('.$row['bKey'].')</td>
                        ';
                        if($row['semester'] > 0){
                            $entry .= '<td class="text-center">'.$row['semester'].'</td>';
                        } else {
                            $entry .= '<td class="text-center alert-warning"><i>???</i></td>';
                        }

                        if($row['semester'] <= 4 && $row['semester'] > 0){
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

                    } else if ($row['tb_group_ID'] == 4 || $row['tb_group_ID'] == 5){

                        $entry = '
                        <tr class="userEntry" userID="'.$row['ID'].'" bKey="'.$row['bKey'].'">
                            <td>'.$row['firstname'].' '.$row['lastname'].' ('.$row['bKey'].')</td>
                        ';
                        if($row['semester'] > 0){
                            $entry .= '<td class="text-center">'.$row['semester'].'</td>';
                        } else {
                            $entry .= '<td class="text-center alert-warning"><i>???</i></td>';
                        }

                        if($row['semester'] < 5 && $row['semester'] > 0){
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

                        $listLLKV .= $entry . '</tr>';

                    } else {

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
            <div class="col-12">
                <hr />
            </div>
        </div>
        <div class="row">
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th style="border-top:none;" scope="col" rowspan="2"><?php echo $translate[192]." & ". $translate[191]; ?></th>
                        <th style="border-top:none;" scope="col" class="text-center" rowspan="2"><?php echo $translate[38]; ?></th>
                        <th style="border-top:none;" class="text-center" scope="col" colspan="2"><?php echo $translate[47]; ?></th>
                    </tr>
                    <tr>
                        <th class="text-center" scope="col"><?php echo $translate[38]." 5"; ?></th>
                        <th class="text-center" scope="col"><?php echo $translate[38]." 6"; ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php echo $listLLKV; ?>
                </tbody>
            </table>
        </div>
    </div>

    <button id="getCSV" class="btn btn-lg btn-default">CSV Generieren</button>

    <script type="text/javascript" src="modul/leistungslohn/js/exporter.min.js"></script>
    <script type="text/javascript" src="js/jquery.redirect.js"></script>

<?php else : ?>

    <br/><br/>

    <div class='alert alert-danger'>
        <strong><?php echo $translate[95];?> </strong> <?php echo $translate[94];?>
    </div>

<?php endif; ?>
