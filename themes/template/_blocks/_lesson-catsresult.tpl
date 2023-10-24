<section class="section" style="margin-bottom: 20px;">
    <div class="container">
        <h2 class="section__title text-uppercase">{$arrOneCourse.name}</h2>
        {if !$hideSection}
        <section class="aside-2">
            {/if}
            <ul class="nav n-tabs n-tabs--sm">
                {foreach from=$stagesresult key=ls item=stage}
                <li class="nav-item"><a class="nav-link {if $ls eq 0}active{/if}" href="#{$prev}-tab-{$ls+1}" data-toggle="tab"><img class="n-tabs__bg" src="{$URL_IMAGES}/n-tab-link-bg.png" alt=""><span>{$stage.name}</span></a></li>
                {/foreach}
            </ul>
            <div class="n-tabs-content n-tabs-content--aside">
                <div class="tab-content">
                    {foreach from=$stagesresult key=ls item=stage}
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
                                        <a class="n-menu__link" href="#!" style="position: relative;">
                                            <div class="persent" style="width: {if $les.pt < 100}{$les.pt}{else}100{/if}%;background: #ddd;position: absolute;left: 0;height: 100%;top: 0;"> </div>
                                            <div style="z-index: 1000;display: flex;justify-content: space-between;width: 100%; position: relative;">
                                                {$les.name} <span class="text-muted font-weight-normal">{if $les.pt < 100}{$les.pt}%{else}100%{/if}</span>
                                            </div>
                                        </a>
                                        <ul class="n-menu__sub">
                                            {foreach from = $les.sublessons key =j item = sub}                                            
                                            {*math assign='pt' equation='(y/x)*100' x=$sub.duration y=$sub.total_time*}
                                            {assign var=pt value=$sub.pt}
                                            <li class="n-menu__item">
                                                <a class="n-menu__link" href="{$Rewrite->url_lesson($sub)}" style="position: relative;">
                                                    <div class="persent" style="width: {$pt}%;background: #ddd;position: absolute;left: 0;height: 100%;top: 0;"> </div>
                                                    <div style="z-index: 1000;display: flex;justify-content: space-between;width: 100%;">
                                                        {$sub.name}
                                                        {if $pt < 100} <span class="text-muted font-weight-normal">{$pt|ceil}% {if $sub.scores > 0} | P:{$sub.scores}{/if}</span>
                                                            {else}
                                                            <span class="text-muted font-weight-normal">100%</span>
                                                            {/if}
                                                    </div>
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