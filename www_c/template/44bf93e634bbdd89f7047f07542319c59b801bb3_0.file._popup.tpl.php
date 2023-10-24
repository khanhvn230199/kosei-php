<?php
/* Smarty version 3.1.32, created on 2022-12-30 11:40:17
  from '/var/www/koseionline/data/www/koseionline.vn/themes/template/_adver/_popup.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_63ae6bb17bde48_24171491',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '44bf93e634bbdd89f7047f07542319c59b801bb3' => 
    array (
      0 => '/var/www/koseionline/data/www/koseionline.vn/themes/template/_adver/_popup.tpl',
      1 => 1672375212,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_63ae6bb17bde48_24171491 (Smarty_Internal_Template $_smarty_tpl) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['arrListAdver']->value, 'adver', false, 'i');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['i']->value => $_smarty_tpl->tpl_vars['adver']->value) {
?>
<div class="md-video md-video-<?php echo $_smarty_tpl->tpl_vars['i']->value+1;?>
 modal fade" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body md-video__body">
                <button class="md-video__close" data-dismiss="modal"></button>
                <a href="<?php echo $_smarty_tpl->tpl_vars['adver']->value['link'];?>
"><img class="d-block w-100" src="<?php echo $_smarty_tpl->tpl_vars['URL_UPLOADS']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['adver']->value['image'];?>
" alt="<?php echo $_smarty_tpl->tpl_vars['adver']->value['title'];?>
" /></a>
            </div>
        </div>
    </div>
</div>
<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
}
}
