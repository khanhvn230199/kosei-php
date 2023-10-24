<?php
/* Smarty version 3.1.32, created on 2021-06-10 09:02:41
  from '/var/www/koseionline.vn/data/www/koseionline.vn/themes/template/_blocks/_answer.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_60c172c113fe16_38765035',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '68427caf033619218b69320000e2d6aedd3a4bad' => 
    array (
      0 => '/var/www/koseionline.vn/data/www/koseionline.vn/themes/template/_blocks/_answer.tpl',
      1 => 1623290529,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60c172c113fe16_38765035 (Smarty_Internal_Template $_smarty_tpl) {
?><ul class="answers js-answer">
  <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['answers']->value, 'answer', false, 'answerIdx');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['answerIdx']->value => $_smarty_tpl->tpl_vars['answer']->value) {
?>
    <li class="answers__item">
      <label class="radio-styled">
        <input class="radio-styled__input js-answer-input <?php if ($_smarty_tpl->tpl_vars['answer']->value['is_correct']) {
if ($_smarty_tpl->tpl_vars['answer']->value['ctype']) {
echo $_smarty_tpl->tpl_vars['answer']->value['ctype'];
} else {
echo $_smarty_tpl->tpl_vars['questionType']->value;
}?> correct<?php }?>" type="radio" name="q<?php echo $_smarty_tpl->tpl_vars['answer']->value['name'];?>
" data-point="<?php echo $_smarty_tpl->tpl_vars['answer']->value['point'];?>
" data-answer-id="<?php echo $_smarty_tpl->tpl_vars['answer']->value['id'];?>
" />
        <span class="radio-styled__icon"></span>
        <span><?php echo htmlDecode($_smarty_tpl->tpl_vars['answer']->value['text']);?>
</span>
      </label>
    </li>
  <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
</ul>
<?php }
}
