<?php
/* Smarty version 3.1.32, created on 2023-05-19 09:47:24
  from '/var/www/koseionline/data/www/koseionline.vn/themes/template/lessons/index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_6466e33c244523_33243309',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2ce438cc5e1fa780f77f2a17bca162f63b45ea96' => 
    array (
      0 => '/var/www/koseionline/data/www/koseionline.vn/themes/template/lessons/index.tpl',
      1 => 1670384118,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:notfound.tpl' => 3,
  ),
),false)) {
function content_6466e33c244523_33243309 (Smarty_Internal_Template $_smarty_tpl) {
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
