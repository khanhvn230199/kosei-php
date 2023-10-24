<?php
/* Smarty version 3.1.32, created on 2023-09-14 15:31:59
  from '/var/www/koseionline/data/www/koseionline.vn/admin/templates/settings/act_catsetting3.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_6502c4ff4d5433_07956126',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '02e15c336bda6e9f8934c89e3a4dbfe2a962b142' => 
    array (
      0 => '/var/www/koseionline/data/www/koseionline.vn/admin/templates/settings/act_catsetting3.html',
      1 => 1694680317,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6502c4ff4d5433_07956126 (Smarty_Internal_Template $_smarty_tpl) {
echo $_smarty_tpl->tpl_vars['clsForm']->value->showJS();?>

<div class="inner_head_title">
<table cellpadding="0" cellspacing="0" width="100%" border="0">
<tr style="background:#FBFBFB">
	<td width="55px" style="padding:5px;">
		<a href="?mod=<?php echo $_smarty_tpl->tpl_vars['mod']->value;?>
&act=<?php echo $_smarty_tpl->tpl_vars['act']->value;?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['ADMIN_URL_IMAGES']->value;?>
/largeicon/configfront.png" border="0"/></a>
	</td>
	<td>
		<span class="title1"><?php echo $_smarty_tpl->tpl_vars['core']->value->getLang("FrontEndSettings");?>
</span><br />
		<span class="title2"><?php echo $_smarty_tpl->tpl_vars['core']->value->getLang("FrontEndSettings");?>
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
<td style="padding:10px">
	<div style="padding-bottom:3px;font-size:14px; border-bottom:1px solid #999999; padding-left:5px;">
		<a class="btn-tab " href="?mod=settings&act=catsetting">Cấu hình Trang chủ</a>
		<a class="btn-tab " href="?mod=settings&act=catsetting2">Cấu hình Thanh toán</a>
		<a class="btn-tab active" href="?mod=settings&act=catsetting3">Liên kết MXH</a>
		<div style="float:right;font-size:12px; width:30%; color:blue" align="right">
		Ngôn ngữ: <?php echo $_smarty_tpl->tpl_vars['lang_code_name']->value;?>

		</div>
	</div>
</td>
</tr>
<tr>
<td style="padding:0px 10px" width="100%" valign="top">
	<table cellpadding="0" cellspacing="0" width="100%" border="0" class="girdtable">
	<tr>
		<td class="gridrow" width="30%">Link YouTube</td>
		<td class="gridrow1"><?php echo $_smarty_tpl->tpl_vars['clsForm']->value->showInput("cat_id3[youtube]");?>
</td>
	</tr>	
	<tr>
		<td class="gridrow">Link RSS</td>
		<td class="gridrow1"><?php echo $_smarty_tpl->tpl_vars['clsForm']->value->showInput("cat_id3[rss]");?>
</td>
	</tr>	
	<tr>
		<td class="gridrow">Link Twitter</td>
		<td class="gridrow1"><?php echo $_smarty_tpl->tpl_vars['clsForm']->value->showInput("cat_id3[twitter]");?>
</td>
	</tr>	
	<tr>
		<td class="gridrow">Link Facebook Fanpage</td>
		<td class="gridrow1"><?php echo $_smarty_tpl->tpl_vars['clsForm']->value->showInput("cat_id3[facebook]");?>
</td>
	</tr>
	<tr>
		<td class="gridrow">Link Google+</td>
		<td class="gridrow1"><?php echo $_smarty_tpl->tpl_vars['clsForm']->value->showInput("cat_id3[googleplus]");?>
</td>
	</tr>
	<tr>
		<td class="gridrow">Link zalo</td>
		<td class="gridrow1"><?php echo $_smarty_tpl->tpl_vars['clsForm']->value->showInput("cat_id3[zalo]");?>
</td>
	</tr>
	</table>
</td>
</tr>
</table>
</form><?php }
}
