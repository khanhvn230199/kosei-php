<ul class="menu">
    <li class="menu__item">
        <a class="menu__link" href="{$VNCMS_URL}">{'Home'|lang}</a>
    </li>
    {foreach from=$arrListMainMenu key=m item=menu}
    <li class="menu__item {if $menu.children}menu__dropdown{/if}">
        <a class="menu__link" href="{$menu.href}">{$menu.title}</a>
        <ul class="menu__sub">
            {if $menu.children}
            {foreach from=$menu.children key=c1 item=children}
            <li class="menu__sub-item">
                <a class="menu__sub-link" href="{$children.href}">{$children2.title}</a>
            </li>
            {/foreach}
            {/if}
        </ul>
    </li>
    {/foreach}
</ul>
