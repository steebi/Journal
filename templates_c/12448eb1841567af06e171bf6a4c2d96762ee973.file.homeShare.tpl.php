<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-04-29 01:54:41
         compiled from ".\templates\homeShare.tpl" */ ?>
<?php /*%%SmartyHeaderCode:18044554015df4f3462-15544639%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '12448eb1841567af06e171bf6a4c2d96762ee973' => 
    array (
      0 => '.\\templates\\homeShare.tpl',
      1 => 1430265276,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '18044554015df4f3462-15544639',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_554015df5f1324_58664928',
  'variables' => 
  array (
    'user_name' => 0,
    'libraries' => 0,
    'row' => 0,
    'references' => 0,
    'reference' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_554015df5f1324_58664928')) {function content_554015df5f1324_58664928($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('title'=>"BibTex"), 0);?>


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
            
            $(function(){
                $("table").stupidtable();
            });
            
        <?php echo '</script'; ?>
>
    </head>
    <body>
        <div id="header" >
            <span><a href="home.php">Home</a></span>&nbsp;|&nbsp;<span><a href="newEntry.php">New Entry</a></span>
            <span class="right"><a href="upDateDetails.php"><?php echo $_smarty_tpl->tpl_vars['user_name']->value;?>
</a>&nbsp;|&nbsp;<a href="logout.php">Logout</a></span>
        </div>
       
        <div class = "container">
        
            <div id="sideBar">
                
                <div class="controlsList">
                    <form action='home.php'method='get'>
                        <p>
                            <label for='search'>Search Libraries:</label>
                            <select name='libID'>
                                <option value="all" selected="selected">All libraries</option>
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
"><?php echo $_smarty_tpl->tpl_vars['reference']->value['ownerEmail'];?>
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
