<?php
/* Smarty version 3.1.32, created on 2021-06-09 11:21:38
  from '/var/www/koseionline.vn/data/www/koseionline.vn/themes/template/_blocks/_exercise.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_60c041d2ed63f5_73483837',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '5b637233f1471827327d5a3fd419c92381496ae1' => 
    array (
      0 => '/var/www/koseionline.vn/data/www/koseionline.vn/themes/template/_blocks/_exercise.tpl',
      1 => 1623212431,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:_blocks/_bigQuestion.tpl' => 1,
  ),
),false)) {
function content_60c041d2ed63f5_73483837 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/var/www/koseionline.vn/data/www/koseionline.vn/includes/smarty3/plugins/modifier.lang.php','function'=>'smarty_modifier_lang',),));
?><ul class="list-unstyled mb-30">
  <li class="mb-6">
    <ul class="list-unstyled mb-0">
      <?php if ($_smarty_tpl->tpl_vars['bigQuestions']->value) {?>
          <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['bigQuestions']->value, 'bigQuestion', false, 'bigQuestionIdx');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['bigQuestionIdx']->value => $_smarty_tpl->tpl_vars['bigQuestion']->value) {
?>
              <?php $_smarty_tpl->_subTemplateRender("file:_blocks/_bigQuestion.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
          <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
      <?php }?>
    </ul>
  </li>

  <li class="mb-6">
    <a class="btn btn-danger mr-2 js-finish-test" href="javascript:;"><?php echo smarty_modifier_lang('Result');?>
</a>
    <a class="btn btn-primary mr-2 js-reset-test" href="javascript:;"><?php echo smarty_modifier_lang('Rework');?>
</a>
          </li>
</ul>
<?php }
}
