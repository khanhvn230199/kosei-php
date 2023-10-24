<div class="question-2__group">

  <div class="question-2__query" data-name="q{$smallQuestion.questions_id}">
    <div class="media">
      <span class="mr-2">問{$smallQuestionIdx+1}：</span>
      <div class="media-body">
          {$smallQuestion.question|htmlDecode}
      </div>
    </div>
  </div>

    {if $smallQuestion.attachment}
        {if $showAudioTag}
          <audio class="w-100 mb-3" src="{$URL_UPLOADS}/{$smallQuestion.attachment}"></audio>
        {else}
          <div class="js-sound" data-url="{$URL_UPLOADS}/{$smallQuestion.attachment}"></div>
        {/if}
    {/if}

    {include file="_blocks/_answer.tpl" answers=$smallQuestion.answers}
</div>
