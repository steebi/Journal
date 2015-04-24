<?php
//Log out function unsets the session variable and returns user to login page
 session_start();
 unset($_SESSION['user_email']);
 header('Location: index.php');
?>