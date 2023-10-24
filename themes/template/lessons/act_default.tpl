<div class="container py-30">
    <div class="row">
        <div class="col-lg-8 mb-30">
            <button class="float-sidebar-btn js-float-sidebar-open text-700" data-target="#float-sidebar-1"><i class="fa fa-bars mr-2"></i>Bài học</button>
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
            <div class="aside-2__body py-3 text-center">
                <a class="button" href="https://m.me/111871621739031?ref=koseionline-vn">Nhận tư vấn ngay</a>
            </div>
            <div class="mt-10"></div>
            <ul class="nav n-tabs mt-20" data-payment-status="{$paymentStatus.status}" data-expired="{$paymentStatus.expired}">
                <li class="nav-item">
                    <a class="nav-link active js-course-intro-tab" href="#detail-tab-1" data-toggle="tab">
                        <img class="n-tabs__bg" src="{$URL_IMAGES}/n-tab-link-bg.png" alt="">
                        <span>Giới thiệu</span>
                    </a>
                </li>
                {if $isLogin ne 1}

                {else}



                {if $paymentStatus.status eq 2}

                <li class="nav-item">
                    <a class="nav-link js-course-intro-tab" href="#detail-tab-3" data-toggle="tab">
                        <img class="n-tabs__bg" src="{$URL_IMAGES}/n-tab-link-bg.png" alt="">
                        {if $paymentStatus.status eq '2'}
                        <span class="d-none d-xl-block">Bài giảng học thử</span>
                        <span class="d-block d-xl-none">Bắt đầu học</span>
                        {else}
                        <span>Bài giảng học thử</span>
                        {/if}
                    </a>
                </li>
                 <li class="nav-item">
                    <a class="nav-link js-course-intro-tab   {if $paymentStatus}{else}js-show-combo{/if}" href="#detail-tab-2" data-toggle="tab">
                        <img class="n-tabs__bg" src="{$URL_IMAGES}/n-tab-link-bg.png" alt="">
                        {if $paymentStatus}
                        <span>Thông tin đăng ký</span>
                        {else}
                        <span>Mua khóa học này</span>
                        {/if}
                    </a>
                </li>
                {else}
                <li class="nav-item">
                    <a class="nav-link js-course-intro-tab   {if $paymentStatus eq 2}{else}js-show-combo{/if}" href="#detail-tab-2" data-toggle="tab">
                        <img class="n-tabs__bg" src="{$URL_IMAGES}/n-tab-link-bg.png" alt="">
                        {if $paymentStatus}
                        <span>Thông tin đăng ký</span>
                        {else}
                        <span>Mua khóa học này</span>
                        {/if}
                    </a>
                </li>
                   <li class="nav-item">
                    <a class="nav-link js-course-intro-tab" href="#detail-tab-3" data-toggle="tab">
                        <img class="n-tabs__bg" src="{$URL_IMAGES}/n-tab-link-bg.png" alt="">
                        {if $paymentStatus.status eq '2'}
                        <span class="d-none d-xl-block">Bài giảng học thử</span>
                        <span class="d-block d-xl-none">Bắt đầu học</span>
                        {else}
                        <span>Bài giảng học thử</span>
                        {/if}
                    </a>
                </li>

                {/if}


                {/if}
                 {if $isLogin ne 1}
                <li class="nav-item">
                    <a class="nav-link js-course-intro-tab" href="#detail-tab-3" data-toggle="tab">
                        <img class="n-tabs__bg" src="{$URL_IMAGES}/n-tab-link-bg.png" alt="">
                        {if $paymentStatus.status eq '2'}
                        <span class="d-none d-xl-block">Bài giảng học thử</span>
                        <span class="d-block d-xl-none">Bắt đầu học</span>
                        {else}
                        <span>Bài giảng học thử</span>
                        {/if}
                    </a>
                </li>
                {else}

                {/if}
                <!-- End -->
            </ul>
            <div class="n-tabs-content n-tabs-content--custom">
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="detail-tab-1">
                        <div class="expandable" data-height="300">
                            <div class="expandable__content">
                                {$curCat.detail|htmlDecode}
                            </div>
                            <div class="py-3 text-center">
                                <a class="button" href="https://m.me/111871621739031?ref=koseionline-vn">Nhận tư vấn ngay</a>
                            </div>
                            <div class="expandable__footer">
                                <a class="expandable__toggle" href="#!" data-label-expand="Xem thêm" data-label-collapse="Thu gọn"></a>
                            </div>
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
                    <div class="tab-pane fade mobile-category" id="detail-tab-3">
                        {if $paymentStatus.status eq '2'}
                        <!-- Khóa học nếu đã mua khóa học -->
                        <div class="destop d-none d-xl-block">
                            {include file ="_blocks/_videotrail.tpl"}
                        </div>
                        <div class="destop d-block d-xl-none">
                            <!-- {include file="_blocks/_lesson-cats.tpl" prev="inner" hideSection=true} -->
                            <!-- phần trăm khóa học -->
                            {include file="_blocks/_lesson-catsresult.tpl" prev="inner" hideSection=true}
                            <!-- End -->
                        </div>
                        {else}
                        <!-- Video học thử -->
                        {include file ="_blocks/_videotrail.tpl"}
                        {/if}
                        <div class="py-3 text-center">
                            <a class="button js-show-tab" href="#detail-tab-2">Mua khóa học này</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 mb-30">
            {include file="_blocks/_lesson-search.tpl"}
            {if $curCat.introductions}
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
            {/if}
            <!-- Học viên đăng nhập đã thanh toán khóa học thì không hiện thị test đầu vào  -->
            {if $paymentStatus.status eq 2}
            {else}
            {if $bigQuestions}
            <section class="aside-2 mb-20">
                <h2 class="aside-2__title">Test đầu vào</h2>
                <div class="aside-2__body py-3 text-center">
                    <a class="button" href="{$Rewrite->url_category($curCat)}?test=1">TEST ĐẦU VÀO</a>
                </div>
            </section>
            {/if}
            {/if}
            <!-- End -->
            <div class="d-none d-xl-block">
                {if $paymentStatus.status eq 2}
                {include file="_blocks/_lesson-catsresult.tpl" prev="aside"}
                {else}
                {include file="_blocks/_lesson-cats.tpl" prev="aside"}
                {/if}
            </div>
        </div>
    </div>
    <div class="fb-comments" data-href="{$Rewrite->url_category($curCat)}" data-width="100%" data-numposts="5"></div>
</div>