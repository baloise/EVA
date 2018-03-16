
-----------------------------------------------------------------------------------<br />
<?php

ini_set('display_errors', 1);

function getRequestHeaders() {
    $headers = array();
    foreach($_SERVER as $key => $value) {
        if (substr($key, 0, 5) <> 'HTTP_') {
            continue;
        }
        $header = str_replace(' ', '-', ucwords(str_replace('_', ' ', strtolower(substr($key, 5)))));
        $headers[$header] = $value;
    }
    return $headers;
}

$headers = getRequestHeaders();

foreach ($headers as $header => $value) {
    echo "$header: $value <br />\n";
}


    echo "<h2>Airlock Medusa Auth</h2>";
    echo "<p>(ToDo)</p>";
    function loginMedusaToken($token) {
        $decoded = explode(";", file_get_contents('compress.zlib://data:who/cares;base64,'. urldecode($token)));
        $_SESSION["user"]["username"] = explode("=", $decoded[0])[1];
        $_SESSION["roles"] = explode(",",explode("=", $decoded[1])[1]);
    }

    $token =
    "H4sIAAAAAAAAAGVTy27CMBAsX9Ev6I2DnYQAQhxsJylWXlachIp
    Tq5K2SBVIEKSqX9%2BkPdQ7HHe0j9md2ethv5bMn%2FOQrc6nz%2B
    6yroRKzLl7O3zZMmfh9D%2BOjCeFpQBrYxcZSoIZZNjMzdjaxKMFo
    RtHNWfKKBeRHpcNpzXzGfTgZCjXRQIslHXH5LJshBPvbKxElkFNbj
    ggUiGSNm7f4T7a6oiSW7hHTEWbN7WZXvrz6fgOzSqVTB8CtmTMh4V
    nbix3pWHsFgkcpEltngvaxPdgnihqF9EevdvAVRSJBn0ZLQFL1De3
    55AhAHiUu6qkFYlQG9oUEJVZu4kIEUyRjR3IGxB5A9p4YHBKfkjg
    IATz0RLEm39TNc0BZqOcC1Si5XTh8Ubi2n90x%2F7w%2BtJ3%2B2r
    4Tnp5aDuuF8kaGltNF0D2Gt43ZJCxTaUrlmDwvsR1ad5kZQqGCahO
    VP3RlssbzxlaQlWJ27jQgjyr%2BFV%2FdXc3eZ58P93%2FAJFRurv
    WBAAA";

    if(!isset($_SESSION["user"]['username']) && !isset($_POST['username'])) {
        if(isset($_COOKIE["MedusaToken"])) {
            loginMedusaToken($_COOKIE["MedusaToken"]);
        } else if(isset($_POST["user"])){
            $_SESSION["user"]["username"] = $_POST["user"];
        } else {
            loginMedusaToken($token);
        }
    }

    echo("<br/><pre>");
    echo('Medusa User Key: '.$_SESSION["user"]["username"]."\n");
    echo("\n</pre>");

    /*
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

    echo "<b>COOKIES:</b><br /><br />";
    echo("<br/><pre>");
    print_r($_COOKIE);
    echo("\n</pre>");

    echo '<b>HEADERS:</b><br /><br />';
    foreach (getallheaders() as $name => $value) {
        echo "($name => $value);\n";
    }

    */

    if(isset($_SESSION["user"]["username"])  && !isset($_GET['error'])){

        $_POST['username'] = $_SESSION["user"];

    } else {
        echo '
        <br/><br/><br/>Keinen gültigen B-Key in Medusa Token gefunden:<br/>
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
