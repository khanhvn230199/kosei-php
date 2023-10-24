<?php
/* Smarty version 3.1.32, created on 2023-10-11 14:04:30
  from '/var/www/koseionline/data/www/koseionline.vn/admin/templates/settings/act_email3.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_652648feb7bad7_48132753',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '5be63eb3ae66de54c051a916399b07b65784b7b5' => 
    array (
      0 => '/var/www/koseionline/data/www/koseionline.vn/admin/templates/settings/act_email3.html',
      1 => 1678872100,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:_block_inner_head_add.html' => 1,
  ),
),false)) {
function content_652648feb7bad7_48132753 (Smarty_Internal_Template $_smarty_tpl) {
echo $_smarty_tpl->tpl_vars['clsForm']->value->showJS();?>

<?php $_smarty_tpl->_subTemplateRender("file:_block_inner_head_add.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
<form name="theForm" action="?mod=settings&act=email3" method="post" id="theForm">
<table width="100%" border="0">
<tr>
<td style="padding:10px" colspan="4">
	<div style="padding-bottom:3px;font-size:14px; border-bottom:1px solid #999999; padding-left:5px;">
		<a class="btn-tab " href="?mod=settings&act=email">Đăng ký tài khoản</a>
		<a class="btn-tab" href="?mod=settings&act=email2">Quên mật khẩu</a>
		<a class="btn-tab active" href="?mod=settings&act=email3">Cấu hình SMTP</a>
		<a class="btn-tab" href="?mod=settings&act=email5">Mail Thông báo thi thử</a>
		<a class="btn-tab " href="?mod=settings&act=email6">Mail Feedback</a>
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
		<td colspan="2" class="gridheader1">Cấu hình SMTP Server gửi đi</td>
	</tr>
	<tr>
		<td class="gridrow" width="40%">Email của webmaster để gửi đi hoặc nhận thông báo tới</td>
		<td class="gridrow1">
		<?php echo $_smarty_tpl->tpl_vars['clsForm']->value->showInput("webmaster_email");?>

		</td>
	</tr>
	<tr>
		<td class="gridrow">SMTP Server/Port</td>
		<td class="gridrow1">
		<?php echo $_smarty_tpl->tpl_vars['clsForm']->value->showInput("smtp_server");?>

		<?php echo $_smarty_tpl->tpl_vars['clsForm']->value->showInput("smtp_port");?>

		</td>
	</tr>
	<tr>
		<td class="gridrow">SMTP User</td>
		<td class="gridrow1">
		<?php echo $_smarty_tpl->tpl_vars['clsForm']->value->showInput("smtp_user");?>

		</td>
	</tr>
	<tr>
		<td class="gridrow">SMTP Password</td>
		<td class="gridrow1">
		<?php echo $_smarty_tpl->tpl_vars['clsForm']->value->showInput("smtp_pass");?>

		</td>
	</tr>
	<tr>
		<td colspan="2" class="gridheader1 text-primary">Gửi email kiểm tra:</td>
	</tr>
	<tr>
		<tr>
		<td class="gridrow">Chọn loại email muốn gửi test thử:</td>
		<td class="gridrow1">
		<?php echo $_smarty_tpl->tpl_vars['clsForm']->value->showInput("choose_mail");?>

		</td>
	</tr>
	<tr>
		<tr>
		<td class="gridrow">Nhập email muốn nhận:</td>
		<td class="gridrow1">
		<?php echo $_smarty_tpl->tpl_vars['clsForm']->value->showInput("to_email");?>

		</td>
	</tr>
	<tr style="background:none">
		<td><input type="hidden" name="btnSubmit" value="TestMail"></td>
		<td><input class="btn btn-sm btn-primary" type="button" value=" Gửi test " data-form="theForm" onclick="return submitTestMail(this);">
		<img src="<?php echo $_smarty_tpl->tpl_vars['ADMIN_URL_IMAGES']->value;?>
/loading.gif" style="display:none;" id="loading_bar">
		</td>
	</tr>
	<tr style="background:none; display:none" id="tr_send_mail_log">
		<td colspan="2" align="center">
		<textarea id="send_mail_log" style="width:99%;height:300px;" readonly ></textarea>
		</td>
	</tr>
	</tr>
	</table>
</td>
</tr>
</table>
</form>

<?php echo '<script'; ?>
>
function submitTestMail(obj){
	$(obj).prop('disabled', true);
	$("#loading_bar").show();
	$("#send_mail_log").val("Sending...");
	$("#tr_send_mail_log").show();
	var fname = $(obj).data("form");
	var formObj = $('#'+fname);
	var formURL = formObj.attr("action")+"&mode=ajax";
	var formData = formObj.serialize();
    $.ajax({
	     url: formURL,
	     type: 'POST',
	     data:  formData,
	     dataType: "json",	     
	     cache: false,
	     success: function(response){
	    	 $("#send_mail_log").val(response.log);
	    	 if (response.status=='OK'){
	    		 alert(response.message);	    		 
	    		 $('#to_email').val('');
	    	 }else{	    		 
	    		 alert(response.message);
	    	 }	    	 
	    	 $(obj).prop('disabled', false);
	    	 $("#loading_bar").hide();	    	 
	     },
	     error: function(jqXHR, textStatus, errorThrown) {
	    	 $("#send_mail_log").val("");
	    	 alert("Error connection");
	    	 $(obj).prop('disabled', false);
	    	 $("#loading_bar").hide();
	     }          
    });
    return false;
}
<?php echo '</script'; ?>
>
<?php }
}
