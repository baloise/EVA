<?php

    function getDBList($mysqli){
        $entries = array();
        $sql = 'show databases';
        $result = $mysqli->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                array_push($entries,$row['Database']);
                if($row['Database'] == 'db_eva'){
                    $evaIsHere = true;
                }
            }
        } else {
            $entries = "No Entries";
        }
        return $entries;
    }

    include('connect.php');

    $evaIsHere = false;
    $sql = "DROP DATABASE db_eva";
    $mysqli->query($sql);

    $entries = getDBList($mysqli);

    echo "<h1>Database Setuppr</h4>";
    echo "<h4>Available Databases:</h4>";

    echo "<ul>";
    foreach ($entries as $value) {
        echo "<li>$value</li>";
        if($value == 'db_eva'){
            $evaIsHere = true;
        }
    }
    echo "</ul>";

    if($evaIsHere){

        echo "<p>db_eva has been found. Listing Tables...</p>";

        if(!$mysqli = mysqli_connect($_db_host, $_db_username, $_db_passwort, 'db_eva')) {
            die('No connection: ' . mysqli_connect_error());
        }

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
        echo "<p>no db_eva found. Starting Database creation...</p>";

        $sql = "CREATE DATABASE db_eva";

        if ($mysqli->query($sql) === TRUE) {

            echo "<p>Database creation successful. Starting Table creation from .sql File...</p>";

            $sql = '';
            $sqlScript = file('db_eva.sql');
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
            $entries = getDBList($mysqli);
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

    }


?>
