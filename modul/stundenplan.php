<?php
    session_start();
    session_regenerate_id();
    $usergroup = $_SESSION['user']['usergroup'];
?>
    
<?php if($usergroup == 1) : ?>

    <h1 class="mt-5">Stundenplan</h1>
    <p>Sie sind Nachwuchsentwicklung</p>
   
<?php elseif($usergroup == 2) : ?>

    <h1 class="mt-5">Stundenplan</h1>
    <p>Sie sind Praxisausbildner</p>
    
<?php elseif($usergroup == 3) : ?>

    <h1 class="mt-5">Stundenplan</h1>
    <p>Sie sind Informatik-Lehrling</p>

<?php elseif($usergroup == 4) : ?>

    <h1 class="mt-5">Stundenplan</h1>
    <p>Sie sind KV-Lehrling</p>

<?php elseif($usergroup == 5) : ?>

    <h1 class="mt-5">Stundenplan</h1>
    <p>Sie sind Superuser</p>
    
<?php else : ?>
    
    <br/><br/>
    
    <div class='alert alert-danger'>
        <strong>Fehler </strong> Ihr Account wurde keiner Gruppe zugewiesen.
        Bitte wenden Sie sich an einen <a href='mailto:elia.reutlinger@baloise.ch'>Administrator</a>.
    </div>
    
<?php endif; ?>