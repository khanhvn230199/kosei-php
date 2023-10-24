<?php
/* Smarty version 3.1.32, created on 2021-07-05 11:11:59
  from '/var/www/koseionline.vn/data/www/koseionline.vn/themes/template/_slider/_main.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_60e2868f83e501_16487811',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '441ad870e42f5d7eea68055435d627d26adba3fa' => 
    array (
      0 => '/var/www/koseionline.vn/data/www/koseionline.vn/themes/template/_slider/_main.tpl',
      1 => 1625458316,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60e2868f83e501_16487811 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['homeBanners']->value) {?>
  <div class="banner-slider"><img class="banner-slider__bg" src="<?php echo $_smarty_tpl->tpl_vars['URL_IMAGES']->value;?>
/banner-home.jpg" alt="" />
    <div class="banner-slider__container swiper-container">
      <div class="swiper-wrapper">
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['homeBanners']->value, 'banner', false, 'k');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['banner']->value) {
?>
          <div class="swiper-slide">
            <div class="banner">
              <div class="container h-100">
                <div class="banner__inner">
                  <div class="banner__body">
                    <h2 class="banner__title"><?php echo $_smarty_tpl->tpl_vars['banner']->value['title'];?>
</h2>
                    <div class="banner__content m-last-0">
                      <?php echo htmlDecode($_smarty_tpl->tpl_vars['banner']->value['des']);?>

                    </div>
                    <?php if ($_smarty_tpl->tpl_vars['banner']->value['link']) {?>
                      <a class="banner__btn button" href="<?php echo $_smarty_tpl->tpl_vars['banner']->value['link'];?>
">Học thử</a>
                    <?php }?>
                  </div>
                  <div class="banner__frame">
                    <?php if ($_smarty_tpl->tpl_vars['banner']->value['image']) {?>
                      <img src="<?php echo $_smarty_tpl->tpl_vars['URL_UPLOADS']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['banner']->value['image'];?>
" alt="" />
                    <?php } else { ?>
                      <img src="<?php echo $_smarty_tpl->tpl_vars['URL_IMAGES']->value;?>
/banner-img.png" alt="" />
                    <?php }?>
                  </div>
                </div>
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
<?php }?>

<?php }
}
