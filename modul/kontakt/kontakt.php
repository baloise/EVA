<?php

    if (file_exists("../../database/connect.php")) {
        include("../../database/connect.php");
    } else if (file_exists("database/connect.php")){
        include("database/connect.php");
    }

?>

<?php

    session_start();

    if (isset($_SESSION['user']['id'])){
        $sqlUser = "SELECT firstname, lastname, mail FROM `tb_user` WHERE id = ".$_SESSION['user']['id'].";";

        $resultUser = $mysqli->query($sqlUser);

        if (isset($resultUser) && $resultUser->num_rows == 1) {

            $rowUser = $resultUser->fetch_assoc();

            $formCreds = "
            <div class='form-group'>
                <label for='fname'>". $_SESSION['translations'][41] ."</label>
                <input id='fname' type='text' name='fname' class='form-control' value='".$rowUser['firstname']."' required/>
            </div>
            <div class='form-group'>
                <label for='lname'>". $_SESSION['translations'][42] ."</label>
                <input id='lname' type='text' name='lname' class='form-control' value='".$rowUser['lastname']."' required/>
            </div>
            <div class='form-group'>
                <label for='email'>". $_SESSION['translations'][255] ."</label>
                <input id='email' type='text' name='email' class='form-control' value='".$rowUser['mail']."' required/>
            </div>
            ";

            $themeList = "
            <select id='subj' name='subject' class='form-control'>
                <option value='generalhr'>".$_SESSION['translations'][265]."</option>
                <option value='generalit'>".$_SESSION['translations'][266]."</option>
                <option value='suggest'>".$_SESSION['translations'][267]."</option>
                <option value='feedback'>".$_SESSION['translations'][268]."</option>
                <option value='support'>".$_SESSION['translations'][269]."</option>
                <option value='error'>".$_SESSION['translations'][270]."</option>
            </select>
            ";

        }

    } else {

        $formCreds = "
        <div class='form-group'>
            <label for='fname'>Firstname</label>
            <input id='fname' type='text' name='fname' class='form-control'/>
        </div>
        <div class='form-group'>
            <label for='lname'>Lastname</label>
            <input id='lname' type='text' name='lname' class='form-control'/>
        </div>
        <div class='form-group'>
            <label for='email'>Email</label>
            <input id='email' type='text' name='email' class='form-control'/>
        </div>
        ";

        $themeList = "
        <select id='subj' name='subject' class='form-control'>
            <option>General Request (Human-Resources)</option>
            <option>General Request (Developement)</option>
            <option>Suggestions</option>
            <option>Feedback / Criticism</option>
            <option>Product Support</option>
            <option>Problem / Error</option>
        </select>
        ";

    }

?>

<h1 class="mt-5">
    <?php
        if(isset($_SESSION['translations'])){
            echo ($_SESSION['translations'][263]);
        } else {
            echo "Contact";
        };
    ?>
</h1>

<div class='container'>
    <div class='row'>
        <div class='col-sm-12'>
            <div class="alert alert-success" style="display:none;" role="alert">
                <?php
                    if(isset($_SESSION['translations'])){
                        echo ($_SESSION['translations'][272]);
                    } else {
                        echo "Thanks! You Message has been sent!";
                    };
                ?>
            </div>
            <div class='well formArea'>
                <form>
                    <div class='row'>
                        <div class='col-sm-4'>
                            <?php echo $formCreds; ?>
                            <div class='form-group'>
                                <label for='subject'>
                                    <?php
                                        if(isset($_SESSION['translations'])){
                                            echo ($_SESSION['translations'][271]);
                                        } else {
                                            echo "Subject";
                                        };
                                    ?>
                                </label>
                                <?php echo $themeList; ?>
                            </div>
                        </div>
                        <div class='col-sm-8'>
                            <div class='form-group'>
                                <label for='message'>
                                    <?php
                                        if(isset($_SESSION['translations'])){
                                            echo ($_SESSION['translations'][264]);
                                        } else {
                                            echo "Message";
                                        };
                                    ?>
                                </label>
                                <textarea id='message' class='form-control' name='message' rows='10'><?php if(isset($reason)){
                                        echo 'ERROR MESSAGE:
------- '. $reason .' -------
WRITE YOUR MESSAGE BELOW:
'; } ?>
</textarea>
                            </div>
                            <div class='text-right'>
                                <input type='submit' class='btn btn-primary' id="sendContact" value='
                                <?php
                                    if(isset($_SESSION['translations'])){
                                        echo ($_SESSION['translations'][31]);
                                    } else {
                                        echo "Send";
                                    };
                                ?>
                                '/>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="modul/kontakt/kontakt.min.js"></script>
