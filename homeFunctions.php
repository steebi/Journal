<?php

/* 
 * This is a list of functions that are used in the Home.php page. These are 
 * for all the controls to access the database, perform updates, deletes etc.
 */

require_once "database.php";


/*
 * This function returns all the references in the database owned by the currently logged in user. 
 */
function returnAllReferences($email){
    try{
        $connection = new PDO('mysql:host=isedbserver.cloudapp.net;port=3306;dbname=user5', "user5", "poi456!!");
        $query = $connection->prepare("SELECT a.id, a.author, a.title, a.publishYear, b.displayName, a.url FROM reference a, library b WHERE b.ownerEmail = :email AND b.id = a.libID;");
        $query->bindParam(':email', $email);
        $success = $query->execute();
        $results =  $query->fetchAll();
        return $results;
    }   catch(PDOexception $e){
        echo $e->getMessage();
    }
}

/*
 * This function inserts a new element into the library table, given an email and a name for the library
 */
function newLibrary($email, $displayName){
    try{
        $connection = new PDO('mysql:host=isedbserver.cloudapp.net;port=3306;dbname=user5', "user5", "poi456!!");
        $sql = $connection->prepare("INSERT INTO library (displayName, ownerEmail) VALUES (:displayName, :ownerEmail);");
        $sql->bindParam(":displayName", $displayName);
        $sql->bindParam(":ownerEmail", $email);
        $sql->execute();
    }   catch(PDOexception $e){
        echo $e->getMessage();
    }
}

/*
 * This function returns all of the libraries owned by the user with the email passed to it
 */
function returnLibraries($email){
    try{
        $connection = new PDO('mysql:host=isedbserver.cloudapp.net;port=3306;dbname=user5', "user5", "poi456!!");
        $sql = $connection->prepare("SELECT id, displayName FROM library WHERE ownerEmail = :mail;");
        $sql->bindParam(":mail", $email);
        $sql->execute();
        
        return $sql->fetchAll();
    }   catch(PDOException $e){
        echo $e->getMessage();
    }
}

/*
 *  This function takes in an email and libID and returns an array of elements corresponding to that user with that libraryID 
 */
 
function filterreferenceByLibrary($email, $libID){
    try{
        $connection = new PDO('mysql:host=isedbserver.cloudapp.net;port=3306;dbname=user5', "user5", "poi456!!");
        
        if($libID == 'all'){
            $query = $connection->prepare("SELECT a.id, a.author, a.title, a.publishYear, b.displayName, a.url FROM reference a, library b WHERE b.ownerEmail = :email AND b.id = a.libID;");
            $query->bindParam(":email", $email);
        }else{
            $query = $connection->prepare("SELECT a.author, a.title, a.publishYear, b.displayName, a.url FROM reference a, library b WHERE b.ownerEmail = :email AND b.id = a.libID AND a.libID = :libID;");
            $query->bindParam(":email", $email);
            $query->bindParam(":libID", $libID);
        }
        $success = $query->execute();
        $results =  $query->fetchAll();
        return $results;
    }   catch(PDOException $e){
        $e->getMessage();
    }
}

/*
 * Function to search the libraries. Returns an array of the elements matched by
 * title, author, year and library
 */
function searchLibraries($email, $title, $author, $year, $libID){
    try{
        
        $sqlStatement = "SELECT a.id, a.author, a.title, a.publishYear, b.displayName, a.url FROM reference a, library b WHERE ";
        //first confirm all strings are not empty, if they are callreturnAllreferences
        if(($title == '') && ($author == '') && ($year == '')){
            return returnAllReferences($email);
        }
        //now add the strings that are not left blank
        if(!($title == '')){
            $sqlStatement .= "title LIKE :title";
        }
        if(!($author == '')){
            $sqlStatement .= "author LIKE :author";
        }
        if(!($year == '')){
            $sqlStatement .= "publishYear LIKE :year";
        }
        
        if(!($libID == 'all')){
            $sqlStatement .= " AND libID = :libID";
        }
        
        $sqlStatement .= " AND b.ownerEmail = :email AND b.id = a.libID;";
        $connection = new PDO('mysql:host=isedbserver.cloudapp.net;port=3306;dbname=user5', "user5", "poi456!!");
        $sql = $connection->prepare($sqlStatement);
        if(!($title == '')){
            $title = "%".$title."%";
            $sql->bindParam(":title", $title);
        }
        if(!($author == '')){
            $author = "%".$author."%";
            $sql->bindParam("author", $author);
        }
        if(!($year == '')){
            $year = "%".$year."%";
            $sql->bindParam(":year", $year);
        }
        if(!($libID == 'all')){
            $sql->bindParam(":libID", $libID);
        }
        $sql->bindParam(":email", $email);
        $success = $sql->execute();
        $answer = $sql->fetchAll();
        return $answer;
    }   catch(PDOException $e){
        $e->getMessage();
    }
}


