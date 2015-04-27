<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="registerStyles.css?relaod">
        <title>BibTex</title>
    </head>
    <body>
        <?php
            //firt confirm user is logged in, if not kick to login screen
            session_start();
            require_once 'database.php';
            if($_SESSION['user_email'] == ''){
                header("Location: index.php");
                exit;
            }
            $userName = $_SESSION['user_name'];
            $mail = $_SESSION['user_email'];
            
            print_r($_GET);
            $var = $_GET['libID'];
            echo "$var";
            
            if(!isset($_GET['libID'])){
                echo "getting reference";
                $reference = returnReference($mail, $_GET['libID']);
                print_r($reference);
            }
            
            //take input from get and load the correct page for that
            require_once 'homeFunctions.php';
            
        ?>
        <div id="header" >
            <span><a href="home.php">Home</a></span>&nbsp;|&nbsp;<span><a href="newEntry.php">New Entry</a></span>
            <span class="right"><a href="/upDateDetails.php"><?php echo "$userName"; ?></a>&nbsp;|&nbsp;<a href="logout.php">Logout</a></span>
        </div>
        
        <div id = "insertReference" class = "centerForm"><?php
            echo "<div><ul>";
                foreach($reference as $id){
                   echo "<li>$id</li>";
                }
            echo "</ul></div>";?>
        </div>
    </body>
</html>