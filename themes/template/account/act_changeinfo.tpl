<div class="container pt-40">
    <div class="row">
        <div class="col-xl-9 col-lg-8 mb-50 order-lg-1">
            <section class="profile-section">
                <h2 class="profile-section__title">Đổi email</h2>
                <form method="post">
                    <div class="form-group row">
                        <label class="col-form-label col-md-3">Email mới:</label>
                        <div class="col-md-9">
                            <input class="form-control" type="email" name="email" placeholder="{$core->_USER.email}" value="{$smarty.post.email}" required>
                            {if $msg_error.email ne ''}<div class="text-danger">{$msg_error.email}</div>{/if}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-3">Mật khẩu:</label>
                        <div class="col-md-9">
                            <input class="form-control" type="password" name="user_pass" value="{$smarty.post.user_pass}" required>
                            {if $msg_error.user_pass1 ne ''}<div class="text-danger">{$msg_error.user_pass1}</div>{/if}
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
                            <input class="form-control" type="tel" name="phone" placeholder="{$core->_USER.mobile}" value="{$smarty.post.phone}" required>
                            {if $msg_error.phone ne ''}<div class="text-danger">{$msg_error.phone}</div>{/if}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-3">Mật khẩu:</label>
                        <div class="col-md-9">
                            <input class="form-control" type="password" name="user_pass" value="{$smarty.post.user_pass}" required>
                            {if $msg_error.user_pass2 ne ''}<div class="text-danger">{$msg_error.user_pass2}</div>{/if}
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
                            <input class="form-control" type="password" name="user_pass_old" value="{$smarty.post.user_pass_old}" required>
                            {if $msg_error.user_pass_old ne ''}<div class="text-danger">{$msg_error.user_pass_old}</div>{/if}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-3">Mật khẩu mới:</label>
                        <div class="col-md-9">
                            <input class="form-control" type="password" name="user_pass" value="{$smarty.post.user_pass}" required>
                            {if $msg_error.user_pass.0 ne ''}<div class="text-danger">{$msg_error.user_pass.0}</div>{/if}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-3">Nhập lại mật khẩu mới:</label>
                        <div class="col-md-9">
                            <input class="form-control" type="password" name="user_pass_confirm"  value="{$smarty.post.user_pass_confirm}" required>
                            {if $msg_error.user_pass.1 ne ''}<div class="text-danger">{$msg_error.user_pass.1}</div>{/if}
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
                        <a class="nav-link" href="{$Rewrite->url_history()}">
                            <i class="fa fa-file-text-o mr-3"></i>
                            <span>Khoá học của tôi</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{$Rewrite->url_account()}">
                            <i class="fa fa-user mr-3"></i>
                            <span>Thông tin cá nhân</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{$Rewrite->url_logout()}">
                            <i class="fa fa-power-off mr-3"></i>
                            <span>Đăng xuất</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>