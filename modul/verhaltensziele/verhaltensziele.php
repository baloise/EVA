<?php include("../../includes/session.php"); ?>
<?php include("../../database/connect.php"); ?>
<?php include("../../includes/alerts.php"); ?>

<?php if($session_usergroup == 1 || $session_usergroup == 2) : //HR & PA ?>


    <head>
        <link rel="stylesheet" href="modul/benutzerverwaltung/benutzerverwaltung.css"/>
        <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.css">
	</head>

    <?php

		if($session_usergroup == 1){
			$sql = "SELECT bh.`stageName`, bh.`points`, bh.`creationDate`, us.firstname, us.lastname, bh.ID FROM `tb_behaviorgrade` AS bh
                LEFT JOIN tb_user AS us ON bh.`tb_userPA_ID` = us.ID
                WHERE us.deleted IS NULL ORDER BY bh.`creationDate` DESC LIMIT 800";
		} else {
			$sql = "SELECT bh.`stageName`, bh.`points`, bh.`creationDate`, us.firstname, us.lastname, bh.ID FROM `tb_behaviorgrade` AS bh
                LEFT JOIN tb_user AS us ON bh.`tb_userPA_ID` = us.ID
				WHERE bh.`tb_userPA_ID` = $session_userid AND us.deleted IS NULL ORDER BY bh.`creationDate` DESC LIMIT 800";
		}

        $entryList = "";

        $result = $mysqli->query($sql);
        if ($result->num_rows > 0) {

            $i = 1;

            while($row = $result->fetch_assoc()) {

                $dateSet =  date("d.m.Y", strtotime($row['creationDate']));

                $sql2 = "SELECT bh.`stageName`, bh.`points`, bh.`creationDate`, us.firstname, us.lastname, bh.ID FROM `tb_behaviorgrade` AS bh
                LEFT JOIN tb_user AS us ON bh.`tb_userLL_ID` = us.ID WHERE bh.ID = ".$row['ID'];
                $result2 = $mysqli->query($sql2);
                $row2 = $result2->fetch_assoc();

                $listEntry = '
                <tr>
                    <td><button entryID="'. $row['ID'] .'"  entryPoints="'. $row['points'] .'" entryLL="'. $row2['firstname'] .' '. $row2['lastname'] .'" entryPA="'. $row['firstname'] .' '. $row['lastname'] .'" type="button" class="btn btn-warning checkEntry" style="padding-bottom: 0px; padding-top: 0px;"><b>!</b></button></td>
                    <th scope="row">'.$i.'</th>
                    <td>'. $row['stageName'] .'</td>
                    <td>'. $row['points'] .'</td>
                    <td>'. $row['firstname'] .' '. $row['lastname'] .'</td>
                    <td>'. $row2['firstname'] .' '. $row2['lastname'] .'</td>
                    <td>'. $dateSet .' </td>
                </tr>';

                $entryList = $entryList . $listEntry;
                $i = $i + 1;

            }
        } else {
            $entryList = $translate[100].".";
        }

    ?>

    <h1 class="mt-5"><?php echo $translate[13];?></h1>

    <div id="loadingTable" style="display: none; text-align:center; width: 100%">
        <img class="img-responsive" src="img/loading2_big.svg"/>
    </div>

    <table class="table" id="dtmake" style="display: none;">
        <thead>
            <tr>
                <th></th>
                <th>#</th>
                <th><?php echo $translate[84];?></th>
                <th><?php echo $translate[19];?></th>
                <th><?php echo $translate[85];?></th>
                <th><?php echo $translate[20];?></th>
                <th><?php echo $translate[22];?></th>
            </tr>
        </thead>
        <tbody>
            <?php
                if($entryList){
                    echo $entryList;
                } else {
                    echo "<tr><td colspan='7' align='center'>".$translate[87]."<td></tr>";
                }
            ?>
        </tbody>
    </table>

	<div class="alert alert-success" id="checkedNotif" style="display: none; margin-bottom: 0px;"></div><br/>
    <div id="checkEntryForm" style="display: none;">
        <hr/>
        <div class="alert alert-danger" id="error" style="display: none;" role="alert"></div>
        <h3><?php echo $translate[29];?></h3>
        <div class="row">
            <div class="col-lg-4">
                <label for="fcheckEntryPoints"><?php echo $translate[19];?></label>
                <input class="form-control" type="text" id="fcheckEntryPoints" value="" disabled/>
            </div>
            <div class="col-lg-4">
                <label for="fcheckEntryLL"><?php echo $translate[20];?></label>
                <input class="form-control" type="text" id="fcheckEntryLL" value="" disabled/>
            </div>
            <div class="col-lg-4">
                <label for="fcheckEntryPA"><?php echo $translate[85];?></label>
                <input class="form-control" type="text" id="fcheckEntryPA" value="" disabled/>
            </div>
        </div>
        <br/>
        <div class="row">
            <div class="col-lg-12">
                <label for="fcheckEntryReason"><?php echo $translate[30];?></label>
                <textarea class="form-control" id="fcheckEntryReason"></textarea><br/>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <button type="button" entryID="" id="fsend" class="btn btn-primary"><?php echo $translate[31];?></button>
                <?php if($session_usergroup == 1){echo '<button type="button" entryID="" id="fsendAndDelete" class="btn btn-danger">'.$translate[32].'</button>';} ?>
            </div>
            <div class="col-lg-6">
                <button type="button" style="float: right;" id="finterrupt" class="btn btn-secondary"><?php echo $translate[33];?></button>
            </div>
        </div>
        <br/>
        <div class="row">
            <div class="col-lg-12">
                <p><?php echo $translate[34];?>.</p>
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
    <script type="text/javascript" src="modul/verhaltensziele/verhaltensziele.min.js"></script>
    <script type="text/javascript" src="js/datatablesInit.js"></script>

