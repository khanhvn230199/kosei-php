<?php
/* Smarty version 3.1.32, created on 2023-05-20 14:54:41
  from '/var/www/koseionline/data/www/koseionline.vn/themes/template/_adver/_branch.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_64687cc12cae29_16943306',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4dc532a89bfb1db102457021bc7e62ff2a305638' => 
    array (
      0 => '/var/www/koseionline/data/www/koseionline.vn/themes/template/_adver/_branch.tpl',
      1 => 1670384119,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_64687cc12cae29_16943306 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/var/www/koseionline/data/www/koseionline.vn/includes/smarty3/plugins/modifier.lang.php','function'=>'smarty_modifier_lang',),));
if ($_smarty_tpl->tpl_vars['arrListAdver']->value) {?>
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['arrListAdver']->value, 'adver', false, 'k');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['adver']->value) {
?>
        <div class="ct-info__map embed-responsive">
            <?php echo htmlDecode($_smarty_tpl->tpl_vars['adver']->value['embed']);?>

        </div>
        <div class="ct-info__map-label">
            <strong><?php echo smarty_modifier_lang('Base');?>
 <?php echo $_smarty_tpl->tpl_vars['k']->value+1;?>
:</strong>
            <span><?php echo $_smarty_tpl->tpl_vars['adver']->value['title'];?>
</span>
        </div>
    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
}
}
}
