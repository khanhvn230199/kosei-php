<?php
/* Smarty version 3.1.32, created on 2023-05-19 15:38:08
  from '/var/www/koseionline/data/www/koseionline.vn/themes/template/account/act_activeacc.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_646735705d5067_32838307',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c2fd01a5f0211568f9f20db1d8bbbfb52d194899' => 
    array (
      0 => '/var/www/koseionline/data/www/koseionline.vn/themes/template/account/act_activeacc.tpl',
      1 => 1669775156,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_646735705d5067_32838307 (Smarty_Internal_Template $_smarty_tpl) {
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
            <li class="breadcrumb-item active"><?php echo smarty_modifier_lang('Activation_account');?>
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
                        <h2 class="card-title"><?php echo smarty_modifier_lang('Activation_account');?>
</h2>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <?php if ($_smarty_tpl->tpl_vars['success']->value == 1) {?>
                                    <p class="text-success"><strong><?php echo smarty_modifier_lang('Activation_account_successfully');?>
!</strong></p>
                                    <p class="mt-3"><?php echo smarty_modifier_lang('Thank_you_for_register_to');?>
 <a href=".md-login" data-toggle="modal"><?php echo smarty_modifier_lang('Sign_in');?>
</a> <?php echo smarty_modifier_lang('To_manage_your_account');?>
.</p>
                                <?php } elseif ($_smarty_tpl->tpl_vars['success']->value == -1) {?>
                                    <p class="text-danger"><strong><?php echo smarty_modifier_lang('Activation_account_unsuccessfully');?>
!</strong></p>
                                    <p class="mt-3"><?php echo smarty_modifier_lang('Activation_fail_notice');?>
.</p>
                                <?php } else { ?>
                                    <p class="text-danger"><?php echo smarty_modifier_lang('Error_occur_when_activation');?>
.</p>
                                <?php }?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section><?php }
}
