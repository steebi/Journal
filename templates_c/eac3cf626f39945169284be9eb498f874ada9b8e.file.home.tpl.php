<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-04-27 01:51:55
         compiled from ".\templates\home.tpl" */ ?>
<?php /*%%SmartyHeaderCode:190815539048734b6b6-33638628%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'eac3cf626f39945169284be9eb498f874ada9b8e' => 
    array (
      0 => '.\\templates\\home.tpl',
      1 => 1430092125,
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
                        <label for='changeLibrary'>Change Library
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
                            <p>Author name</p><input teype='text' name='searchAuthor' id='search'>
                            <p>Title</p><input teype='text' name='searchTitle' id='search'>
                            <p>Year</p><input teype='text' name='searchYear' id='search'>
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
            
            
            
            
            
            
            <div id="mainContent">
                <table>
                    <tr>
                        <th>Select</th>
                        <th>Author</th>
                        <th>Title</th>
                        <th>year</th>
                        <th>library</th>
                        <th>url</th>
                    </tr>
                    <?php  $_smarty_tpl->tpl_vars['reference'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['reference']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['references']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['reference']->key => $_smarty_tpl->tpl_vars['reference']->value) {
$_smarty_tpl->tpl_vars['reference']->_loop = true;
?>
                        <tr>
                            <td></td>
                            <td><?php echo $_smarty_tpl->tpl_vars['reference']->value['author'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['reference']->value['title'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['reference']->value['publishYear'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['reference']->value['displayName'];?>
</td>
                            <td><?php if ($_smarty_tpl->tpl_vars['reference']->value['url']=='') {?><img alt = "external link" src="images/link.png"><?php } else { ?><a href = <?php echo $_smarty_tpl->tpl_vars['reference']->value['url'];?>
><img alt = "external link" src="images/link.png"></a><?php }?></td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
            
            
        </div>
        
        
    </body>
</html>

<?php echo $_smarty_tpl->getSubTemplate ("footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php }} ?>
