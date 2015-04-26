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
            if($_SESSION['user_email'] == ''){
                header("Location: index.php");
                exit;
            }
            $userName = $_SESSION['user_name'];
            $mail = $_SESSION['user_email'];
        ?>
        
        <div id="header" >
            <span><a href="home.php">Home</a></span>&nbsp;|&nbsp;<span><a href="newEntry.php">New Entry</a></span>
            <span class="right"><a href="/upDateDetails.php"><?php echo "$userName"; ?></a>&nbsp;|&nbsp;<a href="logout.php">Logout</a></span>
        </div>
        
        <div id = "insertReference" class = "centerForm">
            <table>
                <?php foreach ($_POST as $key => $value) {
                     echo "<tr>";
                     echo "<td>";
                     echo $key;
                     echo "</td>";
                     echo "<td>";
                    echo $value;
                    echo "</td>";
                    echo "</tr>";
                }?>
            </table>
        </div>
    </body>
</html>
