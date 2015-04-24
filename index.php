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
                //if there was some information given in post examin it to either login 
                if(isset($_POST['submit'])){
                    try{
                        //takes in the email and password and sees if that user exists in the database
                        $email = trim(filter_input(INPUT_POST, 'email'));
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
                        }
                        
                    }   catch(PDOException $e){
                        echo $e->getMessage();
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
                <p class="errors">
                    <?php
                        if(!$incorrectLogin){
                            echo "The password does not match this user!";
                        }
                    ?>
                </p>
                <p>
                    <input class="submit" name="submit" type="submit" value="Submit"/>
                </p>
           </form>
        </div>
        
    </body>
</html>
