<?php include("session/session.php"); ?>
<?php include("../database/connect.php"); ?>
<?php if($session_usergroup == 1) : ?>

    <h1 class="mt-5">Stundenpläne</h1>
    <p>Stundenpläne der Lehrlinge</p>
    
    <?php
    
        $linkList = "";
    
        $sql = "SELECT firstname, lastname, timetable FROM tb_user WHERE NOT (timetable IS NULL OR deleted IS NOT NULL)";
        $result = $mysqli->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $link = '<a href="" class="clickandload" classId="'.$row['timetable'].'">'. $row['firstname'] .' '. $row['lastname'] .'</a>';
            
                if($linkList){
                     $linkList = $linkList . ", " . $link;
                } else {
                    $linkList = $linkList . $link;
                }   
            } 
        }
    
    ?>
    
    <?php echo $linkList; ?>
    <br/><br/><br/>
    <div class="timetableContent"style="display: none;">
        
        <div id="stundenplan">
					
			<div class="weekchanger weekchangerBefore"><button type="button" class="btn btn-default btn-block"><span class="glyphicon glyphicon-arrow-left"></span> Vorherige Woche</button></div>
			<div style="text-align: center;" class="weekchanger weekchangerDate"><b>Kalenderwoche: <div id="weekchangerDateNum">43-2016</div></b></div>
			<div class="weekchanger weekchangerNext"><button type="button" class="btn btn-default btn-block">Nächste Woche <span class="glyphicon glyphicon-arrow-right"></span></button></div>
			<br/>
			<div id="kalender_tafel">
				<div class="agenda">
					<div class="table-responsive">
						<table class="table table-condensed table-bordered">
							<thead>
								<tr>
									<th>Datum</th>
									<th>Zeit</th>
									<th>Fach</th>
									<th>Raum</th>
									<th>Lehrer</th>
								</tr>
							</thead>
							<tbody id="tafel_content">
										
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
                
        
    </div>
    
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.19.1/moment.min.js"></script>
    <script type="text/javascript" src="modul/stundenplan/hrpa.js"></script>
    
    
<?php elseif($session_usergroup == 2) : ?>

    <h1 class="mt-5">Alle PA-Module</h1>
    <p>Sie sind Praxisausbildner</p>
    
<?php elseif($session_usergroup == 3) : ?>

    <?php
    
        $sql = "SELECT timetable FROM tb_user WHERE ID = $session_userid;";
        $result = $mysqli->query($sql);
        if ($result->num_rows == 1) {
            
            $row = $result->fetch_assoc();
            $classSel = $row['timetable'];
                
        }
    
    ?>

    <div class="col-lg-12 text-center">
				<h1 class="mt-5">Gibm Stundenplan</h1>
                    <div class="form-group" id="klassenauswahl">
						<label for="k_auswahl">Klassenauswahl</label>
						<select <?php if(isset($classSel)){echo "value='".$classSel."'";} ?> class="form-control" id="k_auswahl">
						</select>
                        <div class="saveClass"><button id="saveClassButton" type="button" class="btn btn-primary" style="border-top-left-radius: 0; border-top-right-radius: 0; display: none;">Klasse speichern</button></div>
					</div>
				<div id="stundenplan" style="opacity: 0;">
					
					<div class="weekchanger weekchangerBefore"><button type="button" class="btn btn-default btn-block"><span class="glyphicon glyphicon-arrow-left"></span> Vorherige Woche</button></div>
					<div class="weekchanger weekchangerDate"><b>Kalenderwoche: <div id="weekchangerDateNum">43-2016</div></b></div>
					<div class="weekchanger weekchangerNext"><button type="button" class="btn btn-default btn-block">Nächste Woche <span class="glyphicon glyphicon-arrow-right"></span></button></div>
					<br/>
					<div id="kalender_tafel">
						 <div class="agenda">
							<div class="table-responsive">
								<table class="table table-condensed table-bordered">
									<thead>
										<tr>
											<th>Datum</th>
											<th>Zeit</th>
											<th>Fach</th>
											<th>Raum</th>
											<th>Lehrer</th>
										</tr>
									</thead>
									<tbody id="tafel_content">
										
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
                
			</div>
		</div>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.19.1/moment.min.js"></script>
    <script type="text/javascript" src="modul/stundenplan/stundenplan.js"></script>

<?php elseif($session_usergroup == 4) : ?>

    <h1 class="mt-5">Alle KV-Module</h1>
    <p>Sie sind KV-Lehrling</p>

<?php elseif($session_usergroup == 5) : ?>

    <h1 class="mt-5">Alle Module</h1>
    <p>Sie sind Superuser</p>
    
<?php else : ?>
    
    <br/><br/>
    
    <div class='alert alert-danger'>
        <strong>Fehler </strong> Ihr Account wurde keiner Gruppe zugewiesen.
        Bitte wenden Sie sich an einen <a href='mailto:elia.reutlinger@baloise.ch'>Administrator</a>.
    </div>
    
<?php endif; ?>