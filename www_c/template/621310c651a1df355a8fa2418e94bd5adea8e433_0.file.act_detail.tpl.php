<?php
/* Smarty version 3.1.32, created on 2023-07-27 14:40:19
  from '/var/www/koseionline/data/www/koseionline.vn/themes/template/lessons/act_detail.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_64c21f634a93b8_74545158',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '621310c651a1df355a8fa2418e94bd5adea8e433' => 
    array (
      0 => '/var/www/koseionline/data/www/koseionline.vn/themes/template/lessons/act_detail.tpl',
      1 => 1690443589,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:_blocks/_exercise.tpl' => 1,
    'file:_blocks/_resultexercise.tpl' => 1,
    'file:_blocks/_lesson-cats.tpl' => 3,
    'file:_blocks/_payment-form.tpl' => 3,
    'file:_blocks/_lesson-catsresult.tpl' => 2,
  ),
),false)) {
function content_64c21f634a93b8_74545158 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/var/www/koseionline/data/www/koseionline.vn/includes/smarty3/plugins/modifier.lang.php','function'=>'smarty_modifier_lang',),1=>array('file'=>'/var/www/koseionline/data/www/koseionline.vn/includes/smarty3/plugins/modifier.replace.php','function'=>'smarty_modifier_replace',),2=>array('file'=>'/var/www/koseionline/data/www/koseionline.vn/includes/smarty3/plugins/modifier.date_format.php','function'=>'smarty_modifier_date_format',),));
?><div class="container py-30">
    <div class="row">
        <div class="col-lg-8 mb-30">
            <h1 class="title-video" style="font-size: 20px;font-weight: bold;color: red">Video - <?php echo $_smarty_tpl->tpl_vars['lesson']->value['name'];?>
</h1>
            <button class="float-sidebar-btn js-float-sidebar-open text-700" data-target="#float-sidebar-1"><i class="fa fa-bars mr-2"></i>Bài học</button>
            <!-- Login để xem được bài học thử -->
            <?php if ($_smarty_tpl->tpl_vars['isLogin']->value == 1) {?>
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
}?>" data-setup="{}" id="lessionVideoPlayer">
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
" data-key="<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
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
            <!-- Lam bai tap -->
            <?php if ($_smarty_tpl->tpl_vars['lesson']->value['is_trial'] == 0) {?>
            <?php if ($_smarty_tpl->tpl_vars['paymentStatus']->value['status'] == 2) {?>
            <?php if ($_smarty_tpl->tpl_vars['paymentStatus']->value['status'] == 2 && $_smarty_tpl->tpl_vars['paymentStatus']->value['expired']) {?>
            <button class="btn btn-danger btn-lg mt-20" type="button">
                <a href=".md-purchase-require" class="text-700" data-toggle="modal" style="color: #fff"><?php echo smarty_modifier_lang('Finish');?>
</a>
            </button>
            <?php } else { ?>
            <button class="btn btn-danger btn-lg js-start-test mt-20" type="button"><?php echo smarty_modifier_lang('Finish');?>
</button>
            <?php }?>
            <?php }?>
            <?php } else { ?>
            <!-- Trường hợp có bài tập hoặc thử hoặc không học thử -->
            <button class="btn btn-danger btn-lg js-start-test mt-20" type="button"><?php echo smarty_modifier_lang('Finish');?>
</button>
            <?php if ($_smarty_tpl->tpl_vars['scores']->value) {?>
            <button class="btn btn-success btn-lg mt-20 js-show-resultexercise" type="button">Bạn đã làm bài này Điểm số: <?php echo $_smarty_tpl->tpl_vars['scores']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['total_question']->value;?>
 (<?php echo $_smarty_tpl->tpl_vars['scores']->value;?>
 câu/ <?php echo $_smarty_tpl->tpl_vars['total_question']->value;?>
 câu)</button><?php }?>
            <?php }?>
            <article class="collapse js-test mt-20" id="article_testing">
                <h2 class="vocab-page-title"><?php echo smarty_modifier_lang('Exercise');?>
</h2>
                <?php $_smarty_tpl->_subTemplateRender("file:_blocks/_exercise.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
            </article>
            <!-- Kết quả đã làm -->
            <article class="collapse js-resul-test mt-20" id="article_result" style="display:none">
                <h2 class="vocab-page-title"><?php echo smarty_modifier_lang('Exercise');?>
</h2>
                <?php $_smarty_tpl->_subTemplateRender("file:_blocks/_resultexercise.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
            </article>
            <!-- End -->
          
            <!-- End -->
            <div class="aside-2__body py-3 text-center" style="border:none;">
                <a class="button" href="<?php echo $_smarty_tpl->tpl_vars['social']->value['facebook'];?>
">Nhận tư vấn ngay</a>
            </div>
            <div class="mt-10"></div>
            <ul class="nav n-tabs mt-20" data-payment-status="<?php echo $_smarty_tpl->tpl_vars['paymentStatus']->value['status'];?>
" data-expired="<?php echo $_smarty_tpl->tpl_vars['paymentStatus']->value['expired'];?>
">
                <li class="nav-item">
                    <a class="nav-link js-course-intro-tab" href="#detail-tab-3" data-toggle="tab">
                        <img class="n-tabs__bg" src="<?php echo $_smarty_tpl->tpl_vars['URL_IMAGES']->value;?>
/n-tab-link-bg.png" alt="">
                        <span>Bài giảng học thử</span>
                    </a>
                </li>
                <?php if ($_smarty_tpl->tpl_vars['isLogin']->value != 1) {?>
                <?php } else { ?>
                <li class="nav-item">
                    <a class="nav-link js-course-intro-tab js-show-combo" href="#detail-tab-2" data-toggle="tab">
                        <img class="n-tabs__bg" src="<?php echo $_smarty_tpl->tpl_vars['URL_IMAGES']->value;?>
/n-tab-link-bg.png" alt="">
                        <?php if ($_smarty_tpl->tpl_vars['paymentStatus']->value) {?>
                        <span>Thông tin đăng ký</span>
                        <?php } else { ?>
                        <span>Mua khóa học này</span>
                        <?php }?>
                    </a>
                </li>
                <?php }?>
                <!-- End -->
            </ul>
            <div class="n-tabs-content n-tabs-content--custom">
                <div class="tab-content">
                    <div class="tab-pane fade mobile-category" id="detail-tab-3">
                        <!-- Video học thử -->
                        <div class="row">
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
                        </div>
                        <!-- <?php $_smarty_tpl->_subTemplateRender("file:_blocks/_lesson-cats.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('prev'=>"inner",'hideSection'=>true), 0, false);
?> -->
                        <div class="py-3 text-center">
                            <a class="button js-show-tab" href="#detail-tab-2">Mua khóa học này</a>
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
                </div>
            </div>
            <?php }?>
            <?php if ($_smarty_tpl->tpl_vars['bigQuestions']->value) {?>
            <?php } else { ?>
            <div class="alert alert-info mt-2 mb-0"><i class="fa fa-info-circle mr-3"></i> Video này không có bài tập!</div>
            <?php }?>
            <?php } else { ?>
            <div class="container">
                <div class="item_trail">
                    <div class="videotrail_tt">
                        <div class="js-login-required alert alert-danger mb-2">Bạn cầm <a href=".md-login" class="text-700 text-danger" data-toggle="modal">đăng nhập</a> để xem được nội dung này</div>
                    </div>
                    <ul class="h-links_video">
                        <li style="background: red;border: none;"><a href="/register" style="color:#fff">Đăng ký</a></li>
                        <li><a href=".md-login" data-toggle="modal">Đăng nhập</a></li>
                    </ul>
                </div>
                <h3 class="titlevideo">Video bài giảng thử</h3>
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
            </div>
            <!-- End -->
            <?php }?>
            <div class="d-xl-none mobile-category mt-3">
                <?php if ($_smarty_tpl->tpl_vars['paymentStatus']->value['status'] == 2) {?>
                <?php $_smarty_tpl->_subTemplateRender("file:_blocks/_lesson-catsresult.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('prev'=>"inner"), 0, false);
?>
                <?php } else { ?>
                <?php $_smarty_tpl->_subTemplateRender("file:_blocks/_lesson-cats.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('prev'=>"inner"), 0, true);
?>
                <?php }?>
            </div>
        </div>
        <div class="col-lg-4 mb-30">
            <section class="aside-2 mb-20 position-relative" style="z-index: 30">
                <h2 class="aside-2__title"><?php echo $_smarty_tpl->tpl_vars['curCat']->value['name'];?>
</h2>
                <div class="aside-2__body py-3 text-center">
                    <?php if ($_smarty_tpl->tpl_vars['isLogin']->value != 1) {?>
                    <a class="button" href=".md-login" data-toggle="modal">MUA KHÓA HỌC NÀY</a>
                    <?php } else { ?>
                    <a class="button" href="<?php echo $_smarty_tpl->tpl_vars['Rewrite']->value->url_category($_smarty_tpl->tpl_vars['curCat']->value);?>
">MUA KHÓA HỌC NÀY</a>
                    <?php }?>
                </div>
            </section>
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
                <?php if ($_smarty_tpl->tpl_vars['paymentStatus']->value['status'] == 2) {?>
                <?php $_smarty_tpl->_subTemplateRender("file:_blocks/_lesson-catsresult.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('prev'=>"aside"), 0, true);
?>
                <?php } else { ?>
                <?php $_smarty_tpl->_subTemplateRender("file:_blocks/_lesson-cats.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('prev'=>"aside"), 0, true);
?>
                <?php }?>
            </div>
        </div>
    </div>
    <div class="fb-comments" data-href="<?php echo $_smarty_tpl->tpl_vars['Rewrite']->value->url_lesson($_smarty_tpl->tpl_vars['lesson']->value);?>
" data-width="100%" data-numposts="5"></div>
</div><?php }
}
