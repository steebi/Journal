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
    
    //there is something in GET then process it, otherwise populate the page with all references
    if(isset($_GET['action'])){
        
        switch($_GET['action']){
            //if newLibrary was entered check its not empty and then create a library with that name
            case 'Create Library':
                $displayName = $_GET['libraryName'];
                if($displayName != ''){
                    newLibrary($mail, $displayName);
                    header("Location: home.php");
                }   else{
                    //redirect ro home without creating a library
                    header("Location: home.php");
                }
                break;
            //this changes the references to only be those filtered by the selected library
            case 'Change Library':
                $references = filterreferenceByLibrary($mail, $_GET['libID']);
                break;
            //this returns a list of libraries that conform to the values passed in the search boxes
            case 'Search Libraries':
                $references = searchLibraries($mail, $_GET['searchTitle'], $_GET['searchAuthor'], $_GET['searchYear'], $_GET['libID']);
                break;
            //This moves a reference that was selected to a particular library
            case 'Move To':
                moveSelectedToLibrary($mail, $_GET['libID'], $_GET['referenceID']);
                header("Location: home.php");
                break;
            //This removes a library entry in the library database
            case 'Delete Library':
                deleteLibrary($mail, $_GET['libID']);
                header("Location: home.php");
                break;
            //This deletes all the references that are stored in the thrash library in the database
            case 'Empty Trash':
                emptyTrash($mail);
                header("Location: home.php");
                break;
            //this functions renames a library with the value passed to it
            case 'Rename Library':
                renameLibrary($_GET['libID'], $_GET['renameLib']);
                header("Location: home.php");
                break;
            //this shares a selected library with a user passed to it. It redirects 
            //to an error page if a user does not exist in the user database
            case 'Share Library':
                shareLibrary($_GET['libID'], $_GET['shareEmail'], $mail);
                if(isset($_SESSION['error'])){
                    header("Location: error.php");
                }   else{
                    header("Location: home.php");
                }
                break;
            //this removes an entry in the sharedLib table. It also populates reference with the library present in $_GET
            case 'Remove SharedUser':
                removeSharedUser($_GET['selectSharedUser']);
                $references = filterreferenceByLibrary($mail, $_GET['libID']);
                break;
        }
        
        
    }   else{
        $references = returnAllReferences($mail);
    }
    
    //This function is to populate the list of all libraries for the sidebar
    $libraries = returnLibraries($mail);
    //this returns the list of libraries the user is allowed to delete from the table
    $delLib = returnDelLib($mail);
    //if the LibID varible is in $_GET then set the list of shared users, if empty then don't put in any shared users
    if(isset($_GET['libID'])){
        $sharedUsers = returnSharedUsers($mail, $_GET['libID']);
    }   else{
        $sharedUsers = NULL;
    }
    //if the user has selected a library then we will populate the shared user select box
    
    $template = new Smarty();

    //this assigns variables to the template dynamically. So the templates are brought in in the Smarty object and these 3 statements replace variables in the template with these values 
    $template->assign("user_email", $mail);
    $template->assign("user_name", $userName);
    $template->assign("sharedUsers", $sharedUsers);
    $template->assign("libraries", $libraries);
    $template->assign("deleteableLibraries", $delLib);
    $template->assign("references", $references);
    $template->display('home.tpl');
?>
