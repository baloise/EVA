<?php include("../session/session.php"); ?>
<?php include("../../database/connect.php"); ?>

    <head>
        <link href="modul/settings/color-picker.min.css" rel="stylesheet">
    </head>

<h1 class="mt-5"><?php echo $translate["Einstellungen"];?></h1>

<div class="row">
    <div class="col-lg-6">
        <div class="alert alert-danger" id="error" style="display: none;"></div>
        <div class="alert alert-success" id="AddedNotif" style="display: none;">
            <strong></strong> <?php echo $translate["Menüpunkt wurde hinzugefügt"];?>.
        </div>
        <div id="usersNavItems">
            <h2><?php echo $translate["Navigation bearbeiten"];?></h2>
        <?php

            $userID = ($mysqli->query("SELECT ID FROM tb_user WHERE bKey = '$session_username'")->fetch_assoc());

            $sql1 = "SELECT mg.ID, mg.position, mm.name FROM tb_ind_nav AS mg INNER JOIN tb_modul AS mm ON mm.ID = mg.tb_modul_ID WHERE mg.tb_user_ID = ". $userID['ID'] ." ORDER BY mg.position";

            $result = $mysqli->query($sql1);


            if (isset($result) && $result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    $link = '
                    <div class="navListPosition" id="navListPosition" navItemID="' . $row["ID"] . '">
                        <div id="navListItem">
                            ' . $translate[$row["name"]] . ' <span> </span>
                        </div>
                        <div id="navListIcon"><span navItemID="'. $row['ID'] .'" class="itemDelete"><i class="fa fa-minus" aria-hidden="true"></i></span></div>
                    </div>
                    ';
                    echo $link;

                }
            } else {

            }

        ?>
        </div>
        <div id="navListPosition" pos="">
            <div id="navListItem">
                <select class="form-control" id="selectModule" userID="<?php echo $userID['ID']; ?>">
                    <?php

                        $sql2 = "SELECT mm.ID, mm.title FROM tb_modul AS mm INNER JOIN tb_modul_group AS mg ON mm.ID = mg.tb_modul_ID WHERE mg.tb_group_ID = $session_usergroup";

                        $result = $mysqli->query($sql2);

                        if (isset($result) && $result->num_rows > 0) {
                            // output data of each row
                            while($row = $result->fetch_assoc()) {
                                $link = '
                                <option value="'. $row["ID"].'">'. $translate[$row["title"]].'</option>
                                ';
                                echo $link;

                            }
                        } else {
                            echo "<option>".$translate["Fehler beim suchen der Einträge"]."</option>";
                        }

                    ?>

                </select><span></span>
            </div>
            <div id="navListIcon"><span id="itemAdd"><i class="fa fa-plus" aria-hidden="true"></i></span></div>
        </div>

    </div>
    <div class="col-lg-6">
        <div class="col-lg-12">

            <h2><?php echo $translate["Sprache anpassen"];?></h2>
            <div class="alert alert-danger" id="errorLang" style="display: none;"></div>
            <div class="alert alert-success" id="AddedNotifLang" style="display: none;">
                <strong></strong> <?php echo $translate["Sprache wurde angepasst"];?>.
            </div>

            <div class="col-12">
                <select class="form-control" id="newSelLang">
                    <option <?php if($session_language == "de"){echo "selected";}?> value="de">de - <?php echo $translate["Deutsch"];?></option>
                    <option <?php if($session_language == "fr"){echo "selected";}?> value="fr">fr - <?php echo $translate["Französisch"];?></option>
                    <option <?php if($session_language == "it"){echo "selected";}?> value="it">it - <?php echo $translate["Italienisch"];?></option>
                </select>
            </div>

            <div class="col-12">
                <br/>
                <button class="btn btn-block" style="display:none;" id="changeLanguageButton"><?php echo $translate["Ändern"];?></button>
            </div>

        </div>

        <?php

            $sql = "SELECT * FROM `tb_ind_design` WHERE tb_user_ID = $session_userid;";

            $result = $mysqli->query($sql);

            if (isset($result) && $result->num_rows == 1) {

                $row = $result->fetch_assoc();

            } else {
                $row = $session_appinfo;
            }

        ?>

        <div class="col-lg-12">

            <h2><?php echo $translate["Design anpassen"];?> (ALPHA)</h2>
            <div class="alert alert-danger" id="errorLang" style="display: none;"></div>

            <div class="col-12">
                <div class="row">
                    <div class="col-12">
                        <label><?php echo $translate["Hintergrund"];?></label>
                        <input type="text"  id="color1" class="form-control colorer" value="<?php echo $row['hintergrund']; ?>">
                    </div>
                </div>
                <br/>
                <div class="row">
                    <div class="col-12">
                        <label><?php echo $translate["Hintergrund"];?> 2</label>
                        <input type="text" id="color2" class="form-control colorer" value="<?php echo $row['akzentfarbe']; ?>">
                    </div>
                </div>
                <br/>
                <div class="row">
                    <div class="col-12">
                        <label><?php echo $translate["Schrift"];?></label>
                        <input type="text" id="color3" class="form-control colorer" value="<?php echo $row['schrift']; ?>">
                    </div>
                </div>
                <br/>
                <div class="row">
                    <div class="col-12">
                        <label><?php echo $translate["Links"];?></label>
                        <input type="text" id="color4" class="form-control colorer" value="<?php echo $row['link']; ?>">
                    </div>
                </div>
                <br/>
                <div class="row">
                    <div class="col-12">
                        <button type="button" id="saveColor" style="display:none;" class="btn btn-block btn-success"><?php echo $translate['Ändern']; ?></button>
                    </div>
                </div>
                <br/>
                <div class="row">
                    <div class="col-12">
                        <button type="button" id="removeColor" class="btn btn-block"><?php echo $translate['Zurücksetzen']; ?></button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script type="text/javascript">
    var translate = {};
    <?php
        foreach ($translate as $key => $value) {
            echo ("translate['".$key."'] = '".$value."';");
        };
    ?>;
