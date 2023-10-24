{foreach key=k item=adver from=$arrListAdver name=i}
    {if $core->callfunc("strlen", $adver.embed) > 10}
        {$adver.embed|htmlDecode}
    {elseif $core->callfunc("strpos", $adver.image, '.swf')>0 || $core->callfunc("strpos", $adver.image, '.SWF')>0}
        {$core->callfunc("getFlashAds2", $adver)}
    {else}
        <a href="{$adver.link}" title="{$adver.title}" target="_blank"><img src="{$URL_UPLOADS}/{$adver.image}"
                                                                            alt="{$adver.title}"></a>
    {/if}
    {if $smarty.foreach.i.total > 1 && $smarty.foreach.i.last ne 1}
        <div class="hr10"></div>
    {/if}
{/foreach}