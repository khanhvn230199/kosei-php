<div class="container">
    <div class="border-top"></div>
</div>
<nav>
    <div class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a class="link-unstyled" href="{$VNCMS_URL}">{'Home'|lang}</a>
            </li>
            <li class="breadcrumb-item">
                <a class="link-unstyled" href="{$VNCMS_URL}/exams">{'JLPT_exam_inventory'|lang}</a>
            </li>
            <li class="breadcrumb-item active">{$arrOneExam.name}</li>
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
                                <div class="test-info__title">{$arrOneExam.name}</div>
                                <div class="test-info__time">{'Total_duration'|lang} {$arrOneExam.time_end} {'minute'|lang}</div>
                                <div class="test-info__desc">{$arrOneExam.skill_name} - {$arrOneExam.level_name}</div>
                                <!-- data-timer tính bằng giây-->
                                <div class="test-info__timer js-test-timer {if $arrOneExam.time_end > 0}js-data-timer{/if}" {if $arrOneExam.time_end > 0}data-timer="{$arrOneExam.time_end*60}"{/if}>00:00:00</div>
                                <div class="text-center">
                                    <a class="test-info__btn btn btn-lg btn-outline-light js-start-test" href="javascript:;" data-btn="start">{'Start'|lang}</a>
                                    {if $arrOneExam.time_end > 0}
                                        <div class="form-text">
                                            <i class="fa fa-headphones mr-2"></i>
                                            <span>{'Open_the_speaker_or_wear_a_headset_to_hear_the_question'|lang}</span>
                                        </div>
                                    {/if}
                                </div>
                            </div>
                        </div>
                        <div class="aside__block d-none d-lg-block">
                            {if $arrListOtherExams}
                                <h2 class="aside__title">{$core->getLang('Related_test')}</h2>
                                <ul class="list-unstyled mb-0">
                                    {foreach from=$arrListOtherExams key=e item=exam}
                                        <li class="mb-20 m-last-0">
                                            <a class="as-card card card-body" href="{$Rewrite->url_exam($exam)}">
                                                <div class="text-600 text-16 mb-2">{$exam.name} #{$exam.exam_id}</div>
                                                <div>
                                                    {if $exam.time_end}
                                                        <i class="fa fa-clock-o mr-1"></i>
                                                        <span>{$exam.time_end} {'minute'|lang}</span>
                                                    {/if}
                                                </div>
                                            </a>
                                        </li>
                                    {/foreach}
                                </ul>
                            {/if}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 mb-30">
                <article class="js-test collapse">
                    <ul class="list-unstyled mb-30">
                        <li class="mb-6">
                            {if $arrListQuestions}
                                <ul class="list-unstyled mb-0 js-exam" data-exam="{$arrOneExam.exam_id}">
                                    {assign var="i" value=0}
                                    {foreach from=$arrListQuestions key=q item=question}
                                        <li class="mb-6">
                                            <div class="question mb-2 js-question {if $question.attachment}js-sound{/if}" {if $question.attachment}url="{$URL_UPLOADS}/{$question.attachment}"{/if} data-id="{$question.questions_id}">
                                                <div class="question__header card card-body">
                                                    <div class="question__title media">
                                                        <div class="question__title-label">問題{$q+1}（{$question.point}点)： </div>
                                                        <div class="media-body">{$question.question|htmlDecode}</div>
                                                    </div>
                                                    <div class="question__translate mt-2 mb-0 collapse js-test-translation">{$question.translate|htmlDecode}</div>
                                                </div>
                                                <div class="question__body card card-body">
                                                    {if $question.child}
                                                        {foreach from=$question.child key=sc1 item=sub_question}
                                                            <div class="question__small-title media text-16 {if $sub_question.attachment}js-sound{/if}" {if $sub_question.attachment}url="{$URL_UPLOADS}/{$sub_question.attachment}"{/if}>
                                                                <div class="question__small-title-index {if $sub_question.child}mw-50px{/if}">{if $sub_question.child}問題{else}問{/if}{$sc+1}</div>
                                                                <div class="media-body">
                                                                    <div>{$sub_question.question|htmlDecode}</div>
                                                                    <div class="question__translate mt-2 mb-0 collapse js-test-translation text-16">{$sub_question.translate|htmlDecode}</div>
                                                                </div>
                                                            </div>
                                                            {if $sub_question.child}
                                                                <div class="pl-50 mt-20">
                                                                    {foreach from=$sub_question.child key=sc2 item=sub_question2}
                                                                        <div class="question__small-title media text-16 {if $sub_question2.attachment}js-sound{/if}" {if $sub_question2.attachment}url="{$URL_UPLOADS}/{$sub_question2.attachment}"{/if}>
                                                                            <div class="question__small-title-index">問{$sc2+1}</div>
                                                                            <div class="media-body">{$sub_question2.question|htmlDecode}</div>
                                                                        </div>
                                                                        <div class="question__translate mt-2 mb-0 collapse js-test-translation text-16">{$sub_question2.translate|htmlDecode}</div>
                                                                        <div class="row">
                                                                            {if $sub_question2.answer_a}
                                                                                <div class="col-12 mt-3">
                                                                                    <div class="d-flex">
                                                                                        <label class="radio-styled media d-flex">
                                                                                            <input class="question__input radio-styled__input js-test-input {if $sub_question2.correct_answer eq '1' || $sub_question2.correct_answer|upper eq 'A'}correct{/if}" type="radio" name="question-{$i}" disabled="disabled" data-point="{$sub_question2.point}" />
                                                                                            <span class="radio-styled__icon"></span>
                                                                                            <span>{$sub_question2.answer_a|htmlDecode}</span>
                                                                                            {if $sub_question2.correct_answer eq '1' || $sub_question2.correct_answer|upper eq 'A'}
                                                                                                <span class="question__result">
                                                                                                    <i class="fa fa-check-circle ml-1"></i>
                                                                                                </span>
                                                                                                <span class="collapse js-test-answer">
                                                                                                    <i class="fa fa-check-circle ml-1"></i>
                                                                                                </span>
                                                                                            {else}
                                                                                                <span class="question__result">
                                                                                                    <i class="fa fa-times-circle ml-1"></i>
                                                                                                </span>
                                                                                            {/if}
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                            {/if}
                                                                            {if $sub_question2.answer_b}
                                                                                <div class="col-12 mt-3">
                                                                                    <div class="d-flex">
                                                                                        <label class="radio-styled media d-flex">
                                                                                            <input class="question__input radio-styled__input js-test-input {if $sub_question2.correct_answer eq '2' || $sub_question2.correct_answer|upper eq 'B'}correct{/if}" type="radio" name="question-{$i}" disabled="disabled" data-point="{$sub_question2.point}" />
                                                                                            <span class="radio-styled__icon"></span>
                                                                                            <span>{$sub_question2.answer_b|htmlDecode}</span>
                                                                                            {if $sub_question2.correct_answer eq '2' || $sub_question2.correct_answer|upper eq 'B'}
                                                                                                <span class="question__result">
                                                                                                    <i class="fa fa-check-circle ml-1"></i>
                                                                                                </span>
                                                                                                <span class="collapse js-test-answer">
                                                                                                    <i class="fa fa-check-circle ml-1"></i>
                                                                                                </span>
                                                                                            {else}
                                                                                                <span class="question__result">
                                                                                                    <i class="fa fa-times-circle ml-1"></i>
                                                                                                </span>
                                                                                            {/if}
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                            {/if}
                                                                            {if $sub_question2.answer_c}
                                                                                <div class="col-12 mt-3">
                                                                                    <div class="d-flex">
                                                                                        <label class="radio-styled media d-flex">
                                                                                            <input class="question__input radio-styled__input js-test-input {if $sub_question2.correct_answer eq '3' || $sub_question2.correct_answer|upper eq 'C'}correct{/if}" type="radio" name="question-{$i}" disabled="disabled" data-point="{$sub_question2.point}" />
                                                                                            <span class="radio-styled__icon"></span>
                                                                                            <span>{$sub_question2.answer_c|htmlDecode}</span>
                                                                                            {if $sub_question2.correct_answer eq '3' || $sub_question2.correct_answer|upper eq 'C'}
                                                                                                <span class="question__result">
                                                                                                    <i class="fa fa-check-circle ml-1"></i>
                                                                                                </span>
                                                                                                <span class="collapse js-test-answer">
                                                                                                    <i class="fa fa-check-circle ml-1"></i>
                                                                                                </span>
                                                                                            {else}
                                                                                                <span class="question__result">
                                                                                                    <i class="fa fa-times-circle ml-1"></i>
                                                                                                </span>
                                                                                            {/if}
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                            {/if}
                                                                            {if $sub_question2.answer_d}
                                                                                <div class="col-12 mt-3">
                                                                                    <div class="d-flex">
                                                                                        <label class="radio-styled media d-flex">
                                                                                            <input class="question__input radio-styled__input js-test-input {if $sub_question2.correct_answer eq '4' || $sub_question2.correct_answer|upper eq 'D'}correct{/if}" type="radio" name="question-{$i}" disabled="disabled" data-point="{$sub_question2.point}" />
                                                                                            <span class="radio-styled__icon"></span>
                                                                                            <span>{$sub_question2.answer_d|htmlDecode}</span>
                                                                                            {if $sub_question2.correct_answer eq '4' || $sub_question2.correct_answer|upper eq 'D'}
                                                                                                <span class="question__result">
                                                                                                    <i class="fa fa-check-circle ml-1"></i>
                                                                                                </span>
                                                                                                <span class="collapse js-test-answer">
                                                                                                    <i class="fa fa-check-circle ml-1"></i>
                                                                                                </span>
                                                                                            {else}
                                                                                                <span class="question__result">
                                                                                                    <i class="fa fa-times-circle ml-1"></i>
                                                                                                </span>
                                                                                            {/if}
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                            {/if}
                                                                        </div>
                                                                        {$i = $i+1}
                                                                    {/foreach}
                                                                </div>
                                                            {else}
                                                                <div class="row">
                                                                    {if $sub_question.answer_a}
                                                                        <div class="col-12 mt-3">
                                                                            <div class="d-flex">
                                                                                <label class="radio-styled media d-flex">
                                                                                    <input class="question__input radio-styled__input js-test-input {if $sub_question.correct_answer eq '1' || $sub_question.correct_answer|upper eq 'A'}correct{/if}" type="radio" name="question-{$i}" disabled="disabled" data-point="{$sub_question.point}" />
                                                                                    <span class="radio-styled__icon"></span>
                                                                                    <span>{$sub_question.answer_a|htmlDecode}</span>
                                                                                    {if $sub_question.correct_answer eq '1' || $sub_question.correct_answer|upper eq 'A'}
                                                                                        <span class="question__result">
                                                                                        <i class="fa fa-check-circle ml-1"></i>
                                                                                    </span>
                                                                                        <span class="collapse js-test-answer">
                                                                                        <i class="fa fa-check-circle ml-1"></i>
                                                                                    </span>
                                                                                    {else}
                                                                                        <span class="question__result">
                                                                                        <i class="fa fa-times-circle ml-1"></i>
                                                                                    </span>
                                                                                    {/if}
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    {/if}
                                                                    {if $sub_question.answer_b}
                                                                        <div class="col-12 mt-3">
                                                                            <div class="d-flex">
                                                                                <label class="radio-styled media d-flex">
                                                                                    <input class="question__input radio-styled__input js-test-input {if $sub_question.correct_answer eq '2' || $sub_question.correct_answer|upper eq 'B'}correct{/if}" type="radio" name="question-{$i}" disabled="disabled" data-point="{$sub_question.point}" />
                                                                                    <span class="radio-styled__icon"></span>
                                                                                    <span>{$sub_question.answer_b|htmlDecode}</span>
                                                                                    {if $sub_question.correct_answer eq '2' || $sub_question.correct_answer|upper eq 'B'}
                                                                                        <span class="question__result">
                                                                                        <i class="fa fa-check-circle ml-1"></i>
                                                                                    </span>
                                                                                        <span class="collapse js-test-answer">
                                                                                        <i class="fa fa-check-circle ml-1"></i>
                                                                                    </span>
                                                                                    {else}
                                                                                        <span class="question__result">
                                                                                        <i class="fa fa-times-circle ml-1"></i>
                                                                                    </span>
                                                                                    {/if}
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    {/if}
                                                                    {if $sub_question.answer_c}
                                                                        <div class="col-12 mt-3">
                                                                            <div class="d-flex">
                                                                                <label class="radio-styled media d-flex">
                                                                                    <input class="question__input radio-styled__input js-test-input {if $sub_question.correct_answer eq '3' || $sub_question.correct_answer|upper eq 'C'}correct{/if}" type="radio" name="question-{$i}" disabled="disabled" data-point="{$sub_question.point}" />
                                                                                    <span class="radio-styled__icon"></span>
                                                                                    <span>{$sub_question.answer_c|htmlDecode}</span>
                                                                                    {if $sub_question.correct_answer eq '3' || $sub_question.correct_answer|upper eq 'C'}
                                                                                        <span class="question__result">
                                                                                        <i class="fa fa-check-circle ml-1"></i>
                                                                                    </span>
                                                                                        <span class="collapse js-test-answer">
                                                                                        <i class="fa fa-check-circle ml-1"></i>
                                                                                    </span>
                                                                                    {else}
                                                                                        <span class="question__result">
                                                                                        <i class="fa fa-times-circle ml-1"></i>
                                                                                    </span>
                                                                                    {/if}
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    {/if}
                                                                    {if $sub_question.answer_d}
                                                                        <div class="col-12 mt-3">
                                                                            <div class="d-flex">
                                                                                <label class="radio-styled media d-flex">
                                                                                    <input class="question__input radio-styled__input js-test-input {if $sub_question.correct_answer eq '4' || $sub_question.correct_answer|upper eq 'D'}correct{/if}" type="radio" name="question-{$i}" disabled="disabled" data-point="{$sub_question.point}" />
                                                                                    <span class="radio-styled__icon"></span>
                                                                                    <span>{$sub_question.answer_d|htmlDecode}</span>
                                                                                    {if $sub_question.correct_answer eq '4' || $sub_question.correct_answer|upper eq 'D'}
                                                                                        <span class="question__result">
                                                                                        <i class="fa fa-check-circle ml-1"></i>
                                                                                    </span>
                                                                                        <span class="collapse js-test-answer">
                                                                                        <i class="fa fa-check-circle ml-1"></i>
                                                                                    </span>
                                                                                    {else}
                                                                                        <span class="question__result">
                                                                                        <i class="fa fa-times-circle ml-1"></i>
                                                                                    </span>
                                                                                    {/if}
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    {/if}
                                                                </div>
                                                                {$i = $i+1}
                                                            {/if}
                                                        {/foreach}
                                                    {else}
                                                        <div class="row">
                                                            {if $question.answer_a}
                                                                <div class="col-12 mt-3">
                                                                    <div class="d-flex">
                                                                        <label class="radio-styled media d-flex">
                                                                            <input class="question__input radio-styled__input js-test-input {if $question.correct_answer eq '1' || $question.correct_answer|upper eq 'A'}correct{/if}" type="radio" name="question-{$i}" disabled="disabled" data-point="{$question.point}" />
                                                                            <span class="radio-styled__icon"></span>
                                                                            <span>{$question.answer_a|htmlDecode}</span>
                                                                            {if $question.correct_answer eq '1' || $question.correct_answer|upper eq 'A'}
                                                                                <span class="question__result">
                                                                                    <i class="fa fa-check-circle ml-1"></i>
                                                                                </span>
                                                                                <span class="collapse js-test-answer">
                                                                                    <i class="fa fa-check-circle ml-1"></i>
                                                                                </span>
                                                                            {else}
                                                                                <span class="question__result">
                                                                                    <i class="fa fa-times-circle ml-1"></i>
                                                                                </span>
                                                                            {/if}
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            {/if}
                                                            {if $question.answer_b}
                                                                <div class="col-12 mt-3">
                                                                    <div class="d-flex">
                                                                        <label class="radio-styled media d-flex">
                                                                            <input class="question__input radio-styled__input js-test-input {if $question.correct_answer eq '2' || $question.correct_answer|upper eq 'B'}correct{/if}" type="radio" name="question-{$i}" disabled="disabled" data-point="{$question.point}" />
                                                                            <span class="radio-styled__icon"></span>
                                                                            <span>{$question.answer_b|htmlDecode}</span>
                                                                            {if $question.correct_answer eq '2' || $question.correct_answer|upper eq 'B'}
                                                                                <span class="question__result">
                                                                                        <i class="fa fa-check-circle ml-1"></i>
                                                                                    </span>
                                                                                <span class="collapse js-test-answer">
                                                                                    <i class="fa fa-check-circle ml-1"></i>
                                                                                </span>
                                                                            {else}
                                                                                <span class="question__result">
                                                                                    <i class="fa fa-times-circle ml-1"></i>
                                                                                </span>
                                                                            {/if}
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            {/if}
                                                            {if $question.answer_c}
                                                                <div class="col-12 mt-3">
                                                                    <div class="d-flex">
                                                                        <label class="radio-styled media d-flex">
                                                                            <input class="question__input radio-styled__input js-test-input {if $question.correct_answer eq '3' || $question.correct_answer|upper eq 'C'}correct{/if}" type="radio" name="question-{$i}" disabled="disabled" data-point="{$question.point}" />
                                                                            <span class="radio-styled__icon"></span>
                                                                            <span>{$question.answer_c|htmlDecode}</span>
                                                                            {if $question.correct_answer eq '3' || $question.correct_answer|upper eq 'C'}
                                                                                <span class="question__result">
                                                                                    <i class="fa fa-check-circle ml-1"></i>
                                                                                </span>
                                                                                <span class="collapse js-test-answer">
                                                                                    <i class="fa fa-check-circle ml-1"></i>
                                                                                </span>
                                                                            {else}
                                                                                <span class="question__result">
                                                                                    <i class="fa fa-times-circle ml-1"></i>
                                                                                </span>
                                                                            {/if}
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            {/if}
                                                            {if $question.answer_d}
                                                                <div class="col-12 mt-3">
                                                                    <div class="d-flex">
                                                                        <label class="radio-styled media d-flex">
                                                                            <input class="question__input radio-styled__input js-test-input {if $question.correct_answer eq '4' || $question.correct_answer|upper eq 'D'}correct{/if}" type="radio" name="question-{$i}" disabled="disabled" data-point="{$question.point}" />
                                                                            <span class="radio-styled__icon"></span>
                                                                            <span>{$question.answer_d|htmlDecode}</span>
                                                                            {if $question.correct_answer eq '4' || $question.correct_answer|upper eq 'D'}
                                                                                <span class="question__result">
                                                                                    <i class="fa fa-check-circle ml-1"></i>
                                                                                </span>
                                                                                <span class="collapse js-test-answer">
                                                                                    <i class="fa fa-check-circle ml-1"></i>
                                                                                </span>
                                                                            {else}
                                                                                <span class="question__result">
                                                                                    <i class="fa fa-times-circle ml-1"></i>
                                                                                </span>
                                                                            {/if}
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            {/if}
                                                        </div>
                                                        {$i = $i+1}
                                                    {/if}
                                                </div>
                                            </div>
                                        </li>
                                    {/foreach}
                                </ul>
                            {/if}
                        </li>
                        <li class="mb-6">
                            <a class="btn btn-danger mr-2 js-finish-test" href="javascript:;">{'Result'|lang}</a>
                            <a class="btn btn-primary mr-2 js-reset-test" href="javascript:;">{'Rework'|lang}</a>
                            <a class="btn btn-success mr-2 js-show-answer" href="javascript:;">{'Answer'|lang}</a>
                            <a class="btn btn-info mr-2 js-show-translate" href="javascript:;">{'Translate'|lang}</a>
                        </li>
                    </ul>
                    <div>
                        <div class="fb-comments" data-href="{$Rewrite->url_exam($arrOneExam)}" data-width="100%" data-numposts="10"></div>
                    </div>
                </article>
            </div>
            <div class="col-lg-4 d-lg-none mb-30">
                <div class="aside">
                    {if $arrListOtherExams}
                        <div class="aside__block">
                            <h2 class="aside__title">{$core->getLang('Related_test')}</h2>
                            <ul class="list-unstyled mb-0">
                                {foreach from=$arrListOtherExams key=e item=exam}
                                    <li class="mb-20 m-last-0">
                                        <a class="as-card card card-body" href="{$Rewrite->url_exam($exam)}">
                                            <div class="text-600 text-16 mb-2">{$exam.name} #{$exam.exam_id}</div>
                                            <div>
                                                {if $exam.time_end}
                                                    <i class="fa fa-clock-o mr-1"></i>
                                                    <span>{$exam.time_end} {'minute'|lang}</span>
                                                {/if}
                                            </div>
                                        </a>
                                    </li>
                                {/foreach}
                            </ul>
                        </div>
                    {/if}
                </div>
            </div>
        </div>
    </div>
</section>
<div class="sticky-time">
    <div class="sticky-time__iwrap">
        <img src="{$URL_IMAGES}/sticky-img.png" alt="sticky"></div>
    <div class="sticky-time__timer js-test-timer">00:00:00</div>
</div>