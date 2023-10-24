{if $arrListAdver}
    {foreach key=k item=adver from=$arrListAdver}
        <div class="ct-info__map embed-responsive">
            {$adver.embed|htmlDecode}
        </div>
        <div class="ct-info__map-label">
            <strong>{'Base'|lang} {$k+1}:</strong>
            <span>{$adver.title}</span>
        </div>
    {/foreach}
{/if}
