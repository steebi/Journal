{include file="header.tpl" title="BibTex"}

<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="registerStyles.css">
        <title>BibTex</title>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script src="lib/joequery-Stupid-Table-Plugin-5cb0c4d/stupidtable.js?dev"></script>
        <script language="JavaScript">
            /*
             * This function is to select all the checkboxes on the page marked with the class
             * and selects them
             */
            $(document).ready(function(){
                $('.selectAll').click(function(event){
                    if(this.checked){
                        $('.referencesCheckBoxes').each(function(){
                            this.checked = true;
                        });
                    }   else{
                        $('.referencesCheckBoxes').each(function(){
                            this.checked = false;
                        });
                    }
                });
            });
            
            $("#simpleTable").stupidtable();
        </script>
    </head>
    <body>
        <div id="header" >
            <span><a href="home.php">Home</a></span>&nbsp;|&nbsp;<span><a href="newEntry.php">New Entry</a></span>
            <span class="right"><a href="upDateDetails.php">{$user_name}</a>&nbsp;|&nbsp;<a href="logout.php">Logout</a></span>
        </div>
       
        <div class = "container">
        
            <div id="sideBar">
                <div class="controlsList">
                    <form action='home.php'method='get'>
                        <p>
                            <label for='newLibrary'>New Library: <input teype='text' name='libraryName' id='newLibrary'></label></br>
                        </p>
                        <p>    
                            <input type='submit' class='submit right' name='action' value='Create Library' />
                        </p>

                    </form>
                </div>
                
                </br>
                </br>
                <hr>
                
                <div class="controlsList">
                    <form action="home.php" method="get">
                        <label for='changeLibrary'>Change Library:
                            <select name='libID'>
                                <option value="all" selected="selected">All libraries</option>
                                {foreach from=$libraries item=row}
                                    <option value="{$row.0}">{$row.1}</option>
                                {/foreach}
                            </select>
                        </label>
                        </br>
                        </br>
                        <input type='submit' class='submit right' name='action' value='Change Library'>
                    </form>
                </div>
                </br>
                <hr>
                
                <div class="controlsList">
                    <form action='home.php'method='get'>
                        <p>
                            <label for='search'>Search Libraries:</label></br>
                            <p>Author name</p><input type='text' name='searchAuthor' id='search'>
                            <p>Title</p><input type='text' name='searchTitle' id='search'>
                            <p>Year</p><input type='text' name='searchYear' id='search'>
                        </p>
                        <p>    
                            <input type='submit' class='submit right' name='action' value='Search Libraries' />
                        </p>
                    </form>
                    </br>
                    </br>
                    <hr>
                </div>
                
                <div class="controlsList">
                    <form action="home.php" method="get">
                        <label for='changeLibrary'>Delete Library:
                            <select name='libID'>
                                {foreach from=$deleteableLibraries item=row}
                                    <option value="{$row.0}">{$row.1}</option>
                                {/foreach}
                            </select>
                        </label>
                        </br>
                        </br>
                        <input type='submit' class='submit right' name='action' value='Delete Library'>
                    </form>
                    </br>
                    </br>
                    <hr>
                </div>
                
                <div class="controlsList">
                    <form action="home.php" method="get">
                        <label for='renameLibrary'>Rename Library:
                            <select name='libID'>
                                {foreach from=$deleteableLibraries item=row}
                                    <option value="{$row.0}">{$row.1}</option>
                                {/foreach}
                            </select>
                            </br>
                            </br>
                            <input type='text' name='renameLib' class='left'>
                        </label>
                        </br>
                        </br>
                        <input type='submit' class='submit right' name='action' value='Rename Library'>
                    </form>
                    </br>
                    </br>
                    <hr>
                </div>
            </div>
            
            
            <div id="mainContent">
                
                <form action='home.php' method="get" class="left">
                    <input type="submit" class="submit" name="action" value="Empty Trash">
                </form>
                
                
                <form action="home.php" method="get">
                        <div id='dropdownCenter'><select name='libID' class="right">
                            {foreach from=$libraries item=row}
                                <option value="{$row.0}"{if $row.1 eq 'unfiled'}selected='selected'{/if}>{$row.1}</option>
                            {/foreach}
                        </select></div>
                    <input type='submit' class='right submit' name='action' value='Move To'>
                    <table>
                        <thead>
                        <tr class='tableHeader'>
                            <th>All</th>
                            <th>Author</th>
                            <th>Title</th>
                            <th>year</th>
                            <th>library</th>
                            <th>url</th>
                        </tr>
                        <tr class='tableHeader'>
                            <th><input type='checkbox' class='selectAll left' name='selectAll' onChange='selectALL(this)'></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        {foreach from=$references item=reference}
                            <tr class='hover'>
                                <td><input type='checkbox' class='referencesCheckBoxes' name='referenceID[]' value='{$reference['id']}'></td>
                                <td><a href = "showReference.php?libID={$reference['id']}">{$reference['author']}</a></td>
                                <td><a href = "showReference.php?libID={$reference['id']}">{$reference['title']}</a></td>
                                <td><a href = "showReference.php?libID={$reference['id']}">{$reference['publishYear']}</a></td>
                                <td><a href = "showReference.php?libID={$reference['id']}">{$reference['displayName']}</a></td>
                                <td>{if $reference['url'] eq ''}<img alt = "external link" src="images/link.png">{else}<a href = {$reference['url']}><img alt = "external link" src="images/link.png"></a>{/if}</td>
                            </tr>
                        {/foreach}
                        </tbody>
                    </table>
                </form>
            </div>
            
            
        </div>
        
        
    </body>
</html>

{include file="footer.tpl"}
