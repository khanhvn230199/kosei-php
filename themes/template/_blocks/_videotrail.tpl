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