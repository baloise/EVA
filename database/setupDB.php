<?php

    function getDBList($setupConn){
        $entries = array();
        $sql = 'show databases';
        $result = $setupConn->query($sql);
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

    $_db_host = "DB_HOST";
    $_db_username = "DB_USER";
    $_db_passwort = "DB_PASS";
    $evaIsHere = false;

    if( ! $setupConn = mysqli_connect($_db_host, $_db_username, $_db_passwort) ) {
        die('No connection: ' . mysqli_connect_error());
    }

    $entries = getDBList($setupConn);

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
        echo "<p>db_eva has been found. Checking for updates...</p>";
        //TODO
    } else {
        echo "<p>no db_eva found. Starting Table creation...</p>";

        ob_start();
        include('db_eva.sql');
        $dbCreateSql = "'" . ob_get_contents() . "'";
        ob_end_clean();

        $sql = "CREATE DATABASE db_eva";

        if ($setupConn->query($sql) === TRUE) {

            echo "<p>db creation successful. Listing new tables:</p>";
            $entries = getDBList($setupConn);

            echo "<ul>";
            foreach ($entries as $value) {
                echo "<li>$value</li>";
            }
            echo "</ul>";

        } else {
            echo "Error creating database: " . $setupConn->error;
        }

    }


?>
