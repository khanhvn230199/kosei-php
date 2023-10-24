<?php
/* Smarty version 3.1.32, created on 2021-06-08 14:13:47
  from '/var/www/koseionline.vn/data/www/koseionline.vn/themes/template/home/act_contact.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_60bf18ab0aa593_48180141',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f8ab41935fd5234ad66d7f8e7d883b7684345134' => 
    array (
      0 => '/var/www/koseionline.vn/data/www/koseionline.vn/themes/template/home/act_contact.tpl',
      1 => 1618904760,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60bf18ab0aa593_48180141 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/var/www/koseionline.vn/data/www/koseionline.vn/includes/smarty3/plugins/modifier.lang.php','function'=>'smarty_modifier_lang',),));
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
