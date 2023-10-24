<div class="container">
    <div class="border-top"></div>
</div>
<nav>
    <div class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a class="link-unstyled" href="{$VNCMS_URL}">{'Home'|lang}</a>
            </li>
            <li class="breadcrumb-item active">{'JLPT_exam_inventory'|lang}</li>
        </ol>
    </div>
</nav>
<section class="section mb-50">
    <div class="container">
        <h2 class="section__title text-uppercase">{'Practice'|lang}</h2>
        {*<ul class="exam-tabs nav" role="tablist">
            {if $arrListExams}
                <li class="nav-item">
                    <a class="nav-link btn btn-default active" href="#skill" role="tab" data-toggle="tab">{'All'|lang}</a>
                </li>
            {/if}
            {if $arrListSkills}
                {foreach from=$arrListSkills key=s item=skill}
                    <li class="nav-item">
                        <a class="nav-link btn btn-default" href="#skill-{$s}" role="tab" data-toggle="tab">{$skill.name}</a>
                    </li>
                {/foreach}
            {/if}
        </ul>*}
        <div class="tab-content">
            {if $arrListExams}
                <div class="tab-pane fade active show" id="skill" role="tabpanel">
                    <div class="row">
                        {foreach from=$arrListExams key=e item=exam}
                            <div class="col-lg-4 col-sm-6 mb-30">
                                <div class="exam card card-body">
                                    <h3 class="exam__title">
                                        <a class="text-default" href="{$Rewrite->url_exam_detail($exam)}">{$exam.name}</a>
                                    </h3>
                                    <div class="d-flex align-items-center mb-4">
                                        {if $exam.time_end}
                                            <div class="mr-20">
                                                <i class="fa fa-clock-o mr-1"></i>
                                                <span>{$exam.time_end} {'minute'|lang}</span>
                                            </div>
                                        {/if}
                                        <span class="exam__badge badge badge-danger">{'Free'|lang}</span>
                                    </div>
                                    <div class="nav mb-1">
                                        {if $exam.list_user}
                                            {foreach from=$exam.list_user key=u item=user}
                                                <a class="exam__user" href="javascript:;" title="{$user.fullname}">
                                                    <img src="{$URL_IMAGES}/{$user.image}" onerror="this.src='{$URL_IMAGES}/user.png'" alt="{$user.fullname}"/>
                                                </a>
                                            {/foreach}
                                            {if $exam.total_user > 3 && ($exam.total_user - 3) > 0}
                                                <a class="exam__user" href="javascript:;">
                                                    <span>+{$exam.total_user - 3}</span>
                                                </a>
                                            {/if}
                                        {/if}
                                    </div>
                                    <div class="nav justify-content-between">
                                        <div class="exam__tags mt-20">
                                            <a class="btn btn-danger text-700" href="javascript:;">{$exam.code}</a>
                                            <a class="btn btn-secondary ml-1" href="javascript:;">#{$exam.skill_name}</a>
                                        </div>
                                        <a class="exam__link btn btn-primary mt-20" href="{$Rewrite->url_exam_detail($exam)}">{'Mock_exam'|lang}</a>
                                    </div>
                                </div>
                            </div>
                        {/foreach}
                    </div>
                    <div class="text-center">
                        <a class="section__btn btn btn-primary" href="#!">{'View_more'|lang}</a>
                    </div>
                </div>
            {/if}
            {if $arrListSkills}
                {foreach from=$arrListSkills key=s item=skill}
                    <div class="tab-pane fade" id="skill-{$s}" role="tabpanel">
                        <div class="row">
                            {foreach from=$skill.list_exams key=e item=exam}
                                <div class="col-lg-4 col-sm-6 mb-30">
                                    <div class="exam card card-body">
                                        <h3 class="exam__title">
                                            <a class="text-default" href="{$Rewrite->url_exam_detail($exam)}">{$exam.name}</a>
                                        </h3>
                                        <div class="d-flex align-items-center mb-4">
                                            {if $exam.time_end}
                                                <div class="mr-20">
                                                    <i class="fa fa-clock-o mr-1"></i>
                                                    <span>{$exam.time_end} {'minute'|lang}</span>
                                                </div>
                                            {/if}
                                            <span class="exam__badge badge badge-danger">{'Free'|lang}</span>
                                        </div>
                                        <div class="nav mb-1">
                                            {if $exam.list_user}
                                                {foreach from=$exam.list_user key=u item=user}
                                                    <a class="exam__user" href="javascript:;" title="{$user.fullname}">
                                                        <img src="{$URL_IMAGES}/{$user.image}" onerror="this.src='{$URL_IMAGES}/user.png'" alt="{$user.fullname}"/>
                                                    </a>
                                                {/foreach}
                                                {if $exam.total_user > 3 && ($exam.total_user - 3) > 0}
                                                    <a class="exam__user" href="javascript:;">
                                                        <span>+{$exam.total_user - 3}</span>
                                                    </a>
                                                {/if}
                                            {/if}
                                        </div>
                                        <div class="nav justify-content-between">
                                            <div class="exam__tags mt-20">
                                                <a class="btn btn-danger text-700" href="javascript:;">{$exam.code}</a>
                                                <a class="btn btn-secondary ml-1" href="javascript:;">#{$exam.skill_name}</a>
                                            </div>
                                            <a class="exam__link btn btn-primary mt-20" href="{$Rewrite->url_exam_detail($exam)}">{'Mock_exam'|lang}</a>
                                        </div>
                                    </div>
                                </div>
                            {/foreach}
                        </div>
                        <div class="text-center">
                            <a class="section__btn btn btn-primary" href="#!">{'View_more'|lang}</a>
                        </div>
                    </div>
                {/foreach}
            {/if}
        </div>
    </div>
