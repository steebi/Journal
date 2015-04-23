<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="registerStyles.css">
        <title>BibMan</title>
    </head>
    
    <body>
        <?php
            //load the session data if there is any
            session_start();
            include('database.php');
        ?>
        
        
        <div id="header" >
            <span class="first-command-header"><a href="index.php">Login</a></span>&nbsp;|&nbsp;<span><a href="register.php">Register</a></span>
            <span class="right">BibMan!</span>
        </div>
        
        <div id = "signup-form" class = "centerForm">
            <h2>Sign up to BibMan!</h2>
            <p>Enter your details below</p>
            <form action="registerControls.php" method='post'>
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
                <p class="errors">
                    <?php
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
                </p>
                <p>
                    <input name='submit' type='submit' value='Submit'/>
                </p>
            </form>
        </div>
        
    </body>
</html>
