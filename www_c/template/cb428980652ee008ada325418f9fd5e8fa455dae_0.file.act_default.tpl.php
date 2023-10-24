<?php
/* Smarty version 3.1.32, created on 2021-11-10 00:00:53
  from '/var/www/koseionline.vn/data/www/koseionline.vn/themes/template/trialtest/act_default.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_618aa945286de6_76896920',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'cb428980652ee008ada325418f9fd5e8fa455dae' => 
    array (
      0 => '/var/www/koseionline.vn/data/www/koseionline.vn/themes/template/trialtest/act_default.tpl',
      1 => 1636476134,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_618aa945286de6_76896920 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/var/www/koseionline.vn/data/www/koseionline.vn/includes/smarty3/plugins/modifier.lang.php','function'=>'smarty_modifier_lang',),1=>array('file'=>'/var/www/koseionline.vn/data/www/koseionline.vn/includes/smarty3/plugins/modifier.date_format.php','function'=>'smarty_modifier_date_format',),2=>array('file'=>'/var/www/koseionline.vn/data/www/koseionline.vn/includes/smarty3/plugins/modifier.replace.php','function'=>'smarty_modifier_replace',),));
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
      <li class="breadcrumb-item active"><?php echo smarty_modifier_lang('Mock_exam');?>
</li>
    </ol>
  </div>
</nav>

<section class="section mb-50">
  <div class="container">
                  <?php if ($_smarty_tpl->tpl_vars['arrListTest']->value) {?>
        <h2 class="section__title text-uppercase"><?php echo smarty_modifier_lang('List_of_exam_questions');?>
</h2>
        <div class="row">
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['arrListTest']->value, 'test', false, 'e');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['e']->value => $_smarty_tpl->tpl_vars['test']->value) {
?>
              <div class="col-lg-4 col-sm-6 mb-30">
                <div class="exam card card-body">
                  <h3 class="exam__title">
                    <a class="text-default" href="<?php echo $_smarty_tpl->tpl_vars['Rewrite']->value->url_trialtest($_smarty_tpl->tpl_vars['test']->value);?>
"><?php echo $_smarty_tpl->tpl_vars['test']->value['name'];?>
</a>
                  </h3>
                  <div class="d-flex align-items-center mb-4">
                      <?php if ($_smarty_tpl->tpl_vars['test']->value['time_end']) {?>
                        <div class="mr-20">
                          <i class="fa fa-clock-o mr-1"></i>
                          <span><?php echo $_smarty_tpl->tpl_vars['test']->value['time_end'];?>
 <?php echo smarty_modifier_lang('minute');?>
</span>
                        </div>
                      <?php }?>
                    <span class="exam__badge badge badge-danger"><?php echo smarty_modifier_lang('Free');?>
</span>
                  </div>
                  <div class="nav mb-1">
                      <?php if ($_smarty_tpl->tpl_vars['test']->value['list_user']) {?>
                          <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['test']->value['list_user'], 'user', false, 'u');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['u']->value => $_smarty_tpl->tpl_vars['user']->value) {
?>
                            <a class="exam__user" href="javascript:;" title="<?php echo $_smarty_tpl->tpl_vars['user']->value['fullname'];?>
">
                              <img src="<?php echo $_smarty_tpl->tpl_vars['URL_IMAGES']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['user']->value['image'];?>
" onerror="this.src='<?php echo $_smarty_tpl->tpl_vars['URL_IMAGES']->value;?>
/user.png'"
                                   alt="<?php echo $_smarty_tpl->tpl_vars['user']->value['fullname'];?>
"/>
                            </a>
                          <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                          <?php if ($_smarty_tpl->tpl_vars['test']->value['total_user'] > 3 && ($_smarty_tpl->tpl_vars['test']->value['total_user']-3) > 0) {?>
                            <a class="exam__user" href="javascript:;">
                              <span>+<?php echo $_smarty_tpl->tpl_vars['test']->value['total_user']-3;?>
</span>
                            </a>
                          <?php }?>
                      <?php }?>
                  </div>
                  <div class="nav justify-content-between">
                    <div class="exam__tags mt-20">
                      <a class="btn btn-danger text-700" href="#!"><?php echo $_smarty_tpl->tpl_vars['test']->value['code'];?>
</a>
                    </div>
                    <a class="exam__link btn btn-primary mt-20"
                       href="<?php echo $_smarty_tpl->tpl_vars['Rewrite']->value->url_trialtest($_smarty_tpl->tpl_vars['test']->value);?>
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
          <a class="section__btn btn btn-primary" href="javascript:;"><?php echo smarty_modifier_lang('View_more');?>
</a>
        </div>
      <?php } else { ?>
        <div class="row">
          <div class="col-xl-8 offset-xl-2">
            <div class="alert-box">
              <div class="alert-box__wrapper">
                <img class="alert-box__bg" src="<?php echo $_smarty_tpl->tpl_vars['URL_IMAGES']->value;?>
/test-start.png" alt="test-start">
                <div class="alert-box__content">
                  <div>
                    <div class="alert-box__text-1"><?php echo smarty_modifier_lang('The_test_will_take_place');?>
</div>
                    <div class="alert-box__text-2"><?php echo smarty_modifier_lang(smarty_modifier_replace(smarty_modifier_date_format($_smarty_tpl->tpl_vars['arrOneLatestTest']->value['start_date'],"%H:%M Day %d/%m/%Y"),"Day",'Day'));?>
</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      <?php }?>
                                      </div>
</section>
<?php }
}
