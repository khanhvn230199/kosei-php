<?php
/* Smarty version 3.1.32, created on 2021-06-10 09:15:33
  from '/var/www/koseionline.vn/data/www/koseionline.vn/themes/template/_blocks/_bigQuestion.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_60c175c5713c80_97401498',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4821d5e0a49fa1bf30d7a381ea9fc49a257eb651' => 
    array (
      0 => '/var/www/koseionline.vn/data/www/koseionline.vn/themes/template/_blocks/_bigQuestion.tpl',
      1 => 1623291329,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:_blocks/_question.tpl' => 1,
    'file:_blocks/_answer.tpl' => 1,
  ),
),false)) {
function content_60c175c5713c80_97401498 (Smarty_Internal_Template $_smarty_tpl) {
?><li class="mb-6">
  <section class="question-2">

    <div class="question-2__header">
      <div class="media">
        <span class="mr-2">問題<?php echo $_smarty_tpl->tpl_vars['bigQuestionIdx']->value+1;?>
（<?php echo $_smarty_tpl->tpl_vars['bigQuestion']->value['point'];?>
点)：</span>
        <div class="media-body">
          <?php echo htmlDecode($_smarty_tpl->tpl_vars['bigQuestion']->value['question']);?>

        </div>
      </div>
    </div>

    <div class="question-2__body">

      <?php if ($_smarty_tpl->tpl_vars['bigQuestion']->value['attachment']) {?>
        <?php if ($_smarty_tpl->tpl_vars['showAudioTag']->value) {?>
          <audio class="w-100 mb-3" src="<?php echo $_smarty_tpl->tpl_vars['URL_UPLOADS']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['bigQuestion']->value['attachment'];?>
"></audio>
        <?php } else { ?>
          <div class="js-sound" data-url="<?php echo $_smarty_tpl->tpl_vars['URL_UPLOADS']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['bigQuestion']->value['attachment'];?>
"></div>
        <?php }?>
      <?php }?>

      <?php if ($_smarty_tpl->tpl_vars['bigQuestion']->value['questions']) {?>

        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['bigQuestion']->value['questions'], 'question', false, 'questionIdx');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['questionIdx']->value => $_smarty_tpl->tpl_vars['question']->value) {
?>
          <?php $_smarty_tpl->_subTemplateRender("file:_blocks/_question.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>

      <?php } else { ?>

        <div class="question-2__group">
          <?php $_smarty_tpl->_subTemplateRender("file:_blocks/_answer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('answers'=>$_smarty_tpl->tpl_vars['bigQuestion']->value['answers']), 0, false);
?>
        </div>

      <?php }?>
    </div>
  </section>
</li>
<?php }
}
