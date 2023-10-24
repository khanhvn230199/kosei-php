<?php
/* Smarty version 3.1.32, created on 2021-06-08 13:54:06
  from '/var/www/koseionline.vn/data/www/koseionline.vn/themes/template/_modals.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_60bf140e076767_74021972',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c8672cb4fe9afde60c6018245dded25434d70d91' => 
    array (
      0 => '/var/www/koseionline.vn/data/www/koseionline.vn/themes/template/_modals.tpl',
      1 => 1620635214,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:_blocks/_mock_exam.tpl' => 1,
    'file:_blocks/_payment-form.tpl' => 3,
  ),
),false)) {
function content_60bf140e076767_74021972 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/var/www/koseionline.vn/data/www/koseionline.vn/includes/smarty3/plugins/modifier.lang.php','function'=>'smarty_modifier_lang',),1=>array('file'=>'/var/www/koseionline.vn/data/www/koseionline.vn/includes/smarty3/plugins/modifier.replace.php','function'=>'smarty_modifier_replace',),2=>array('file'=>'/var/www/koseionline.vn/data/www/koseionline.vn/includes/smarty3/plugins/modifier.date_format.php','function'=>'smarty_modifier_date_format',),));
?><article class="md-login modal fade" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><?php echo smarty_modifier_lang('Login');?>
</h5>
        <button class="close" type="button" data-dismiss="modal">
          <span>&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="login_form" action="" method="POST" onsubmit="ajax_login();return false;">
          <div class="form-group alert alert-danger text-16 js-login-alert-box d-none">Bạn phải đăng nhập để xem được nội dung này!</div>
          <div class="form-group">
            <div class="form-control-icon form-control-icon-user">
              <input class="form-control" type="text" name="user_name" placeholder="<?php echo smarty_modifier_lang('User_name');?>
" required />
            </div>
          </div>
          <div class="form-group">
            <div class="form-control-icon form-control-icon-lock">
              <input class="form-control" type="password" name="user_pass" placeholder="<?php echo smarty_modifier_lang('Password');?>
" required />
            </div>
            <a class="text-default text-muted form-text mt-2 js-restore-btn" href=".md-restore" data-toggle="modal"><?php echo smarty_modifier_lang('Forgot_your_password');?>
?</a>
          </div>
          <div class="form-group">
            <input type="hidden" name="btnLogin" value="<?php echo smarty_modifier_lang('Login');?>
 ">
            <button class="btn btn-block btn-danger" type="submit"><?php echo smarty_modifier_lang('Login');?>
</button>
          </div>
          <div class="row">
            <div class="col-6">
              <div class="form-group">
                <a class="btn btn-block btn-facebook text-white" href="<?php echo $_smarty_tpl->tpl_vars['Rewrite']->value->url_fbauth();?>
">
                  <i class="fa fa-facebook mr-2"></i>
                  <span>Facebook</span>
                </a>
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <a class="btn btn-block btn-google-plus text-white" href="<?php echo $_smarty_tpl->tpl_vars['Rewrite']->value->url_ggauth();?>
">
                  <i class="fa fa-google mr-2"></i>
                  <span>Google</span>
                </a>
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <div class="d-block w-100">
          <a class="text-primary" href="<?php echo $_smarty_tpl->tpl_vars['Rewrite']->value->url_register();?>
"><?php echo smarty_modifier_lang('Register_now');?>
</a>
          <?php echo smarty_modifier_lang('If_you_do_not_have_an_account');?>

        </div>
      </div>
    </div>
  </div>
</article>
<article class="md-restore modal fade" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><?php echo smarty_modifier_lang('Password_retrieval');?>
</h5>
        <button class="close" type="button" data-dismiss="modal">
          <span>&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="forgot_form" action="" method="POST" onsubmit="ajax_forgot();return false;">
          <div class="form-group">
            <div class="form-control-icon form-control-icon-user">
              <input class="form-control" type="text" name="user_name" placeholder="<?php echo smarty_modifier_lang('User_name');?>
" />
            </div>
          </div>
          <div class="form-group">
            <div class="form-control-icon form-control-icon-envelope">
              <input class="form-control" type="email" name="email" placeholder="Email" />
            </div>
          </div>
          <div class="form-group">
            <input type="hidden" name="btnForgot" value="btnForgot">
            <button class="btn btn-block btn-danger" type="submit"><?php echo smarty_modifier_lang('Password_retrieval');?>
</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</article>
<article class="md-course modal fade" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><?php echo smarty_modifier_lang('Register_the_course');?>
</h5>
        <button class="close" type="button" data-dismiss="modal">
          <span>&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?php echo $_smarty_tpl->tpl_vars['Rewrite']->value->url_checkout();?>
" method="post">
          <div class="form-group">
            <div class="form-control-icon form-control-icon-user">
              <input class="form-control" type="text" id="fullname" name="fullname" value="<?php echo $_smarty_tpl->tpl_vars['fullname']->value;?>
" placeholder="<?php echo smarty_modifier_lang('Example_name');?>
" required>
            </div>
          </div>
          <div class="form-group">
            <div class="form-control-icon form-control-icon-envelope">
              <input class="form-control" type="email" id="email" name="email" value="<?php echo $_smarty_tpl->tpl_vars['email']->value;?>
" placeholder="email@example.com" required>
            </div>
          </div>
          <div class="form-group">
            <div class="form-control-icon form-control-icon-phone">
              <input class="form-control" type="tel" id="mobile" name="mobile" value="<?php echo $_smarty_tpl->tpl_vars['mobile']->value;?>
" placeholder="<?php echo smarty_modifier_lang('Phone');?>
" required>
            </div>
          </div>
          <div class="form-group">
            <div class="form-control-icon form-control-icon-book">
              <input class="form-control" type="text" id="address" name="address" value="<?php echo $_smarty_tpl->tpl_vars['address']->value;?>
" placeholder="<?php echo smarty_modifier_lang('Address');?>
" required>
            </div>
          </div>
          <div class="form-group">
            <input type="hidden" name="cat_id" value="<?php echo $_smarty_tpl->tpl_vars['curCat']->value['cat_id'];?>
">
            <button class="btn btn-block btn-danger" type="submit" value="checkout"><?php echo smarty_modifier_lang('Proceed_to_payment');?>
</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</article>
<article class="md-result modal fade" role="dialog">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><?php echo smarty_modifier_lang('Result');?>
</h5>
        <button class="close" type="button" data-dismiss="modal">
          <span>&times;</span>
        </button>
      </div>
      <div class="modal-body py-30">
        <div class="js-result md-result__text text-20 text-center"></div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-danger" data-dismiss="modal"><?php echo smarty_modifier_lang('Close');?>
</button>
      </div>
    </div>
  </div>
</article>
<article class="md-test-result modal fade" role="dialog">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <div class="test-result">
          <img class="test-result__img" src="<?php echo $_smarty_tpl->tpl_vars['URL_IMAGES']->value;?>
/test-result-img.png" alt="" />
          <div class="js-test-result">
            <div>
              <div class="test-result__title">JP</div>
              <div class="test-result__info">
                <table>
                  <tr>
                    <td>氏名 Họ tên:</td>
                    <td></td>
                  </tr>
                  <tr>
                    <td>結果 Kết quả:</td>
                    <td></td>
                  </tr>
                </table>
              </div>
              <div class="test-result__table table-responsive">
                <table class="table table-bordered">
                  <tr>
                    <td colspan="3">得点区分別得点 Điểm thành phần</td>
                    <td rowspan="2">
                      <div>総合得点</div>
                      <div>Tổng điểm</div>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <div>言語知識（文字・語彙・文法）</div>
                      <div>Từ vựng + Ngữ pháp</div>
                    </td>
                    <td>
                      <div>読解</div>
                      <div>Đọc hiểu</div>
                    </td>
                    <td>
                      <div>聴解</div>
                      <div>Nghe hiểu</div>
                    </td>
                  </tr>
                  <tr>
                    <td>00/60</td>
                    <td>00/60</td>
                    <td>00/60</td>
                    <td>00/180</td>
                  </tr>
                </table>
              </div>
            </div>
          </div>
          <img class="test-result__logo" src="<?php echo $_smarty_tpl->tpl_vars['URL_IMAGES']->value;?>
/logo.png" alt="" />
        </div>
      </div>
    </div>
  </div>
</article>
<div class="md-noexam modal fade" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <button class="close" data-dismiss="modal"><span>&times;</span></button>
        <div class="w-100 pt-4 pb-3 text-18 text-center">
          <p><?php echo smarty_modifier_lang('This_lecture_has_no_exercises');?>
.<br /><?php echo smarty_modifier_lang('Please_see_more_other_lectures');?>
!</p>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="md-expired-lession modal fade" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content" style="background-color:transparent!important; border:0px solid #FFF">
      <div class="modal-body">
        <button class="md-welcome__close" type="button" data-dismiss="modal">
          <img src="<?php echo $_smarty_tpl->tpl_vars['URL_IMAGES']->value;?>
/close-btn.png" alt="close">
        </button>
        <div class="col-xl-12 mb-20">
          <div class="sign-in card border-danger">
            <div class="card-header bg-danger text-white">
              <h2 class="card-title"><?php echo smarty_modifier_lang('Notice');?>
</h2>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-12">
                  <p><?php echo smarty_modifier_lang('Expired_time_to_view_this_content');?>
!</p>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>

<?php $_smarty_tpl->_subTemplateRender("file:_blocks/_mock_exam.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<?php if ($_smarty_tpl->tpl_vars['mod']->value == 'lessons' && $_smarty_tpl->tpl_vars['act']->value == 'detail') {?>
  <article class="md-purchase-require modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Yêu cầu đăng ký</h5>
          <button class="close" type="button" data-dismiss="modal"><span>&times;</span></button>
        </div>

        <div class="modal-body">
          <?php if (!$_smarty_tpl->tpl_vars['paymentStatus']->value) {?>
            <div class="form-group alert alert-danger text-16">Bạn phải đăng ký khoá học mới xem được nội dung ngày!</div>
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
          <?php }?>
        </div>
      </div>
    </div>
    </div>
  </article>
<?php }?>

<div class="md-continue modal fade" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Bạn có muốn tiếp tục bài thi lần trước?</h5>
        <button class="close" type="button" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <div class="form-group mb-3">Có vẻ như lần trước của bạn đã chưa hoàn thành bài thi, bạn có muốn <strong class="text-16 text-danger">THI TIẾP</strong> hay <strong class="text-16 text-primary">THI LẠI TỪ ĐẦU</strong> không?</div>
        <div class="d-flex justify-content-center"><a class="button mr-3 js-continue-test" href="#!">Thi tiếp</a>
          <button class="button bg-primary" type="button" data-dismiss="modal">Thi lại</button>
        </div>
      </div>
    </div>
  </div>
</div>
<?php }
}
