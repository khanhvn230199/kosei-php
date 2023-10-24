<?php
/* Smarty version 3.1.32, created on 2023-05-19 10:41:20
  from '/var/www/koseionline/data/www/koseionline.vn/themes/template/account/act_historylearning.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_6466efe0a46434_76022408',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '376e9b3b6338790dfc7b4ff482210fd246d6ae0c' => 
    array (
      0 => '/var/www/koseionline/data/www/koseionline.vn/themes/template/account/act_historylearning.tpl',
      1 => 1682669853,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6466efe0a46434_76022408 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/var/www/koseionline/data/www/koseionline.vn/includes/smarty3/plugins/modifier.lang.php','function'=>'smarty_modifier_lang',),1=>array('file'=>'/var/www/koseionline/data/www/koseionline.vn/includes/smarty3/plugins/modifier.durationtime_format.php','function'=>'smarty_modifier_durationtime_format',),2=>array('file'=>'/var/www/koseionline/data/www/koseionline.vn/includes/smarty3/plugins/modifier.date_format.php','function'=>'smarty_modifier_date_format',),));
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
            <li class="breadcrumb-item active"><?php echo smarty_modifier_lang('Profile');?>
</li>
        </ol>
    </div>
</nav>
<section class="section mb-50">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="profile-panel card">
                    <h2 class="card-header"><?php echo smarty_modifier_lang('Profile');?>
</h2>
                    <div class="list-group list-group-flush">
                        <a class="list-group-item list-group-item-active" href="<?php echo $_smarty_tpl->tpl_vars['Rewrite']->value->url_history();?>
">
                            <img src="<?php echo $_smarty_tpl->tpl_vars['URL_IMAGES']->value;?>
/icon-file-list.png" alt="<?php echo smarty_modifier_lang('Learning_information');?>
">
                            <span><?php echo smarty_modifier_lang('Learning_information');?>
</span>
                        </a>
                        <a class="list-group-item list-group-item-active" href="<?php echo $_smarty_tpl->tpl_vars['Rewrite']->value->url_account();?>
">
                            <img src="<?php echo $_smarty_tpl->tpl_vars['URL_IMAGES']->value;?>
/icon-user-blue.png" alt="<?php echo smarty_modifier_lang('Profile');?>
">
                            <span><?php echo smarty_modifier_lang('Profile');?>
</span>
                        </a>
                        <a class="list-group-item list-group-item-active active" href="<?php echo $_smarty_tpl->tpl_vars['Rewrite']->value->url_historylearning();?>
">
                            <img src="<?php echo $_smarty_tpl->tpl_vars['URL_IMAGES']->value;?>
/icon-file-list.png" alt="<?php echo smarty_modifier_lang('Lịch sử học tập');?>
">
                            <span><?php echo smarty_modifier_lang('Lịch sử học tập');?>
</span>
                        </a>
                        <a class="list-group-item list-group-item-active" href="<?php echo $_smarty_tpl->tpl_vars['Rewrite']->value->url_logout();?>
">
                            <img src="<?php echo $_smarty_tpl->tpl_vars['URL_IMAGES']->value;?>
/icon-power-off-blue.png" alt="<?php echo smarty_modifier_lang('Logout');?>
">
                            <span><?php echo smarty_modifier_lang('Logout');?>
</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <section class="profile-section">
                    <h2 class="profile-section__title"><?php echo smarty_modifier_lang('Khóa học đã học');?>
</h2>
                    <div class="row">
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['arrListTransactions']->value, 'transactions', false, 'j');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['j']->value => $_smarty_tpl->tpl_vars['transactions']->value) {
?>
                        <?php if ($_smarty_tpl->tpl_vars['transactions']->value['status'] == 2) {?>
                        <div class="col-sm-6 col-md-6 mb-30">
                            <div class="lesson">
                                <span class="lesson__iwrap">
                                    <img src="<?php echo $_smarty_tpl->tpl_vars['NVCMS_URL']->value;?>
/img.php?pic=<?php echo $_smarty_tpl->tpl_vars['core']->value->callfunc('base64_encode',$_smarty_tpl->tpl_vars['transactions']->value['image']);?>
&w=370&h=248&encode=1" alt="<?php echo $_smarty_tpl->tpl_vars['transactions']->value['name'];?>
" />
                                </span>
                                <h3 class="lesson__title">
                                    <p class="text-default mb-0" href="<?php echo $_smarty_tpl->tpl_vars['Rewrite']->value->url_category($_smarty_tpl->tpl_vars['transactions']->value);?>
"><?php echo $_smarty_tpl->tpl_vars['transactions']->value['name'];?>
</p>
                                    <hr class="mt-1 mb-1">
                                    <p class="text-white mb-0">Đã học: <?php echo (($tmp = @smarty_modifier_durationtime_format($_smarty_tpl->tpl_vars['transactions']->value['total_time']))===null||$tmp==='' ? 0 : $tmp);?>
</p>
                                    <hr class="mt-1 mb-1">
                                    <p class="text-white mb-0">Lần đầu học: <?php echo (($tmp = @smarty_modifier_date_format($_smarty_tpl->tpl_vars['transactions']->value['first_time'],"%d/%m/%Y %H:%M"))===null||$tmp==='' ? 0 : $tmp);?>
</p>
                                    <hr class="mt-1 mb-1">
                                    <p class="text-white mb-0">Lần cuối học: <?php echo (($tmp = @smarty_modifier_date_format($_smarty_tpl->tpl_vars['transactions']->value['last_time'],"%d/%m/%Y %H:%M"))===null||$tmp==='' ? 0 : $tmp);?>
</p>
                                    <hr class="mt-1 mb-1">
                                    <p class="text-white mb-0">
                                        <a class="btn btn-info" href="?cid=<?php echo $_smarty_tpl->tpl_vars['transactions']->value['cat_id'];?>
">Chi tiết thời gian</a>
                                    </p>
                                </h3>
                            </div>
                        </div>
                        <?php }?>
                        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    </div>
                </section>
            </div>
        </div>
    </div>
</section>
<?php if ($_smarty_tpl->tpl_vars['stages']->value) {?>
<!-- thông báo bài học đã học gần đây nhất cho học viên -->
<div class="md-video md-video-1 modal fade" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered" style="width: 350px;">
        <div class="modal-content">
            <div class="modal-body md-video__body">
                <button class="md-video__close" data-dismiss="modal"></button>
                <a href="<?php echo $_smarty_tpl->tpl_vars['Rewrite']->value->url_lesson($_smarty_tpl->tpl_vars['arrOneLesson']->value);?>
"><img class="d-block w-100" src="<?php echo $_smarty_tpl->tpl_vars['URL_UPLOADS']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['arrOneLesson']->value['image'];?>
" alt="<?php echo $_smarty_tpl->tpl_vars['adver']->value['title'];?>
" /></a>
                <p style="text-align: center; font-weight: bold;font-size: 20px">Bài học gần nhất bạn đã học <br><a href="<?php echo $_smarty_tpl->tpl_vars['Rewrite']->value->url_lesson($_smarty_tpl->tpl_vars['arrOneLesson']->value);?>
"><?php echo $_smarty_tpl->tpl_vars['arrOneLesson']->value['name'];?>
</a></p>
                <div class="st_learning_history">
                    <ul class="st_learning">
                        <li class="h-links__item h-links__item--desktop">
                            <a class="h-links__link bg-primary" href="<?php echo $_smarty_tpl->tpl_vars['Rewrite']->value->url_lesson($_smarty_tpl->tpl_vars['arrOneLesson']->value);?>
" onclick="deletetMenuClicked();">
                                <i class="fa fa-user-circle-o fa fw mr-1"></i>
                                <span>Ôn Lại</span>
                            </a>
                        </li>
                        <li class="h-links__item h-links__item--desktop">
                            <a class="h-links__link" href="<?php echo $_smarty_tpl->tpl_vars['Rewrite']->value->url_category($_smarty_tpl->tpl_vars['arrOneCourse']->value);?>
">
                                <i class="fa fa-sign-out fa fw mr-1"></i>
                                <span>Học Tiếp</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End -->
<section class="section" style="margin-bottom: 20px;">
    <div class="container">
        <h2 class="section__title text-uppercase"><?php echo $_smarty_tpl->tpl_vars['arrOneCourse']->value['name'];?>
</h2>
        <?php if (!$_smarty_tpl->tpl_vars['hideSection']->value) {?>
        <section class="aside-2">
            <?php }?>
            <ul class="nav n-tabs n-tabs--sm">
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['stages']->value, 'stage', false, 'ls');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['ls']->value => $_smarty_tpl->tpl_vars['stage']->value) {
?>
                <li class="nav-item"><a class="nav-link <?php if ($_smarty_tpl->tpl_vars['ls']->value == 0) {?>active<?php }?>" href="#<?php echo $_smarty_tpl->tpl_vars['prev']->value;?>
-tab-<?php echo $_smarty_tpl->tpl_vars['ls']->value+1;?>
" data-toggle="tab"><img class="n-tabs__bg" src="<?php echo $_smarty_tpl->tpl_vars['URL_IMAGES']->value;?>
/n-tab-link-bg.png" alt=""><span><?php echo $_smarty_tpl->tpl_vars['stage']->value['name'];?>
</span></a></li>
                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            </ul>
            <div class="n-tabs-content n-tabs-content--aside">
                <div class="tab-content">
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['stages']->value, 'stage', false, 'ls');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['ls']->value => $_smarty_tpl->tpl_vars['stage']->value) {
?>
                    <div class="tab-pane fade show <?php if ($_smarty_tpl->tpl_vars['ls']->value == 0) {?>active<?php }?>" id="<?php echo $_smarty_tpl->tpl_vars['prev']->value;?>
-tab-<?php echo $_smarty_tpl->tpl_vars['ls']->value+1;?>
">
                        <ul class="nav as-nav">
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['stage']->value['cats'], 'subStage', false, 'sc');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['sc']->value => $_smarty_tpl->tpl_vars['subStage']->value) {
?>
                            <li class="nav-item"><a class="nav-link" href="#<?php echo $_smarty_tpl->tpl_vars['prev']->value;?>
-tab-<?php echo $_smarty_tpl->tpl_vars['ls']->value+1;?>
-<?php echo $_smarty_tpl->tpl_vars['sc']->value+1;?>
" data-toggle="tab"><span><?php echo $_smarty_tpl->tpl_vars['subStage']->value['name'];?>
</span><img src="<?php echo $_smarty_tpl->tpl_vars['URL_UPLOADS']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['subStage']->value['image'];?>
" alt=""></a></li>
                            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        </ul>
                        <div class="tab-content">
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['stage']->value['cats'], 'subStage', false, 'sc');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['sc']->value => $_smarty_tpl->tpl_vars['subStage']->value) {
?>
                            <div class="tab-pane fade" id="<?php echo $_smarty_tpl->tpl_vars['prev']->value;?>
-tab-<?php echo $_smarty_tpl->tpl_vars['ls']->value+1;?>
-<?php echo $_smarty_tpl->tpl_vars['sc']->value+1;?>
">
                                <ul class="n-menu mt-20">
                                    <li class="n-menu__title">Video bài học</li>
                                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['subStage']->value['lessons'], 'les', false, 'j');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['j']->value => $_smarty_tpl->tpl_vars['les']->value) {
?>
                                    <li class="n-menu__item">
                                        <a class="n-menu__link" href="#!"><?php echo $_smarty_tpl->tpl_vars['les']->value['name'];?>
</a>
                                        <ul class="n-menu__sub">
                                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['les']->value['sublessons'], 'sub', false, 'j');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['j']->value => $_smarty_tpl->tpl_vars['sub']->value) {
?>
                                            <li class="n-menu__item">
                                                <a class="n-menu__link" href="<?php echo $_smarty_tpl->tpl_vars['Rewrite']->value->url_lesson($_smarty_tpl->tpl_vars['sub']->value);?>
"> <?php echo $_smarty_tpl->tpl_vars['sub']->value['name'];?>

                                                    <?php if ($_smarty_tpl->tpl_vars['sub']->value['total_time'] > 0) {?>
                                                    <small class="text-danger">(Đã học)</small>
                                                    <small class="text-danger">(Đã học  : <?php echo (($tmp = @smarty_modifier_durationtime_format($_smarty_tpl->tpl_vars['sub']->value['total_time']))===null||$tmp==='' ? 0 : $tmp);?>
)</small>
                                                    <?php }?>
                                                </a>
                                                                                            </li>
                                            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                        </ul>
                                    </li>
                                    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                </ul>
                            </div>
                            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        </div>
                    </div>
                    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                </div>
            </div>
            <?php if (!$_smarty_tpl->tpl_vars['hideSection']->value) {?>
        </section>
        <?php }?>
</section>
<?php }
}
}
