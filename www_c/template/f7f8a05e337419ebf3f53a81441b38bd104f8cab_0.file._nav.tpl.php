<?php
/* Smarty version 3.1.32, created on 2021-06-09 09:45:21
  from '/var/www/koseionline.vn/data/www/koseionline.vn/themes/template/_nav.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_60c02b41e5e7c2_84222706',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f7f8a05e337419ebf3f53a81441b38bd104f8cab' => 
    array (
      0 => '/var/www/koseionline.vn/data/www/koseionline.vn/themes/template/_nav.tpl',
      1 => 1623206717,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60c02b41e5e7c2_84222706 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/var/www/koseionline.vn/data/www/koseionline.vn/includes/smarty3/plugins/modifier.lang.php','function'=>'smarty_modifier_lang',),));
?><ul class="menu">
    <li class="menu__item">
        <a class="menu__link" href="<?php echo $_smarty_tpl->tpl_vars['VNCMS_URL']->value;?>
"><?php echo smarty_modifier_lang('Home');?>
</a>
    </li>
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['arrListMainMenu']->value, 'menu', false, 'm');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['m']->value => $_smarty_tpl->tpl_vars['menu']->value) {
?>
    <li class="menu__item <?php if ($_smarty_tpl->tpl_vars['menu']->value['children']) {?>menu__dropdown<?php }?>">
        <a class="menu__link" href="<?php echo $_smarty_tpl->tpl_vars['menu']->value['href'];?>
"><?php echo $_smarty_tpl->tpl_vars['menu']->value['title'];?>
</a>
        <ul class="menu__sub">
            <?php if ($_smarty_tpl->tpl_vars['menu']->value['children']) {?>
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['menu']->value['children'], 'children', false, 'c1');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['c1']->value => $_smarty_tpl->tpl_vars['children']->value) {
?>
            <li class="menu__sub-item">
                <a class="menu__sub-link" href="<?php echo $_smarty_tpl->tpl_vars['children']->value['href'];?>
"><?php echo $_smarty_tpl->tpl_vars['children2']->value['title'];?>
</a>
            </li>
            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            <?php }?>
        </ul>
    </li>
    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
</ul>
<?php }
}
