<div class="container py-30">
  <div class="row">
    <div class="col-lg-8 mb-30">

      {if $video}
        {if $video.requirement eq 1}
          <div class="js-login-required alert alert-danger mb-2">Bạn phải <a href=".md-login" class="text-700 text-danger" data-toggle="modal">đăng nhập</a> để xem được nội dung này</div>
        {elseif $video.requirement eq 2}
          <div class="js-purchase-required alert alert-danger mb-2">Bạn phải <a href="{VNCMS_URL}/course/checkout?cid={$curCat.cat_id}" class="text-700 text-danger">đăng ký khoá học</a> để xem được nội dung này</div>
        {/if}

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
          <a class="nav-link active" href="#detail-tab-1" data-toggle="tab">
            <img class="n-tabs__bg" src="{$URL_IMAGES}/n-tab-link-bg.png" alt="">
            <span>{$curCat.name}</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link js-show-combo" href="#detail-tab-2" data-toggle="tab">
            <img class="n-tabs__bg" src="{$URL_IMAGES}/n-tab-link-bg.png" alt="">
            <span>Đăng ký khoá học</span>
          </a>
        </li>
      </ul>
      <div class="n-tabs-content n-tabs-content--custom">
        <div class="tab-content">
          <div class="tab-pane fade show active" id="detail-tab-1">
            {$curCat.detail|htmlDecode}
          </div>
          <div class="tab-pane fade" id="detail-tab-2">
            {if $isLogin ne 1}
              <div class="alert alert-danger mb-0">
                <i class="fa fa-exclamation-circle mr-2"></i>
                Vui lòng <a class="js-login-required text-danger text-700" href=".md-login" data-toggle="modal">đăng nhập</a> để thực hiện chức năng này!
              </div>
            {elseif !$paymentStatus}
              {include file="_blocks/_payment-form.tpl"}
            {elseif $paymentStatus.status ne '2'}
              <div class="alert alert-warning mb-0">
                <i class="fa fa-exclamation-circle mr-2"></i>
                Bạn đã đăng ký combo khoá học này nhưng chưa thanh toán.
                <br>
                Vui lòng <a class="text-700 text-primary" href="#payment-banking" data-toggle="collapse">thanh toán qua ngân hàng</a> hoặc <a class="text-700 text-primary" href="#payment-cash" data-toggle="collapse">thanh toán trực tiếp tại Kosei</a> để để kích hoạt khoá học.
                <br>
                <strong>Note:</strong> Nếu bạn đã thanh toán nhưng chưa kích hoạt khoá học. Vui lòng liên hệ lại với chúng tôi để nhận được sự hỗ trợ.
              </div>

              <div class="js-payment-info pt-3 collapse" id="payment-banking">
                <div class="alert alert-info mb-0">
                  <div class="mb-12">
                    <strong class="text-danger">{'Transferring_content'|lang}:</strong><br>
                    <kbd class="ml-0">{$core->callfunc('utf8_nosign', $curCat.name)|replace:'tieng Nhat ':''}_{$core->_USER.user_name}_{$core->_USER.mobile}</kbd>
                  </div>
                  {if $bankAccounts}
                    {foreach from=$bankAccounts item=bank key=key name=name}
                      <div class="mb-12 m-last-0">
                        <div class="text-700">{$bank.name}</div>
                        <div>Chủ tài khoản: <strong>{$bank.account_holder}</strong></div>
                        <div>Số tài khoản: <strong>{$bank.account_number}</strong></div>
                      </div>
                    {/foreach}
                  {/if}
                </div>
              </div>

              <div class="js-payment-info pt-3 collapse" id="payment-cash">
                <div class="alert alert-info mb-0">
                  {if $locations}
                    {foreach from=$locations item=location key=key name=name}
                      <div class="mb-12 m-last-0"><strong>Cơ sở {$key + 1}:</strong> {$location.name}</div>
                    {/foreach}
                  {/if}
                </div>
              </div>
            {elseif $paymentStatus.status eq '2' and $paymentStatus.expired}
              <div class="alert alert-danger">
                <i class="fa fa-exclamation-circle mr-2"></i>
                Đăng ký của bạn đã hết hạn vào ngày <strong>{$paymentStatus.expired_time|date_format:"%d/%m/%Y"}</strong>.
                <br>
                Bạn có thể đăng ký lại để tiếp tục tham gia khoá học.
              </div>
              {include file="_blocks/_payment-form.tpl"}
            {elseif $paymentStatus.status eq '2'}
              <div class="alert alert-success mb-0">
                <i class="fa fa-check-square-o mr-2"></i>
                Bạn đã đăng ký khoá học này! Thời hạn đến ngày <strong>{$paymentStatus.expired_time|date_format:"%d/%m/%Y"}</strong>
              </div>
            {/if}
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-4 mb-30">
      {if $otherCombos}
        <section class="aside-2 mb-20">
          <h2 class="aside-2__title">Combo khác</h2>
          {foreach from=$otherCombos item=combo key=key name=name}
            <div class="combo media">
              <a class="combo__frame" href="{$Rewrite->url_category($combo)}"><img src="{$URL_UPLOADS}/{$combo.image}" alt="{$combo.name}" /></a>
              <div class="media-body">
                <h3 class="combo__name"><a href="{$Rewrite->url_category($combo)}">{$combo.name}</a></h3>
                <div class="combo__price">
                  <div>{$core->callfunc('number_format', $combo.price_vn)} vnđ</div>
                  <div>{$core->callfunc('number_format', $combo.price_jp)} ¥</div>
                </div>
                <div class="combo__time">Thời gian: {$combo.duration} tháng</div>
              </div>
            </div>
          {/foreach}
        </section>
      {/if}
    </div>
  </div>

  <div class="fb-comments" data-href="{$Rewrite->url_category($curCat)}" data-width="100%" data-numposts="5"></div>
</div>
