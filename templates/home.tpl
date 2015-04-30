{include file="header.tpl" title="BibTex"}

<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="registerStyles.css">
        <title>BibTex</title>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
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
            /*
             * This calls on a library downloaded from the internet, that allows a table to be sorted
             * by giving the table elements a class name
             */
            $(function(){
                $("table").stupidtable();
            });
            
        </script>
    </head>
    <body>
        <div id="header" >
            <span><a href="home.php">Home</a></span>&nbsp;|&nbsp;<span><a href="newEntry.php">New Entry</a>&nbsp;|&nbsp;<span><a href="homeShare.php">Shared Libraries</a></span>
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
                                <!--If there is a library set in the $_GET variable then select that library in the library list-->
                                <!--Populate the library options list with libraries passed to the smarty template-->
                                <option value="all" {if !isset($smarty.get.libID)}selected="selected"{/if}>All libraries</option>
                                {foreach from=$libraries item=row}
                                    <option value="{$row.0}"{if isset($smarty.get.libID)and $smarty.get.libID eq $row.0}selected="selected"{/if}>{$row.1}</option>
                                {/foreach}
                            </select>
                        </label>
                        </br>
                        </br>
                        <input type='submit' class='submit right' name='action' value='Change Library'>
                    </form>
                            </br></br>
                    <form action="home.php" method="get">
                        <label>
                            Library is shared with:</br>
                            <select name="selectSharedUser" class="selectSharedUser" multiple="multiple" width="15">
                                <!--Populate the shared user list if there are shared users passed to the template-->
                                {foreach from=$sharedUsers item=sharedUser}<option value="{$sharedUser.id}">{$sharedUser.sharedUser}</option>{/foreach}
                            </select>
                        </label>
                        </br>
                        <input type="hidden" name="libID" value="{$smarty.get.libID}"/>
                        <input type='submit' class='submit right' name='action' value='Remove SharedUser'/>
                    </form>
                </div>
                </br>
                <hr>
                
                <div class="controlsList">
                    <form action='home.php'method='get'>
                        <p>
                            <label for='search'>Search Libraries:</label>
                            <select name='libID'>
                                <option value="all" selected="selected">All libraries</option>
                                <!--Fills the option list with the libraries that were passed to the smarty template-->
                                {foreach from=$libraries item=row}
                                    <option value="{$row.0}">{$row.1}</option>
                                {/foreach}
                            </select>
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
                        <label for='deleteLibrary'>Delete Library:
                            <select name='libID'>
                                <!--List the libraries that are deleteable, passed to the smarty template-->
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
                            
                <div class="controlsList">
                    <form action='home.php'method='get'>
                        <p>
                            <label for='shareWith'>Share library: 
                                <select name='libID' >
                                    {foreach from=$deleteableLibraries item=row}
                                        <option value="{$row.0}"{if $row.1 eq 'unfiled'}selected='selected'{/if}>{$row.1}</option>
                                    {/foreach}
                                </select><input teype='text' name='shareEmail' id='shareEmail'></label></br>
                        </p>
                        <p>    
                            <input type='submit' class='submit right' name='action' value='Share Library' />
                        </p>

                    </form>
                    </br>
                    </br>
                    <hr>
                </div>
                            
            </div>
            
            <!--                   END OF THE SIDEBAR ELEMENTS!                   -->
                            
            <div id="mainContent">
                
                
                
                <form action="home.php" method="get">
                    
                    <div id='dropdownCenter right'>
                        <input type="submit" class="submit" name="action" value="Empty Trash">
                        <input type='submit' class='submit' name='action' value='Move To'>
                        <select name='libID' >
                            {foreach from=$libraries item=row}
                                <option value="{$row.0}"{if $row.1 eq 'unfiled'}selected='selected'{/if}>{$row.1}</option>
                            {/foreach}
                        </select>
                        
                    </div>
                    
                    </br></br>
                    
                    <table>
                        <thead>
                            <!--These are the library entries in the database, they are passed to the smarty template-->
                            <tr class='tableHeader'>
                                <th>All<input type='checkbox' class='selectAll left' name='selectAll' onChange='selectALL(this);'></th>
                                <th data-sort="string">Author</th>
                                <th data-sort="string">Title</th>
                                <th data-sort="string">year</th>
                                <th>library</th>
                                <th>url</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!--Cycles through the array of passed libraries and populates them in the list-->
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
                 
                 <hr>       
             
                        <!--End of the main content of the website! -->
            </div>
            
              
        </div>
        
                   
    
    </body>
</html>

{include file="footer.tpl"}
