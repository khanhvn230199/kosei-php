<?php
/* Smarty version 3.1.32, created on 2023-05-19 09:47:32
  from '/var/www/koseionline/data/www/koseionline.vn/themes/template/_adver/_customer_reviews.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_6466e3440c10a1_34392957',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6096fe314e025a5e0cf511f85b75b86998e1100f' => 
    array (
      0 => '/var/www/koseionline/data/www/koseionline.vn/themes/template/_adver/_customer_reviews.tpl',
      1 => 1670384119,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6466e3440c10a1_34392957 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/var/www/koseionline/data/www/koseionline.vn/includes/smarty3/plugins/modifier.lang.php','function'=>'smarty_modifier_lang',),1=>array('file'=>'/var/www/koseionline/data/www/koseionline.vn/includes/smarty3/plugins/modifier.truncate.php','function'=>'smarty_modifier_truncate',),));
if ($_smarty_tpl->tpl_vars['arrListAdver']->value) {?>
<section class="section-2 bg-light">
    <div class="container">
        <h2 class="section-2__title"><span><?php echo smarty_modifier_lang('Actual_results');?>
</span><img src="<?php echo $_smarty_tpl->tpl_vars['URL_IMAGES']->value;?>
/icon-jp-country-shape.png" alt=""></h2>
        <div class="testimonial-slider">
            <div class="testimonial-slider__pagination"></div>
            <div class="testimonial-slider__container swiper-container">
                <div class="swiper-wrapper">
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['arrListAdver']->value, 'adver', false, 'k');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['adver']->value) {
?>
                    <div class="swiper-slide">
                        <div class="testimonial">
                            <div class="testimonial__avatar"><img src="<?php echo $_smarty_tpl->tpl_vars['URL_UPLOADS']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['adver']->value['image'];?>
" alt="" />
                            </div>
                            <div class="testimonial__body">
                                <div class="media align-items-center mb-3"><img class="testimonial__icon" src="<?php echo $_smarty_tpl->tpl_vars['URL_IMAGES']->value;?>
/icon-double-quote-open.png" alt="" />
                                    <div class="media-body">
                                        <div class="testimonial__name"><?php echo $_smarty_tpl->tpl_vars['adver']->value['title'];?>
</div>
                                        <div class="testimonial__addr"><?php echo $_smarty_tpl->tpl_vars['adver']->value['occupations'];?>
</div>
                                    </div>
                                </div>
                                <div class="text-italic">“ <?php echo smarty_modifier_truncate(preg_replace('!<[^>]*?>!', ' ', htmlDecode($_smarty_tpl->tpl_vars['adver']->value['des'])),650,"...");?>
. ”</div>
                            </div>
                        </div>
                    </div>
                    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php }
}
}
