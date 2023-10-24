<?php
/* Smarty version 3.1.32, created on 2023-10-17 09:54:04
  from '/var/www/koseionline/data/www/koseionline.vn/admin/templates/users/act_export.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_652df74ca3f384_26818540',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '10448ea35a5fa4458c33147a79ee9ac3e0e977ed' => 
    array (
      0 => '/var/www/koseionline/data/www/koseionline.vn/admin/templates/users/act_export.html',
      1 => 1697511213,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_652df74ca3f384_26818540 (Smarty_Internal_Template $_smarty_tpl) {
?><table cellpadding="0" cellspacing="0" width="100%" border="0">
<tr style="background:#FBFBFB">
<td width="55px" style="border-bottom:1px #CCCCCC solid;">
<div style="padding:3px"><a href="?mod=<?php echo $_smarty_tpl->tpl_vars['mod']->value;?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['ADMIN_URL_IMAGES']->value;?>
/largeicon/excel.png" border="0"/></a></div>
</td>
<td style="color:#990000;border-bottom:1px #CCCCCC solid;">
<font style="font-size:24px;"><b>Xuất dữ liệu</b></font><br />
<font style="font-size:9px"><i>Ra file Excel</i></font>
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
<div style="font-size:11px; padding:10px">
<?php if ($_smarty_tpl->tpl_vars['errorMsg']->value != '') {?>
<p style="background:#FFFFCC;color:#FF0000; padding:5px"><?php echo $_smarty_tpl->tpl_vars['errorMsg']->value;?>
</p>
<?php }?>

<form action="" method="post" enctype="multipart/form-data">
<p>
<select name="is_active">
	<option value="">Trạng thái</option>
	<option value="0" <?php if ($_smarty_tpl->tpl_vars['is_active']->value == '0') {?>selected<?php }?>>Không hoạt động</option>
	<option value="1" <?php if ($_smarty_tpl->tpl_vars['is_active']->value == '1') {?>selected<?php }?>>Hoạt động</option>
	
</select>
Xuất dữ liệu từ: <input type="text" name="from_no" id="from_no" placeholder="0" /> đến <input type="text" name="to_no" id="to_no" placeholder="1000" /><br /><br />
<i>(Nếu không chọn khoảng dữ liệu, hệ thống sẽ xuất tất cả dữ liệu, nếu dữ liệu của bạn quá lớn, sẽ quá thời gian Request của trình duyệt, và bạn sẽ không xuất được dữ liệu.)</i>
</p>
<p>
<input type="submit" name="btnImport" value=" Xuất dữ liệu " />
</p>
</form>
</div><?php }
}
