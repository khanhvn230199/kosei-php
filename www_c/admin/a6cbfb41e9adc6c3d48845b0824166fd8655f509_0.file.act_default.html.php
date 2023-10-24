<?php
/* Smarty version 3.1.32, created on 2021-06-08 14:19:42
  from '/var/www/koseionline.vn/data/www/koseionline.vn/admin/templates/sliders/act_default.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_60bf1a0ee8d4f5_48561011',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a6cbfb41e9adc6c3d48845b0824166fd8655f509' => 
    array (
      0 => '/var/www/koseionline.vn/data/www/koseionline.vn/admin/templates/sliders/act_default.html',
      1 => 1616483394,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:_block_inner_head.html' => 1,
  ),
),false)) {
function content_60bf1a0ee8d4f5_48561011 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:_block_inner_head.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<form name="theForm" action="" method="post" id="theForm">
<table width="100%" border="0">
<tr>
<td style="padding:10px">
	<div style="padding-bottom:5px;font-size:14px; float:left">
	<strong><?php echo $_smarty_tpl->tpl_vars['core']->value->getLang("ListOf");?>
 <?php echo $_smarty_tpl->tpl_vars['clsDataGrid']->value->getTitle();?>
</strong>
	</div>
	<div style="float:right;font-size:12px; width:30%; color:blue" align="right">
	Ngôn ngữ: <?php echo $_smarty_tpl->tpl_vars['lang_code_name']->value;?>

	</div>
</td>
</tr>
<tr>
<td style="padding-left:10px;padding-right:10px" width="100%" valign="top">
	<?php echo $_smarty_tpl->tpl_vars['clsDataGrid']->value->showDataGrid("theForm");?>

</td>
</tr>
<tr>
<td  style="padding-left:10px;padding-right:10px">
	<?php echo $_smarty_tpl->tpl_vars['clsDataGrid']->value->showPaging("theForm");?>

</td>
</tr>
</table>
</form><?php }
}
