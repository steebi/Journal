<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-04-09 00:48:47
         compiled from ".\templates\index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:135205525b04fc99471-46337408%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3dbdaba6cc9b44a95788b30a813179bd43f2ac1d' => 
    array (
      0 => '.\\templates\\index.tpl',
      1 => 1428532831,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '135205525b04fc99471-46337408',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'notes' => 0,
    'note' => 0,
    'ACTIVE_NOTE_ID' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5525b04fe43152_03428601',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5525b04fe43152_03428601')) {function content_5525b04fe43152_03428601($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_truncate')) include 'C:\\xampp\\htdocs\\Journal\\lib\\plugins\\modifier.truncate.php';
if (!is_callable('smarty_modifier_date_format')) include 'C:\\xampp\\htdocs\\Journal\\lib\\plugins\\modifier.date_format.php';
?><?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('title'=>"miNotes"), 0);?>


<div id="container">
    
	<!-- This deals sets the content for the notes list -->
    <div id="notes-list">
        <div id="notes-list-header" class="header">
            <span class="left">miNotes</span>
            <span class="right"><a href="index.php?action=new"><img src="images/newDocument.png" width="25" height ="25" alt="Create new note."></a></span>
        </div>
		<!-- For each note item in notes enter a note in the notes list -->
        <?php  $_smarty_tpl->tpl_vars['note'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['note']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['notes']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['note']->key => $_smarty_tpl->tpl_vars['note']->value) {
$_smarty_tpl->tpl_vars['note']->_loop = true;
?>
            <div class="notes-list-item">
				<!-- Link that passes navigate to switch statement in index.php and also sets the note id to be the selected note, also has a conditional class, if active note id matches then set class to 'active'. The contents of the link is also set to content from the note, truncated to 20 characters and stripped of html tags -->
                <span class="notes-list-item-title"><a href="index.php?action=navigate&id=<?php echo $_smarty_tpl->tpl_vars['note']->value['id'];?>
" <?php if ($_smarty_tpl->tpl_vars['note']->value['id']==$_smarty_tpl->tpl_vars['ACTIVE_NOTE_ID']->value) {?>class='active'<?php }?>><?php echo strip_tags(smarty_modifier_truncate($_smarty_tpl->tpl_vars['note']->value['content'],20));?>
</a></span>
                <!-- Sets the timestamp of the note -->
				<span class="notes-list-item-timestamp"><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['note']->value['last_modified'],"%b %d");?>
</span>
            </div>      
        <?php } ?>
    </div>
    
    <div id="notepad">
        <div id="notepad-header" class="header">
			<!-- Control buttons on head of page. Save takes content from 'updateForm' and submits -->
			<!-- Delete passes delete to the switch statement with the current noteId -->
			<!-- Publish calls on download.php to download the notes as a plain text file -->
            <span class="first-command-header"><a href="#" onclick="document.getElementById('updateForm').submit();">Save</a></span>&nbsp;|&nbsp;<span><a href="index.php?action=delete">Delete</a></span>&nbsp;|&nbsp;<span><a href="download.php">Publish</a></span>
            <span class="right">Stephen Farrell</span>
        </div>
        <div>
		<!-- If there is a current actve note then set the timestamp on the page to the note timestamp and fill the text area with the note's content. This is done on page load -->
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
