<?php
/* Smarty version 3.1.32, created on 2023-05-29 13:46:18
  from '/var/www/koseionline/data/www/koseionline.vn/admin/templates/adminmanager/act_default.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_64744a3af40e08_01894901',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6be49772b60292659ea3e3aa8a05095140c4a047' => 
    array (
      0 => '/var/www/koseionline/data/www/koseionline.vn/admin/templates/adminmanager/act_default.html',
      1 => 1670384083,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:_block_inner_head.html' => 1,
  ),
),false)) {
function content_64744a3af40e08_01894901 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:_block_inner_head.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
<form name="theForm" action="" method="post" id="theForm">
<table width="100%" border="0">
<tr>
<td style="padding:10px">
	<div style="padding-bottom:5px;font-size:14px">
	<strong><?php echo $_smarty_tpl->tpl_vars['core']->value->getLang("ListOf");?>
</strong>
	</div>

	<div style="clear:both; height:0px; overflow:hidden"></div>
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
</form><?php }
}
