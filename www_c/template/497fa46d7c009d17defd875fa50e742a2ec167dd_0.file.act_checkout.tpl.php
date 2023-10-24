<?php
/* Smarty version 3.1.32, created on 2021-07-30 13:25:17
  from '/var/www/koseionline.vn/data/www/koseionline.vn/themes/template/stage/act_checkout.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_61039b4ddf2092_09662358',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '497fa46d7c009d17defd875fa50e742a2ec167dd' => 
    array (
      0 => '/var/www/koseionline.vn/data/www/koseionline.vn/themes/template/stage/act_checkout.tpl',
      1 => 1620466540,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_61039b4ddf2092_09662358 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/var/www/koseionline.vn/data/www/koseionline.vn/includes/smarty3/plugins/modifier.lang.php','function'=>'smarty_modifier_lang',),1=>array('file'=>'/var/www/koseionline.vn/data/www/koseionline.vn/includes/smarty3/plugins/modifier.replace.php','function'=>'smarty_modifier_replace',),));
?><div class="container">
  <div class="border-top"></div>
</div>
<!-- breadcrumb-->
<nav>
  <div class="container">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a class="link-unstyled" href="<?php echo $_smarty_tpl->tpl_vars['VNCMS_URL']->value;?>
"><?php echo smarty_modifier_lang('Home');?>
</a></li>
      <li class="breadcrumb-item active"><?php echo smarty_modifier_lang('Payment');?>
</li>
    </ol>
  </div>
</nav>
<div class="container">
  <form class="mb-60" method="post">
    <?php if ($_GET['success'] == 1) {?>
      <div class="row">
        <div class="col-xl-6 offset-xl-3">
          <div class="sign-in card border-primary">
            <div class="card-header bg-primary text-white">
              <h2 class="card-title"><?php echo smarty_modifier_lang('Notice');?>
</h2>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-12">
                  <h2 class="text-danger"><?php echo smarty_modifier_lang('Sign_up_course_successful');?>
!</h2>
                  <p><?php echo smarty_modifier_replace(smarty_modifier_lang('Thank_you_for_registering_the_course_please_pay_the_tuition_fee_so_that_you_can_see_the_full_content_of_this_course'),"%c",$_smarty_tpl->tpl_vars['arrOneCourse']->value['name']);?>

                    !</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php } else { ?>
      <div class="row">
        <div class="col-lg-4">
          <div class="payment">
            <h2 class="payment__header">
              <i class="fa fa-home"></i>
              <span><?php echo smarty_modifier_lang('Your_information');?>
</span>
            </h2>
            <?php if ($_smarty_tpl->tpl_vars['arrOneUser']->value) {?>
              <div class="form-group">
                <label class="payment__label"><?php echo smarty_modifier_lang('Full_name');?>
</label>
                <input class="form-control" type="text" id="fullname" name="fullname" value="<?php echo $_smarty_tpl->tpl_vars['arrOneUser']->value['fullname'];?>
" placeholder="<?php echo smarty_modifier_lang('Example_name');?>
" required>
              </div>
              <div class="form-group">
                <label class="payment__label"><?php echo smarty_modifier_lang('Phone');?>
</label>
                <input class="form-control" type="tel" id="mobile" name="mobile" value="<?php echo $_smarty_tpl->tpl_vars['arrOneUser']->value['mobile'];?>
" placeholder="<?php echo smarty_modifier_lang('Phone');?>
" required>
              </div>
              <div class="form-group">
                <label class="payment__label">Email</label>
                <input class="form-control" type="email" id="email" name="email" value="<?php echo $_smarty_tpl->tpl_vars['arrOneUser']->value['email'];?>
" placeholder="email@example.com" required>
              </div>
              <div class="form-group">
                <label class="payment__label"><?php echo smarty_modifier_lang('Address');?>
</label>
                <input class="form-control" type="text" name="address" value="<?php echo $_smarty_tpl->tpl_vars['arrOneUser']->value['address'];?>
" placeholder="<?php echo smarty_modifier_lang('Address');?>
">
              </div>
            <?php } else { ?>
              <div class="form-group">
                <label class="payment__label"><?php echo smarty_modifier_lang('Full_name');?>
</label>
                <input class="form-control" type="text" id="fullname" name="fullname" value="<?php echo $_smarty_tpl->tpl_vars['fullname']->value;?>
" placeholder="<?php echo smarty_modifier_lang('Example_name');?>
" required>
              </div>
              <div class="form-group">
                <label class="payment__label"><?php echo smarty_modifier_lang('Phone');?>
</label>
                <input class="form-control" type="tel" id="mobile" name="mobile" value="<?php echo $_smarty_tpl->tpl_vars['mobile']->value;?>
" placeholder="<?php echo smarty_modifier_lang('Phone');?>
" required>
              </div>
              <div class="form-group">
                <label class="payment__label">Email</label>
                <input class="form-control" type="email" id="email" name="email" value="<?php echo $_smarty_tpl->tpl_vars['email']->value;?>
" placeholder="email@example.com" required>
              </div>
              <div class="form-group">
                <label class="payment__label"><?php echo smarty_modifier_lang('Address');?>
</label>
                <input class="form-control" type="text" name="address" value="<?php echo $_smarty_tpl->tpl_vars['address']->value;?>
" placeholder="<?php echo smarty_modifier_lang('Address');?>
">
              </div>
            <?php }?>
            <div class="form-group">
              <label><?php echo smarty_modifier_lang('Content');?>
</label>
              <textarea class="form-control" name="note" rows="3"><?php echo $_smarty_tpl->tpl_vars['note']->value;?>
</textarea>
            </div>
            <div class="form-group">
              <label class="payment__label"><?php echo smarty_modifier_lang('Register_the_course');?>
</label>
              <input class="form-control" type="text" value="<?php echo $_smarty_tpl->tpl_vars['arrOneCourse']->value['name'];?>
" readonly>
            </div>
          </div>
        </div>
        <div class="col-lg-4">
                    <div class="payment">
            <h2 class="payment__header">
              <i class="fa fa-credit-card-alt"></i>
              <span><?php echo smarty_modifier_lang('Bank_transfer');?>
</span>
            </h2>
            <div class="card bg-light rounded-0 mb-3 js-account-holder">
              <div class="card-body py-12">
                <span id="account_holder" class="d-none"><?php echo smarty_modifier_lang('Account_holder');?>
:</span>
                <strong class="js-account-name"><?php echo smarty_modifier_lang('Select_the_bank_you_want_to_transfe');?>
</strong>
              </div>
            </div>
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['arrListPaymentMethod']->value, 'payment', false, 'p');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['p']->value => $_smarty_tpl->tpl_vars['payment']->value) {
?>
              <?php if ($_smarty_tpl->tpl_vars['payment']->value['ctype'] == 0) {?>
                <div class="form-group">
                  <label class="radio-styled">
                    <input class="radio-styled__input js-card-payment js-account-select" type="radio" name="payment_id" value="<?php echo $_smarty_tpl->tpl_vars['payment']->value['payment_id'];?>
" data-currency="<?php echo $_smarty_tpl->tpl_vars['payment']->value['country'];?>
" data-ah="<?php echo $_smarty_tpl->tpl_vars['payment']->value['account_holder'];?>
" />
                    <span class="radio-styled__icon"></span>
                    <div>
                      <div><?php echo smarty_modifier_lang('Account_number');?>
: <?php echo $_smarty_tpl->tpl_vars['payment']->value['account_number'];?>
</div>
                      <div><?php echo $_smarty_tpl->tpl_vars['payment']->value['name'];?>
</div>
                    </div>
                  </label>
                </div>
              <?php }?>
            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            <div class="form-group">
              <div class="form-text">
                <strong class="text-danger"><?php echo smarty_modifier_lang('Transferring_content');?>
:</strong><br>
                <kbd class="ml-0"><?php echo smarty_modifier_replace($_smarty_tpl->tpl_vars['core']->value->callfunc('utf8_nosign',$_smarty_tpl->tpl_vars['arrOneCourse']->value['name']),'tieng Nhat ','');?>
_<?php echo $_smarty_tpl->tpl_vars['core']->value->_USER['user_name'];?>
_<?php echo $_smarty_tpl->tpl_vars['core']->value->_USER['mobile'];?>
</kbd>
              </div>
            </div>
          </div>
          <div class="payment">
            <h2 class="payment__header">
              <i class="fa fa-code"></i>
              <span>Mã khuyến mại</span>
            </h2>
            <div class="mb-3">
              <div class="input-group">
                <input class="form-control" type="text" id="coupon" name="coupon" placeholder="Nhập mã khuyến mại vào đây">
                <div class="input-group-append">
                  <button type="button" class="btn btn-primary ml-2 js-btn-coupon">Áp dụng</button>
                </div>
              </div>
            </div>
            <div class="collapse js-currency-vn">
              <div class="media text-700 mt-1">
                <div class="media-body">Học phí:</div>
                <div class="text-right text-danger"><?php echo $_smarty_tpl->tpl_vars['core']->value->callfunc("number_format",$_smarty_tpl->tpl_vars['arrOneCourse']->value['price_vn'],0,',','.');?>
 vnđ</div>
              </div>
              <div class="js-save-block">
                <div class="media text-700 mt-1">
                  <div class="media-body">Khuyến mại:</div>
                  <div class="text-right text-danger">
                    <span class="js-save-vn"></span> vnđ
                  </div>
                </div>
                <div class="media text-20 mt-1">
                  <div class="media-body"><strong>Học phí cần thanh toán:</strong></div>
                  <div class="text-right text-danger">
                    <strong><span class="js-total-vn"></span> vnđ</strong>
                  </div>
                </div>
              </div>
            </div>
            <div class="collapse js-currency-jp">
              <div class="media text-700 mt-1">
                <div class="media-body">Học phí:</div>
                <div class="text-right text-danger"><?php echo $_smarty_tpl->tpl_vars['core']->value->callfunc("number_format",$_smarty_tpl->tpl_vars['arrOneCourse']->value['price_jp'],0,',','.');?>
 JPY</div>
              </div>
              <div class="js-save-block">
                <div class="media text-700 mt-1">
                  <div class="media-body">Khuyến mại:</div>
                  <div class="text-right text-danger">
                    <sapn class="js-save-jp"></sapn> JPY
                  </div>
                </div>
                <div class="media text-20 mt-1">
                  <div class="media-body"><strong>Học phí cần thanh toán:</strong></div>
                  <div class="text-right text-danger">
                    <strong>
                      <sapn class="js-total-jp"></sapn> JPY
                    </strong>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="payment">
            <h2 class="payment__header">
              <i class="fa fa-money"></i>
              <span><?php echo smarty_modifier_lang('Pay_directly_at_Kosei');?>
</span>
            </h2>
            <?php $_smarty_tpl->_assignInScope('i', 1);?>
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['arrListPaymentMethod']->value, 'payment', false, 'p');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['p']->value => $_smarty_tpl->tpl_vars['payment']->value) {
?>
              <?php if ($_smarty_tpl->tpl_vars['payment']->value['ctype'] == 1) {?>
                <div class="form-group">
                  <label class="radio-styled">
                    <input class="radio-styled__input" type="radio" name="payment_id" value="<?php echo $_smarty_tpl->tpl_vars['payment']->value['payment_id'];?>
">
                    <span class="radio-styled__icon"></span>
                    <span><?php echo smarty_modifier_lang('Base');?>
 <?php echo $_smarty_tpl->tpl_vars['i']->value;?>
: <?php echo $_smarty_tpl->tpl_vars['payment']->value['name'];?>
</span>
                  </label>
                </div>
                <?php $_smarty_tpl->_assignInScope('i', $_smarty_tpl->tpl_vars['i']->value+1);?>
              <?php }?>
            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
          </div>
        </div>
      </div>
      <div class="text-center pt-30">
        <input type="hidden" name="cat_id" id="cat_id" value="<?php if ($_smarty_tpl->tpl_vars['cat_id']->value) {
echo $_smarty_tpl->tpl_vars['cat_id']->value;
} else {
echo $_GET['cid'];
}?>">
        <button class="payment-btn" type="submit" name="btnCheckout" value="checkout"><?php echo smarty_modifier_lang('Confirm_registration');?>
</button>
      </div>
    <?php }?>
  </form>
</div>
<?php }
}
