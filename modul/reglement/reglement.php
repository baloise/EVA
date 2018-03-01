<?php include("../session/session.php"); ?>
<?php include("../../database/connect.php"); ?>

<?php if($session_usergroup == 1) : //HR ?>

    <h1 class="mt-5"><?php echo $translate[253];?></h1>

    <h1 class="mt-5" style="color: red;">Work in Progress...</h1>

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

    <script type="text/javascript" src="modul/reglement/reglement.js"></script>


<?php else : ?>

    <br/><br/>

    <div class='alert alert-danger'>
        <strong><?php echo $translate[95];?> </strong> <?php echo $translate[94];?>.
    </div>

<?php endif; ?>
