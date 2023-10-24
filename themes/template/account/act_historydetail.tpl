<div class="container">
  <div class="border-top"></div>
</div>
<nav>
  <div class="container">
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a class="link-unstyled" href="{$VNCMS_URL}">{'Home'|lang}</a>
      </li>
      <li class="breadcrumb-item active">{'Learning_information'|lang}</li>
    </ol>
  </div>
</nav>

<section class="section mb-50">
  <div class="container">
    <div class="row">
      <div class="col-lg-3">
        <div class="profile-panel card">
          <h2 class="card-header">{'Profile'|lang}</h2>
          <div class="list-group list-group-flush">
            <a class="list-group-item list-group-item-active" href="{$Rewrite->url_history()}">
              <img src="{$URL_IMAGES}/icon-file-list.png" alt="{'Learning_information'|lang}">
              <span>{'Learning_information'|lang}</span>
            </a>
            <a class="list-group-item list-group-item-active" href="{$Rewrite->url_account()}">
              <img src="{$URL_IMAGES}/icon-user-blue.png" alt="{'Profile'|lang}">
              <span>{'Profile'|lang}</span>
            </a>
            <a class="list-group-item list-group-item-active" href="{$Rewrite->url_logout()}">
              <img src="{$URL_IMAGES}/icon-power-off-blue.png" alt="{'Logout'|lang}">
              <span>{'Logout'|lang}</span>
            </a>
          </div>
        </div>
      </div>
      <div class="col-lg-9">
        <article class="test js-test" data-name="{$arrOneUser['fullname']}" data-course="{$arrOneTest.code}" data-test="{$arrOneTest.tt_id}" data-test-id="{$arrOneTest.test_id}" data-totalpoint="{$arrOneTest.pass_score}" , data-answers="{$candidate.answers}">
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
          {/if}
        </article>
      </div>
    </div>
  </div>
</section>
