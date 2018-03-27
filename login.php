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
                <form method="POST" action="auth.php?loginType=normal">
                    <div class="row">
                        <div class="col-lg-10">
                            <input class="form-control" type="text" name="username" placeholder="Key" required autofocus/><br/>
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
                                INNER JOIN tb_group AS gr ON us.tb_group_ID = gr.ID";

                        $result = $mysqli->query($sql);

                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo '
                                <li>
                                    '.$row['bKey'].' - '.$row['description'].'
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
