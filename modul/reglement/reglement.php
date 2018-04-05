<?php include("../../includes/session.php"); ?>
<?php include("../../database/connect.php"); ?>
<?php include("../../includes/alerts.php"); ?>

<?php if($session_usergroup == 1) : //HR ?>

    <h1 class="mt-5"><?php echo $translate[253];?></h1>

    <div class="row">
        <div class="col-12">
            <h2><?php echo $translate[190]; ?></h2>
        </div>
    </div>

    <?php

        $sql = "SELECT * FROM `tb_text` WHERE type = 'reglement'";

        $executed = $mysqli->query($sql);

        if (isset($executed) && $executed->num_rows > 0) {
            $rowRegIt = $executed->fetch_assoc();
            $rowRegKv = $executed->fetch_assoc();
        }

    ?>

    <div class="row" style="margin-bottom:50px;">
        <div class="col-12">

            <b><a href="#" class="openReg" group="3" lang="de"><?php echo $translate[140]; ?></a></b>

            <b><a href="#" class="openReg" group="3" lang="it"><?php echo $translate[141]; ?></a></b>

            <b><a href="#" class="openReg" group="3" lang="fr"><?php echo $translate[142]; ?></a></b>

            <div class="toggableReg" group="3" lang="de" style="display:none;">
                <hr/>
                <object data="<?php echo $rowRegIt['de']; ?>" type="application/pdf" width="100%" height="800">
                    <p><b>Failed to Load</b>: This browser does not support PDFs. Please download the PDF to view it: <a href="<?php echo $rowRegIt['de']; ?>">Download</a>.</p>
                </object>
                <br/><br/>

                <?php echo $translate[262]; ?>
                <form enctype="multipart/form-data" action="modul/reglement/upload.php" method="POST">
                    <input type="hidden" name="group" value="3" />
                    <input type="hidden" name="lang" value="de" />
                    <input type="file" name="userfile" id="userfile" required/>
                    <input class="uploadRegFile" type="submit" value="<?php echo $translate[254]; ?>" name="submit"/>
                </form>

            </div>
            <div class="toggableReg" group="3" lang="it" style="display:none;">
                <hr/>
                <object data="<?php echo $rowRegIt['it']; ?>" type="application/pdf" width="100%" height="800">
                    <p><b>Failed to Load</b>: This browser does not support PDFs. Please download the PDF to view it: <a href="<?php echo $rowRegIt['it']; ?>">Download</a>.</p>
                </object>

                <?php echo $translate[262]; ?>
                <form enctype="multipart/form-data" action="modul/reglement/upload.php" method="POST">
                    <input type="hidden" name="group" value="3" />
                    <input type="hidden" name="lang" value="it" />
                    <input type="file" name="userfile" id="userfile" required/>
                    <input class="uploadRegFile" type="submit" value="<?php echo $translate[254]; ?>" name="submit"/>
                </form>
            </div>
            <div class="toggableReg" group="3" lang="fr" style="display:none;">
                <hr/>
                <object data="<?php echo $rowRegIt['fr']; ?>" type="application/pdf" width="100%" height="800">
                    <p><b>Failed to Load</b>: This browser does not support PDFs. Please download the PDF to view it: <a href="<?php echo $rowRegIt['fr']; ?>">Download</a>.</p>
                </object>

                <?php echo $translate[262]; ?>
                <form enctype="multipart/form-data" action="modul/reglement/upload.php" method="POST">
                    <input type="hidden" name="group" value="3" />
                    <input type="hidden" name="lang" value="fr" />
                    <input type="file" name="userfile" id="userfile" required/>
                    <input class="uploadRegFile" type="submit" value="<?php echo $translate[254]; ?>" name="submit"/>
                </form>
            </div>

            <hr/>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <h2><?php echo $translate[192] . " & " . $translate[191]; ?></h2>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <b><a href="#" class="openReg" group="4" lang="de"><?php echo $translate[140]; ?></a></b>

            <b><a href="#" class="openReg" group="4" lang="it"><?php echo $translate[141]; ?></a></b>

            <b><a href="#" class="openReg" group="4" lang="fr"><?php echo $translate[142]; ?></a></b>

            <div class="toggableReg" group="4" lang="de" style="display:none;">
                <hr/>
                <object data="<?php echo $rowRegKv['de']; ?>" type="application/pdf" width="100%" height="800">
                    <p><b>Failed to Load</b>: This browser does not support PDFs. Please download the PDF to view it: <a href="<?php echo $rowRegKv['de']; ?>">Download</a>.</p>
                </object>

                <?php echo $translate[262]; ?>
                <form enctype="multipart/form-data" action="modul/reglement/upload.php" method="POST">
                    <input type="hidden" name="group" value="4" />
                    <input type="hidden" name="lang" value="de" />
                    <input type="file" name="userfile" id="userfile" required/>
                    <input class="uploadRegFile" type="submit" value="<?php echo $translate[254]; ?>" name="submit"/>
                </form>
            </div>
            <div class="toggableReg" group="4" lang="it" style="display:none;">
                <hr/>
                <object data="<?php echo $rowRegKv['it']; ?>" type="application/pdf" width="100%" height="800">
                    <p><b>Failed to Load</b>: This browser does not support PDFs. Please download the PDF to view it: <a href="<?php echo $rowRegKv['it']; ?>">Download</a>.</p>
                </object>

                <?php echo $translate[262]; ?>
                <form enctype="multipart/form-data" action="modul/reglement/upload.php" method="POST">
                    <input type="hidden" name="group" value="4" />
                    <input type="hidden" name="lang" value="it" />
                    <input type="file" name="userfile" id="userfile" required/>
                    <input class="uploadRegFile" type="submit" value="<?php echo $translate[254]; ?>" name="submit"/>
                </form>
            </div>
            <div class="toggableReg" group="4" lang="fr" style="display:none;">
                <hr/>
                <object data="<?php echo $rowRegKv['fr']; ?>" type="application/pdf" width="100%" height="800">
                    <p><b>Failed to Load</b>: This browser does not support PDFs. Please download the PDF to view it: <a href="<?php echo $rowRegKv['fr']; ?>">Download</a>.</p>
                </object>

                <?php echo $translate[262]; ?>
                <form enctype="multipart/form-data" action="modul/reglement/upload.php" method="POST">
                    <input type="hidden" name="group" value="4" />
                    <input type="hidden" name="lang" value="fr" />
                    <input type="file" name="userfile" id="userfile" required/>
                    <input class="uploadRegFile" type="submit" value="<?php echo $translate[254]; ?>" name="submit"/>
                </form>
            </div>

            <hr/>
        </div>
    </div>
    <br/>
    <div class="row">
        <div class="col-12" id="textareaContent">
        </div>
        <div class="col-12">
            <button id="safeRegChange" class="btn btn-block" style="display:none;"><?php echo $translate[254]; ?></button>
        </div>
    </div>
    <br/>

    <script type="text/javascript" src="modul/reglement/reglement.min.js"></script>

<?php elseif($session_usergroup == 3 || $session_usergroup == 4 || $session_usergroup == 5 || $session_usergroup == 2) : ?>

    <h1 class="mt-5"><?php echo $translate[253];?></h1>

    <?php

        $sql = "SELECT ".$session_language." FROM `tb_text` WHERE type = 'reglement' AND tb_group_ID = ".$session_usergroup;

        $executed = $mysqli->query($sql);

        if (isset($executed) && $executed->num_rows > 0) {
            $tmp = $executed->fetch_assoc();
            $pathToFile = $tmp[$session_language];
        }

    ?>

    <object data="<?php echo $pathToFile; ?>" type="application/pdf" width="100%" height="900">
        <p><b>Failed to Load</b>: This browser does not support PDFs. Please download the PDF to view it: <a href="<?php echo $pathToFile; ?>">Download</a>.</p>
    </object>

<?php else : ?>

    <br/><br/>

    <div class='alert alert-danger'>
        <strong><?php echo $translate[95];?> </strong> <?php echo $translate[94];?>.
    </div>

<?php endif; ?>
