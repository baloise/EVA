<?php include("session/session.php"); ?>
<?php if($usergroup == 1) : ?>

    <h1 class="mt-5">Benutzerverwaltung</h1>
      
<?php elseif($usergroup == 2 || $usergroup == 3 || $usergroup == 4 || $usergroup == 5) : ?>

    <br/><br/>

    <div class='alert alert-danger'>
        <strong>Fehler </strong> Sie haben keine Berechtigungen auf dieses Modul.
        Falls Sie dies für einen Fehler halten, wenden Sie sich bitte an einen <a href='mailto:elia.reutlinger@baloise.ch'>Administrator</a>.
    </div>
    
<?php else : ?>
    
    <br/><br/>
    
    <div class='alert alert-danger'>
        <strong>Fehler </strong> Ihr Account wurde keiner Gruppe zugewiesen.
        Bitte wenden Sie sich an einen <a href='mailto:elia.reutlinger@baloise.ch'>Administrator</a>.
    </div>
    
<?php endif; ?>