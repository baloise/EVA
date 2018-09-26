<?php

    include("database/connect.php");
    include("includes/session.php");

    $result = $mysqli->query("SELECT * FROM `tb_appinfo`;");

    if (isset($result) && $result->num_rows == 1) {
        $appinfo = $result->fetch_assoc();
    }

    $result = $mysqli->query("SELECT * FROM `tb_ind_design` WHERE tb_user_ID = $session_userid;");

    if (isset($result) && $result->num_rows == 1) {

        $row = $result->fetch_assoc();

    }

?>

<!DOCTYPE html>
<html lang="en">
    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="<?php echo $appinfo["description"];?>">
        <meta name="author" content="Elia Reutlinger">

        <title><?php echo $appinfo["title"];?></title>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

        <?php

            if (preg_match("/(Trident\/(\d{2,}|7|8|9)(.*)rv:(\d{2,}))|(MSIE\ (\d{2,}|8|9)(.*)Tablet\ PC)|(Trident\/(\d{2,}|7|8|9))/", $_SERVER["HTTP_USER_AGENT"], $match) != 0) {

                $fixCss=file_get_contents('css/evaStyles.min.css');

                if(isset($row)){

                    $fixCss=str_replace("var(--hintergrund)", $row["hintergrund"],$fixCss);
                    $fixCss=str_replace("var(--akzentfarbe)", $row["akzentfarbe"],$fixCss);
                    $fixCss=str_replace("var(--schrift)", $row["schrift"],$fixCss);
                    $fixCss=str_replace("var(--link)", $row["link"],$fixCss);

                } else {

                    $fixCss=str_replace("var(--hintergrund)", $appinfo["hintergrund"],$fixCss);
                    $fixCss=str_replace("var(--akzentfarbe)", $appinfo["akzentfarbe"],$fixCss);
                    $fixCss=str_replace("var(--schrift)", $appinfo["schrift"],$fixCss);
                    $fixCss=str_replace("var(--link)", $appinfo["link"],$fixCss);

                }

                echo '
                    <style>
                        .navbar-brand {
                            font-family: "Geometria", "MetaPro", sans-serif;
                        }
                        .dashModuleIcon {
                            margin-bottom: -3vh;
                        }
                        '.$fixCss.'
                    </style>
                ';


            } else {

                if(isset($row)){

                    echo '
                    <meta name="theme-color" content="'.$row["akzentfarbe"].'"/>
                    <style>
                        :root {
                            --hintergrund: '.$row["hintergrund"].';
                            --akzentfarbe: '.$row["akzentfarbe"].';
                            --schrift: '.$row["schrift"].';
                            --link: '.$row["link"].';
                        }
                        body {
                            font-family: "MetaPro-Normal", sans-serif;
                        }
                        .navbar-brand, .mt-5 {
                            font-family: "Geometria", "MetaPro", sans-serif;
                        }
                    </style>
                    <link href="css/evaStyles.min.css" rel="stylesheet">
                    ';

                } else {

                    echo '
                    <meta name="theme-color" content="'.$appinfo["akzentfarbe"].'"/>
                    <style>
                        :root {
                            --hintergrund: '.$appinfo["hintergrund"].';
                            --akzentfarbe: '.$appinfo["akzentfarbe"].';
                            --schrift: '.$appinfo["schrift"].';
                            --link: '.$appinfo["link"].';
                        }
                        body {
                            font-family: "MetaPro-Normal", sans-serif;
                        }
                        .navbar-brand, .mt-5 {
                            font-family: "Geometria", "MetaPro", sans-serif;
                        }
                    </style>
                    <link href="css/evaStyles.min.css" rel="stylesheet">
                    ';

                }

            }

        ?>

    </head>

    <?php
        if(isset($_GET['adm'])){
            echo '<body style="display: none">';
        } else {
            echo '<body>';
        }
    ?>


        <div class="loadScreen">
            <span class="helper"></span><img class="img-responsive" id="loadingImg" src="img/loading.svg" alt="loadingImg"/>
        </div>

        <div id="pageContents" style="opacity: 0;">

            <!-- Navigation -->
            <div id="naviLink">
                <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top" id="slideMe" style="display: none;">
                    <div class="container">
                        <a class="navbar-brand" href="modul/dashboard/dashboard.php">
                            <img src="
                            <?php
                                if(isset($appinfo["logo_path_".$session_language])){
                                    echo $appinfo["logo_path_".$session_language];
                                } else {
                                    echo $appinfo["logo_path_de"];
                                }
                            ?>
                            " width="<?php echo $appinfo["logo_width"];?>" alt="Logo">
                            <span style="margin-left:20px;"><?php echo $appinfo["title"];?></span>
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
                                            <a class="nav-link" href="modul/settings/settings.php">'. $translate[15].'</a>
                                        </li>
                                        ';

                                        echo $link;

                                    }

                                    if(isset($_GET['adm'])){
                                        echo '
                                        <li class="nav-item" id="editNavLink">
                                            <a class="btn btn-warning" href="logout.php"><b>Back to my Account</b></a>
                                        </li>
                                        ';
                                    }

                                ?>

                            </ul>
                        </div>
                    </div>
                </nav>
            </div>

            <?php
                if(isset($_GET['page']) && $_GET['page'] != ""){
                    if(strpos($_GET['page'], '/') !== false){
                        $pageLink = "modul/".$_GET['page'].".php";
                    } else {
                        $pageLink = "modul/".$_GET['page']."/".$_GET['page'].".php";
                    }

                } else if(isset($_SESSION["user"]["currentPath"])){
                    $pageLink = $_SESSION["user"]["currentPath"];
                } else {
                    $pageLink = "modul/dashboard/dashboard.php";
                }
            ?>

            <!-- Page Content -->
            <div class="container">
    		    <div class="row">
    			    <div class="col-lg-10 offset-md-1">
        				<div page="<?php echo $pageLink; ?>" id="pageContent">
        				</div>
    			    </div>
    		    </div>
            </div>
            <!-- /.container -->

            <footer class="footer" id="slideMeFoot" style="display: none;">
                <div class="container">
                    <a class="foot-link" href="modul/settings/settings.php"><?php echo $translate[16] ?></a> <b class="text-muted">|</b> <a class="foot-link" href="modul/kontakt/kontakt.php"><?php echo $translate[263] ?></a><i class="text-muted"> | <?php echo $_SESSION["user"]['username']; ?></i><span class="text-muted">©<a href="https://www.baloise.com/de/home.html"> Baloise Group</a> | 2018 | <?php echo $appinfo["title"];?> <a href="https://github.com/baloise/eva">v.1.0</a> by <a href="https://eliareutlinger.ch">Elia Reutlinger</a></span>
                </div>
            </footer>
        </div>

        <!-- Bootstrap core JavaScript -->
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
        <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
        <script type="text/javascript" type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.19.1/moment.min.js"></script>

        <?php include('./includes/useTranslations.php'); ?>
        <script type="text/javascript" src="js/index.min.js"></script>

    </body>

</html>