/*
 * This function is to delete a library from the database. First it will move all the references
 * to the trash folder that are stored in the library to be deleted. Once that is done it will then delete the library
 */
function moveSelectedToLibrary($email, $libID, $referenceID){
    try{
        $connection = new PDO('mysql:host=isedbserver.cloudapp.net;port=3306;dbname=user5', "user5", "poi456!!");
        $sql = $connection->prepare("UPDATE reference SET libID = :libID WHERE id = :referenceID;");
        foreach($referenceID as $id){
            $sql->bindParam(":libID", $libID);
            $sql->bindParam(":referenceID", $id);
            $sql->execute();
        }
    } catch(PDOException $e){
        echo $e->getMessage();
    }
}

/*
 * This function returns the libraries that the user is allowed to delete from the database only
 */
function returnDelLib($email){
    try{
        $connection = new PDO('mysql:host=isedbserver.cloudapp.net;port=3306;dbname=user5', "user5", "poi456!!");
        $sql = $connection->prepare("SELECT id, displayName FROM library WHERE ownerEmail = :mail AND displayName != 'trash' AND displayName != 'unfiled';");
        $sql->bindParam(":mail", $email);
        $sql->execute();
        
        return $sql->fetchAll();
    }   catch(PDOException $e){
        echo $e->getMessage();
    }
}
/*
 * This deletes a library from the data base
 * Should first move all the libraries in it to trash and then delete the library
 */
function deleteLibrary($email, $libID){
    try{
        $connection = new PDO('mysql:host=isedbserver.cloudapp.net;port=3306;dbname=user5', "user5", "poi456!!");
        //first get this users trash id
        $trashID = $connection->prepare("SELECT id FROM library WHERE ownerEmail = :email AND displayName = 'trash';" );
        $trashID->bindParam(":email", $email);
        $trashID->execute();
        $trash = $trashID->fetch();
        //print_r($trash);
        
        //use trash id to move all the references with th library ID to b deleted to trash
        $moveOldReferences = $connection->prepare("UPDATE reference SET libID = :trash WHERE libID = :deleteLib");
        $moveOldReferences->bindParam(":trash", $trash[0]);
        $moveOldReferences->bindParam(":deleteLib", $libID);
        $moveOldReferences->execute();
        
        //finlly delete the library itself after the updates have been made
        $delete = $connection->prepare("DELETE FROM library WHERE id = :libID;");
        $moveOldReferences->bindParam(":id", $libID);
        $delete->execute();
    }   catch(PDOException $e){
        echo $e->getMessage();
    }
}

/*
 * This function empties the trash folder. This will permanently delete all the entries in the trash folder!
 */
function emptyTrash($email){
    try{
        $connection = new PDO('mysql:host=isedbserver.cloudapp.net;port=3306;dbname=user5', "user5", "poi456!!");
        //first get the id of the trash folder
        $trashID = $connection->prepare("SELECT id FROM library WHERE ownerEmail = :email AND displayName = 'trash';" );
        $trashID->bindParam(":email", $email);
        $trashID->execute();
        $trash = $trashID->fetch();
        //print_r($trash);
        //now delete all the references with that libID
        $delete = $connection->prepare("DELETE FROM reference WHERE libID = :trashID");
        $delete->bindParam(":trashID", $trash[0]);
        $delete->execute();
    }   catch(PDOException $e){
        $e->getMessage();
    }
}

