<?php
/* Smarty version 3.1.32, created on 2023-10-23 10:53:47
  from '/var/www/koseionline/data/www/koseionline.vn/admin/templates/settings/act_default.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_6535ee4bc6b486_76725931',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1b3c92239002f9eff1fc29bd663fd6e4bdf7c8d8' => 
    array (
      0 => '/var/www/koseionline/data/www/koseionline.vn/admin/templates/settings/act_default.html',
      1 => 1670384086,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6535ee4bc6b486_76725931 (Smarty_Internal_Template $_smarty_tpl) {
?><table cellpadding="0" cellspacing="0" width="100%" border="0">
<tr style="background:#FBFBFB">
<td width="55px" style="border-bottom:1px #CCCCCC solid;">
<div style="padding:3px"><a href="?mod=<?php echo $_smarty_tpl->tpl_vars['mod']->value;?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['ADMIN_URL_IMAGES']->value;?>
/largeicon/config.png" border="0"/></a></div>
</td>
<td style="color:#990000;border-bottom:1px #CCCCCC solid;">
<font style="font-size:24px;"><b><?php echo mb_strtoupper($_smarty_tpl->tpl_vars['clsDataGrid']->value->getTitle(), 'UTF-8');?>
</b></font><br />
<font style="font-size:9px"><i><?php if ($_smarty_tpl->tpl_vars['_LANG_ID']->value != "vn") {
echo $_smarty_tpl->tpl_vars['clsDataGrid']->value->getTitle();?>
 <?php echo $_smarty_tpl->tpl_vars['core']->value->getLang("Management");
} else {
echo $_smarty_tpl->tpl_vars['core']->value->getLang("Management");?>
 <?php echo $_smarty_tpl->tpl_vars['clsDataGrid']->value->getTitle();
}?></i></font>
</td>
<td style="padding-right:10px; border-bottom:1px #CCCCCC solid;" align="right">
<div>
	<table cellpadding="2px" border="0">
	<tr>
		<?php echo $_smarty_tpl->tpl_vars['clsButtonNav']->value->render();?>
		
	</tr>
	</table>
</div>
</td>
</tr>
</table>
<form name="theForm" action="" method="post">
<table width="100%" border="0">
<tr>
<td style="padding-left:10px;padding-right:10px">
	<div style="padding-bottom:5px;font-size:14px">
	<strong><?php echo $_smarty_tpl->tpl_vars['core']->value->getLang("ListOf");?>
 <?php echo $_smarty_tpl->tpl_vars['clsDataGrid']->value->getTitle();?>
</strong>
	</div>
</td>
</tr>
<tr>
<td style="padding-left:10px;padding-right:10px" width="100%" valign="top">
	<?php echo $_smarty_tpl->tpl_vars['clsDataGrid']->value->showDataGrid("theForm");?>


	
</td>
</tr>
<tr>
<td  style="padding-left:10px;padding-right:10px">
	<?php echo $_smarty_tpl->tpl_vars['clsDataGrid']->value->showPaging("theForm");?>

</td>
</tr>
</table>
</form>
<?php }
}
