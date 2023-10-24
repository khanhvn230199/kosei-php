<?php
/* Smarty version 3.1.32, created on 2021-06-11 17:44:10
  from '/var/www/koseionline.vn/data/www/koseionline.vn/themes/template/_blocks/_payment-form.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_60c33e7ad31d13_27787338',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '57b05fb3d63128e2788dd8fa8bc8f56f294512e1' => 
    array (
      0 => '/var/www/koseionline.vn/data/www/koseionline.vn/themes/template/_blocks/_payment-form.tpl',
      1 => 1623408208,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60c33e7ad31d13_27787338 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/var/www/koseionline.vn/data/www/koseionline.vn/includes/smarty3/plugins/modifier.lang.php','function'=>'smarty_modifier_lang',),1=>array('file'=>'/var/www/koseionline.vn/data/www/koseionline.vn/includes/smarty3/plugins/modifier.replace.php','function'=>'smarty_modifier_replace',),));
?><form class="consultation js-payment-form">
  <input type="hidden" name="cat_id" value="<?php echo $_smarty_tpl->tpl_vars['curCat']->value['cat_id'];?>
">
  <div class="form-row form-group">
    <label class="col-form-label col-md-4 col-xl-3">Họ và tên:</label>
    <div class="col-md-8 col-xl-9">
      <input class="form-control" type="text" value="<?php echo $_smarty_tpl->tpl_vars['user']->value['fullname'];?>
" readonly disabled>
    </div>
  </div>
  <div class="form-row form-group">
    <label class="col-form-label col-md-4 col-xl-3">Số điện thoại:</label>
    <div class="col-md-8 col-xl-9">
      <input class="form-control" type="text" value="<?php echo $_smarty_tpl->tpl_vars['user']->value['mobile'];?>
" readonly disabled>
    </div>
  </div>
  <div class="form-row form-group">
    <label class="col-form-label col-md-4 col-xl-3">Phương thức thanh toán</label>
    <div class="col-md-8 col-xl-9">
      <select class="custom-select js-payment-method" name="payment_method" required>
        <option value="">-- Chọn phương thức thanh toán --</option>
        <option value="0" data-target="#payment-banking">Chuyển khoản ngân hàng</option>
        <option value="1" data-target="#payment-cash">Thanh toán trực tiếp tại Kosei</option>
      </select>
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
    </div>
  </div>
  <div class="form-row form-group">
    <label class="col-form-label col-md-4 col-xl-3">Mã khuyến mại</label>
    <div class="col-md-8 col-xl-9">
      <div class="input-group consultation__promo-code">
        <input class="form-control js-promo-code" type="text" name="coupon" placeholder="Nhập mã khuyến mại tại đây">
        <div class="input-group-append">
          <button class="input-group-text js-promo-btn" type="button">Áp dụng</button>
        </div>
      </div>
      <div class="js-promo-status">
      </div>
    </div>
  </div>
  <div class="form-row form-group">
    <label class="col-form-label col-md-4 col-xl-3">Ghi chú:</label>
    <div class="col-md-8 col-xl-9">
      <textarea name="note" rows="4" class="form-control" placeholder="Nhập ghi chú"></textarea>
    </div>
  </div>
  <div class="text-center mt-3">
    <button class="consultation__btn js-payment-submit" type="submit">Xác nhận đăng ký</button>
  </div>
</form>
<?php }
}
