<form method="POST" action="login.php">
    <input type="text" name="username" placeholder="B-Key" required autofocus/>
    <input type="submit"/>
</form>
<br/>
<hr/>
<h2>Momentan verfügbare B-Keys:</h2>
<ul>
    <li>
        b000001 - Nachwuchsentwicklung
    </li>
</ul>

<?php

    ini_set('display_errors', 1);

    if (isset($_POST['username'])){
        include("auth.php?loginType=normal");
    }

    //Error ausgeben, falls einer übergeben wurde
    function error($reason){

        echo '
        <head>
            <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
            <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
            <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
        </head>
        <body>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="error-template">
                            <h1>
                                Oops!</h1>
                            <h2>
                                There was an Error:</h2>
                            <div class="error-details">
                                '.$reason.'
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </body>
        ';
    }

    //Prüfen, ob Token verfügbar ist
    if(isset($_COOKIE["MedusaToken"])) {
        if(!isset($_GET['error'])){
            if(isset($_COOKIE["MedusaToken"])) {
                header('Location: auth.php?loginType=medusa');
            }
        }
    } else {
        error("Your request didn't deliver any useable Login-Tokens");
    }

    //Error aus Überprüfung ausgeben
    if(isset($_GET['error'])){
        if ($_GET['error'] == "userNotFound"){
            error("You Key doesn't exist in our database");
            die();
        }
        if ($_GET['error'] == "userDeleted"){
            error("Your Account has been deleted");
            die();
        }
        if ($_GET['error'] == "noType"){
            error("Your request didn't deliver any Login-Type");
            die();
        }

    }

?>
