<?php
/* Smarty version 3.1.32, created on 2023-05-19 09:57:18
  from '/var/www/koseionline/data/www/koseionline.vn/admin/templates/_block_inner_head_add.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_6466e58ed079a8_97060961',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'edb981459b16b811c146bdbc9c350ee3b1984e50' => 
    array (
      0 => '/var/www/koseionline/data/www/koseionline.vn/admin/templates/_block_inner_head_add.html',
      1 => 1670384055,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6466e58ed079a8_97060961 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="inner_head_title">
	<div class="container-fluid">
  		<div class="row mt-1">
  			<div class="col-sm">
  				<?php if ($_smarty_tpl->tpl_vars['clsCP']->value->getImgSrc() != '') {?>
  				<a href="?mod=<?php echo $_smarty_tpl->tpl_vars['mod']->value;?>
" class="float-left mr-1"><img src="<?php echo $_smarty_tpl->tpl_vars['clsCP']->value->getImgSrc();?>
" border="0" align=''/></a>
  				<?php }?>
  				<span class="title1"><?php if ($_smarty_tpl->tpl_vars['_LANG_ID']->value != "vn") {
echo $_smarty_tpl->tpl_vars['clsForm']->value->getTitle();
} else {
echo $_smarty_tpl->tpl_vars['clsForm']->value->getTitle();
}?></span><br />
				<span class="title2"><?php if ($_smarty_tpl->tpl_vars['_LANG_ID']->value != "vn") {
echo $_smarty_tpl->tpl_vars['clsForm']->value->getTitle();?>
 <?php echo $_smarty_tpl->tpl_vars['core']->value->getLang("Management");
} else {
echo $_smarty_tpl->tpl_vars['core']->value->getLang("Management");?>
 <?php echo $_smarty_tpl->tpl_vars['clsForm']->value->getTitle();
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
