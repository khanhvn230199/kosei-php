<section class="aside-2 mb-20 position-relative" style="z-index: 30">
    <h2 class="aside-2__title">{$curCat.name}</h2>
    <div class="aside-2__body py-3 text-center">
         {if $isLogin ne 1}
         <a class="button" href=".md-login" data-toggle="modal" >MUA KHÓA HỌC NÀY</a>
         {else}
        <a class="button js-show-tab" href="#detail-tab-2">MUA KHÓA HỌC NÀY</a>
        {/if}

    </div>
</section>