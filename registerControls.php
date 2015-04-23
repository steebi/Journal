<?php
//access any sessions saved
    session_start();
    
    include('database.php');
    //examine the input data to see if it is empty
    if(filter_input(INPUT_POST, 'username') == ''){
        $_SESSION['error']['username'] = "User Name is required.";
    }
    if(filter_input(INPUT_POST, 'email') == ''){
        $_SESSION['error']['email'] = "Email is required.";
    }
    if(filter_input(INPUT_POST, 'password') == ''){
        $_SESSION['error']['password'] = "Password is required.";
    }
    //Now that all fields are confirmed to be non-null validate the email for
    //the correct form and also to ensure it is not in use already
    if(filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL)){
        try{
            $email = filter_input(INPUT_POST, 'email');
            $doesEmailExist = $connection->prepare("SELECT * FROM user WHERE email = :email;");
            $doesEmailExist->bindParam(':email', $email);
            $doesEmailExist->execute();

            if(count($doesEmailExist->fetchAll())>0){
                $_SESSION['error']['email'] = "This Email is already in use!";
            }
        }   catch (PDOException $e) {
            echo $e->getMessage();
        }

    }   else{
        //if the format is not a valid email format return an error
        $_SESSION['error']['email'] = "This is not a valid email";
    }

    //ensures there are no special characters in the username
    if (preg_match('/[^A-Za-z0-9]/', filter_input(INPUT_POST, 'username')))
    {
      $_SESSION['error']['username'] = "No special characters allowed in username";
    }

    //Now that the input has been validated if there is an error the user will be 
    ////stopped and redirected back to the register page with an error

    if(isset($_SESSION['error'])){
        header("Location: register.php");
        exit;
    }   else{

        $username = filter_input(INPUT_POST, 'username');
        $email = filter_input(INPUT_POST, 'email');
        $password = filter_input(INPUT_POST, 'password');
        //creates the MD5 hash of a string
        $reg_code = md5(uniqid(rand()));


        try{
            $sqlInsert = $connection->prepare("INSERT INTO user VALUES (:email, :password, :username, :reg_code);");

            $sqlInsert->bindParam(':email', $email);
            $sqlInsert->bindParam(':password', $password);
            $sqlInsert->bindParam(':username', $username);
            $sqlInsert->bindParam(':reg_code', $reg_code);
            $SuccessfulInsert = $sqlInsert->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

        //if data was successfully inserted then send a confirmation email
        if($SuccessfulInsert){
            /*
             * None of the email functions I used worked, so I instead just print the confirmation address on the page.
             */


            echo "<a href=\"http://localhost/BibTex/confirm.php?RegCode=$reg_code\" >Click here to confirm account!</a>"; 
            

            /*
            $to = $email;
            $subject = "Confirmation from BibMan";
            $body = "Hey $username you have almost completed creating your BibMan account.";
            $body .= " All you need to do is click the link below and verify your account!\n\n";
            $body .= "http://localhost/BibTex/confirm.php?RegCode=$reg_code";
            */
            //$sendEmail = mail($to, $subject, $body, $header);

            /*if(mail($to, $subject, $body, $header)){
                echo "Confirmation has been sent!";
            }   else{
                echo "Cannot send confirmation link to email!";
            }*/
            /*
            $sendgrid = new SendGrid('azure_12a7e2a8cb4ba4036b8b5975631939ad@azure.com', 'Your Password');
            $mymail    = new SendGridMail();

            $mymail->addTo($to)
                  ->setFrom("someMail@example.com")
                  ->setSubject($subject)
                  ->setText($body);

            $sendgrid->smtp->send($mymail);
            */
        } 
    }
    ?>