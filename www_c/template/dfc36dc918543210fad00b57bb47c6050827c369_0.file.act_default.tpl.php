<?php
/* Smarty version 3.1.32, created on 2021-06-11 18:08:21
  from '/var/www/koseionline.vn/data/www/koseionline.vn/themes/template/lessons/act_default.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_60c34425eac031_69351387',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'dfc36dc918543210fad00b57bb47c6050827c369' => 
    array (
      0 => '/var/www/koseionline.vn/data/www/koseionline.vn/themes/template/lessons/act_default.tpl',
      1 => 1623409699,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:_blocks/_payment-form.tpl' => 3,
    'file:_blocks/_lesson-cats.tpl' => 2,
    'file:_blocks/_lesson-search.tpl' => 1,
  ),
),false)) {
function content_60c34425eac031_69351387 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/var/www/koseionline.vn/data/www/koseionline.vn/includes/smarty3/plugins/modifier.lang.php','function'=>'smarty_modifier_lang',),1=>array('file'=>'/var/www/koseionline.vn/data/www/koseionline.vn/includes/smarty3/plugins/modifier.replace.php','function'=>'smarty_modifier_replace',),2=>array('file'=>'/var/www/koseionline.vn/data/www/koseionline.vn/includes/smarty3/plugins/modifier.date_format.php','function'=>'smarty_modifier_date_format',),));
?><div class="container py-30">
  <div class="row">
    <div class="col-lg-8 mb-30">
      <button class="float-sidebar-btn js-float-sidebar-open text-700" data-target="#float-sidebar-1"><i class="fa fa-bars mr-2"></i>Bài học</button>

      <?php if ($_smarty_tpl->tpl_vars['video']->value) {?>
        <?php if ($_smarty_tpl->tpl_vars['video']->value['attachment']) {?>
          <?php $_smarty_tpl->_assignInScope('file_type', pathinfo($_smarty_tpl->tpl_vars['video']->value['attachment'],@constant('PATHINFO_EXTENSION')));?>

          <?php if ($_smarty_tpl->tpl_vars['file_type']->value == "mp4") {?>
            <div class="embed-responsive embed-responsive-16by9">
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
          <div class="embed-responsive embed-responsive-16by9">
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

      <ul class="nav n-tabs mt-20" data-payment-status="<?php echo $_smarty_tpl->tpl_vars['paymentStatus']->value['status'];?>
" data-expired="<?php echo $_smarty_tpl->tpl_vars['paymentStatus']->value['expired'];?>
">
        <li class="nav-item">
          <a class="nav-link active js-course-intro-tab" href="#detail-tab-1" data-toggle="tab">
            <img class="n-tabs__bg" src="<?php echo $_smarty_tpl->tpl_vars['URL_IMAGES']->value;?>
/n-tab-link-bg.png" alt="">
            <span>Giới thiệu</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link js-course-intro-tab" href="#detail-tab-2" data-toggle="tab">
            <img class="n-tabs__bg" src="<?php echo $_smarty_tpl->tpl_vars['URL_IMAGES']->value;?>
/n-tab-link-bg.png" alt="">
            <?php if ($_smarty_tpl->tpl_vars['paymentStatus']->value) {?>
              <span>Thông tin đăng ký</span>
            <?php } else { ?>
              <span>Đăng ký khoá học</span>
            <?php }?>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link n-tabs__btn js-course-intro-tab" href="#detail-tab-3" data-toggle="tab">
            <img class="n-tabs__bg" src="<?php echo $_smarty_tpl->tpl_vars['URL_IMAGES']->value;?>
/n-tab-link-bg.png" alt="">
            <span>Bài học</span>
          </a>
        </li>
      </ul>

      <div class="n-tabs-content n-tabs-content--custom">
        <div class="tab-content">
          <div class="tab-pane fade show active" id="detail-tab-1">

            <div class="expandable" data-height="300">
              <div class="expandable__content">
                <?php echo htmlDecode($_smarty_tpl->tpl_vars['curCat']->value['detail']);?>

              </div>
              <div class="expandable__footer">
                <a class="expandable__toggle" href="#!" data-label-expand="Xem thêm" data-label-collapse="Thu gọn"></a>
              </div>
            </div>

          </div>

          <div class="tab-pane fade" id="detail-tab-2">
            <?php if ($_smarty_tpl->tpl_vars['isLogin']->value != 1) {?>
              <div class="alert alert-danger mb-0">
                <i class="fa fa-exclamation-circle mr-2"></i>
                Vui lòng <a class="text-danger text-700" href=".md-login" data-toggle="modal">đăng nhập</a> để thực hiện chức năng này!
              </div>
            <?php } elseif (!$_smarty_tpl->tpl_vars['paymentStatus']->value) {?>
              <?php $_smarty_tpl->_subTemplateRender("file:_blocks/_payment-form.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
            <?php } elseif ($_smarty_tpl->tpl_vars['paymentStatus']->value['status'] != '2') {?>
              <?php if ($_smarty_tpl->tpl_vars['paymentStatus']->value['combo_link']) {?>
                <div class="alert alert-warning">
                  <i class="fa fa-exclamation-circle mr-2"></i>
                  Bạn đã đăng ký <a class="text-700 text-primary" href="<?php echo $_smarty_tpl->tpl_vars['paymentStatus']->value['combo_link'];?>
"><?php echo $_smarty_tpl->tpl_vars['paymentStatus']->value['name'];?>
</a> nhưng chưa thanh toán.
                  <br>
                  Bạn có thể thực hiện thanh toán combo khoá học trên hoặc đăng ký khoá học này:
                </div>
                <?php $_smarty_tpl->_subTemplateRender("file:_blocks/_payment-form.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
              <?php } else { ?>
                <div class="alert alert-warning mb-0">
                  <i class="fa fa-exclamation-circle mr-2"></i>
                  Bạn đã đăng ký khoá học này nhưng chưa thanh toán.
                  <br>
                  Vui lòng <a class="text-700 text-primary" href="#payment-banking" data-toggle="collapse">thanh toán qua ngân hàng</a> hoặc <a class="text-700 text-primary" href="#payment-cash" data-toggle="collapse">thanh toán trực tiếp tại Kosei</a> để để kích hoạt khoá học.
                  <br>
                  <strong>Note:</strong> Nếu bạn đã thanh toán nhưng chưa kích hoạt khoá học. Vui lòng liên hệ lại với chúng tôi để nhận được sự hỗ trợ.
                </div>

                <div class="js-payment-info pt-3 collapse" id="payment-banking">
                  <div class="alert alert-info mb-0">
                    <div class="mb-12">
                      <strong class="text-danger"><?php echo smarty_modifier_lang('Transferring_content');?>
:</strong><br>
                      <kbd class="ml-0"><?php echo smarty_modifier_replace($_smarty_tpl->tpl_vars['core']->value->callfunc('utf8_nosign',$_smarty_tpl->tpl_vars['curCat']->value['name']),'tieng Nhat ','');?>
_<?php echo $_smarty_tpl->tpl_vars['core']->value->_USER['user_name'];?>
_<?php echo $_smarty_tpl->tpl_vars['core']->value->_USER['mobile'];?>
</kbd>
                    </div>
                    <?php if ($_smarty_tpl->tpl_vars['bankAccounts']->value) {?>
                      <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['bankAccounts']->value, 'bank', false, 'key', 'name', array (
));
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['bank']->value) {
?>
                        <div class="mb-12 m-last-0">
                          <div class="text-700"><?php echo $_smarty_tpl->tpl_vars['bank']->value['name'];?>
</div>
                          <div>Chủ tài khoản: <strong><?php echo $_smarty_tpl->tpl_vars['bank']->value['account_holder'];?>
</strong></div>
                          <div>Số tài khoản: <strong><?php echo $_smarty_tpl->tpl_vars['bank']->value['account_number'];?>
</strong></div>
                        </div>
                      <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    <?php }?>
                  </div>
                </div>

                <div class="js-payment-info pt-3 collapse" id="payment-cash">
                  <div class="alert alert-info mb-0">
                    <?php if ($_smarty_tpl->tpl_vars['locations']->value) {?>
                      <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['locations']->value, 'location', false, 'key', 'name', array (
));
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['location']->value) {
?>
                        <div class="mb-12 m-last-0"><strong>Cơ sở <?php echo $_smarty_tpl->tpl_vars['key']->value+1;?>
:</strong> <?php echo $_smarty_tpl->tpl_vars['location']->value['name'];?>
</div>
                      <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    <?php }?>
                  </div>
                </div>
              <?php }?>
            <?php } elseif ($_smarty_tpl->tpl_vars['paymentStatus']->value['status'] == '2' && $_smarty_tpl->tpl_vars['paymentStatus']->value['expired']) {?>
              <div class="alert alert-danger">
                <i class="fa fa-exclamation-circle mr-2"></i>
                Đăng ký của bạn đã hết hạn vào ngày <strong><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['paymentStatus']->value['expired_time'],"%d/%m/%Y");?>
</strong>.
                <br>
                Bạn có thể đăng ký lại để tiếp tục tham gia khoá học.
              </div>
              <?php $_smarty_tpl->_subTemplateRender("file:_blocks/_payment-form.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
            <?php } elseif ($_smarty_tpl->tpl_vars['paymentStatus']->value['status'] == '2') {?>
              <div class="alert alert-success mb-0">
                <i class="fa fa-check-square-o mr-2"></i>
                Bạn đã đăng ký khoá học này! Thời hạn đến ngày <strong><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['paymentStatus']->value['expired_time'],"%d/%m/%Y");?>
</strong>
              </div>
            <?php }?>
          </div>

          <div class="tab-pane fade mobile-category" id="detail-tab-3">
            <?php $_smarty_tpl->_subTemplateRender("file:_blocks/_lesson-cats.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('prev'=>"inner",'hideSection'=>true), 0, false);
?>
          </div>
        </div>
      </div>

    </div>

    <div class="col-lg-4 mb-30">
      <?php $_smarty_tpl->_subTemplateRender("file:_blocks/_lesson-search.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

      <?php if ($_smarty_tpl->tpl_vars['curCat']->value['introductions']) {?>
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
      <?php }?>

      <?php if ($_smarty_tpl->tpl_vars['bigQuestions']->value) {?>
        <section class="aside-2 mb-20">
          <h2 class="aside-2__title">Test đầu vào</h2>
          <div class="aside-2__body py-3 text-center">
            <a class="button" href="<?php echo $_smarty_tpl->tpl_vars['Rewrite']->value->url_category($_smarty_tpl->tpl_vars['curCat']->value);?>
?test=1">TEST ĐẦU VÀO</a>
          </div>
        </section>
      <?php }?>

      <div class="d-none d-xl-block">
        <?php $_smarty_tpl->_subTemplateRender("file:_blocks/_lesson-cats.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('prev'=>"aside"), 0, true);
?>
      </div>
    </div>
  </div>

  <div class="fb-comments" data-href="<?php echo $_smarty_tpl->tpl_vars['Rewrite']->value->url_category($_smarty_tpl->tpl_vars['curCat']->value);?>
" data-width="100%" data-numposts="5"></div>
</div>
<?php }
}
