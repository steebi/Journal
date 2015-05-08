<?php
   if ($_POST['formData']){
    include 'services/config.php';
     // Prevent caching.
     header('Cache-Control: no-cache, must-revalidate');
     header('Expires: Mon, 01 Jan 1996 00:00:00 GMT');
   
     // The JSON standard MIME header.
     header('Content-type: application/json');
   
   $connection = new PDO('mysql:host=isedbserver.cloudapp.net;port=3306;dbname=user5', "user5", "poi456!!");
}  
   
   
   
     parse_str($_POST['formData'], $formarray);
     $username = $formarray['username'];;
     $password = $formarray['password'];;
	
	try{
		$connection = new PDO('mysql:host=isedbserver.cloudapp.net;port=3306;dbname=user5', "user5", "poi456!!");
                            $userExists = $connection->prepare("SELECT username FROM user WHERE email = :email;");
                            $userExists->bindParam(':email', $username);
                            $userExists->execute();
                            $confirmUser = $userExists->fetchAll();
                            $countUsers = count($confirmUser);
							if($countUsers == 1){
                                //user was confirmed to be in the database so now check that the password is correct
                                $login = $connection->prepare("SELECT * FROM user WHERE email = :email AND password = :password;");
                                $login->bindparam(':email', $username);
                                $login->bindparam(':password', $password);
                                $login->execute();
                                $print = $login->fetchAll();
                                $number = count($print);
                                //print_r($print);
                                //if a match is found then record a session variable of the user email
                                //and go to the home page
                                if($number == 1){
                                    $mail = $print[0]['email'];
                                    $username = $print[0]['userName'];
                                    $_SESSION['user_email'] = $username;
                                    header("Location: home.php");
                                    exit;
                                }   else{
                                    $incorrectLogin = FALSE;
                                    $_SESSION['error']['login'] = "The password is incorrect for this user!";
                                }
                            }  else{
                                $incorrectLogin = FALSE;
                                $_SESSION['error']['login'] = "This user does not exist!";
                            }
	}   catch (PDOException $e) {
			echo $e->getMessage();
	}
   
      $con = pg_connect("host=$dbhost dbname=$dbname user=$dbuser password=$dbpass port=3306") or die ("Could not connect: " . pg_last_error());
   
      $query = ("SELECT ");
      $result = pg_query($query);
   
   
     // Lets say everything is in order
     $output = array('status' => true, 'message' => 'Welcome!','user'=>$username,'pass'=>$password);
     echo json_encode($output);
   }
   ?>