<?php include("session/session.php"); ?>
<?php if($session_usergroup == 1) : ?>

    <h1 class="mt-5">Leistungslohn</h1>
    <p>Sie sind Nachwuchsentwicklung</p>
    
<?php elseif($session_usergroup == 3) : ?>

    <h1 class="mt-5">Leistungslohn</h1>
    <p>Sie sind Informatik-Lehrling</p>

<?php elseif($session_usergroup == 4) : ?>

    <h1 class="mt-5">Leistungslohn</h1>
    <p>Sie sind KV-Lehrling Versicherung</p>

<?php elseif($session_usergroup == 5) : ?>

    <h1 class="mt-5">Leistungslohn</h1>
    <p>Sie sind KV-Lehrling Bank</p>
    
<?php else : ?>
    
    <br/><br/>
    
    <div class='alert alert-danger'>
        <strong>Fehler </strong> Sie haben keine Berechtigungen zu diesem Modul.
        Falls Sie das für einen Fehler halten, wenden Sie sich bitte an einen <a href='mailto:elia.reutlinger@baloise.ch'>Administrator</a>.
    </div>
    
<?php endif; ?>