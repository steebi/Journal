<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
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

function searchLibraries($email, $title, $author, $year){
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
        print_r($trash);
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
    echo "entering function";
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



