<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-04-30 20:07:54
         compiled from ".\templates\home.tpl" */ ?>
<?php /*%%SmartyHeaderCode:190815539048734b6b6-33638628%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'eac3cf626f39945169284be9eb498f874ada9b8e' => 
    array (
      0 => '.\\templates\\home.tpl',
      1 => 1430416388,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '190815539048734b6b6-33638628',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_55390487474505_24971669',
  'variables' => 
  array (
    'user_name' => 0,
    'libraries' => 0,
    'row' => 0,
    'sharedUsers' => 0,
    'sharedUser' => 0,
    'deleteableLibraries' => 0,
    'references' => 0,
    'reference' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55390487474505_24971669')) {function content_55390487474505_24971669($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('title'=>"BibTex"), 0);?>


<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="registerStyles.css">
        <title>BibTex</title>
        <?php echo '<script'; ?>
 src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="lib/joequery-Stupid-Table-Plugin-5cb0c4d/stupidtable.js?dev"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 language="JavaScript">
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
            
        <?php echo '</script'; ?>
>
    </head>
    <body>
        <div id="header" >
            <span><a href="home.php">Home</a></span>&nbsp;|&nbsp;<span><a href="newEntry.php">New Entry</a>&nbsp;|&nbsp;<span><a href="homeShare.php">Shared Libraries</a></span>
            <span class="right"><a href="upDateDetails.php"><?php echo $_smarty_tpl->tpl_vars['user_name']->value;?>
</a>&nbsp;|&nbsp;<a href="logout.php">Logout</a></span>
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
                                <option value="all" <?php if (!isset($_GET['libID'])) {?>selected="selected"<?php }?>>All libraries</option>
                                <?php  $_smarty_tpl->tpl_vars['row'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['row']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['libraries']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['row']->key => $_smarty_tpl->tpl_vars['row']->value) {
$_smarty_tpl->tpl_vars['row']->_loop = true;
?>
                                    <option value="<?php echo $_smarty_tpl->tpl_vars['row']->value[0];?>
"<?php if (isset($_GET['libID'])&&$_GET['libID']==$_smarty_tpl->tpl_vars['row']->value[0]) {?>selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['row']->value[1];?>
</option>
                                <?php } ?>
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
                                <?php  $_smarty_tpl->tpl_vars['sharedUser'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['sharedUser']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['sharedUsers']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['sharedUser']->key => $_smarty_tpl->tpl_vars['sharedUser']->value) {
$_smarty_tpl->tpl_vars['sharedUser']->_loop = true;
?><option value="<?php echo $_smarty_tpl->tpl_vars['sharedUser']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['sharedUser']->value['sharedUser'];?>
</option><?php } ?>
                            </select>
                        </label>
                        </br>
                        <input type="hidden" name="libID" value="<?php echo $_GET['libID'];?>
"/>
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
                                <?php  $_smarty_tpl->tpl_vars['row'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['row']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['libraries']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['row']->key => $_smarty_tpl->tpl_vars['row']->value) {
$_smarty_tpl->tpl_vars['row']->_loop = true;
?>
                                    <option value="<?php echo $_smarty_tpl->tpl_vars['row']->value[0];?>
"><?php echo $_smarty_tpl->tpl_vars['row']->value[1];?>
</option>
                                <?php } ?>
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
                                <?php  $_smarty_tpl->tpl_vars['row'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['row']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['deleteableLibraries']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['row']->key => $_smarty_tpl->tpl_vars['row']->value) {
$_smarty_tpl->tpl_vars['row']->_loop = true;
?>
                                    <option value="<?php echo $_smarty_tpl->tpl_vars['row']->value[0];?>
"><?php echo $_smarty_tpl->tpl_vars['row']->value[1];?>
</option>
                                <?php } ?>
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
                                <?php  $_smarty_tpl->tpl_vars['row'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['row']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['deleteableLibraries']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['row']->key => $_smarty_tpl->tpl_vars['row']->value) {
$_smarty_tpl->tpl_vars['row']->_loop = true;
?>
                                    <option value="<?php echo $_smarty_tpl->tpl_vars['row']->value[0];?>
"><?php echo $_smarty_tpl->tpl_vars['row']->value[1];?>
</option>
                                <?php } ?>
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
                                    <?php  $_smarty_tpl->tpl_vars['row'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['row']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['deleteableLibraries']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['row']->key => $_smarty_tpl->tpl_vars['row']->value) {
$_smarty_tpl->tpl_vars['row']->_loop = true;
?>
                                        <option value="<?php echo $_smarty_tpl->tpl_vars['row']->value[0];?>
"<?php if ($_smarty_tpl->tpl_vars['row']->value[1]=='unfiled') {?>selected='selected'<?php }?>><?php echo $_smarty_tpl->tpl_vars['row']->value[1];?>
</option>
                                    <?php } ?>
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
                            <?php  $_smarty_tpl->tpl_vars['row'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['row']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['libraries']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['row']->key => $_smarty_tpl->tpl_vars['row']->value) {
$_smarty_tpl->tpl_vars['row']->_loop = true;
?>
                                <option value="<?php echo $_smarty_tpl->tpl_vars['row']->value[0];?>
"<?php if ($_smarty_tpl->tpl_vars['row']->value[1]=='unfiled') {?>selected='selected'<?php }?>><?php echo $_smarty_tpl->tpl_vars['row']->value[1];?>
</option>
                            <?php } ?>
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
                        <?php  $_smarty_tpl->tpl_vars['reference'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['reference']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['references']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['reference']->key => $_smarty_tpl->tpl_vars['reference']->value) {
$_smarty_tpl->tpl_vars['reference']->_loop = true;
?>
                            <tr class='hover'>
                                <td><input type='checkbox' class='referencesCheckBoxes' name='referenceID[]' value='<?php echo $_smarty_tpl->tpl_vars['reference']->value['id'];?>
'></td>
                                <td><a href = "showReference.php?libID=<?php echo $_smarty_tpl->tpl_vars['reference']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['reference']->value['author'];?>
</a></td>
                                <td><a href = "showReference.php?libID=<?php echo $_smarty_tpl->tpl_vars['reference']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['reference']->value['title'];?>
</a></td>
                                <td><a href = "showReference.php?libID=<?php echo $_smarty_tpl->tpl_vars['reference']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['reference']->value['publishYear'];?>
</a></td>
                                <td><a href = "showReference.php?libID=<?php echo $_smarty_tpl->tpl_vars['reference']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['reference']->value['displayName'];?>
</a></td>
                                <td><?php if ($_smarty_tpl->tpl_vars['reference']->value['url']=='') {?><img alt = "external link" src="images/link.png"><?php } else { ?><a href = <?php echo $_smarty_tpl->tpl_vars['reference']->value['url'];?>
><img alt = "external link" src="images/link.png"></a><?php }?></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                 </form>
                 
                 <hr>       
             
                        <!--End of the main content of the website! -->
            </div>
            
              
        </div>
        
                   
    
    </body>
</html>

<?php echo $_smarty_tpl->getSubTemplate ("footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php }} ?>
