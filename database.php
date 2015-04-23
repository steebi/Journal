<?php

/* 
 * This fil contains the login details for the SQL database used by the web application.
 * Havin it in one file here allows me to change the database without having to dig through 
 * the code code changing each instance in all the different files.
 */


try{
    $connection = new PDO('mysql:host=isedbserver.cloudapp.net;port=3306;dbname=user5', "user5", "poi456!!");
}   catch (PDOException $e) {
        echo $e->getMessage();
}

/*
$server =  "tcp:bujl4riquq.database.windows.net";
$user = "steebi";
$pwd = "iop456!!";
$db = "BibMan";

try {
	$conn = new PDO ( "sqlsrv:server = tcp:bujl4riquq.database.windows.net,1433; Database = BibMan", "steebi", "iop456!!");
	$conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    }	catch ( PDOException $e ) {
	print( "Error connecting to SQL Server." );
	die(print_r($e));
    }
*/

//$connection = new PDO('mysql:host=localhost;dbname=BibMan', "root", "");




?>