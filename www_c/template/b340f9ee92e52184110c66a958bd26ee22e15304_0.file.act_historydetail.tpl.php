<?php
/* Smarty version 3.1.32, created on 2023-06-03 09:45:16
  from '/var/www/koseionline/data/www/koseionline.vn/themes/template/account/act_historydetail.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_647aa93cd17115_69543203',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b340f9ee92e52184110c66a958bd26ee22e15304' => 
    array (
      0 => '/var/www/koseionline/data/www/koseionline.vn/themes/template/account/act_historydetail.tpl',
      1 => 1669775156,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:_blocks/_exam.tpl' => 1,
  ),
),false)) {
function content_647aa93cd17115_69543203 (Smarty_Internal_Template $_smarty_tpl) {
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
        <article class="test js-test" data-name="<?php echo $_smarty_tpl->tpl_vars['arrOneUser']->value['fullname'];?>
" data-course="<?php echo $_smarty_tpl->tpl_vars['arrOneTest']->value['code'];?>
" data-test="<?php echo $_smarty_tpl->tpl_vars['arrOneTest']->value['tt_id'];?>
" data-test-id="<?php echo $_smarty_tpl->tpl_vars['arrOneTest']->value['test_id'];?>
" data-totalpoint="<?php echo $_smarty_tpl->tpl_vars['arrOneTest']->value['pass_score'];?>
" , data-answers="<?php echo $_smarty_tpl->tpl_vars['candidate']->value['answers'];?>
">
          <?php if ($_smarty_tpl->tpl_vars['exams']->value) {?>
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['exams']->value, 'exam', false, 'examIdx');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['examIdx']->value => $_smarty_tpl->tpl_vars['exam']->value) {
?>
              <?php if ($_smarty_tpl->tpl_vars['examIdx']->value == 0) {?>
                <?php $_smarty_tpl->_assignInScope('questionType', "js-vocab");?>
              <?php } elseif ($_smarty_tpl->tpl_vars['examIdx']->value == 1) {?>
                <?php $_smarty_tpl->_assignInScope('questionType', "js-reading");?>
              <?php } else { ?>
                <?php $_smarty_tpl->_assignInScope('questionType', "js-listening");?>
              <?php }?>

              <?php $_smarty_tpl->_subTemplateRender("file:_blocks/_exam.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
          <?php }?>
        </article>
      </div>
    </div>
  </div>
</section>
<?php }
}
