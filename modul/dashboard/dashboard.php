<?php include("../session/session.php"); ?>
<?php include("../../database/connect.php"); ?>

<?php

	$welcome = "<h3>".$translate['Willkommen']."!</h3>";
	
    $sql = "SELECT * FROM tb_modul AS mm INNER JOIN tb_modul_group AS mg ON mm.ID = mg.tb_modul_ID WHERE mg.tb_group_ID = $session_usergroup";
	$sql2 = "SELECT firstname, lastname FROM tb_user WHERE id = $session_userid";
	$result = $mysqli->query($sql2);
        
    if ($result->num_rows == 1) {
		$row = $result->fetch_assoc();
		$welcome = "<h2 style='opacity: 0;' class='mt-5'>".$translate['Willkommen']." ".$row['firstname']." ".$row['lastname']."!</h2>";
	} 

?>
<?php if($session_usergroup == 1 || $session_usergroup == 2 || $session_usergroup == 3 || $session_usergroup == 4 || $session_usergroup == 5) : ?>
		  
    <?php
	
	echo $welcome;
	
    $result = $mysqli->query($sql);
        
    if ($result->num_rows > 0) {
        echo"<div class='row' style='margin-bottom:100px;'>";
        while($row = $result->fetch_assoc()) {
            $generateDiv = '
			<div class="col-lg-4 col-md-6 col-sm-6">
				<div class="dashModul" href="'. $row["file_path"] .'">
					<div class="dashModuleIcon">
						<img src="'. $row["icon"] .'" class="dashIco img-fluid mx-auto d-block"/>
					</div>
					<div class="dashModuleTitle">
					   <h3>'. $translate[$row["title"]] .'</h3>
					</div>
				</div>
			</div>
            ';
            if($row["title"] != "Dashboard"){
                echo $generateDiv;
            }
        }
        echo"</div>";
    } else {
        echo "Keine Daten gefunden.";
    }
    
    ?>
    
<?php else : ?>
    
    <br/><br/>
    
    <div class='alert alert-danger'>
        <strong>Fehler </strong> Ihr Account wurde keiner gültigen Gruppe zugewiesen.
        Bitte wenden Sie sich an einen <a href='mailto:elia.reutlinger@baloise.ch'>Administrator</a>.
    </div>
    
<?php endif; ?>

<script type="text/javascript" src="modul/dashboard/dashboard.js"></script>