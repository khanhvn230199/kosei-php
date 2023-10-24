<div class="container py-30">
    <div class="row">
        <div class="col-lg-8 mb-30">
            {if $bigQuestions}
            <article class="js-test">
                <h2 class="vocab-page-title">Bài test đầu vào</h2>
                {include file="_blocks/_exercise.tpl"}
            </article>
            {/if}
        </div>
        <div class="col-lg-4 mb-30">
            <section class="float-sidebar" id="float-sidebar-1" style="z-index:2147483645">
                <div class="float-sidebar__header">
                    <div class="float-sidebar__close">
                        <div class="text-16 text-uppercase mr-2">Close</div>
                        <div class="navbar-toggle active"><span></span><span></span><span></span></div>
                    </div>
                </div>
                <div class="float-sidebar__body">
                    {include file="_blocks/_lesson-search.tpl"}
                    <section class="aside-2 mb-20 d-none d-lg-block">
                        <h2 class="aside-2__title">Hướng dẫn trước khi học</h2>
                        <div class="aside-2__body py-3">
                            <div class="expandable" data-height="300">
                                <div class="expandable__content">
                                    {$curCat.instructions|htmlDecode}
                                </div>
                                <div class="expandable__footer"><a class="expandable__toggle" href="#!" data-label-expand="Xem thêm" data-label-collapse="Thu gọn"></a></div>
                            </div>
                        </div>
                    </section>
                    {include file="_blocks/_lesson-cats.tpl"}
                </div>
            </section>
            <section class="aside-2 mb-20 d-lg-none">
                <h2 class="aside-2__title">Hướng dẫn trước khi học</h2>
                <div class="aside-2__body py-3">
                    <div class="expandable" data-height="300">
                        <div class="expandable__content">
                            {$curCat.instructions|htmlDecode}
                        </div>
                        <div class="expandable__footer"><a class="expandable__toggle" href="#!" data-label-expand="Xem thêm" data-label-collapse="Thu gọn"></a></div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <div class="fb-comments" data-href="{$Rewrite->url_category($curCat)}?test=1" data-width="100%" data-numposts="5"></div>
</div>