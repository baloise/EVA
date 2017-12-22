<?php

    session_start();
    session_regenerate_id();
 
	if (empty($_SESSION['login'])) {
		header('Location: login.php');
	} else {

        $username = $_SESSION['user']['username'];
        
        $sql = "SELECT tb_group_id, deleted FROM tb_user WHERE bKey = '$username'";
        $result = $mysqli->query($sql);
        
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if($row['deleted'] == 1){
                 header("Location: login.php?error=userdeleted");
            } else {
                $_SESSION['user']['usergroup'] = $row['tb_group_id'];
            }
        } else {
            header("Location: login.php?error=user");
        }
    }
    
    /*
     *  --> Scripts für LDAP/SSO etc...
     *
    function isDevelopment() {
        // TODO : implement me
        return true;
    }
    
    function loginMedusaToken($token) {
        $decoded = explode(";", file_get_contents('compress.zlib://data:who/cares;base64,'. urldecode($token)));
        $_SESSION["usr"] = explode("=", $decoded[0])[1];
        $_SESSION["roles"] = explode(",",explode("=", $decoded[1])[1]);
    }
    
    function loginLDAP($usr, $pwd) {
        // TODO wollen wir das wirklich implementieren? -> 
    }    

    $token = "H4sIAAAAAAAAAGVTy27CMBAsX9Ev6I2DnYQAQhxsJylWXlachIpTq5K2SBVIEKSqX9%2BkPdQ7HHe0j9md2ethv5bMn%2FOQrc6nz%2B6yroRKzLl7O3zZMmfh9D%2BOjCeFpQBrYxcZSoIZZNjMzdjaxKMFoRtHNWfKKBeRHpcNpzXzGfTgZCjXRQIslHXH5LJshBPvbKxElkFNbjggUiGSNm7f4T7a6oiSW7hHTEWbN7WZXvrz6fgOzSqVTB8CtmTMh4Vnbix3pWHsFgkcpEltngvaxPdgnihqF9EevdvAVRSJBn0ZLQFL1De355AhAHiUu6qkFYlQG9oUEJVZu4kIEUyRjR3IGxB5A9p4YHBKfkjgIATz0RLEm39TNc0BZqOcC1Si5XTh8Ubi2n90x%2F7w%2BtJ3%2B2r4Tnp5aDuuF8kaGltNF0D2Gt43ZJCxTaUrlmDwvsR1ad5kZQqGCahOVP3RlssbzxlaQlWJ27jQgjyr%2BFV%2FdXc3eZ58P93%2FAJFRurvWBAAA";
    loginMedusaToken($token);
    if(!isset($_SESSION["usr"])) {
        if(isset($_COOKIE["MedusaToken"])) {
            loginMedusaToken($_COOKIE["MedusaToken"]);
        } else if(isset($_POST["USR"])){
            $_SESSION["usr"] = $_POST["USR"];
            if(isDevelopment()) {
                $_SESSION["roles"] = explode(",",$_POST["PWD"]);
            } else {
                loginLDAP($_POST["USR"], $_POST["PWD"]);
            }
        } else {
            include("loginForm.php");
            die();
        }     
    }
    
    // TODO find better logging ;-)
    
    echo("<br/><pre>");
    echo('usr : '.$_SESSION["usr"]."\nroles: ");
    print_r($_SESSION["roles"]);
    echo("\n</pre>");
    
    */
?>