/*
 * Loads a specfic reference and returns as an array
 */
function returnReference($email, $refID){
    try{
        $connection = new PDO('mysql:host=isedbserver.cloudapp.net;port=3306;dbname=user5', "user5", "poi456!!");
        //$query = $connection->prepare("SELECT * FROM reference WHERE id = :refID;");
        $query = $connection->prepare("SELECT a.title, a.id, a.author, a.publishYear, a.publishMonth, a.abstract, a.address, a.annote, a.bookTitle, a.chapter, a.crossReference, a.edition, a.eprint, a.institution, a.journal, a.bibtexKey, a.NOTE, a.issueNumber, a.organisation, a.pages, a.Publisher, a.school, a.series, a.publishType, a.volume, a.dataAdded, a.libID, a.url, c.displayName, c.ownerEmail FROM reference a, library c WHERE a.id = :refID AND c.id = a.libID;");
        $query->bindParam(":refID", $refID);
        $success = $query->execute();
        $results =  $query->fetchAll();
        //print_r($results);
        return $results;
    }   catch(PDOexception $e){
        echo $e->getMessage();
    }
}


function renameLibrary($refID, $name){
    try{
        $connection = new PDO('mysql:host=isedbserver.cloudapp.net;port=3306;dbname=user5', "user5", "poi456!!");
        $query = $connection->prepare("UPDATE library SET displayName = :name WHERE id = :id;");
        $query->bindParam(":name", $name);
        $query->bindParam(":id", $refID);
        $success = $query->execute();
    }   catch(PDOexception $e){
        echo $e->getMessage();
    }
}

/*
 * Share a library with another user.
 */
function shareLibrary($libID, $shareMail, $userMail){
    try{
        $connection = new PDO('mysql:host=isedbserver.cloudapp.net;port=3306;dbname=user5', "user5", "poi456!!");
        
        //first check that the user exists and also that the entry doesn't exist already
        //the following sql statement returns the controls neccessary for this
        $userExist = $connection->prepare("SELECT email, reg_code FROM user WHERE email = :email;");
        $userExist->bindParam(":email", $shareMail);
        $userExist->execute();
        $usersPresent = $userExist->fetchAll();
        $usersFound = count($usersPresent);
        
        //the following connection is to ensure the share does not already exist in the system
        $uniqueEntry = $connection->prepare("SELECT * FROM shareLib WHERE libID = :libID AND sharedUser = :shareMail");
        $uniqueEntry->bindParam(":libID", $libID);
        $uniqueEntry->bindParam(":shareMail", $shareMail);
        $uniqueEntry->execute();
        $entriesFound = $uniqueEntry->fetchAll();
        $sameEntriesFound = count($entriesFound);
        
        //if there is no user then set an error
        if($usersFound === 0){
            //if no such user exists return an error
            $_SESSION['error']['shareLib'] = "This is not a registered user!";
        }     
        else if($usersPresent[0][0] == $userMail ){
            //if user is the person logged in return an error
            $_SESSION['error']['shareLib'] = "You cannot share with yourself!";
        }
        else if($usersPresent[0][1] != NULL){
            //if the user being shared with is not registered
            $_SESSION['error']['shareLib'] = "This user has not confirmed their account!";
        }
        else if($sameEntriesFound != 0){
            $_SESSION['error']['shareLib'] = "This library has already been shared with this user!";
        }
        else{
            //check that the user owns the library
            $checkUser = $connection->prepare("SELECT ownerEmail FROM library WHERE id=:id");
            $checkUser->bindParam(":id", $libID);
            $checkUser->execute();
            $result = $checkUser->fetch();
            if($result[0] == $userMail){
                $query = $connection->prepare("INSERT INTO shareLib (libID, sharedUser) VALUES (:libID, :shareMail);");
                $query->bindParam(":libID", $libID);
                $query->bindParam(":shareMail", $shareMail);
                $query->execute();
                }   else{
                    $_SESSION['error']['shareLib'] = "You cannot share other people's libraries!";
                }
        }
    }   catch (PDOException $e){
        echo $e->getMessage();
    }
}
/*
 * This function returns all the users that a library is shared with!
 */
