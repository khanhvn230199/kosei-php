{if $exams and $candidate.answers}
{include file="account/act_historydetail.tpl"}
{else}
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
                        <a class="list-group-item list-group-item-active active" href="javascript:;">
                            <img src="{$URL_IMAGES}/icon-file-list.png" alt="{'Learning_information'|lang}">
                            <span>{'Learning_information'|lang}</span>
                        </a>
                        <a class="list-group-item list-group-item-active" href="{$Rewrite->url_account()}">
                            <img src="{$URL_IMAGES}/icon-user-blue.png" alt="{'Profile'|lang}">
                            <span>{'Profile'|lang}</span>
                        </a>
                        <a class="list-group-item list-group-item-active" href="{$Rewrite->url_historylearning()}">
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
                    <h2 class="profile-section__title">{'Registered_courses'|lang}</h2>
                    <div class="row">
                        {if $arrListTransactions}
                        {foreach from=$arrListTransactions key=t item=transsaction}
                        <div class="col-sm-6 col-md-4 mb-30">
                            <div class="lesson">
                                <a class="lesson__iwrap" href="{$Rewrite->url_category($transsaction)}">
                                    <img src="{$NVCMS_URL}/img.php?pic={$core->callfunc('base64_encode', $transsaction.image)}&w=370&h=248&encode=1" alt="{$transsaction.name}" />
                                </a>
                                <div class="lesson__message" style="background-color: {if $transsaction.status eq 0}orange{elseif $transsaction.status eq 2}green{/if}">
                                    {if $transsaction.status eq 0}
                                    {'Wait_for_pay'|lang}
                                    {elseif $transsaction.status eq 1}
                                    {'Unpaid'|lang}
                                    {else}
                                    {'Paid'|lang}
                                    {/if}
                                </div>
                                <h3 class="lesson__title">
                                    <a class="text-default" href="{$Rewrite->url_category($transsaction)}">{$transsaction.name}</a>
                                </h3>
                            </div>
                        </div>
                        {/foreach}
                        {/if}
                    </div>
                </section>
            </div>
        </div>
    </div>
</section>
{if $candidates}
<section class="section">
    <div class="container">
        <h2 class="section__title text-uppercase">{'Trial_exam_history'|lang}</h2>
        <div class="row">
            {foreach from=$candidates key=e item=candidate}
            <div class="col-lg-4 col-sm-6 mb-30">
                <div class="exam card card-body">
                    <h3 class="exam__title">
                        <a class="text-default" href="{$Rewrite->url_history()}?candidate_id={$candidate.id}">{$candidate.name}</a>
                    </h3>
                    <div class="d-flex align-items-center mb-3">
                        <i class="fa fa-clock-o mr-1"></i>
                        <span>{$candidate.reg_date|date_format:"%D %r"}</span>
                    </div>
                    <div class="highscore__item"><strong>Tổng điểm:</strong><strong class="text-danger">{$candidate.total_score}/180</strong></div>
                    <div class="highscore__item"><span>Từ vựng + Ngữ pháp:</span><strong class="text-danger">{$candidate.vocabulary_score}/60</strong></div>
                    <div class="highscore__item"><span>Đọc hiểu:</span><strong class="text-danger">{$candidate.reading_score}/60</strong></div>
                    <div class="highscore__item"><span>Nghe hiểu:</span><strong class="text-danger">{$candidate.listening_score}/60</strong></div>
                    <div class="nav justify-content-end">
                        <a class="exam__link btn btn-primary mt-20" href="{$Rewrite->url_history()}?candidate_id={$candidate.id}">Xem chi tiết</a>
                    </div>
                </div>
            </div>
            {/foreach}
        </div>
</section>
{/if}
{/if}