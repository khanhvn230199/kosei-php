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
        <h2 class="section__title">{'Choose_skill'|lang}</h2>
        <div class="row">
            {if $arrListSkills}
                {foreach from=$arrListSkills key=s item=skill}
                    <div class="col-lg-4 col-sm-6 mb-30">
                        <div class="lesson">
                            <a class="lesson__iwrap" href="{$Rewrite->url_exam($skill)}">
                                <img src="{$URL_UPLOADS}/{$skill.image}" onerror="this.src='{$URL_IMAGES}/nopic.png'"  alt="{$skill.name}" />
                            </a>
                            <h3 class="lesson__title">
                                <a class="text-default" href="{$Rewrite->url_exam($skill)}">{$skill.name}</a>
                            </h3>
                        </div>
                    </div>
                {/foreach}
            {/if}
        </div>
    </div>
</section>