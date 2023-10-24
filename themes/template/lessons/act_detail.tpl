<div class="container py-30">
    <div class="row">
        <div class="col-lg-8 mb-30">
            <h1 class="title-video" style="font-size: 20px;font-weight: bold;color: red">Video - {$lesson.name}</h1>
            <button class="float-sidebar-btn js-float-sidebar-open text-700" data-target="#float-sidebar-1"><i class="fa fa-bars mr-2"></i>Bài học</button>
            <!-- Login để xem được bài học thử -->
            {if $isLogin eq 1}
            {if $video}
            {if $video.requirement eq 1 }
            <div class="js-login-required alert alert-danger mb-2">Bạn phải <a href=".md-login" class="text-700 text-danger" data-toggle="modal">đăng nhập</a> để xem được nội dung này</div>
            {elseif $video.requirement eq 2}
            <div class="js-purchase-required alert alert-danger mb-2">Bạn phải <a href=".md-purchase-require" class="text-700 text-danger" data-toggle="modal">đăng ký khoá học</a> để xem được nội dung này</div>
            {/if}
            {if $video.attachment}
            {assign var="file_type" value=$video.attachment|pathinfo:$smarty.const.PATHINFO_EXTENSION}
            {if $file_type eq "mp4"}
            <div class="embed-responsive embed-responsive-16by9" data-label="attachment">
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
            <div class="embed-responsive embed-responsive-16by9" data-label="arrStream">
                <video class="video-js embed-responsive-item" controls preload="auto" width="100%" height="100%" poster="{if $lesson.image}{$URL_UPLOADS}/{$lesson.image}{else}{$URL_UPLOADS}/{$curCat.image}{/if}" data-setup="{}" id="lessionVideoPlayer">
                    {foreach from=$video.arrStream key=s item=stream}
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
            {if $otherLessons}
            <div class="video-slider">
                <div class="video-slider__prev"><i class="fa fa-angle-left"></i></div>
                <div class="video-slider__next"><i class="fa fa-angle-right"></i></div>
                <div class="video-slider__container swiper-container">
                    <div class="swiper-wrapper">
                        {foreach from = $otherLessons key=i item=item}
                        <div class="swiper-slide">
                            <a class="video-slider__frame {if $item.lesson_id eq $lesson.lesson_id}video-slider__frame--active{/if}" href="{$Rewrite->url_lesson($item)}" data-key="{$i}">
                                <img src="{if $item.image}{$URL_UPLOADS}/{$item.image}{else}{$URL_UPLOADS}/{$curCat.image}{/if}" alt="{$item.name}" />
                            </a>
                        </div>
                        {/foreach}
                    </div>
                </div>
            </div>
            <!-- Lam bai tap -->
            {if $lesson.is_trial eq 0}
            {if $paymentStatus.status == 2}
            {if $paymentStatus.status == 2 and $paymentStatus.expired}
            <button class="btn btn-danger btn-lg mt-20" type="button">
                <a href=".md-purchase-require" class="text-700" data-toggle="modal" style="color: #fff">{'Finish'|lang}</a>
            </button>
            {else}
            <button class="btn btn-danger btn-lg js-start-test mt-20" type="button">{'Finish'|lang}</button>
            {/if}
            {/if}
            {else}
            <!-- Trường hợp có bài tập hoặc thử hoặc không học thử -->
            <button class="btn btn-danger btn-lg js-start-test mt-20" type="button">{'Finish'|lang}</button>
            {if $scores}
            <button class="btn btn-success btn-lg mt-20 js-show-resultexercise" type="button">Bạn đã làm bài này Điểm số: {$scores}/{$total_question} ({$scores} câu/ {$total_question} câu)</button>{/if}
            {/if}
            <article class="collapse js-test mt-20" id="article_testing">
                <h2 class="vocab-page-title">{'Exercise'|lang}</h2>
                {include file="_blocks/_exercise.tpl"}
            </article>
            <!-- Kết quả đã làm -->
            <article class="collapse js-resul-test mt-20" id="article_result" style="display:none">
                <h2 class="vocab-page-title">{'Exercise'|lang}</h2>
                {include file="_blocks/_resultexercise.tpl"}
            </article>
            <!-- End -->
          
            <!-- End -->
            <div class="aside-2__body py-3 text-center" style="border:none;">
                <a class="button" href="{$social.facebook}">Nhận tư vấn ngay</a>
            </div>
            <div class="mt-10"></div>
            <ul class="nav n-tabs mt-20" data-payment-status="{$paymentStatus.status}" data-expired="{$paymentStatus.expired}">
                <li class="nav-item">
                    <a class="nav-link js-course-intro-tab" href="#detail-tab-3" data-toggle="tab">
                        <img class="n-tabs__bg" src="{$URL_IMAGES}/n-tab-link-bg.png" alt="">
                        <span>Bài giảng học thử</span>
                    </a>
                </li>
                {if $isLogin ne 1}
                {else}
                <li class="nav-item">
                    <a class="nav-link js-course-intro-tab js-show-combo" href="#detail-tab-2" data-toggle="tab">
                        <img class="n-tabs__bg" src="{$URL_IMAGES}/n-tab-link-bg.png" alt="">
                        {if $paymentStatus}
                        <span>Thông tin đăng ký</span>
                        {else}
                        <span>Mua khóa học này</span>
                        {/if}
                    </a>
                </li>
                {/if}
                <!-- End -->
            </ul>
            <div class="n-tabs-content n-tabs-content--custom">
                <div class="tab-content">
                    <div class="tab-pane fade mobile-category" id="detail-tab-3">
                        <!-- Video học thử -->
                        <div class="row">
                            {foreach from=$arrListTrailCategory item=lesson key=i name=name}
                            <div class="col-md-4 col-6 videos_trail_category">
                                <a class="lesson-3" href="{$Rewrite->url_lesson($lesson)}">
                                    {if $lesson.image}
                                    <img src="{$URL_UPLOADS}/{$lesson.image}" alt="{$lesson.name}" />
                                    {else}
                                    <img src="{$URL_IMAGES}/nopic.png" alt="{$lesson.name}" />
                                    {/if}
                                </a>
                            </div>
                            {/foreach}
                        </div>
                        <!-- {include file="_blocks/_lesson-cats.tpl" prev="inner" hideSection=true} -->
                        <div class="py-3 text-center">
                            <a class="button js-show-tab" href="#detail-tab-2">Mua khóa học này</a>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="detail-tab-2">
                        {if $isLogin ne 1}
                        <div class="alert alert-danger mb-0">
                            <i class="fa fa-exclamation-circle mr-2"></i>
                            Vui lòng <a class="text-danger text-700" href=".md-login" data-toggle="modal">đăng nhập</a> để thực hiện chức năng này!
                        </div>
                        {elseif !$paymentStatus}
                        {include file="_blocks/_payment-form.tpl"}
                        {elseif $paymentStatus.status ne '2'}
                        {if $paymentStatus.combo_link}
                        <div class="alert alert-warning">
                            <i class="fa fa-exclamation-circle mr-2"></i>
                            Bạn đã đăng ký <a class="text-700 text-primary" href="{$paymentStatus.combo_link}">{$paymentStatus.name}</a> nhưng chưa thanh toán.
                            <br>
                            Bạn có thể thực hiện thanh toán combo khoá học trên hoặc đăng ký khoá học này:
                        </div>
                        {include file="_blocks/_payment-form.tpl"}
                        {else}
                        <div class="alert alert-warning mb-0">
                            <i class="fa fa-exclamation-circle mr-2"></i>
                            Bạn đã đăng ký khoá học này nhưng chưa thanh toán.
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
                        {/if}
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
            {/if}
            {if $bigQuestions}
            {else}
            <div class="alert alert-info mt-2 mb-0"><i class="fa fa-info-circle mr-3"></i> Video này không có bài tập!</div>
            {/if}
            {else}
            <div class="container">
                <div class="item_trail">
                    <div class="videotrail_tt">
                        <div class="js-login-required alert alert-danger mb-2">Bạn cầm <a href=".md-login" class="text-700 text-danger" data-toggle="modal">đăng nhập</a> để xem được nội dung này</div>
                    </div>
                    <ul class="h-links_video">
                        <li style="background: red;border: none;"><a href="/register" style="color:#fff">Đăng ký</a></li>
                        <li><a href=".md-login" data-toggle="modal">Đăng nhập</a></li>
                    </ul>
                </div>
                <h3 class="titlevideo">Video bài giảng thử</h3>
                {if $otherLessons}
                <div class="video-slider">
                    <div class="video-slider__prev"><i class="fa fa-angle-left"></i></div>
                    <div class="video-slider__next"><i class="fa fa-angle-right"></i></div>
                    <div class="video-slider__container swiper-container">
                        <div class="swiper-wrapper">
                            {foreach from = $otherLessons key=i item=item}
                            <div class="swiper-slide">
                                <a class="video-slider__frame {if $item.lesson_id eq $lesson.lesson_id}video-slider__frame--active{/if}" href="{$Rewrite->url_lesson($item)}">
                                    <img src="{if $item.image}{$URL_UPLOADS}/{$item.image}{else}{$URL_UPLOADS}/{$curCat.image}{/if}" alt="{$item.name}" />
                                </a>
                            </div>
                            {/foreach}
                        </div>
                    </div>
                </div>
                {/if}
            </div>
            <!-- End -->
            {/if}
            <div class="d-xl-none mobile-category mt-3">
                {if $paymentStatus.status eq 2}
                {include file="_blocks/_lesson-catsresult.tpl" prev="inner"}
                {else}
                {include file="_blocks/_lesson-cats.tpl" prev="inner"}
                {/if}
            </div>
        </div>
        <div class="col-lg-4 mb-30">
            <section class="aside-2 mb-20 position-relative" style="z-index: 30">
                <h2 class="aside-2__title">{$curCat.name}</h2>
                <div class="aside-2__body py-3 text-center">
                    {if $isLogin ne 1}
                    <a class="button" href=".md-login" data-toggle="modal">MUA KHÓA HỌC NÀY</a>
                    {else}
                    <a class="button" href="{$Rewrite->url_category($curCat)}">MUA KHÓA HỌC NÀY</a>
                    {/if}
                </div>
            </section>
            <section class="aside-2 mb-20">
                <h2 class="aside-2__title">Hướng dẫn trước khi học</h2>
                <div class="aside-2__body py-3">
                    <div class="expandable" data-height="300">
                        <div class="expandable__content">
                            {$curCat.instructions|htmlDecode}
                        </div>
                        <div class="expandable__footer"><a class="expandable__toggle" href="#!" data-label-expand="Xem thêm" data-label-collapse="Thu gọn"></a></div>
                    </div>
                </div>
            </section>
            <div class="d-none d-xl-block">
                {if $paymentStatus.status eq 2}
                {include file="_blocks/_lesson-catsresult.tpl" prev="aside"}
                {else}
                {include file="_blocks/_lesson-cats.tpl" prev="aside"}
                {/if}
            </div>
        </div>
    </div>
    <div class="fb-comments" data-href="{$Rewrite->url_lesson($lesson)}" data-width="100%" data-numposts="5"></div>
</div>