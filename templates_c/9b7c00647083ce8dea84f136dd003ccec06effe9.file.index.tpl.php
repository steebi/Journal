<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-03-06 12:07:56
         compiled from "./templates/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:11374461854e71d2870d2e4-92880343%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9b7c00647083ce8dea84f136dd003ccec06effe9' => 
    array (
      0 => './templates/index.tpl',
      1 => 1425643143,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '11374461854e71d2870d2e4-92880343',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_54e71d287a8ee1_55860376',
  'variables' => 
  array (
    'notes' => 0,
    'note' => 0,
    'ACTIVE_NOTE_ID' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54e71d287a8ee1_55860376')) {function content_54e71d287a8ee1_55860376($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_truncate')) include '/home/smsc1403/public_html/journal/lib/plugins/modifier.truncate.php';
if (!is_callable('smarty_modifier_date_format')) include '/home/smsc1403/public_html/journal/lib/plugins/modifier.date_format.php';
?><?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('title'=>"miNotes"), 0);?>


<div id="container">
    
    <div id="notes-list">
        <div id="notes-list-header" class="header">
            <span class="left">miNotes</span>
            <span class="right"><a href="index.php?action=new"><img src="images/newDocument.png" width="25" height ="25" alt="Create new note."></a></span>
        </div>
        <?php  $_smarty_tpl->tpl_vars['note'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['note']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['notes']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['note']->key => $_smarty_tpl->tpl_vars['note']->value) {
$_smarty_tpl->tpl_vars['note']->_loop = true;
?>
            <div class="notes-list-item">
                <span class="notes-list-item-title"><a href="index.php?action=navigate&id=<?php echo $_smarty_tpl->tpl_vars['note']->value['id'];?>
" <?php if ($_smarty_tpl->tpl_vars['note']->value['id']==$_smarty_tpl->tpl_vars['ACTIVE_NOTE_ID']->value) {?>class='active'<?php }?>><?php echo strip_tags(smarty_modifier_truncate($_smarty_tpl->tpl_vars['note']->value['content'],20));?>
</a></span>
                <span class="notes-list-item-timestamp"><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['note']->value['last_modified'],"%b %d");?>
</span>
            </div>      
        <?php } ?>
    </div>
    
    <div id="notepad">
        <div id="notepad-header" class="header">
            <span class="first-command-header"><a href="#" onclick="document.getElementById('updateForm').submit();">Save</a></span>&nbsp;|&nbsp;<span><a href="index.php?action=delete">Delete</a></span>&nbsp;|&nbsp;<span><a href="download.php">Publish</a></span>
            <span class="right">Stephen Farrell</span>
        </div>
        <div>
            <?php  $_smarty_tpl->tpl_vars['note'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['note']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['notes']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['note']->key => $_smarty_tpl->tpl_vars['note']->value) {
$_smarty_tpl->tpl_vars['note']->_loop = true;
?>
                <?php if ($_smarty_tpl->tpl_vars['note']->value['id']==$_smarty_tpl->tpl_vars['ACTIVE_NOTE_ID']->value) {?>
                <span id="timestamp"><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['note']->value['last_modified'],"%B %d, %r");?>
</span>
                <form action="index.php" method="POST" id="updateForm">
                    <div id="tinymce-holder">
                        <textarea rows="20" cols="70" id="content" name="content" style="margin: 20px; border: 1px grey solid"><?php echo $_smarty_tpl->tpl_vars['note']->value['content'];?>
</textarea>
                    </div>  
                    <input type="hidden" name="action" value="update"/>
                </form>
                <?php }?>
            <?php } ?>
        </div>
    </div>
</div>

<?php echo $_smarty_tpl->getSubTemplate ("footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php }} ?>
