<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
            if($_SESSION['user_email'] == ''){
                header("Location: index.php");
                exit;
            }
        ?>
    </body>
</html>
