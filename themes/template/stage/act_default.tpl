<div class="container py-30">
  <div class="row">
    <div class="col-lg-8 mb-30">

      {if $video}
        {if $video.attachment}
          {assign var="file_type" value=$video.attachment|pathinfo:$smarty.const.PATHINFO_EXTENSION}

          {if $file_type eq "mp4"}
            <div class="embed-responsive embed-responsive-16by9">
              <video class="video-js embed-responsive-item" controls preload="auto" width="640" height="264" poster="{if $video.image}{$URL_UPLOADS}/{$video.image}{else}{$URL_UPLOADS}/{$curCat.image}{/if}" data-setup="{}">
                <source src="{$URL_UPLOADS}/{$video.attachment|escape:'url'}" type="video/mp4">
                <p class="vjs-no-js">To view this video please enable JavaScript, and consider upgrading to a web browser that
                  <a href="https://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>
                </p>
              </video>
            </div>
          {elseif $file_type eq "mp3"}
            <audio preload="auto" controls class="js-audio">
              <source src="{$URL_UPLOADS}/{$lesson.attachment|escape:'url'}">
            </audio>
          {/if}
        {elseif $video.arrStream}
          <div class="embed-responsive embed-responsive-16by9">
            <video class="video-js embed-responsive-item" controls preload="auto" width="100%" height="100%" poster="{if $lesson.image}{$URL_UPLOADS}/{$lesson.image}{else}{$URL_UPLOADS}/{$curCat.image}{/if}" data-setup="{}">
              {foreach from=$lesson.arrStream key=s item=stream}
                <source src="{$stream.url}" type="{$stream.mime}" data-quality="{$stream.qualityLabel}">
              {/foreach}
              <p class="vjs-no-js">To view this video please enable JavaScript, and consider upgrading to a web
                browser that
                <a href="https://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>
              </p>
            </video>
          </div>
        {else}
          <img class="d-block w-100" src="{if $video.image}{$URL_UPLOADS}/{$video.image}{else}{$URL_UPLOADS}/{$curCat.image}{/if}" alt="{$video.name}" onerror="this.src='{$URL_IMAGES}/nopic.png'" class="w-100">
        {/if}
      {/if}

      <div class="mt-10"></div>

      <ul class="nav n-tabs mt-20">
        <li class="nav-item">
          <a class="nav-link active" href="#!">
            <img class="n-tabs__bg" src="{$URL_IMAGES}/n-tab-link-bg.png" alt="">
            <span>{$curCat.name}</span>
          </a>
        </li>

        {if !$paymentStatus}
          <li class="nav-item">
            <a class="nav-link" href="{VNCMS_URL}/course/checkout?cid={$curCat.cat_id}">
              <img class="n-tabs__bg" src="{$URL_IMAGES}/n-tab-link-bg.png" alt="">
              <span>Đăng ký khoá học</span>
            </a>
          </li>
        {/if}
      </ul>

      <div class="n-tabs-content n-tabs-content--custom">
        <div class="tab-content">
          <div class="tab-pane fade show active" id="detail-tab-1">
            {$curCat.des|htmlDecode}
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-4 mb-30">
      {include file="_blocks/_lesson-search.tpl"}

      <section class="aside-2 mb-20">
        <h2 class="aside-2__title">Hướng dẫn trước khi học</h2>
        <div class="aside-2__body py-3">
          {$curCat.instructions|htmlDecode}
        </div>
      </section>

      <section class="aside-2 mb-20">
        <h2 class="aside-2__title">Test đầu vào</h2>
        <div class="aside-2__body py-3 text-center">
          <a class="button" href="{$Rewrite->url_category($curCat)}?test=1">TEST ĐẦU VÀO</a>
        </div>
      </section>

      {include file="_blocks/_lesson-cats.tpl"}
    </div>
  </div>

  <div class="fb-comments" data-href="{$Rewrite->url_category($curCat)}" data-width="100%" data-numposts="5"></div>
</div>
