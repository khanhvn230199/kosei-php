<?php
/* Smarty version 3.1.32, created on 2023-03-16 08:46:05
  from '/var/www/koseionline/data/www/koseionline.vn/admin/templates/settings/act_email.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_641274dd5f8dc8_65144143',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a95fed6158dcd7b5e008c93c1586277925f39202' => 
    array (
      0 => '/var/www/koseionline/data/www/koseionline.vn/admin/templates/settings/act_email.html',
      1 => 1616483394,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:_block_inner_head_add.html' => 1,
  ),
),false)) {
function content_641274dd5f8dc8_65144143 (Smarty_Internal_Template $_smarty_tpl) {
echo $_smarty_tpl->tpl_vars['clsForm']->value->showJS();?>

<?php $_smarty_tpl->_subTemplateRender("file:_block_inner_head_add.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
<form name="theForm" action="" method="post" id="theForm">
<table width="100%" border="0">
<tr>
<td style="padding:10px" colspan="4">
	<div style="padding-bottom:3px;font-size:14px; border-bottom:1px solid #999999; padding-left:5px;">
		<a class="btn-tab active" href="?mod=settings&act=email">Đăng ký tài khoản</a>
		<a class="btn-tab" href="?mod=settings&act=email2">Quên mật khẩu</a>
		<a class="btn-tab " href="?mod=settings&act=email3">Cấu hình SMTP</a>
		<a class="btn-tab" href="?mod=settings&act=email5">Mail Thông báo thi thử</a>
		<a class="btn-tab " href="?mod=settings&act=email6">Mail Feedback</a>
		<a class="btn-tab" href="?mod=settings&act=email7">Mail Đăng ký tư vấn</a>
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
		<td colspan="2" class="gridheader1">Email Kích hoạt tài khoản</td>
	</tr>	
	<tr>
		<td class="gridrow" width="40%">Gửi email kích hoạt cho người dùng sau khi đăng ký tài khoản?
		</td>
		<td class="gridrow1">
		<?php echo $_smarty_tpl->tpl_vars['clsForm']->value->showInput("mail_configs[mail_register]");?>

		(<small class="text-info">Nếu chọn Không gửi email ở mục này thì email Đăng ký thành công bên dưới sẽ được gửi nếu cho phép</small>)
		</td>
	</tr>
	<tr>
		<td class="gridrow" width="40%">Tiêu đề email:</td>
		<td class="gridrow1">
		<?php echo $_smarty_tpl->tpl_vars['clsForm']->value->showInput("mail_register_title");?>

		</td>
	</tr>
	<tr>
		<td class="gridrow" width="40%">Nội dung email:
		<br><br><pre>
%SITE_NAME% : tên của website
%SITE_TITLE% : tiêu đề của website
%SITE_HOTLINE% : hotline của website
%FULL_NAME% : họ tên người đăng ký
%USER_NAME% : tên đăng nhập
%USER_PASS% : mật khẩu
%URL_ACTIVE% : link kích hoạt tài khoản
		</pre>
		</td>
		<td class="gridrow1">
		<?php echo $_smarty_tpl->tpl_vars['clsForm']->value->showInput("mail_register_body");?>

		</td>
	</tr>
	<tr>
		<td colspan="2" class="gridheader1">Email Đăng ký thành công</td>
	</tr>
	<tr>
		<td class="gridrow" width="40%">Gửi email thông báo đăng ký tài khoản thành công sau khi người dùng đã kích hoạt?		
		</td>
		<td class="gridrow1">
		<?php echo $_smarty_tpl->tpl_vars['clsForm']->value->showInput("mail_configs[mail_register_success]");?>

		(<small class="text-info">Trường hợp ở trên không gửi email kích hoạt thì email này sẽ được gửi ngay sau khi đăng ký nếu cho phép</small>)
		</td>
	</tr>
	<tr>
		<td class="gridrow" width="40%">Tiêu đề email:</td>
		<td class="gridrow1">
		<?php echo $_smarty_tpl->tpl_vars['clsForm']->value->showInput("mail_register_success_title");?>

		</td>
	</tr>
	<tr>
		<td class="gridrow" width="40%">Nội dung email:
		<br><br><pre>
%SITE_NAME% : tên của website
%SITE_TITLE% : tiêu đề của website
%SITE_HOTLINE% : hotline của website
%FULL_NAME% : họ tên người đăng ký
%USER_NAME% : tên đăng nhập
%USER_PASS% : mật khẩu
		</pre>
		</td>
		<td class="gridrow1">
		<?php echo $_smarty_tpl->tpl_vars['clsForm']->value->showInput("mail_register_success_body");?>

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
