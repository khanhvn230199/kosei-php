<li class="mb-6">
  <section class="question-2">

    <div class="question-2__header">
      <div class="media">
        <span class="mr-2">問題{$bigQuestionIdx+1}（{$bigQuestion.point}点)：</span>
        <div class="media-body">
          {$bigQuestion.question|htmlDecode}
        </div>
      </div>
    </div>

    <div class="question-2__body">

      {if $bigQuestion.attachment}
        {if $showAudioTag}
          <audio class="w-100 mb-3" src="{$URL_UPLOADS}/{$bigQuestion.attachment}"></audio>
        {else}
          <div class="js-sound" data-url="{$URL_UPLOADS}/{$bigQuestion.attachment}"></div>
        {/if}
      {/if}

      {if $bigQuestion.questions}

        {foreach from=$bigQuestion.questions key=questionIdx item=question}
          {include file="_blocks/_question.tpl"}
        {/foreach}

      {else}

        <div class="question-2__group">
          {include file="_blocks/_answer.tpl" answers=$bigQuestion.answers}
        </div>

      {/if}
    </div>
  </section>
</li>
