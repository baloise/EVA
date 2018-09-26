<!DOCTYPE html>
<html lang="en">
    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="View your grades created by Eva">
        <meta name="author" content="Elia Reutlinger">

        <title>Eva-Grades</title>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

        <?php

            if (preg_match("/(Trident\/(\d{2,}|7|8|9)(.*)rv:(\d{2,}))|(MSIE\ (\d{2,}|8|9)(.*)Tablet\ PC)|(Trident\/(\d{2,}|7|8|9))/", $_SERVER["HTTP_USER_AGENT"], $match) != 0) {

                $fixCss=file_get_contents('css/evaStyles.min.css');

                $fixCss=str_replace("var(--hintergrund)", "#ffffff",$fixCss);
                $fixCss=str_replace("var(--akzentfarbe)", "#343a40",$fixCss);
                $fixCss=str_replace("var(--schrift)", "#333333",$fixCss);
                $fixCss=str_replace("var(--link)", "#64A943",$fixCss);

                echo '
                    <style>
                        .navbar-brand {
                            font-family: monospace;
                            color: #64A943;
                        }
                        .dashModuleIcon {
                            margin-bottom: -3vh;
                        }
                        '.$fixCss.'
                    </style>
                ';


            } else {

                echo '
                <meta name="theme-color" content="#343a40"/>
                <style>
                    :root {
                        --hintergrund: #ffffff;
                        --akzentfarbe: #343a40;
                        --schrift: #333333;
                        --link: #64A943;
                    }
                    body {
                        font-family: "RobotoRegular", sans-serif;
                    }
                    .navbar-brand, .mt-5 {
                        font-family: "Geometria", "RobotoRegular", sans-serif;
                        color: #64A94;
                    }
                </style>
                <link href="css/evaStyles.min.css" rel="stylesheet">
                ';


            }

        ?>

    </head>

    <body>
        <div class="loadScreen">
            <span class="helper"></span><img class="img-responsive" id="loadingImg" src="img/loading.svg" alt="loadingImg"/>
        </div>

        <div id="pageContents" style="opacity: 0;">

            <!-- Navigation -->
            <div id="naviLink">
                <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top" id="slideMe" style="display: none;">
                    <div class="container">
                        <a class="navbar-brand" href="#">
                            <img src="img/logo/eva/eva_logo.svg" width="80" alt="Logo">
                            <span style="margin-left:20px;">Eva-Grades</span>
                        </a>
                        <button class="navbar-toggler custom-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarResponsive">
                            <ul class="navbar-nav ml-auto">

                            </ul>
                        </div>
                    </div>
                </nav>
            </div>

            <!-- Page Content -->
            <div class="container">
    		    <div class="row">
    			    <div class="col-lg-10 offset-md-1">
        				<div id="pageContent">

                            <?php include("gradeEngine.php"); ?>

        				</div>
    			    </div>
    		    </div>
            </div>
            <!-- /.container -->

            <footer class="footer" id="slideMeFoot" style="display: none;">
                <div class="container">
                    <i class="text-muted"> 2018 | Eva-Grades <a href="https://github.com/eliareutlinger/evaGrades">v.1.0</a> by <a href="https://eliareutlinger.ch">Elia Reutlinger</a></span>
                </div>
            </footer>
        </div>

        <!-- Bootstrap core JavaScript -->
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
        <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
        <script type="text/javascript" type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.19.1/moment.min.js"></script>

        <script type="text/javascript" src="js/index.min.js"></script>

    </body>

</html>
