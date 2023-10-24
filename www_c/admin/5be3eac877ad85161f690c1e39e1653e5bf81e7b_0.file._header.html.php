<?php
/* Smarty version 3.1.32, created on 2021-06-08 14:17:43
  from '/var/www/koseionline.vn/data/www/koseionline.vn/admin/templates/_header.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_60bf19976ecb14_52625374',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '5be3eac877ad85161f690c1e39e1653e5bf81e7b' => 
    array (
      0 => '/var/www/koseionline.vn/data/www/koseionline.vn/admin/templates/_header.html',
      1 => 1616482970,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60bf19976ecb14_52625374 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/var/www/koseionline.vn/data/www/koseionline.vn/includes/smarty3/plugins/modifier.date_format.php','function'=>'smarty_modifier_date_format',),));
?><nav class="navbar navbar-expand-lg navbar-dark">
  <a class="navbar-brand" href="?">VnCMS3.0</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarColor02">
    <ul class="navbar-nav mr-auto">
		<li class="nav-item <?php if ($_smarty_tpl->tpl_vars['clsCP']->value->getCurrentSection() == '') {?>active<?php }?>">
		  <a class="nav-link" href="?"><img src="<?php echo $_smarty_tpl->tpl_vars['ADMIN_URL_IMAGES']->value;?>
/adm3.png" border="0"> <span class='nav-sname'>Bảng điều khiển</span></a>
		</li>
		<?php echo $_smarty_tpl->tpl_vars['clsCP']->value->showMenuHeader();?>

      	<li class="dropdown">
		  <button class="btn btn-primary btn-sm dropdown-toggle mt-1" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		    <?php echo $_smarty_tpl->tpl_vars['lang_code_name']->value;?>

		  </button>
		  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
		  	<h6 class="dropdown-header pl-2 text-muted"><?php echo $_smarty_tpl->tpl_vars['core']->value->getLang("Data_language");?>
</h6>
		    <a class="dropdown-item <?php if ($_smarty_tpl->tpl_vars['lang_code']->value == 'jp') {?>active<?php }?>" href="#" onclick="return changeLanguageData('jp');">Tiếng nhật</a>
		    <a class="dropdown-item <?php if ($_smarty_tpl->tpl_vars['lang_code']->value == 'vn') {?>active<?php }?>" href="#" onclick="return changeLanguageData('vn');">Tiếng Việt</a>
		  </div>		  
		</li>
		<?php if ($_smarty_tpl->tpl_vars['_CONFIG']->value['home_cache'] == 1) {?>
		<li class="nav-item">
			<a class="btn btn-sm btn-primary d-none d-lg-inline-block mt-1 mb-md-0 ml-md-1" href="?clearCache=1" title="Xóa cache trang chủ">Xóa Cache</a>
		</li>
		<?php }?>
		<li class="nav-item">
			<a class="btn btn-sm btn-primary d-none d-lg-inline-block mt-1 mb-md-0 ml-md-1" target="_blank" href="<?php echo $_smarty_tpl->tpl_vars['VNCMS_URL']->value;?>
" title="Xem Trang chủ"><img src="<?php echo $_smarty_tpl->tpl_vars['ADMIN_URL_IMAGES']->value;?>
/house.png" border="0"></a>
		</li>
    </ul>
	<div class="dropdown d-none d-sm-block">
      	<button class="btn btn-sm  btn-light dropdown-toggle" type="button" id="navbarDropdownExit" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
         	<img src="<?php echo $_smarty_tpl->tpl_vars['ADMIN_URL_IMAGES']->value;?>
/icon/user1.png" border="0"> <?php echo $_smarty_tpl->tpl_vars['core']->value->_USER['fullname'];?>
!
        </button>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        	<span class="dropdown-item navbar-text text-secondary">
        	<?php echo $_smarty_tpl->tpl_vars['core']->value->getLang("Last_visit");?>
: <br><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['core']->value->_USER['last_visit'],"%Hh:%M' %m/%d/%Y");?>

  			</span>
          <a class="dropdown-item" href="#" onclick="return logout()"><img src="<?php echo $_smarty_tpl->tpl_vars['ADMIN_URL_IMAGES']->value;?>
/close.png" border="0" style='width:12px; height:12px;'> <?php echo $_smarty_tpl->tpl_vars['core']->value->getLang("Logout");?>
</a>
        </div>
    </div>	
  </div>
</nav>
<form class="form-inline" method="POST" action="" id="fChangeLanguage" style="display:none">
<input name="lang_id" id="lang_id" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['_LANG_ID']->value;?>
">
<input name="lang_code" id="lang_code" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['lang_code']->value;?>
">
</form>
<?php echo '<script'; ?>
>
function changeLanguageData(lang){
	if ($("#lang_code").val()!=lang){
		$("#lang_code").val(lang);
		$("#fChangeLanguage").submit();
	}
	return false;
}
<?php echo '</script'; ?>
><?php }
}
