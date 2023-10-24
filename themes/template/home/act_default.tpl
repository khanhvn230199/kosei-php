<!-- banner-->
{include file ="_slider/_main.tpl"}
<!-- các khoá học online-->
<section class="section-2">
    <div class="container">
        <h2 class="section-2__title"><span>Các khoá học Online</span><img src="{$URL_IMAGES}/icon-mountain-red.png" alt=""></h2>
        <ul class="nav n-tabs">
            <li class="nav-item"><a class="nav-link active" href="#course-tab-1" data-toggle="tab"><img class="n-tabs__bg" src="{$URL_IMAGES}/n-tab-link-bg.png" alt=""><img src="{$URL_IMAGES}/icon-jp-flag.png" alt=""><span>Các khoá học</span></a></li>
            <li class="nav-item"><a class="nav-link" href="#course-tab-2" data-toggle="tab"><img class="n-tabs__bg" src="{$URL_IMAGES}/n-tab-link-bg.png" alt=""><span>Combo khoá học</span></a></li>
        </ul>
        <div class="n-tabs-content">
            <div class="tab-content">
                <div class="tab-pane fade show active" id="course-tab-1">
                    {if $courses}
                    <div class="course-slider">
                        <div class="course-slider__prev"><i class="fa fa-angle-left"></i></div>
                        <div class="course-slider__next"><i class="fa fa-angle-right"></i></div>
                        <div class="course-slider__container swiper-container">
                            <div class="swiper-wrapper">
                                {foreach from=$courses item=course key=key name=name}
                                <div class="swiper-slide">
                                    <div class="course-2">
                                        <div class="course-2__header">{$course.name}</div>
                                        <div class="course-2__body">
                                            <div class="course-2__price">
                                                <div>{$core->callfunc('number_format', $course.price_vn)} Vnđ</div>
                                                <div>{$core->callfunc('number_format', $course.price_jp)} ¥</div>
                                            </div>
                                            <div class="mt-1">Thời gian: {$course.duration} tháng</div>
                                        </div>
                                        <div class="course-2__footer">
                                            <div class="course-2__btn">Khám phá</div>
                                        </div>
                                        <div class="course-2__overlay">
                                            <div class="course-2__name"><span>{$course.name}</span><img src="{$URL_IMAGES}/icon-lantern.png" alt="" /></div>
                                            <div class="course-2__desc">{$course.des|htmlDecode|strip_tags}</div>
                                            <div class="course-2__footer"><a class="course-2__btn" href="{$Rewrite->url_category($course)}">Khám phá</a></div>
                                        </div>
                                    </div>
                                </div>
                                {/foreach}
                            </div>
                        </div>
                    </div>
                    {/if}
                </div>
                <div class="tab-pane fade" id="course-tab-2">
                    {if $combos}
                    <div class="course-slider">
                        <div class="course-slider__prev"><i class="fa fa-angle-left"></i></div>
                        <div class="course-slider__next"><i class="fa fa-angle-right"></i></div>
                        <div class="course-slider__container swiper-container">
                            <div class="swiper-wrapper">
                                {foreach from=$combos item=combo key=key name=name}
                                <div class="swiper-slide">
                                    <div class="course-2">
                                        <div class="course-2__header">{$combo.name}</div>
                                        <div class="course-2__body">
                                            <div class="course-2__price">
                                                <div>{$core->callfunc('number_format', $combo.price_vn)} Vnđ</div>
                                                <div>{$core->callfunc('number_format', $combo.price_jp)} ¥</div>
                                            </div>
                                            <div class="mt-1">Thời gian: {$combo.duration} tháng</div>
                                        </div>
                                        <div class="course-2__footer">
                                            <div class="course-2__btn">Mua khóa học</div>
                                        </div>
                                        <div class="course-2__overlay">
                                            <div class="course-2__name"><span>{$combo.name}</span><img src="{$URL_IMAGES}/icon-lantern.png" alt="" /></div>
                                            <div class="course-2__desc">{$combo.des|htmlDecode|strip_tags}</div>
                                            <div class="course-2__footer"><a class="course-2__btn" href="{$Rewrite->url_category($combo)}#detail-tab-2">Mua khóa học</a></div>
                                        </div>
                                    </div>
                                </div>
                                {/foreach}
                            </div>
                        </div>
                    </div>
                    {/if}
                </div>
            </div>
        </div>
    </div>
