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
        <h2 class="section__title">{'Choose_level'|lang}</h2>
        <div class="row">
            {if $arrListLevel}
                {assign var="big" value=0}
                {foreach from=$arrListLevel key=l item=level}
                    {if $big < 3}
                    <div class="col-lg-4 col-sm-6 mb-30">
                        <div class="lesson">
                            <a class="lesson__iwrap" href="{$Rewrite->url_practice($level)}">
                                <img src="{$URL_IMAGES}/{$level.image}" onerror="this.src='{$URL_UPLOADS}/{$level.image}'"  alt="{$level.name}" />
                            </a>
                            <h3 class="lesson__title">
                                <a class="text-default" href="{$Rewrite->url_practice($level)}">{$level.name}</a>
                            </h3>
                        </div>
                    </div>
                    {$big = $big+1}
                {else}
                    <div class="col-sm-4 mb-30">
                        <div class="lesson">
                            <a class="lesson__iwrap" href="{$Rewrite->url_practice($level)}">
                                <img src="{$URL_IMAGES}/{$level.image}" onerror="this.src='{$URL_UPLOADS}/{$level.image}'"  alt="{$level.name}" />
                            </a>
                            <h3 class="lesson__title">
                                <a class="text-default" href="{$Rewrite->url_practice($level)}">{$level.name}</a>
                            </h3>
                        </div>
                    </div>
                    {if $big eq 4}
                        {$big = 0}
                    {else}
                        {$big = $big+1}
                    {/if}
                {/if}
                {/foreach}
            {/if}
        </div>
    </div>
</section>