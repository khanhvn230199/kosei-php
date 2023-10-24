<div class="container">
    <div class="border-top"></div>
</div>
<nav>
    <div class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a class="link-unstyled" href="{$VNCMS_URL}">{'Home'|lang}</a>
            </li>
            <li class="breadcrumb-item active">{$arrOnePage.name}</li>
        </ol>
    </div>
</nav>
<section class="section mb-50">
    <div class="container">
        <h1 class="section__title">{$arrOnePage.name}</h1>
        <article class="post">
            <div class="mb-3">
                <div class="fb-like" data-href="{$Rewrite->url_article($arrOnePage)}" data-layout="button_count" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
            </div>
            <h2 class="post-sapo">{$arrOnePage.sapo|htmlDecode}</h2>
            <div class="post-content">
                {$arrOnePage.content|htmlDecode}
                <p>
                    <img src="{$URL_IMAGES}/dmca.png" alt="{$arrOnePage.name}" />
                </p>
            </div>
        </article>
    </div>
</section>
<section class="mb-50 over-hidden">
    <div class="container">
        <div>
            <div class="fb-comments" data-href="{$Rewrite->url_article($arrOnePage)}" data-width="100%" data-numposts="10"></div>
        </div>
    </div>
</section>

    