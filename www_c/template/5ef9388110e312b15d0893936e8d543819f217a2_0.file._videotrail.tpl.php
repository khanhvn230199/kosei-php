<?php
/* Smarty version 3.1.32, created on 2023-05-19 09:48:14
  from '/var/www/koseionline/data/www/koseionline.vn/themes/template/_blocks/_videotrail.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_6466e36ee27938_40999542',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '5ef9388110e312b15d0893936e8d543819f217a2' => 
    array (
      0 => '/var/www/koseionline/data/www/koseionline.vn/themes/template/_blocks/_videotrail.tpl',
      1 => 1671591002,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6466e36ee27938_40999542 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="row">
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['arrListTrailCategory']->value, 'lesson', false, 'i', 'name', array (
));
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['i']->value => $_smarty_tpl->tpl_vars['lesson']->value) {
?>
    <div class="col-md-4 col-6 videos_trail_category">
        <a class="lesson-3" href="<?php echo $_smarty_tpl->tpl_vars['Rewrite']->value->url_lesson($_smarty_tpl->tpl_vars['lesson']->value);?>
">
            <?php if ($_smarty_tpl->tpl_vars['lesson']->value['image']) {?>
            <img src="<?php echo $_smarty_tpl->tpl_vars['URL_UPLOADS']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['lesson']->value['image'];?>
" alt="<?php echo $_smarty_tpl->tpl_vars['lesson']->value['name'];?>
" />
            <?php } else { ?>
            <img src="<?php echo $_smarty_tpl->tpl_vars['URL_IMAGES']->value;?>
/nopic.png" alt="<?php echo $_smarty_tpl->tpl_vars['lesson']->value['name'];?>
" />
            <?php }?>
        </a>
    </div>
    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
</div><?php }
}
