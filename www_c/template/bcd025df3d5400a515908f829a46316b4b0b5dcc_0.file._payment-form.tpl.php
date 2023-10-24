<?php
/* Smarty version 3.1.32, created on 2023-05-19 09:47:24
  from '/var/www/koseionline/data/www/koseionline.vn/themes/template/_blocks/_payment-form.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_6466e33c4b69d0_40160387',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'bcd025df3d5400a515908f829a46316b4b0b5dcc' => 
    array (
      0 => '/var/www/koseionline/data/www/koseionline.vn/themes/template/_blocks/_payment-form.tpl',
      1 => 1681273647,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6466e33c4b69d0_40160387 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/var/www/koseionline/data/www/koseionline.vn/includes/smarty3/plugins/modifier.lang.php','function'=>'smarty_modifier_lang',),1=>array('file'=>'/var/www/koseionline/data/www/koseionline.vn/includes/smarty3/plugins/modifier.replace.php','function'=>'smarty_modifier_replace',),));
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
">
        </div>
    </div>
    <!-- add -->
    <div class="sapo_khoahoc">
        <p>Khóa học : <?php echo $_smarty_tpl->tpl_vars['curCat']->value['name'];?>
</p>
        <p>Học phí : <?php echo $_smarty_tpl->tpl_vars['core']->value->callfunc("number_format",$_smarty_tpl->tpl_vars['curCat']->value['price_vn'],0,',','.');?>
 VNĐ</p>
        <p>Thời gian : <?php echo $_smarty_tpl->tpl_vars['curCat']->value['duration'];?>
Tháng <strong>(Thời hạn học kể từ khi mua)</strong></p>
    </div>
    <!-- End -->
    <div class="form-row form-group">
        <label class="col-form-label col-md-4 col-xl-3">Phương thức thanh toán</label>
        <div class="col-md-8 col-xl-9">
            <select class="custom-select js-payment-method" name="payment_method" required>
                <option value="">-- Chọn phương thức thanh toán --</option>
                <option value="0" data-target="#payment-cash">Thanh toán trực tiếp tại Kosei</option>
                <option value="1" data-target="#payment-banking">Chuyển khoản ngân hàng Việt Nam</option>
                <option value="1" data-target="#payment-banking1">Chuyển khoản ngân hàng Nhật Bản</option>
            </select>
            <div class="js-payment-info pt-3 collapse" id="payment-banking">
                <div class="alert alert-info mb-0">
                    <div class="mb-12">
                        <strong class="text-danger"><?php echo smarty_modifier_lang('Transferring_content');?>
:</strong><br>
                        <kbd class="ml-0" style="font-family: auto; font-size: 16px;padding-bottom: 0px;padding-top: 0px;"><?php echo smarty_modifier_replace($_smarty_tpl->tpl_vars['core']->value->callfunc('utf8_nosign',$_smarty_tpl->tpl_vars['curCat']->value['name']),'tieng Nhat ','');?>
_<?php echo $_smarty_tpl->tpl_vars['core']->value->_USER['email'];
if ($_smarty_tpl->tpl_vars['core']->value->_USER['mobile']) {?>_<?php echo $_smarty_tpl->tpl_vars['core']->value->_USER['mobile'];
}?></kbd>
                        <br>
                        Lưu ý: Nội dung chuyển khoản bỏ qua ký tự đặc biệt như: @ . , +, _
                        <br>
                        <!-- <strong>Ví dụ: <?php echo smarty_modifier_replace($_smarty_tpl->tpl_vars['core']->value->callfunc('utf8_nosign',$_smarty_tpl->tpl_vars['curCat']->value['slug']),'tieng Nhat ','');?>
_<?php echo $_smarty_tpl->tpl_vars['core']->value->_USER['email'];?>
</strong> -->
                        <br>
                        <?php if ($_smarty_tpl->tpl_vars['core']->value->_USER['mobile']) {?>
                        <strong>Hoặc : <?php echo smarty_modifier_replace($_smarty_tpl->tpl_vars['core']->value->callfunc('utf8_nosign',$_smarty_tpl->tpl_vars['curCat']->value['slug']),'tieng Nhat ','');?>
_<?php echo $_smarty_tpl->tpl_vars['core']->value->_USER['mobile'];?>
</strong>
                        <?php }?>
                        <br>
                    </div>
                    <?php if ($_smarty_tpl->tpl_vars['bankAccounts']->value) {?>
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['bankAccounts']->value, 'bank', false, 'key', 'name', array (
));
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['bank']->value) {
?>
                    <?php if ($_smarty_tpl->tpl_vars['key']->value == 0) {?>
                    <div class="mb-12 m-last-0">
                        <div class="text-700"><?php echo $_smarty_tpl->tpl_vars['bank']->value['name'];?>
</div>
                        <div>Chủ tài khoản: <strong><?php echo $_smarty_tpl->tpl_vars['bank']->value['account_holder'];?>
</strong></div>
                        <div>Số tài khoản: <strong><?php echo $_smarty_tpl->tpl_vars['bank']->value['account_number'];?>
</strong></div>
                    </div>
                    <?php }?>
                    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    <?php }?>
                </div>
            </div>
            <div class="js-payment-info pt-3 collapse" id="payment-banking1">
                <div class="alert alert-info mb-0">
                   <strong class="text-danger"><?php echo smarty_modifier_lang('Transferring_content');?>
:</strong><br>
                        <kbd class="ml-0" style="font-family: auto; font-size: 16px;padding-bottom: 0px;padding-top: 0px;"><?php echo smarty_modifier_replace($_smarty_tpl->tpl_vars['core']->value->callfunc('utf8_nosign',$_smarty_tpl->tpl_vars['curCat']->value['name']),'tieng Nhat ','');?>
_<?php echo $_smarty_tpl->tpl_vars['core']->value->_USER['email'];
if ($_smarty_tpl->tpl_vars['core']->value->_USER['mobile']) {?>_<?php echo $_smarty_tpl->tpl_vars['core']->value->_USER['mobile'];
}?></kbd>
                        <br>
                        Lưu ý: Nội dung chuyển khoản bỏ qua ký tự đặc biệt như: @ . , +, _
                        <br>
                        <!-- <strong>Ví dụ: <?php echo smarty_modifier_replace($_smarty_tpl->tpl_vars['core']->value->callfunc('utf8_nosign',$_smarty_tpl->tpl_vars['curCat']->value['slug']),'tieng Nhat ','');?>
_<?php echo $_smarty_tpl->tpl_vars['core']->value->_USER['email'];?>
</strong> -->
                        <br>
                        <?php if ($_smarty_tpl->tpl_vars['core']->value->_USER['mobile']) {?>
                        <strong>Hoặc : <?php echo smarty_modifier_replace($_smarty_tpl->tpl_vars['core']->value->callfunc('utf8_nosign',$_smarty_tpl->tpl_vars['curCat']->value['slug']),'tieng Nhat ','');?>
_<?php echo $_smarty_tpl->tpl_vars['core']->value->_USER['mobile'];?>
</strong>
                        <?php }?>
                        <br>
                    <?php if ($_smarty_tpl->tpl_vars['bankAccounts']->value) {?>
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['bankAccounts']->value, 'bank', false, 'key', 'name', array (
));
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['bank']->value) {
?>
                    <?php if ($_smarty_tpl->tpl_vars['key']->value == 1) {?>
                    <div class="mb-12 m-last-0">
                        <div class="text-700"><?php echo $_smarty_tpl->tpl_vars['bank']->value['name'];?>
</div>
                        <div>Chủ tài khoản: <strong><?php echo $_smarty_tpl->tpl_vars['bank']->value['account_holder'];?>
</strong></div>
                        <div>Số tài khoản: <strong><?php echo $_smarty_tpl->tpl_vars['bank']->value['account_number'];?>
</strong></div>
                    </div>
                    <?php }?>
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
</form><?php }
}
