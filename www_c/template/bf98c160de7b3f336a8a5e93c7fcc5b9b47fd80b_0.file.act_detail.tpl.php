<?php
/* Smarty version 3.1.32, created on 2021-06-08 20:08:18
  from '/var/www/koseionline.vn/data/www/koseionline.vn/themes/template/exams/act_detail.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_60bf6bc2ecfd51_11001127',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'bf98c160de7b3f336a8a5e93c7fcc5b9b47fd80b' => 
    array (
      0 => '/var/www/koseionline.vn/data/www/koseionline.vn/themes/template/exams/act_detail.tpl',
      1 => 1618904758,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:_blocks/login_form.tpl' => 1,
  ),
),false)) {
function content_60bf6bc2ecfd51_11001127 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/var/www/koseionline.vn/data/www/koseionline.vn/includes/smarty3/plugins/modifier.lang.php','function'=>'smarty_modifier_lang',),));
?><div class="transparent-overlay"></div>
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
            <li class="breadcrumb-item">
<a class="link-unstyled" href="<?php echo $_smarty_tpl->tpl_vars['VNCMS_URL']->value;?>
/practice"><?php echo smarty_modifier_lang('JLPT_exam_inventory');?>
</a>
               <!-- <a class="link-unstyled" href="<?php echo $_smarty_tpl->tpl_vars['VNCMS_URL']->value;?>
/exams"><?php echo smarty_modifier_lang('JLPT_exam_inventory');?>
</a>-->
            </li>
            <li class="breadcrumb-item active"><?php echo $_smarty_tpl->tpl_vars['arrOneExam']->value['name'];?>
</li>
        </ol>
    </div>
</nav>
<section class="section mb-50">
    <div class="container">
        <?php if ($_smarty_tpl->tpl_vars['isLogin']->value == 1) {?>
            <div class="row">
                <div class="col-lg-4 mb-30 floating-container">
                    <div class="floating">
                        <div class="aside">
                            <div class="aside__block">
                                <div class="test-info card card-body js-test-panel">
                                    <div class="test-info__title"><?php echo $_smarty_tpl->tpl_vars['arrOneExam']->value['name'];?>
</div>
                                    <div class="test-info__time"><?php echo smarty_modifier_lang('Total_duration');?>
 <?php echo $_smarty_tpl->tpl_vars['arrOneExam']->value['time_end'];?>
 <?php echo smarty_modifier_lang('minute');?>
</div>
                                    <div class="test-info__desc"><?php echo $_smarty_tpl->tpl_vars['arrOneExam']->value['skill_name'];?>
 - <?php echo $_smarty_tpl->tpl_vars['arrOneExam']->value['level_name'];?>
</div>
                                    <!-- data-timer tính bằng giây-->
                                    <div class="test-info__timer js-test-timer <?php if ($_smarty_tpl->tpl_vars['arrOneExam']->value['time_end'] > 0) {?>js-data-timer<?php }?>" <?php if ($_smarty_tpl->tpl_vars['arrOneExam']->value['time_end'] > 0) {?>data-timer="<?php echo $_smarty_tpl->tpl_vars['arrOneExam']->value['time_end']*60;?>
"<?php }?>>00:00:00</div>
                                    <div class="text-center">
                                        <a class="test-info__btn btn btn-lg btn-outline-light js-start-test" href="javascript:;" data-btn="start" data-start="<?php echo smarty_modifier_lang('Start');?>
" data-complete="<?php echo smarty_modifier_lang('Complete_Test');?>
" data-redo="<?php echo smarty_modifier_lang('Redo');?>
" ><?php echo smarty_modifier_lang('Loading_Test');?>
</a>
                                        <?php if ($_smarty_tpl->tpl_vars['arrOneExam']->value['time_end'] > 0) {?>
                                            <div class="form-text">
                                                <i class="fa fa-headphones mr-2"></i>
                                                <span><?php echo smarty_modifier_lang('Open_the_speaker_or_wear_a_headset_to_hear_the_question');?>
</span>
                                            </div>
                                        <?php }?>
                                    </div>
                                </div>
                            </div>
                            <div class="aside__block d-none d-lg-block">
                                <?php if ($_smarty_tpl->tpl_vars['arrListOtherExams']->value) {?>
                                    <h2 class="aside__title"><?php echo $_smarty_tpl->tpl_vars['core']->value->getLang('Related_test');?>
</h2>
                                    <ul class="list-unstyled mb-0">
                                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['arrListOtherExams']->value, 'exam', false, 'e');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['e']->value => $_smarty_tpl->tpl_vars['exam']->value) {
?>
                                            <li class="mb-20 m-last-0">
                                                <a class="as-card card card-body" href="<?php echo $_smarty_tpl->tpl_vars['Rewrite']->value->url_exam($_smarty_tpl->tpl_vars['exam']->value);?>
">
                                                    <div class="text-600 text-16 mb-2"><?php echo $_smarty_tpl->tpl_vars['exam']->value['name'];?>
 #<?php echo $_smarty_tpl->tpl_vars['exam']->value['exam_id'];?>
</div>
                                                    <div>
                                                        <?php if ($_smarty_tpl->tpl_vars['exam']->value['time_end']) {?>
                                                            <i class="fa fa-clock-o mr-1"></i>
                                                            <span><?php echo $_smarty_tpl->tpl_vars['exam']->value['time_end'];?>
 <?php echo smarty_modifier_lang('minute');?>
</span>
                                                        <?php }?>
                                                    </div>
                                                </a>
                                            </li>
                                        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                    </ul>
                                <?php }?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 mb-30">
                    <article class="js-test collapse">
                        <ul class="list-unstyled mb-30">
                            <li class="mb-6">
                                <?php if ($_smarty_tpl->tpl_vars['arrListQuestions']->value) {?>
                                    <ul class="list-unstyled mb-0 js-exam" data-exam="<?php echo $_smarty_tpl->tpl_vars['arrOneExam']->value['exam_id'];?>
">
                                        <?php $_smarty_tpl->_assignInScope('i', 0);?>
                                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['arrListQuestions']->value, 'question', false, 'q');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['q']->value => $_smarty_tpl->tpl_vars['question']->value) {
?>
                                            <li class="mb-6">
                                                <div class="question mb-2 js-question <?php if ($_smarty_tpl->tpl_vars['question']->value['attachment']) {?>js-sound<?php }?>" <?php if ($_smarty_tpl->tpl_vars['question']->value['attachment']) {?>url="<?php echo $_smarty_tpl->tpl_vars['URL_UPLOADS']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['question']->value['attachment'];?>
"<?php }?> data-id="<?php echo $_smarty_tpl->tpl_vars['question']->value['questions_id'];?>
">
                                                    <div class="question__header card card-body">
                                                        <div class="question__title media">
                                                            <div class="question__title-label w-auto">問題<?php echo $_smarty_tpl->tpl_vars['q']->value+1;?>
<span class="px-2"></span>（<?php echo $_smarty_tpl->tpl_vars['question']->value['point'];?>
点)： </div>
                                                            <div class="media-body"><?php echo htmlDecode($_smarty_tpl->tpl_vars['question']->value['question']);?>
</div>
                                                        </div>
                                                        <div class="question__translate mt-2 mb-0 collapse js-test-translation"><?php echo htmlDecode($_smarty_tpl->tpl_vars['question']->value['translate']);?>
</div>
                                                    </div>
                                                    <div class="question__body card card-body">
                                                        <?php if ($_smarty_tpl->tpl_vars['question']->value['child']) {?>
                                                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['question']->value['child'], 'sub_question', false, 'sc1');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['sc1']->value => $_smarty_tpl->tpl_vars['sub_question']->value) {
?>
                                                                <div class="question__small-title media text-20 <?php if ($_smarty_tpl->tpl_vars['sub_question']->value['attachment']) {?>js-sound<?php }?>" <?php if ($_smarty_tpl->tpl_vars['sub_question']->value['attachment']) {?>url="<?php echo $_smarty_tpl->tpl_vars['URL_UPLOADS']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['sub_question']->value['attachment'];?>
"<?php }?> count="<?php echo $_smarty_tpl->tpl_vars['URL_SOUND']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['sc1']->value+1;?>
-ban.mp3" data-name="question-<?php echo $_smarty_tpl->tpl_vars['q']->value;
echo $_smarty_tpl->tpl_vars['i']->value;?>
">
                                                                    <div class="question__small-title-index w-auto <?php if ($_smarty_tpl->tpl_vars['sub_question']->value['child']) {?>mw-50px<?php }?>"><?php if ($_smarty_tpl->tpl_vars['sub_question']->value['child']) {?>問題<?php } else { ?>問<?php }
echo $_smarty_tpl->tpl_vars['sc1']->value+1;?>
<span class="px-2"></span></div>
                                                                    <div class="media-body">
                                                                        <div><?php echo htmlDecode($_smarty_tpl->tpl_vars['sub_question']->value['question']);?>
</div>
                                                                        <div class="question__translate mt-2 mb-0 collapse js-test-translation text-20"><?php echo htmlDecode($_smarty_tpl->tpl_vars['sub_question']->value['translate']);?>
</div>
                                                                    </div>
                                                                </div>
                                                                <?php if ($_smarty_tpl->tpl_vars['sub_question']->value['child']) {?>
                                                                    <div class="pl-50 mt-20">
                                                                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['sub_question']->value['child'], 'sub_question2', false, 'sc2');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['sc2']->value => $_smarty_tpl->tpl_vars['sub_question2']->value) {
?>
                                                                            <div class="question__small-title media text-20 <?php if ($_smarty_tpl->tpl_vars['sub_question2']->value['attachment']) {?>js-sound<?php }?>" <?php if ($_smarty_tpl->tpl_vars['sub_question2']->value['attachment']) {?>url="<?php echo $_smarty_tpl->tpl_vars['URL_UPLOADS']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['sub_question2']->value['attachment'];?>
"<?php }?> count="<?php echo $_smarty_tpl->tpl_vars['URL_SOUND']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['sc2']->value+1;?>
-ban.mp3" data-name="question-<?php echo $_smarty_tpl->tpl_vars['q']->value;
echo $_smarty_tpl->tpl_vars['i']->value;?>
">
                                                                                <div class="question__small-title-index w-auto">問<?php echo $_smarty_tpl->tpl_vars['sc2']->value+1;?>
<span class="px-2"></span></div>
                                                                                <div class="media-body"><?php echo htmlDecode($_smarty_tpl->tpl_vars['sub_question2']->value['question']);?>
</div>
                                                                            </div>
                                                                            <div class="question__translate mt-2 mb-0 collapse js-test-translation text-20"><?php echo htmlDecode($_smarty_tpl->tpl_vars['sub_question2']->value['translate']);?>
</div>
                                                                            <div class="row">
                                                                                <?php if ($_smarty_tpl->tpl_vars['sub_question2']->value['answer_a']) {?>
                                                                                    <div class="col-12 mt-3">
                                                                                        <div class="d-flex" style="font-size: 18px; line-height: 21px;">
                                                                                            <label class="radio-styled media d-flex">
                                                                                                <input class="question__input radio-styled__input js-test-input <?php if ($_smarty_tpl->tpl_vars['sub_question2']->value['correct_answer'] == '1' || mb_strtoupper($_smarty_tpl->tpl_vars['sub_question2']->value['correct_answer'], 'UTF-8') == 'A') {?>correct<?php }?>" type="radio" name="question-<?php echo $_smarty_tpl->tpl_vars['q']->value;
echo $_smarty_tpl->tpl_vars['i']->value;?>
" disabled="disabled" data-point="<?php echo $_smarty_tpl->tpl_vars['sub_question2']->value['point'];?>
" />
                                                                                                <span class="radio-styled__icon"></span>
                                                                                                <span><?php echo htmlDecode($_smarty_tpl->tpl_vars['sub_question2']->value['answer_a']);?>
</span>
                                                                                                <?php if ($_smarty_tpl->tpl_vars['sub_question2']->value['correct_answer'] == '1' || mb_strtoupper($_smarty_tpl->tpl_vars['sub_question2']->value['correct_answer'], 'UTF-8') == 'A') {?>
                                                                                                    <span class="question__result">
                                                                                                        <i class="fa fa-check-circle ml-1"></i>
                                                                                                    </span>
                                                                                                    <span class="collapse js-test-answer">
                                                                                                        <i class="fa fa-check-circle ml-1"></i>
                                                                                                    </span>
                                                                                                <?php } else { ?>
                                                                                                    <span class="question__result">
                                                                                                        <i class="fa fa-times-circle ml-1"></i>
                                                                                                    </span>
                                                                                                <?php }?>
                                                                                            </label>
                                                                                        </div>
                                                                                    </div>
                                                                                <?php }?>
                                                                                <?php if ($_smarty_tpl->tpl_vars['sub_question2']->value['answer_b']) {?>
                                                                                    <div class="col-12 mt-3">
                                                                                        <div class="d-flex" style="font-size: 18px; line-height: 21px;">
                                                                                            <label class="radio-styled media d-flex">
                                                                                                <input class="question__input radio-styled__input js-test-input <?php if ($_smarty_tpl->tpl_vars['sub_question2']->value['correct_answer'] == '2' || mb_strtoupper($_smarty_tpl->tpl_vars['sub_question2']->value['correct_answer'], 'UTF-8') == 'B') {?>correct<?php }?>" type="radio" name="question-<?php echo $_smarty_tpl->tpl_vars['q']->value;
echo $_smarty_tpl->tpl_vars['i']->value;?>
" disabled="disabled" data-point="<?php echo $_smarty_tpl->tpl_vars['sub_question2']->value['point'];?>
" />
                                                                                                <span class="radio-styled__icon"></span>
                                                                                                <span><?php echo htmlDecode($_smarty_tpl->tpl_vars['sub_question2']->value['answer_b']);?>
</span>
                                                                                                <?php if ($_smarty_tpl->tpl_vars['sub_question2']->value['correct_answer'] == '2' || mb_strtoupper($_smarty_tpl->tpl_vars['sub_question2']->value['correct_answer'], 'UTF-8') == 'B') {?>
                                                                                                    <span class="question__result">
                                                                                                        <i class="fa fa-check-circle ml-1"></i>
                                                                                                    </span>
                                                                                                    <span class="collapse js-test-answer">
                                                                                                        <i class="fa fa-check-circle ml-1"></i>
                                                                                                    </span>
                                                                                                <?php } else { ?>
                                                                                                    <span class="question__result">
                                                                                                        <i class="fa fa-times-circle ml-1"></i>
                                                                                                    </span>
                                                                                                <?php }?>
                                                                                            </label>
                                                                                        </div>
                                                                                    </div>
                                                                                <?php }?>
                                                                                <?php if ($_smarty_tpl->tpl_vars['sub_question2']->value['answer_c']) {?>
                                                                                    <div class="col-12 mt-3" style="font-size: 18px; line-height: 21px;">
                                                                                        <div class="d-flex">
                                                                                            <label class="radio-styled media d-flex">
                                                                                                <input class="question__input radio-styled__input js-test-input <?php if ($_smarty_tpl->tpl_vars['sub_question2']->value['correct_answer'] == '3' || mb_strtoupper($_smarty_tpl->tpl_vars['sub_question2']->value['correct_answer'], 'UTF-8') == 'C') {?>correct<?php }?>" type="radio" name="question-<?php echo $_smarty_tpl->tpl_vars['q']->value;
echo $_smarty_tpl->tpl_vars['i']->value;?>
" disabled="disabled" data-point="<?php echo $_smarty_tpl->tpl_vars['sub_question2']->value['point'];?>
" />
                                                                                                <span class="radio-styled__icon"></span>
                                                                                                <span><?php echo htmlDecode($_smarty_tpl->tpl_vars['sub_question2']->value['answer_c']);?>
</span>
                                                                                                <?php if ($_smarty_tpl->tpl_vars['sub_question2']->value['correct_answer'] == '3' || mb_strtoupper($_smarty_tpl->tpl_vars['sub_question2']->value['correct_answer'], 'UTF-8') == 'C') {?>
                                                                                                    <span class="question__result">
                                                                                                        <i class="fa fa-check-circle ml-1"></i>
                                                                                                    </span>
                                                                                                    <span class="collapse js-test-answer">
                                                                                                        <i class="fa fa-check-circle ml-1"></i>
                                                                                                    </span>
                                                                                                <?php } else { ?>
                                                                                                    <span class="question__result">
                                                                                                        <i class="fa fa-times-circle ml-1"></i>
                                                                                                    </span>
                                                                                                <?php }?>
                                                                                            </label>
                                                                                        </div>
                                                                                    </div>
                                                                                <?php }?>
                                                                                <?php if ($_smarty_tpl->tpl_vars['sub_question2']->value['answer_d']) {?>
                                                                                    <div class="col-12 mt-3">
                                                                                        <div class="d-flex" style="font-size: 18px; line-height: 21px;">
                                                                                            <label class="radio-styled media d-flex">
                                                                                                <input class="question__input radio-styled__input js-test-input <?php if ($_smarty_tpl->tpl_vars['sub_question2']->value['correct_answer'] == '4' || mb_strtoupper($_smarty_tpl->tpl_vars['sub_question2']->value['correct_answer'], 'UTF-8') == 'D') {?>correct<?php }?>" type="radio" name="question-<?php echo $_smarty_tpl->tpl_vars['q']->value;
echo $_smarty_tpl->tpl_vars['i']->value;?>
" disabled="disabled" data-point="<?php echo $_smarty_tpl->tpl_vars['sub_question2']->value['point'];?>
" />
                                                                                                <span class="radio-styled__icon"></span>
                                                                                                <span><?php echo htmlDecode($_smarty_tpl->tpl_vars['sub_question2']->value['answer_d']);?>
</span>
                                                                                                <?php if ($_smarty_tpl->tpl_vars['sub_question2']->value['correct_answer'] == '4' || mb_strtoupper($_smarty_tpl->tpl_vars['sub_question2']->value['correct_answer'], 'UTF-8') == 'D') {?>
                                                                                                    <span class="question__result">
                                                                                                        <i class="fa fa-check-circle ml-1"></i>
                                                                                                    </span>
                                                                                                    <span class="collapse js-test-answer">
                                                                                                        <i class="fa fa-check-circle ml-1"></i>
                                                                                                    </span>
                                                                                                <?php } else { ?>
                                                                                                    <span class="question__result">
                                                                                                        <i class="fa fa-times-circle ml-1"></i>
                                                                                                    </span>
                                                                                                <?php }?>
                                                                                            </label>
                                                                                        </div>
                                                                                    </div>
                                                                                <?php }?>
                                                                            </div>
                                                                            <?php $_smarty_tpl->_assignInScope('i', $_smarty_tpl->tpl_vars['i']->value+1);?>
                                                                        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                                                    </div>
                                                                <?php } else { ?>
                                                                    <div class="row">
                                                                        <?php if ($_smarty_tpl->tpl_vars['sub_question']->value['answer_a']) {?>
                                                                            <div class="col-12 mt-3">
                                                                                <div class="d-flex" style="font-size: 18px; line-height: 21px;">
                                                                                    <label class="radio-styled media d-flex">
                                                                                        <input class="question__input radio-styled__input js-test-input <?php if ($_smarty_tpl->tpl_vars['sub_question']->value['correct_answer'] == '1' || mb_strtoupper($_smarty_tpl->tpl_vars['sub_question']->value['correct_answer'], 'UTF-8') == 'A') {?>correct<?php }?>" type="radio" name="question-<?php echo $_smarty_tpl->tpl_vars['q']->value;
echo $_smarty_tpl->tpl_vars['i']->value;?>
" disabled="disabled" data-point="<?php echo $_smarty_tpl->tpl_vars['sub_question']->value['point'];?>
" />
                                                                                        <span class="radio-styled__icon"></span>
                                                                                        <span><?php echo htmlDecode($_smarty_tpl->tpl_vars['sub_question']->value['answer_a']);?>
</span>
                                                                                        <?php if ($_smarty_tpl->tpl_vars['sub_question']->value['correct_answer'] == '1' || mb_strtoupper($_smarty_tpl->tpl_vars['sub_question']->value['correct_answer'], 'UTF-8') == 'A') {?>
                                                                                            <span class="question__result">
                                                                                            <i class="fa fa-check-circle ml-1"></i>
                                                                                        </span>
                                                                                            <span class="collapse js-test-answer">
                                                                                            <i class="fa fa-check-circle ml-1"></i>
                                                                                        </span>
                                                                                        <?php } else { ?>
                                                                                            <span class="question__result">
                                                                                            <i class="fa fa-times-circle ml-1"></i>
                                                                                        </span>
                                                                                        <?php }?>
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                        <?php }?>
                                                                        <?php if ($_smarty_tpl->tpl_vars['sub_question']->value['answer_b']) {?>
                                                                            <div class="col-12 mt-3">
                                                                                <div class="d-flex" style="font-size: 18px; line-height: 21px;">
                                                                                    <label class="radio-styled media d-flex">
                                                                                        <input class="question__input radio-styled__input js-test-input <?php if ($_smarty_tpl->tpl_vars['sub_question']->value['correct_answer'] == '2' || mb_strtoupper($_smarty_tpl->tpl_vars['sub_question']->value['correct_answer'], 'UTF-8') == 'B') {?>correct<?php }?>" type="radio" name="question-<?php echo $_smarty_tpl->tpl_vars['q']->value;
echo $_smarty_tpl->tpl_vars['i']->value;?>
" disabled="disabled" data-point="<?php echo $_smarty_tpl->tpl_vars['sub_question']->value['point'];?>
" />
                                                                                        <span class="radio-styled__icon"></span>
                                                                                        <span><?php echo htmlDecode($_smarty_tpl->tpl_vars['sub_question']->value['answer_b']);?>
</span>
                                                                                        <?php if ($_smarty_tpl->tpl_vars['sub_question']->value['correct_answer'] == '2' || mb_strtoupper($_smarty_tpl->tpl_vars['sub_question']->value['correct_answer'], 'UTF-8') == 'B') {?>
                                                                                            <span class="question__result">
                                                                                            <i class="fa fa-check-circle ml-1"></i>
                                                                                        </span>
                                                                                            <span class="collapse js-test-answer">
                                                                                            <i class="fa fa-check-circle ml-1"></i>
                                                                                        </span>
                                                                                        <?php } else { ?>
                                                                                            <span class="question__result">
                                                                                            <i class="fa fa-times-circle ml-1"></i>
                                                                                        </span>
                                                                                        <?php }?>
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                        <?php }?>
                                                                        <?php if ($_smarty_tpl->tpl_vars['sub_question']->value['answer_c']) {?>
                                                                            <div class="col-12 mt-3">
                                                                                <div class="d-flex" style="font-size: 18px; line-height: 21px;">
                                                                                    <label class="radio-styled media d-flex">
                                                                                        <input class="question__input radio-styled__input js-test-input <?php if ($_smarty_tpl->tpl_vars['sub_question']->value['correct_answer'] == '3' || mb_strtoupper($_smarty_tpl->tpl_vars['sub_question']->value['correct_answer'], 'UTF-8') == 'C') {?>correct<?php }?>" type="radio" name="question-<?php echo $_smarty_tpl->tpl_vars['q']->value;
echo $_smarty_tpl->tpl_vars['i']->value;?>
" disabled="disabled" data-point="<?php echo $_smarty_tpl->tpl_vars['sub_question']->value['point'];?>
" />
                                                                                        <span class="radio-styled__icon"></span>
                                                                                        <span><?php echo htmlDecode($_smarty_tpl->tpl_vars['sub_question']->value['answer_c']);?>
</span>
                                                                                        <?php if ($_smarty_tpl->tpl_vars['sub_question']->value['correct_answer'] == '3' || mb_strtoupper($_smarty_tpl->tpl_vars['sub_question']->value['correct_answer'], 'UTF-8') == 'C') {?>
                                                                                            <span class="question__result">
                                                                                            <i class="fa fa-check-circle ml-1"></i>
                                                                                        </span>
                                                                                            <span class="collapse js-test-answer">
                                                                                            <i class="fa fa-check-circle ml-1"></i>
                                                                                        </span>
                                                                                        <?php } else { ?>
                                                                                            <span class="question__result">
                                                                                            <i class="fa fa-times-circle ml-1"></i>
                                                                                        </span>
                                                                                        <?php }?>
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                        <?php }?>
                                                                        <?php if ($_smarty_tpl->tpl_vars['sub_question']->value['answer_d']) {?>
                                                                            <div class="col-12 mt-3">
                                                                                <div class="d-flex" style="font-size: 18px; line-height: 21px;">
                                                                                    <label class="radio-styled media d-flex">
                                                                                        <input class="question__input radio-styled__input js-test-input <?php if ($_smarty_tpl->tpl_vars['sub_question']->value['correct_answer'] == '4' || mb_strtoupper($_smarty_tpl->tpl_vars['sub_question']->value['correct_answer'], 'UTF-8') == 'D') {?>correct<?php }?>" type="radio" name="question-<?php echo $_smarty_tpl->tpl_vars['q']->value;
echo $_smarty_tpl->tpl_vars['i']->value;?>
" disabled="disabled" data-point="<?php echo $_smarty_tpl->tpl_vars['sub_question']->value['point'];?>
" />
                                                                                        <span class="radio-styled__icon"></span>
                                                                                        <span><?php echo htmlDecode($_smarty_tpl->tpl_vars['sub_question']->value['answer_d']);?>
</span>
                                                                                        <?php if ($_smarty_tpl->tpl_vars['sub_question']->value['correct_answer'] == '4' || mb_strtoupper($_smarty_tpl->tpl_vars['sub_question']->value['correct_answer'], 'UTF-8') == 'D') {?>
                                                                                            <span class="question__result">
                                                                                            <i class="fa fa-check-circle ml-1"></i>
                                                                                        </span>
                                                                                            <span class="collapse js-test-answer">
                                                                                            <i class="fa fa-check-circle ml-1"></i>
                                                                                        </span>
                                                                                        <?php } else { ?>
                                                                                            <span class="question__result">
                                                                                            <i class="fa fa-times-circle ml-1"></i>
                                                                                        </span>
                                                                                        <?php }?>
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                        <?php }?>
                                                                    </div>
                                                                    <?php $_smarty_tpl->_assignInScope('i', $_smarty_tpl->tpl_vars['i']->value+1);?>
                                                                <?php }?>
                                                            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                                        <?php } else { ?>
                                                            <div class="row">
                                                                <?php if ($_smarty_tpl->tpl_vars['question']->value['answer_a']) {?>
                                                                    <div class="col-12 mt-3">
                                                                        <div class="d-flex" style="font-size: 18px; line-height: 21px;">
                                                                            <label class="radio-styled media d-flex">
                                                                                <input class="question__input radio-styled__input js-test-input <?php if ($_smarty_tpl->tpl_vars['question']->value['correct_answer'] == '1' || mb_strtoupper($_smarty_tpl->tpl_vars['question']->value['correct_answer'], 'UTF-8') == 'A') {?>correct<?php }?>" type="radio" name="question-<?php echo $_smarty_tpl->tpl_vars['q']->value;?>
" disabled="disabled" data-point="<?php echo $_smarty_tpl->tpl_vars['question']->value['point'];?>
" />
                                                                                <span class="radio-styled__icon"></span>
                                                                                <span><?php echo htmlDecode($_smarty_tpl->tpl_vars['question']->value['answer_a']);?>
</span>
                                                                                <?php if ($_smarty_tpl->tpl_vars['question']->value['correct_answer'] == '1' || mb_strtoupper($_smarty_tpl->tpl_vars['question']->value['correct_answer'], 'UTF-8') == 'A') {?>
                                                                                    <span class="question__result">
                                                                                        <i class="fa fa-check-circle ml-1"></i>
                                                                                    </span>
                                                                                    <span class="collapse js-test-answer">
                                                                                        <i class="fa fa-check-circle ml-1"></i>
                                                                                    </span>
                                                                                <?php } else { ?>
                                                                                    <span class="question__result">
                                                                                        <i class="fa fa-times-circle ml-1"></i>
                                                                                    </span>
                                                                                <?php }?>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                <?php }?>
                                                                <?php if ($_smarty_tpl->tpl_vars['question']->value['answer_b']) {?>
                                                                    <div class="col-12 mt-3">
                                                                        <div class="d-flex" style="font-size: 18px; line-height: 21px;">
                                                                            <label class="radio-styled media d-flex">
                                                                                <input class="question__input radio-styled__input js-test-input <?php if ($_smarty_tpl->tpl_vars['question']->value['correct_answer'] == '2' || mb_strtoupper($_smarty_tpl->tpl_vars['question']->value['correct_answer'], 'UTF-8') == 'B') {?>correct<?php }?>" type="radio" name="question-<?php echo $_smarty_tpl->tpl_vars['q']->value;?>
" disabled="disabled" data-point="<?php echo $_smarty_tpl->tpl_vars['question']->value['point'];?>
" />
                                                                                <span class="radio-styled__icon"></span>
                                                                                <span><?php echo htmlDecode($_smarty_tpl->tpl_vars['question']->value['answer_b']);?>
</span>
                                                                                <?php if ($_smarty_tpl->tpl_vars['question']->value['correct_answer'] == '2' || mb_strtoupper($_smarty_tpl->tpl_vars['question']->value['correct_answer'], 'UTF-8') == 'B') {?>
                                                                                    <span class="question__result">
                                                                                        <i class="fa fa-check-circle ml-1"></i>
                                                                                    </span>
                                                                                    <span class="collapse js-test-answer">
                                                                                        <i class="fa fa-check-circle ml-1"></i>
                                                                                    </span>
                                                                                <?php } else { ?>
                                                                                    <span class="question__result">
                                                                                        <i class="fa fa-times-circle ml-1"></i>
                                                                                    </span>
                                                                                <?php }?>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                <?php }?>
                                                                <?php if ($_smarty_tpl->tpl_vars['question']->value['answer_c']) {?>
                                                                    <div class="col-12 mt-3">
                                                                        <div class="d-flex" style="font-size: 18px; line-height: 21px;">
                                                                            <label class="radio-styled media d-flex">
                                                                                <input class="question__input radio-styled__input js-test-input <?php if ($_smarty_tpl->tpl_vars['question']->value['correct_answer'] == '3' || mb_strtoupper($_smarty_tpl->tpl_vars['question']->value['correct_answer'], 'UTF-8') == 'C') {?>correct<?php }?>" type="radio" name="question-<?php echo $_smarty_tpl->tpl_vars['q']->value;?>
" disabled="disabled" data-point="<?php echo $_smarty_tpl->tpl_vars['question']->value['point'];?>
" />
                                                                                <span class="radio-styled__icon"></span>
                                                                                <span><?php echo htmlDecode($_smarty_tpl->tpl_vars['question']->value['answer_c']);?>
</span>
                                                                                <?php if ($_smarty_tpl->tpl_vars['question']->value['correct_answer'] == '3' || mb_strtoupper($_smarty_tpl->tpl_vars['question']->value['correct_answer'], 'UTF-8') == 'C') {?>
                                                                                    <span class="question__result">
                                                                                        <i class="fa fa-check-circle ml-1"></i>
                                                                                    </span>
                                                                                    <span class="collapse js-test-answer">
                                                                                        <i class="fa fa-check-circle ml-1"></i>
                                                                                    </span>
                                                                                <?php } else { ?>
                                                                                    <span class="question__result">
                                                                                        <i class="fa fa-times-circle ml-1"></i>
                                                                                    </span>
                                                                                <?php }?>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                <?php }?>
                                                                <?php if ($_smarty_tpl->tpl_vars['question']->value['answer_d']) {?>
                                                                    <div class="col-12 mt-3">
                                                                        <div class="d-flex" style="font-size: 18px; line-height: 21px;">
                                                                            <label class="radio-styled media d-flex">
                                                                                <input class="question__input radio-styled__input js-test-input <?php if ($_smarty_tpl->tpl_vars['question']->value['correct_answer'] == '4' || mb_strtoupper($_smarty_tpl->tpl_vars['question']->value['correct_answer'], 'UTF-8') == 'D') {?>correct<?php }?>" type="radio" name="question-<?php echo $_smarty_tpl->tpl_vars['q']->value;?>
" disabled="disabled" data-point="<?php echo $_smarty_tpl->tpl_vars['question']->value['point'];?>
" />
                                                                                <span class="radio-styled__icon"></span>
                                                                                <span><?php echo htmlDecode($_smarty_tpl->tpl_vars['question']->value['answer_d']);?>
</span>
                                                                                <?php if ($_smarty_tpl->tpl_vars['question']->value['correct_answer'] == '4' || mb_strtoupper($_smarty_tpl->tpl_vars['question']->value['correct_answer'], 'UTF-8') == 'D') {?>
                                                                                    <span class="question__result">
                                                                                        <i class="fa fa-check-circle ml-1"></i>
                                                                                    </span>
                                                                                    <span class="collapse js-test-answer">
                                                                                        <i class="fa fa-check-circle ml-1"></i>
                                                                                    </span>
                                                                                <?php } else { ?>
                                                                                    <span class="question__result">
                                                                                        <i class="fa fa-times-circle ml-1"></i>
                                                                                    </span>
                                                                                <?php }?>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                <?php }?>
                                                            </div>
                                                            <?php $_smarty_tpl->_assignInScope('i', $_smarty_tpl->tpl_vars['i']->value+1);?>
                                                        <?php }?>
                                                    </div>
                                                </div>
                                            </li>
                                        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                    </ul>
                                <?php }?>
                            </li>
                            <li class="mb-6">
                                <a class="btn btn-danger mr-2 js-finish-test" href="javascript:;"><?php echo smarty_modifier_lang('Result');?>
</a>
                                <a class="btn btn-primary mr-2 js-reset-test" href="javascript:;"><?php echo smarty_modifier_lang('Rework');?>
</a>
                                <a class="btn btn-success mr-2 js-show-answer" href="javascript:;"><?php echo smarty_modifier_lang('Answer');?>
</a>
                            </li>
                        </ul>
                        <div>
                            <div class="fb-comments" data-href="<?php echo $_smarty_tpl->tpl_vars['Rewrite']->value->url_exam($_smarty_tpl->tpl_vars['arrOneExam']->value);?>
" data-width="100%" data-numposts="10"></div>
                        </div>
                    </article>
                </div>
                <div class="col-lg-4 d-lg-none mb-30">
                    <div class="aside">
                        <?php if ($_smarty_tpl->tpl_vars['arrListOtherExams']->value) {?>
                            <div class="aside__block">
                                <h2 class="aside__title"><?php echo $_smarty_tpl->tpl_vars['core']->value->getLang('Related_test');?>
</h2>
                                <ul class="list-unstyled mb-0">
                                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['arrListOtherExams']->value, 'exam', false, 'e');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['e']->value => $_smarty_tpl->tpl_vars['exam']->value) {
?>
                                        <li class="mb-20 m-last-0">
                                            <a class="as-card card card-body" href="<?php echo $_smarty_tpl->tpl_vars['Rewrite']->value->url_exam($_smarty_tpl->tpl_vars['exam']->value);?>
">
                                                <div class="text-600 text-16 mb-2"><?php echo $_smarty_tpl->tpl_vars['exam']->value['name'];?>
 #<?php echo $_smarty_tpl->tpl_vars['exam']->value['exam_id'];?>
</div>
                                                <div>
                                                    <?php if ($_smarty_tpl->tpl_vars['exam']->value['time_end']) {?>
                                                        <i class="fa fa-clock-o mr-1"></i>
                                                        <span><?php echo $_smarty_tpl->tpl_vars['exam']->value['time_end'];?>
 <?php echo smarty_modifier_lang('minute');?>
</span>
                                                    <?php }?>
                                                </div>
                                            </a>
                                        </li>
                                    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                </ul>
                            </div>
                        <?php }?>
                    </div>
                </div>
            </div>
        <?php } else { ?>
            <?php $_smarty_tpl->_subTemplateRender("file:_blocks/login_form.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
        <?php }?>
    </div>
</section>
<div class="sticky-time">
    <div class="sticky-time__iwrap">
        <img src="<?php echo $_smarty_tpl->tpl_vars['URL_IMAGES']->value;?>
/sticky-img.png" alt="sticky"></div>
    <div class="sticky-time__timer js-test-timer">00:00:00</div>
</div>
<?php }
}
