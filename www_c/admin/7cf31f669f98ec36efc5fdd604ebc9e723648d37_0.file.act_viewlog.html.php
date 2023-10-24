<?php
/* Smarty version 3.1.32, created on 2023-10-11 13:54:52
  from '/var/www/koseionline/data/www/koseionline.vn/admin/templates/teacher/act_viewlog.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_652646bc320b09_44996420',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7cf31f669f98ec36efc5fdd604ebc9e723648d37' => 
    array (
      0 => '/var/www/koseionline/data/www/koseionline.vn/admin/templates/teacher/act_viewlog.html',
      1 => 1670384087,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_652646bc320b09_44996420 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="inner_head_title">
<table cellpadding="0" cellspacing="0" width="100%" border="0">
<tr style="background:#FBFBFB">
	<td width="55px" style="padding:5px;">
		<a href="?mod=<?php echo $_smarty_tpl->tpl_vars['mod']->value;?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['ADMIN_URL_IMAGES']->value;?>
/largeicon/news.png" border="0"/></a>
	</td>
	<td>
	<span class="title1">VIEWLOG POST</span><br />
	<span class="title2">Post Management</span>
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
<td style="padding-left:10px;padding-right:10px">
</td>
</tr>
<tr>
<td style="padding-left:10px;padding-right:10px; font-size:12px" width="100%" valign="top">
<div style="padding:10px">
	Action Log on news <i>'<?php echo $_smarty_tpl->tpl_vars['arrOneNews']->value['title'];?>
'</i>:<br />
<textarea  rows="15" cols="80"  style="width:100%" readonly><?php echo $_smarty_tpl->tpl_vars['arrOneNews']->value['action_log'];?>
</textarea>	
</div>
</td>
</tr>
<tr>
</tr>
</table>
</form>
<?php }
}
