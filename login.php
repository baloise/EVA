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

    if(isset($_GET['error'])){
        if ($_GET['error'] == "user"){
            echo "<br/><br/><strong>Dieser B-Key existiert nicht in der Datenbank.</strong>";
            die();
        }
        if ($_GET['error'] == "userdeleted"){
            echo "<br/><br/><strong>Dieser B-Key wurde gelöscht/deaktiviert.</strong>";
            die();
        }
    }

    if (isset($message['error'])){
        echo $message['error'];
    }

?>
