<div class="container">
    <div class="border-top"></div>
</div>
<nav>
    <div class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a class="link-unstyled" href="{$VNCMS_URL}">{'Home'|lang}</a>
            </li>
            <li class="breadcrumb-item">
                <a class="link-unstyled" href="{$Rewrite->url_category($curCat)}">{$curCat.name}</a>
            </li>
            <li class="breadcrumb-item active">{$arrOneArticle.title}</li>
        </ol>
    </div>
</nav>
<section class="section mb-50">
    <div class="container">
        <div class="section__title">{$curCat.name}</div>
        <article class="post">
            <h1 class="post-title">{$arrOneArticle.title}</h1>
            <div class="mb-3">
                <div class="fb-like" data-href="{$Rewrite->url_article($arrOneArticle)}" data-layout="button_count"
                     data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
            </div>
            <h2 class="post-sapo">{$arrOneArticle.sapo|htmlDecode}</h2>
            <div class="post-content">
                {$arrOneArticle.content|htmlDecode}
                <p>
                    <img src="{$URL_IMAGES}/dmca.png" alt="{$arrOneArticle.title}"/>
                </p>
            </div>
        </article>
    </div>
</section>
<section class="mb-50 over-hidden">
    <div class="container">
        {if $arrListOtherArticles}
            <h2 class="section__title">{'Related_news'|lang}</h2>
            <div class="subject-slider js-subject-slider mb-30">
                <div class="subject-slider__prev">
                    <img src="{$URL_IMAGES}/icon-angle-left-blue.png" alt="prev"/>
                </div>
                <div class="subject-slider__next">
                    <img src="{$URL_IMAGES}/icon-angle-left-blue.png" alt="next"/>
                </div>
                <div class="swiper-container">
                    <div class="swiper-wrapper">
                        {foreach from=$arrListOtherArticles key=n item=news}
                            <div class="swiper-slide">
                                <div class="subject-3">
                                    <a class="subject-3__iwrap" href="{$Rewrite->url_article($news)}"
                                       title="{$news.title}">
                                        <img src="{$NVCMS_URL}/img.php?pic={$core->callfunc('base64_encode', $news.image)}&w=198&h=270&encode=1"
                                             onerror="this.src='{$URL_IMAGES}/nopic.png'" alt="{$news.title}"/>
                                    </a>
                                    <h3 class="subject-3__title">
                                        <a class="text-default" href="{$Rewrite->url_article($news)}"
                                           title="{$news.title}">{$news.title}</a>
                                    </h3>
                                    <div class="subject-3__desc">{$news.sapo|htmlDecode|strip_tags|truncate:200:"..."}</div>
                                </div>
                            </div>
                        {/foreach}
                    </div>
                </div>
            </div>
        {/if}
        <div>
            <div class="fb-comments" data-href="{$Rewrite->url_article($arrOneArticle)}" data-width="100%"
                 data-numposts="10"></div>
        </div>
    </div>
</section>