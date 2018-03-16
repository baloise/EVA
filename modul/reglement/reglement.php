<?php include("../../includes/session.php"); ?>
<?php include("../../database/connect.php"); ?>
<?php include("../../includes/alerts.php"); ?>

<?php if($session_usergroup == 1) : //HR ?>

    <h1 class="mt-5"><?php echo $translate[253];?></h1>

    <script src="js/ckeditor/ckeditor.js"></script>

    <div class="row">
        <div class="col-12">
            <h2><?php echo $translate[190]; ?></h2>
        </div>
    </div>
    <div class="row" style="margin-bottom:50px;">
        <div class="col-12">
            <b><a href="#" class="openReg" group="3" lang="de"><?php echo $translate[140]; ?></a></b>

            <b><a href="#" class="openReg" group="3" lang="it"><?php echo $translate[141]; ?></a></b>

            <b><a href="#" class="openReg" group="3" lang="fr"><?php echo $translate[142]; ?></a></b>

            <hr/>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <h2><?php echo $translate[192] . " & " . $translate[191]; ?></h2>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <b><a href="#" class="openReg" group="4" lang="de"><?php echo $translate[140]; ?></a></b>

            <b><a href="#" class="openReg" group="4" lang="it"><?php echo $translate[141]; ?></a></b>

            <b><a href="#" class="openReg" group="4" lang="fr"><?php echo $translate[142]; ?></a></b>

            <hr/>
        </div>
    </div>
    <br/>
    <div class="row">
        <div class="col-12" id="textareaContent">
        </div>
        <div class="col-12">
            <button id="safeRegChange" class="btn btn-block" style="display:none;"><?php echo $translate[254]; ?></button>
        </div>
    </div>
    <br/>

    <script type="text/javascript" src="modul/reglement/reglement.js"></script>

<?php elseif($session_usergroup == 3 || $session_usergroup == 4 || $session_usergroup == 5 || $session_usergroup == 2) : ?>

    <h1 class="mt-5"><?php echo $translate[253];?></h1>

    <?php

        if($session_usergroup == 3){
            $sql = "SELECT $session_language FROM `tb_text` WHERE tb_group_ID = $session_usergroup AND type = 'reglement'";
        } else if ($session_usergroup == 4 || $session_usergroup == 5){
            $sql = "SELECT $session_language FROM `tb_text` WHERE tb_group_ID IN(4, 5) AND type = 'reglement'";
        } else if ($session_usergroup == 2){
            $sql = "SELECT $session_language FROM `tb_text` WHERE tb_group_ID = 3 AND type = 'reglement'";
        } else {
            $sql = "Error";
        }

        $result = $mysqli->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo $row[$session_language];
            }
        }


    ?>

<?php else : ?>

    <br/><br/>

    <div class='alert alert-danger'>
        <strong><?php echo $translate[95];?> </strong> <?php echo $translate[94];?>.
    </div>

<?php endif; ?>
