<?php
/* Smarty version 3.1.32, created on 2023-05-20 14:04:18
  from '/var/www/koseionline/data/www/koseionline.vn/admin/templates/trial/act_default.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_646870f21072f8_17962288',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ac2f6b10e8aefc6e2a24858db6390d0774935bb7' => 
    array (
      0 => '/var/www/koseionline/data/www/koseionline.vn/admin/templates/trial/act_default.html',
      1 => 1671770705,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:_block_inner_head.html' => 1,
  ),
),false)) {
function content_646870f21072f8_17962288 (Smarty_Internal_Template $_smarty_tpl) {
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
