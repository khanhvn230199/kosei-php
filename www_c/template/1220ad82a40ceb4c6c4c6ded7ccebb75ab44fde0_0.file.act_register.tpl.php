<?php
/* Smarty version 3.1.32, created on 2023-05-19 10:36:58
  from '/var/www/koseionline/data/www/koseionline.vn/themes/template/account/act_register.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_6466eedaf04e28_29214100',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1220ad82a40ceb4c6c4c6ded7ccebb75ab44fde0' => 
    array (
      0 => '/var/www/koseionline/data/www/koseionline.vn/themes/template/account/act_register.tpl',
      1 => 1679884188,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6466eedaf04e28_29214100 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/var/www/koseionline/data/www/koseionline.vn/includes/smarty3/plugins/modifier.lang.php','function'=>'smarty_modifier_lang',),));
?><div class="container">
    <div class="border-top"></div>
</div>
<nav>
    <div class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a class="link-unstyled" href="<?php echo $_smarty_tpl->tpl_vars['VNCMS_URL']->value;?>
"><?php echo smarty_modifier_lang('Home');?>
</a>
            </li>
            <li class="breadcrumb-item active"><?php echo smarty_modifier_lang('Register');?>
</li>
        </ol>
    </div>
</nav>
<section class="mb-50">
    <div class="container">
        <div class="row">
            <div class="col-xl-8 offset-xl-2">
                <div class="sign-in card border-primary">
                    <div class="card-header bg-primary text-white">
                        <?php if ($_GET['success'] == 1) {?>
                        <h2 class="card-title"><?php echo smarty_modifier_lang('Register_successfully');?>
</h2>
                        <?php } else { ?>
                        <h2 class="card-title"><?php echo smarty_modifier_lang('Register');?>
</h2>
                        <?php }?>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <?php if ($_GET['success'] == 1) {?>
                            <div class="col-md-12">
                                <h2 class="text-danger"><?php echo smarty_modifier_lang('Register_successfully');?>
!</h2>
                                <p><?php echo smarty_modifier_lang('Thank_you_for_register_to');?>
 <a href=".md-login" data-toggle="modal"><?php echo smarty_modifier_lang('Sign_in');?>
</a> <?php echo smarty_modifier_lang('To_manage_your_account');?>
.</p>
                            </div>
                            <?php } else { ?>
                            <div class="col-md-6 order-md-1">
                                <form method="POST" id="fRegister" name="fRegister">
                                    <div class="form-group">
                                        <div class="form-control-icon form-control-icon-user">
                                            <input class="form-control" type="text" id="fullname" name="fullname" value="<?php echo $_smarty_tpl->tpl_vars['fullname']->value;?>
" placeholder="Họ Và Tên" required>
                                        </div>
                                        <?php if ($_smarty_tpl->tpl_vars['arr_error']->value['fullname'] != '') {?><div class="text-danger"><?php echo $_smarty_tpl->tpl_vars['arr_error']->value['fullname'];?>
</div><?php }?>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-control-icon">
                                            <i class="fa fa-address-card" aria-hidden="true" style="color: #4166b0;position: absolute;top: 9px;left: 13px;"></i>
                                            <input class="form-control" type="text" id="user_name" name="user_name" value="<?php echo $_smarty_tpl->tpl_vars['user_name']->value;?>
" placeholder="<?php echo smarty_modifier_lang('User_name');?>
" pattern="[A-Za-z0-9]{6,}" title="Tài khoản phải viết liền không dấu, không được chứa khoảng trắng và ký tự đặc biệt, tối thiểu 6 ký tự" required>
                                        </div>
                                        <?php if ($_smarty_tpl->tpl_vars['arr_error']->value['user_name'] != '') {?><div class="text-danger"><?php echo $_smarty_tpl->tpl_vars['arr_error']->value['user_name'];?>
</div><?php }?>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-control-icon form-control-icon-envelope">
                                            <input class="form-control" type="email" id="email" name="email" value="<?php echo $_smarty_tpl->tpl_vars['email']->value;?>
" placeholder="email@example.com" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required>
                                        </div>
                                        <?php if ($_smarty_tpl->tpl_vars['arr_error']->value['email'] != '') {?><div class="text-danger"><?php echo $_smarty_tpl->tpl_vars['arr_error']->value['email'];?>
</div><?php }?>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-control-icon form-control-icon-phone">
                                            <input class="form-control" type="tel" id="mobile" name="mobile" value="<?php echo $_smarty_tpl->tpl_vars['mobile']->value;?>
" placeholder="<?php echo smarty_modifier_lang('Phone');?>
" required>
                                        </div>
                                        <?php if ($_smarty_tpl->tpl_vars['arr_error']->value['mobile'] != '') {?><div class="text-danger"><?php echo $_smarty_tpl->tpl_vars['arr_error']->value['mobile'];?>
</div><?php }?>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-control-icon form-control-icon-lock">
                                            <input class="form-control" type="password" id="user_pass" name="user_pass" value="<?php echo $_smarty_tpl->tpl_vars['user_pass']->value;?>
" placeholder="<?php echo smarty_modifier_lang('Password');?>
" pattern=".{6,}" title="mật khẩu tối thiểu 6 ký tự" required>
                                        </div>
                                        <?php if ($_smarty_tpl->tpl_vars['arr_error']->value['user_pass'][0] != '') {?><div class="text-danger"><?php echo $_smarty_tpl->tpl_vars['arr_error']->value['user_pass'][0];?>
</div><?php }?>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-control-icon form-control-icon-lock">
                                            <input class="form-control" type="password" id="user_pass_confirm" name="user_pass_confirm" value="<?php echo $_smarty_tpl->tpl_vars['user_pass_confirm']->value;?>
" placeholder="<?php echo smarty_modifier_lang('Confirm_password');?>
" pattern=".{6,}" title="mật khẩu tối thiểu 6 ký tự" required>
                                        </div>
                                        <?php if ($_smarty_tpl->tpl_vars['arr_error']->value['user_pass'][1] != '') {?><div class="text-danger"><?php echo $_smarty_tpl->tpl_vars['arr_error']->value['user_pass'][1];?>
</div><?php }?>
                                    </div>
                                    <div class="form-group form-inline">
                                        <label class="mr-4"><?php echo smarty_modifier_lang('Gender');?>
</label>
                                        <label class="radio-styled mr-4">
                                            <input class="radio-styled__input" type="radio" name="gender" value="0" checked>
                                            <span class="radio-styled__icon"></span>
                                            <span><?php echo smarty_modifier_lang('Male');?>
</span>
                                        </label>
                                        <label class="radio-styled mr-4">
                                            <input class="radio-styled__input" type="radio" name="gender" value="1">
                                            <span class="radio-styled__icon"></span>
                                            <span><?php echo smarty_modifier_lang('Female');?>
</span>
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <label class="checkbox-styled">
                                            <input class="checkbox-styled__input" type="checkbox" name="agree" value="agree" required>
                                            <span class="checkbox-styled__icon"></span>
                                            <span><?php echo smarty_modifier_lang('I_have_read_and_agree_with');?>
</span>
                                            <a class="text-primary" href="<?php echo $_smarty_tpl->tpl_vars['_CONFIG']->value['terms_of_use'];?>
"><?php echo smarty_modifier_lang('Terms_of_use');?>
</a>
                                        </label>
                                        <?php if ($_smarty_tpl->tpl_vars['arr_error']->value['agree'] != '') {?><div class="text-danger"><?php echo $_smarty_tpl->tpl_vars['arr_error']->value['agree'];?>
</div><?php }?>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-danger btn-block" type="submit" name="btnRegister" value="Register"><?php echo smarty_modifier_lang('Register');?>
</button>
                                    </div>
                                    <div>
                                        <a class="text-primary text-uppercase" href=".md-login" data-toggle="modal"><?php echo smarty_modifier_lang('Login');?>
</a>
                                        <span><?php echo smarty_modifier_lang('If_you_already_have_an_account');?>
</span>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-6">
                                <div class="w-100 h-100 position-relative">
                                    <div class="sign-in__detail">
                                        <div class="sign-in__subtitle mb-2"><?php echo smarty_modifier_lang('Terms_of_use');?>
</div>
                                        <div class="card card-body px-0 border-primary">
                                            <div class="sign-in__rule">
                                                <?php if ($_smarty_tpl->tpl_vars['_CONFIG']->value['terms_of_use']) {?>
                                                <?php echo htmlDecode($_smarty_tpl->tpl_vars['_CONFIG']->value['terms_of_use']);?>

                                                <?php } else { ?>
                                                <?php echo smarty_modifier_lang('Updating');?>

                                                <?php }?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php }?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section><?php }
}
