<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
            session_start();
            require_once 'database.php';
            if($_SESSION['user_email'] == ''){
                header("Location: index.php");
                exit;
            }
            $userName = $_SESSION['user_name'];
            $mail = $_SESSION['user_email'];
            
            //two string variables, one stores the names of the elements to insert
            //The other contains the values of these elements to insert
            $elements = "";
            
            $inputError = FALSE;
            
            //first validate that the essential fields have been filled in. These are
            //title, author, year and library.
            if(filter_input(INPUT_POST, 'title') == ''){
                $_SESSION['error']['title'] = "Title cannot be left blank!";
                $inputError = TRUE;
            }
            if(filter_input(INPUT_POST, 'author') == ''){
                $_SESSION['error']['author'] = "Author cannot be left blank!";
                $inputError = TRUE;
            }
            if(filter_input(INPUT_POST, 'publishYear') == ''){
                $_SESSION['error']['year'] = "Year cannot be left blank!";
                $inputError = TRUE;
            }
            if(!preg_match("/^[0-9]{4}$/", filter_input(INPUT_POST, 'publishYear'))){
                $_SESSION['error']['year'] = "Year must be a 4 digit number year!";
                $inputError = TRUE;
            }
            
            //all these dates are the important ones, if they are valid then we 
            //can inser them into the database otherwise return an error to the user
            
            if($inputError){
                $refID = $_GET['refID'];
                header("Location: showReference.php?libID=$refID");
                exit;
            }
            
           
            //if there was no error then insert into the database
            foreach($_POST as $key => $value){
                if($key === "submit"){
                    break;
                }
                $elements .=" $key = :$key,";
            }
            $elements = rtrim($elements, ",");
            
            //now the values are stored in the strings we prepare the connection
            //and bind the parameters
            try{
                $insertString = "UPDATE reference SET ".$elements." WHERE id = :id;";
                //echo "$insertString";
                $updateReference = $connection->prepare($insertString);
                //this cycles through the data in post it takes the keys and values 
                //from the array passed by post and binds each parameter according 
                //to the key passed and then the value used.
                foreach($_POST as $key => $value){
                    if($key === "submit"){
                        break;
                    }
                    $currentKey = ":$key";
                    $updateReference->bindParam($currentKey, $_POST[$key]);
                }
                $updateReference->bindParam(":id", $_GET['refID']);
                
                
                $insertSuccess = $updateReference->execute();
            }   catch (PDOException $e) {
                echo $e->getMessage();
            }
            
            if($insertSuccess){
                header("Location: home.php");
            }else{
                $_SESSION['error']['database'] = "There was an error inserting this into the database!";
            }
            
        ?>
    </body>
</html>
