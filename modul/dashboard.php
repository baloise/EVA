<?php include("session/session.php"); ?>
<?php include("../database/connect.php"); ?>
<?php

    $sql = "SELECT * FROM tb_modul AS mm INNER JOIN tb_modul_group AS mg ON mm.ID = mg.tb_modul_ID WHERE mg.tb_group_ID = $usergroup";

?>
<?php if($usergroup == 1) : ?>

    <h1 class="mt-5">Alle HR-Module</h1>
    <p>Sie sind Nachwuchsentwicklung</p>
      
    <?php
    
    
    $result = $mysqli->query($sql);
        
    if ($result->num_rows > 0) {
        echo"<div class='row'>";
        while($row = $result->fetch_assoc()) {
            $generateDiv = '
            <div class="col-lg-4">
            <div id="dashModule" href="'. $row["file_path"] .'">
                <div id="dashModuleTitle">
                   <h3>'. $row["title"] .'</h3>
                </div>
                <div id="dashModuleDescription">
                    '. utf8_encode($row["description"]) .'
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
    
<?php elseif($usergroup == 2) : ?>

    <h1 class="mt-5">Alle PA-Module</h1>
    <p>Sie sind Praxisausbildner</p>
    
<?php elseif($usergroup == 3) : ?>

    <h1 class="mt-5">Alle IT-Module</h1>
    
    <?php

    $result = $mysqli->query($sql);
        
    if ($result->num_rows > 0) {
        echo"<div class='row'>";
        while($row = $result->fetch_assoc()) {
            $generateDiv = '
            <div class="col-lg-4">
            <div class="dashModul" id="dashModule" href="'. $row["file_path"] .'">
                <div id="dashModuleTitle">
                   <h3>'. $row["title"] .'</h3>
                </div>
                <div id="dashModuleDescription">
                    '. utf8_encode($row["description"]) .'
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
    
<?php elseif($usergroup == 4) : ?>

    <h1 class="mt-5">Alle KV-Module</h1>
    <p>Sie sind KV-Lehrling</p>

<?php elseif($usergroup == 5) : ?>

    <h1 class="mt-5">Alle Module</h1>
    <p>Sie sind Superuser</p>
    
<?php else : ?>
    
    <br/><br/>
    
    <div class='alert alert-danger'>
        <strong>Fehler </strong> Ihr Account wurde keiner Gruppe zugewiesen.
        Bitte wenden Sie sich an einen <a href='mailto:elia.reutlinger@baloise.ch'>Administrator</a>.
    </div>
    
<?php endif; ?>

<script>
    $(document).ready(function(){
       
       $(".dashModul").each(function(){
        
            $(this).hover(function() {
                $(this).css( 'cursor', 'pointer' );
            });
            
            var href = ($(this).attr('href'));
            
            $(this).click(function(){
                event.preventDefault();
                $("#pageContent").fadeOut("fast", function(){
                    if (href){
                        $("#pageContent").load(href, function(responseTxt,statusTxt){
    
                            if(statusTxt=="error"){
                                $("#pageContent").html("<br/><br/><div class='alert alert-danger'><strong>Fehler </strong> Seite enthält keinen gültigen Pfad. Bitte wenden Sie sich an einen <a href='mailto:elia.reutlinger@baloise.ch'>Administrator</a>.</div>");
                            }
                            
                        });
                    } else {
                        $("#pageContent").html("<br/><br/><div class='alert alert-danger'><strong>Fehler </strong> Seite wurde noch nicht verlinkt. Bitte wenden Sie sich an einen <a href='mailto:elia.reutlinger@baloise.ch'>Administrator</a>.</div>");
                    }
                }).fadeIn("fast");
            });
        
        });
        
    });
</script>