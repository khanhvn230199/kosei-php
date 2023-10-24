<?php
/* Smarty version 3.1.32, created on 2023-05-29 08:44:39
  from '/var/www/koseionline/data/www/koseionline.vn/admin/templates/course/act_add.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_647403876fc044_71329710',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a2658627e083b7a71cb05e2ab799ce197b06aa97' => 
    array (
      0 => '/var/www/koseionline/data/www/koseionline.vn/admin/templates/course/act_add.html',
      1 => 1670384084,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:_block_inner_head_add.html' => 1,
  ),
),false)) {
function content_647403876fc044_71329710 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:_block_inner_head_add.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
<form name="theForm" action="" method="post">
<table width="100%" border="0">
<tr>
<td style="padding:10px">
	<div style="font-size:14px; float:left">
	<strong><?php if ($_smarty_tpl->tpl_vars['clsForm']->value->pval != '') {
echo $_smarty_tpl->tpl_vars['core']->value->getLang("Edit");?>
 <?php echo $_smarty_tpl->tpl_vars['clsForm']->value->getTitle();?>
: #<?php echo $_smarty_tpl->tpl_vars['clsForm']->value->pval;?>

			<?php } else {
echo $_smarty_tpl->tpl_vars['core']->value->getLang("Add");?>
 <?php echo $_smarty_tpl->tpl_vars['clsForm']->value->getTitle();?>

			<?php }?></strong>
	</div>
	<div style="float:right;font-size:12px; color:blue" align="right">
	Ngôn ngữ: <?php echo $_smarty_tpl->tpl_vars['lang_code_name']->value;?>

	</div>
</td>
</tr>
<tr>
<td style="padding:0px 10px" width="100%" valign="top">
	<?php echo $_smarty_tpl->tpl_vars['clsForm']->value->showJS();?>

	<table cellpadding="0" cellspacing="0" width="100%" border="0" class="girdtable">
	<tr>
		<td colspan="2" class="gridheader1"><?php echo $_smarty_tpl->tpl_vars['core']->value->getLang("InputCorrectlyAllBelowFields");?>
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

	</table>
	<em><font style="font-size:10px"><?php echo $_smarty_tpl->tpl_vars['core']->value->getLang("Note");?>
: * <?php echo $_smarty_tpl->tpl_vars['core']->value->getLang("isrequired");?>
</font></em>
</td>
</tr>
</table>
</form>
<?php if ($_smarty_tpl->tpl_vars['mode']->value == 'New') {
echo '<script'; ?>
>var old_slug = "";<?php echo '</script'; ?>
>
<?php } else {
echo '<script'; ?>
>var old_slug = $("#slug").val();<?php echo '</script'; ?>
>
<?php }
}
}
