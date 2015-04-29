<?php
    session_start();
    //if user has not logged in yet then redirect to login page
    if($_SESSION['user_email'] == ''){
        header("Location: index.php");
        exit;
    }
    //load session variables since they are present
    $mail = $_SESSION['user_email'];
    $userName = $_SESSION['user_name'];
    //this references must be set to populate the list of references on the page
    $references;
    //imports smarty classes
    require_once "lib/Smarty.class.php";
    require_once "homeFunctions.php";
    
    //there is something in GET then process it, otherwise populate the page all references
    if(isset($_GET['action'])){
        switch($_GET['action']){
            case 'Search Libraries':
                /*ADD THE FUNCTION HERE AND THE REDIRECT OR WHATEVER!!!*/
        }
    }   else{
        
    }
    
    $references = returnSharedLibraries($mail);
    //if the user has selected a library then we will populate the shared user select box
    
    $template = new Smarty();

    //this assigns variables to the template dynamically. So the templates are brought in in the Smarty object and these 3 statements replace variables in the template with these values 
    $template->assign("user_email", $mail);
    $template->assign("user_name", $userName);
    $template->assign("references", $references);
    $template->display('homeShare.tpl');
?>
