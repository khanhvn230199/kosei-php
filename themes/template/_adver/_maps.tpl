{if $arrListAdver}
    {foreach from=$arrListAdver key=a item=adver}
        {if $a < 2}
            <div class="col-sm-6 mb-4 mb-sm-0">
                <a class="f-map" href="javascript:;">
                    <div class="f-map__iwrap">
                        {$adver.embed|htmlDecode}
                    </div>
                    <div class="f-map__title d-flex align-items-center">
                        <div>
                            <strong>{'Base'|lang} {$a+1}:</strong> {$adver.title}
                        </div>
                    </div>
                </a>
            </div>
        {/if}
    {/foreach}
{/if}