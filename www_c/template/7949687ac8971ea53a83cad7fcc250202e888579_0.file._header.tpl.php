<?php
/* Smarty version 3.1.32, created on 2021-08-26 11:20:20
  from '/var/www/koseionline.vn/data/www/koseionline.vn/themes/template/_header.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_612716843416a8_69623311',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7949687ac8971ea53a83cad7fcc250202e888579' => 
    array (
      0 => '/var/www/koseionline.vn/data/www/koseionline.vn/themes/template/_header.tpl',
      1 => 1629951618,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:_nav.tpl' => 1,
  ),
),false)) {
function content_612716843416a8_69623311 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/var/www/koseionline.vn/data/www/koseionline.vn/includes/smarty3/plugins/modifier.lang.php','function'=>'smarty_modifier_lang',),));
?><header class="header">
    <div class="header__sticky">
        <div class="container">
            <div class="header__inner">
                <a class="header__logo" href="/"><img src="<?php echo $_smarty_tpl->tpl_vars['URL_IMAGES']->value;?>
/logo.png" alt="" /></a>
                <nav class="h-nav">
                    <a href="#!" class="h-nav__toggle">
                        <i class="fa fa-user-circle-o mr-2"></i>
                        <span>Tài khoản</span>
                        <i class="fa fa-caret-down ml-2"></i>
                    </a>
                    <div class="h-nav__dropdown">
                        <?php if ($_smarty_tpl->tpl_vars['isLogin']->value != 1) {?>
                        <a class="h-nav__item" href="<?php echo $_smarty_tpl->tpl_vars['VNCMS_URL']->value;?>
/register" onclick="deletetMenuClicked();">
                            <i class="fa fa-pencil-square-o fa-fw"></i>
                            <span class="ml-2"><?php echo smarty_modifier_lang('Register');?>
</span>
                        </a>
                        <a class="h-nav__item" href=".md-login" data-toggle="modal">
                            <i class="fa fa-lock fa-fw"></i>
                            <span class="ml-2"><?php echo smarty_modifier_lang('Login');?>
</span>
                        </a>
                        <?php } else { ?>
                        <a class="h-nav__item" href="<?php echo $_smarty_tpl->tpl_vars['Rewrite']->value->url_account();?>
" onclick="deletetMenuClicked();">
                            <i class="fa fa-user-circle-o fa-fw"></i>
                            <span class="ml-2"><?php if ($_smarty_tpl->tpl_vars['core']->value->_USER['fullname']) {
echo $_smarty_tpl->tpl_vars['core']->value->_USER['fullname'];
} else {
echo smarty_modifier_lang('Account');
}?></span>
                        </a>
                        <a class="h-nav__item" href="<?php echo $_smarty_tpl->tpl_vars['Rewrite']->value->url_logout();?>
" onclick="deletetMenuClicked();">
                            <i class="fa fa-sign-out fa-fw"></i>
                            <span class="ml-2"><?php echo smarty_modifier_lang('Logout');?>
</span>
                        </a>
                        <?php }?>
                    </div>
                </nav>
                <button class="navbar-mobile-btn d-xl-none" data-toggle="button"><i class="fa fa-bars"></i></button>
                <div class="navbar-backdrop"></div>
                <div class="navbar navbar-mobile navbar-expand-xl">
                    <div class="navbar-header">
                        <div class="navbar-title">Menu</div>
                        <button class="navbar-close" type="button" data-dismiss="modal"><i class="fa fa-arrow-left"></i></button>
                    </div>
                    <?php $_smarty_tpl->_subTemplateRender("file:_nav.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
                    <ul class="h-links">
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['arrListTopMenu']->value, 'menu', false, 'm');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['m']->value => $_smarty_tpl->tpl_vars['menu']->value) {
?>
                        <!-- Người dùng đăng nhập thanh toán mới hiển thị menu giáo trình -->
                        <?php if ($_smarty_tpl->tpl_vars['isLogin']->value == 1) {?>
                        <?php if ($_smarty_tpl->tpl_vars['m']->value == 0) {?>
                        <li class="h-links__item">
                            <a class="h-links__link" href="<?php echo $_smarty_tpl->tpl_vars['menu']->value['href'];?>
" onclick="deletetMenuClicked();">
                                <?php if ($_smarty_tpl->tpl_vars['menu']->value['image']) {?>
                                <img class="w-100 fw mr-1" src="<?php echo $_smarty_tpl->tpl_vars['VNCMS_URL']->value;?>
/img.php?pic=<?php echo $_smarty_tpl->tpl_vars['core']->value->callfunc('base64_encode',$_smarty_tpl->tpl_vars['menu']->value['image']);?>
&w=15&h=14&encode=1" onerror="this.src='<?php echo $_smarty_tpl->tpl_vars['URL_IMAGES']->value;?>
/nopic.png'" alt="<?php echo $_smarty_tpl->tpl_vars['menu']->value['title'];?>
">
                                <?php } else { ?>
                                <i class="fa <?php if ($_smarty_tpl->tpl_vars['menu']->value['icon']) {
echo $_smarty_tpl->tpl_vars['menu']->value['icon'];
} else { ?>fa-money<?php }?> fa fw mr-1"></i>
                                <?php }?>
                                <span><?php echo $_smarty_tpl->tpl_vars['menu']->value['title'];?>
</span>
                            </a>
                        </li>
                        <?php }?>
                        <?php }?>
                        <!-- End -->
                        <?php if ($_smarty_tpl->tpl_vars['m']->value > 0) {?>
                        <li class="h-links__item">
                            <a class="h-links__link" href="<?php echo $_smarty_tpl->tpl_vars['menu']->value['href'];?>
" onclick="deletetMenuClicked();">
                                <?php if ($_smarty_tpl->tpl_vars['menu']->value['image']) {?>
                                <img class="w-100 fw mr-1" src="<?php echo $_smarty_tpl->tpl_vars['VNCMS_URL']->value;?>
/img.php?pic=<?php echo $_smarty_tpl->tpl_vars['core']->value->callfunc('base64_encode',$_smarty_tpl->tpl_vars['menu']->value['image']);?>
&w=15&h=14&encode=1" onerror="this.src='<?php echo $_smarty_tpl->tpl_vars['URL_IMAGES']->value;?>
/nopic.png'" alt="<?php echo $_smarty_tpl->tpl_vars['menu']->value['title'];?>
">
                                <?php } else { ?>
                                <i class="fa <?php if ($_smarty_tpl->tpl_vars['menu']->value['icon']) {
echo $_smarty_tpl->tpl_vars['menu']->value['icon'];
} else { ?>fa-money<?php }?> fa fw mr-1"></i>
                                <?php }?>
                                <span><?php echo $_smarty_tpl->tpl_vars['menu']->value['title'];?>
</span>
                            </a>
                        </li>
                        <?php }?>
                        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        <?php if ($_smarty_tpl->tpl_vars['isLogin']->value != 1) {?>
                        <li class="h-links__item  h-links__item--desktop">
                            <a class="h-links__link" href="<?php echo $_smarty_tpl->tpl_vars['VNCMS_URL']->value;?>
/register" onclick="deletetMenuClicked();">
                                <i class="fa fa-pencil-square-o fa fw mr-1"></i>
                                <span><?php echo smarty_modifier_lang('Register');?>
</span>
                            </a>
                        </li>
                        <li class="h-links__item  h-links__item--desktop">
                            <a class="h-links__link bg-primary" href=".md-login" data-toggle="modal">
                                <i class="fa fa-lock fa fw mr-1"></i>
                                <span><?php echo smarty_modifier_lang('Login');?>
</span>
                            </a>
                        </li>
                        <?php } else { ?>
                        <li class="h-links__item h-links__item--desktop">
                            <a class="h-links__link bg-primary" href="<?php echo $_smarty_tpl->tpl_vars['Rewrite']->value->url_account();?>
" onclick="deletetMenuClicked();">
                                <i class="fa fa-user-circle-o fa fw mr-1"></i>
                                <span><?php if ($_smarty_tpl->tpl_vars['core']->value->_USER['fullname']) {
echo $_smarty_tpl->tpl_vars['core']->value->_USER['fullname'];
} else {
echo smarty_modifier_lang('Account');
}?></span>
                            </a>
                        </li>
                        <li class="h-links__item h-links__item--desktop">
                            <a class="h-links__link" href="<?php echo $_smarty_tpl->tpl_vars['Rewrite']->value->url_logout();?>
" onclick="deletetMenuClicked();">
                                <i class="fa fa-sign-out fa fw mr-1"></i>
                                <span><?php echo smarty_modifier_lang('Logout');?>
</span>
                            </a>
                        </li>
                        <?php }?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header><?php }
}
