{include file="trialtest/act_detail.tpl"}

{*<div class="transparent-overlay"></div>*}
{*<div class="container">*}
{*    <div class="border-top"></div>*}
{*</div>*}
{*<nav>*}
{*    <div class="container">*}
{*        <ol class="breadcrumb">*}
{*            <li class="breadcrumb-item">*}
{*                <a class="link-unstyled" href="{$VNCMS_URL}">{'Home'|lang}</a>*}
{*            </li>*}
{*            <li class="breadcrumb-item">*}
{*                <a class="link-unstyled" href="{$VNCMS_URL}/exams">{'JLPT_exam_inventory'|lang}</a>*}
{*            </li>*}
{*            <li class="breadcrumb-item active">{$arrOneExam.name}</li>*}
{*        </ol>*}
{*    </div>*}
{*</nav>*}
{*<section class="section mb-50">*}
{*    <div class="container">*}
{*        {if $isLogin eq 1}*}
{*            <div class="row">*}
{*                <div class="col-lg-4 mb-30 floating-container">*}
{*                    <div class="floating">*}
{*                        <div class="aside">*}
{*                            <div class="aside__block">*}
{*                                <div class="test-info card card-body js-test-panel">*}
{*                                    <div class="test-info__title">{$arrOneTest.name}</div>*}
{*                                    <div class="test-info__time js-total-time">{'Total_time'|lang}</div>*}
{*                                    <div class="test-info__desc">{'Mock_exam'|lang} - {$arrOneTest.level_name}</div>*}
{*                                    <div class="test-info__skill js-test-info-skill">{'Skills'|lang}:</div>*}
{*                                    <!-- data-timer tính bằng giây-->*}
{*                                    <div class="test-info__timer js-test-timer">00:00:00</div>*}
{*                                    <div class="test-info__loading js-test-loading" data-text="Đang tải bài thi">*}
{*                                        <span>Đang tải bài thi (0%)</span>*}
{*                                        <img src="{URL_IMAGES}/loading.gif" alt="">*}
{*                                    </div>*}
{*                                    <div class="text-center">*}
{*                                        <a class="test-info__btn btn btn-lg btn-outline-light js-toggle-test" href="javascript:;" data-btn="start" data-start="{'Start'|lang}" data-submit="{'Submit_Test'|lang}" data-continue="{'Continue_Test'|lang}" data-result="{'Loading_Test'|lang}" >{'Loading_Test'|lang}</a>*}
{*                                        <div class="form-text">*}
{*                                            <i class="fa fa-headphones mr-2"></i>*}
{*                                            <small>{'Open_the_speaker_or_wear_a_headset_to_hear_the_question'|lang}</small>*}
{*                                        </div>*}
{*                                    </div>*}
{*                                </div>*}
{*                            </div>*}
{*                            <div class="aside__block d-none d-lg-block">*}
{*                                {if $arrListOtherExams}*}
{*                                    <h2 class="aside__title">{$core->getLang('Related_test')}</h2>*}
{*                                    <ul class="list-unstyled mb-0">*}
{*                                        {foreach from=$arrListOtherExams key=e item=exam}*}
{*                                            <li class="mb-20 m-last-0">*}
{*                                                <a class="as-card card card-body" href="{$Rewrite->url_exam($exam)}">*}
{*                                                    <div class="text-600 text-16 mb-2">{$exam.name} #{$exam.exam_id}</div>*}
{*                                                    <div>*}
{*                                                        {if $exam.time_end}*}
{*                                                            <i class="fa fa-clock-o mr-1"></i>*}
{*                                                            <span>{$exam.time_end} {'minute'|lang}</span>*}
{*                                                        {/if}*}
{*                                                    </div>*}
{*                                                </a>*}
{*                                            </li>*}
{*                                        {/foreach}*}
{*                                    </ul>*}
{*                                {/if}*}
{*                            </div>*}
{*                        </div>*}
{*                  </div>*}
{*                </div>*}
{*                <div class="col-lg-8 mb-30">*}
{*                    <article class="test js-test" data-name="{$arrOneUser['fullname']}" data-course="{$arrOneTest.code}" data-totalpoint="{$arrOneTest.pass_score}">*}
{*                        <section class="py-50 js-resting-time collapse">*}
{*                            <div class="test__alert">{'Break_time'|lang}</div>*}
{*                            <div class="test__clock">*}
{*                                <span class="js-rest-timer">05:00</span>*}
{*                            </div>*}
{*                            <div class="text-center">*}
{*                                <a class="test__btn js-start-test" href="javascript:;">{'Skip_break_time'|lang}</a>*}
{*                            </div>*}
{*                            <small class="form-text text-muted text-center mt-3">*}
{*                                <i class="fa fa-lightbulb-o mr-2"></i>*}
{*                                <span>{'You_can_immediately_take_the_next_test_by_pressing_skip_break_time'|lang}</span>*}
{*                            </small>*}
{*                        </section>*}
{*                        {if $arrListExams}*}
{*                            {foreach from=$arrListExams key=e item=exam}*}
{*                                {if $e eq 0}*}
{*                                    {assign var="block" value="js-vocab"}*}
{*                                {elseif $e eq 1}*}
{*                                    {assign var="block" value=""}*}
{*                                {else}*}
{*                                    {assign var="block" value="js-listening"}*}
{*                                {/if}*}
{*                                <setion class="js-test-skill collapse" data-skill="{$e+1}" data-basepoint="{$exam.pass_score}" {if $exam.time_end}data-timer="{$exam.time_end*60}"{/if} data-title="{$exam.name}">*}
{*                                    <h2 class="test__title">{$exam.name}</h2>*}
{*                                    <ul class="list-unstyled mb-0">*}
{*                                        {if $exam.questions}*}
{*                                            {foreach from=$exam.questions key=q item=question}*}
{*                                                <li class="mb-6">*}
{*                                                    <section class="question-2 {if $question.attachment}js-sound11{/if}" {if $question.attachment}url="{$URL_UPLOADS}/{$question.attachment}"{/if}>*}

{*                                                        {if $question.attachment}*}
{*                                                        <div class="question-2__audio">*}
{*                                                          <audio preload="none" class="js-sound">*}
{*                                                            <source src="{$URL_UPLOADS}/{$question.attachment}" type="audio/mpeg" />*}
{*                                                          </audio>*}
{*                                                        </div>*}

{*                                                          <div class="js-sound" data-url="{$URL_UPLOADS}/{$question.attachment}"></div>*}
{*                                                        {/if}*}
{*                                                        <div class="question-2__header">*}
{*                                                            <div class="media">*}
{*                                                                <span class="mr-2">問題{$q+1}（{$question.point}点)：</span>*}
{*                                                                <div class="media-body">*}
{*                                                                    {$question.question|htmlDecode}*}
{*                                                                </div>*}
{*                                                            </div>*}
{*                                                        </div>*}
{*                                                        <div class="question-2__body">*}
{*                                                            {if $question.child}*}
{*                                                                {foreach from=$question.child key=sc1 item=sub_question}*}
{*                                                                    <div class="question-2__group {if $sub_question.attachment}js-sound11{/if}" {if $sub_question.attachment}url="{$URL_UPLOADS}/{$sub_question.attachment}"{/if}>*}

