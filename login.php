<form method="POST" action="login.php">
    <input type="text" name="username" placeholder="B-Key" required/>
    <input type="submit"/>
</form>

<?php

    if(isset($_GET['error'])){
        if ($_GET['error'] = "user"){
            echo "<br/><br/><strong>Dieser B-Key existiert nicht in der Datenbank.</strong>";
        }
        if ($_GET['error'] = "userdeleted"){
            echo "<br/><br/><strong>Dieser B-Key wurde gelöscht/deaktiviert.</strong>";
        }
    }

    if (isset($_SESSION['login'])) {
        redirect("index.php");
    } else {
        if (!empty($_POST)) {
            if (empty($_POST['username'])) {
                $message['error'] = 'Bitte B-Key angeben.';
            } else {

                ini_set('session.cookie_lifetime', 60 * 60 * 24 * 100);
				ini_set('session.gc_maxlifetime', 60 * 60 * 24 * 100);
						
				session_start();
 
				$_SESSION = array('login' => true,'user'  => array('username'  => $_POST['username']));
                
                header("Location: auth.php");
            
            }
        }
    }
    
    if (isset($message['error'])){
        echo $message['error'];
    }

?>