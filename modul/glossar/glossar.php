<?php include("../../includes/session.php"); ?>
<?php include("../../database/connect.php"); ?>
<?php include("../../includes/alerts.php"); ?>

<?php if($session_usergroup == 1 || $session_usergroup == 2) : //HR & PA ?>

    <h1 class="mt-5"><?php echo $translate[256];?></h1>

<?php elseif($session_usergroup == 3 || $session_usergroup == 4 || $session_usergroup == 5) : //Lehrling ?>

    <h1 class="mt-5"><?php echo $translate[256];?></h1>

<?php else : //No Usergroup ?>

    <br/><br/>

    <div class='alert alert-danger'>
        <strong><?php echo $translate[95];?> </strong> <?php echo $translate[94];?>.
    </div>

<?php endif; ?>