</section>
{*{if $arrListExamsAllSkills}
    <section class="section mb-50">
        <div class="container">
            <h2 class="section__title text-uppercase">{'Practice_subject_full_4_skills'|lang}</h2>
            <div class="row">
                {foreach from=$arrListExamsAllSkills key=e item=exam}
                    <div class="col-lg-4 col-sm-6 mb-30">
                        <div class="exam card card-body">
                            <h3 class="exam__title">
                                <a class="text-default" href="{$Rewrite->url_exam_detail($exam)}">{$exam.name}</a>
                            </h3>
                            <div class="d-flex align-items-center mb-4">
                                {if $exam.time_end}
                                    <div class="mr-20">
                                        <i class="fa fa-clock-o mr-1"></i>
                                        <span>{$exam.time_end} {'minute'|lang}</span>
                                    </div>
                                {/if}
                                <span class="exam__badge badge badge-danger">{'Free'|lang}</span>
                            </div>
                            <div class="nav mb-1">
                                {if $exam.list_user}
                                    {foreach from=$exam.list_user key=u item=user}
                                        <a class="exam__user" href="javascript:;" title="{$user.fullname}">
                                            <img src="{$URL_IMAGES}/{$user.image}" onerror="this.src='{$URL_IMAGES}/user.png'" alt="{$user.fullname}"/>
                                        </a>
                                    {/foreach}
                                    {if $exam.total_user > 3 && ($exam.total_user - 3) > 0}
                                        <a class="exam__user" href="javascript:;">
                                            <span>+{$exam.total_user - 3}</span>
                                        </a>
                                    {/if}
                                {/if}
                            </div>
                            <div class="nav justify-content-between">
                                <div class="exam__tags mt-20">
                                    <a class="btn btn-danger text-700" href="#!">{$exam.code}</a>
                                </div>
                                <a class="exam__link btn btn-primary mt-20" href="{$Rewrite->url_exam_detail($exam)}">{'Mock_exam'|lang}</a>
                            </div>
                        </div>
                    </div>
                {/foreach}
            </div>
            <div class="text-center">
                <a class="section__btn btn btn-primary" href="#!">{'View_more'|lang}</a>
            </div>
        </div>
    </section>
{/if}*}