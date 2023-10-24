<setion class="js-test-skill collapse" data-skill="{$examIdx+1}" data-basepoint="{$exam.pass_score}" {if $exam.time_end}data-timer="{$exam.time_end*60}" {/if} data-title="{$exam.name}">

  <h2 class="test__title">{$exam.name}</h2>

  <ul class="list-unstyled mb-0">
    {if $exam.bigQuestions}
      {foreach from=$exam.bigQuestions key=bigQuestionIdx item=bigQuestion}
        {include file="_blocks/_bigQuestion.tpl"}
      {/foreach}
    {/if}
  </ul>
</setion>
