{if $stages}
  {if !$hideSection}
  <section class="aside-2">
    <h2 class="aside-2__title mb-3">Bắt đầu học</h2>
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

                                 <span>0 %</span>
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
{/if}
