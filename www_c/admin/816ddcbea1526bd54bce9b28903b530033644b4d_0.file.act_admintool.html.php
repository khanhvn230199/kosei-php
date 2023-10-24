<?php
/* Smarty version 3.1.32, created on 2023-07-11 17:24:13
  from '/var/www/koseionline/data/www/koseionline.vn/admin/templates/settings/act_admintool.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_64ad2dcd42f0e6_04479593',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '816ddcbea1526bd54bce9b28903b530033644b4d' => 
    array (
      0 => '/var/www/koseionline/data/www/koseionline.vn/admin/templates/settings/act_admintool.html',
      1 => 1670384086,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_64ad2dcd42f0e6_04479593 (Smarty_Internal_Template $_smarty_tpl) {
echo '<script'; ?>
>
function save(){
	document.theForm.btnSave.value = "Save";
	document.theForm.submit();
}
<?php echo '</script'; ?>
>


<div class="inner_head_title">
<table cellpadding="0" cellspacing="0" width="100%" border="0">
<tr style="background:#FBFBFB">
	<td width="55px" style="padding:5px;">
	<a href="?mod=<?php echo $_smarty_tpl->tpl_vars['mod']->value;?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['ADMIN_URL_IMAGES']->value;?>
/largeicon/webmaster_tools.png" border="0"/></a>
	</td>
	<td>
	<span class="title1"><?php echo $_smarty_tpl->tpl_vars['core']->value->getLang("WebmasterTools");?>
</span><br />
	<span class="title2"><?php echo $_smarty_tpl->tpl_vars['core']->value->getLang("WebmasterTools");?>
 (<?php echo $_smarty_tpl->tpl_vars['lang_code_name']->value;?>
)</span>
	</td>
	<td style="padding:5px;" align="right">
			<?php echo $_smarty_tpl->tpl_vars['clsButtonNav']->value->render();?>
		
	</td>
</tr>
</table>
</div>
<form name="theForm" action="" method="post">
<table width="100%" border="0">
<tr>
<td style="padding:10px" colspan="4">
	<div style="padding-bottom:5px;font-size:14px; float:left">
	<strong>Nhập các công cụ quản trị, theo dõi website</strong>
	</div>
	<div style="float:right;font-size:12px; width:30%; color:blue" align="right">
	Ngôn ngữ: <?php echo $_smarty_tpl->tpl_vars['lang_code_name']->value;?>

	</div>
</td>
</tr>
<tr>
<td style="padding:0px 10px" width="100%" valign="top">
	<?php echo $_smarty_tpl->tpl_vars['clsForm']->value->showJS();?>

	<table cellpadding="0" cellspacing="0" width="100%" border="0" class="girdtable">
	<tr>
		<td colspan="2" class="gridheader1"><?php echo $_smarty_tpl->tpl_vars['core']->value->getLang("InputCorrectlyAllBelowFields");?>
<Br />
		
		</td>
	</tr>
	<?php if ($_smarty_tpl->tpl_vars['clsForm']->value->isValid != 1) {?>
	<tr>
		<td class="gridrow1" style="color:red; padding:5px" colspan="2">
		<?php echo $_smarty_tpl->tpl_vars['clsForm']->value->showAllError();?>

		</td>
	</tr>
	<?php }?>
	<tr>
		<td class="gridrow" width="30%">Mã JS đặt trong thẻ &lt;head&gt;<small>(VD: mã Tiếp thị lại FB Pixel)</small></td>
		<td class="gridrow1">
		<?php echo $_smarty_tpl->tpl_vars['clsForm']->value->showInput("jscode_head");?>
 
		</td>
	</tr>	
	<tr>
		<td class="gridrow" width="30%">Mã JS đặt ngay sau thẻ mở &lt;body&gt;</td>
		<td class="gridrow1">
		<?php echo $_smarty_tpl->tpl_vars['clsForm']->value->showInput("jscode_openbody");?>
 
		</td>
	</tr>	
	<tr>
		<td class="gridrow" width="30%">Mã Google Analytics</td>
		<td class="gridrow1">
		<?php echo $_smarty_tpl->tpl_vars['clsForm']->value->showInput("google_analytics");?>
 
		</td>
	</tr>	
	<tr>
		<td class="gridrow" width="30%">Mã JS đặt ngay trước thẻ đóng &lt;/body&gt; <small>(VD: mã Tiếp thị lại Adwords)</small></td>
		<td class="gridrow1">
		<?php echo $_smarty_tpl->tpl_vars['clsForm']->value->showInput("jscode_closebody");?>
 
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
