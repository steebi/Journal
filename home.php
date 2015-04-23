<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
            session_start();
            if($_SESSION['user_email'] == '')
            {
                echo "Got here!";
                echo $_SESSION['user_email'];
                //header("Location: index.php");
                //exit;
            }
            echo "Hi ".$_SESSION['user_email'];
       ?>
       <a href="logout.php">Logout</a>
    </body>
</html>
