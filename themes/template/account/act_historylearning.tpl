<div class="container">
    <div class="border-top"></div>
</div>
<nav>
    <div class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a class="link-unstyled" href="{$VNCMS_URL}">{'Home'|lang}</a>
            </li>
            <li class="breadcrumb-item active">{'Profile'|lang}</li>
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
                        <a class="list-group-item list-group-item-active active" href="{$Rewrite->url_historylearning()}">
                            <img src="{$URL_IMAGES}/icon-file-list.png" alt="{'Lịch sử học tập'|lang}">
                            <span>{'Lịch sử học tập'|lang}</span>
                        </a>
                        <a class="list-group-item list-group-item-active" href="{$Rewrite->url_logout()}">
                            <img src="{$URL_IMAGES}/icon-power-off-blue.png" alt="{'Logout'|lang}">
                            <span>{'Logout'|lang}</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <section class="profile-section">
                    <h2 class="profile-section__title">{'Khóa học đã học'|lang}</h2>
                    <div class="row">
                        {foreach from =$arrListTransactions key = j item = transactions}
                        {if $transactions.status == 2}
                        <div class="col-sm-6 col-md-6 mb-30">
                            <div class="lesson">
                                <span class="lesson__iwrap">
                                    <img src="{$NVCMS_URL}/img.php?pic={$core->callfunc('base64_encode', $transactions.image)}&w=370&h=248&encode=1" alt="{$transactions.name}" />
                                </span>
                                <h3 class="lesson__title">
                                    <p class="text-default mb-0" href="{$Rewrite->url_category($transactions)}">{$transactions.name}</p>
                                    <hr class="mt-1 mb-1">
                                    <p class="text-white mb-0">Đã học: {$transactions.total_time|durationtime_format|default:0}</p>
                                    <hr class="mt-1 mb-1">
                                    <p class="text-white mb-0">Lần đầu học: {$transactions.first_time|date_format:"%d/%m/%Y %H:%M"|default:0}</p>
                                    <hr class="mt-1 mb-1">
                                    <p class="text-white mb-0">Lần cuối học: {$transactions.last_time|date_format:"%d/%m/%Y %H:%M"|default:0}</p>
                                    <hr class="mt-1 mb-1">
                                    <p class="text-white mb-0">
                                        <a class="btn btn-info" href="?cid={$transactions.cat_id}">Chi tiết thời gian</a>
                                    </p>
                                </h3>
                            </div>
                        </div>
                        {/if}
                        {/foreach}
                    </div>
                </section>
            </div>
        </div>
    </div>
</section>
{if $stages}
<!-- thông báo bài học đã học gần đây nhất cho học viên -->
<div class="md-video md-video-1 modal fade" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered" style="width: 350px;">
        <div class="modal-content">
            <div class="modal-body md-video__body">
                <button class="md-video__close" data-dismiss="modal"></button>
                <a href="{$Rewrite->url_lesson($arrOneLesson)}"><img class="d-block w-100" src="{$URL_UPLOADS}/{$arrOneLesson.image}" alt="{$adver.title}" /></a>
                <p style="text-align: center; font-weight: bold;font-size: 20px">Bài học gần nhất bạn đã học <br><a href="{$Rewrite->url_lesson($arrOneLesson)}">{$arrOneLesson.name}</a></p>
                <div class="st_learning_history">
                    <ul class="st_learning">
                        <li class="h-links__item h-links__item--desktop">
                            <a class="h-links__link bg-primary" href="{$Rewrite->url_lesson($arrOneLesson)}" onclick="deletetMenuClicked();">
                                <i class="fa fa-user-circle-o fa fw mr-1"></i>
                                <span>Ôn Lại</span>
                            </a>
                        </li>
                        <li class="h-links__item h-links__item--desktop">
                            <a class="h-links__link" href="{$Rewrite->url_category($arrOneCourse)}">
                                <i class="fa fa-sign-out fa fw mr-1"></i>
                                <span>Học Tiếp</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End -->
<section class="section" style="margin-bottom: 20px;">
    <div class="container">
        <h2 class="section__title text-uppercase">{$arrOneCourse.name}</h2>
        {if !$hideSection}
        <section class="aside-2">
            {/if}
            <ul class="nav n-tabs n-tabs--sm">
                {foreach from=$stages key=ls item=stage}
                <li class="nav-item"><a class="nav-link {if $ls eq 0}active{/if}" href="#{$prev}-tab-{$ls+1}" data-toggle="tab"><img class="n-tabs__bg" src="{$URL_IMAGES}/n-tab-link-bg.png" alt=""><span>{$stage.name}</span></a></li>
                {/foreach}
            </ul>
            <div class="n-tabs-content n-tabs-content--aside">
                <div class="tab-content">
                    {foreach from=$stages key=ls item=stage}
                    <div class="tab-pane fade show {if $ls eq 0}active{/if}" id="{$prev}-tab-{$ls+1}">
                        <ul class="nav as-nav">
                            {foreach from=$stage.cats key=sc item=subStage}
                            <li class="nav-item"><a class="nav-link" href="#{$prev}-tab-{$ls+1}-{$sc+1}" data-toggle="tab"><span>{$subStage.name}</span><img src="{$URL_UPLOADS}/{$subStage.image}" alt=""></a></li>
                            {/foreach}
                        </ul>
                        <div class="tab-content">
                            {foreach from=$stage.cats key=sc item=subStage}
                            <div class="tab-pane fade" id="{$prev}-tab-{$ls+1}-{$sc+1}">
                                <ul class="n-menu mt-20">
                                    <li class="n-menu__title">Video bài học</li>
                                    {foreach from = $subStage.lessons key =j item = les}
                                    <li class="n-menu__item">
                                        <a class="n-menu__link" href="#!">{$les.name}</a>
                                        <ul class="n-menu__sub">
                                            {foreach from = $les.sublessons key =j item = sub}
                                            <li class="n-menu__item">
                                                <a class="n-menu__link" href="{$Rewrite->url_lesson($sub)}"> {$sub.name}
                                                    {if $sub.total_time>0}
                                                    <small class="text-danger">(Đã học)</small>
                                                    <small class="text-danger">(Đã học  : {$sub.total_time|durationtime_format|default:0})</small>
                                                    {/if}
                                                </a>
                                                {* <a class="n-menu__link" href="{$Rewrite->url_category($curCat)}?lesson_id={$sub.lesson_id}"> {$sub.name}</a> *}
                                            </li>
                                            {/foreach}
                                        </ul>
                                    </li>
                                    {/foreach}
                                </ul>
                            </div>
                            {/foreach}
                        </div>
                    </div>
                    {/foreach}
                </div>
            </div>
            {if !$hideSection}
        </section>
        {/if}
</section>
{/if}