function returnSharedUsers($email, $libID){
    try{
        $connection = new PDO('mysql:host=isedbserver.cloudapp.net;port=3306;dbname=user5', "user5", "poi456!!");
        $query = $connection->prepare("SELECT * FROM shareLib WHERE libID = :libID;");
        $query->bindParam(":libID", $libID);
        $query->execute();
        $answers = $query->fetchAll();
        return $answers;
    }   catch(PDOexception $e){
        echo $e->getMessage();
    }
}

/*
 * This deletes a shared user from the shared user table
 */
function removeSharedUser($id){
    try{
        $connection = new PDO('mysql:host=isedbserver.cloudapp.net;port=3306;dbname=user5', "user5", "poi456!!");
        $query = $connection->prepare("DELETE FROM shareLib WHERE id = :id;");
        $query->bindParam(":id", $id);
        $query->execute();
    }   catch(PDOexception $e){
        echo $e->getMessage();
    }
}

/*
 * Returns all the that have been shared with the user email passed to it
 */
function returnSharedLibraries($email){
    try{
        $connection = new PDO('mysql:host=isedbserver.cloudapp.net;port=3306;dbname=user5', "user5", "poi456!!");
        $query = $connection->prepare("SELECT a.title, a.id, a.author, a.publishYear, a.publishMonth, a.abstract, a.address, a.annote, a.bookTitle, a.chapter, a.crossReference, a.edition, a.eprint, a.institution, a.journal, a.bibtexKey, a.NOTE, a.issueNumber, a.organisation, a.pages, a.Publisher, a.school, a.series, a.publishType, a.volume, a.dataAdded, a.libID, a.url, c.displayName, c.ownerEmail FROM reference a, shareLib b, library c WHERE a.libID = b.libID AND b.libID = c.id AND b.sharedUser = :email;");
        $query->bindParam(":email", $email);
        $query->execute();
        return $query->fetchAll();
    }   catch(PDOexception $e){
        echo $e->getMessage();
    }
}

/*
 * This search function will only return elements from shared libraries to the output
*/
function searchSharedLibraries($email, $title, $author, $year, $libID){
    try{
        
        $sqlStatement = "SELECT b.ownerEmail, a.id, a.author, a.title, a.publishYear, b.displayName, a.url FROM reference a, library b, shareLib c WHERE ";
        //first confirm all strings are not empty, if they are callreturnAllreferences
        if(($title == '') && ($author == '') && ($year == '')){
            return returnAllReferences($email);
        }
        //now add the strings that are not left blank
        if(!($title == '')){
            $sqlStatement .= "a.title LIKE :title";
        }
        if(!($author == '')){
            $sqlStatement .= "a.author LIKE :author";
        }
        if(!($year == '')){
            $sqlStatement .= "a.publishYear LIKE :year";
        }
        
        if(!($libID == 'all')){
            $sqlStatement .= " AND a.libID = :libID";
        }
        
        $sqlStatement .= " AND b.id = a.libID AND c.sharedUser = :shareEmail AND c.libID = a.libID;";
        $connection = new PDO('mysql:host=isedbserver.cloudapp.net;port=3306;dbname=user5', "user5", "poi456!!");
        $sql = $connection->prepare($sqlStatement);
        if(!($title == '')){
            $title = "%".$title."%";
            $sql->bindParam(":title", $title);
        }
        if(!($author == '')){
            $author = "%".$author."%";
            $sql->bindParam("author", $author);
        }
        if(!($year == '')){
            $year = "%".$year."%";
            $sql->bindParam(":year", $year);
        }
        if(!($libID == 'all')){
            $sql->bindParam(":libID", $libID);
        }
        $sql->bindParam(":shareEmail", $email);
        $success = $sql->execute();
        $answer = $sql->fetchAll();
        return $answer;
    }   catch(PDOException $e){
        $e->getMessage();
    }
}