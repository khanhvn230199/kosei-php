<section class="section-2 bg-light whyChooseUs">
    <div class="container">
        <div class="section-tile-container text-center mb-5">
            <h2 class="section-title"><span>Tại sao nên chọn khóa học tiếng Nhật ở Kosei</span></h2>
        </div>
        <div class="row">
            {foreach from = $arrListAdver key =j item = adver}
            <div class="col-md-6 col-lg-3 mb-4">
                <div class="whyChooseUs-item">
                    <div class="whyChooseUs-title">{$adver.title}</div>
                    <div class="whyChooseUs-icon"><img src="{$URL_UPLOADS}/{$adver.image}" alt="{$adver.title}"></div>
                    <div class="box-text">
                        {$adver.des|htmlDecode}
                    </div>
                </div>
            </div>
            {/foreach}
        </div>
    </div>
    <div class="aside-2__body py-3 text-center">
        <a class="button" href="https://m.me/111871621739031?ref=koseionline-vn">Nhận tư vấn ngay</a>
    </div>
</section>