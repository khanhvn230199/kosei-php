<?php
/* Smarty version 3.1.32, created on 2021-06-08 14:17:43
  from '/var/www/koseionline.vn/data/www/koseionline.vn/admin/templates/_footer.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_60bf199770f8a5_75870054',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f7549cc376a3af37be088c22ee06330aad508801' => 
    array (
      0 => '/var/www/koseionline.vn/data/www/koseionline.vn/admin/templates/_footer.html',
      1 => 1616482970,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60bf199770f8a5_75870054 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/var/www/koseionline.vn/data/www/koseionline.vn/includes/smarty3/plugins/modifier.date_format.php','function'=>'smarty_modifier_date_format',),));
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
