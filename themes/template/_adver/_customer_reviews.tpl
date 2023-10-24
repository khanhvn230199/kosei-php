{if $arrListAdver}
<section class="section-2 bg-light">
    <div class="container">
        <h2 class="section-2__title"><span>{'Actual_results'|lang}</span><img src="{$URL_IMAGES}/icon-jp-country-shape.png" alt=""></h2>
        <div class="testimonial-slider">
            <div class="testimonial-slider__pagination"></div>
            <div class="testimonial-slider__container swiper-container">
                <div class="swiper-wrapper">
                    {foreach key=k item=adver from=$arrListAdver}
                    <div class="swiper-slide">
                        <div class="testimonial">
                            <div class="testimonial__avatar"><img src="{$URL_UPLOADS}/{$adver.image}" alt="" />
                            </div>
                            <div class="testimonial__body">
                                <div class="media align-items-center mb-3"><img class="testimonial__icon" src="{$URL_IMAGES}/icon-double-quote-open.png" alt="" />
                                    <div class="media-body">
                                        <div class="testimonial__name">{$adver.title}</div>
                                        <div class="testimonial__addr">{$adver.occupations}</div>
                                    </div>
                                </div>
                                <div class="text-italic">“ {$adver.des|htmlDecode|strip_tags|truncate:650:"..."}. ”</div>
                            </div>
                        </div>
                    </div>
                    {/foreach}
                </div>
            </div>
        </div>
    </div>
</section>
{/if}