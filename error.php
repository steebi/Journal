<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="registerStyles.css">
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
                <span class="right"><a href="upDateDetails.php"><?php echo "$userName"; ?></a>&nbsp;|&nbsp;<a href="logout.php">Logout</a></span>
        </div>
        
        <div id = "update-form" class = "centerForm">
            <h1>There was an error processing the request!</h1>
            <div class="errors">
                <?php
                    //If an error was passed in session print the error message recorded
                    if(isset($_SESSION['error'])){
                    if(isset($_SESSION['error']['shareLib'])){
                        echo '<p>'.$_SESSION['error']['shareLib'].'</p>';
                    }

                    //unset the error session variable
                    unset($_SESSION['error']);
                    }
                ?>
                <p><a href="home.php">Return to home!</a></p>
            </div>
        </div>
    </body>
</html>
