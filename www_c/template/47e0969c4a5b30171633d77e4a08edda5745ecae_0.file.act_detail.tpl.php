<?php
/* Smarty version 3.1.32, created on 2021-12-07 18:47:32
  from '/var/www/koseionline.vn/data/www/koseionline.vn/themes/template/trialtest/act_detail.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_61af49d44b5f68_52524708',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '47e0969c4a5b30171633d77e4a08edda5745ecae' => 
    array (
      0 => '/var/www/koseionline.vn/data/www/koseionline.vn/themes/template/trialtest/act_detail.tpl',
      1 => 1638856735,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:_blocks/_exam.tpl' => 1,
  ),
),false)) {
function content_61af49d44b5f68_52524708 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/var/www/koseionline.vn/data/www/koseionline.vn/includes/smarty3/plugins/modifier.lang.php','function'=>'smarty_modifier_lang',),1=>array('file'=>'/var/www/koseionline.vn/data/www/koseionline.vn/includes/smarty3/plugins/modifier.date_format.php','function'=>'smarty_modifier_date_format',),));
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
      <li class="breadcrumb-item active"><?php echo $_smarty_tpl->tpl_vars['arrOneTest']->value['name'];?>
</li>
    </ol>
  </div>
</nav>

<section class="section mb-50">
  <div class="container">
          <div class="row">
        <div class="col-lg-4 mb-30 floating-container">
          <div class="floating">
            <div class="aside">
              <div class="aside__block">
                <div class="test-info card card-body js-test-panel">
                  <div class="test-info__title"><?php echo $_smarty_tpl->tpl_vars['arrOneTest']->value['name'];?>
</div>
                  <?php if ($_smarty_tpl->tpl_vars['isLogin']->value == 1) {?>
                    <div class="test-info__time js-total-time"><?php echo smarty_modifier_lang('Total_time');?>
</div>
                    <div class="test-info__desc"><?php echo smarty_modifier_lang('Mock_exam');?>
 - <?php echo $_smarty_tpl->tpl_vars['arrOneTest']->value['level_name'];?>
</div>
                    <div class="test-info__skill js-test-info-skill"><?php echo smarty_modifier_lang('Skills');?>
:</div>
                    <!-- data-timer tính bằng giây-->
                    <div class="test-info__timer js-test-timer">00:00:00</div>
                    <div class="test-info__loading js-test-loading" data-text="Đang tải bài thi">
                      <span>Đang tải bài thi (0%)</span>
                      <img src="<?php echo URL_IMAGES;?>
/loading.gif" alt="">
                    </div>
                    <div class="text-center">
                      <a class="test-info__btn btn btn-lg btn-outline-light js-toggle-test" href="javascript:;" data-btn="start" data-start="<?php echo smarty_modifier_lang('Start');?>
" data-submit="<?php echo smarty_modifier_lang('Submit_Test');?>
" data-continue="<?php echo smarty_modifier_lang('Continue_Test');?>
" data-result="Xem kết quả"><?php echo smarty_modifier_lang('Loading_Test');?>
</a>
                      <div class="form-text">
                        <i class="fa fa-headphones mr-2"></i>
                        <small><?php echo smarty_modifier_lang('Open_the_speaker_or_wear_a_headset_to_hear_the_question');?>
</small>
                      </div>
                    </div>
                  <?php } else { ?>
                    <div class="test-info__desc"><?php echo smarty_modifier_lang('Mock_exam');?>
 - <?php echo $_smarty_tpl->tpl_vars['arrOneTest']->value['level_name'];?>
</div>
                    <div class="mb-2">Bạn cần đăng nhập để tham gia thi thử !</div>
                    <div class="text-center mt-2">
                      <a class="test-info__btn btn btn-lg btn-outline-light" href=".md-login" data-toggle="modal">Đăng nhập</a>
                    </div>
                  <?php }?>
                </div>
              </div>
              <?php if ($_smarty_tpl->tpl_vars['isLogin']->value == 1 && $_smarty_tpl->tpl_vars['highScores']->value) {?>
                <div class="aside__block d-none d-lg-block">
                  <h2 class="aside__title">Học viên đạt điểm cao</h2>
                  <ul class="list-unstyled mb-0">
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['highScores']->value, 'score', false, 'key');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['score']->value) {
?>
                      <?php if ($_smarty_tpl->tpl_vars['key']->value < 5) {?>
                        <li class="mb-20 m-last-0">
                          <div class="highscore media">
                            <div class="highscore__left">
                              <div class="highscore__frame">
                                                                <img src="<?php echo $_smarty_tpl->tpl_vars['core']->value->callfunc("validAvatar",$_smarty_tpl->tpl_vars['score']->value['avatar']);?>
" alt="">
                              </div>
                              <div class="highscore__number"><?php echo ($_smarty_tpl->tpl_vars['key']->value+1);?>
</div>
                            </div>
                            <div class="media-body">
                              <div class="highscore__name"><?php echo $_smarty_tpl->tpl_vars['score']->value['fullname'];?>
</div>
                              <div class="highscore__item">
                                <strong>Tổng điểm:</strong>
                                <strong class="text-danger"><?php echo $_smarty_tpl->tpl_vars['score']->value['total_score'];?>
/180</strong>
                              </div>

                              <?php if ($_smarty_tpl->tpl_vars['arrOneTest']->value['level_id'] == 9 || $_smarty_tpl->tpl_vars['arrOneTest']->value['level_id'] == 4) {?>
                              <div class="highscore__item">
                                <span>Từ vựng + Ngữ pháp + Đọc hiểu:</span>
                                <strong class="text-danger"><?php echo ($_smarty_tpl->tpl_vars['score']->value['vocabulary_score']+$_smarty_tpl->tpl_vars['score']->value['reading_score']);?>
/120</strong>
                              </div>
                              <?php } else { ?>
                              <div class="highscore__item">
                                <span>Từ vựng + Ngữ pháp:</span>
                                <strong class="text-danger"><?php echo $_smarty_tpl->tpl_vars['score']->value['vocabulary_score'];?>
/60</strong>
                              </div>
                              <div class="highscore__item">
                                <span>Đọc hiểu:</span>
                                <strong class="text-danger"><?php echo $_smarty_tpl->tpl_vars['score']->value['reading_score'];?>
/60</strong>
                              </div>
                              <?php }?>
                              <div class="highscore__item">
                                <span>Nghe hiểu:</span>
                                <strong class="text-danger"><?php echo $_smarty_tpl->tpl_vars['score']->value['listening_score'];?>
/60</strong>
                              </div>
                            </div>
                          </div>
                        </li>
                      <?php }?>
                    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                  </ul>

                  <div class="text-center mt-3">
                    <a href="<?php echo $_smarty_tpl->tpl_vars['Rewrite']->value->url_ranking();?>
?test_id=<?php echo $_smarty_tpl->tpl_vars['arrOneTest']->value['test_id'];?>
" class="btn btn-sm btn-primary px-4 text-uppercase text-700">Xem thêm</a>
                  </div>
                </div>
              <?php }?>
            </div>
          </div>
        </div>
        <div class="col-lg-8 mb-30">
          <?php if ($_smarty_tpl->tpl_vars['isLogin']->value == 1) {?>
            <article class="test js-test" data-name="<?php echo $_smarty_tpl->tpl_vars['arrOneUser']->value['fullname'];?>
" data-course="<?php echo $_smarty_tpl->tpl_vars['arrOneTest']->value['code'];?>
" data-test="<?php echo $_smarty_tpl->tpl_vars['arrOneTest']->value['tt_id'];?>
" data-test-id="<?php echo $_smarty_tpl->tpl_vars['arrOneTest']->value['test_id'];?>
" data-totalpoint="<?php echo $_smarty_tpl->tpl_vars['arrOneTest']->value['pass_score'];?>
" data-level-id="<?php echo $_smarty_tpl->tpl_vars['arrOneTest']->value['level_id'];?>
">
              <section class="py-50 js-resting-time collapse">
                <div class="test__alert"><?php echo smarty_modifier_lang('Break_time');?>
</div>
                <div class="test__clock">
                  <span class="js-rest-timer">05:00</span>
                </div>
                <div class="text-center">
                  <a class="test__btn js-start-test" href="javascript:;"><?php echo smarty_modifier_lang('Skip_break_time');?>
</a>
                </div>
                <small class="form-text text-muted text-center mt-3">
                  <i class="fa fa-lightbulb-o mr-2"></i>
                  <span><?php echo smarty_modifier_lang('You_can_immediately_take_the_next_test_by_pressing_skip_break_time');?>
</span>
                </small>
              </section>

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
                <setion class="js-summary collapse">
                  <h3 class="mb-3"><?php echo smarty_modifier_lang('You_have_completed_the_test');?>
</h3>
                  <a class="test__btn test__btn--primary js-show-result" href="javascript:;"><?php echo smarty_modifier_lang('View_result');?>
</a>
                  <a class="test__btn js-show-answer ml-2" href="javascript:;"><?php echo smarty_modifier_lang('View_answer');?>
</a>
                </setion>
                <div class="text-center mb-50">
                  <div class="js-complete-test-wrapper collapse">
                    <a class="test__btn test__btn--primary js-complete-test" href="javascript:;"><?php echo smarty_modifier_lang('Submit');?>
</a>
                  </div>
                </div>
              <?php }?>
            </article>
          <?php } elseif ($_smarty_tpl->tpl_vars['highScores']->value) {?>
            <h2 class="text-center text-uppercase text-20 text-700 text-center mb-3">Học viên đạt điểm cao</h2>
            <div class="table-responsive">
              <table class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th class="bg-primary text-white text-center">STT</th>
                    <th class="bg-primary text-white">Họ và tên</th>
                    <th class="bg-primary text-white text-center">Ngày thi</th>
                   <?php if ($_smarty_tpl->tpl_vars['arrOneTest']->value['level_id'] == 9 || $_smarty_tpl->tpl_vars['arrOneTest']->value['level_id'] == 4) {?>
                    <th class="bg-primary text-white text-right">Từ vựng <br />+ Ngữ pháp<br />+ Đọc hiểu</th>
                    <?php } else { ?>
                    <th class="bg-primary text-white text-right">Từ vựng <br />+ Ngữ pháp</th>
                    <th class="bg-primary text-white text-right">Đọc hiểu</th>
                    <?php }?>
                    <th class="bg-primary text-white text-right">Nghe hiểu</th>
                    <th class="bg-primary text-white text-right">Tổng điểm</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['highScores']->value, 'score', false, 'i');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['i']->value => $_smarty_tpl->tpl_vars['score']->value) {
?>
                    <tr>
                      <td class="text-center"><?php echo $_smarty_tpl->tpl_vars['i']->value+1;?>
</td>
                      <td>
                        <div class="media align-items-center">
                                                    <img src="<?php echo $_smarty_tpl->tpl_vars['core']->value->callfunc("validAvatar",$_smarty_tpl->tpl_vars['score']->value['avatar']);?>
" class="mr-3" alt="" width="35" height="35" style="border-radius: 50%">
                          <div class="media-body"><?php echo $_smarty_tpl->tpl_vars['score']->value['fullname'];?>
</div>
                        </div>
                      </td>
                      <td class="text-center"><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['score']->value['reg_date'],"%d/%m/%Y");?>
</td>
                     <?php if ($_smarty_tpl->tpl_vars['arrOneTest']->value['level_id'] == 9 || $_smarty_tpl->tpl_vars['arrOneTest']->value['level_id'] == 4) {?>
                      <td class="text-right text-16"><?php echo ($_smarty_tpl->tpl_vars['score']->value['vocabulary_score']+$_smarty_tpl->tpl_vars['score']->value['reading_score']);?>
/120</td>
                      <?php } else { ?>
                      <td class="text-right text-16"><?php echo $_smarty_tpl->tpl_vars['score']->value['vocabulary_score'];?>
/60</td>
                      <td class="text-right text-16"><?php echo $_smarty_tpl->tpl_vars['score']->value['reading_score'];?>
/60</td>
                      <?php }?>
                      <td class="text-right text-16"><?php echo $_smarty_tpl->tpl_vars['score']->value['listening_score'];?>
/60</td>
                      <td class="text-right text-16 text-700 text-danger"><?php echo $_smarty_tpl->tpl_vars['score']->value['total_score'];?>
/180</td>
                    </tr>
                  <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                </tbody>
              </table>
            </div>
          <?php }?>
          <!-- facebook comments-->
                    <!-- <div class="fb-comments" data-href="<?php echo $_smarty_tpl->tpl_vars['Rewrite']->value->url_exam($_smarty_tpl->tpl_vars['arrOneExam']->value);?>
" data-width="100%" data-numposts="10"></div> -->
                  </div>
      </div>
    </div>
  </section>

  <div class="sticky-time d-xl-none">
    <div class="sticky-time__iwrap">
      <img src="<?php echo $_smarty_tpl->tpl_vars['URL_IMAGES']->value;?>
/sticky-img.png" alt="sticky">
    </div>
    <div class="sticky-time__timer js-test-timer">00:00:00</div>
  </div>

  <div class="md-reload modal fade" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body">
          <div class="text-center">
            <h3 class="text-primary">Đã có lỗi xảy ra!</h3>
            <div>Website không thể tải được bài thi do kết nối không ổn định hoặc bị trình duyệt web ngăn chặn.</div>
            <div>Vui lòng thử lại bằng cách tải lại trang!</div>
          </div>
          <div class="text-center mt-4">
            <button class="btn btn-primary" type="button" onclick="window.location.reload();">Tải lại trang</button>
            <button class="btn btn-light" data-dismiss="modal">Huỷ</button>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php }
}
