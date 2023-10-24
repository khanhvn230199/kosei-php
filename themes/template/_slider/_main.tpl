{if $arrListSlider}
<div class="banner-slider">
    <!-- <img class="banner-slider__bg" src="{$URL_IMAGES}/banner-home.jpg" alt="" /> -->
    <div class="banner-slider__container swiper-container">
        <div class="swiper-wrapper">
            {foreach from=$arrListSlider key=k item=slider}
            <div class="swiper-slide">
                <div class="banner">
                    <img src="{$URL_UPLOADS}/{$slider.image}" alt="" />
                </div>
            </div>
            {/foreach}
        </div>
    </div>
</div>
{/if}