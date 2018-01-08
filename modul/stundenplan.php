<?php include("session/session.php"); ?>
<?php if($session_usergroup == 1) : ?>

    <h1 class="mt-5">Alle HR-Module</h1>
    <p>Sie sind Nachwuchsentwicklung</p>
      
<?php elseif($session_usergroup == 2) : ?>

    <h1 class="mt-5">Alle PA-Module</h1>
    <p>Sie sind Praxisausbildner</p>
    
<?php elseif($session_usergroup == 3) : ?>

    <div class="col-lg-12 text-center">
				<h1 class="mt-5">Gibm Stundenplan</h1>
				<p class="lead">Nach Fachrichtung</p>
                    <div class="form-group" id="klassenauswahl">
						<label for="k_auswahl">Klassenauswahl</label>
						<select class="form-control" id="k_auswahl">
						</select>
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