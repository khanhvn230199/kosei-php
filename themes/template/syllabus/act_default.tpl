<div class="container">
    <div class="border-top"></div>
</div>
<nav>
    <div class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a class="link-unstyled" href="{$VNCMS_URL}">{'Home'|lang}</a>
            </li>
            <li class="breadcrumb-item active">{$curCat.name}</li>
        </ol>
    </div>
</nav>
<section class="section mb-50">
    <div class="container">
        <h2 class="section__title">{$curCat.name}</h2>
        <ul class="list-unstyled mb-40">
            {if $arrListSyllabus}
                {foreach from=$arrListSyllabus key=k item=syllabus}
                    <li class="mb-20">
                        <div class="subject media">
                            <a class="subject__iwrap-2" href="{$Rewrite->url_syllabus($syllabus)}">
                                <img src="{$VNCMS_URL}/img.php?pic={$core->callfunc('base64_encode', $syllabus.image)}&w=195&h=266&encode=1" onerror="this.src='{$URL_IMAGES}/nopic.png'" alt="{$syllabus.title}" />
                            </a>
                            <div class="media-body">
                                <h3 class="subject__title">
                                    <a class="text-default" href="{$Rewrite->url_syllabus($syllabus)}">{$syllabus.title}</a>
                                </h3>
                                <div class="subject__time">{$syllabus.reg_date|date_format:"%d/%m/%Y | %H:%i"}</div>
                                <div class="subject__desc">
                                    {$syllabus.sapo|htmlDecode|strip_tags|truncate:200:"..."}
                                </div>
                            </div>
                        </div>
                    </li>
                {/foreach}
            {/if}
        </ul>
        <nav>
            <ul class="pagination">
                {$clsPaging->showPagingNew2()}
            </ul>
        </nav>
    </div>
</section>