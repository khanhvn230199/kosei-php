<?php
/* Smarty version 3.1.32, created on 2021-06-09 23:34:23
  from '/var/www/koseionline.vn/data/www/koseionline.vn/themes/template/exams/act_default.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_60c0ed8f6ab942_28384232',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd10426578264a26acb5a516ded76fca2f1e8fe63' => 
    array (
      0 => '/var/www/koseionline.vn/data/www/koseionline.vn/themes/template/exams/act_default.tpl',
      1 => 1618904758,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60c0ed8f6ab942_28384232 (Smarty_Internal_Template $_smarty_tpl) {
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
            <li class="breadcrumb-item active"><?php echo smarty_modifier_lang('JLPT_exam_inventory');?>
</li>
        </ol>
    </div>
</nav>
<section class="section mb-50">
    <div class="container">
        <h2 class="section__title text-uppercase"><?php echo smarty_modifier_lang('Practice');?>
</h2>
                <div class="tab-content">
            <?php if ($_smarty_tpl->tpl_vars['arrListExams']->value) {?>
                <div class="tab-pane fade active show" id="skill" role="tabpanel">
                    <div class="row">
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['arrListExams']->value, 'exam', false, 'e');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['e']->value => $_smarty_tpl->tpl_vars['exam']->value) {
?>
                            <div class="col-lg-4 col-sm-6 mb-30">
                                <div class="exam card card-body">
                                    <h3 class="exam__title">
                                        <a class="text-default" href="<?php echo $_smarty_tpl->tpl_vars['Rewrite']->value->url_exam_detail($_smarty_tpl->tpl_vars['exam']->value);?>
"><?php echo $_smarty_tpl->tpl_vars['exam']->value['name'];?>
</a>
                                    </h3>
                                    <div class="d-flex align-items-center mb-4">
                                        <?php if ($_smarty_tpl->tpl_vars['exam']->value['time_end']) {?>
                                            <div class="mr-20">
                                                <i class="fa fa-clock-o mr-1"></i>
                                                <span><?php echo $_smarty_tpl->tpl_vars['exam']->value['time_end'];?>
 <?php echo smarty_modifier_lang('minute');?>
</span>
                                            </div>
                                        <?php }?>
                                        <span class="exam__badge badge badge-danger"><?php echo smarty_modifier_lang('Free');?>
</span>
                                    </div>
                                    <div class="nav mb-1">
                                        <?php if ($_smarty_tpl->tpl_vars['exam']->value['list_user']) {?>
                                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['exam']->value['list_user'], 'user', false, 'u');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['u']->value => $_smarty_tpl->tpl_vars['user']->value) {
?>
                                                <a class="exam__user" href="javascript:;" title="<?php echo $_smarty_tpl->tpl_vars['user']->value['fullname'];?>
">
                                                    <img src="<?php echo $_smarty_tpl->tpl_vars['URL_IMAGES']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['user']->value['image'];?>
" onerror="this.src='<?php echo $_smarty_tpl->tpl_vars['URL_IMAGES']->value;?>
/user.png'" alt="<?php echo $_smarty_tpl->tpl_vars['user']->value['fullname'];?>
"/>
                                                </a>
                                            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                            <?php if ($_smarty_tpl->tpl_vars['exam']->value['total_user'] > 3 && ($_smarty_tpl->tpl_vars['exam']->value['total_user']-3) > 0) {?>
                                                <a class="exam__user" href="javascript:;">
                                                    <span>+<?php echo $_smarty_tpl->tpl_vars['exam']->value['total_user']-3;?>
</span>
                                                </a>
                                            <?php }?>
                                        <?php }?>
                                    </div>
                                    <div class="nav justify-content-between">
                                        <div class="exam__tags mt-20">
                                            <a class="btn btn-danger text-700" href="javascript:;"><?php echo $_smarty_tpl->tpl_vars['exam']->value['code'];?>
</a>
                                            <a class="btn btn-secondary ml-1" href="javascript:;">#<?php echo $_smarty_tpl->tpl_vars['exam']->value['skill_name'];?>
</a>
                                        </div>
                                        <a class="exam__link btn btn-primary mt-20" href="<?php echo $_smarty_tpl->tpl_vars['Rewrite']->value->url_exam_detail($_smarty_tpl->tpl_vars['exam']->value);?>
"><?php echo smarty_modifier_lang('Mock_exam');?>
</a>
                                    </div>
                                </div>
                            </div>
                        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    </div>
                    <div class="text-center">
                        <a class="section__btn btn btn-primary" href="#!"><?php echo smarty_modifier_lang('View_more');?>
</a>
                    </div>
                </div>
            <?php }?>
            <?php if ($_smarty_tpl->tpl_vars['arrListSkills']->value) {?>
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['arrListSkills']->value, 'skill', false, 's');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['s']->value => $_smarty_tpl->tpl_vars['skill']->value) {
?>
                    <div class="tab-pane fade" id="skill-<?php echo $_smarty_tpl->tpl_vars['s']->value;?>
" role="tabpanel">
                        <div class="row">
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['skill']->value['list_exams'], 'exam', false, 'e');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['e']->value => $_smarty_tpl->tpl_vars['exam']->value) {
?>
                                <div class="col-lg-4 col-sm-6 mb-30">
                                    <div class="exam card card-body">
                                        <h3 class="exam__title">
                                            <a class="text-default" href="<?php echo $_smarty_tpl->tpl_vars['Rewrite']->value->url_exam_detail($_smarty_tpl->tpl_vars['exam']->value);?>
"><?php echo $_smarty_tpl->tpl_vars['exam']->value['name'];?>
</a>
                                        </h3>
                                        <div class="d-flex align-items-center mb-4">
                                            <?php if ($_smarty_tpl->tpl_vars['exam']->value['time_end']) {?>
                                                <div class="mr-20">
                                                    <i class="fa fa-clock-o mr-1"></i>
                                                    <span><?php echo $_smarty_tpl->tpl_vars['exam']->value['time_end'];?>
 <?php echo smarty_modifier_lang('minute');?>
</span>
                                                </div>
                                            <?php }?>
                                            <span class="exam__badge badge badge-danger"><?php echo smarty_modifier_lang('Free');?>
</span>
                                        </div>
                                        <div class="nav mb-1">
                                            <?php if ($_smarty_tpl->tpl_vars['exam']->value['list_user']) {?>
                                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['exam']->value['list_user'], 'user', false, 'u');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['u']->value => $_smarty_tpl->tpl_vars['user']->value) {
?>
                                                    <a class="exam__user" href="javascript:;" title="<?php echo $_smarty_tpl->tpl_vars['user']->value['fullname'];?>
">
                                                        <img src="<?php echo $_smarty_tpl->tpl_vars['URL_IMAGES']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['user']->value['image'];?>
" onerror="this.src='<?php echo $_smarty_tpl->tpl_vars['URL_IMAGES']->value;?>
/user.png'" alt="<?php echo $_smarty_tpl->tpl_vars['user']->value['fullname'];?>
"/>
                                                    </a>
                                                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                                <?php if ($_smarty_tpl->tpl_vars['exam']->value['total_user'] > 3 && ($_smarty_tpl->tpl_vars['exam']->value['total_user']-3) > 0) {?>
                                                    <a class="exam__user" href="javascript:;">
                                                        <span>+<?php echo $_smarty_tpl->tpl_vars['exam']->value['total_user']-3;?>
</span>
                                                    </a>
                                                <?php }?>
                                            <?php }?>
                                        </div>
                                        <div class="nav justify-content-between">
                                            <div class="exam__tags mt-20">
                                                <a class="btn btn-danger text-700" href="javascript:;"><?php echo $_smarty_tpl->tpl_vars['exam']->value['code'];?>
</a>
                                                <a class="btn btn-secondary ml-1" href="javascript:;">#<?php echo $_smarty_tpl->tpl_vars['exam']->value['skill_name'];?>
</a>
                                            </div>
                                            <a class="exam__link btn btn-primary mt-20" href="<?php echo $_smarty_tpl->tpl_vars['Rewrite']->value->url_exam_detail($_smarty_tpl->tpl_vars['exam']->value);?>
"><?php echo smarty_modifier_lang('Mock_exam');?>
</a>
                                        </div>
                                    </div>
                                </div>
                            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        </div>
                        <div class="text-center">
                            <a class="section__btn btn btn-primary" href="#!"><?php echo smarty_modifier_lang('View_more');?>
</a>
                        </div>
                    </div>
                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            <?php }?>
        </div>
    </div>
</section>
<?php }
}
