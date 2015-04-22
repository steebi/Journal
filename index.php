<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>BibMan</title>
    </head>
    
    <body>
        
        <?php
            echo "PHP";
            //start the session
            session_start();
            include('database.php');
            //If an error was passed in session print the error message recorded
            if(isset($_SESSION['error'])){
                if(isset($_SESSION['error']['username'])){
                    echo '<p>'.$_SESSION['error']['username'].'</p>';
                }
                if(isset($_SESSION['error']['email'])){
                    echo '<p>'.$_SESSION['error']['email'].'</p>';
                }
                if(isset($_SESSION['error']['password'])){
                echo '<p>'.$_SESSION['error']['password'].'</p>';
                }
                
                //unset the error session variable
                unset($_SESSION['error']);
            }
        ?>
        <div class = "signup-form">
            <form action="register.php" method='post'>
                <p>
                    <label for='username'>User name:</label></br>
                    <input name = 'username' type='text' id='username'size='40'/>
                </p>
                <p>
                    <label for='email'>Email address:</label></br>
                    <input name = 'email' type='text' id='email'size='40'/>
                </p>
                <p>
                    <label for='password'>Password:</label></br>
                    <input name = 'password' type='password' id='password'size='40'/>
                </p>
                <p>
                    <input name='submit' type='submit' value='Submit'/>
                </p>
            </form>
        </div>
        
        <p><a href='login.php'>Login</a></p>
                
        
    </body>
</html>
