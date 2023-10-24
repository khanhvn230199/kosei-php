<?php
/* Smarty version 3.1.32, created on 2023-02-09 18:17:05
  from '/var/www/koseionline/data/www/koseionline.vn/admin/templates/settings/act_seosetting.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_63e4d631e44571_64891674',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd7294e24a9eff7ae60ef040c829afe6f18c8c4a8' => 
    array (
      0 => '/var/www/koseionline/data/www/koseionline.vn/admin/templates/settings/act_seosetting.html',
      1 => 1616483394,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_63e4d631e44571_64891674 (Smarty_Internal_Template $_smarty_tpl) {
echo $_smarty_tpl->tpl_vars['clsForm']->value->showJS();?>

<div class="inner_head_title">
<table cellpadding="0" cellspacing="0" width="100%" border="0">
<tr style="background:#FBFBFB">
	<td width="55px" style="padding:5px;">
	<a href="?mod=<?php echo $_smarty_tpl->tpl_vars['mod']->value;?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['ADMIN_URL_IMAGES']->value;?>
/largeicon/settingseo.png" border="0"/></a>
	</td>
	<td>
	<span class="title1"><?php echo $_smarty_tpl->tpl_vars['core']->value->getLang("SEOSettings");?>
</span><br />
	<span class="title2"><?php echo $_smarty_tpl->tpl_vars['core']->value->getLang("SEOSettings");?>
 (<?php echo $_smarty_tpl->tpl_vars['lang_code_name']->value;?>
)</span>
	</td>
	<td style="padding:5px;" align="right">
			<?php echo $_smarty_tpl->tpl_vars['clsButtonNav']->value->render();?>
		
	</td>
</tr>
</table>
</div>
<form name="theForm" action="" method="post" id="theForm">
<table width="100%" border="0">
<tr>
<td style="padding:10px" colspan="4">
	<div style="padding-bottom:5px;font-size:14px; float:left">
	<strong><?php echo $_smarty_tpl->tpl_vars['core']->value->getLang("SEOSettings");?>
</strong>
	</div>
	<div style="float:right;font-size:12px; width:30%; color:blue" align="right">
	Ngôn ngữ: <?php echo $_smarty_tpl->tpl_vars['lang_code_name']->value;?>

	</div>
</td>
</tr>
<tr>
<td style="padding:0px 10px" width="100%" valign="top">
	<table cellpadding="0" cellspacing="0" width="100%" border="0" class="girdtable">
	<tr>
		<td colspan="2" class="gridheader1"><?php echo $_smarty_tpl->tpl_vars['core']->value->getLang("InputCorrectlyAllBelowFields");?>
</td>
	</tr>
	<tr>
		<td class="gridrow" width="40%"> <?php echo $_smarty_tpl->tpl_vars['core']->value->getLang("EnableURLRewriting");?>
</td>
		<td class="gridrow1">
		<?php echo $_smarty_tpl->tpl_vars['clsForm']->value->showInput("enable_urlrewrite");?>

		</td>
	</tr>
	<tr>
		<td class="gridrow">Tiêu đề site</td>
		<td class="gridrow1">
		<?php echo $_smarty_tpl->tpl_vars['clsForm']->value->showInput("site_title");?>

		</td>
	</tr>
	<tr>
		<td class="gridrow">Thẻ Meta-Description</td>
		<td class="gridrow1">
		<?php echo $_smarty_tpl->tpl_vars['clsForm']->value->showInput("site_description");?>

		</td>
	</tr>
	<tr>
		<td class="gridrow">Thẻ Meta-Keywords</td>
		<td class="gridrow1">
		<?php echo $_smarty_tpl->tpl_vars['clsForm']->value->showInput("meta_keywords");?>

		</td>
	</tr>
	<tr>
		<td class="gridrow2" width="40%"> Cho phép nối "Tiêu đề Site" vào tiêu đề các trang trong</td>
		<td class="gridrow3">
		<?php echo $_smarty_tpl->tpl_vars['clsForm']->value->showInput("seo_configs[allow_append]");?>

		</td>
	</tr>
	</table>
	<em><font style="font-size:10px"><?php echo $_smarty_tpl->tpl_vars['core']->value->getLang("Note");?>
: * <?php echo $_smarty_tpl->tpl_vars['core']->value->getLang("isrequired");?>
</font></em>
</td>
</tr>
</table>
</form><?php }
}
