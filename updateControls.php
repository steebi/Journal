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
            $myName = $_SESSION['user_name'];
            $email1 = $_SESSION['user_email'];
            $nochanges = FALSE;
            //if there is something in the input fields then add them to the update field
            //These strings will be used to update the fields that need to be changed in the database
            //values will store the variables that need to be updated, the others will store the value
            //to be passed to the update statement
            $updateString = array();
            $updateValues = array();
            $username = "";
            $email = "";
            $password = "";
            $updateSuccessFul = FALSE;
            //these are used to update the session variables in the case either is changed
            $changeName = FALSE;
            $changeMail = FALSE;
            
            //first to check is that the password for this user is correct.
            
            try{
                //takes in the email and password and sees if that user exists in the database
                $testMail = $_SESSION['user_email'];
                $testPassword = trim(filter_input(INPUT_POST, 'verifyPassword'));
                $verifyUser = $connection->prepare("SELECT * FROM user WHERE email = :email AND password = :password;");
                $verifyUser->bindparam(':email', $testMail);
                $verifyUser->bindparam(':password', $testPassword);
                $verifyUser->execute();
                $print = $verifyUser->fetchAll();
                $number = count($print);
                print_r($print);
                //if a match is found then record a session variable of the user email
                //and go to the home page
                if($number == 1){
                    //the user is confirmed to be who they are and the script can continue.
                }   else{
                    //otherwise kick the user back to the upDateDetails page and return an error for incorrect password
                    $_SESSION['error']['login'] = "The password was incorrect for this account!";
                        //header("Location: upDateDetails.php");
                        exit;
                    }
                        
                    }   catch(PDOException $e){
                        echo $e->getMessage();
            }
            
            
            //first check if the check boxes are set, if they are then check the string is not empty
            //and add them to the strings defined above for the sql update query
            if(isset($_POST['changeUserName']) && filter_input(INPUT_POST, 'changeUserName') == 'YES'){
                if(trim(filter_input(INPUT_POST, 'username')) == ''){
                    $_SESSION['error']['username'] = "The username cannot be left blank";
                }   else{
                    array_push($updateString, " userName = :variable");
                    array_push($updateValues, filter_input(INPUT_POST, 'username'));
                    $username = filter_input(INPUT_POST, 'username');
                    $changeName = TRUE;
                }
            }
            
            if(isset($_POST['changePassword']) && filter_input(INPUT_POST, 'changePassword') == 'YES'){
                if(trim(filter_input(INPUT_POST, 'password')) == ''){
                    $_SESSION['error']['password'] = "The password cannot be left blank";
                }   else{
                    array_push($updateString, " password = :variable");
                    array_push($updateValues, filter_input(INPUT_POST, 'password'));
                }
            }
            
            //email must be last so the email is not changed and the SQL statements can use the correct email
            if(isset($_POST['changeEmail']) && filter_input(INPUT_POST, 'changeEmail') == 'YES'){
                if(trim(filter_input(INPUT_POST, 'email')) == ''){
                    $_SESSION['error']['email'] = "The email cannot be left blank";
                }   else{
                    array_push($updateString, " email = :variable");
                    array_push($updateValues, filter_input(INPUT_POST, 'email'));
                    $email = filter_input(INPUT_POST, 'email');
                    $changeMail = TRUE;
                }
            }
            
            //Now the fields have been assigned if the email is set then test it to see
            //it is of the correct form. Then check it is not already in use.
            if($changeMail && filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL)){
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
                    header("Location: upDateDetails.php");
                    exit;
                }   else{
                    try{
                        //loop through the elements in updatevalues/updatestring and add accordingly
                        
                        for($i = 0; $i < count($updateString); $i++){
                            
                            $myQuery = "UPDATE user SET ".$updateString[$i]." WHERE email = '$email1';";
                            //echo "$myQuery";
                            $sqlUpdate = $connection->prepare($myQuery);
                            $sqlUpdate->bindParam(":variable", $updateValues[$i]);
                            //echo "</br>Binding "."$updateValues[$i]";
                            $updateSuccessFul = $sqlUpdate->execute();
                            //echo "</br>$successfulUpdate";
                        }
                        
                        if($updateSuccessFul && $changeMail){
                            $_SESSION['user_email'] = $email;
                        }
                        if($updateSuccessFul && $changeName){
                            $_SESSION['user_name'] = $username;
                        }
                        
                        //$sqlUpdate = $connection->prepare("UPDATE user SET email = 'asd@asd.com' WHERE email= :email;");
                        //$sqlUpdate->bindparam(':email', $email1);
                        //$SuccessfulUpdate = $sqlUpdate->execute();
                    } catch (PDOException $e) {
                        echo $e->getMessage();
                    }

                    }
            
            ?>
        <div id="header" >
            <span><a href="home.php">Home</a></span>&nbsp;|&nbsp;<span><a href="newEntry.php">New Entry</a></span>
            <span class="right"><a href="/upDateDetails.php"><?php echo "$myName"; ?></a>&nbsp;|&nbsp;<a href="logout.php">Logout</a></span>
        </div>
        
        <div class="centerForm">
            <?php
                //if the user has been successfully registered then allow them to register and then login
                if($nochanges){
                    echo "<p>No changes were made to your details.</p><p><a href = \"/home.php\">Return Home</a></p>";
                }else{
                if($updateSuccessFul){
                        echo "<p>Details successfully changed!</p><a href = \"/home.php\">Return to home.</a>";
                    }   else{
                        echo "<p class=\"errors\">There was a problem updating your account. </p><p><a href = \"/upDateDetails.php\">Try again.</a></p>";
                    }
                }
            ?>
        </div>
    </body>
</html>