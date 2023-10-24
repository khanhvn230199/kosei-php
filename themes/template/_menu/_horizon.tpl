<nav class="navbar navbar-default navbar-sticky awesomenav">
  <!-- Start Top Search -->
   <div class="top-search">
       <div class="container-fluid">
           <div class="input-group">
               <span class="input-group-addon"><i class="fa fa-search"></i></span>
               <input type="text" class="form-control" placeholder="Search">
               <span class="input-group-addon close-search"><i class="fa fa-times"></i></span>
           </div>
       </div>
   </div>
   <!-- End Top Search -->
   <div class="container-fluid">  
       
       <!-- Start Atribute Navigation -->
       <div class="attr-nav">
           <ul>
              	<li class="search"><a href="#"><i class="fa fa-search"></i></a></li>
               <li class="dropdown">
                   <a href="{$core->callfunc('url_cart')}" class="dropdown-toggle" data-toggle="dropdown" >
                       <i class="fa fa-shopping-bag"></i>
                       <span class="badge" id="totalItemInCart">{$cart_totalQuantity}</span>
                   </a>
                   <ul class="dropdown-menu cart-list">
                   	{if $cart_totalQuantity>0}
                   		{foreach key=k item=item from=$arrListCartItem}
                    	{math equation="x*y" x=$item->quantity y=$item->price assign=sumprice}
                       	<li>
                           <a href="#" class="photo" title="{$item->name}"><img width="32" height="32" src="{$URL_UPLOADS}/{$item->image}" alt="{$item->name}" onerror="this.src='{$URL_UPLOADS}/nopic.jpg'"></a>
                           <h6 style="line-height:140%"><a href="#" title="{$item->name}">{$item->name|truncate:50:'...':false}</a></h6>
                           <p>{$item->quantity}x - {$sumprice|number_format}</p>
                       	</li>
                       	{/foreach}
                    {/if}       
                       <li class="total">
                           <span class="pull-right price-color"><strong id="totalPriceInCart">{$cart_totalPrice|number_format}</strong> ₫</span>
                           <a href="{$core->callfunc('url_cart')}" class="btn btn-default btn-cart">Giỏ hàng</a>
                       </li>
                   </ul>
               </li>
               <li class="side-menu"><a href="#"><i class="fa fa-bars"></i></a></li>
           </ul>
       </div>        
       <!-- End Atribute Navigation -->


       <!-- Start Header Navigation -->
       <div class="navbar-header">
           <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
               <i class="fa fa-bars"></i>
           </button>
           <a class="navbar-brand" href="{$VNCMS_URL}" title="{$_CONFIG.site_title}"><img src="{$URL_IMAGES}/logo.png" class="logo" alt="{$_CONFIG.site_title}"></a>
       </div>
       <!-- End Header Navigation -->

       <!-- Collect the nav links, forms, and other content for toggling -->
       <div class="collapse navbar-collapse" id="navbar-menu">
           <ul class="nav navbar-nav navbar-center" data-in="fadeInDown" data-out="fadeOutUp">
				{foreach key=i item=menu from=$arrListMenu}
				{assign var=menu_id value=$menu.menu_id}
				{assign var=children value=$menu.children}
				<li id="menu-item-{$i}" class="{if $menu.total_children>0 &&  $menu.is_megamenu==1}dropdown megamenu-fw{else}dropdown{/if}">
					<a class="{if $menu.total_children>0}dropdown-toggle{/if}" title="{$menu.title}" href="{$menu.href}" onclick="setMenuClicked({$i+1});">{$menu.title}</a>
					{if $menu.total_children>0}
					<ul class="{if $menu.is_megamenu==1}dropdown-menu megamenu-content{else}dropdown-menu{/if}" role="menu">
						{foreach key=j item=menu1 from=$children}
						{assign var=children1 value=$menu1.children}
						<li>
							<a href="{$menu1.href}"  onclick="setMenuClicked({$i+1});">{$menu1.title}</a>
							{if $menu1.total_children>0}
							<ul role="menu">
								{foreach key=k item=menu2 from=$children1}
								{assign var=children2 value=$menu2.children}
								<li>
									<a href="{$menu2.href}"  onclick="setMenuClicked({$i+1});">{$menu2.title}</a>
									{if $menu2.total_children>0}
									<ul role="menu">
										{foreach key=l item=menu3 from=$children2}
										<li><a href="{$menu3.href}"  onclick="setMenuClicked({$i+1});">{$menu3.title}</a></li>
										{/foreach}
									</ul>
									{/if}
								</li>
								{/foreach}
							</ul>
							{/if}
						</li>
						{/foreach}
					</ul>
					{/if}
				</li>
				{/foreach}               
           </ul>
       </div><!-- /.navbar-collapse -->
   </div> 
   
   <!-- Start Side Menu -->
<div class="side">
	<a href="#" class="close-side"><i class="fa fa-times"></i></a>
	<div class="widget">
		<h6 class="title">Shop làm đẹp</h6>
		<ul class="link link-right-sidebar">
			<li><a href="{$core->callfunc('url_account')}">Tài khoản</a></li>
			<li><a href="{$core->callfunc('url_checkout')}">Đặt hàng</a></li>
			<li><a href="{$core->callfunc('url_cart')}">Giỏ hàng</a></li>
			<li><a href="">FAQ</a></li>
			<li><a href="">Chính sách</a></li>
		</ul>
	</div>
</div>
<!-- End Side Menu -->

</nav>