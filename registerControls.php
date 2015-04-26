<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="registerStyles.css">
        <title>BibTex</title>
    </head>
    <body>
        <?php
        //access any sessions saved
            session_start();
            include('database.php');
            $insertSuccessFull = FALSE;
            //examine the input data to see if it is empty
            if(filter_input(INPUT_POST, 'username') == ''){
                $_SESSION['error']['username'] = "User Name is required.";
            }
            if(filter_input(INPUT_POST, 'email') == ''){
                $_SESSION['error']['email'] = "Email is required.";
            }
            if(filter_input(INPUT_POST, 'password') == ''){
                $_SESSION['error']['password1'] = "Password is required.";
            }
            if(filter_input(INPUT_POST, 'passwordConfirm') == ''){
                $_SESSION['error']['password2'] = "You must re-type your password.";
            }
            
            //check two passwords are the same
            if(filter_input(INPUT_POST, 'password') != filter_input(INPUT_POST, 'passwordConfirm')){
                $_SESSION['error']['password2'] = "Passwords do not match!";
            }
            
            //Now that all fields are confirmed to be non-null validate the email for
            //the correct form and also to ensure it is not in use already
            if(filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL)){
                try{
                    //checks if the email already exists in the DB and doesn't accept it if it does
                    $email = filter_input(INPUT_POST, 'email');
                    $doesEmailExist = $connection->prepare("SELECT * FROM user WHERE email = :email;");
                    $doesEmailExist->bindParam(':email', $email);
                    $doesEmailExist->execute();
                    //if the array is bigger than 0 then the email already exists in the DB
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
            //stopped and redirected back to the register page with an error

            if(isset($_SESSION['error'])){
                header("Location: register.php");
                exit;
            }   else{
                //otherwise continue on and take the input values and store in database
                $username = filter_input(INPUT_POST, 'username');
                $email = filter_input(INPUT_POST, 'email');
                $password = filter_input(INPUT_POST, 'password');
                //creates the MD5 hash of a string as a registration code for the user
                $reg_code = md5(uniqid(rand()));


                try{
                    //insert new values into the database
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


                    $insertSuccessFull = TRUE;
                    
                    //we also want to create the thrash and unfiled folders by default for this user after they have registered
                    try{
                        $email = filter_input(INPUT_POST, 'email');
                        $createThrash = $connection->prepare("INSERT INTO library (displayName, ownerEmail) VALUES ('trash', :ownerEmail);");
                        $createThrash->bindParam(':ownerEmail', $email);
                        $createThrash->execute();
                        $createUnfiled = $connection->prepare("INSERT INTO library (displayName, ownerEmail) VALUES ('unfiled', :ownerEmail);");
                        $createUnfiled->bindParam(':ownerEmail', $email);
                        $createUnfiled->execute();
                    }   catch(PDOException $e) {
                        echo $e->getMessage();
                    }
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
        <div id="header" >
            <span><a href="index.php">Login</a></span>&nbsp;|&nbsp;<span><a href="register.php">Register</a></span>
            <span class="right">BibMan!</span>
        </div>
        
        <div class="centerForm">
            <?php
                //if the user has been successfully registered then allow them to register and then login
                if($insertSuccessFull){
                    echo "<p>Complete the registration process by clicking the following link!</p>";
                    echo "<a href=\"/confirm.php?RegCode=$reg_code\" >Click here to confirm account!</a>";
                }   else{
                    echo "<p class=\"errors\">There was a problem creating your account. </p>>Try again.</p>";
                }
            ?>
        </div>
    </body>
</html>