</section>
{$core->echoAdverNonTime('why','why')}
<!-- xem thử bài giảng-->
{if !$isTestSpeed}
{if $trialLevels}
<section class="section-2 bg-light">
    <div class="container">
        <h2 class="section-2__title"><span>Xem thử bài giảng</span><img src="{$URL_IMAGES}/icon-jp-flag.png" alt=""></h2>
        <ul class="nav n-tabs">
            {foreach from=$trialLevels item=level key=key name=name}
            {if $level.lessons}
            <li class="nav-item">
                <a class="nav-link 
                {if $level.lessons}
                {if $key eq 1}active{/if}
                {else}
                {if $key eq 0}active{/if}
                {/if}

                " href="#lesson-tab-{$key + 1}" data-toggle="tab">
                    <img class="n-tabs__bg" src="{$URL_IMAGES}/n-tab-link-bg.png" alt="">
                    <img src="{$URL_IMAGES}/icon-jp-flag.png" alt="">
                    <span>Bài giảng {$level.code}</span>
                </a>
            </li>
            {/if}
            {/foreach}
        </ul>
        <div class="n-tabs-content">
            <div class="tab-content">
                {foreach from=$trialLevels item=level key=key name=name}
                <div class="tab-pane fade {if $key eq 1}show active{/if}" id="lesson-tab-{$key + 1}">
                    {if $level.lessons}
                    <div class="course-slider">
                        <div class="course-slider__prev"><i class="fa fa-angle-left"></i></div>
                        <div class="course-slider__next"><i class="fa fa-angle-right"></i></div>
                        <div class="course-slider__container swiper-container">
                            <div class="swiper-wrapper">
                                {foreach from=$level.lessons item=lesson key=i name=name}
                                <div class="swiper-slide">
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
                        </div>
                    </div>
                    {/if}
                </div>
                {/foreach}
            </div>
        </div>
    </div>
    <div class="aside-2__body py-3 text-center">
        <a class="button" href="https://m.me/111871621739031?ref=koseionline-vn">Nhận tư vấn ngay</a>
    </div>
</section>
{/if}
{/if}
{if !$isTestSpeed}
<!-- End -->
{if $arrListTeacher}
<!-- thông tin giảng viên-->
<section class="section-2">
    <div class="container">
        <h2 class="section-2__title"><span>{'You_will_learn_with_a_good_and_dedicated_teacher'|lang}</span><img src="{$URL_IMAGES}/icon-jp-woman.png" alt=""></h2>
        <div class="teacher-slider">
            <div class="teacher-slider__prev"><i class="fa fa-angle-left"></i></div>
            <div class="teacher-slider__next"><i class="fa fa-angle-right"></i></div>
            <div class="teacher-slider__container swiper-container">
                <div class="swiper-wrapper">
                    {foreach from = $arrListTeacher key =i item = teacher}
                    <div class="swiper-slide">
                        <div class="teacher"><a class="teacher__frame" href="{$Rewrite->url_teacher($teacher)}"><img src="{$URL_UPLOADS}/{$teacher.image}" alt="{$teacher.title}" /></a>
                            <div class="teacher__body">
                                <h3 class="teacher__name"><a class="text-default" href="{$Rewrite->url_teacher($teacher)}">{$teacher.title}</a></h3>
                                <div class="teacher__info"> {$teacher.sapo|htmlDecode}</div>
                                <div class="teacher__contacts">
                                    <a class="teacher__contact" href="{$teacher.facebook}"><i class="fa fa-fw fa-facebook"></i></a>
                                    <a class="teacher__contact" href="{$teacher.instagram}"><i class="fa fa-fw fa-instagram"></i></a>
                                    <a class="teacher__contact" href="{$teacher.twitter}"><i class="fa fa-fw fa-twitter"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    {/foreach}
                </div>
            </div>
        </div>
    </div>
</section>
{/if}
{/if}
{if !$isTestSpeed}
<!-- Cảm nhận học viên-->
{$core->echoAdverNonTime('CR','customer_reviews')}
{/if}
<!-- đăng ký tư vấn-->
{* <section class="section-2">
    <div class="container">
        <form class="consultation" id="advisory_form1" action="" method="POST" onsubmit="ajax_advisory(1);return false;">
            <h2 class="consultation__title">{'Sign_up_for_advice'|lang}</h2>
            <div class="row">
                <div class="col-lg-6 mb-30 mb-lg-0">
                    {$_CONFIG.about|htmlDecode}
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>{'Full_name'|lang}</label>
                        <input class="form-control" type="text" name="name" placeholder="" required />
                    </div>
                    <div class="form-group">
                        <label>{'Phone'|lang}</label>
                        <input class="form-control" type="text" name="phone" placeholder="" required />
                    </div>
                    <div class="form-group">
                        <label>{'Email'|lang}</label>
                        <input class="form-control" name="email" placeholder="" required />
                    </div>
                    <div class="form-group">
                        <label>{'Address'|lang}</label>
                        <input class="form-control" name="address" placeholder="" required />
                    </div>
                    <button class="consultation__btn" type="submit">{'Sign_up_for_advice'|lang}</button>
                </div>
            </div>
        </form>
    </div>
</section> *}