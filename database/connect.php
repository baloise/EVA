<?php

	$_db_host = "localhost";
	$_db_database = "snobbr";
	$_db_username = "root";
	$_db_passwort = "";

    $mysqli = mysqli_connect($_db_host, $_db_username, $_db_passwort, $_db_database);
    
    if (!$mysqli) {
        die('Connect Error (' . mysqli_connect_errno() . ') '. mysqli_connect_error());
    }
	
	$mysqli->set_charset('utf8');

?>