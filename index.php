<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="Evaluation-Tool for trainees">
        <meta name="author" content="Elia Reutlinger">

        <title>EVA</title>

        <!-- Bootstrap core CSS -->
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">

        <!-- Custom styles for this template -->
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        <link href="css/evaStyles.css" rel="stylesheet">

    </head>


    <body>
        <div class="loadScreen">
            <span class="helper"></span><img class="img-responsive" id="loadingImg" src="img/loading.gif"/>
        </div>

        <div id="pageContents" style="opacity: 0;">

            <?php
                include("database/connect.php");
                include("modul/session/session.php");
            ?>

            <!-- Navigation -->
            <div id="naviLink">
                <nav class="navbar navbar-expand-lg navbar-inverse bg-color fixed-top" id="slideMe" style="display: none;">
                    <div class="container">
                        <a class="navbar-brand" href="modul/dashboard/dashboard.php">
                            <img src="img/logoBaslerBalet.svg" width="300" alt="Logo">
                        </a>
                        <button class="navbar-toggler custom-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarResponsive">
                            <ul class="navbar-nav ml-auto">

                                <?php

                                    $userID = ($mysqli->query("SELECT ID FROM tb_user WHERE bKey = '$session_username'")->fetch_assoc());

                                    $sql1 = "SELECT mg.ID, mm.file_path, mm.title FROM tb_ind_nav AS mg INNER JOIN tb_modul AS mm ON mm.ID = mg.tb_modul_ID WHERE mg.tb_user_ID = " . $userID['ID'] . " ORDER BY mg.position";

                                    $result = $mysqli->query($sql1);

                                    if (isset($result) && $result->num_rows > 0) {

                                        while($row = $result->fetch_assoc()) {
                                            $link = '
                                            <li class="nav-item">
                                                <a class="nav-link" navLinkId="'. $row["ID"].'" href="'. $row["file_path"].'">'. $translate[$row["title"]].'</a>
                                                </li>
                                                ';
                                                echo $link;
                                        }

                                    } else {

                                        $link = '
                                        <li class="nav-item" id="editNavLink">
                                            <a class="nav-link" href="modul/settings/settings.php">'. $translate["Navigation bearbeiten"].'</a>
                                        </li>
                                        ';

                                        echo $link;

                                    }

                                ?>

                            </ul>
                        </div>
                    </div>
                </nav>
            </div>

            <!-- Page Content -->
            <div class="container">
    		    <div class="row">
    			    <div class="col-lg-1"></div>
    			    <div class="col-lg-10">
        				<div page="<?php if(isset($_SESSION["user"]["currentPath"])){ echo $_SESSION["user"]["currentPath"]; } else { echo "modul/dashboard/dashboard.php";} ?>" id="pageContent">

        				</div>
    			    </div>
    		    </div>
            </div>
            <!-- /.container -->

            <footer class="footer" id="slideMeFoot" style="display: none;">
                <div class="container">
                    <a class="foot-link" href="modul/settings/settings.php"><?php echo $translate["Einstellungen"] ?></a><i class="text-muted"> | <?php echo $_SESSION["user"]['username']; ?></i><span class="text-muted">©<a href="https://eliareutlinger.ch"> Elia Reutlinger</a> | 2018 | EVA <a href="https://github.com/baloise/eva">v.1.0</a></span>
                </div>
            </footer>
        </div>

        <!-- Bootstrap core JavaScript -->
        <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>

        <!-- Own JS -->
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.19.1/moment.min.js"></script>

        <script type="text/javascript">
            var translate = {};
            <?php
                foreach ($translate as $key => $value) {
                    echo ("translate['".$key."'] = '".$value."';");
                };
            ?>;
        </script>
        <script src="js/index.js"></script>

    </body>

</html>
