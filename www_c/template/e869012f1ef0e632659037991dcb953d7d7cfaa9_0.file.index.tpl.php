<?php
/* Smarty version 3.1.32, created on 2023-05-19 10:35:31
  from '/var/www/koseionline/data/www/koseionline.vn/themes/template/trialtest/index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_6466ee83200119_18061252',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e869012f1ef0e632659037991dcb953d7d7cfaa9' => 
    array (
      0 => '/var/www/koseionline/data/www/koseionline.vn/themes/template/trialtest/index.tpl',
      1 => 1670384118,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:notfound.tpl' => 3,
  ),
),false)) {
function content_6466ee83200119_18061252 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['sub']->value != "default") {?>
	<?php if ($_smarty_tpl->tpl_vars['core']->value->template_exists(((string)$_smarty_tpl->tpl_vars['mod']->value)."/".((string)$_smarty_tpl->tpl_vars['sub']->value).".default.tpl")) {?>
		<?php if ($_smarty_tpl->tpl_vars['act']->value != "default") {?>
			<?php if ($_smarty_tpl->tpl_vars['core']->value->template_exists(((string)$_smarty_tpl->tpl_vars['mod']->value)."/".((string)$_smarty_tpl->tpl_vars['sub']->value).".".((string)$_smarty_tpl->tpl_vars['act']->value).".tpl")) {?>
				<?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['mod']->value)."/".((string)$_smarty_tpl->tpl_vars['sub']->value).".".((string)$_smarty_tpl->tpl_vars['act']->value).".tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
			<?php } else { ?>
				<?php $_smarty_tpl->_assignInScope('content', "Action File not Found!");?>
				<?php $_smarty_tpl->_subTemplateRender("file:notfound.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
			<?php }?>
		<?php } else { ?>	
			<?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['mod']->value)."/".((string)$_smarty_tpl->tpl_vars['sub']->value).".default.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
		<?php }?>				
	<?php } else { ?>
		<?php $_smarty_tpl->_assignInScope('content', "Sub Module File not Found!");?>
		<?php $_smarty_tpl->_subTemplateRender("file:notfound.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
	<?php }
} else { ?>
	<?php if ($_smarty_tpl->tpl_vars['act']->value != "default") {?>
		<?php if ($_smarty_tpl->tpl_vars['core']->value->template_exists(((string)$_smarty_tpl->tpl_vars['mod']->value)."/act_".((string)$_smarty_tpl->tpl_vars['act']->value).".tpl")) {?>
			<?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['mod']->value)."/act_".((string)$_smarty_tpl->tpl_vars['act']->value).".tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
		<?php } else { ?>
			<?php $_smarty_tpl->_assignInScope('content', "Action File not Found!");?>
			<?php $_smarty_tpl->_subTemplateRender("file:notfound.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
		<?php }?>
	<?php } else { ?>
		<?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['mod']->value)."/act_default.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
	<?php }
}
}
}