{*                                                                      {if $sub_question.attachment}*}
{*                                                                      <div class="question-2__audio">*}
{*                                                                        <audio preload="none" class="js-sound">*}
{*                                                                          <source src="{$URL_UPLOADS}/{$sub_question.attachment}" type="audio/mpeg" />*}
{*                                                                        </audio>*}
{*                                                                      </div>*}

{*                                                                        <div class="js-sound" data-url="{$URL_UPLOADS}/{$sub_question.attachment}"></div>*}
{*                                                                      {/if}*}

{*                                                                        <div class="question-2__query" data-name="sc1-{$e}{$q}{$sc1}">*}
{*                                                                            <div class="media">*}
{*                                                                                <span class="mr-2">{if $sub_question.child}問題{else}問{/if}{$sc1+1}：</span>*}
{*                                                                                <div class="media-body">*}
{*                                                                                    {$sub_question.question|htmlDecode}*}
{*                                                                                </div>*}
{*                                                                            </div>*}
{*                                                                        </div>*}
{*                                                                        {if $sub_question.child}*}
{*                                                                            <div class="pl-30">*}
{*                                                                                {foreach from=$sub_question.child key=sc2 item=sub_question2}*}
{*                                                                                    <div class="question-2__group {if $sub_question2.attachment}js-sound11{/if}" {if $sub_question2.attachment}url="{$URL_UPLOADS}/{$sub_question2.attachment}"{/if}>*}
{*                                                                                        {if $sub_question2.attachment}*}
{*                                                                                        *}{*<div class="question-2__audio">*}
{*                                                                                        *}{*	<audio preload="none" class="js-sound">*}

