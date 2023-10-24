<?php
/* Smarty version 3.1.32, created on 2022-06-25 10:29:58
  from '/var/www/koseionline.vn/data/www/koseionline.vn/themes/template/account/act_resetpass.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_62b68136a9e2b4_91062540',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'db40049f4670cc9d7c397949a0361a8758373201' => 
    array (
      0 => '/var/www/koseionline.vn/data/www/koseionline.vn/themes/template/account/act_resetpass.tpl',
      1 => 1618904756,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_62b68136a9e2b4_91062540 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/var/www/koseionline.vn/data/www/koseionline.vn/includes/smarty3/plugins/modifier.lang.php','function'=>'smarty_modifier_lang',),));
?><div class="bg-gray my-2">
    <div class="container">
        <div class="row">
            <?php if ($_GET['success'] == 1) {?>
            <div class="col-md-12 mb-4 mt-4">
                <h2 class="text-danger"><?php echo smarty_modifier_lang('Reset_password');?>
!</h2>
                <p><?php echo smarty_modifier_lang('Reset_password_success_notice1');?>
</p>
                <p class="mt-3"><a href="/login"><?php echo smarty_modifier_lang('Sign_in');?>
</a> <?php echo smarty_modifier_lang('To_manage_your_account');?>
.</p>
            </div>
            <?php } elseif ($_smarty_tpl->tpl_vars['existskey']->value == 0) {?>
            <div class="col-md-12 mb-4 mt-4">
                <h2 class="text-danger"><?php echo smarty_modifier_lang('Reset_password');?>
!</h2>
                <p class="text-danger"><?php echo smarty_modifier_lang('This_link_is_not_correct_or_expired');?>
</p>
                <p class="mt-3"><a href=".md-login" data-toggle="modal"><?php echo smarty_modifier_lang('Sign_in');?>
</a> <?php echo smarty_modifier_lang('To_manage_your_account');?>
.</p>
            </div>
            <?php } else { ?>
            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-8 mx-auto">
                <form class="m-form sign-in-form" action="" method="POST" id="fForgot" name="fForgot" class="fLoginRegister">
                    <h2 class="text-danger"><?php echo smarty_modifier_lang('Create_new_password');?>
!</h2>
                    <div class="form-group">
                        <input class="form-control" type="password" placeholder="<?php echo smarty_modifier_lang('Password');?>
" id="user_pass" name="user_pass" value="<?php echo $_POST['user_pass'];?>
" required>
                        <?php if ($_smarty_tpl->tpl_vars['arr_error']->value['user_pass'][0] != '') {?><div class="text-danger"><?php echo $_smarty_tpl->tpl_vars['arr_error']->value['user_pass'][0];?>
</div><?php }?>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="password" placeholder="<?php echo smarty_modifier_lang('Confirm_password');?>
" id="user_pass_confirm" name="user_pass_confirm" required>
                        <?php if ($_smarty_tpl->tpl_vars['arr_error']->value['user_pass'][1] != '') {?><div class="text-danger"><?php echo $_smarty_tpl->tpl_vars['arr_error']->value['user_pass'][1];?>
</div><?php }?>
                    </div>
                    <button class="m-form__btn btn btn-block rounded-0" type="submit" value="Login" name="btnReset" value="Create" style="background: #dc2428;
    color: white;
    text-transform: uppercase;
    font-weight: bold;"><?php echo smarty_modifier_lang('Create_password');?>
</button>
    <br>
                    <div class="m-form__text">
                        <p>
                            <span><?php echo smarty_modifier_lang('Dont_have_an_account');?>
</span>
                            <a href="/register"><?php echo smarty_modifier_lang('Register_here');?>
</a>
                        </p>
                        <p>
                            <span class="uppercase"><?php echo smarty_modifier_lang('Or');?>
</span>
                            <a href="/login"><?php echo smarty_modifier_lang('Sign_in');?>
</a>
                        </p>
                    </div>
                </form>
            </div>
            <?php }?>
        </div>
    </div>
</div><?php }
}
