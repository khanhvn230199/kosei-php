<?php
/* Smarty version 3.1.32, created on 2021-06-10 09:35:38
  from '/var/www/koseionline.vn/data/www/koseionline.vn/themes/template/_blocks/_smallQuestion.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_60c17a7a62fac5_78336763',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0e8a93bc89678f3f6c89e67c8b0915ca5c223345' => 
    array (
      0 => '/var/www/koseionline.vn/data/www/koseionline.vn/themes/template/_blocks/_smallQuestion.tpl',
      1 => 1623291330,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:_blocks/_answer.tpl' => 1,
  ),
),false)) {
function content_60c17a7a62fac5_78336763 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="question-2__group">

  <div class="question-2__query" data-name="q<?php echo $_smarty_tpl->tpl_vars['smallQuestion']->value['questions_id'];?>
">
    <div class="media">
      <span class="mr-2">問<?php echo $_smarty_tpl->tpl_vars['smallQuestionIdx']->value+1;?>
：</span>
      <div class="media-body">
          <?php echo htmlDecode($_smarty_tpl->tpl_vars['smallQuestion']->value['question']);?>

      </div>
    </div>
  </div>

    <?php if ($_smarty_tpl->tpl_vars['smallQuestion']->value['attachment']) {?>
        <?php if ($_smarty_tpl->tpl_vars['showAudioTag']->value) {?>
          <audio class="w-100 mb-3" src="<?php echo $_smarty_tpl->tpl_vars['URL_UPLOADS']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['smallQuestion']->value['attachment'];?>
"></audio>
        <?php } else { ?>
          <div class="js-sound" data-url="<?php echo $_smarty_tpl->tpl_vars['URL_UPLOADS']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['smallQuestion']->value['attachment'];?>
"></div>
        <?php }?>
    <?php }?>

    <?php $_smarty_tpl->_subTemplateRender("file:_blocks/_answer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('answers'=>$_smarty_tpl->tpl_vars['smallQuestion']->value['answers']), 0, false);
?>
</div>
<?php }
}
