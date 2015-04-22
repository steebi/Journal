<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$connection = new PDO('mysql:host=localhost;dbname=BibMan', "root", "");

/*
function retrieveName(){
    try{
        $conn = new PDO('mysql:host=localhost;dbname=bibliographyman', "root", "");
        $query = $conn->prepare("SELECT * FROM user");
        $query->execute();
        return $query->fetchAll();
    } catch(PDOException $e){
        echo $e->getMessage();
    }    
}*/

?>