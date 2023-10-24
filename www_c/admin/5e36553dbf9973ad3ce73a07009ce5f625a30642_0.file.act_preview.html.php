<?php
/* Smarty version 3.1.32, created on 2023-10-11 13:54:42
  from '/var/www/koseionline/data/www/koseionline.vn/admin/templates/teacher/act_preview.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_652646b2300cc9_40023152',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '5e36553dbf9973ad3ce73a07009ce5f625a30642' => 
    array (
      0 => '/var/www/koseionline/data/www/koseionline.vn/admin/templates/teacher/act_preview.html',
      1 => 1670384087,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_652646b2300cc9_40023152 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/var/www/koseionline/data/www/koseionline.vn/includes/smarty3/plugins/modifier.date_format.php','function'=>'smarty_modifier_date_format',),));
echo '<script'; ?>
>
function confirmDialog(btnValue) {
	document.theForm.btnSave.value= btnValue;
	document.theForm.submit();
	return true;
}
function confirmVerify(){
	return confirmDialog("Verify");
}
function confirmUnVerify(){
	return confirmDialog("UnVerify");
}
function confirmPublish() {
	return confirmDialog("Publish");
}
function confirmUnPublish() {
	return confirmDialog("UnPublish");
}
function confirmDelete2(){
	document.theForm.btnDelete.value= 'Delete';
	document.theForm.submit();
	return true;
}
<?php echo '</script'; ?>
>

<div class="inner_head_title">
<table cellpadding="0" cellspacing="0" width="100%" border="0">
<tr style="background:#FBFBFB">
	<td width="55px" style="padding:5px;">
		<a href="?mod=<?php echo $_smarty_tpl->tpl_vars['mod']->value;?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['ADMIN_URL_IMAGES']->value;?>
/largeicon/news.png" border="0"/></a>
	</td>
	<td>
	<span class="title1">PUBLISH POST</span><br />
	<span class="title2">Post Management</span>
	</td>
	<td style="padding:5px;" align="right">
		<?php echo $_smarty_tpl->tpl_vars['clsButtonNav']->value->render();?>
		
	</td>
</tr>
</table>
</div>
<form name="theForm" action="" method="post" >
<input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['arrOneNews']->value['news_id'];?>
" name="checkList[]"/>
<input type='hidden' name='btnSave' id='btnSave' value=''>
<input type='hidden' name='btnDelete' id='btnDelete' value=''>
</form>
<div style="padding:10px; margin:0px auto">
<table border="0" cellpadding="5" cellspacing="10" width="100%" style="border:#CCCCCC 1px dotted; max-width:1000px">
<tr>
	<td style="border-bottom:1px dotted #CCCCCC">
<b style="font-size:14px; color:#990000"><img src="<?php echo $_smarty_tpl->tpl_vars['ADMIN_URL_IMAGES']->value;?>
/document_view.png" border="0" align="left"/>Preview</b></td>
</tr>
<tr>
	<td height="25"><span class="txt_menu" style="padding-left:0px"><?php echo $_smarty_tpl->tpl_vars['arrOneNews']->value['title'];?>
</span><br /><span style="font-size:11px">Posted at <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['arrOneNews']->value['reg_date'],"%m/%d/%Y, %H:%M");?>
</span></td>
</tr>
<tr>
	<td class="content">
<?php if ($_smarty_tpl->tpl_vars['arrOneNews']->value['image'] != '') {?><img src="<?php echo $_smarty_tpl->tpl_vars['URL_UPLOADS']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['arrOneNews']->value['image'];?>
" align="left" style="padding:5px; max-width:220px; margin:0px 10px 10px 0px;"><?php }
echo $_smarty_tpl->tpl_vars['arrOneNews']->value['content'];?>

	</td>
</tr>
</table>
<br />&nbsp;
</div><?php }
}
