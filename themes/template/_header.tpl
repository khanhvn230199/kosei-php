<header class="header">
    <div class="header__sticky">
        <div class="container">
            <div class="header__inner">
                <a class="header__logo" href="/"><img src="{$URL_IMAGES}/logo.png" alt="" /></a>
                <nav class="h-nav">
                    <a href="#!" class="h-nav__toggle">
                        <i class="fa fa-user-circle-o mr-2"></i>
                        <span>Tài khoản</span>
                        <i class="fa fa-caret-down ml-2"></i>
                    </a>
                    <div class="h-nav__dropdown">
                        {if $isLogin ne 1}
                        <a class="h-nav__item" href="{$VNCMS_URL}/register" onclick="deletetMenuClicked();">
                            <i class="fa fa-pencil-square-o fa-fw"></i>
                            <span class="ml-2">{'Register'|lang}</span>
                        </a>
                        <a class="h-nav__item" href=".md-login" data-toggle="modal">
                            <i class="fa fa-lock fa-fw"></i>
                            <span class="ml-2">{'Login'|lang}</span>
                        </a>
                        {else}
                        <a class="h-nav__item" href="{$Rewrite->url_account()}" onclick="deletetMenuClicked();">
                            <i class="fa fa-user-circle-o fa-fw"></i>
                            <span class="ml-2">{if $core->_USER.fullname}{$core->_USER.fullname}{else}{'Account'|lang}{/if}</span>
                        </a>
                        <a class="h-nav__item" href="{$Rewrite->url_logout()}" onclick="deletetMenuClicked();">
                            <i class="fa fa-sign-out fa-fw"></i>
                            <span class="ml-2">{'Logout'|lang}</span>
                        </a>
                        {/if}
                    </div>
                </nav>
                <button class="navbar-mobile-btn d-xl-none" data-toggle="button"><i class="fa fa-bars"></i></button>
                <div class="navbar-backdrop"></div>
                <div class="navbar navbar-mobile navbar-expand-xl">
                    <div class="navbar-header">
                        <div class="navbar-title">Menu</div>
                        <button class="navbar-close" type="button" data-dismiss="modal"><i class="fa fa-arrow-left"></i></button>
                    </div>
                    {include file="_nav.tpl"}
                    <ul class="h-links">
                        {foreach from=$arrListTopMenu key=m item=menu}
                        <!-- Người dùng đăng nhập thanh toán mới hiển thị menu giáo trình -->
                        {if $isLogin eq 1}
                        {if $m eq 0}
                        <li class="h-links__item">
                            <a class="h-links__link" href="{$menu.href}" onclick="deletetMenuClicked();">
                                {if $menu.image}
                                <img class="w-100 fw mr-1" src="{$VNCMS_URL}/img.php?pic={$core->callfunc('base64_encode', $menu.image)}&w=15&h=14&encode=1" onerror="this.src='{$URL_IMAGES}/nopic.png'" alt="{$menu.title}">
                                {else}
                                <i class="fa {if $menu.icon}{$menu.icon}{else}fa-money{/if} fa fw mr-1"></i>
                                {/if}
                                <span>{$menu.title}</span>
                            </a>
                        </li>
                        {/if}
                        {/if}
                        <!-- End -->
                        {if $m > 0}
                        <li class="h-links__item">
                            <a class="h-links__link" href="{$menu.href}" onclick="deletetMenuClicked();">
                                {if $menu.image}
                                <img class="w-100 fw mr-1" src="{$VNCMS_URL}/img.php?pic={$core->callfunc('base64_encode', $menu.image)}&w=15&h=14&encode=1" onerror="this.src='{$URL_IMAGES}/nopic.png'" alt="{$menu.title}">
                                {else}
                                <i class="fa {if $menu.icon}{$menu.icon}{else}fa-money{/if} fa fw mr-1"></i>
                                {/if}
                                <span>{$menu.title}</span>
                            </a>
                        </li>
                        {/if}
                        {/foreach}
                        {if $isLogin ne 1}
                        <li class="h-links__item  h-links__item--desktop">
                            <a class="h-links__link" href="{$VNCMS_URL}/register" onclick="deletetMenuClicked();">
                                <i class="fa fa-pencil-square-o fa fw mr-1"></i>
                                <span>{'Register'|lang}</span>
                            </a>
                        </li>
                        <li class="h-links__item  h-links__item--desktop">
                            <a class="h-links__link bg-primary" href=".md-login" data-toggle="modal">
                                <i class="fa fa-lock fa fw mr-1"></i>
                                <span>{'Login'|lang}</span>
                            </a>
                        </li>
                        {else}
                        <li class="h-links__item h-links__item--desktop">
                            <a class="h-links__link bg-primary" href="{$Rewrite->url_account()}" onclick="deletetMenuClicked();">
                                <i class="fa fa-user-circle-o fa fw mr-1"></i>
                                <span>{if $core->_USER.fullname}{$core->_USER.fullname}{else}{'Account'|lang}{/if}</span>
                            </a>
                        </li>
                        <li class="h-links__item h-links__item--desktop">
                            <a class="h-links__link" href="{$Rewrite->url_logout()}" onclick="deletetMenuClicked();">
                                <i class="fa fa-sign-out fa fw mr-1"></i>
                                <span>{'Logout'|lang}</span>
                            </a>
                        </li>
                        {/if}
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>