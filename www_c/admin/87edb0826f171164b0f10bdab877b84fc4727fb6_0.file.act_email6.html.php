<?php
/* Smarty version 3.1.32, created on 2023-10-11 14:05:22
  from '/var/www/koseionline/data/www/koseionline.vn/admin/templates/settings/act_email6.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_6526493248e350_42854022',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '87edb0826f171164b0f10bdab877b84fc4727fb6' => 
    array (
      0 => '/var/www/koseionline/data/www/koseionline.vn/admin/templates/settings/act_email6.html',
      1 => 1678872090,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:_block_inner_head_add.html' => 1,
  ),
),false)) {
function content_6526493248e350_42854022 (Smarty_Internal_Template $_smarty_tpl) {
echo $_smarty_tpl->tpl_vars['clsForm']->value->showJS();?>

<?php $_smarty_tpl->_subTemplateRender("file:_block_inner_head_add.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
<form name="theForm" action="" method="post" id="theForm">
<table width="100%" border="0">
<tr>
<td style="padding:10px" colspan="4">
	<div style="padding-bottom:3px;font-size:14px; border-bottom:1px solid #999999; padding-left:5px;">
		<a class="btn-tab " href="?mod=settings&act=email">Đăng ký tài khoản</a>
		<a class="btn-tab" href="?mod=settings&act=email2">Quên mật khẩu</a>
		<a class="btn-tab " href="?mod=settings&act=email3">Cấu hình SMTP</a>
		<a class="btn-tab" href="?mod=settings&act=email5">Mail Thông báo thi thử</a>
		<a class="btn-tab active" href="?mod=settings&act=email6">Mail Feedback</a>
		<a class="btn-tab" href="?mod=settings&act=email7">Mail Đăng ký tư vấn</a>
		<a class="btn-tab " href="?mod=settings&act=email8">Email nhắc quay lại học</a>
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
		<td colspan="2" class="gridheader1">Email gửi Khách hàng</td>
	</tr>	
	<tr>
		<td class="gridrow" width="40%">Gửi email tới Khách hàng khi gửi form Appointment thành công?</td>
		<td class="gridrow1">
		<?php echo $_smarty_tpl->tpl_vars['clsForm']->value->showInput("mail_configs[mail_feedback_client]");?>

		</td>
	</tr>
	<tr>
		<td class="gridrow" width="40%">Tiêu đề email:</td>
		<td class="gridrow1">
		<?php echo $_smarty_tpl->tpl_vars['clsForm']->value->showInput("mail_feedback_client_title");?>

		</td>
	</tr>
	<tr>
		<td class="gridrow" width="40%">Nội dung email:
		<br><br><pre>
%SITE_NAME% : tên của website
%SITE_TITLE% : tiêu đề của website
%SITE_HOTLINE% : hotline của website
%JOB_TITLE% : chức danh của người gửi form
%FULL_NAME% : tên người gửi form
%PHONE% : điện thoại người gửi form
%EMAIL% : email người gửi form
%SENT_DATE%: thời gian gửi form
%COMPANY_NAME%: tên công ty 
%CONTENT%: nội dung KH gửi
		</pre>
		</td>
		<td class="gridrow1">
		<?php echo $_smarty_tpl->tpl_vars['clsForm']->value->showInput("mail_feedback_client_body");?>

		</td>
	</tr>
	<tr>
		<td colspan="2" class="gridheader1">Email gửi Quản trị viên</td>
	</tr>
	<tr>
		<td class="gridrow" width="40%">Gửi email tới Quản trị viên khi có khách gửi form Appointment thành công?</td>
		<td class="gridrow1">
		<?php echo $_smarty_tpl->tpl_vars['clsForm']->value->showInput("mail_configs[mail_feedback_admin]");?>

		</td>
	</tr>
	<tr>
		<td class="gridrow" width="40%">Tiêu đề email:</td>
		<td class="gridrow1">
		<?php echo $_smarty_tpl->tpl_vars['clsForm']->value->showInput("mail_feedback_admin_title");?>

		</td>
	</tr>
	<tr>
		<td class="gridrow" width="40%">Nội dung email:
		<br><br><pre>
%SITE_NAME% : tên của website
%SITE_TITLE% : tiêu đề của website
%SITE_HOTLINE% : hotline của website
%JOB_TITLE% : chức danh của người gửi form
%FULL_NAME% : tên người gửi form
%PHONE% : điện thoại người gửi form
%EMAIL% : email người gửi form
%SENT_DATE%: thời gian gửi form
%COMPANY_NAME%: tên công ty 
%CONTENT%: nội dung KH gửi
		</pre>
		</td>
		<td class="gridrow1">
		<?php echo $_smarty_tpl->tpl_vars['clsForm']->value->showInput("mail_feedback_admin_body");?>

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
