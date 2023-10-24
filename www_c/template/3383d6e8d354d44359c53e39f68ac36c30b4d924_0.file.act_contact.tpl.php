<?php
/* Smarty version 3.1.32, created on 2023-05-20 14:54:41
  from '/var/www/koseionline/data/www/koseionline.vn/themes/template/home/act_contact.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_64687cc12a3487_70960379',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3383d6e8d354d44359c53e39f68ac36c30b4d924' => 
    array (
      0 => '/var/www/koseionline/data/www/koseionline.vn/themes/template/home/act_contact.tpl',
      1 => 1670384112,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_64687cc12a3487_70960379 (Smarty_Internal_Template $_smarty_tpl) {
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
            <li class="breadcrumb-item active"><?php echo smarty_modifier_lang('Contact');?>
</li>
        </ol>
    </div>
</nav>
<section class="mb-30">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 mb-30">
                <!-- contact infomation-->
                <article class="ct-info">
                    <h2 class="ct-info__title text-uppercase"><?php echo smarty_modifier_lang('Contact_us');?>
</h2>
                    <div class="ct-info__content mb-20">
                        <?php echo htmlDecode($_smarty_tpl->tpl_vars['_CONFIG']->value['contact_info']);?>

                    </div>
                    <?php echo $_smarty_tpl->tpl_vars['core']->value->echoAdverNonTime('CN','branch');?>

                </article>
            </div>
            <div class="col-lg-6 mb-30">
                <!-- contact form-->
                <form class="ct-form" method="post">
                    <div class="form-group">
                        <label>
                            <span><?php echo $_smarty_tpl->tpl_vars['core']->value->getLang('Your_name');?>
</span>
                            <span class="text-danger">*</span>
                        </label>
                        <input class="form-control" name="name" type="text" id="name" placeholder="<?php echo $_smarty_tpl->tpl_vars['core']->value->getLang('Your_name');?>
" required="required">
                    </div>
                    <div class="form-group">
                        <label>
                            <span><?php echo $_smarty_tpl->tpl_vars['core']->value->getLang('Phone');?>
</span>
                            <span class="text-danger">*</span>
                        </label>
                        <input class="form-control" type="tel" name="phone" id="phone" placeholder="<?php echo $_smarty_tpl->tpl_vars['core']->value->getLang('Phone');?>
" required="required">
                    </div>
                    <div class="form-group">
                        <label>
                            <span>Email</span>
                            <span class="text-danger">*</span>
                        </label>
                        <input class="form-control" type="email" name="email" id="email" placeholder="<?php echo $_smarty_tpl->tpl_vars['core']->value->getLang('Email');?>
" required="required">
                    </div>
                    <div class="form-group">
                        <label>
                            <span><?php echo $_smarty_tpl->tpl_vars['core']->value->getLang('Title');?>
</span>
                        </label>
                        <input class="form-control" type="text" name="title" id="title" placeholder="<?php echo $_smarty_tpl->tpl_vars['core']->value->getLang('Title');?>
" required="required">
                    </div>
                    <div class="form-group">
                        <label>
                            <span><?php echo $_smarty_tpl->tpl_vars['core']->value->getLang('Content');?>
</span>
                            <span class="text-danger">*</span>
                        </label>
                        <textarea class="form-control" id="content" name="content" placeholder="<?php echo $_smarty_tpl->tpl_vars['core']->value->getLang('Content');?>
" rows="7"></textarea>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary text-700 text-uppercase" name="btnSend" value="<?php echo $_smarty_tpl->tpl_vars['core']->value->getLang('Submmit_now');?>
" type="submit"><?php echo smarty_modifier_lang('Contact_now');?>
</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section><?php }
}
