<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="registerStyles.css?relaod">
        <title>BibTex</title>
    </head>
    <body>
        <?php
        //start the session variable. If there is no email stored kick user to login page
        //otherwise store the userName and mail in the sessions
            session_start();
            require_once 'database.php';
            if($_SESSION['user_email'] == ''){
                header("Location: index.php");
                exit;
            }
            $userName = $_SESSION['user_name'];
            $mail = $_SESSION['user_email'];
        ?>
        
        <div id="header" >
            <span><a href="home.php">Home</a></span>&nbsp;|&nbsp;<span><a href="newEntry.php">New Entry</a></span>
            <span class="right"><a href="/upDateDetails.php"><?php echo "$userName"; ?></a>&nbsp;|&nbsp;<a href="logout.php">Logout</a></span>
        </div>
        
        <div id = "insertReference" class = "newReferenceForm">
            <h1>New Reference</h1>
            <form action="newEntryControls.php" method='post'>
                <p>
                    <label for='title'>
                        Title:
                    </label></br>
                    <input name = 'title' type='text' id='username' class='inputFullWidth' />
                    
                </p>
                <p>
                    <label for='author'>
                        Author:
                    </label></br>
                    <input name = 'author' type='text' id='author' class='inputFullWidth' />
                </p>
                <p>
                    <label for='Library'>
                        Select Library to store reference in:  &nbsp;
                        <select name='library'>
                            
                            <?php
                                //First get the unfiled elements
                                $retrieveUnfiled = $connection->prepare("SELECT id FROM library WHERE ownerEmail = :mail AND displayName = 'unfiled';");
                                $retrieveUnfiled->bindParam(":mail", $mail);
                                $retrieveUnfiled->execute();
                                $unfiledValue = $retrieveUnfiled->fetch();
                                $unfiledID = $unfiledValue[0];
                                //print_r($unfiledValue);
                                //echo "</br></br>";
                                //populate the list of libraries that are stored in the database at that time
                                $listLibraries = $connection->prepare("SELECT id, displayName FROM library WHERE ownerEmail = :mail AND NOT(displayName = 'trash') AND NOT(displayName = 'unfiled');");
                                $listLibraries->bindParam(":mail", $mail);
                                $listLibraries->execute();
                                //store the results in an 2-d array. The first index is the element number
                                //second index is 0 for libraryid and 1 for the library name
                                //Thrash is excluded from this query as there is no point putting a new file directly into thrash
                                //The first element should be the unFiled option, so a seperate queries inserts this into the options list
                                $libraryist = $listLibraries->fetchAll();
                                //print_r($libraryist);
                                $value = $libraryist[0]['id'];
                                //echo "$value";

                                echo "<option value = \"$unfiledID\">un-filed</option>";
                                foreach($libraryist as $row){
                                    $id = $row[0];
                                    $name = $row[1];
                                    echo "<option value = \"$id\">$name</option>";
                                }
                                
                            ?>
                        </select>
                    </label>
                </p>
                <p>
                    <label for='url'>
                        url:
                    </label></br>
                    <input name = 'url' type='text' id='url' class='inputFullWidth' />
                </p>
                <p>
                    <label for='libID'>
                        Library:
                    </label></br>
                    <input name = 'libID' type='text' id='libID' class='inputFullWidth' />
                </p>
                <p>
                    <label for='publishDate'>
                        Month:
                        <select name='month'>
                            <option value= ""> --- </option>
                            <option value = "01">January</option>
                            <option value = "01">February</option>
                            <option value = "01">March</option>
                            <option value = "01">April</option>
                            <option value = "01">May</option>
                            <option value = "01">June</option>
                            <option value = "01">July</option>
                            <option value = "01">August</option>
                            <option value = "01">September</option>
                            <option value = "01">October</option>
                            <option value = "01">November</option>
                            <option value = "01">December</option>
                        </select>
                        Year:
                        <input name='publishYear' type='text' id='publishYear' size='10'>
                    </label></br>
                </p>
                <div class="errors">
                    <?php
                        //If an error was passed in session print the error message recorded
                        if(isset($_SESSION['error'])){
                            if(isset($_SESSION['error']['title'])){
                                echo '<p>'.$_SESSION['error']['username'].'</p>';
                            }
                            if(isset($_SESSION['error']['author'])){
                                echo '<p>'.$_SESSION['error']['email'].'</p>';
                            }
                            if(isset($_SESSION['error']['library'])){
                            echo '<p>'.$_SESSION['error']['password1'].'</p>';
                            }

                            //unset the error session variable
                            unset($_SESSION['error']);
                        }
                    ?>
                </div>
                
                <p class='submitButton'>
                    <input class="submit" name='submit' type='submit' value='Submit'/>
                </p>
                
        </div>
    </body>
</html>
