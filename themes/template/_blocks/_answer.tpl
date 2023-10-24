<ul class="answers js-answer">
  {foreach from=$answers item=answer key=answerIdx}
    <li class="answers__item">
      <label class="radio-styled">
        <input class="radio-styled__input js-answer-input {if $answer.is_correct}{if $answer.ctype}{$answer.ctype}{else}{$questionType}{/if} correct{/if}" type="radio" name="q{$answer.name}" data-point="{$answer.point}" data-answer-id="{$answer.id}" onclick="setRadiohecked(this)" />
        <span class="radio-styled__icon"></span>
        <span>{$answer.text|htmlDecode}</span>
      </label>
    </li>
  {/foreach}
</ul>
