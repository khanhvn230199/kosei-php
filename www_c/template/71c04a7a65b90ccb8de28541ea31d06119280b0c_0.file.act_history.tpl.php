<?php
/* Smarty version 3.1.32, created on 2023-05-19 15:50:02
  from '/var/www/koseionline/data/www/koseionline.vn/themes/template/account/act_history.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_6467383a681921_84676266',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '71c04a7a65b90ccb8de28541ea31d06119280b0c' => 
    array (
      0 => '/var/www/koseionline/data/www/koseionline.vn/themes/template/account/act_history.tpl',
      1 => 1677816569,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:account/act_historydetail.tpl' => 1,
  ),
),false)) {
function content_6467383a681921_84676266 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/var/www/koseionline/data/www/koseionline.vn/includes/smarty3/plugins/modifier.lang.php','function'=>'smarty_modifier_lang',),1=>array('file'=>'/var/www/koseionline/data/www/koseionline.vn/includes/smarty3/plugins/modifier.date_format.php','function'=>'smarty_modifier_date_format',),));
if ($_smarty_tpl->tpl_vars['exams']->value && $_smarty_tpl->tpl_vars['candidate']->value['answers']) {
$_smarty_tpl->_subTemplateRender("file:account/act_historydetail.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
} else { ?>
<div class="container">
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
            <li class="breadcrumb-item active"><?php echo smarty_modifier_lang('Learning_information');?>
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
                        <a class="list-group-item list-group-item-active active" href="javascript:;">
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
                        <a class="list-group-item list-group-item-active" href="<?php echo $_smarty_tpl->tpl_vars['Rewrite']->value->url_historylearning();?>
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
                    <h2 class="profile-section__title"><?php echo smarty_modifier_lang('Registered_courses');?>
</h2>
                    <div class="row">
                        <?php if ($_smarty_tpl->tpl_vars['arrListTransactions']->value) {?>
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['arrListTransactions']->value, 'transsaction', false, 't');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['t']->value => $_smarty_tpl->tpl_vars['transsaction']->value) {
?>
                        <div class="col-sm-6 col-md-4 mb-30">
                            <div class="lesson">
                                <a class="lesson__iwrap" href="<?php echo $_smarty_tpl->tpl_vars['Rewrite']->value->url_category($_smarty_tpl->tpl_vars['transsaction']->value);?>
">
                                    <img src="<?php echo $_smarty_tpl->tpl_vars['NVCMS_URL']->value;?>
/img.php?pic=<?php echo $_smarty_tpl->tpl_vars['core']->value->callfunc('base64_encode',$_smarty_tpl->tpl_vars['transsaction']->value['image']);?>
&w=370&h=248&encode=1" alt="<?php echo $_smarty_tpl->tpl_vars['transsaction']->value['name'];?>
" />
                                </a>
                                <div class="lesson__message" style="background-color: <?php if ($_smarty_tpl->tpl_vars['transsaction']->value['status'] == 0) {?>orange<?php } elseif ($_smarty_tpl->tpl_vars['transsaction']->value['status'] == 2) {?>green<?php }?>">
                                    <?php if ($_smarty_tpl->tpl_vars['transsaction']->value['status'] == 0) {?>
                                    <?php echo smarty_modifier_lang('Wait_for_pay');?>

                                    <?php } elseif ($_smarty_tpl->tpl_vars['transsaction']->value['status'] == 1) {?>
                                    <?php echo smarty_modifier_lang('Unpaid');?>

                                    <?php } else { ?>
                                    <?php echo smarty_modifier_lang('Paid');?>

                                    <?php }?>
                                </div>
                                <h3 class="lesson__title">
                                    <a class="text-default" href="<?php echo $_smarty_tpl->tpl_vars['Rewrite']->value->url_category($_smarty_tpl->tpl_vars['transsaction']->value);?>
"><?php echo $_smarty_tpl->tpl_vars['transsaction']->value['name'];?>
</a>
                                </h3>
                            </div>
                        </div>
                        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        <?php }?>
                    </div>
                </section>
            </div>
        </div>
    </div>
</section>
<?php if ($_smarty_tpl->tpl_vars['candidates']->value) {?>
<section class="section">
    <div class="container">
        <h2 class="section__title text-uppercase"><?php echo smarty_modifier_lang('Trial_exam_history');?>
</h2>
        <div class="row">
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['candidates']->value, 'candidate', false, 'e');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['e']->value => $_smarty_tpl->tpl_vars['candidate']->value) {
?>
            <div class="col-lg-4 col-sm-6 mb-30">
                <div class="exam card card-body">
                    <h3 class="exam__title">
                        <a class="text-default" href="<?php echo $_smarty_tpl->tpl_vars['Rewrite']->value->url_history();?>
?candidate_id=<?php echo $_smarty_tpl->tpl_vars['candidate']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['candidate']->value['name'];?>
</a>
                    </h3>
                    <div class="d-flex align-items-center mb-3">
                        <i class="fa fa-clock-o mr-1"></i>
                        <span><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['candidate']->value['reg_date'],"%D %r");?>
</span>
                    </div>
                    <div class="highscore__item"><strong>Tổng điểm:</strong><strong class="text-danger"><?php echo $_smarty_tpl->tpl_vars['candidate']->value['total_score'];?>
/180</strong></div>
                    <div class="highscore__item"><span>Từ vựng + Ngữ pháp:</span><strong class="text-danger"><?php echo $_smarty_tpl->tpl_vars['candidate']->value['vocabulary_score'];?>
/60</strong></div>
                    <div class="highscore__item"><span>Đọc hiểu:</span><strong class="text-danger"><?php echo $_smarty_tpl->tpl_vars['candidate']->value['reading_score'];?>
/60</strong></div>
                    <div class="highscore__item"><span>Nghe hiểu:</span><strong class="text-danger"><?php echo $_smarty_tpl->tpl_vars['candidate']->value['listening_score'];?>
/60</strong></div>
                    <div class="nav justify-content-end">
                        <a class="exam__link btn btn-primary mt-20" href="<?php echo $_smarty_tpl->tpl_vars['Rewrite']->value->url_history();?>
?candidate_id=<?php echo $_smarty_tpl->tpl_vars['candidate']->value['id'];?>
">Xem chi tiết</a>
                    </div>
                </div>
            </div>
            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        </div>
</section>
<?php }
}
}
}
