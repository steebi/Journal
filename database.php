<?php

/* 
 * This file contains the login details for the SQL database used by the web application.
 * Havin it in one file here allows me to change the database without having to dig through 
 * the code code changing each instance in all the different files.
 */


try{
    $connection = new PDO('mysql:host=isedbserver.cloudapp.net;port=3306;dbname=user5', "user5", "poi456!!");
}   catch (PDOException $e) {
        echo $e->getMessage();
}

?>