{*                                                                                        *}{*		<source src="{$URL_UPLOADS}/{$sub_question2.attachment}" type="audio/mpeg" />*}

{*                                                                                        *}{*	</audio>*}
{*                                                                                        *}{*</div>*}
{*                                                                                          <div class="js-sound" data-url="{$URL_UPLOADS}/{$sub_question2.attachment}"></div>*}
{*                                                                                        {/if}*}
{*                                                                                        <div class="question-2__query" data-name="sq2-{$e}{$q}{$sc1}{$sc2}">*}
{*                                                                                            <div class="media">*}
{*                                                                                                <span class="mr-2">問{$sc2+1}：</span>*}
{*                                                                                                <div class="media-body">*}
{*                                                                                                    {$sub_question2.question|htmlDecode}*}
{*                                                                                                </div>*}
{*                                                                                            </div>*}
{*                                                                                        </div>*}
{*                                                                                        <ul class="answers js-answer">*}
{*                                                                                            {if $sub_question2.answer_a}*}
{*                                                                                                <li class="answers__item">*}
{*                                                                                                    <label class="radio-styled">*}
{*                                                                                                        <input class="radio-styled__input js-answer-input {if $sub_question2.correct_answer eq '1' || $sub_question2.correct_answer|upper eq 'A'}{if $sub_question2.ctype}{$sub_question2.ctype}{else}{$block}{/if} correct{/if}" type="radio" name="sq2-{$e}{$q}{$sc1}{$sc2}" data-point="{$sub_question2.point}" />*}
{*                                                                                                        <span class="radio-styled__icon"></span>*}
{*                                                                                                        <span>{$sub_question2.answer_a|htmlDecode}</span>*}
{*                                                                                                    </label>*}
{*                                                                                                </li>*}
{*                                                                                            {/if}*}
{*                                                                                            {if $sub_question2.answer_b}*}
{*                                                                                                <li class="answers__item">*}
{*                                                                                                    <label class="radio-styled">*}
{*                                                                                                        <input class="radio-styled__input js-answer-input {if $sub_question2.correct_answer eq '2' || $sub_question2.correct_answer|upper eq 'B'}{if $sub_question2.ctype}{$sub_question2.ctype}{else}{$block}{/if} correct{/if}" type="radio" name="sq2-{$e}{$q}{$sc1}{$sc2}" data-point="{$sub_question2.point}" />*}
{*                                                                                                        <span class="radio-styled__icon"></span>*}
{*                                                                                                        <span>{$sub_question2.answer_b|htmlDecode}</span>*}
{*                                                                                                    </label>*}
{*                                                                                                </li>*}
{*                                                                                            {/if}*}
{*                                                                                            {if $sub_question2.answer_c}*}
{*                                                                                                <li class="answers__item">*}
{*                                                                                                    <label class="radio-styled">*}
{*                                                                                                        <input class="radio-styled__input js-answer-input {if $sub_question2.correct_answer eq '3' || $sub_question2.correct_answer|upper eq 'C'}{if $sub_question2.ctype}{$sub_question2.ctype}{else}{$block}{/if} correct{/if}" type="radio" name="sq2-{$e}{$q}{$sc1}{$sc2}" data-point="{$sub_question2.point}" />*}
{*                                                                                                        <span class="radio-styled__icon"></span>*}
{*                                                                                                        <span>{$sub_question2.answer_c|htmlDecode}</span>*}
{*                                                                                                    </label>*}
{*                                                                                                </li>*}
{*                                                                                            {/if}*}
{*                                                                                            {if $sub_question2.answer_d}*}
{*                                                                                                <li class="answers__item">*}
{*                                                                                                    <label class="radio-styled">*}
{*                                                                                                        <input class="radio-styled__input js-answer-input {if $sub_question2.correct_answer eq '4' || $sub_question2.correct_answer|upper eq 'D'}{if $sub_question2.ctype}{$sub_question2.ctype}{else}{$block}{/if} correct{/if}" type="radio" name="sq2-{$e}{$q}{$sc1}{$sc2}" data-point="{$sub_question2.point}" />*}
{*                                                                                                        <span class="radio-styled__icon"></span>*}
{*                                                                                                        <span>{$sub_question2.answer_d|htmlDecode}</span>*}
{*                                                                                                    </label>*}
{*                                                                                                </li>*}
{*                                                                                            {/if}*}
{*                                                                                        </ul>*}
{*                                                                                    </div>*}
{*                                                                                {/foreach}*}
{*                                                                            </div>*}
{*                                                                        {else}*}
{*                                                                            <ul class="answers js-answer">*}
{*                                                                                {if $sub_question.answer_a}*}
{*                                                                                    <li class="answers__item">*}
{*                                                                                        <label class="radio-styled">*}
{*                                                                                            <input class="radio-styled__input js-answer-input {if $sub_question.correct_answer eq '1' || $sub_question.correct_answer|upper eq 'A'}{if $sub_question.ctype}{$sub_question.ctype}{else}{$block}{/if} correct{/if}" type="radio" name="sc1-{$e}{$q}{$sc1}" data-point="{$sub_question.point}" />*}
{*                                                                                            <span class="radio-styled__icon"></span>*}
{*                                                                                            <span>{$sub_question.answer_a|htmlDecode}</span>*}
{*                                                                                        </label>*}
{*                                                                                    </li>*}
{*                                                                                {/if}*}
{*                                                                                {if $sub_question.answer_b}*}
{*                                                                                    <li class="answers__item">*}
{*                                                                                        <label class="radio-styled">*}
{*                                                                                            <input class="radio-styled__input js-answer-input {if $sub_question.correct_answer eq '2' || $sub_question.correct_answer|upper eq 'B'}{if $sub_question.ctype}{$sub_question.ctype}{else}{$block}{/if} correct{/if}" type="radio" name="sc1-{$e}{$q}{$sc1}" data-point="{$sub_question.point}" />*}
{*                                                                                            <span class="radio-styled__icon"></span>*}
{*                                                                                            <span>{$sub_question.answer_b|htmlDecode}</span>*}
{*                                                                                        </label>*}
{*                                                                                    </li>*}
{*                                                                                {/if}*}
{*                                                                                {if $sub_question.answer_c}*}
{*                                                                                    <li class="answers__item">*}
{*                                                                                        <label class="radio-styled">*}
{*                                                                                            <input class="radio-styled__input js-answer-input {if $sub_question.correct_answer eq '3' || $sub_question.correct_answer|upper eq 'C'}{if $sub_question.ctype}{$sub_question.ctype}{else}{$block}{/if} correct{/if}" type="radio" name="sc1-{$e}{$q}{$sc1}" data-point="{$sub_question.point}" />*}
{*                                                                                            <span class="radio-styled__icon"></span>*}
{*                                                                                            <span>{$sub_question.answer_c|htmlDecode}</span>*}
{*                                                                                        </label>*}
{*                                                                                    </li>*}
{*                                                                                {/if}*}
{*                                                                                {if $sub_question.answer_d}*}
{*                                                                                    <li class="answers__item">*}
{*                                                                                        <label class="radio-styled">*}
{*                                                                                            <input class="radio-styled__input js-answer-input {if $sub_question.correct_answer eq '4' || $sub_question.correct_answer|upper eq 'D'}{if $sub_question.ctype}{$sub_question.ctype}{else}{$block}{/if} correct{/if}" type="radio" name="sc1-{$e}{$q}{$sc1}" data-point="{$sub_question.point}" />*}
{*                                                                                            <span class="radio-styled__icon"></span>*}
{*                                                                                            <span>{$sub_question.answer_d|htmlDecode}</span>*}
{*                                                                                        </label>*}
{*                                                                                    </li>*}
{*                                                                                {/if}*}
{*                                                                            </ul>*}
{*                                                                        {/if}*}
{*                                                                    </div>*}
{*                                                                {/foreach}*}
{*                                                            {else}*}
{*                                                                <div class="question-2__group">*}
{*                                                                    <ul class="answers js-answer">*}
{*                                                                        {if $question.answer_a}*}
{*                                                                            <li class="answers__item">*}
{*                                                                                <label class="radio-styled">*}
{*                                                                                    <input class="radio-styled__input js-answer-input {if $question.correct_answer eq '1' || $question.correct_answer|upper eq 'A'}{if $question.ctype}{$question.ctype}{else}{$block}{/if} correct{/if}" type="radio" name="q-{$q}" data-point="{$question.point}" />*}
{*                                                                                    <span class="radio-styled__icon"></span>*}
{*                                                                                    <span>{$question.answer_a|htmlDecode}</span>*}
{*                                                                                </label>*}
{*                                                                            </li>*}
{*                                                                        {/if}*}
{*                                                                        {if $question.answer_b}*}
{*                                                                            <li class="answers__item">*}
{*                                                                                <label class="radio-styled">*}
{*                                                                                    <input class="radio-styled__input js-answer-input {if $question.correct_answer eq '2' || $question.correct_answer|upper eq 'B'}{if $question.ctype}{$question.ctype}{else}{$block}{/if} correct{/if}" type="radio" name="q-{$q}" data-point="{$question.point}" />*}
{*                                                                                    <span class="radio-styled__icon"></span>*}
{*                                                                                    <span>{$question.answer_b|htmlDecode}</span>*}
{*                                                                                </label>*}
{*                                                                            </li>*}
{*                                                                        {/if}*}
{*                                                                        {if $question.answer_c}*}
{*                                                                            <li class="answers__item">*}
{*                                                                                <label class="radio-styled">*}
{*                                                                                    <input class="radio-styled__input js-answer-input {if $question.correct_answer eq '3' || $question.correct_answer|upper eq 'C'}{if $question.ctype}{$question.ctype}{else}{$block}{/if} correct{/if}" type="radio" name="q-{$q}" data-point="{$question.point}" />*}
{*                                                                                    <span class="radio-styled__icon"></span>*}
{*                                                                                    <span>{$question.answer_c|htmlDecode}</span>*}
{*                                                                                </label>*}
{*                                                                            </li>*}
{*                                                                        {/if}*}
{*                                                                        {if $question.answer_d}*}
{*                                                                            <li class="answers__item">*}
{*                                                                                <label class="radio-styled">*}
{*                                                                                    <input class="radio-styled__input js-answer-input {if $question.correct_answer eq '4' || $question.correct_answer|upper eq 'D'}{if $question.ctype}{$question.ctype}{else}{$block}{/if} correct{/if}" type="radio" name="q-{$q}" data-point="{$question.point}" />*}
{*                                                                                    <span class="radio-styled__icon"></span>*}
{*                                                                                    <span>{$question.answer_d|htmlDecode}</span>*}
{*                                                                                </label>*}
{*                                                                            </li>*}
{*                                                                        {/if}*}
{*                                                                    </ul>*}
{*                                                                </div>*}
{*                                                            {/if}*}
{*                                                        </div>*}
{*                                                    </section>*}
{*                                                </li>*}
{*                                            {/foreach}*}
{*                                        {/if}*}
{*                                    </ul>*}
{*                                </setion>*}
{*                            {/foreach}*}
{*                            <setion class="js-summary collapse">*}
{*                                <h3 class="mb-3">{'You_have_completed_the_test'|lang}</h3>*}
{*                                <a class="test__btn test__btn--primary js-show-result" href="javascript:;">{'View_result'|lang}</a>*}
{*                                <a class="test__btn js-show-answer ml-2" href="javascript:;">{'View_answer'|lang}</a>*}
{*                            </setion>*}
{*                            <div class="text-center mb-50">*}
{*                                <div class="js-complete-test-wrapper collapse">*}
{*                                    <a class="test__btn test__btn--primary js-complete-test" href="javascript:;">{'Submit'|lang}</a>*}
{*                                </div>*}
{*                            </div>*}
{*                        {/if}*}
{*                    </article>*}
{*                    <!-- facebook comments-->*}
{*                    <div>*}
{*                        <div class="fb-comments" data-href="{$Rewrite->url_exam($arrOneExam)}" data-width="100%" data-numposts="10"></div>*}
{*                    </div>*}
{*                </div>*}
{*                <div class="col-lg-4 d-lg-none mb-30">*}
{*                    <div class="aside">*}
{*                        {if $arrListOtherExams}*}
{*                            <div class="aside__block">*}
{*                                <h2 class="aside__title">{$core->getLang('Related_test')}</h2>*}
{*                                <ul class="list-unstyled mb-0">*}
{*                                    {foreach from=$arrListOtherExams key=e item=exam}*}
{*                                        <li class="mb-20 m-last-0">*}
{*                                            <a class="as-card card card-body" href="{$Rewrite->url_exam($exam)}">*}
{*                                                <div class="text-600 text-16 mb-2">{$exam.name} #{$exam.exam_id}</div>*}
{*                                                <div>*}
{*                                                    {if $exam.time_end}*}
{*                                                        <i class="fa fa-clock-o mr-1"></i>*}
{*                                                        <span>{$exam.time_end} {'minute'|lang}</span>*}
{*                                                    {/if}*}
{*                                                </div>*}
{*                                            </a>*}
{*                                        </li>*}
{*                                    {/foreach}*}
{*                                </ul>*}
{*                            </div>*}
{*                        {/if}*}
{*                    </div>*}
{*                </div>*}
{*            </div>*}
{*        {else}*}
{*            {include file="_blocks/login_form.tpl"}*}
{*        {/if}*}
{*    </div>*}
{*</section>*}
{*<div class="sticky-time d-xl-none">*}
{*    <div class="sticky-time__iwrap">*}
{*        <img src="{$URL_IMAGES}/sticky-img.png" alt="sticky"></div>*}
{*    <div class="sticky-time__timer js-test-timer">00:00:00</div>*}
{*</div>*}

{*<div class="md-reload modal fade" tabindex="-1">*}
{*    <div class="modal-dialog">*}
{*        <div class="modal-content">*}
{*            <div class="modal-body">*}
{*                <div class="text-center">*}
{*                    <h3 class="text-primary">Đã có lỗi xảy ra!</h3>*}
{*                    <div>Website không thể tải được bài thi do kết nối không ổn định hoặc bị trình duyệt web ngăn chặn.</div>*}
{*                    <div>Vui lòng thử lại bằng cách tải lại trang!</div>*}
{*                </div>*}
{*                <div class="text-center mt-4">*}
{*                    <button class="btn btn-primary" type="button" onclick="window.location.reload();">Tải lại trang</button>*}
{*                    <button class="btn btn-light" data-dismiss="modal">Huỷ</button>*}
{*                </div>*}
{*            </div>*}
{*        </div>*}
{*    </div>*}
{*</div>*}
