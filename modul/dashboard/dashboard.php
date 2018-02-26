<?php include("../session/session.php"); ?>
<?php include("../../database/connect.php"); ?>

<?php

	$welcome = "<h3>".$translate[1]."!</h3>";

    $sql = "SELECT * FROM tb_modul AS mm INNER JOIN tb_modul_group AS mg ON mm.ID = mg.tb_modul_ID WHERE mg.tb_group_ID = $session_usergroup";
	$sql2 = "SELECT firstname, lastname FROM tb_user WHERE id = $session_userid";
	$result = $mysqli->query($sql2);

    if ($result->num_rows == 1) {
		$row = $result->fetch_assoc();
		$welcome = "<h2 style='opacity: 0;' class='mt-5'>".$translate[1]." ".$row['firstname']." ".$row['lastname']."!</h2>";
	}

?>

<?php if($session_usergroup == 1 || $session_usergroup == 2 || $session_usergroup == 3 || $session_usergroup == 4 || $session_usergroup == 5) : ?>

    <?php

	echo $welcome;

    $result = $mysqli->query($sql);

    if ($result->num_rows > 0) {
        echo"<div class='row' style='margin-bottom:50px;'>";
        while($row = $result->fetch_assoc()) {
            $generateDiv = '
			<div class="col-lg-2 col-md-3 col-sm-6 col-xs-6">
				<div class="dashModul" href="'. $row["file_path"] .'">
					<div class="dashModuleIcon">
						<img src="'. $row["icon"] .'" class="dashIco svg img-fluid mx-auto d-block"/>
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

	<script type="text/javascript">
		var translate = {};
		<?php
			foreach ($translate as $key => $value) {
				echo ("translate['".$key."'] = '".$value."';");
			};
		?>;
	</script>
	<script type="text/javascript" src="modul/dashboard/dashboard.js"></script>

	<?php
		if($session_usergroup == 3 || $session_usergroup == 4 || $session_usergroup == 5){

			if($session_semesterid){
				$sql = "SELECT * FROM `tb_semester` WHERE ID = $session_semesterid;";
				$result = $mysqli->query($sql);
			    if ($result->num_rows == 1) {
					$row = $result->fetch_assoc();
					$sql2 = "SELECT count(ID) FROM `tb_semester` WHERE tb_group_ID = 3";
					$result2 = $mysqli->query($sql2);
					echo "<h2>Du befindest dich im Semester ". $row['semester'];
					if ($result2->num_rows == 1) {
						$row2 = $result2->fetch_assoc();
						echo " von " . $row2['count(ID)'] . "</h2>";
					} else {
						echo "</h2>";
					}
				}
			} else {

			}

		}
	?>

<?php else : ?>

    <br/><br/>

	<div class='alert alert-danger'>
        <strong><?php echo $translate[95];?> </strong> <?php echo $translate[94];?>
    </div>

<?php endif; ?>
