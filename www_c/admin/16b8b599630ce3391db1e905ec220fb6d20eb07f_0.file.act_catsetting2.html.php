<?php
/* Smarty version 3.1.32, created on 2021-06-08 16:57:40
  from '/var/www/koseionline.vn/data/www/koseionline.vn/admin/templates/settings/act_catsetting2.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_60bf3f145b6421_32233358',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '16b8b599630ce3391db1e905ec220fb6d20eb07f' => 
    array (
      0 => '/var/www/koseionline.vn/data/www/koseionline.vn/admin/templates/settings/act_catsetting2.html',
      1 => 1616483394,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60bf3f145b6421_32233358 (Smarty_Internal_Template $_smarty_tpl) {
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
		<a class="btn-tab active" href="?mod=settings&act=catsetting2">Cấu hình Thanh toán</a>
		<a class="btn-tab" href="?mod=settings&act=catsetting3">Liên kết MXH</a>
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
		<td class="gridrow" width="30%">Cấu hình nội dung "Terms & Conditions" trong trang Checkout</td>
		<td class="gridrow1"><?php echo $_smarty_tpl->tpl_vars['clsForm']->value->showInput("payment_terms");?>
</td>
	</tr>
	<tr>
		<td class="gridrow">Tài khoản ngân hàng 1</td>
		<td class="gridrow1"><?php echo $_smarty_tpl->tpl_vars['clsForm']->value->showInput("list_banks_0");?>
</td>
	</tr>
	<tr>
		<td class="gridrow">Tài khoản ngân hàng 2</td>
		<td class="gridrow1"><?php echo $_smarty_tpl->tpl_vars['clsForm']->value->showInput("list_banks_1");?>
</td>
	</tr>
	<tr>
		<td class="gridrow">Tài khoản ngân hàng 3</td>
		<td class="gridrow1"><?php echo $_smarty_tpl->tpl_vars['clsForm']->value->showInput("list_banks_2");?>
</td>
	</tr>
	</table>
</td>
</tr>
</table>
</form><?php }
}
