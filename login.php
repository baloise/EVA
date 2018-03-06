
-----------------------------------------------------------------------------------<br />

<b>HEADERS:</b><br /><br />
<?php

if (!function_exists('getallheaders')) {
    function getallheaders() {
           $headers = [];
       foreach ($_SERVER as $name => $value) {
           if (substr($name, 0, 5) == 'HTTP_') {
               $headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value;
           }
       }
       return $headers;
    }
}

foreach (getallheaders() as $name => $value) {
    echo "($name => $value);\n";
}

if(isset($test)){

} else {
    echo '<br/><br/><br/>Kein B-Key gefunden:<br/>
    <form method="POST" action="login.php">
        <input type="text" name="username" placeholder="B-Key" required autofocus/>
        <input type="submit"/>
    </form>
    ';
}

?>
-----------------------------------------------------------------------------------
<br/>
<hr/>
<h2>Momentan verfügbare B-Keys:</h2>
<ul>
    <li>
        b000001 - Nachwuchsentwicklung
    </li>
    <li>
        b000002 - Nachwuchsentwicklung
    </li>
    <li>
        b000003 - PA
    </li>
    <li>
        b000004 - PA
    </li>
    <li>
        b000005 - Lernender IT
    </li>
    <li>
        b000006 - Lernender IT
    </li>
    <li>
        b000007 - Lernender KV Versicherung
    </li>
    <li>
        b000008 - Lernender KV Versicherung
    </li>
    <li>
        b000009 - Lernender KV Bank
    </li>
    <li>
        b000010 - Lernender KV Bank
    </li>
</ul>


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
