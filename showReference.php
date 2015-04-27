<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="registerStyles.css?relaod">
        <title>BibTex</title>
    </head>
    <body>
        <?php
            //firt confirm user is logged in, if not kick to login screen
            session_start();
            require_once 'database.php';
            require_once 'homeFunctions.php';
            if($_SESSION['user_email'] == ''){
                header("Location: index.php");
                exit;
            }
            $userName = $_SESSION['user_name'];
            $mail = $_SESSION['user_email'];
            
            $reference = returnReference($mail, 22);
            
            
            //take input from get and load the correct page for that
            require_once 'homeFunctions.php';
            
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
                        *Title:
                    </label></br>
                    <input name = 'title' type='text' id='username' class='inputFullWidth' value=<?php $var = $reference[0]['title']; echo "$var"; ?>/>
                    
                </p>
                <p>
                    <label for='author'>
                        *Author:
                    </label></br>
                    <input name = 'author' type='text' id='author' class='inputFullWidth' value=<?php $var = $reference[0]['author']; echo "$var"; ?>/>
                </p>
                <p>
                    <label for='publishDate'>
                        *Month:
                        <select name='publishMonth'>
                            <option value= ""> --- </option>
                            <option value = "1"<?php if($reference[0]['title']== 1); echo "selected=\"selected\""; ?>>January</option>
                            <option value = "2"<?php if($reference[0]['title']== 2); echo "selected=\"selected\""; ?>>February</option>
                            <option value = "3"<?php if($reference[0]['title']== 3); echo "selected=\"selected\""; ?>>March</option>
                            <option value = "4"<?php if($reference[0]['title']== 4); echo "selected=\"selected\""; ?>>April</option>
                            <option value = "5"<?php if($reference[0]['title']== 5); echo "selected=\"selected\""; ?>>May</option>
                            <option value = "6"<?php if($reference[0]['title']== 6); echo "selected=\"selected\""; ?>>June</option>
                            <option value = "7"<?php if($reference[0]['title']== 7); echo "selected=\"selected\""; ?>>July</option>
                            <option value = "8"<?php if($reference[0]['title']== 8); echo "selected=\"selected\""; ?>>August</option>
                            <option value = "9"<?php if($reference[0]['title']== 9); echo "selected=\"selected\""; ?>>September</option>
                            <option value = "10"<?php if($reference[0]['title']== 10); echo "selected=\"selected\""; ?>>October</option>
                            <option value = "11"<?php if($reference[0]['title']== 11); echo "selected=\"selected\""; ?>>November</option>
                            <option value = "12"<?php if($reference[0]['title']== 12); echo "selected=\"selected\""; ?>>December</option>
                        </select>
                        *Year:
                        <input name='publishYear' type='text' id='publishYear'value=<?php $var = $reference[0]['publishYear']; echo "$var"; ?>>
                    </label></br>
                </p>
                
                <hr>
                <!--Mandatory fields are above this line. The rest are optional fields-->
                <p>
                    <label for='url'>
                        url:
                    </label></br>
                    <input name = 'url' type='text' id='url' class='inputFullWidth' value=<?php $var = $reference[0]['url']; echo "$var"; ?>/>
                </p>
                <p>
                    <label for='abstract'>
                        Abstract:
                    </label></br>
                    <textarea name = 'abstract' rows='5' type='text' id='abstract' class='inputFullWidth' value=<?php $var = $reference[0]['abstract']; echo "$var"; ?>></textarea>
                </p>
                <p>
                    <label for='address'>
                        Address:
                    </label></br>
                    <textarea name = 'address' rows='5' type='text' id='address' class='inputFullWidth' ></textarea>
                </p>
                <p>
                    <label for='annote'>
                        Annote:
                    </label></br>
                    <textarea name = 'annote' rows='5' type='text' id='annote' class='inputFullWidth' ></textarea>
                </p>
                <p>
                    <label for='bookTitle'>
                        Book title:
                    </label></br>
                    <input name = 'bookTitle' type='text' id='bookTitle' class='inputFullWidth' />
                </p>
                <p>
                    <label for='chapter'>
                        Chapter:
                    </label></br>
                    <input name = 'chapter' type='text' id='chapter' class='inputFullWidth' />
                </p>
                <p>
                    <label for='crossReference'>
                        Cross reference:
                    </label></br>
                    <input name = 'crossReference' type='text' id='crossReference' class='inputFullWidth' />
                </p>
                <p>
                    <label for='edition'>
                        Edition:
                    </label></br>
                    <input name = 'edition' type='text' id='edition' class='inputFullWidth' />
                </p>
                <p>
                    <label for='eprint'>
                        E print:
                    </label></br>
                    <input name = 'eprint' type='text' id='eprint' class='inputFullWidth' />
                </p>
                <p>
                    <label for='institution'>
                        Institution:
                    </label></br>
                    <input name = 'institution' type='text' id='institution' class='inputFullWidth' />
                </p>
                <p>
                    <label for='journal'>
                        Journal:
                    </label></br>
                    <input name = 'journal' type='text' id='journal' class='inputFullWidth' />
                </p>
                <p>
                    <label for='bibtexKey'>
                        Bibtex key:
                    </label></br>
                    <input name = 'bibtexKey' type='text' id='bibtexKey' class='inputFullWidth' />
                </p>
                <p>
                    <label for='NOTE'>
                        Notes:
                    </label></br>
                    <textarea name = 'NOTE' rows='5' type='text' id='NOTE' class='inputFullWidth' ></textarea>
                </p>
                <p>
                    <label for='issueNumber'>
                        Issue number:
                    </label></br>
                    <input name = 'issueNumber' type='text' id='issueNumber' class='inputFullWidth' />
                </p>
                <p>
                    <label for='organisation'>
                        Organisation:
                    </label></br>
                    <input name = 'organisation' type='text' id='organisation' class='inputFullWidth' />
                </p>
                <p>
                    <label for='Publisher'>
                        Publisher:
                    </label></br>
                    <input name = 'Publisher' type='text' id='Publisher' class='inputFullWidth' />
                </p>
                <p>
                    <label for='school'>
                        School:
                    </label></br>
                    <input name = 'school' type='text' id='school' class='inputFullWidth' />
                </p>
                <p>
                    <label for='series'>
                        Series:
                    </label></br>
                    <input name = 'series' type='text' id='series' class='inputFullWidth' />
                </p>
                <p>
                    <label for='publishType'>
                        Publish type:
                    </label></br>
                    <input name = 'publishType' type='text' id='publishType' class='inputFullWidth' />
                </p>
                <p>
                    <label for='volume'>
                        Volume:
                    </label></br>
                    <input name = 'volume' type='text' id='volume' class='inputFullWidth' />
                </p>
                
                
                <div class="errors">
                    <?php
                        //If an error was passed in session print the error message recorded
                        if(isset($_SESSION['error'])){
                            if(isset($_SESSION['error']['title'])){
                                echo '<p>'.$_SESSION['error']['title'].'</p>';
                            }
                            if(isset($_SESSION['error']['author'])){
                                echo '<p>'.$_SESSION['error']['author'].'</p>';
                            }
                            if(isset($_SESSION['error']['year'])){
                            echo '<p>'.$_SESSION['error']['year'].'</p>';
                            }
                            if(isset($_SESSION['error']['database'])){
                            echo '<p>'.$_SESSION['error']['database'].'</p>';
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