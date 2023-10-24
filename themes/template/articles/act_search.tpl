<!-- main content-->
<div class="container py-50">
    <nav class="py-10">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a class="link-unstyled" href="{$VNCMS_URL}">{'Home'|lang}</a>
            </li>
            <li class="breadcrumb-item active">{'Search'|lang}</li>
        </ol>
    </nav>
    <section class="section-3">
        <div class="section-3__header">
            <h2 class="section-3__title">
                {'Search_results_for_keyword'|lang} "{$key}"
            </h2>
        </div>
    </section>
    <div class="row">
        {foreach from=$arrListArticles key=k item=news}
            <div class="col-lg-3 col-sm-6">
                <a class="news" href="{$Rewrite->url_article($news)}">
                    <img class="news__img" src="{$VNCMS_URL}/img.php?pic={$core->callfunc('base64_encode', $news.image)}&w=255&h=383&encode=1" onerror="this.src='{$URL_IMAGES}/nopic.png'"  alt="{$news.title}" />
                    <div class="news__body">
                        <div class="news__title max-line-2">{$news.title}</div>
                        <div class="news__time">{$news.reg_date|date_format:"%d/%m/%Y"}</div>
                    </div>
                </a>
            </div>
        {/foreach}
    </div>
    <nav class="d-flex justify-content-center">
        <ul class="pagination mb-0">
            {$clsPaging->showPagingNew2()}
        </ul>
    </nav>
</div>