<?php
/* Smarty version 3.1.32, created on 2023-05-19 11:02:41
  from '/var/www/koseionline/data/www/koseionline.vn/themes/template/_blocks/_question.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_6466f4e1b2e935_03356594',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '780d19a7ae9b843293c17fe8c86af9674768beab' => 
    array (
      0 => '/var/www/koseionline/data/www/koseionline.vn/themes/template/_blocks/_question.tpl',
      1 => 1670384119,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:_blocks/_smallQuestion.tpl' => 1,
    'file:_blocks/_answer.tpl' => 1,
  ),
),false)) {
function content_6466f4e1b2e935_03356594 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="question-2__group">
  <div class="question-2__query" data-name="q<?php echo $_smarty_tpl->tpl_vars['question']->value['questions_id'];?>
">
    <div class="media">
      <span class="mr-2"><?php if ($_smarty_tpl->tpl_vars['question']->value['smallQuestions']) {?>問題<?php } else { ?>問<?php }
echo $_smarty_tpl->tpl_vars['questionIdx']->value+1;?>
：</span>
      <div class="media-body">
          <?php echo htmlDecode($_smarty_tpl->tpl_vars['question']->value['question']);?>

      </div>
    </div>
  </div>

  <?php if ($_smarty_tpl->tpl_vars['question']->value['attachment']) {?>
      <?php if ($_smarty_tpl->tpl_vars['showAudioTag']->value) {?>
        <audio class="w-100 mb-3" src="<?php echo $_smarty_tpl->tpl_vars['URL_UPLOADS']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['question']->value['attachment'];?>
"></audio>
      <?php } else { ?>
        <div class="js-sound" data-url="<?php echo $_smarty_tpl->tpl_vars['URL_UPLOADS']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['question']->value['attachment'];?>
"></div>
      <?php }?>
  <?php }?>

  <?php if ($_smarty_tpl->tpl_vars['question']->value['smallQuestions']) {?>
    <div class="pl-30">
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['question']->value['smallQuestions'], 'smallQuestion', false, 'smallQuestionIdx');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['smallQuestionIdx']->value => $_smarty_tpl->tpl_vars['smallQuestion']->value) {
?>
            <?php $_smarty_tpl->_subTemplateRender("file:_blocks/_smallQuestion.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    </div>
  <?php } else { ?>
      <?php $_smarty_tpl->_subTemplateRender("file:_blocks/_answer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('answers'=>$_smarty_tpl->tpl_vars['question']->value['answers']), 0, false);
?>
  <?php }?>
</div>
<?php }
}
