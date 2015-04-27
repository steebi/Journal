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
            //if newLibrary was entered check its not empty and then create a library with that name
            case 'Create Library':
                $displayName = $_GET['libraryName'];
                if($displayName != ''){
                    newLibrary($mail, $displayName);
                    header("Location: home.php");
                }   else{
                    //redirect ro home without creating library
                    header("Location: home.php");
                }
                break;
            case 'Change Library':
                $references = filterreferenceByLibrary($mail, $_GET['libID']);
                break;
            case 'Search Libraries':
                $references = searchLibraries($mail, $_GET['searchTitle'], $_GET['searchAuthor'], $_GET['searchYear']);
                break;
            case 'Move To':
                moveSelectedToLibrary($mail, $_GET['libID'], $_GET['referenceID']);
                header("Location: home.php");
                break;
            }
        
        
        
    }   else{
        $references = returnAllReferences($mail);
    }
    
    //This function is to populate the list of all libraries for the sidebar
    $libraries = returnLibraries($mail);
    
    //print_r($references);
    
    $template = new Smarty();

    //this assigns variables to the template dynamically. So the templates are brought in in the Smarty object and these 3 statements replace variables in the template with these values 
    $template->assign("user_email", $mail);
    $template->assign("user_name", $userName);
    $template->assign("libraries", $libraries);
    $template->assign("references", $references);
    $template->display('home.tpl');
?>
