<?php
/* Smarty version 3.1.32, created on 2023-07-27 09:26:48
  from '/var/www/koseionline/data/www/koseionline.vn/admin/templates/settings/act_editlang.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_64c1d5e8d9c1b1_65028472',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ba3426b4269a737f03fe28afb49aa4471213057a' => 
    array (
      0 => '/var/www/koseionline/data/www/koseionline.vn/admin/templates/settings/act_editlang.html',
      1 => 1670384086,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_64c1d5e8d9c1b1_65028472 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/var/www/koseionline/data/www/koseionline.vn/includes/smarty3/plugins/function.counter.php','function'=>'smarty_function_counter',),));
echo $_smarty_tpl->tpl_vars['clsForm']->value->showJS();?>

<div class="inner_head_title">
<table cellpadding="0" cellspacing="0" width="100%" border="0">
<tr style="background:#FBFBFB">
	<td width="55px" style="padding:5px;">
		<a href="?mod=<?php echo $_smarty_tpl->tpl_vars['mod']->value;?>
&act=<?php echo $_smarty_tpl->tpl_vars['act']->value;?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['ADMIN_URL_IMAGES']->value;?>
/largeicon/icon_lamp.png" border="0"/></a>
	</td>
	<td>
		<span class="title1">Chỉnh sửa ngôn ngữ</span><br />
		<span class="title2">Chỉnh sửa ngôn ngữ (<?php echo $_smarty_tpl->tpl_vars['lang_code_name']->value;?>
)</span>
	</td>
	<td style="padding:5px;" align="right">
		<?php echo $_smarty_tpl->tpl_vars['clsButtonNav']->value->render();?>
		
	</td>
</tr>
</table>
</div>
<form name="theForm" action="" method="post" id="theForm">
<input type='hidden' name='btnSave' id='btnSave' value=''>
<table width="100%" border="0">
<tr>
<td style="padding:10px" width="100%" valign="top">
	<table cellpadding="0" cellspacing="0" width="100%" border="0" class="girdtable">
	<tr>
		<td colspan="3" class="gridheader1">Sửa lại ngôn ngữ "<?php echo $_smarty_tpl->tpl_vars['lang_code_name']->value;?>
"</td>
	</tr>
	<tr>
		<th class="gridrow" width="5%">STT</th>
		<th class="gridrow" width="30%">KEY</th>
		<th class="gridrow1">GIÁ TRỊ / VALUE</th>
	</tr>
	<?php echo smarty_function_counter(array('start'=>0,'print'=>false),$_smarty_tpl);?>

	<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['arrLang']->value, 'val', false, 'k');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['val']->value) {
?>
	<?php if ($_smarty_tpl->tpl_vars['k']->value != 'AAAA') {?>
	<tr>
		<td class="gridrow" width="5%"><?php echo smarty_function_counter(array(),$_smarty_tpl);?>
</td>
		<td class="gridrow" width="30%"><?php echo $_smarty_tpl->tpl_vars['k']->value;?>
</td>
		<td class="gridrow1"><input type="text" name="lang[<?php echo $_smarty_tpl->tpl_vars['k']->value;?>
]" value="<?php echo $_smarty_tpl->tpl_vars['arrValue']->value[$_smarty_tpl->tpl_vars['k']->value];?>
"></td>
	</tr>
	<?php }?>
	<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
	</table>
</td>
</tr>
</table>
</form><?php }
}
