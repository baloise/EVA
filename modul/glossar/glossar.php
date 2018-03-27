<?php include("../../includes/session.php"); ?>
<?php include("../../database/connect.php"); ?>
<?php include("../../includes/alerts.php"); ?>

<?php if($session_usergroup == 1 || $session_usergroup == 2) : //HR & PA ?>

    <h1 class="mt-5"><?php echo $translate[256];?></h1>

    <script src="js/ckeditor/ckeditor.js"></script>

    <?php

        $sql = "SELECT * FROM `tb_text` WHERE type = 'glossar'";
        $result = $mysqli->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
        }

    ?>

    <div class="row">
        <div class="col-lg-12 toggler" id="gerTog" style="cursor:pointer;">
            <div class="row">
                <div class="col-10">
                    <h2><?php echo $translate['140']; ?></h2>
                </div>
                <div class="col-2 text-right">
                    <i class="fa fa-chevron-down" aria-hidden="true"></i>
                </div>
            </div>
            <hr/>
        </div>
        <div class="col-lg-12 toggableCont" style="display:none;" id="gerTogCont">
            <div class="row">
                <div class="col-12 text-center">
                    <button type="button" class="btn btn-default editText" id="ger"><i class="fa fa-pencil" aria-hidden="true"></i> <?php echo $translate['261']; ?></button>
                </div>
                <div class="col-12 text-center">
                    <button type="button" style="display:none;" class="btn btn-default btn-info saveText" id="ger"><i class="fa fa-floppy-o" aria-hidden="true"></i> <?php echo $translate['254']; ?></button>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <br/>
                    <div class="textContentSpace" id="ger">
                        <?php echo $row['de']; ?>
                    </div>
                </div>
            </div>
            <br/>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 toggler" id="itaTog" style="cursor:pointer;">
            <div class="row">
                <div class="col-10">
                    <h2><?php echo $translate['141']; ?></h2>
                </div>
                <div class="col-2 text-right">
                    <i class="fa fa-chevron-down" aria-hidden="true"></i>
                </div>
            </div>
            <hr/>
        </div>
        <div class="col-lg-12 toggableCont" style="display:none;" id="itaTogCont">
            <div class="row">
                <div class="col-12 text-center">
                    <button type="button" class="btn btn-default editText" id="ita"><i class="fa fa-pencil" aria-hidden="true"></i> <?php echo $translate['261']; ?></button>
                </div>
                <div class="col-12 text-center">
                    <button type="button" style="display:none;" class="btn btn-default btn-info saveText" id="ita"><i class="fa fa-floppy-o" aria-hidden="true"></i> <?php echo $translate['254']; ?></button>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <br/>
                    <div class="textContentSpace" id="ita">
                        <?php echo $row['it']; ?>
                    </div>
                </div>
            </div>
            <br/>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 toggler" id="fraTog" style="cursor:pointer;">
            <div class="row">
                <div class="col-10">
                    <h2><?php echo $translate['142']; ?></h2>
                </div>
                <div class="col-2 text-right">
                    <i class="fa fa-chevron-down" aria-hidden="true"></i>
                </div>
            </div>
            <hr/>
        </div>
        <div class="col-lg-12 toggableCont" style="display:none;" id="fraTogCont">
            <div class="row">
                <div class="col-12 text-center">
                    <button type="button" class="btn btn-default editText" id="fra"><i class="fa fa-pencil" aria-hidden="true"></i> <?php echo $translate['261']; ?></button>
                </div>
                <div class="col-12 text-center">
                    <button type="button" style="display:none;" class="btn btn-default btn-info saveText" id="fra"><i class="fa fa-floppy-o" aria-hidden="true"></i> <?php echo $translate['254']; ?></button>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <br/>
                    <div class="textContentSpace" id="fra">
                        <?php echo $row['fr']; ?>
                    </div>
                </div>
            </div>
            <br/>
        </div>
    </div>


    <script type="text/javascript" src="modul/glossar/glossar.js"></script>


<?php elseif($session_usergroup == 3 || $session_usergroup == 4 || $session_usergroup == 5) : //Lehrling ?>

    <h1 class="mt-5"><?php echo $translate[256];?></h1>

    <?php


        $sql = "SELECT $session_language FROM `tb_text` WHERE type = 'glossar'";

        $result = $mysqli->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo $row[$session_language];
            }
        }


    ?>

<?php else : //No Usergroup ?>

    <br/><br/>

    <div class='alert alert-danger'>
        <strong><?php echo $translate[95];?> </strong> <?php echo $translate[94];?>.
    </div>

<?php endif; ?>
