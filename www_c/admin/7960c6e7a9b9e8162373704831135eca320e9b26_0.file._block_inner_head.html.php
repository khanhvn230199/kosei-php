<?php
/* Smarty version 3.1.32, created on 2021-06-08 14:17:47
  from '/var/www/koseionline.vn/data/www/koseionline.vn/admin/templates/_block_inner_head.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_60bf199bad31c3_03027129',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7960c6e7a9b9e8162373704831135eca320e9b26' => 
    array (
      0 => '/var/www/koseionline.vn/data/www/koseionline.vn/admin/templates/_block_inner_head.html',
      1 => 1616482970,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60bf199bad31c3_03027129 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="inner_head_title">
	<div class="container-fluid">
  		<div class="row mt-1">
  			<div class="col-sm">
  				<?php if ($_smarty_tpl->tpl_vars['clsCP']->value->getImgSrc() != '') {?>
  				<a href="?mod=<?php echo $_smarty_tpl->tpl_vars['mod']->value;?>
" class="float-left float-md-left text-center text-md-left mr-1"><img src="<?php echo $_smarty_tpl->tpl_vars['clsCP']->value->getImgSrc();?>
" border="0"/></a>
  				<?php }?>
  				<span class="title1"><?php if ($_smarty_tpl->tpl_vars['_LANG_ID']->value != "vn") {
echo $_smarty_tpl->tpl_vars['clsDataGrid']->value->getTitle();
} else {
echo $_smarty_tpl->tpl_vars['clsDataGrid']->value->getTitle();
}?></span><br />
				<span class="title2"><?php if ($_smarty_tpl->tpl_vars['_LANG_ID']->value != "vn") {
echo $_smarty_tpl->tpl_vars['clsDataGrid']->value->getTitle();?>
 <?php echo $_smarty_tpl->tpl_vars['core']->value->getLang("Management");
} else {
echo $_smarty_tpl->tpl_vars['core']->value->getLang("Management");?>
 <?php echo $_smarty_tpl->tpl_vars['clsDataGrid']->value->getTitle();
}?> (<?php echo $_smarty_tpl->tpl_vars['lang_code_name']->value;?>
)</span>
  			</div>
  			<div class="col-sm text-center text-md-right align-middle">
  				<div class="mt-2 mb-1">
  				<?php echo $_smarty_tpl->tpl_vars['clsButtonNav']->value->render();?>

  				</div>
  			</div>
  		</div>
  	</div>
</div><?php }
}
