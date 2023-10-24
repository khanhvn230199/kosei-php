{if $arrListAdver}
	 <section class="home-intro mb-50">
		 <div class="container">
			 <div class="home-intro__panel">
				 <h2 class="home-intro__title">
					 <a class="link-unstyled" href="{$VNCMS_URL}">{'Shopping_experience_limited_only_at_TheSafe'|lang}</a>
				 </h2>
				 <div class="row gutter-20">
					 {foreach from=$arrListAdver key=a item=adver}
						 {if $a < 4}
							 <div class="col-lg-3 col-sm-6">
								 <div class="pros">
									 <div class="pros__iwrap">
										 <img src="{$URL_UPLOADS}/{$adver.image}" onerror="this.src='{$URL_IMAGES}/nopic.png'" alt="{$adver.title}">
									 </div>
									 <a href="{$adver.link}" class="link-unstyled"><h3 class="pros__title">{$adver.title}</h3></a>
									 <div class="pros__desc">
										 {$adver.des|htmlDecode|strip_tags}
									 </div>
								 </div>
							 </div>
						 {/if}
					 {/foreach}
				 </div>
			 </div>
		 </div>
	 </section>
 {else}
	 <div class="mb-50"></div>
 {/if}