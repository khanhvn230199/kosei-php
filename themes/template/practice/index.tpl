{if $sub ne "default"}
	{if $core->template_exists("$mod/$sub.default.tpl")}
		{if $act ne "default"}
			{if $core->template_exists("$mod/$sub.$act.tpl")}
				{include file="$mod/$sub.$act.tpl"}
			{else}
				{assign var=content value="Action File not Found!"}
				{include file="notfound.tpl"}
			{/if}
		{else}	
			{include file="$mod/$sub.default.tpl"}
		{/if}				
	{else}
		{assign var=content value="Sub Module File not Found!"}
		{include file="notfound.tpl"}
	{/if}
{else}
	{if $act ne "default"}
		{if $core->template_exists("$mod/act_$act.tpl")}
			{include file="$mod/act_$act.tpl"}
		{else}
			{assign var=content value="Action File not Found!"}
			{include file="notfound.tpl"}
		{/if}
	{else}
		{include file="$mod/act_default.tpl"}
	{/if}
{/if}