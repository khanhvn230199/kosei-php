<?php
/* Smarty version 3.1.32, created on 2021-06-09 11:46:15
  from '/var/www/koseionline.vn/data/www/koseionline.vn/themes/template/account/act_changeinfo.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_60c04797689628_63754229',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a56c9b5fece75a7ad90f6eeab50690d9679cbcd2' => 
    array (
      0 => '/var/www/koseionline.vn/data/www/koseionline.vn/themes/template/account/act_changeinfo.tpl',
      1 => 1618904756,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60c04797689628_63754229 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="container pt-40">
    <div class="row">
        <div class="col-xl-9 col-lg-8 mb-50 order-lg-1">
            <section class="profile-section">
                <h2 class="profile-section__title">Đổi email</h2>
                <form method="post">
                    <div class="form-group row">
                        <label class="col-form-label col-md-3">Email mới:</label>
                        <div class="col-md-9">
                            <input class="form-control" type="email" name="email" placeholder="<?php echo $_smarty_tpl->tpl_vars['core']->value->_USER['email'];?>
" value="<?php echo $_POST['email'];?>
" required>
                            <?php if ($_smarty_tpl->tpl_vars['msg_error']->value['email'] != '') {?><div class="text-danger"><?php echo $_smarty_tpl->tpl_vars['msg_error']->value['email'];?>
</div><?php }?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-3">Mật khẩu:</label>
                        <div class="col-md-9">
                            <input class="form-control" type="password" name="user_pass" value="<?php echo $_POST['user_pass'];?>
" required>
                            <?php if ($_smarty_tpl->tpl_vars['msg_error']->value['user_pass1'] != '') {?><div class="text-danger"><?php echo $_smarty_tpl->tpl_vars['msg_error']->value['user_pass1'];?>
</div><?php }?>
                        </div>
                    </div>
                    <div class="text-center">
                        <button class="btn btn-primary text-bold px-35" type="submit" name="btnChangeEmail" value="save">ĐỔI</button>
                    </div>
                </form>
            </section>
            <section class="profile-section">
                <h2 class="profile-section__title">Đổi số điện thoại</h2>
                <form method="post">
                    <div class="form-group row">
                        <label class="col-form-label col-md-3">Số điện thoại mới:</label>
                        <div class="col-md-9">
                            <input class="form-control" type="tel" name="phone" placeholder="<?php echo $_smarty_tpl->tpl_vars['core']->value->_USER['mobile'];?>
" value="<?php echo $_POST['phone'];?>
" required>
                            <?php if ($_smarty_tpl->tpl_vars['msg_error']->value['phone'] != '') {?><div class="text-danger"><?php echo $_smarty_tpl->tpl_vars['msg_error']->value['phone'];?>
</div><?php }?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-3">Mật khẩu:</label>
                        <div class="col-md-9">
                            <input class="form-control" type="password" name="user_pass" value="<?php echo $_POST['user_pass'];?>
" required>
                            <?php if ($_smarty_tpl->tpl_vars['msg_error']->value['user_pass2'] != '') {?><div class="text-danger"><?php echo $_smarty_tpl->tpl_vars['msg_error']->value['user_pass2'];?>
</div><?php }?>
                        </div>
                    </div>
                    <div class="text-center">
                        <button class="btn btn-primary text-bold px-35" type="submit" name="btnChangePhone" value="save">ĐỔI</button>
                    </div>
                </form>
            </section>
            <section class="profile-section">
                <h2 class="profile-section__title">Đổi mật khẩu</h2>
                <form method="post">
                    <div class="form-group row">
                        <label class="col-form-label col-md-3">Mật khẩu cũ:</label>
                        <div class="col-md-9">
                            <input class="form-control" type="password" name="user_pass_old" value="<?php echo $_POST['user_pass_old'];?>
" required>
                            <?php if ($_smarty_tpl->tpl_vars['msg_error']->value['user_pass_old'] != '') {?><div class="text-danger"><?php echo $_smarty_tpl->tpl_vars['msg_error']->value['user_pass_old'];?>
</div><?php }?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-3">Mật khẩu mới:</label>
                        <div class="col-md-9">
                            <input class="form-control" type="password" name="user_pass" value="<?php echo $_POST['user_pass'];?>
" required>
                            <?php if ($_smarty_tpl->tpl_vars['msg_error']->value['user_pass'][0] != '') {?><div class="text-danger"><?php echo $_smarty_tpl->tpl_vars['msg_error']->value['user_pass'][0];?>
</div><?php }?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-3">Nhập lại mật khẩu mới:</label>
                        <div class="col-md-9">
                            <input class="form-control" type="password" name="user_pass_confirm"  value="<?php echo $_POST['user_pass_confirm'];?>
" required>
                            <?php if ($_smarty_tpl->tpl_vars['msg_error']->value['user_pass'][1] != '') {?><div class="text-danger"><?php echo $_smarty_tpl->tpl_vars['msg_error']->value['user_pass'][1];?>
</div><?php }?>
                        </div>
                    </div>
                    <div class="text-center">
                        <button class="btn btn-primary text-bold px-35" type="submit" name="btnChangePass" value="save">ĐỔI</button>
                    </div>
                </form>
            </section>
        </div>
        <div class="col-xl-3 col-lg-4 mb-50">
            <div class="sidebar card">
                <h2 class="sidebar__header card-header">THÔNG TIN CÁ NHÂN</h2>
                <ul class="sidebar__nav nav">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $_smarty_tpl->tpl_vars['Rewrite']->value->url_history();?>
">
                            <i class="fa fa-file-text-o mr-3"></i>
                            <span>Khoá học của tôi</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="<?php echo $_smarty_tpl->tpl_vars['Rewrite']->value->url_account();?>
">
                            <i class="fa fa-user mr-3"></i>
                            <span>Thông tin cá nhân</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $_smarty_tpl->tpl_vars['Rewrite']->value->url_logout();?>
">
                            <i class="fa fa-power-off mr-3"></i>
                            <span>Đăng xuất</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div><?php }
}
