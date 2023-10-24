<?php
/* Smarty version 3.1.32, created on 2022-05-25 16:24:23
  from '/var/www/koseionline.vn/data/www/koseionline.vn/admin/templates/recyclebin/act_default.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_628df5c73cb545_30715390',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2d7f330a32def71f65a202d9241ff82450386e45' => 
    array (
      0 => '/var/www/koseionline.vn/data/www/koseionline.vn/admin/templates/recyclebin/act_default.html',
      1 => 1616483394,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_628df5c73cb545_30715390 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/var/www/koseionline.vn/data/www/koseionline.vn/includes/smarty3/plugins/modifier.date_format.php','function'=>'smarty_modifier_date_format',),));
echo '<script'; ?>
>
function store(){
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
	if (confirm('Do you want to restore the selected items [OK]:Yes [Cancel]:No?')){
		document.theForm.btnRestore.value= "Restore";
		document.theForm.submit();
		return true;
	}
	return false;
}
function confirmDelete(){
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
	if (confirm('Do you want to delete the selected items [OK]:Yes [Cancel]:No?')){
		document.theForm.btnDelete.value= "Delete";
		document.theForm.submit();
		return true;
	}
	return false;
}
function CheckAll(cb) {
	 var fmobj = document.theForm;
	 for (var i=0;i<fmobj.elements.length;i++) {
		 var e = fmobj.elements[i];
		 if ((e.name != 'allbox') && (e.type=='checkbox') && (!e.disabled)) {
			 e.checked = cb;
		 }
	 }
	 return false;
}
<?php echo '</script'; ?>
>

<div class="inner_head_title">
<table cellpadding="0" cellspacing="0" width="100%" border="0">
<tr style="background:#FBFBFB">
	<td width="55px" style="padding:5px;">
		<a href="?mod=<?php echo $_smarty_tpl->tpl_vars['mod']->value;?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['clsCP']->value->getImgSrc();?>
" border="0"/></a>
	</td>
	<td>
	<span class="title1"><?php echo $_smarty_tpl->tpl_vars['core']->value->getLang("RecycleBin");?>
</span><br />
	<span class="title2"><?php echo $_smarty_tpl->tpl_vars['core']->value->getLang("RecycleBin");?>
</span>
	</td>
	<td style="padding:5px;" align="right">
		<?php echo $_smarty_tpl->tpl_vars['clsButtonNav']->value->render();?>
		
	</td>
</tr>
</table>
</div>
<form name="theForm" action="" method="post">
<input type="hidden" name="btnRestore" value="" />
<input type="hidden" name="btnDelete" value="" />
<table width="100%" border="0">
<tr>
<td style="padding:10px">
	<div style="padding-bottom:5px;font-size:14px">
	<strong>List of Deleted Objects:</strong> 
	<a href="" onclick="return CheckAll(1);"><?php echo $_smarty_tpl->tpl_vars['core']->value->getLang("CheckAll");?>
</a> | <a href="" onclick="return CheckAll(0);"><?php echo $_smarty_tpl->tpl_vars['core']->value->getLang("UnCheckAll");?>
</a>
	</div>
</td>
</tr>
<tr>
<td style="padding-left:10px;padding-right:10px" width="100%" valign="top">
	
<table cellpadding="5" cellspacing="5" border="0">
<tr>
<?php
$__section_id_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['arrListItem']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_id_0_total = $__section_id_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_id'] = new Smarty_Variable(array());
if ($__section_id_0_total !== 0) {
for ($__section_id_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_id']->value['index'] = 0; $__section_id_0_iteration <= $__section_id_0_total; $__section_id_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_id']->value['index']++){
$_smarty_tpl->tpl_vars['__smarty_section_id']->value['rownum'] = $__section_id_0_iteration;
?>
	<td>
<div style="width:180px; border:1px solid #CCCCCC; color:#999999; font-size:10px" align="center">
<a href="?mod=recyclebin&act=detail&id=<?php echo $_smarty_tpl->tpl_vars['arrListItem']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_id']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_id']->value['index'] : null)]['id'];?>
" style="text-decoration:none" title="View Object Detail"><div style="border-bottom:1px solid #CCCCCC; font-size:11px; background:#666666; color:#F7F7F7"><b><?php echo $_smarty_tpl->tpl_vars['arrListItem']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_id']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_id']->value['index'] : null)]['objname'];?>
</b></div></a>
<?php echo $_smarty_tpl->tpl_vars['arrListItem']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_id']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_id']->value['index'] : null)]['objtitle'];?>

<br>
<input type="checkbox" name="checkList[]" value="<?php echo $_smarty_tpl->tpl_vars['arrListItem']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_id']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_id']->value['index'] : null)]['id'];?>
"/>
<div style="border-top:1px solid #CCCCCC;">Deleted at <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['arrListItem']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_id']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_id']->value['index'] : null)]['del_date'],"%m/%d/%Y, %H:%M");?>
 <br>
by <?php echo $_smarty_tpl->tpl_vars['arrListItem']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_id']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_id']->value['index'] : null)]['user_name'];?>
</div>
</div>
	
	</td>
<?php if ((isset($_smarty_tpl->tpl_vars['__smarty_section_id']->value['rownum']) ? $_smarty_tpl->tpl_vars['__smarty_section_id']->value['rownum'] : null)%5 == 0) {?>
	</tr>
	<tr>
<?php }
}} else {
 ?>
	<tr>
		<td style="color:#FF0000"><b><?php echo $_smarty_tpl->tpl_vars['core']->value->getLang("Empty");?>
!</b></td>
	</tr>
<?php
}
?>
</tr>
</table>
	
</td>
</tr>
<tr>
	<td style="padding-left:10px;padding-right:10px; font-size:12px"><div style="float:left; display:inline"><?php echo $_smarty_tpl->tpl_vars['core']->value->getLang("Total");?>
: <?php echo $_smarty_tpl->tpl_vars['totalItem']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['core']->value->getLang("object");?>
(s)</div>
<div style="float:right;">	
<?php if ($_smarty_tpl->tpl_vars['prevurl']->value != '') {?><a href="<?php echo $_smarty_tpl->tpl_vars['prevurl']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['core']->value->getLang("Prev");?>
</a><?php } else {
echo $_smarty_tpl->tpl_vars['core']->value->getLang("Prev");
}?> | <?php echo $_smarty_tpl->tpl_vars['page']->value;?>
 |
<?php if ($_smarty_tpl->tpl_vars['nexturl']->value != '') {?><a href="<?php echo $_smarty_tpl->tpl_vars['nexturl']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['core']->value->getLang("Next");?>
</a><?php } else {
echo $_smarty_tpl->tpl_vars['core']->value->getLang("Next");
}?>
</div>
</td>
</tr>
</table>
</form>
<?php }
}
