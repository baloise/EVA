<?php include("../session/session.php"); ?>
<?php include("../../database/connect.php"); ?>

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
</div>


<script src="modul/settings/settings.js"></script>
