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
                    <form action='homeShare.php'method='get'>
                        <p>
                            <label for='search'>Search Shared Libraries:</label>
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
                
                            
            </div>
            
            <!--                   END OF THE SIDEBAR ELEMENTS!                   -->
                            
            <div id="mainContent">
                
                
                
                <form action="home.php" method="get">
                    
                    <table>
                        <thead>
                            <tr class='tableHeader'>
                                <th>All<input type='checkbox' class='selectAll left' name='selectAll' onChange='selectALL(this);'></th>
                                <th data-sort="string">Author</th>
                                <th data-sort="string">Title</th>
                                <th data-sort="string">Owner</th>
                                <th data-sort="string">year</th>
                                <th>library</th>
                                <th>url</th>
                            </tr>
                        </thead>
                        <tbody>
                        {foreach from=$references item=reference}
                            <tr class='hover'>
                                <td><input type='checkbox' class='referencesCheckBoxes' name='referenceID[]' value='{$reference['id']}'></td>
                                <td><a href = "showReference.php?libID={$reference['id']}">{$reference['author']}</a></td>
                                <td><a href = "showReference.php?libID={$reference['id']}">{$reference['title']}</a></td>
                                <td><a href = "showReference.php?libID={$reference['id']}">{$reference['ownerEmail']}</a></td>
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
