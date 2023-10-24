<div class="row">
    <div class="col-xl-6 offset-xl-3">
        <div class="sign-in card border-primary">
            <div class="card-header bg-primary text-white">
                <h2 class="card-title">{'Please_login_to_view_this_content'|lang}</h2>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <form id="login_form" action="" method="POST" onsubmit="ajax_login();return false;">
                            <div class="form-group">
                                <div class="form-control-icon form-control-icon-user">
                                    <input class="form-control" type="text" name="user_name" placeholder="{'User_name'|lang}" required/>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-control-icon form-control-icon-lock">
                                    <input class="form-control" type="password" name="user_pass"
                                           placeholder="{'Password'|lang}" required/>
                                </div>
                                <div class="form-text mt-2">
                                    <a class="text-default text-muted mr-2 js-restore-btn" href=".md-restore" data-toggle="modal">{'Forgot_your_password'|lang}?</a>
                                    <a class="text-default text-muted" href="{$Rewrite->url_register()}">{'Register_now'|lang}</a> {'If_you_do_not_have_an_account'|lang}
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="btnLogin" value="{'Login'|lang} ">
                                <button class="btn btn-block btn-danger" type="submit">{'Login'|lang}</button>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <a class="btn btn-block btn-facebook text-white"
                                           href="{$Rewrite->url_fbauth()}">
                                            <i class="fa fa-facebook mr-2"></i>
                                            <span>Facebook</span>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <a class="btn btn-block btn-google-plus text-white"
                                           href="{$Rewrite->url_ggauth()}">
                                            <i class="fa fa-google mr-2"></i>
                                            <span>Google</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>