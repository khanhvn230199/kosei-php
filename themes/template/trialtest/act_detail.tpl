<div class="container">
  <div class="border-top"></div>
</div>

<nav>
  <div class="container">
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a class="link-unstyled" href="{$VNCMS_URL}">{'Home'|lang}</a>
      </li>
      <li class="breadcrumb-item active">{$arrOneTest.name}</li>
    </ol>
  </div>
</nav>

<section class="section mb-50">
  <div class="container">
    {*      {if $isLogin eq 1}*}
      <div class="row">
        <div class="col-lg-4 mb-30 floating-container">
          <div class="floating">
            <div class="aside">
              <div class="aside__block">
                <div class="test-info card card-body js-test-panel">
                  <div class="test-info__title">{$arrOneTest.name}</div>
                  {if $isLogin eq 1}
                    <div class="test-info__time js-total-time">{'Total_time'|lang}</div>
                    <div class="test-info__desc">{'Mock_exam'|lang} - {$arrOneTest.level_name}</div>
                    <div class="test-info__skill js-test-info-skill">{'Skills'|lang}:</div>
                    <!-- data-timer tính bằng giây-->
                    <div class="test-info__timer js-test-timer">00:00:00</div>
                    <div class="test-info__loading js-test-loading" data-text="Đang tải bài thi">
                      <span>Đang tải bài thi (0%)</span>
                      <img src="{URL_IMAGES}/loading.gif" alt="">
                    </div>
                    <div class="text-center">
                      <a class="test-info__btn btn btn-lg btn-outline-light js-toggle-test" href="javascript:;" data-btn="start" data-start="{'Start'|lang}" data-submit="{'Submit_Test'|lang}" data-continue="{'Continue_Test'|lang}" data-result="Xem kết quả">{'Loading_Test'|lang}</a>
                      <div class="form-text">
                        <i class="fa fa-headphones mr-2"></i>
                        <small>{'Open_the_speaker_or_wear_a_headset_to_hear_the_question'|lang}</small>
                      </div>
                    </div>
                  {else}
                    <div class="test-info__desc">{'Mock_exam'|lang} - {$arrOneTest.level_name}</div>
                    <div class="mb-2">Bạn cần đăng nhập để tham gia thi thử !</div>
                    <div class="text-center mt-2">
                      <a class="test-info__btn btn btn-lg btn-outline-light" href=".md-login" data-toggle="modal">Đăng nhập</a>
                    </div>
                  {/if}
                </div>
              </div>
              {if $isLogin eq 1 and $highScores}
                <div class="aside__block d-none d-lg-block">
                  <h2 class="aside__title">Học viên đạt điểm cao</h2>
                  <ul class="list-unstyled mb-0">
                    {foreach from=$highScores item=score key=key}
                      {if $key lt 5}
                        <li class="mb-20 m-last-0">
                          <div class="highscore media">
                            <div class="highscore__left">
                              <div class="highscore__frame">
                                {* <img src="{if $score.avatar}{$URL_UPLOADS}/{$score.avatar}{else}{$URL_IMAGES}/no_profile.png{/if}" alt=""> *}
                                <img src="{$core->callfunc("validAvatar", $score.avatar)}" alt="">
                              </div>
                              <div class="highscore__number">{($key + 1)}</div>
                            </div>
                            <div class="media-body">
                              <div class="highscore__name">{$score.fullname}</div>
                              <div class="highscore__item">
                                <strong>Tổng điểm:</strong>
                                <strong class="text-danger">{$score.total_score}/180</strong>
                              </div>

                              {if $arrOneTest.level_id == 9 OR $arrOneTest.level_id == 4}
                              <div class="highscore__item">
                                <span>Từ vựng + Ngữ pháp + Đọc hiểu:</span>
                                <strong class="text-danger">{($score.vocabulary_score + $score.reading_score)}/120</strong>
                              </div>
                              {else}
                              <div class="highscore__item">
                                <span>Từ vựng + Ngữ pháp:</span>
                                <strong class="text-danger">{$score.vocabulary_score}/60</strong>
                              </div>
                              <div class="highscore__item">
                                <span>Đọc hiểu:</span>
                                <strong class="text-danger">{$score.reading_score}/60</strong>
                              </div>
                              {/if}
                              <div class="highscore__item">
                                <span>Nghe hiểu:</span>
                                <strong class="text-danger">{$score.listening_score}/60</strong>
                              </div>
                            </div>
                          </div>
                        </li>
                      {/if}
                    {/foreach}
                  </ul>

                  <div class="text-center mt-3">
                    <a href="{$Rewrite->url_ranking()}?test_id={$arrOneTest.test_id}" class="btn btn-sm btn-primary px-4 text-uppercase text-700">Xem thêm</a>
                  </div>
                </div>
              {/if}
            </div>
          </div>
        </div>
        <div class="col-lg-8 mb-30">
          {if $isLogin eq 1}
            <article class="test js-test" data-name="{$arrOneUser['fullname']}" data-course="{$arrOneTest.code}" data-test="{$arrOneTest.tt_id}" data-test-id="{$arrOneTest.test_id}" data-totalpoint="{$arrOneTest.pass_score}" data-level-id="{$arrOneTest.level_id}">
              <section class="py-50 js-resting-time collapse">
                <div class="test__alert">{'Break_time'|lang}</div>
                <div class="test__clock">
                  <span class="js-rest-timer">05:00</span>
                </div>
                <div class="text-center">
                  <a class="test__btn js-start-test" href="javascript:;">{'Skip_break_time'|lang}</a>
                </div>
                <small class="form-text text-muted text-center mt-3">
                  <i class="fa fa-lightbulb-o mr-2"></i>
                  <span>{'You_can_immediately_take_the_next_test_by_pressing_skip_break_time'|lang}</span>
                </small>
              </section>

              {if $exams}
                {foreach from=$exams key=examIdx item=exam}
                  {if $examIdx eq 0}
                    {assign var="questionType" value="js-vocab"}
                  {elseif $examIdx eq 1}
                    {assign var="questionType" value="js-reading"}
                  {else}
                    {assign var="questionType" value="js-listening"}
                  {/if}

                  {include file="_blocks/_exam.tpl"}
                {/foreach}
                <setion class="js-summary collapse">
                  <h3 class="mb-3">{'You_have_completed_the_test'|lang}</h3>
                  <a class="test__btn test__btn--primary js-show-result" href="javascript:;">{'View_result'|lang}</a>
                  <a class="test__btn js-show-answer ml-2" href="javascript:;">{'View_answer'|lang}</a>
                </setion>
                <div class="text-center mb-50">
                  <div class="js-complete-test-wrapper collapse">
                    <a class="test__btn test__btn--primary js-complete-test" href="javascript:;">{'Submit'|lang}</a>
                  </div>
                </div>
              {/if}
            </article>
          {elseif $highScores}
            <h2 class="text-center text-uppercase text-20 text-700 text-center mb-3">Học viên đạt điểm cao</h2>
            <div class="table-responsive">
              <table class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th class="bg-primary text-white text-center">STT</th>
                    <th class="bg-primary text-white">Họ và tên</th>
                    <th class="bg-primary text-white text-center">Ngày thi</th>
                   {if $arrOneTest.level_id == 9 OR $arrOneTest.level_id == 4}
                    <th class="bg-primary text-white text-right">Từ vựng <br />+ Ngữ pháp<br />+ Đọc hiểu</th>
                    {else}
                    <th class="bg-primary text-white text-right">Từ vựng <br />+ Ngữ pháp</th>
                    <th class="bg-primary text-white text-right">Đọc hiểu</th>
                    {/if}
                    <th class="bg-primary text-white text-right">Nghe hiểu</th>
                    <th class="bg-primary text-white text-right">Tổng điểm</th>
                  </tr>
                </thead>
                <tbody>
                  {foreach from=$highScores key=i item=score}
                    <tr>
                      <td class="text-center">{$i + 1}</td>
                      <td>
                        <div class="media align-items-center">
                          {* <img src="{if $score.avatar}{$URL_UPLOADS}/{$score.avatar}{else}{$URL_IMAGES}/no_profile.png{/if}" class="mr-3" alt="" width="35" height="35" style="border-radius: 50%"> *}
                          <img src="{$core->callfunc("validAvatar", $score.avatar)}" class="mr-3" alt="" width="35" height="35" style="border-radius: 50%">
                          <div class="media-body">{$score.fullname}</div>
                        </div>
                      </td>
                      <td class="text-center">{$score.reg_date|date_format:"%d/%m/%Y"}</td>
                     {if $arrOneTest.level_id == 9 OR $arrOneTest.level_id == 4}
                      <td class="text-right text-16">{($score.vocabulary_score + $score.reading_score)}/120</td>
                      {else}
                      <td class="text-right text-16">{$score.vocabulary_score}/60</td>
                      <td class="text-right text-16">{$score.reading_score}/60</td>
                      {/if}
                      <td class="text-right text-16">{$score.listening_score}/60</td>
                      <td class="text-right text-16 text-700 text-danger">{$score.total_score}/180</td>
                    </tr>
                  {/foreach}
                </tbody>
              </table>
            </div>
          {/if}
          <!-- facebook comments-->
          {*            <div>*}
          <!-- <div class="fb-comments" data-href="{$Rewrite->url_exam($arrOneExam)}" data-width="100%" data-numposts="10"></div> -->
          {*            </div>*}
        </div>
      </div>
    </div>
  </section>

  <div class="sticky-time d-xl-none">
    <div class="sticky-time__iwrap">
      <img src="{$URL_IMAGES}/sticky-img.png" alt="sticky">
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
