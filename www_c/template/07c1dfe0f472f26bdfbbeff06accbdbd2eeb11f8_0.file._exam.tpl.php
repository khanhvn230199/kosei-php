<?php
/* Smarty version 3.1.32, created on 2021-06-08 14:35:04
  from '/var/www/koseionline.vn/data/www/koseionline.vn/themes/template/_blocks/_exam.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_60bf1da881c941_53840738',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '07c1dfe0f472f26bdfbbeff06accbdbd2eeb11f8' => 
    array (
      0 => '/var/www/koseionline.vn/data/www/koseionline.vn/themes/template/_blocks/_exam.tpl',
      1 => 1619515320,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:_blocks/_bigQuestion.tpl' => 1,
  ),
),false)) {
function content_60bf1da881c941_53840738 (Smarty_Internal_Template $_smarty_tpl) {
?><setion class="js-test-skill collapse" data-skill="<?php echo $_smarty_tpl->tpl_vars['examIdx']->value+1;?>
" data-basepoint="<?php echo $_smarty_tpl->tpl_vars['exam']->value['pass_score'];?>
" <?php if ($_smarty_tpl->tpl_vars['exam']->value['time_end']) {?>data-timer="<?php echo $_smarty_tpl->tpl_vars['exam']->value['time_end']*60;?>
" <?php }?> data-title="<?php echo $_smarty_tpl->tpl_vars['exam']->value['name'];?>
">

  <h2 class="test__title"><?php echo $_smarty_tpl->tpl_vars['exam']->value['name'];?>
</h2>

  <ul class="list-unstyled mb-0">
    <?php if ($_smarty_tpl->tpl_vars['exam']->value['bigQuestions']) {?>
      <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['exam']->value['bigQuestions'], 'bigQuestion', false, 'bigQuestionIdx');
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
</setion>
<?php }
}
