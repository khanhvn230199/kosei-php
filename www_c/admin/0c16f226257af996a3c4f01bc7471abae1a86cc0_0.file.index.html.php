<?php
/* Smarty version 3.1.32, created on 2022-05-28 13:41:26
  from '/var/www/koseionline.vn/data/www/koseionline.vn/admin/templates/promotion/index.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_6291c41667a921_68900615',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0c16f226257af996a3c4f01bc7471abae1a86cc0' => 
    array (
      0 => '/var/www/koseionline.vn/data/www/koseionline.vn/admin/templates/promotion/index.html',
      1 => 1616483392,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6291c41667a921_68900615 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['sub']->value != "default") {?>
	<?php if ($_smarty_tpl->tpl_vars['core']->value->template_exists(((string)$_smarty_tpl->tpl_vars['mod']->value)."/sub_".((string)$_smarty_tpl->tpl_vars['sub']->value).".html")) {?>
		<?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['mod']->value)."/sub_".((string)$_smarty_tpl->tpl_vars['sub']->value).".html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
	<?php } else { ?>
		Sub Module File not Found!
	<?php }
} else { ?>
	<?php if ($_smarty_tpl->tpl_vars['act']->value != "default") {?>
		<?php if ($_smarty_tpl->tpl_vars['core']->value->template_exists(((string)$_smarty_tpl->tpl_vars['mod']->value)."/act_".((string)$_smarty_tpl->tpl_vars['act']->value).".html")) {?>
			<?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['mod']->value)."/act_".((string)$_smarty_tpl->tpl_vars['act']->value).".html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>	
		<?php } else { ?>
			Action File not Found!
		<?php }?>
	<?php } else { ?>
		<?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['mod']->value)."/act_default.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
	<?php }
}
}
}
