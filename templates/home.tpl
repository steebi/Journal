{include file="header.tpl" title="BibTex"}

<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="registerStyles.css">
        <title>BibTex</title>
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
                
            </div>
            
            
            
            
            
            
            <div id="mainContent">
                <form action="home.php" method="get">
                    <select name='libID'>
                        {foreach from=$libraries item=row}
                            <option value="{$row.0}"{if $row.1 eq 'unfiled'}selected='selected'{/if}>{$row.1}</option>
                        {/foreach}
                    </select>
                    <input type='submit' class='submit right' name='action' value='Move To'>
                    <table>
                        <tr>
                            <th>Select</th>
                            <th>Author</th>
                            <th>Title</th>
                            <th>year</th>
                            <th>library</th>
                            <th>url</th>
                        </tr>
                        {foreach from=$references item=reference}
                            <tr>
                                <td><input type='checkbox' name='referenceID[]' value='{$reference['id']}'></td>
                                <td>{$reference['author']}</td>
                                <td>{$reference['title']}</td>
                                <td>{$reference['publishYear']}</td>
                                <td>{$reference['displayName']}</td>
                                <td>{if $reference['url'] eq ''}<img alt = "external link" src="images/link.png">{else}<a href = {$reference['url']}><img alt = "external link" src="images/link.png"></a>{/if}</td>
                            </tr>
                        {/foreach}
                    </table>
                </form>
            </div>
            
            
        </div>
        
        
    </body>
</html>

{include file="footer.tpl"}
