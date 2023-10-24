<?php
/* Smarty version 3.1.32, created on 2021-06-08 13:55:33
  from '/var/www/koseionline.vn/data/www/koseionline.vn/themes/template/account/index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_60bf1465c025b3_02309060',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8f89b5db5bb724086bc7a0104fb15e79603c8104' => 
    array (
      0 => '/var/www/koseionline.vn/data/www/koseionline.vn/themes/template/account/index.tpl',
      1 => 1618904756,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:notfound.tpl' => 3,
  ),
),false)) {
function content_60bf1465c025b3_02309060 (Smarty_Internal_Template $_smarty_tpl) {
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
