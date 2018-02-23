<?php



	if(null !== (getenv('APP_DB_NAME'))){
		$_db_database = getenv('APP_DB_NAME');
		$_db_host = getenv('APP_DB_HOST');
		$_db_username = getenv('APP_DB_USER');
		$_db_passwort = getenv('APP_DB_PASS');
	} else {
		$_db_database = "db_eva";
		$_db_host = "localhost";
		$_db_username = "root";
		$_db_passwort = "";
	}

    $mysqli = mysqli_connect($_db_host, $_db_username, $_db_passwort, $_db_database);

    if (!$mysqli) {
        die('Connect Error (' . mysqli_connect_errno() . ') '. mysqli_connect_error());
    }

	$mysqli->set_charset('utf8');

?>
