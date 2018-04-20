<?php include("../../includes/session.php"); ?>
<?php include("../../database/connect.php"); ?>

<?php

	$welcome = "<h3>".$translate[1]."!</h3>";

    $sql = "SELECT * FROM tb_modul AS mm INNER JOIN tb_modul_group AS mg ON mm.ID = mg.tb_modul_ID WHERE mg.tb_group_ID = $session_usergroup ORDER BY mm.ID";
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
				<div class="col-lg-3 col-md-3 col-6">
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

<?php if($session_usergroup == 3 || $session_usergroup == 4 || $session_usergroup == 5) : ?>

	<?php

		$semesterid = $row['ID'];
		$semesterTitle = $row['semester'];
		$entries = "";

		if(!isset($session_semesterid)){
			$getSemSql = "SELECT ID FROM `tb_semester` WHERE tb_group_ID = $session_usergroup ORDER BY `tb_semester`.`semester` DESC;";
			$resultSemSql = $mysqli->query($getSemSql);

			if ($resultSemSql->num_rows > 0) {

				while($semRow = $resultSemSql->fetch_assoc()) {
					$session_semesterid = $semRow['ID'];
				}
			}

		}

		$sql2 = "SELECT ID, title_".$session_language.", title_de, date, tb_semester_ID FROM `tb_deadline` WHERE tb_semester_ID = $session_semesterid;";
		$result2 = $mysqli->query($sql2);

		if ($result2->num_rows > 0) {
			while($row2 = $result2->fetch_assoc()) {

				$deadlineID = $row2['ID'];

				$deadlineTitle = $row2['title_'.$session_language];
				if(!$deadlineTitle){
					$deadlineTitle = $row2['title_de'];
				}

				$deadlineDate = $row2['date'];

				$sql3 = "SELECT * FROM `tb_deadline_check` WHERE tb_deadline_ID = $deadlineID AND tb_user_ID = $session_userid;";
				$result3 = $mysqli->query($sql3);

				if ($result3->num_rows == 1) {
					$entry = '
						<div class="row">
							<div class="col-lg-12 card alert-success" style="margin-bottom: 10px; background-color: #F1F4FB;">
								<div class="row">
									<div class="col-6">
										<b>'.$deadlineTitle.'</b>
									</div>
									<div class="col-6 text-right">
										'.$translate[80].': <b>'.$deadlineDate.'</b>
									</div>
								</div>
							</div>
						</div>
					';
				} else {
					$entry = '
						<div class="row">
							<div class="col-lg-12 card" style="margin-bottom: 10px; background-color: #F1F4FB;">
								<div class="row">
									<div class="col-6">
										<b>'.$deadlineTitle.'</b>
									</div>
									<div class="col-6 text-right">
										'.$translate[80].': <b>'.$deadlineDate.'</b>
									</div>
								</div>
							</div>
						</div>
					';
				}

				$entries = $entries . $entry;

			}

		} else {
			$entries = $translate[123];
		}

		if($entries){
			$entry = '
				<div class="divtogglercontent">
					<div class="row">
						<div class="col-12">
							<h2>'.$translate[78].':</h2>
						</div>
						<div class="col-12">
							'.$entries.'
						</div>
					</div>
				</div>
			';
		}

		echo $entry;

    ?>

<?php endif; ?>

	<script type="text/javascript">
		var translate = {};
		<?php
			foreach ($translate as $key => $value) {
				echo ("translate['".$key."'] = '".$value."';");
			};
		?>;
	</script>
	<script type="text/javascript" src="modul/dashboard/dashboard.min.js"></script>

<?php elseif($session_usergroup == 100) : //Not yet implemented -> GIT ISSUE 94?>

	<div class="col-lg-12 text-center">
		<h1 class='mt-5'><?php echo $translate[249]; ?></h1>

		<?php echo $titleSemBar; ?>
		<div class="myProgress" style="border-radius: 100px;">
	  		<div class="myBar" style="border-radius: 100px;" id="semesterBar"></div>
		</div>
		<br/>

		<h2><?php echo $translate[7] . ": " . $salaryBar; ?></h2>
		<div class="myProgress" style="border-radius: 100px;">
	  		<div class="myBar" style="border-radius: 100px;" id="salaryBar"></div>
		</div>

	</div>

	<!--<script type="text/javascript">
		$(document).ready(function(){
			move('semesterBar', 20, );
			move('salaryBar', 15, );
		});
	</script>-->

<?php else : ?>

    <br/><br/>

	<div class='alert alert-danger'>
        <strong><?php echo $translate[95];?> </strong> <?php echo $translate[94];?>
    </div>

<?php endif; ?>
