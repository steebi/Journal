<?php

    echo "GOT HERE!";
    

   if ($_POST['formData']){
    include 'services/config.php';
     // Prevent caching.
     header('Cache-Control: no-cache, must-revalidate');
     header('Expires: Mon, 01 Jan 1996 00:00:00 GMT');
   
     // The JSON standard MIME header.
     header('Content-type: application/json');
   
     parse_str($_POST['formData'], $formarray);
     $username = $formarray['username'];;
     $password = $formarray['password'];;
   
      $con = pg_connect("host=$dbhost dbname=$dbname user=$dbuser password=$dbpass port=5432") or die ("Could not connect: " . pg_last_error());
   
      $query = ("INSERT INTO login VALUES('$username','$password')");
      $result = pg_query($query);
   
   
     // Lets say everything is in order
     $output = array('status' => true, 'message' => 'Welcome!','user'=>$username,'pass'=>$password);
     echo json_encode($output);
   }
   ?>