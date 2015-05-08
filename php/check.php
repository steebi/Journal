<?php
    echo "Here first!";
   if ($_POST['formData']){
       
       echo "HERE";
    //include 'services/config.php';
     // Prevent caching.
     header('Cache-Control: no-cache, must-revalidate');
     header('Expires: Mon, 01 Jan 1996 00:00:00 GMT');
   
     // The JSON standard MIME header.
     header('Content-type: application/json');
   
     parse_str($_POST['formData'], $formarray);
     $username = $formarray['username'];;
     $password = $formarray['password'];;
   
      //$con = pg_connect("host=$dbhost dbname=$dbname user=$dbuser password=$dbpass port=5432") or die ("Could not connect: " . pg_last_error());
         $conn = new PDO('mysql:host=isedbserver.cloudapp.net;port=3306;dbname=user5', "user5", "poi456!!");

      $query = ("INSERT INTO login VALUES('$username','$password')");
      $result = pg_query($query);
   
   
     // Lets say everything is in order
     $output = array('status' => true, 'message' => 'Welcome!','user'=>$username,'pass'=>$password);
     echo json_encode($output);
   }    else{
       echo "No form data";
   }
   ?>