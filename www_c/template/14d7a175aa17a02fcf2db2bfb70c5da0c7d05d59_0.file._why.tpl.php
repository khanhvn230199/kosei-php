<?php
/* Smarty version 3.1.32, created on 2023-05-29 09:28:02
  from '/var/www/koseionline/data/www/koseionline.vn/themes/template/_adver/_why.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_64740db2517cd2_83156881',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '14d7a175aa17a02fcf2db2bfb70c5da0c7d05d59' => 
    array (
      0 => '/var/www/koseionline/data/www/koseionline.vn/themes/template/_adver/_why.tpl',
      1 => 1685327209,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_64740db2517cd2_83156881 (Smarty_Internal_Template $_smarty_tpl) {
?><section class="section-2 bg-light whyChooseUs">
    <div class="container">
        <div class="section-tile-container text-center mb-5">
            <h2 class="section-title"><span>Tại sao nên chọn khóa học tiếng Nhật ở Kosei</span></h2>
        </div>
        <div class="row">
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['arrListAdver']->value, 'adver', false, 'j');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['j']->value => $_smarty_tpl->tpl_vars['adver']->value) {
?>
            <div class="col-md-6 col-lg-3 mb-4">
                <div class="whyChooseUs-item">
                    <div class="whyChooseUs-title"><?php echo $_smarty_tpl->tpl_vars['adver']->value['title'];?>
</div>
                    <div class="whyChooseUs-icon"><img src="<?php echo $_smarty_tpl->tpl_vars['URL_UPLOADS']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['adver']->value['image'];?>
" alt="<?php echo $_smarty_tpl->tpl_vars['adver']->value['title'];?>
"></div>
                    <div class="box-text">
                        <?php echo htmlDecode($_smarty_tpl->tpl_vars['adver']->value['des']);?>

                    </div>
                </div>
            </div>
            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        </div>
    </div>
    <div class="aside-2__body py-3 text-center">
        <a class="button" href="https://m.me/111871621739031?ref=koseionline-vn">Nhận tư vấn ngay</a>
    </div>
</section><?php }
}
