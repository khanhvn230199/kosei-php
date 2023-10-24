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
            <li class="breadcrumb-item active">{$arrOneSyllabus.title}</li>
        </ol>
    </div>
</nav>
<section class="section mb-50">
    <div class="container">
        <div class="section__title">{$curCat.name}</div>
        <article class="post">
            <h1 class="post-title">{$arrOneSyllabus.title}</h1>
            <div class="mb-3">
                <div class="fb-like" data-href="{$Rewrite->url_syllabus($arrOneSyllabus)}" data-layout="button_count" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
            </div>
            <h2 class="post-sapo">{$arrOneSyllabus.sapo|htmlDecode}</h2>
            <div class="post-content">
                {$arrOneSyllabus.content|htmlDecode}
                <p>
                    <img src="{$URL_IMAGES}/dmca.png" alt="{$arrOneSyllabus.title}" />
                </p>
            </div>
        </article>
    </div>
</section>
<section class="mb-50 over-hidden">
    <div class="container">
        {if $arrListOtherSyllabus}
            <h2 class="section__title">{'Related_syllabus'|lang}</h2>
            <div class="subject-slider js-subject-slider mb-30">
                <div class="subject-slider__prev">
                    <img src="{$URL_IMAGES}/icon-angle-left-blue.png" alt="prev" />
                </div>
                <div class="subject-slider__next">
                    <img src="{$URL_IMAGES}/icon-angle-left-blue.png" alt="next" />
                </div>
                <div class="swiper-container">
                    <div class="swiper-wrapper">
                        {foreach from=$arrListOtherSyllabus key=n item=syllabus}
                            <div class="swiper-slide">
                                <div class="subject-3">
                                    <a class="subject-3__iwrap" href="{$Rewrite->url_syllabus($syllabus)}" title="{$syllabus.title}">
                                        <img src="{$NVCMS_URL}/img.php?pic={$core->callfunc('base64_encode', $syllabus.image)}&w=198&h=270&encode=1" onerror="this.src='{$URL_IMAGES}/nopic.png'" alt="{$syllabus.title}" />
                                    </a>
                                    <h3 class="subject-3__title">
                                        <a class="text-default" href="{$Rewrite->url_syllabus($syllabus)}" title="{$syllabus.title}">{$syllabus.title}</a>
                                    </h3>
                                    <div class="subject-3__desc">{$syllabus.sapo|htmlDecode|strip_tags|truncate:200:"..."}</div>
                                </div>
                            </div>
                        {/foreach}
                    </div>
                </div>
            </div>
        {/if}
        <div>
            <div class="fb-comments" data-href="{$Rewrite->url_syllabus($arrOneSyllabus)}" data-width="100%" data-numposts="10"></div>
        </div>
    </div>
</section>