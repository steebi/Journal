<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="registerStyles.css">
        <title>BibMan</title>
    </head>
    <body>
        <?php
                session_start();
                include('database.php');
                $incorrectLogin = TRUE;
                if(isset($_POST['submit'])){
                    try{
                        $email = trim(filter_input(INPUT_POST, 'email'));
                        $password = trim(filter_input(INPUT_POST, 'password'));
                        $login = $connection->prepare("SELECT * FROM user WHERE email = :email AND password = :password;");
                        $login->bindparam(':email', $email);
                        $login->bindparam(':password', $password);
                        $login->execute();
                        //$print = $login->fetch();
                        //print_r($print);
                        if(count($login->fetchAll()) == 1){
                            $row = $login->fetch();
                            $_SESSION['user_email'] = $row['email'];
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
            <span class="right">BibMan!</span>
        </div>
        
        <div id = "login-form" class = "centerForm">
            <h2>BibMan!</h2>
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
                    <input name="submit" type="submit" value="Submit"/>
                </p>
           </form>
        </div>
        
    </body>
</html>
