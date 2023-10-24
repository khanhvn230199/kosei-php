<div class="question-2__group">
  <div class="question-2__query" data-name="q{$question.questions_id}">
    <div class="media">
      <span class="mr-2">{if $question.smallQuestions}問題{else}問{/if}{$questionIdx+1}：</span>
      <div class="media-body">
          {$question.question|htmlDecode}
      </div>
    </div>
  </div>

  {if $question.attachment}
      {if $showAudioTag}
        <audio class="w-100 mb-3" src="{$URL_UPLOADS}/{$question.attachment}"></audio>
      {else}
        <div class="js-sound" data-url="{$URL_UPLOADS}/{$question.attachment}"></div>
      {/if}
  {/if}

  {if $question.smallQuestions}
    <div class="pl-30">
        {foreach from=$question.smallQuestions key=smallQuestionIdx item=smallQuestion}
            {include file="_blocks/_smallQuestion.tpl"}
        {/foreach}
    </div>
  {else}
      {include file="_blocks/_answer.tpl" answers=$question.answers}
  {/if}
</div>
