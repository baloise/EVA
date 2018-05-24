<head>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Login</h1>

                        <?php
                            if(isset($_GET['redirect'])){
                                echo '<form id="loginForm" method="POST" action="auth.php?loginType=normal&&redirect='.$_GET['redirect'].'">';
                            } else {
                                echo '<form id="loginForm" method="POST" action="auth.php?loginType=normal">';
                            }
                        ?>

                    <div class="row">
                        <div class="col-lg-10">
                            <input class="form-control" type="text" name="username" placeholder="Key" id="bKeyInForm" required autofocus/><br/>
                        </div>
                        <div class="col-lg-2">
                            <input class="form-control" type="submit"/>
                        </div>
                    </div>
                </form>
                <br/>
                <hr/>
                <h2>Currently available Keys:</h2>
                <ul>
                    <?php

                        include("database/connect.php");

                        $sql = "SELECT us.bKey, gr.description FROM `tb_user` AS us
                                INNER JOIN tb_group AS gr ON us.tb_group_ID = gr.ID
                                WHERE us.`deleted` IS NULL";

                        $result = $mysqli->query($sql);

                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo '
                                <li>
                                    <b style="cursor: pointer;" class="autofillForm">'.$row['bKey'].'</b> - '.$row['description'].'
                                </li>
                                ';
                            }
                        } else {
                            echo "None";
                        }

                    ?>
                </ul>
            </div>
        </div>
    </div>
    <script type="text/javascript">

        $('.autofillForm').each(function(){
            $(this).click(function(){
                $('#bKeyInForm').val($(this).html());
                document.getElementById('loginForm').submit();
            });
        });

    </script>
</body>


<?php

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
                    <div class="col-12">
                    <br/><br/>
                    <hr/>
                        <div class="error-template">
                            <h1>
                                Oops!</h1>
                            <b>
                                There was an Error:</b>
                            <div class="error-details">
                                <h2>'.$reason.'</h2><br/>
                                Be sure to provide this Error-Message in the Contact-Form below, if you\'d like to get support:
                            </div>
                        </div>
                    </div>
                </div>

        ';

        include("modul/kontakt/kontakt.php");

        echo '
            </div>
        </body>
        ';

    }

    //Prüfen, ob Token verfügbar ist
    if(isset($_COOKIE["MedusaToken"])) {
        if(!isset($_GET['error'])){
            if(isset($_COOKIE["MedusaToken"])) {
                if(isset($_GET['redirect'])){
                    header('Location: auth.php?loginType=medusa&&redirect='.$_GET['redirect']);
                } else {
                    header('Location: auth.php?loginType=medusa');
                }
            }
        }
    } else {

    }

    //Error aus Überprüfung ausgeben
    if(isset($_GET['error'])){
        if ($_GET['error'] == "userNotFound"){
            error("Your Key isn't registered yet");
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
