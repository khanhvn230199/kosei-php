<div class="as-card">
    <ul class="as-info nav flex-column">
        <li>
            {assign var="from" value=strtotime('+3 day')|date_format:"%d-%m-%Y"}
            {assign var="to" value=strtotime('+5 day')|date_format:"%d-%m-%Y"}
            <img src="{$URL_IMAGES}/icon-people-checker.png" alt="checker">
            <span>{'The_product_is_expected_to_deliver_to_your_address_at_approximately_to_If_you_pay_today'|lang|replace:"%f":$from|replace:"%t":$to}</span>
        </li>
        <li>
            <img src="{$URL_IMAGES}/icon-balance.png" alt="compare">
            <span>{'You_want_to_compare_with_other_products'|lang}</span>
            <a class="as-info__link" href="javascript:addToCompare({$arrOneProduct.product_id});" onclick="showListCompare(this);" data-toid="#list-compare">{'Add_to_compare'|lang} >></a>
        </li>
    </ul>
</div>
<div class="as-card">
    <ul class="as-contact nav flex-column">
        <li>
            <img src="{$URL_IMAGES}/icon-phone.png" alt="Hotline">
            <span>Hotline: {$_CONFIG.hotline}</span>
        </li>
        <li>
            <img src="{$URL_IMAGES}/icon-envelope.png" alt="Email">
            <span>Email: {$_CONFIG.webmaster_email}</span>
        </li>
    </ul>
</div>
<div class="as-card card">
    <div class="card-header">{'Technical_assistance'|lang}</div>
    <form class="as-support">
        <div class="form-group required">
            <input class="form-control" type="text" placeholder="Email">
        </div>
        <div class="form-group required">
            <input class="form-control" type="text" placeholder="{'Phone'|lang}">
        </div>
        <div class="form-group">
            <textarea class="form-control" rows="3" placeholder="{'Content'|lang}"></textarea>
        </div>
        <div class="text-center py-3">
            <button class="btn btn-md btn-gradient btn-cirlce font-weight-bold" type="submit">{'Send_request'|lang}</button>
        </div>
    </form>
</div>
{if $arrListOtherProducts}
    <div class="as-card card">
        <div class="card-header">{'Related_products'|lang}</div>
        <div class="as-slider pb-10" style="margin: 0 -10px;">
            <div class="swiper-container js-aside-slider">
                <div class="swiper-wrapper">
                    {foreach from=$arrListOtherProducts key=p item=product}
                        <div class="swiper-slide px-10">
                            <div class="product">
                                {if $product.start_date <= $smarty.now && $product.end_date >= $smarty.now && $product.is_start eq 1}
                                    {if $product.discount_type eq 1}
                                        {math assign='km' equation='((x-y)/x)*100' x=$product.price y=$product.discount_value}
                                        <span class="product__saleoff">
                                            <span>-{$km|ceil}%</span>
                                        </span>
                                    {else}
                                        <span class="product__saleoff">
                                            <span>-{$product.discount_value}%</span>
                                        </span>
                                    {/if}
                                {/if}
                                <div class="product__container card border-0">
                                    {if $product.start_date <= $smarty.now && $product.end_date >= $smarty.now && $product.is_start eq 1}
                                        <div class="product__timeout js-deadline" data-deadline="{$product.end_date|date_format:"%Y,%m,%d %H:%M:%S"}">
                                            <span>0 : 0 : 0</span>
                                        </div>
                                    {/if}
                                    <a class="product__iwrap img-shine"
                                       href="{$Rewrite->url_product($product)}">
                                        <img src="{$VNCMS_URL}/img.php?pic={$core->callfunc('base64_encode', $product.image)}&w=95&h=125&encode=1" onerror="this.src='{$URL_IMAGES}/nopic.png'" alt="{$product.name}"/>
                                    </a>
                                    <div class="product__state">
                                        <div class="product__comment">
                                            <div class="product__star"></div>
                                            <span>{if $comments}{$comments}{else}0{/if} comments</span>
                                        </div>
                                        <div class="product__like">
                                            <img src="{$URL_IMAGES}/icon-heart.png" alt="like" />
                                            <span>{if $like}{$like}{else}0{/if} like</span>
                                        </div>
                                    </div>
                                    <div class="product__title max-line-2">
                                        <a class="link-unstyled" href="{$Rewrite->url_product($product)}"
                                           title="{$product.name}">{$product.name}</a>
                                    </div>
                                    <div class="product__price">
                                        {if $product.start_date <= $smarty.now && $product.end_date >= $smarty.now && $product.is_start eq 1}
                                            <del>{$core->callfunc("number_format", $product.price, 0, ',', '.')}<sup>đ</sup></del>
                                            <span>
                                                {if $product.discount_type eq 1}
                                                    {$core->callfunc("number_format", $product.discount_value, 0, ',', '.')}
                                                {else}
                                                    {math assign='discount' equation='x-((x*y)/100)' x=$product.price y=$product.discount_value}
                                                    {$core->callfunc("number_format", $discount, 0, ',', '.')}
                                                {/if}
                                                <sup>đ</sup>
                                            </span>
                                        {else}
                                            <span>{if $product.price > 0}{$core->callfunc("number_format", $product.price, 0, ',', '.')}<sup>đ</sup>{else}{'Contact'|lang}{/if}</span>
                                        {/if}
                                    </div>
                                    <div class="product__note">* {'Package_price_to_Vietnam'|lang}</div>
                                </div>
                            </div>
                        </div>
                    {/foreach}
                </div>
            </div>
            <div class="d-flex justify-content-center" style="margin-top: -10px;">
                <div class="mx-10 js-aside-slider-prev" style="outline: none !important;">
                    <img src="{$URL_IMAGES}/icon-chevron-circle-left.png" alt="">
                </div>
                <div class="mx-10 js-aside-slider-next" style="outline: none !important;">
                    <img src="{$URL_IMAGES}/icon-chevron-circle-right.png" alt="">
                </div>
            </div>
        </div>
    </div>
{/if}