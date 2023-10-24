<?php
/* Smarty version 3.1.32, created on 2021-06-09 15:41:51
  from '/var/www/koseionline.vn/data/www/koseionline.vn/admin/templates/menu/act_default.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_60c07ecf253965_62612094',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '14993f8b8a9b38c96c6e1f14f5ab31cb1e8d2c4b' => 
    array (
      0 => '/var/www/koseionline.vn/data/www/koseionline.vn/admin/templates/menu/act_default.html',
      1 => 1616483392,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:_block_inner_head.html' => 1,
  ),
),false)) {
function content_60c07ecf253965_62612094 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:_block_inner_head.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
<form name="theForm" action="<?php if ($_GET['menu_id'] == '') {?>?mod=<?php echo $_smarty_tpl->tpl_vars['mod']->value;
}?>" method="post" id="theForm">
<table width="100%" border="0">
<tr>
<td style="padding:10px">
	<div style="font-size:14px; float:left">
	<strong><?php echo $_smarty_tpl->tpl_vars['core']->value->getLang("ListOf");?>
 <?php echo $_smarty_tpl->tpl_vars['clsDataGrid']->value->getTitle();?>
</strong>
	<select name="mtype" id="mtype" onchange="return submitform();">
	<?php echo $_smarty_tpl->tpl_vars['htmlOptionsMenu']->value;?>

	</select>	
	</div>
	<div style="float:right;font-size:12px; color:blue" align="right">
	Ngôn ngữ: <?php echo $_smarty_tpl->tpl_vars['lang_code_name']->value;?>

	</div>
</td>
</tr>
<tr>
	<td style="padding:0px 10px" width="100%" valign="top">
	<div class="navpath"><?php echo $_smarty_tpl->tpl_vars['core']->value->getLang("You_are_at");?>
: <?php echo $_smarty_tpl->tpl_vars['menuPathAdmin']->value;?>
</div>
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
