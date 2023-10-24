<?php
/* Smarty version 3.1.32, created on 2023-05-19 15:47:53
  from '/var/www/koseionline/data/www/koseionline.vn/admin/templates/users/act_default.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_646737b9664a88_99421120',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e64fce0fd72286af1c31113b107259e2b14b8e16' => 
    array (
      0 => '/var/www/koseionline/data/www/koseionline.vn/admin/templates/users/act_default.html',
      1 => 1670384087,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:_block_inner_head.html' => 1,
  ),
),false)) {
function content_646737b9664a88_99421120 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:_block_inner_head.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
<form name="theForm" action="" method="post" id="theForm">
<table width="100%" border="0">
<tr>
<td style="padding:10px">
	<div style="font-size:12px;float:right">
		<input type="text" name="s_user_name" value="<?php echo $_smarty_tpl->tpl_vars['s_user_name']->value;?>
" style="width:100px" placeholder="Tên đăng nhập"/>
		<input type="text" name="s_fullname" value="<?php echo $_smarty_tpl->tpl_vars['s_fullname']->value;?>
" style="width:100px" placeholder="Họ tên"/>
		<input type="text" name="s_email" value="<?php echo $_smarty_tpl->tpl_vars['s_email']->value;?>
" style="width:100px" placeholder="Email"/>
		<select name="s_gender">
		<option value="">Giới tính</option>
		<option value="0" <?php if ($_smarty_tpl->tpl_vars['s_gender']->value == '0') {?>selected<?php }?>>Nam</option>
		<option value="1" <?php if ($_smarty_tpl->tpl_vars['s_gender']->value == '1') {?>selected<?php }?>>Nữ</option>
		</select>
		<select name="s_is_active">
		<option value="">Trạng thái</option>
		<option value="0" <?php if ($_smarty_tpl->tpl_vars['s_is_active']->value == '0') {?>selected<?php }?>>Không hoạt động</option>
		<option value="1" <?php if ($_smarty_tpl->tpl_vars['s_is_active']->value == '1') {?>selected<?php }?>>Hoạt động</option>
		</select>
		<input type="submit" name="btnFilter" value="&nbsp;&nbsp;" id="btnSearch"/>	
	</div>
</td>
</tr>
<tr>
	<td style="padding:0px 10px" width="100%" valign="top">
	<?php echo $_smarty_tpl->tpl_vars['clsDataGrid']->value->showDataGrid("theForm");?>

	</td>
</tr>
<tr>
	<td  style="padding:0px 10px">
	<?php echo $_smarty_tpl->tpl_vars['clsDataGrid']->value->showPaging("theForm");?>

	</td>
</tr>
</table>
</form>

<?php echo '<script'; ?>
>
function confirmUnBan() {
	var total = 0;
	var fmobj = document.theForm;
	for (var i=0;i<fmobj.elements.length;i++) {
	 var e = fmobj.elements[i];
	 if ((e.name != 'allbox') && (e.type=='checkbox') && (!e.disabled)) {
		 if (e.checked) total++;
	 }
	}
	if (total==0){ 
		alert('You must choose at least one!');
		return false;
	}
	document.theForm.btnSave.value= "UnBan";
	document.theForm.submit();
	return true;
}
function confirmBan(){
	var total = 0;
	var fmobj = document.theForm;
	for (var i=0;i<fmobj.elements.length;i++) {
	 var e = fmobj.elements[i];
	 if ((e.name != 'allbox') && (e.type=='checkbox') && (!e.disabled)) {
		 if (e.checked) total++;
	 }
	}
	if (total==0){ 
		alert('You must choose at least one!');
		return false;
	}
	document.theForm.btnSave.value= "Ban";
	document.theForm.submit();
	return true;
}
function confirmSuspend(){
	var total = 0;
	var fmobj = document.theForm;
	for (var i=0;i<fmobj.elements.length;i++) {
	 var e = fmobj.elements[i];
	 if ((e.name != 'allbox') && (e.type=='checkbox') && (!e.disabled)) {
		 if (e.checked) total++;
	 }
	}
	if (total==0){ 
		alert('You must choose at least one!');
		return false;
	}
	document.theForm.action = "?mod=user&act=dosuspend";
	document.theForm.btnSave.value= "Suspend";
	document.theForm.submit();
	return true;
}
function confirmDelete1(){
	var total = 0;
	var fmobj = document.theForm;
	for (var i=0;i<fmobj.elements.length;i++) {
	 var e = fmobj.elements[i];
	 if ((e.name != 'allbox') && (e.type=='checkbox') && (!e.disabled)) {
		 if (e.checked) total++;
	 }
	}
	if (total==0){ 
		alert('You must choose at least one!');
		return false;
	}
	document.theForm.action = "?mod=user&act=dodelete";
	document.theForm.btnSave.value= "Suspend";
	document.theForm.submit();
	return true;
}

function confirmPending() {
	var total = 0;
	var fmobj = document.theForm;
	for (var i=0;i<fmobj.elements.length;i++) {
	 var e = fmobj.elements[i];
	 if ((e.name != 'allbox') && (e.type=='checkbox') && (!e.disabled)) {
		 if (e.checked) total++;
	 }
	}
	if (total==0){ 
		alert('You must choose at least one!');
		return false;
	}
	document.theForm.action = "?mod=user&act=dopending";
	document.theForm.btnSave.value= "Active";
	document.theForm.submit();
	return true;
}
<?php echo '</script'; ?>
>

<?php }
}
