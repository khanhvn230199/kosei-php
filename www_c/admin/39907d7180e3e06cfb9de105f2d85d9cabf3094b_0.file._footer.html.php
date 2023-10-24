<?php
/* Smarty version 3.1.32, created on 2023-05-19 09:55:48
  from '/var/www/koseionline/data/www/koseionline.vn/admin/templates/_footer.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_6466e534cbad42_16023178',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '39907d7180e3e06cfb9de105f2d85d9cabf3094b' => 
    array (
      0 => '/var/www/koseionline/data/www/koseionline.vn/admin/templates/_footer.html',
      1 => 1670384055,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6466e534cbad42_16023178 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/var/www/koseionline/data/www/koseionline.vn/includes/smarty3/plugins/modifier.date_format.php','function'=>'smarty_modifier_date_format',),));
?><div id="footer">
<table width="100%" cellpadding="5" cellspacing="0" border="0">
<tr>
	<td class="footer" align="left">
	&copy; 2013-<?php echo smarty_modifier_date_format(time(),'%Y');?>
 Copyright by <?php echo $_smarty_tpl->tpl_vars['_CONFIG']->value['site_name'];?>
.,
	</td>
	<td class="footer" align="right">[Your IP:<?php echo $_smarty_tpl->tpl_vars['core']->value->_REMOTE_ADDR;?>
]&nbsp;</td>
</tr>
</table>
</div><?php }
}
