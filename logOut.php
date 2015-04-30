<?php
//Log out function unsets the session variables and returns user to login page
//With the variables unset the user will not be able to access websites home.php
 session_start();
 unset($_SESSION['user_email']);
 header('Location: index.php');
?>