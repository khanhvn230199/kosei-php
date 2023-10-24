<?php
/* Smarty version 3.1.32, created on 2021-11-29 11:42:24
  from '/var/www/koseionline.vn/data/www/koseionline.vn/admin/templates/adminmanager/act_add.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_61a45a307945c6_92729539',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'eb6a1cc173fcce4fc94a85a92df2350949d7630b' => 
    array (
      0 => '/var/www/koseionline.vn/data/www/koseionline.vn/admin/templates/adminmanager/act_add.html',
      1 => 1616483390,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:_block_inner_head_add.html' => 1,
  ),
),false)) {
function content_61a45a307945c6_92729539 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:_block_inner_head_add.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
<form name="theForm" action="" method="post">
<table width="100%" border="0">
<tr>
<td style="padding:10px">
	<div style="padding-bottom:5px;font-size:14px">
	<strong><?php if ($_smarty_tpl->tpl_vars['clsForm']->value->pval != '') {
echo $_smarty_tpl->tpl_vars['core']->value->getLang("Edit");?>
 <?php echo $_smarty_tpl->tpl_vars['clsForm']->value->getTitle();?>
: #<?php echo $_smarty_tpl->tpl_vars['clsForm']->value->pval;?>

			<?php } else {
echo $_smarty_tpl->tpl_vars['core']->value->getLang("Add");?>
 <?php echo $_smarty_tpl->tpl_vars['clsForm']->value->getTitle();?>

			<?php }?>
	</strong>
	</div>
</td>
</tr>
<tr>
<td style="padding:0px 10px" width="100%" valign="top">
	<?php echo $_smarty_tpl->tpl_vars['clsForm']->value->showJS();?>

	<table cellpadding="0" cellspacing="0" width="100%" border="0" class="girdtable">
	<tr>
		<td colspan="2" class="gridheader1"><?php echo $_smarty_tpl->tpl_vars['core']->value->getLang("InputCorrectlyAllBelowFields");?>
<Br />
		
		</td>
	</tr>
	<?php if ($_smarty_tpl->tpl_vars['clsForm']->value->isValid != 1) {?>
	<tr>
		<td class="gridrow1" style="color:red; padding:5px" colspan="2">
		<?php echo $_smarty_tpl->tpl_vars['clsForm']->value->showAllError();?>

		</td>
	</tr>
	<?php }?>
	<?php echo $_smarty_tpl->tpl_vars['clsForm']->value->showForm();?>

	<?php if ($_smarty_tpl->tpl_vars['clsForm']->value->pval != '') {?>
	<tr>
		<td class="gridrow2">&nbsp;</td>
		<td class="gridrow3">
		<strong>Access on Modules:</strong>&nbsp;
<?php if (($_smarty_tpl->tpl_vars['core']->value->isSuper() && $_smarty_tpl->tpl_vars['core']->value->_USER['user_id'] != $_smarty_tpl->tpl_vars['clsForm']->value->pval)) {?>
[<a href="?mod=adminpermiss&<?php echo $_smarty_tpl->tpl_vars['clsForm']->value->pkey;?>
=<?php echo $_smarty_tpl->tpl_vars['clsForm']->value->pval;?>
" style="color:blue"><b>Edit Permission</b></a>]
<?php } else { ?>
<b style="color:#0000FF">All Modules</b>
<?php }?>
		<?php
$__section_id_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['default_permiss_key']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_id_0_total = $__section_id_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_id'] = new Smarty_Variable(array());
if ($__section_id_0_total !== 0) {
for ($__section_id_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_id']->value['index'] = 0; $__section_id_0_iteration <= $__section_id_0_total; $__section_id_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_id']->value['index']++){
?>
		<?php $_smarty_tpl->_assignInScope('key', $_smarty_tpl->tpl_vars['default_permiss_key']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_id']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_id']->value['index'] : null)]);?>
		<?php if ($_smarty_tpl->tpl_vars['admin_permiss']->value[$_smarty_tpl->tpl_vars['key']->value] == 1 || ($_smarty_tpl->tpl_vars['core']->value->isSuper() && $_smarty_tpl->tpl_vars['core']->value->_USER['user_id'] == $_smarty_tpl->tpl_vars['clsForm']->value->pval)) {?>
		<div style="padding-left:5px; padding-top:5px">&raquo; <?php echo $_smarty_tpl->tpl_vars['default_permiss_name']->value[$_smarty_tpl->tpl_vars['key']->value];?>
</div>
		<?php }?>
		<?php
}
}
?>
		&nbsp;
		</td>
	</tr>

	<?php }?>
	</table>
	<em><font style="font-size:10px"><?php echo $_smarty_tpl->tpl_vars['core']->value->getLang("Note");?>
: * <?php echo $_smarty_tpl->tpl_vars['core']->value->getLang("isrequired");?>
</font></em>
</td>
</tr>
</table>
</form><?php }
}
