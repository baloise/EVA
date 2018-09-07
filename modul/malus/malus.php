<?php include("../../includes/session.php"); ?>
<?php include("../../database/connect.php"); ?>
<?php include("../../includes/alerts.php"); ?>

<?php if($session_usergroup == 1) : ?>

    <?php

        $sql = "SELECT ID, firstname, lastname FROM `tb_user` WHERE tb_group_ID IN (3, 4, 5) AND deleted IS NULL";

        $result = $mysqli->query($sql);
        if ($result->num_rows > 0) {

            $llist = "";

            while($row = $result->fetch_assoc()) {

                $entry = "<option value='". $row['ID'] ."'>". $row['firstname'] ." ". $row['lastname'] ."</option>";

                $llist = $llist . $entry;

            }

        } else {
            $llist = $translate[104];
        }


        $sql = "SELECT ml.`description`, ml.`creationDate`, ml.weight, ml.ID, us.firstname, us.lastname, us.ID AS userID, sem.semester FROM `tb_malus` AS ml
                LEFT JOIN tb_user AS us ON us.ID = ml.tb_user_ID
                INNER JOIN tb_semester AS sem ON ml.tb_semester_ID = sem.ID
                WHERE us.deleted IS NULL ORDER BY ml.`creationDate` DESC LIMIT 400;";

        $entryList = "";

        $result = $mysqli->query($sql);
        if ($result->num_rows > 0) {

            while($row = $result->fetch_assoc()) {

                $dateSet =  date("d.m.Y", strtotime($row['creationDate']));


                $listEntry = '
                <tr class="lEntry" entryID="'. $row['ID'] .'">
                    <td><span class="fa fa-trash-o delEntry" userID="'. $row['userID'] .'" entryID="'. $row['ID'] .'" aria-hidden="true" style="cursor: pointer;"></span></td>
                    <th scope="row">'. $row['ID'] .'</th>
                    <td>'. $row['firstname'] .' '. $row['lastname'] .'</td>
                    <td>'. $row['weight'] .' %</td>
                    <td>'. $row['description'] .'</td>
                    <td>'. $row['semester'] .'</td>
                    <td>'. $dateSet .' </td>
                </tr>';

                $entryList = $entryList . $listEntry;

            }
        } else {
            $entryList = $translate[105];
        }

        $semList = "";

    ?>

    <head>
        <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.css">
	</head>

    <h1 class="mt-5"><?php echo $translate[8];?></h1>

    <div class="alert alert-success" id="addedNotif" style="display: none; margin-bottom: 0px;">
        <strong></strong> <?php echo $translate[103];?>.
    </div><br/>
    <div class="col-lg-12 card">
        <div class="row">
            <div class="col-lg-12">
                <br/>
                <h3><?php echo $translate[51];?></h3>
                <hr/>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <label for="fselUser"><?php echo $translate[20];?>:</label>
                <select id="fselUser" class="form-control">
                    <option></option>
                    <?php echo $llist; ?>
                </select>
            </div>
            <div class="col-lg-4">
                <label for="fsem"><?php echo $translate[38];?>:</label>
                <select id="fsem" class="form-control" disabled>
                    <option></option>
                    <?php echo $semList; ?>
                </select>
            </div>
            <div class="col-lg-4">
                <label for="fweigth"><?php echo $translate[49];?>:</label>
                <input id="fweigth" class="form-control" type="text" placeholder="%"/>
            </div>
        </div>
        <br/>
        <div class="row">
            <div class="col-lg-12">
                <label for="freasoning"><?php echo $translate[30];?></label>
                <textarea id="freasoning" class="form-control"></textarea>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <br/>
                <button type="button" id="fsenMal" class="btn btn-primary"><?php echo $translate[31];?></button>
                <br/><br/>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <hr/>
        <h3><?php echo $translate[50];?></h3>
        <br/>
    </div>

    <div id="loadingTable" style="display: none; text-align:center; width: 100%">
        <img class="img-responsive" src="img/loading2_big.svg"/>
    </div>

    <table class="table" id="dtmake" style="display: none;">
        <thead>
            <tr>
                <th></th>
                <th>#</th>
                <th><?php echo $translate[20];?></th>
                <th><?php echo $translate[49];?></th>
                <th><?php echo $translate[30];?></th>
                <th><?php echo $translate[38];?></th>
                <th><?php echo $translate[22];?></th>
            </tr>
        </thead>
        <tbody>
            <?php
                if($entryList){
                    echo $entryList;
                } else {
                    echo "<tr><td colspan='7' align='center'>".$translate[87]."</td></tr>";
                }
            ?>
        </tbody>
    </table>

    
    <script type="text/javascript" src="modul/malus/malus.js"></script>
    <script type="text/javascript" src="js/datatablesInit.js"></script>

<?php else : ?>

    <br/><br/>

    <div class='alert alert-danger'>
        <strong><?php echo $translate[95];?> </strong> <?php echo $translate[94];?>.
    </div>

<?php endif; ?>
