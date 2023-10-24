<?php
/* Smarty version 3.1.32, created on 2021-06-08 16:57:28
  from '/var/www/koseionline.vn/data/www/koseionline.vn/admin/templates/settings/index.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_60bf3f08e2b0b8_42829846',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c11567528a15c4f7dd56411d7807e07d6a301d81' => 
    array (
      0 => '/var/www/koseionline.vn/data/www/koseionline.vn/admin/templates/settings/index.html',
      1 => 1616483394,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60bf3f08e2b0b8_42829846 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['sub']->value != "default") {?>
	<?php if ($_smarty_tpl->tpl_vars['core']->value->template_exists(((string)$_smarty_tpl->tpl_vars['mod']->value)."/sub_".((string)$_smarty_tpl->tpl_vars['sub']->value).".html")) {?>
		<?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['mod']->value)."/sub_".((string)$_smarty_tpl->tpl_vars['sub']->value).".html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
	<?php } else { ?>
		Template Sub Module File not Found!
	<?php }
} else { ?>
	<?php if ($_smarty_tpl->tpl_vars['act']->value != "default") {?>
		<?php if ($_smarty_tpl->tpl_vars['core']->value->template_exists(((string)$_smarty_tpl->tpl_vars['mod']->value)."/act_".((string)$_smarty_tpl->tpl_vars['act']->value).".html")) {?>
			<?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['mod']->value)."/act_".((string)$_smarty_tpl->tpl_vars['act']->value).".html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>	
		<?php } else { ?>
			Template Action File not Found!
		<?php }?>
	<?php } else { ?>
		<?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['mod']->value)."/act_default.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
	<?php }
}
}
}
