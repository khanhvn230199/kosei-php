<?php
/* Smarty version 3.1.32, created on 2021-06-08 14:40:49
  from '/var/www/koseionline.vn/data/www/koseionline.vn/admin/templates/lesson/act_default.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_60bf1f014c5845_22596856',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1ce6ef7eecaf9c21f6710bc6aa572c84f1e5aa39' => 
    array (
      0 => '/var/www/koseionline.vn/data/www/koseionline.vn/admin/templates/lesson/act_default.html',
      1 => 1616483392,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:_block_inner_head.html' => 1,
  ),
),false)) {
function content_60bf1f014c5845_22596856 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:_block_inner_head.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
<form name="theForm" action="" method="post" id="theForm">
<table width="100%" border="0">
<tr>
<td style="padding:10px">
	<div style="font-size:14px; float:left; width:20%">
	<strong><?php echo $_smarty_tpl->tpl_vars['core']->value->getLang("ListOf");?>
 <?php echo $_smarty_tpl->tpl_vars['clsDataGrid']->value->getTitle();?>
</strong>
	</div>
	<div style="float:left; width:58%; text-align:center">
	<input type="text" value="<?php echo $_smarty_tpl->tpl_vars['skeyword']->value;?>
" name="skeyword" placeholder="<?php echo $_smarty_tpl->tpl_vars['core']->value->getLang('Keyword');?>
"/>
	<select name="scatid">
	<option value="">--- <?php echo $_smarty_tpl->tpl_vars['core']->value->getLang("Khóa học");?>
 ---</option>
	<?php echo $_smarty_tpl->tpl_vars['scatid_options']->value;?>

	</select>
	<input type="submit" value="<?php echo $_smarty_tpl->tpl_vars['core']->value->getLang('Search');?>
" name="searchBtn"/>
	</div>
	<div style="float:right;font-size:12px; width:20%; color:blue" align="right">
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
</form><?php }
}
