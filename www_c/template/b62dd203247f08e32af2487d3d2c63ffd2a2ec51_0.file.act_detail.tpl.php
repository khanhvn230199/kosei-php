<?php
/* Smarty version 3.1.32, created on 2021-06-11 18:01:44
  from '/var/www/koseionline.vn/data/www/koseionline.vn/themes/template/lessons/act_detail.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_60c342981c4ff7_14540898',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b62dd203247f08e32af2487d3d2c63ffd2a2ec51' => 
    array (
      0 => '/var/www/koseionline.vn/data/www/koseionline.vn/themes/template/lessons/act_detail.tpl',
      1 => 1623409300,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:_blocks/_exercise.tpl' => 1,
    'file:_blocks/_lesson-cats.tpl' => 2,
    'file:_blocks/_lesson-search.tpl' => 1,
  ),
),false)) {
function content_60c342981c4ff7_14540898 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/var/www/koseionline.vn/data/www/koseionline.vn/includes/smarty3/plugins/modifier.lang.php','function'=>'smarty_modifier_lang',),));
?><div class="container py-30">
  <div class="row">
    <div class="col-lg-8 mb-30">
      <button class="float-sidebar-btn js-float-sidebar-open text-700" data-target="#float-sidebar-1"><i class="fa fa-bars mr-2"></i>Bài học</button>

      <?php if ($_smarty_tpl->tpl_vars['video']->value) {?>
        <?php if ($_smarty_tpl->tpl_vars['video']->value['requirement'] == 1) {?>
          <div class="js-login-required alert alert-danger mb-2">Bạn phải <a href=".md-login" class="text-700 text-danger" data-toggle="modal">đăng nhập</a> để xem được nội dung này</div>
        <?php } elseif ($_smarty_tpl->tpl_vars['video']->value['requirement'] == 2) {?>
          <div class="js-purchase-required alert alert-danger mb-2">Bạn phải <a href=".md-purchase-require" class="text-700 text-danger" data-toggle="modal">đăng ký khoá học</a> để xem được nội dung này</div>
        <?php }?>

        <?php if ($_smarty_tpl->tpl_vars['video']->value['attachment']) {?>
          <?php $_smarty_tpl->_assignInScope('file_type', pathinfo($_smarty_tpl->tpl_vars['video']->value['attachment'],@constant('PATHINFO_EXTENSION')));?>

          <?php if ($_smarty_tpl->tpl_vars['file_type']->value == "mp4") {?>
            <div class="embed-responsive embed-responsive-16by9" data-label="attachment">
              <video class="video-js embed-responsive-item" controls preload="auto" width="640" height="264" poster="<?php if ($_smarty_tpl->tpl_vars['video']->value['image']) {
echo $_smarty_tpl->tpl_vars['URL_UPLOADS']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['video']->value['image'];
} else {
echo $_smarty_tpl->tpl_vars['URL_UPLOADS']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['curCat']->value['image'];
}?>" data-setup="{}">
                <source src="<?php echo $_smarty_tpl->tpl_vars['URL_UPLOADS']->value;?>
/<?php echo rawurlencode($_smarty_tpl->tpl_vars['video']->value['attachment']);?>
" type="video/mp4">
                <p class="vjs-no-js">To view this video please enable JavaScript, and consider upgrading to a web browser that
                  <a href="https://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>
                </p>
              </video>
            </div>
          <?php } elseif ($_smarty_tpl->tpl_vars['file_type']->value == "mp3") {?>
            <audio preload="auto" controls class="js-audio">
              <source src="<?php echo $_smarty_tpl->tpl_vars['URL_UPLOADS']->value;?>
/<?php echo rawurlencode($_smarty_tpl->tpl_vars['lesson']->value['attachment']);?>
">
            </audio>
          <?php }?>
        <?php } elseif ($_smarty_tpl->tpl_vars['video']->value['arrStream']) {?>
          <div class="embed-responsive embed-responsive-16by9" data-label="arrStream">
            <video class="video-js embed-responsive-item" controls preload="auto" width="100%" height="100%" poster="<?php if ($_smarty_tpl->tpl_vars['lesson']->value['image']) {
echo $_smarty_tpl->tpl_vars['URL_UPLOADS']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['lesson']->value['image'];
} else {
echo $_smarty_tpl->tpl_vars['URL_UPLOADS']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['curCat']->value['image'];
}?>" data-setup="{}">
              <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['video']->value['arrStream'], 'stream', false, 's');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['s']->value => $_smarty_tpl->tpl_vars['stream']->value) {
?>
                <source src="<?php echo $_smarty_tpl->tpl_vars['stream']->value['url'];?>
" type="<?php echo $_smarty_tpl->tpl_vars['stream']->value['mime'];?>
" data-quality="<?php echo $_smarty_tpl->tpl_vars['stream']->value['qualityLabel'];?>
">
              <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
              <p class="vjs-no-js">To view this video please enable JavaScript, and consider upgrading to a web
                browser that
                <a href="https://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>
              </p>
            </video>
          </div>
        <?php } else { ?>
          <img class="d-block w-100" src="<?php if ($_smarty_tpl->tpl_vars['video']->value['image']) {
echo $_smarty_tpl->tpl_vars['URL_UPLOADS']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['video']->value['image'];
} else {
echo $_smarty_tpl->tpl_vars['URL_UPLOADS']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['curCat']->value['image'];
}?>" alt="<?php echo $_smarty_tpl->tpl_vars['video']->value['name'];?>
" onerror="this.src='<?php echo $_smarty_tpl->tpl_vars['URL_IMAGES']->value;?>
/nopic.png'" class="w-100">
        <?php }?>
      <?php }?>

      <div class="mt-10"></div>

      <?php if ($_smarty_tpl->tpl_vars['otherLessons']->value) {?>
        <div class="video-slider">
          <div class="video-slider__prev"><i class="fa fa-angle-left"></i></div>
          <div class="video-slider__next"><i class="fa fa-angle-right"></i></div>
          <div class="video-slider__container swiper-container">
            <div class="swiper-wrapper">
              <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['otherLessons']->value, 'item', false, 'i');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['i']->value => $_smarty_tpl->tpl_vars['item']->value) {
?>
                <div class="swiper-slide">
                  <a class="video-slider__frame <?php if ($_smarty_tpl->tpl_vars['item']->value['lesson_id'] == $_smarty_tpl->tpl_vars['lesson']->value['lesson_id']) {?>video-slider__frame--active<?php }?>" href="<?php echo $_smarty_tpl->tpl_vars['Rewrite']->value->url_lesson($_smarty_tpl->tpl_vars['item']->value);?>
">
                    <img src="<?php if ($_smarty_tpl->tpl_vars['item']->value['image']) {
echo $_smarty_tpl->tpl_vars['URL_UPLOADS']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['item']->value['image'];
} else {
echo $_smarty_tpl->tpl_vars['URL_UPLOADS']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['curCat']->value['image'];
}?>" alt="<?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
" />
                  </a>
                </div>
              <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            </div>
          </div>
        </div>
      <?php }?>

      <?php if ($_smarty_tpl->tpl_vars['bigQuestions']->value) {?>
        <button class="btn btn-danger btn-lg js-start-test mt-20" type="button"><?php echo smarty_modifier_lang('Finish');?>
</button>

        <article class="collapse js-test mt-20">
          <h2 class="vocab-page-title"><?php echo smarty_modifier_lang('Exercise');?>
</h2>
          <?php $_smarty_tpl->_subTemplateRender("file:_blocks/_exercise.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
        </article>
      <?php } else { ?>
        <div class="alert alert-info mt-2 mb-0"><i class="fa fa-info-circle mr-3"></i> Video này không có bài tập!</div>
      <?php }?>

      <div class="d-xl-none mobile-category mt-3">
        <?php $_smarty_tpl->_subTemplateRender("file:_blocks/_lesson-cats.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('prev'=>"inner"), 0, false);
?>
      </div>
    </div>

    <div class="col-lg-4 mb-30">

      <?php $_smarty_tpl->_subTemplateRender("file:_blocks/_lesson-search.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

      <section class="aside-2 mb-20">
        <h2 class="aside-2__title">Hướng dẫn trước khi học</h2>
        <div class="aside-2__body py-3">

          <div class="expandable" data-height="300">
            <div class="expandable__content">
                <?php echo htmlDecode($_smarty_tpl->tpl_vars['curCat']->value['instructions']);?>

            </div>
            <div class="expandable__footer"><a class="expandable__toggle" href="#!" data-label-expand="Xem thêm" data-label-collapse="Thu gọn"></a></div>
          </div>

        </div>
      </section>

      <div class="d-none d-xl-block">
        <?php $_smarty_tpl->_subTemplateRender("file:_blocks/_lesson-cats.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('prev'=>"aside"), 0, true);
?>
      </div>

    </div>
  </div>

  <div class="fb-comments" data-href="<?php echo $_smarty_tpl->tpl_vars['Rewrite']->value->url_lesson($_smarty_tpl->tpl_vars['lesson']->value);?>
" data-width="100%" data-numposts="5"></div>
</div>
<?php }
}
