<?php

	if(getenv('APP_DB_USER')){
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

	if(!function_exists('execPrepStmt')){
		function execPrepStmt($mysqli, $query, $formatString, ...$params){

			$stmt = $mysqli->prepare($query);
			if ( false===$stmt ) {
			  	return('ERROR#001'); //Prepare Failed
			}

			$rc = $stmt->bind_param($formatString, ...$params);
			if ( false===$rc ) {
			  	return('ERROR#002'); //Bind Failed
			}

			$rc = $stmt->execute();
			if ( false===$rc ) {
			  	return('ERROR#003'); //Execute Failed
			}

	        return $stmt->get_result();

	    }
	}

    if (!$mysqli) {
        echo "ERROR#004"; //Connect Failed

		if(mysqli_connect_errno() == 1049){

			$mysqli = mysqli_connect($_db_host, $_db_username, $_db_passwort);

			echo "Database " . $_db_database . " not found. Starting creation from scratch Template.";

			$sql = "CREATE DATABASE $_db_database CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;";

	        if ($mysqli->query($sql) === TRUE) {

	            echo "<p>Database creation successful. Starting Table creation from .sql File...</p>";

				$mysqli = mysqli_connect($_db_host, $_db_username, $_db_passwort, $_db_database);
				if (!$mysqli) {
					echo "<p>Couldn't connect to DB.</p>";
				}

	            $sql = '';
	            $sqlScript = file('database/importScripts/db.eva.0.sql');
	            foreach ($sqlScript as $line)	{

	            	$startWith = substr(trim($line), 0 ,2);
	            	$endWith = substr(trim($line), -1 ,1);

	            	if (empty($line) || $startWith == '--' || $startWith == '/*' || $startWith == '//') {
	            		continue;
	            	}

	            	$sql = $sql . $line;
	            	if ($endWith == ';') {
	            		mysqli_query($mysqli,$sql) or die('<p>Problem in executing the SQL query:<br/><br/> <b>' . $sql. '</b></p>');
	            		$sql= '';
	            	}
	            }
	            echo '<p>SQL file imported successfully...</p>';

	            echo "<p>Table creation successful. Listing new Databases:</p>";

				$entries = array();
		        $sql = 'show databases';
		        $result = $mysqli->query($sql);
		        if ($result->num_rows > 0) {
		            while($row = $result->fetch_assoc()) {
		                array_push($entries,$row['Database']);
		                if($row['Database'] == $_db_database){
		                    $evaIsHere = true;
		                }
		            }
		        } else {
		            $entries = "No Entries";
		        }

	            echo "<ul>";
	            foreach ($entries as $value) {
	                echo "<li>$value</li>";
	            }
	            echo "</ul>";

	            echo "<p>Listing new Tables:</p>";

	            $entries = array();
	            $sql = 'show tables;';
	            $result = $mysqli->query($sql);

	            if ($result->num_rows > 0) {

	                echo "<h4>Available Tables:</h4>";

	                while($row = $result->fetch_assoc()) {
	                    array_push($entries,$row['Tables_in_db_eva']);
	                }

	            } else {
	                $entries = "No Entries";
	            }

	            echo "<ul>";
	            foreach ($entries as $value) {
	                echo "<li>$value</li>";
	            }
	            echo "</ul>";



	        } else {
	            echo "Error creating database: " . $mysqli->error;
	        }

		} else {
		    die('Connect Error (' . mysqli_connect_errno() . ') '. mysqli_connect_error().' on '.$_db_username.'@'.$_db_host.'/'.$_db_database);
		}

    } else {

		if (mysqli_num_rows($mysqli->query("SHOW TABLES")) < 1){

			echo "No Tables found in Database " . $_db_database . ". Start creating Tables from scratch import.";

			$sql = '';
			$sqlScript = file('database/importScripts/db.eva.0.sql');
			foreach ($sqlScript as $line)	{

				$startWith = substr(trim($line), 0 ,2);
				$endWith = substr(trim($line), -1 ,1);

				if (empty($line) || $startWith == '--' || $startWith == '/*' || $startWith == '//') {
					continue;
				}

				$sql = $sql . $line;
				if ($endWith == ';') {
					mysqli_query($mysqli,$sql) or die('<p>Problem in executing the SQL query:<br/><br/> <b>' . $sql. '</b></p>');
					$sql= '';
				}
			}
			echo '<p>SQL file imported successfully...</p>';

			echo "<p>Table creation successful. Listing new Tables:</p>";

			$entries = array();
			$sql = 'show tables;';
			$result = $mysqli->query($sql);

			if ($result->num_rows > 0) {

				echo "<h4>Available Tables:</h4>";

				while($row = $result->fetch_assoc()) {
					array_push($entries,$row['Tables_in_db_eva']);
				}

			} else {
				$entries = "No Entries";
			}

			echo "<ul>";
			foreach ($entries as $value) {
				echo "<li>$value</li>";
			}
			echo "</ul>";

		}

	}



?>
