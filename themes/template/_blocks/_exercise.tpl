<ul class="list-unstyled mb-30">
  <li class="mb-6" id="ex_question_list">
    <ul class="list-unstyled mb-0">
      {if $bigQuestions}
          {foreach from=$bigQuestions key=bigQuestionIdx item=bigQuestion}
              {include file="_blocks/_bigQuestion.tpl"}
          {/foreach}
      {/if}
{*      {assign var="i" value=0}*}
{*      {foreach from=$questions key=q item=question}*}
{*        <li class="mb-6">*}
{*          <div class="question mb-2 js-question" data-id="{$question.questions_id}">*}
{*            <div class="question__header card card-body">*}
{*              <div class="question__title media">*}
{*                <div class="question__title-label w-auto">問題{$q+1}<span class="px-2"></span>（{$question.point}点)：*}
{*                </div>*}
{*                <div class="media-body">{$question.question|htmlDecode}</div>*}
{*              </div>*}
{*              <div class="question__translate mt-2 mb-0 collapse js-test-translation">{$question.translate|htmlDecode}</div>*}
{*            </div>*}
{*            {if $question.attachment}*}
{*              <audio class="w-100" controls="controls" src="{$URL_UPLOADS}/{$question.attachment}">*}
{*                Your browser does not support the <code>audio</code> element.*}
{*              </audio>*}
{*            {/if}*}
{*            <div class="question__body card card-body">*}
{*              {if $question.children}*}
{*                {foreach from=$question.children key=sc item=sub_question}*}
{*                  <div class="question__small-title media text-20">*}
{*                    <div class="question__small-title-index w-auto {if $sub_question.child}mw-50px{/if}">{if $sub_question.child}問題{else}問{/if}{$sc+1}*}
{*                      <span class="px-2"></span>*}
{*                    </div>*}
{*                    <div class="media-body">*}
{*                      <div>{$sub_question.question|htmlDecode}</div>*}
{*                      <div class="question__translate mt-2 mb-0 collapse js-test-translation text-20">{$sub_question.translate|htmlDecode}</div>*}
{*                    </div>*}
{*                  </div>*}
{*                  {if $sub_question.children}*}
{*                    <div class="pl-50 mt-20">*}
{*                      {foreach from=$sub_question.children key=sc2 item=sub_question2}*}
{*                        <div class="question__small-title media text-20 {if $sub_question2.attachment}js-sound{/if}" {if $sub_question2.attachment}url="{$URL_UPLOADS}/{$sub_question2.attachment}" {/if}>*}
{*                          <div class="question__small-title-index w-auto">問{$sc2+1}<span class="px-2"></span></div>*}
{*                          <div class="media-body">{$sub_question2.question|htmlDecode}</div>*}
{*                        </div>*}
{*                        <div class="question__translate mt-2 mb-0 collapse js-test-translation text-20">{$sub_question2.translate|htmlDecode}</div>*}
{*                        <div class="row">*}
{*                          {if $sub_question2.answer_a}*}
{*                            <div class="col-12 mt-3">*}
{*                              <div class="d-flex" style="font-size: 18px; line-height: 21px;">*}
{*                                <label class="radio-styled media d-flex">*}
{*                                  <input class="question__input radio-styled__input js-test-input {if $sub_question2.correct_answer eq '1' || $sub_question2.correct_answer|upper eq 'A'}correct{/if}" type="radio" name="question-{$i}" disabled="disabled" data-point="{$sub_question2.point}" />*}
{*                                  <span class="radio-styled__icon"></span>*}
{*                                  <span>{$sub_question2.answer_a|htmlDecode}</span>*}
{*                                  {if $sub_question2.correct_answer eq '1' || $sub_question2.correct_answer|upper eq 'A'}*}
{*                                    <span class="question__result">*}
{*                                      <i class="fa fa-check-circle ml-1"></i>*}
{*                                    </span>*}
{*                                    <span class="collapse js-test-answer">*}
{*                                      <i class="fa fa-check-circle ml-1"></i>*}
{*                                    </span>*}
{*                                  {else}*}
{*                                    <span class="question__result">*}
{*                                      <i class="fa fa-times-circle ml-1"></i>*}
{*                                    </span>*}
{*                                  {/if}*}
{*                                </label>*}
{*                              </div>*}
{*                            </div>*}
{*                          {/if}*}
{*                          {if $sub_question2.answer_b}*}
{*                            <div class="col-12 mt-3">*}
{*                              <div class="d-flex" style="font-size: 18px; line-height: 21px;">*}
{*                                <label class="radio-styled media d-flex">*}
{*                                  <input class="question__input radio-styled__input js-test-input {if $sub_question2.correct_answer eq '2' || $sub_question2.correct_answer|upper eq 'B'}correct{/if}" type="radio" name="question-{$i}" disabled="disabled" data-point="{$sub_question2.point}" />*}
{*                                  <span class="radio-styled__icon"></span>*}
{*                                  <span>{$sub_question2.answer_b|htmlDecode}</span>*}
{*                                  {if $sub_question2.correct_answer eq '2' || $sub_question2.correct_answer|upper eq 'B'}*}
{*                                    <span class="question__result">*}
{*                                      <i class="fa fa-check-circle ml-1"></i>*}
{*                                    </span>*}
{*                                    <span class="collapse js-test-answer">*}
{*                                      <i class="fa fa-check-circle ml-1"></i>*}
{*                                    </span>*}
{*                                  {else}*}
{*                                    <span class="question__result">*}
{*                                      <i class="fa fa-times-circle ml-1"></i>*}
{*                                    </span>*}
{*                                  {/if}*}
{*                                </label>*}
{*                              </div>*}
{*                            </div>*}
{*                          {/if}*}
{*                          {if $sub_question2.answer_c}*}
{*                            <div class="col-12 mt-3">*}
{*                              <div class="d-flex" style="font-size: 18px; line-height: 21px;">*}
{*                                <label class="radio-styled media d-flex">*}
{*                                  <input class="question__input radio-styled__input js-test-input {if $sub_question2.correct_answer eq '3' || $sub_question2.correct_answer|upper eq 'C'}correct{/if}" type="radio" name="question-{$i}" disabled="disabled" data-point="{$sub_question2.point}" />*}
{*                                  <span class="radio-styled__icon"></span>*}
{*                                  <span>{$sub_question2.answer_c|htmlDecode}</span>*}
{*                                  {if $sub_question2.correct_answer eq '3' || $sub_question2.correct_answer|upper eq 'C'}*}
{*                                    <span class="question__result">*}
{*                                      <i class="fa fa-check-circle ml-1"></i>*}
{*                                    </span>*}
{*                                    <span class="collapse js-test-answer">*}
{*                                      <i class="fa fa-check-circle ml-1"></i>*}
{*                                    </span>*}
{*                                  {else}*}
{*                                    <span class="question__result">*}
{*                                      <i class="fa fa-times-circle ml-1"></i>*}
{*                                    </span>*}
{*                                  {/if}*}
{*                                </label>*}
{*                              </div>*}
{*                            </div>*}
{*                          {/if}*}
{*                          {if $sub_question2.answer_d}*}
{*                            <div class="col-12 mt-3">*}
{*                              <div class="d-flex" style="font-size: 18px; line-height: 21px;">*}
{*                                <label class="radio-styled media d-flex">*}
{*                                  <input class="question__input radio-styled__input js-test-input {if $sub_question2.correct_answer eq '4' || $sub_question2.correct_answer|upper eq 'D'}correct{/if}" type="radio" name="question-{$i}" disabled="disabled" data-point="{$sub_question2.point}" />*}
{*                                  <span class="radio-styled__icon"></span>*}
{*                                  <span>{$sub_question2.answer_d|htmlDecode}</span>*}
{*                                  {if $sub_question2.correct_answer eq '4' || $sub_question2.correct_answer|upper eq 'D'}*}
{*                                    <span class="question__result">*}
{*                                      <i class="fa fa-check-circle ml-1"></i>*}
{*                                    </span>*}
{*                                    <span class="collapse js-test-answer">*}
{*                                      <i class="fa fa-check-circle ml-1"></i>*}
{*                                    </span>*}
{*                                  {else}*}
{*                                    <span class="question__result">*}
{*                                      <i class="fa fa-times-circle ml-1"></i>*}
{*                                    </span>*}
{*                                  {/if}*}
{*                                </label>*}
{*                              </div>*}
{*                            </div>*}
{*                          {/if}*}
{*                        </div>*}
{*                        {$i = $i+1}*}
{*                      {/foreach}*}
{*                    </div>*}
{*                  {else}*}
{*                    <div class="row">*}
{*                      {if $sub_question.answer_a}*}
{*                        <div class="col-12 mt-3">*}
{*                          <div class="d-flex" style="font-size: 18px; line-height: 21px;">*}
{*                            <label class="radio-styled media d-flex">*}
{*                              <input class="question__input radio-styled__input js-test-input {if $sub_question.correct_answer eq '1' || $sub_question.correct_answer|upper eq 'A'}correct{/if}" type="radio" name="question-{$i}" disabled="disabled" data-point="{$sub_question.point}" />*}
{*                              <span class="radio-styled__icon"></span>*}
{*                              <div class="media-body">{$sub_question.answer_a|htmlDecode}</div>*}
{*                              {if $sub_question.correct_answer eq '1' || $sub_question.correct_answer|upper eq 'A'}*}
{*                                <span class="question__result">*}
{*                                  <i class="fa fa-check-circle ml-1"></i>*}
{*                                </span>*}
{*                                <span class="collapse js-test-answer">*}
{*                                  <i class="fa fa-check-circle ml-1"></i>*}
{*                                </span>*}
{*                              {else}*}
{*                                <span class="question__result">*}
{*                                  <i class="fa fa-times-circle ml-1"></i>*}
{*                                </span>*}
{*                              {/if}*}
{*                            </label>*}
{*                          </div>*}
{*                        </div>*}
{*                      {/if}*}
{*                      {if $sub_question.answer_b}*}
{*                        <div class="col-12 mt-3">*}
{*                          <div class="d-flex" style="font-size: 18px; line-height: 21px;">*}
{*                            <label class="radio-styled media d-flex">*}
{*                              <input class="question__input radio-styled__input js-test-input {if $sub_question.correct_answer eq '2' || $sub_question.correct_answer|upper eq 'B'}correct{/if}" type="radio" name="question-{$i}" disabled="disabled" data-point="{$sub_question.point}" />*}
{*                              <span class="radio-styled__icon"></span>*}
{*                              <span>{$sub_question.answer_b|htmlDecode}</span>*}
{*                              {if $sub_question.correct_answer eq '2' || $sub_question.correct_answer|upper eq 'B'}*}
{*                                <span class="question__result">*}
{*                                  <i class="fa fa-check-circle ml-1"></i>*}
{*                                </span>*}
{*                                <span class="collapse js-test-answer">*}
{*                                  <i class="fa fa-check-circle ml-1"></i>*}
{*                                </span>*}
{*                              {else}*}
{*                                <span class="question__result">*}
{*                                  <i class="fa fa-times-circle ml-1"></i>*}
{*                                </span>*}
{*                              {/if}*}
{*                            </label>*}
{*                          </div>*}
{*                        </div>*}
{*                      {/if}*}
{*                      {if $sub_question.answer_c}*}
{*                        <div class="col-12 mt-3">*}
{*                          <div class="d-flex" style="font-size: 18px; line-height: 21px;">*}
{*                            <label class="radio-styled media d-flex">*}
{*                              <input class="question__input radio-styled__input js-test-input {if $sub_question.correct_answer eq '3' || $sub_question.correct_answer|upper eq 'C'}correct{/if}" type="radio" name="question-{$i}" disabled="disabled" data-point="{$sub_question.point}" />*}
{*                              <span class="radio-styled__icon"></span>*}
{*                              <span>{$sub_question.answer_c|htmlDecode}</span>*}
{*                              {if $sub_question.correct_answer eq '3' || $sub_question.correct_answer|upper eq 'C'}*}
{*                                <span class="question__result">*}
{*                                  <i class="fa fa-check-circle ml-1"></i>*}
{*                                </span>*}
{*                                <span class="collapse js-test-answer">*}
{*                                  <i class="fa fa-check-circle ml-1"></i>*}
{*                                </span>*}
{*                              {else}*}
{*                                <span class="question__result">*}
{*                                  <i class="fa fa-times-circle ml-1"></i>*}
{*                                </span>*}
{*                              {/if}*}
{*                            </label>*}
{*                          </div>*}
{*                        </div>*}
{*                      {/if}*}
{*                      {if $sub_question.answer_d}*}
{*                        <div class="col-12 mt-3">*}
{*                          <div class="d-flex" style="font-size: 18px; line-height: 21px;">*}
{*                            <label class="radio-styled media d-flex">*}
{*                              <input class="question__input radio-styled__input js-test-input {if $sub_question.correct_answer eq '4' || $sub_question.correct_answer|upper eq 'D'}correct{/if}" type="radio" name="question-{$i}" disabled="disabled" data-point="{$sub_question.point}" />*}
{*                              <span class="radio-styled__icon"></span>*}
{*                              <span>{$sub_question.answer_d|htmlDecode}</span>*}
{*                              {if $sub_question.correct_answer eq '4' || $sub_question.correct_answer|upper eq 'D'}*}
{*                                <span class="question__result">*}
{*                                  <i class="fa fa-check-circle ml-1"></i>*}
{*                                </span>*}
{*                                <span class="collapse js-test-answer">*}
{*                                  <i class="fa fa-check-circle ml-1"></i>*}
{*                                </span>*}
{*                              {else}*}
{*                                <span class="question__result">*}
{*                                  <i class="fa fa-times-circle ml-1"></i>*}
{*                                </span>*}
{*                              {/if}*}
{*                            </label>*}
{*                          </div>*}
{*                        </div>*}
{*                      {/if}*}
{*                    </div>*}
{*                    {$i = $i+1}*}
{*                  {/if}*}
{*                {/foreach}*}
{*              {else}*}
{*                <div class="row">*}
{*                  {if $question.answer_a}*}
{*                    <div class="col-12 mt-3">*}
{*                      <div class="d-flex" style="font-size: 18px; line-height: 21px;">*}
{*                        <label class="radio-styled media d-flex">*}
{*                          <input class="question__input radio-styled__input js-test-input {if $question.correct_answer eq '1' || $question.correct_answer|upper eq 'A'}correct{/if}" type="radio" name="question-{$i}" disabled="disabled" data-point="{$question.point}" />*}
{*                          <span class="radio-styled__icon"></span>*}
{*                          <span>{$question.answer_a|htmlDecode}</span>*}
{*                          {if $question.correct_answer eq '1' || $question.correct_answer|upper eq 'A'}*}
{*                            <span class="question__result">*}
{*                              <i class="fa fa-check-circle ml-1"></i>*}
{*                            </span>*}
{*                            <span class="collapse js-test-answer">*}
{*                              <i class="fa fa-check-circle ml-1"></i>*}
{*                            </span>*}
{*                          {else}*}
{*                            <span class="question__result">*}
{*                              <i class="fa fa-times-circle ml-1"></i>*}
{*                            </span>*}
{*                          {/if}*}
{*                        </label>*}
{*                      </div>*}
{*                    </div>*}
{*                  {/if}*}
{*                  {if $question.answer_b}*}
{*                    <div class="col-12 mt-3">*}
{*                      <div class="d-flex" style="font-size: 18px; line-height: 21px;">*}
{*                        <label class="radio-styled media d-flex">*}
{*                          <input class="question__input radio-styled__input js-test-input {if $question.correct_answer eq '2' || $question.correct_answer|upper eq 'B'}correct{/if}" type="radio" name="question-{$i}" disabled="disabled" data-point="{$question.point}" />*}
{*                          <span class="radio-styled__icon"></span>*}
{*                          <span>{$question.answer_b|htmlDecode}</span>*}
{*                          {if $question.correct_answer eq '2' || $question.correct_answer|upper eq 'B'}*}
{*                            <span class="question__result">*}
{*                              <i class="fa fa-check-circle ml-1"></i>*}
{*                            </span>*}
{*                            <span class="collapse js-test-answer">*}
{*                              <i class="fa fa-check-circle ml-1"></i>*}
{*                            </span>*}
{*                          {else}*}
{*                            <span class="question__result">*}
{*                              <i class="fa fa-times-circle ml-1"></i>*}
{*                            </span>*}
{*                          {/if}*}
{*                        </label>*}
{*                      </div>*}
{*                    </div>*}
{*                  {/if}*}
{*                  {if $question.answer_c}*}
{*                    <div class="col-12 mt-3">*}
{*                      <div class="d-flex" style="font-size: 18px; line-height: 21px;">*}
{*                        <label class="radio-styled media d-flex">*}
{*                          <input class="question__input radio-styled__input js-test-input {if $question.correct_answer eq '3' || $question.correct_answer|upper eq 'C'}correct{/if}" type="radio" name="question-{$i}" disabled="disabled" data-point="{$question.point}" />*}
{*                          <span class="radio-styled__icon"></span>*}
{*                          <span>{$question.answer_c|htmlDecode}</span>*}
{*                          {if $question.correct_answer eq '3' || $question.correct_answer|upper eq 'C'}*}
{*                            <span class="question__result">*}
{*                              <i class="fa fa-check-circle ml-1"></i>*}
{*                            </span>*}
{*                            <span class="collapse js-test-answer">*}
{*                              <i class="fa fa-check-circle ml-1"></i>*}
{*                            </span>*}
{*                          {else}*}
{*                            <span class="question__result">*}
{*                              <i class="fa fa-times-circle ml-1"></i>*}
{*                            </span>*}
{*                          {/if}*}
{*                        </label>*}
{*                      </div>*}
{*                    </div>*}
{*                  {/if}*}
{*                  {if $question.answer_d}*}
{*                    <div class="col-12 mt-3">*}
{*                      <div class="d-flex" style="font-size: 18px; line-height: 21px;">*}
{*                        <label class="radio-styled media d-flex">*}
{*                          <input class="question__input radio-styled__input js-test-input {if $question.correct_answer eq '4' || $question.correct_answer|upper eq 'D'}correct{/if}" type="radio" name="question-{$i}" disabled="disabled" data-point="{$question.point}" />*}
{*                          <span class="radio-styled__icon"></span>*}
{*                          <span>{$question.answer_d|htmlDecode}</span>*}
{*                          {if $question.correct_answer eq '4' || $question.correct_answer|upper eq 'D'}*}
{*                            <span class="question__result">*}
{*                              <i class="fa fa-check-circle ml-1"></i>*}
{*                            </span>*}
{*                            <span class="collapse js-test-answer">*}
{*                              <i class="fa fa-check-circle ml-1"></i>*}
{*                            </span>*}
{*                          {else}*}
{*                            <span class="question__result">*}
{*                              <i class="fa fa-times-circle ml-1"></i>*}
{*                            </span>*}
{*                          {/if}*}
{*                        </label>*}
{*                      </div>*}
{*                    </div>*}
{*                  {/if}*}
{*                </div>*}
{*                {$i = $i+1}*}
{*              {/if}*}
{*            </div>*}
{*          </div>*}
{*        </li>*}
{*      {/foreach}*}
    </ul>
  </li>

  <li class="mb-6">
    <!-- nộp bài -->
    <a class="btn btn-danger mr-2 js-finish-test" href="javascript:;">{'Result'|lang}</a>
    <!-- Làm lại -->
    <a class="btn btn-primary mr-2 js-reset-test" href="javascript:;">{'Rework'|lang}</a>

    {* <a class="btn btn-success mr-2 js-show-answer" href="javascript:;">{'Answer'|lang}</a>*}
    {* <a class="btn btn-info mr-2 js-show-translate" href="javascript:;">{'Translate'|lang}</a>*}
  </li>
</ul>
