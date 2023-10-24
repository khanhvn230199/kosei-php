<?php
/* Smarty version 3.1.32, created on 2021-06-08 13:54:06
  from '/var/www/koseionline.vn/data/www/koseionline.vn/themes/template/_blocks/_mock_exam.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_60bf140e089127_76322489',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1560dca592f42cf15a7bc8ac6b1b7c57cb355dff' => 
    array (
      0 => '/var/www/koseionline.vn/data/www/koseionline.vn/themes/template/_blocks/_mock_exam.tpl',
      1 => 1618904766,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60bf140e089127_76322489 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['arrOneLatestTest']->value) {?>
    <div class="md-welcome modal fade" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <button class="md-welcome__close" type="button" data-dismiss="modal">
                        <img src="<?php echo $_smarty_tpl->tpl_vars['URL_IMAGES']->value;?>
/close-btn.png" alt="close" />
                    </button>
                    <a href="<?php echo $_smarty_tpl->tpl_vars['Rewrite']->value->url_trialtestregister();?>
">
                        <img src="<?php echo $_smarty_tpl->tpl_vars['URL_UPLOADS']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['arrOneLatestTest']->value['image'];?>
" alt="<?php echo $_smarty_tpl->tpl_vars['arrOneLatestTest']->value['name'];?>
" />
                    </a>
                </div>
            </div>
        </div>
    </div>
<?php }
}
}
