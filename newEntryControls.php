<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="registerStyles.css?relaod">
        <title>BibTex</title>
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
            $elementsBindVar = "";
            
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
            if(filter_input(INPUT_POST, 'url') !=''){
                if(filter_input(INPUT_POST, 'url', FILTER_VALIDATE_URL)===FALSE){
                    $_SESSION['error']['url'] = "This is not a valid url!";
                    $inputError = TRUE;
                }
            }
            //all these data fields are the important ones, if they are valid then we 
            //can insert them into the database otherwise return an error to the user
            //and redirect them to the previous page
            
            if($inputError){
                header("Location: newEntry.php");
                exit;
            }
            
            
            //if there was no error then insert into the database
            foreach($_POST as $key => $value){
                if($key === "submit"){
                    break;
                }
                $elements .=" $key,";
                $elementsBindVar .= " :$key,";
            }
            $elements = rtrim($elements, ",");
            $elementsBindVar = rtrim($elementsBindVar, ",");
            
            //now the values are stored in the strings we prepare the connection
            //and bind the parameters
            try{
                $insertString = "INSERT INTO reference (".$elements.") VALUES (".$elementsBindVar.");";
                $insertReference = $connection->prepare($insertString);
                //this cycles through the data in post it takes the keys and values 
                //from the array passed by post and binds each parameter according 
                //to the key passed and then the value used.
                foreach($_POST as $key => $value){
                    if($key === "submit"){
                        break;
                    }
                    $currentKey = ":$key";
                    $insertReference->bindParam($currentKey, $_POST[$key]);
                }
                
                
                $insertSuccess = $insertReference->execute();
            }   catch (PDOException $e) {
                echo $e->getMessage();
            }
            
            if($insertSuccess){
            }else{
                $_SESSION['error']['database'] = "There was an error inserting this into the database!";
            }

        ?>
        
        <div id="header" >
            <span><a href="home.php">Home</a></span>&nbsp;|&nbsp;<span><a href="newEntry.php">New Entry</a></span>
            <span class="right"><a href="/upDateDetails.php"><?php echo "$userName"; ?></a>&nbsp;|&nbsp;<a href="logout.php">Logout</a></span>
        </div>
        
        <div id = "insertReference" class = "centerForm">
            <h1>Entry successfully saved!</h1>
            <p>Your entry has been successfully entered into your library.</p>
            <p><a href = "home.php">Return home!</a></p>
        </div>
    </body>
</html>
