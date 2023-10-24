<!-- footer-->
<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 mb-4">
                <h2 class="footer__title">Trung tâm tiếng Nhật Kosei</h2>
                <div class="footer__contact">
                    {$_CONFIG.footer_info|htmlDecode}
                </div>
            </div>
            <div class="col-lg-6 mb-4">
                <h2 class="footer__title">Kết nối với chúng tôi</h2>
                <div class="footer__media media">
                    <div class="media-body">
                        <ul class="f-social mb-3">
                            <li><a href="{$social.facebook}"><img src="{$URL_IMAGES}/icon-facebook-square.png" alt="{$social.facebook}" /></a></li>
                            <li><a href="{$social.twitter}"><img src="{$URL_IMAGES}/icon-twitter-square.png" alt="{$social.twitter}" /></a></li>
                            <li><a href="{$social.zalo}"><img src="{$URL_IMAGES}/icon-zalo-square.png" alt="{$social.zalo}" /></a></li>
                            <li><a href="{$social.youtube}"><img src="{$URL_IMAGES}/icon-youtube-square.png" alt="{$social.youtube}" /></a></li>
                            <li><a href="{$social.tiktok}"><img src="{$URL_IMAGES}/tiktok.jpg" alt="{$social.tiktok}" /></a></li>
                            <li><a href="{$social.instagram}"><img src="{$URL_IMAGES}/intag.jpg" alt="{$social.instagram}" /></a></li>
                        </ul>
                    </div><img class="footer__dmca" src="{$URL_IMAGES}/logo-dmca.png" alt="" />
                </div>
            </div>
        </div>
        <div class="footer__divider mb-4"></div>
        <div class="form-row">
            {if !$isTestSpeed}
            <div class="col-lg-3 col-md-6 mb-4 d-flex flex-column">
                <h2 class="footer__title-2">Fanpage</h2>
                <div class="f-card flex-grow-1">
                    <div class="f-card__frame"><img src="{$URL_IMAGES}/fanpage.png" alt="" /></div>
                    <div class="f-card__body">
                        <div class="f-card__title"><a class="text-700 text-primary" href="{$social.facebook}">www.facebook.com/NhatNguKosei/</a></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4 d-flex flex-column">
                <h2 class="footer__title-2">Youtube</h2>
                <div class="f-card flex-grow-1">
                    <div class="f-card__frame">
                        <iframe width='560' height='315' src='https://www.youtube.com/embed/1BZQfMoM5Wc' frameborder='0' allow='autoplay; encrypted-media' allowfullscreen></iframe>
                    </div>
                    <div class="f-card__body">
                        <div class="f-card__title"><a class="text-700 text-primary" href="https://www.youtube.com/@TrungtamtiengNhatKoseiVN">www.youtube.com/channel/UCfocYhtBX5PHIKRujSBG5zA</a></div>
                    </div>
                </div>
            </div>
            {/if}
            {if !$isTestSpeed}
            <div class="col-lg-6 mb-4 d-flex flex-column">
                <h2 class="footer__title-2">{'Maps'|lang}</h2>
                <div class="form-row flex-grow-1">
                    <div class="col-md-6 mb-4 mb-md-0">
                        <div class="f-card h-100">
                            <div class="f-card__frame">
                             <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d29794.41412319105!2d105.78948776994501!3d21.020608309512106!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ac87c2eb9eef%3A0x85b8c194ea368c0e!2zVHJ1bmcgVMOibSBUaeG6v25nIE5o4bqtdCBLb3NlaQ!5e0!3m2!1svi!2s!4v1678930780801!5m2!1svi!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>
                            <div class="f-card__body">
                                <div class="f-card__title"><strong>Cơ sở 1:</strong>Số 136 Lê Trọng Tấn, Thanh Xuân, Hà Nội</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="f-card h-100">
                            <div class="f-card__frame">
                                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14894.76613967911!2d105.784324!3d21.045025!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xc2c58224bc20b956!2zVHJ1bmcgVMOibSBUaeG6v25nIE5o4bqtdCBLb3NlaQ!5e0!3m2!1svi!2sus!4v1616403200674!5m2!1svi!2sus" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                            </div>
                            <div class="f-card__body">
                                <div class="f-card__title"><strong>Cơ sở 2:</strong> Số 3 Ngõ 6, Phố Đặng Thùy Trâm, Hoàng Quốc Việt, Cầu Giấy, Hà Nội</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {/if}
        </div>
        <div class="footer__copyright">Copyright © {'Y'|date} {$_CONFIG.copyright}</div>
    </div>
</footer>


<!-- Hotline 2022 -->

<div class="quick-alo-phone quick-alo-green quick-alo-show" id="quick-alo-phoneIcon">
    <a href="tel:{$_CONFIG.site_hotline}">
        <div class="quick-alo-ph-circle"></div>
        <div class="quick-alo-ph-circle-fill"></div>
        <div class="quick-alo-ph-img-circle"></div>
    </a>
</div>

<!-- End phuonghv -->




<section class="i-absolute">
    <div class="i-absolute-zalo">
        <a href="{$social.zalo}"><img src="{$URL_IMAGES}/icon_zalo.gif" alt="zalo"></a>
    </div>
</section>