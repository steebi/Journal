<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="registerStyles.css">
        <title>BibMan</title>
    </head>
    <body>
        <?php

            include("database.php");
            //take the register code 
            $RegCode = filter_input(INPUT_GET, 'RegCode');
            $setRegCode = $connection->prepare("UPDATE user SET reg_code=NULL WHERE reg_code=:reg_code");
            $setRegCode->bindParam(':reg_code', $RegCode);
            $execute = $setRegCode->execute();
            if($execute){
            }   else{
                echo "Some error occured";
            }

        ?>
        <div id="header" >
            <span><a href="index.php">Login</a></span>&nbsp;|&nbsp;<span><a href="register.php">Register</a></span>
            <span class="right">BibMan!</span>
        </div>
        
        <div class="centerForm">
            <p>Your account has been confirmed!</p>
            <p>Please login now:</p>
            <a href="index.php">Login</a>
        </div>
    </body>
</html>