<?php
/* Smarty version 3.1.32, created on 2023-05-19 14:06:39
  from '/var/www/koseionline/data/www/koseionline.vn/themes/template/account/act_login.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_64671fff972a79_74892202',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '783a2ef5e4e12496a1f49ff5ab65b2cd21a34782' => 
    array (
      0 => '/var/www/koseionline/data/www/koseionline.vn/themes/template/account/act_login.tpl',
      1 => 1669775156,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_64671fff972a79_74892202 (Smarty_Internal_Template $_smarty_tpl) {
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
      <li class="breadcrumb-item active"><?php echo smarty_modifier_lang('Login');?>
</li>
    </ol>
  </div>
</nav>
<section class="mb-50">
  <div class="container">
    <div class="row">
      <div class="col-xl-6 offset-xl-3">
        <div class="sign-in card border-primary">
          <div class="card-header bg-primary text-white">
            <h2 class="card-title"><?php echo smarty_modifier_lang('Login');?>
</h2>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <form method="POST" id="fLogin" name="fLogin">
                  <div class="form-group">
                    <div class="form-control-icon form-control-icon-user">
                      <input class="form-control" type="text" placeholder="<?php echo smarty_modifier_lang('User_name');?>
" id="user_name" name="user_name" value="<?php echo $_smarty_tpl->tpl_vars['user_name']->value;?>
" required>
                    </div>
                    <?php if ($_smarty_tpl->tpl_vars['arr_error']->value['user_name'] != '') {?><div class="text-danger"><?php echo $_smarty_tpl->tpl_vars['arr_error']->value['user_name'];?>
</div><?php }?>
                  </div>
                  <div class="form-group">
                    <div class="form-control-icon form-control-icon-lock">
                      <input class="form-control" type="password" placeholder="<?php echo smarty_modifier_lang('Password');?>
" id="user_pass" name="user_pass" required>
                    </div>
                    <?php if ($_smarty_tpl->tpl_vars['arr_error']->value['user_pass'] != '') {?><div class="text-danger"><?php echo $_smarty_tpl->tpl_vars['arr_error']->value['user_pass'];?>
</div><?php }?>
                  </div>
                  <div class="form-group">
                    <button class="btn btn-danger btn-block" type="submit" value="Login" name="btnLogin"><?php echo smarty_modifier_lang('Login');?>
</button>
                  </div>
                  <div>
                    <span><?php echo smarty_modifier_lang('Dont_have_an_account');?>
</span>
                    <a class="text-primary" href="<?php echo $_smarty_tpl->tpl_vars['Rewrite']->value->url_register();?>
"><?php echo smarty_modifier_lang('Register_here');?>
</a>
                  </div>
                  <div>
                    <span><?php echo smarty_modifier_lang('Forgot_your_password');?>
</span>
                    <a class="text-primary" href=".md-restore" data-toggle="modal"><?php echo smarty_modifier_lang('Click_here');?>
</a>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php }
}
