<?php
/* Smarty version 3.1.32, created on 2021-06-08 20:08:18
  from '/var/www/koseionline.vn/data/www/koseionline.vn/themes/template/_blocks/login_form.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_60bf6bc2f1ce59_33357320',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '792b1e1e4e067c0d2898f8c5a7478ab00ed2f209' => 
    array (
      0 => '/var/www/koseionline.vn/data/www/koseionline.vn/themes/template/_blocks/login_form.tpl',
      1 => 1618904766,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60bf6bc2f1ce59_33357320 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/var/www/koseionline.vn/data/www/koseionline.vn/includes/smarty3/plugins/modifier.lang.php','function'=>'smarty_modifier_lang',),));
?><div class="row">
    <div class="col-xl-6 offset-xl-3">
        <div class="sign-in card border-primary">
            <div class="card-header bg-primary text-white">
                <h2 class="card-title"><?php echo smarty_modifier_lang('Please_login_to_view_this_content');?>
</h2>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <form id="login_form" action="" method="POST" onsubmit="ajax_login();return false;">
                            <div class="form-group">
                                <div class="form-control-icon form-control-icon-user">
                                    <input class="form-control" type="text" name="user_name" placeholder="<?php echo smarty_modifier_lang('User_name');?>
" required/>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-control-icon form-control-icon-lock">
                                    <input class="form-control" type="password" name="user_pass"
                                           placeholder="<?php echo smarty_modifier_lang('Password');?>
" required/>
                                </div>
                                <div class="form-text mt-2">
                                    <a class="text-default text-muted mr-2 js-restore-btn" href=".md-restore" data-toggle="modal"><?php echo smarty_modifier_lang('Forgot_your_password');?>
?</a>
                                    <a class="text-default text-muted" href="<?php echo $_smarty_tpl->tpl_vars['Rewrite']->value->url_register();?>
"><?php echo smarty_modifier_lang('Register_now');?>
</a> <?php echo smarty_modifier_lang('If_you_do_not_have_an_account');?>

                                </div>
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
                                        <a class="btn btn-block btn-facebook text-white"
                                           href="<?php echo $_smarty_tpl->tpl_vars['Rewrite']->value->url_fbauth();?>
">
                                            <i class="fa fa-facebook mr-2"></i>
                                            <span>Facebook</span>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <a class="btn btn-block btn-google-plus text-white"
                                           href="<?php echo $_smarty_tpl->tpl_vars['Rewrite']->value->url_ggauth();?>
">
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
</div><?php }
}
