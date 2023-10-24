<div class="container py-30">
  <div class="row">
    <div class="col-lg-8 mb-30">

      {if $questions}
        <article class="js-test">
          <h2 class="vocab-page-title">Bài test đầu vào</h2>
          {include file="_blocks/_exercise.tpl"}
        </article>
      {/if}

    </div>

    <div class="col-lg-4 mb-30">
      {include file="_blocks/_lesson-search.tpl"}

      <section class="aside-2 mb-20">
        <h2 class="aside-2__title">Hướng dẫn trước khi học</h2>
        <div class="aside-2__body py-3">
          {$curCat.instructions|htmlDecode}
        </div>
      </section>

      {include file="_blocks/_lesson-cats.tpl"}
    </div>
  </div>

  <div class="fb-comments" data-href="{$Rewrite->url_category($curCat)}?test=1" data-width="100%" data-numposts="5"></div>
</div>
