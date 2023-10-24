<ul class="navbar-nav">
	{foreach key=i item=menu from=$arrListMenu}
	{assign var=menu_id value=$menu.menu_id}
	{assign var=children value=$menu.children}
    <li class="nav-item {if $menu.total_children>0}dropdown h-dropdown{/if}">
        <a id="menu-item-{$i+1}" class="nav-link {if $menu.total_children>0}dropdown-toggle{/if}" title="{$menu.title}" href="{$menu.href}" onclick="setMenuClicked({$i+1});">{$menu.title}</a>
        {if $menu.total_children>0}
        <div class="dropdown-menu h-dropdown__menu">
        	{foreach key=j item=menu1 from=$children}
			{assign var=children1 value=$menu1.children}
            <a class="dropdown-item" href="{$menu1.href}" onclick="setMenuClicked({$i+1});">{$menu1.title}</a>
            {/foreach}            
        </div>
        {/if}
    </li>
    {/foreach}
</ul>