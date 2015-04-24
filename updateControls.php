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
            $values = " ";
            $username = "";
            $email = "";
            $password = "";
            $changeName = FALSE;
            $changeMail = FALSE;
            if(!(trim(filter_input(INPUT_POST, 'username')) == '')){
                $values .= " userName= :username ";
                $username = filter_input(INPUT_POST, 'username');
                $changeName = TRUE;
            }
            if(!(trim(filter_input(INPUT_POST, 'email')) == '')){
                $values .= " email = :email ";
                $email = filter_input(INPUT_POST, 'email');
                $changeMail = TRUE;
            }
            if(!(trim(filter_input(INPUT_POST, 'password')) == '')){
                $values .= " password = :password ";
                $email = filter_input(INPUT_POST, 'password');
            }
            //if no changes were 
            if(filter_input(INPUT_POST, 'username') == '' && filter_input(INPUT_POST, 'email') == '' && filter_input(INPUT_POST, 'password') == ''){
                $nochanges = TRUE;
                }   else{
                //Now that all fields are prepared validate the email for
                //the correct form and also to ensure it is not in use already
                if(!(filter_input(INPUT_POST, 'email') == '' && filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL))){
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
                        //insert new values into the database
                        $myQuery = "UPDATE user SET ".$values." WHERE email = '$email1';";
                        echo "$myQuery";
                        $sqlUpdate = $connection->prepare($myQuery);

                        if(!(trim(filter_input(INPUT_POST, 'username')) == '')){
                            $sqlUpdate->bindParam(":username", $username);
                            echo "</br> Bind Param1";
                        }
                        if(!(trim(filter_input(INPUT_POST, 'password')) == '')){
                            $sqlUpdate->bindParam(":password", $password);
                            echo "</br> Bind Param2";
                        }
                        if(!(trim(filter_input(INPUT_POST, 'email')) == '')){
                            $sqlUpdate->bindParam(":email", $email);
                            echo "</br> Bind Param3";
                        }
                        
                        $SuccessfulUpdate = $sqlUpdate->execute();
                        
                        if($SuccessfulUpdate && $changeMail){
                            $_SESSION['user_email'] = $email;
                        }
                        if($SuccessfulUpdate && $changeName){
                            $_SESSION['user_name'] = $username;
                        }
                        
                        //$sqlUpdate = $connection->prepare("UPDATE user SET email = 'asd@asd.com' WHERE email= :email;");
                        //$sqlUpdate->bindparam(':email', $email1);
                        //$SuccessfulUpdate = $sqlUpdate->execute();
                    } catch (PDOException $e) {
                        echo $e->getMessage();
                    }

                    } 
                }
            
            ?>
        <div id="header" >
            <span><a href="home.php">Home</a></span>&nbsp;|&nbsp;<span><a href="newEntry.php">New Entry</a></span>
            <span class="right"><a href="/BibTex/upDateDetails.php"><?php echo "$myName"; ?></a>&nbsp;|&nbsp;<a href="logout.php">Logout</a></span>
        </div>
        
        <div class="centerForm">
            <?php
                //if the user has been successfully registered then allow them to register and then login
                if($nochanges){
                    echo "<p>No changes were made to your details.</p><p><a href = \"/BibTex/home.php\">Return Home</a></p>";
                }else{
                if($SuccessfulUpdate){
                        echo "<p>Details successfully changed!</p><a href = \"/BibTex/home.php\">Return to home.</a>";
                    }   else{
                        echo "<p class=\"errors\">There was a problem updating your account. </p><p><a href = \"/BibTex/upDateDetails.php\">Try again.</a></p>";
                    }
                }
            ?>
        </div>
    </body>
</html>