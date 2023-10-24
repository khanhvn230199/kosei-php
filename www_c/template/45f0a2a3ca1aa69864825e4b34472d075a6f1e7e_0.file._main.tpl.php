<?php
/* Smarty version 3.1.32, created on 2022-12-14 16:10:56
  from '/var/www/koseionline/data/www/koseionline.vn/themes/template/_slider/_main.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_63999320118393_76633075',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '45f0a2a3ca1aa69864825e4b34472d075a6f1e7e' => 
    array (
      0 => '/var/www/koseionline/data/www/koseionline.vn/themes/template/_slider/_main.tpl',
      1 => 1671009051,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_63999320118393_76633075 (Smarty_Internal_Template $_smarty_tpl) {
?><!-- <?php if ($_smarty_tpl->tpl_vars['homeBanners']->value) {?>
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
 -->

 <?php if ($_smarty_tpl->tpl_vars['arrListSlider']->value) {?>
<div class="banner-slider">
    <!-- <img class="banner-slider__bg" src="<?php echo $_smarty_tpl->tpl_vars['URL_IMAGES']->value;?>
/banner-home.jpg" alt="" /> -->
    <div class="banner-slider__container swiper-container">
        <div class="swiper-wrapper">
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['arrListSlider']->value, 'slider', false, 'k');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['slider']->value) {
?>
            <div class="swiper-slide">
                <div class="banner">
                   <a href="<?php echo $_smarty_tpl->tpl_vars['slider']->value['vars']['t_url'];?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['URL_UPLOADS']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['slider']->value['image'];?>
" alt="" /></a> 
                </div>
            </div>
            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        </div>
    </div>
</div>
<?php }
}
}
