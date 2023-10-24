<?php
/* Smarty version 3.1.32, created on 2021-06-08 14:13:47
  from '/var/www/koseionline.vn/data/www/koseionline.vn/themes/template/_adver/_branch.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_60bf18ab0bed19_56317257',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b3f2ec2d284d7010fd89cc4872667d833050d853' => 
    array (
      0 => '/var/www/koseionline.vn/data/www/koseionline.vn/themes/template/_adver/_branch.tpl',
      1 => 1618904766,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60bf18ab0bed19_56317257 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/var/www/koseionline.vn/data/www/koseionline.vn/includes/smarty3/plugins/modifier.lang.php','function'=>'smarty_modifier_lang',),));
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
