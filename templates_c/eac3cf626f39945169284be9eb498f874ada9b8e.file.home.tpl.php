<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-04-23 17:47:55
         compiled from ".\templates\home.tpl" */ ?>
<?php /*%%SmartyHeaderCode:190815539048734b6b6-33638628%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'eac3cf626f39945169284be9eb498f874ada9b8e' => 
    array (
      0 => '.\\templates\\home.tpl',
      1 => 1429804073,
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
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55390487474505_24971669')) {function content_55390487474505_24971669($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('title'=>"BibTex"), 0);?>


<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <div id="header" >
            <span><a href="home.php">Home</a></span>&nbsp;|&nbsp;<span><a href="newEntry.php">New Entry</a></span>
            <span class="right"><a href="/BibTex/upDateDetails.php"><?php echo $_smarty_tpl->tpl_vars['user_name']->value;?>
</a>&nbsp;|&nbsp;<a href="logout.php">Logout</a></span>
        </div>
       
    </body>
</html>

<?php echo $_smarty_tpl->getSubTemplate ("footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php }} ?>
