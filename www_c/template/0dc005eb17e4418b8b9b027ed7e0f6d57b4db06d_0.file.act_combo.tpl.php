<?php
/* Smarty version 3.1.32, created on 2021-06-30 12:02:34
  from '/var/www/koseionline.vn/data/www/koseionline.vn/themes/template/lessons/act_combo.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_60dbfaeada2af8_74226824',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0dc005eb17e4418b8b9b027ed7e0f6d57b4db06d' => 
    array (
      0 => '/var/www/koseionline.vn/data/www/koseionline.vn/themes/template/lessons/act_combo.tpl',
      1 => 1623212420,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:_blocks/_payment-form.tpl' => 2,
  ),
),false)) {
function content_60dbfaeada2af8_74226824 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/var/www/koseionline.vn/data/www/koseionline.vn/includes/smarty3/plugins/modifier.lang.php','function'=>'smarty_modifier_lang',),1=>array('file'=>'/var/www/koseionline.vn/data/www/koseionline.vn/includes/smarty3/plugins/modifier.replace.php','function'=>'smarty_modifier_replace',),2=>array('file'=>'/var/www/koseionline.vn/data/www/koseionline.vn/includes/smarty3/plugins/modifier.date_format.php','function'=>'smarty_modifier_date_format',),));
?><div class="container py-30">
  <div class="row">
    <div class="col-lg-8 mb-30">

      <?php if ($_smarty_tpl->tpl_vars['video']->value) {?>
        <?php if ($_smarty_tpl->tpl_vars['video']->value['requirement'] == 1) {?>
          <div class="js-login-required alert alert-danger mb-2">Bạn phải <a href=".md-login" class="text-700 text-danger" data-toggle="modal">đăng nhập</a> để xem được nội dung này</div>
        <?php } elseif ($_smarty_tpl->tpl_vars['video']->value['requirement'] == 2) {?>
          <div class="js-purchase-required alert alert-danger mb-2">Bạn phải <a href="<?php echo VNCMS_URL;?>
/course/checkout?cid=<?php echo $_smarty_tpl->tpl_vars['curCat']->value['cat_id'];?>
" class="text-700 text-danger">đăng ký khoá học</a> để xem được nội dung này</div>
        <?php }?>

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
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['lesson']->value['arrStream'], 'stream', false, 's');
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

      <ul class="nav n-tabs mt-20">
        <li class="nav-item">
          <a class="nav-link active" href="#detail-tab-1" data-toggle="tab">
            <img class="n-tabs__bg" src="<?php echo $_smarty_tpl->tpl_vars['URL_IMAGES']->value;?>
/n-tab-link-bg.png" alt="">
            <span><?php echo $_smarty_tpl->tpl_vars['curCat']->value['name'];?>
</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#detail-tab-2" data-toggle="tab">
            <img class="n-tabs__bg" src="<?php echo $_smarty_tpl->tpl_vars['URL_IMAGES']->value;?>
/n-tab-link-bg.png" alt="">
            <span>Đăng ký khoá học</span>
          </a>
        </li>
      </ul>
      <div class="n-tabs-content n-tabs-content--custom">
        <div class="tab-content">
          <div class="tab-pane fade show active" id="detail-tab-1">
            <?php echo htmlDecode($_smarty_tpl->tpl_vars['curCat']->value['detail']);?>

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
              <div class="alert alert-warning mb-0">
                <i class="fa fa-exclamation-circle mr-2"></i>
                Bạn đã đăng ký combo khoá học này nhưng chưa thanh toán.
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
    </div>

    <div class="col-lg-4 mb-30">
      <?php if ($_smarty_tpl->tpl_vars['otherCombos']->value) {?>
        <section class="aside-2 mb-20">
          <h2 class="aside-2__title">Combo khác</h2>
          <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['otherCombos']->value, 'combo', false, 'key', 'name', array (
));
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['combo']->value) {
?>
            <div class="combo media">
              <a class="combo__frame" href="<?php echo $_smarty_tpl->tpl_vars['Rewrite']->value->url_category($_smarty_tpl->tpl_vars['combo']->value);?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['URL_UPLOADS']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['combo']->value['image'];?>
" alt="<?php echo $_smarty_tpl->tpl_vars['combo']->value['name'];?>
" /></a>
              <div class="media-body">
                <h3 class="combo__name"><a href="<?php echo $_smarty_tpl->tpl_vars['Rewrite']->value->url_category($_smarty_tpl->tpl_vars['combo']->value);?>
"><?php echo $_smarty_tpl->tpl_vars['combo']->value['name'];?>
</a></h3>
                <div class="combo__price">
                  <div><?php echo $_smarty_tpl->tpl_vars['core']->value->callfunc('number_format',$_smarty_tpl->tpl_vars['combo']->value['price_vn']);?>
 vnđ</div>
                  <div><?php echo $_smarty_tpl->tpl_vars['core']->value->callfunc('number_format',$_smarty_tpl->tpl_vars['combo']->value['price_jp']);?>
 ¥</div>
                </div>
                <div class="combo__time">Thời gian: <?php echo $_smarty_tpl->tpl_vars['combo']->value['duration'];?>
 tháng</div>
              </div>
            </div>
          <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        </section>
      <?php }?>
    </div>
  </div>

  <div class="fb-comments" data-href="<?php echo $_smarty_tpl->tpl_vars['Rewrite']->value->url_category($_smarty_tpl->tpl_vars['curCat']->value);?>
" data-width="100%" data-numposts="5"></div>
</div>
<?php }
}
