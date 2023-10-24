<?php
/* Smarty version 3.1.32, created on 2023-10-11 14:05:25
  from '/var/www/koseionline/data/www/koseionline.vn/admin/templates/settings/act_email8.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_65264935279854_33082306',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6514c5e1c2a93b927e85b4793885c2b39d0eb3dc' => 
    array (
      0 => '/var/www/koseionline/data/www/koseionline.vn/admin/templates/settings/act_email8.html',
      1 => 1678870757,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:_block_inner_head_add.html' => 1,
  ),
),false)) {
function content_65264935279854_33082306 (Smarty_Internal_Template $_smarty_tpl) {
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
		<a class="btn-tab" href="?mod=settings&act=email6">Mail Feedback</a>
		<a class="btn-tab" href="?mod=settings&act=email7">Mail Đăng ký tư vấn</a>
		<a class="btn-tab active" href="?mod=settings&act=email8">Email nhắc quay lại học</a>
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
		<td colspan="2" class="gridheader1">Email gửi Quản trị viên</td>
	</tr>
	<tr>
		<td class="gridrow" width="40%">Gửi email tới Quản trị viên khi có Thành viên đăng ký tư vấn?</td>
		<td class="gridrow1">
		<?php echo $_smarty_tpl->tpl_vars['clsForm']->value->showInput("mail_configs[mail_nhachoc]");?>

		</td>
	</tr>
	<tr>
		<td class="gridrow" width="40%">Tiêu đề email:</td>
		<td class="gridrow1">
		<?php echo $_smarty_tpl->tpl_vars['clsForm']->value->showInput("mail_advisory_title");?>

		</td>
	</tr>
	<tr>
		<td class="gridrow" width="40%">Nội dung email:
		<br><br><pre>
%SITE_NAME% : tên của website
%SITE_TITLE% : tiêu đề của website
%SITE_HOTLINE% : hotline của website
%FULL_NAME% : tên người gửi form
%PHONE% : SĐT người gửi form
%EMAIL% : Email người gửi form
%SENT_DATE%: thời gian gửi form

		</pre>
		</td>
		<td class="gridrow1">
		<?php echo $_smarty_tpl->tpl_vars['clsForm']->value->showInput("mail_advisory_body");?>

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
