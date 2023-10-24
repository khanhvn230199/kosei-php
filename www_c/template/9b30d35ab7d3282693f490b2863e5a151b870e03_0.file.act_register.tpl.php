<?php
/* Smarty version 3.1.32, created on 2021-11-10 07:44:49
  from '/var/www/koseionline.vn/data/www/koseionline.vn/themes/template/trialtest/act_register.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_618b16014098f8_60150209',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9b30d35ab7d3282693f490b2863e5a151b870e03' => 
    array (
      0 => '/var/www/koseionline.vn/data/www/koseionline.vn/themes/template/trialtest/act_register.tpl',
      1 => 1636476137,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_618b16014098f8_60150209 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/var/www/koseionline.vn/data/www/koseionline.vn/includes/smarty3/plugins/modifier.lang.php','function'=>'smarty_modifier_lang',),));
?><div class="container pt-5">
    <?php if ($_smarty_tpl->tpl_vars['optionLevel']->value) {?>
      <div class="row">
        <div class="col-xl-8 offset-xl-2">
          <div class="row mb-20">
            <div class="col-md-6 mb-30">
              <div class="registration-card"><?php echo smarty_modifier_lang('You_have_not_registered_for_the_test');?>
?</div>
            </div>
            <div class="col-md-6 mb-30">
              <form action="<?php echo $_smarty_tpl->tpl_vars['Rewrite']->value->url_trialtestregister();?>
" method="POST" id="fRegister"
                    name="fRegister">
                <h2 class="text-700 text-20 text-center text-uppercase"><?php echo smarty_modifier_lang('Trial_test_register');?>
</h2>
                <div class="form-group">
                  <input class="form-control" type="text" name="fullname" placeholder="Họ &amp; tên"
                         value="<?php echo $_smarty_tpl->tpl_vars['core']->value->_USER['fullname'];?>
" disabled>
                </div>
                <div class="form-group">
                  <input class="form-control" type="tel" name="mobile" placeholder="Số điện thoại"
                         value="<?php echo $_smarty_tpl->tpl_vars['core']->value->_USER['mobile'];?>
" disabled>
                </div>
                <div class="form-group">
                  <input class="form-control" type="email" name="email" placeholder="Email"
                         value="<?php echo $_smarty_tpl->tpl_vars['core']->value->_USER['email'];?>
" disabled>
                </div>
                <div class="form-group">
                  <div class="form-control-icon form-control-icon-book">
                    <select class="form-control" name="level_id" <?php if ($_GET['lid']) {?>disabled<?php }?> required>
                      <option><?php echo smarty_modifier_lang('Select_level');?>
</option>
                        <?php echo $_smarty_tpl->tpl_vars['optionLevel']->value;?>

                    </select>
                  </div>
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
                    <?php if ($_smarty_tpl->tpl_vars['arr_error']->value['agree'] != '') {?>
                      <div class="text-danger"><?php echo $_smarty_tpl->tpl_vars['arr_error']->value['agree'];?>
</div><?php }?>
                </div>
                <div class="form-group mb-0">
                  <button class="btn btn-block btn-danger text-700 text-uppercase" name="btnRegister"
                          value="Register"><?php echo smarty_modifier_lang('Register');?>
</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    <?php } else { ?>
      <div class="row">
        <div class="col-xl-8 offset-xl-2">
          <div class="alert-box">
            <div class="alert-box__wrapper">
              <img class="alert-box__bg" src="<?php echo $_smarty_tpl->tpl_vars['URL_IMAGES']->value;?>
/test-end.png" alt="test-end">
              <div class="alert-box__content">
                <div>
                  <div class="alert-box__text-1"><?php echo smarty_modifier_lang('Oh_no_the_test_has_ended');?>
</div>
                  <div class="alert-box__text-2"><?php echo smarty_modifier_lang('We_will_notify_you_when_the_next_test_is_available');?>
</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php }?>
</div>
<?php }
}