<?php elseif($session_usergroup == 3 || $session_usergroup == 4) : //IT-Lehrling & KV-Lehrling ?>

    <?php

        $date = date('d.m.Y');
        $paList = "";
        $sql = "SELECT firstname, lastname, id FROM tb_user WHERE tb_group_ID = 2;";

        $result = $mysqli->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {

                $paListEntry = '<option value="'.$row["id"].'">'.$row["firstname"].' '.$row["lastname"].'</option>';
                $paList = $paList . utf8_encode($paListEntry);

            }
        }

        $sql = "SELECT bh.`stageName`, bh.`points`, bh.`creationDate`, us.firstname, us.lastname, bh.ID, sem.semester FROM `tb_behaviorgrade` AS bh
                LEFT JOIN tb_user AS us ON bh.`tb_userPA_ID` = us.ID
                INNER JOIN tb_semester AS sem ON sem.ID = bh.tb_semester_ID
                WHERE `tb_userLL_ID`= $session_userid;";

        $entryList = "";

        $result = $mysqli->query($sql);
        if ($result->num_rows > 0) {

            $i = 1;

            while($row = $result->fetch_assoc()) {

                $dateSet =  date("d.m.Y", strtotime($row['creationDate']));

                $listEntry = '
                <tr>
                    <th scope="row">'.$i.'</th>
                    <td>'. $row['stageName'] .'</td>
                    <td>'. $row['points'] .'</td>
                    <td>'. $row['firstname'] .' '. $row['lastname'] .'</td>
                    <td>'. $row['semester'] .'</td>
                    <td>'. $dateSet .' </td>
                </tr>';

                $entryList = $entryList . $listEntry;
                $i = $i + 1;

            }
        }

        $semList = "";
        $semSql = "SELECT ID, semester FROM `tb_semester` WHERE tb_group_ID = $session_usergroup";
        $semResult = $mysqli->query($semSql);
        if ($semResult->num_rows > 0) {
            while($semRow = $semResult->fetch_assoc()) {
                $semList = $semList . "<option value='". $semRow['ID'] ."'>". $semRow['semester'] ."</option>";
            }
        } else {
            $semList = "<option>".$translate[91].".</option>";
        }

    ?>

    <h1 class="mt-5"><?php echo $translate[13];?></h1>
    <div class="alert alert-danger" id="error" style="display: none;" role="alert"></div>
    <p><?php echo $translate[35];?>.</p>
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th><?php echo $translate[84];?></th>
                <th><?php echo $translate[19];?></th>
                <th><?php echo $translate[85];?></th>
                <th><?php echo $translate[38];?></th>
                <th><?php echo $translate[22];?></th>
            </tr>
        </thead>
        <tbody>
            <?php if($entryList){echo $entryList;}else{echo $translate[187].".";} ?>
            <tr id="newEntry">
                <th scope="row" style="padding-top: 20px;">#</th>
                <td><input class="form-control" type="text" id="fStage"/></td>
                <td><input class="form-control" type="number" id="fPoints"/></td>
                <td>
                    <select class="form-control" id="fPa">
                        <option></option>
                        <?php echo $paList; ?>
                    </select>
                </td>
                <td>
                    <select class="form-control" id="fSem">
                        <option></option>
                        <?php echo $semList; ?>
                    </select>
                </td>
                <td style="padding-top: 20px;"><?php echo $date; ?></td>
            </tr>
            <tr>
                <td colspan="6" align="center">
                    <div class="alert alert-success" id="addedNotif" style="display: none; margin-bottom: 0px;">
                        <strong></strong> <?php echo $translate[103];?>.
                    </div><br/>
                    <div class="alert alert-warning" id="warnEntry" style="display: none; margin-bottom: 0px;">
                        <?php echo $translate[93];?> <strong>
                        <i class="fa fa-arrow-right" aria-hidden="true"></i> <?php echo $translate[92];?>.</strong>
                    </div><br/>
                    <button id="addNewEntryButton" type="button" class="btn btn-primary"><?php echo $translate[39];?></button>
                </td>
            </tr>
        </tbody>
    </table>

    <script type="text/javascript">
        var translate = {};
        <?php
            foreach ($translate as $key => $value) {
                echo ("translate['".$key."'] = '".$value."';");
            };
        ?>;
    </script>
    <script type="text/javascript" src="modul/verhaltensziele/verhaltensziele.min.js"></script>

<?php else : //No Usergroup ?>

    <br/><br/>

    <div class='alert alert-danger'>
        <strong><?php echo $translate[95];?> </strong> <?php echo $translate[94];?>.
    </div>

<?php endif; ?>