</script>

<script src="modul/settings/settings.js"></script>
<script src="modul/settings/color-picker.min.js"></script>
<script id="colorChanges">

    function resetColors(){
        $(':root').css("--hintergrund", "<?php echo $session_appinfo["hintergrund"];?>");
        $(':root').css("--akzentfarbe", "<?php echo $session_appinfo["akzentfarbe"];?>");
        $(':root').css("--schrift", "<?php echo $session_appinfo["schrift"];?>");
        $(':root').css("--link", "<?php echo $session_appinfo["link"];?>");
    }

    function updateLive(color, p){

        $("#saveColor").slideDown("fast");

        if(p == "p1"){
            $(':root').css("--hintergrund", "#"+color);
        }

        if(p == "p2"){
            $(':root').css("--akzentfarbe", "#"+color);
        }

        if(p == "p3"){
            $(':root').css("--schrift", "#"+color);
        }

        if(p == "p4"){
            $(':root').css("--link", "#"+color);
        }

    }

    var picker1 = new CP(document.querySelector('input[id="color1"]')),
        button1 = document.querySelector('button[id="colorpicker1"]');

    var picker2 = new CP(document.querySelector('input[id="color2"]')),
        button2 = document.querySelector('button[id="colorpicker2"]');

    var picker3 = new CP(document.querySelector('input[id="color3"]')),
        button3 = document.querySelector('button[id="colorpicker3"]');

    var picker4 = new CP(document.querySelector('input[id="color4"]')),
        button4 = document.querySelector('button[id="colorpicker4"]');

    picker1.on("change", function(color) {
        this.target.value = '#' + color;
        updateLive(color, "p1");
    });

    picker2.on("change", function(color) {
        this.target.value = '#' + color;
        updateLive(color, "p2");
    });

    picker3.on("change", function(color) {
        this.target.value = '#' + color;
        updateLive(color, "p3");
    });

    picker4.on("change", function(color) {
        this.target.value = '#' + color;
        updateLive(color, "p4");
    });

</script>
