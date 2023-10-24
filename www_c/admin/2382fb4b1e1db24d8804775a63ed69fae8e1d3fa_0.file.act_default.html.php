<?php
/* Smarty version 3.1.32, created on 2023-03-16 08:35:28
  from '/var/www/koseionline/data/www/koseionline.vn/admin/templates/feedbacks/act_default.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_641272602dc416_16383512',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2382fb4b1e1db24d8804775a63ed69fae8e1d3fa' => 
    array (
      0 => '/var/www/koseionline/data/www/koseionline.vn/admin/templates/feedbacks/act_default.html',
      1 => 1616483392,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:_block_inner_head.html' => 1,
  ),
),false)) {
function content_641272602dc416_16383512 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:_block_inner_head.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
<form name="theForm" action="" method="post" id="theForm">
<table width="100%" border="0">
<tr>
<td style="padding:10px">
	<div style="font-size:14px; float:left">
	<strong><?php echo $_smarty_tpl->tpl_vars['core']->value->getLang("ListOf");?>
 <?php echo $_smarty_tpl->tpl_vars['clsDataGrid']->value->getTitle();?>
</strong> 
	<?php if ($_smarty_tpl->tpl_vars['arrParent']->value['name'] != '') {?>
	[Trang cha: <b><?php echo $_smarty_tpl->tpl_vars['arrParent']->value['name'];?>
</b>]
	<?php }?>
	</div>
	<div style="float:right;font-size:12px; width:30%; color:blue" align="right">
	Ngôn ngữ: <?php echo $_smarty_tpl->tpl_vars['lang_code_name']->value;?>

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
<?php }
}
