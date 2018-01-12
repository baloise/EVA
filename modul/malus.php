<?php include("session/session.php"); ?>
<?php include("../database/connect.php"); ?>
<?php if($session_usergroup == 1) : ?>

    <?php
    
        $sql = "SELECT ID, firstname, lastname FROM `tb_user` WHERE tb_group_ID = 3 OR tb_group_ID = 4 AND deleted IS NULL";
        
        $result = $mysqli->query($sql);
        if ($result->num_rows > 0) {
            
            $llist = "";
            
            while($row = $result->fetch_assoc()) {
                
                $entry = "<option value='". $row['ID'] ."'>". $row['firstname'] ." ". $row['lastname'] ."</option>";
                
                $llist = $llist . $entry;
                
            }
        
        } else {
            $llist = "Keine Lehrlinge im System";
        }
    ?>

    <h1 class="mt-5">Malus</h1>
    <p>Malus-Werte für Lehrlinge definieren.</p>
    <div class="col-lg-12 card">
        <div class="row">
            <div class="col-lg-12">
                <br/>
                <h3>Neuen Malus eintragen</h3>
                <hr/>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <label for="fselUser">Lehrling:</label>
                <select id="fselUser" class="form-control">
                    <?php echo $llist; ?>
                </select>
            </div>
            <div class="col-lg-6">
                <label for="fweigth">Gewichtung:</label>
                <input id="fweigth" class="form-control" type="text"/>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <label for="freasoning">Begründung</label>
                <textarea id="freasoning" class="form-control"></textarea>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <br/>
                <button type="button" id="fsenMal" class="btn btn-primary">Abschicken</button>
                <br/><br/>
            </div>
        </div>
    </div>
    
    <div class="col-lg-12">
        <hr/>
        <h3>Definierte Werte</h3>
    </div>
      
<?php elseif($session_usergroup != 1) : ?>

    <h1 class="mt-5">Berechtigung fehlt</h1>
    <p>Sie haben keine Berechtigungen für dieses Modul. Falls dies ein Fehler ist, wenden Sie sich an einen <a href='mailto:elia.reutlinger@baloise.ch'>Administrator</a>.</p>
    
<?php else : ?>
    
    <br/><br/>
    
    <div class='alert alert-danger'>
        <strong>Fehler </strong> Ihr Account wurde keiner Gruppe zugewiesen.
        Bitte wenden Sie sich an einen <a href='mailto:elia.reutlinger@baloise.ch'>Administrator</a>.
    </div>
    
<?php endif; ?>