<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="registerStyles.css?relaod">
        <title>BibTex</title>
    </head>
    <body>
        <?php
                session_start();
                
                //see if the user is already logged in. If they are redirect to home.php
                if(isset($_SESSION['user_email'])){
                    header("Location: home.php");
                    exit;
                }
                //include connection information for database
                include('database.php');
                //set an incorrect login variable to TRUE initially. If an incorrect login is found then inform the user
                $incorrectLogin = TRUE;
                
                echo "";
                
                //if there was some information given in post examine it to either login or give error to pass in post
                if(isset($_POST['submit'])){
                    
                    //first confirm that the input is not empty
                    if(filter_input(INPUT_POST, 'email') == '' && filter_input( INPUT_POST, 'password')==''){
                        $_SESSION['error']['login']="Both fields were left blank!";
                    }   else if(filter_input(INPUT_POST, 'password') == ''){
                        $_SESSION['error']['login']="The password field was left blank!";
                    }   else if(filter_input(INPUT_POST, 'email') == ''){
                        $_SESSION['error']['login']="The email field was left blank!";
                    }   else{
                        try{
                            //first tests to see if the username is in the database
                            $email = trim(filter_input(INPUT_POST, 'email'));
                            $userExists = $connection->prepare("SELECT username FROM user WHERE email = :email;");
                            $userExists->bindParam(':email', $email);
                            $userExists->execute();
                            $confirmUser = $userExists->fetchAll();
                            $countUsers = count($confirmUser);
                            if($countUsers == 1){
                                //user was confirmed to be in the database so now check that the password is correct
                                $password = trim(filter_input(INPUT_POST, 'password'));
                                $login = $connection->prepare("SELECT * FROM user WHERE email = :email AND password = :password;");
                                $login->bindparam(':email', $email);
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
                                    $_SESSION['user_email'] = $mail;
                                    $_SESSION['user_name'] = $username;
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
                        }   catch(PDOException $e){
                            echo $e->getMessage();
                        }

                    }
                }
        ?>
        
        <div id="header" >
            <span><a href="index.php">Login</a></span>&nbsp;|&nbsp;<span><a href="register.php">Register</a></span>
            <span class="right">BibTex!</span>
        </div>
        
        <div id = "login-form" class = "centerForm">
            <h2>BibTex!</h2>
            <p>Please login below!</p>
            <form action="index.php" method="post" >
                <p>
                    <label for="email">E-mail:</label></br>
                    <input name="email" type="text" id="email" size="30"/>
                </p>
                <p>
                    <label for="password">Password:</label></br>
                    <input name="password" type="password" id="password" size="30"/>
                </p>
                <div class="errors">
                    <?php
                        //if there is an error then print it to the user
                        if(isset($_SESSION['error']['login'])){
                            $error = $_SESSION['error']['login'];
                            echo "<p>$error</p>";
                            unset($_SESSION['error']);
                        }
                    ?>
                </div>
                <p>
                    <input class="submit" name="submit" type="submit" value="Submit"/>
                </p>
           </form>
        </div>
        
    </body>
</html>
