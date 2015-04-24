<?php
    session_start();
    //if user has not logged in yet then redirect to login page
    if($_SESSION['user_email'] == ''){
        header("Location: index.php");
        exit;
    }
    $mail = $_SESSION['user_email'];
    $userName = $_SESSION['user_name'];

    require_once "lib/Smarty.class.php";

    $template = new Smarty();

    //this assigns variables to the template dynamically. So the templates are brought in in the Smarty object and these 3 statements replace variables in the template with these values 
    $template->assign("user_email", $mail);
    $template->assign("user_name", $userName);
    $template->display('home.tpl');
?>
