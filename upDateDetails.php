<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" lang="text/css" href="styles.css"/>
        <title>BibTex</title>
    </head>
    <body>
        <?php
            session_start();
            //see if the user is already logged in. If they are redirect to home.php
            if(!isset($_SESSION['user_email'])){
                header("Location: index.php");
                exit;
            }
            $mail = $_SESSION['user_email'];
            $userName = $_SESSION['user_name'];
        ?>
        
        <div id="header" >
            <span><a href="home.php">Home</a></span>&nbsp;|&nbsp;<span><a href="newEntry.php">New Entry</a></span>
            <span class="right"><a href="/upDateDetails.php"><?php echo "$userName"; ?></a>&nbsp;|&nbsp;<a href="logout.php">Logout</a></span>
        </div>
        
        <div id = "update-form" class = "centerForm">
            <h2>Change your details!</h2>
            <p>Select which element to update</p>
            <form action="updateControls.php" method='post'>
                <p>
                    <label for='username' class='checkboxlabel'><input name='changeUserName' type='checkbox' value='YES' class='checkboxinput'/>User name:</label></br>
                    
                    <input name = 'username' type='text' id='username'size='40'/>
                </p>
                <p>
                    <label for='email' class='checkboxlabel'><input name='changeEmail' type='checkbox' value='YES' class='checkboxinput'/>Email address:</label></br>
                    
                    <input name = 'email' type='text' id='email'size='40'/>
                </p>
                <p>
                    <label for='password' class='checkboxlabel'><input name='changePassword' type='checkbox' value='YES' class='checkboxinput'/>Password:</label></br>              
                    <input name = 'password' type='password' id='password'size='40'/>
                </p>
                <p>
                    <label for='confirmPassword' class='checkboxlabel'>Retype password:</label></br>
                    <input name='confirmPassword' type='password' id='confirmPassword' size='40'/>
                </p>
                <p>
                    <label for='verifyPassword'>Please confirm changes by typing old password</label></br>
                    <input name='verifyPassword' type='password' id='verifyPassword' size='40'/>
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
                            if(isset($_SESSION['error']['login'])){
                            echo '<p>'.$_SESSION['error']['login'].'</p>';
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
        
    </body>
</html>
