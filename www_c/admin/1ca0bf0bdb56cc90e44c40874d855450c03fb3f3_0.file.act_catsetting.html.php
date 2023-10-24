<?php
/* Smarty version 3.1.32, created on 2021-06-08 16:57:36
  from '/var/www/koseionline.vn/data/www/koseionline.vn/admin/templates/settings/act_catsetting.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_60bf3f1078d0f3_73342808',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1ca0bf0bdb56cc90e44c40874d855450c03fb3f3' => 
    array (
      0 => '/var/www/koseionline.vn/data/www/koseionline.vn/admin/templates/settings/act_catsetting.html',
      1 => 1616483394,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60bf3f1078d0f3_73342808 (Smarty_Internal_Template $_smarty_tpl) {
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
		<a class="btn-tab active" href="?mod=settings&act=catsetting">Cấu hình Trang chủ</a>
		<a class="btn-tab " href="?mod=settings&act=catsetting2">Cấu hình Thanh toán</a>
		<a class="btn-tab " href="?mod=settings&act=catsetting3">Liên kết MXH</a>
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
		<td class="gridrow">Tạo Cache cho trang chủ</td>
		<td class="gridrow1"><?php echo $_smarty_tpl->tpl_vars['clsForm']->value->showInput("home_cache");?>
</td>
	</tr>
	<tr>
		<td colspan="2" class="gridheader1">Trang chủ Section 1 (dưới Slider)</td>
	</tr>
	<tr>
		<td class="gridrow">Tiêu đề ô trái 'How We Can Help?</td>
		<td class="gridrow1"><?php echo $_smarty_tpl->tpl_vars['clsForm']->value->showInput("home_section1[title]");?>
</td>
	</tr>
	<tr>
		<td class="gridrow">|_TAB content 01 dưới 'How We Can Help?'</td>
		<td class="gridrow1"><?php echo $_smarty_tpl->tpl_vars['clsForm']->value->showInput("home_section1[tab1]");?>

		<?php echo $_smarty_tpl->tpl_vars['clsForm']->value->showInput("home_section1_content1");?>
	
		</td>
	</tr>
	<tr>
		<td class="gridrow">|_TAB content 02 dưới 'How We Can Help?'</td>
		<td class="gridrow1"><?php echo $_smarty_tpl->tpl_vars['clsForm']->value->showInput("home_section1[tab2]");?>

		<?php echo $_smarty_tpl->tpl_vars['clsForm']->value->showInput("home_section1_content2");?>
	
		</td>
	</tr>
	<tr>
		<td class="gridrow">|_TAB content 03 dưới 'How We Can Help?'</td>
		<td class="gridrow1"><?php echo $_smarty_tpl->tpl_vars['clsForm']->value->showInput("home_section1[tab3]");?>

		<?php echo $_smarty_tpl->tpl_vars['clsForm']->value->showInput("home_section1_content3");?>
	
		</td>
	</tr>
	<tr>
		<td class="gridrow">|_TAB content 04 dưới 'How We Can Help?'</td>
		<td class="gridrow1"><?php echo $_smarty_tpl->tpl_vars['clsForm']->value->showInput("home_section1[tab4]");?>

		<?php echo $_smarty_tpl->tpl_vars['clsForm']->value->showInput("home_section1_content4");?>
	
		</td>
	</tr>
	<tr>
		<td class="gridrow">|_TAB content 05 dưới 'How We Can Help?'</td>
		<td class="gridrow1"><?php echo $_smarty_tpl->tpl_vars['clsForm']->value->showInput("home_section1[tab5]");?>

		<?php echo $_smarty_tpl->tpl_vars['clsForm']->value->showInput("home_section1_content5");?>
	
		</td>
	</tr>
	<tr>
		<td class="gridrow">Tên nút 'Make an appointment'</td>
		<td class="gridrow1"><?php echo $_smarty_tpl->tpl_vars['clsForm']->value->showInput("home_section1[button]");?>
</td>
	</tr>
	<tr>
		<td class="gridrow">|_Link tới khi click nút 'Make an appointment'</td>
		<td class="gridrow1"><?php echo $_smarty_tpl->tpl_vars['clsForm']->value->showInput("home_section1[blink]");?>
</td>
	</tr>
	<tr>
		<td class="gridrow">Tiêu đề ô phải 'Latest News'</td>
		<td class="gridrow1"><?php echo $_smarty_tpl->tpl_vars['clsForm']->value->showInput("home_section1[title1]");?>
</td>
	</tr>
	<tr>
		<td class="gridrow">|_Hiển thị tin bài từ các nhóm</td>
		<td class="gridrow1"><?php echo $_smarty_tpl->tpl_vars['clsForm']->value->showInput("home_section1[cat_id1]");?>
</td>
	</tr>
	<tr>
		<td colspan="2" class="gridheader1">Trang chủ Section 2</td>
	</tr>
	<tr>
		<td class="gridrow">Tiêu đề của section 2.1</td>
		<td class="gridrow1"><?php echo $_smarty_tpl->tpl_vars['clsForm']->value->showInput("home_section2[title]");?>
</td>
	</tr>
	<tr>
		<td class="gridrow">|_Hiển thị tin bài từ các nhóm</td>
		<td class="gridrow1"><?php echo $_smarty_tpl->tpl_vars['clsForm']->value->showInput("home_section2[cat_id]");?>
</td>
	</tr>
	<tr>
		<td class="gridrow">Tiêu đề của section 2.2</td>
		<td class="gridrow1"><?php echo $_smarty_tpl->tpl_vars['clsForm']->value->showInput("home_section2[title1]");?>
</td>
	</tr>
	<tr>
		<td class="gridrow">|_Hiển thị tin bài từ các nhóm</td>
		<td class="gridrow1"><?php echo $_smarty_tpl->tpl_vars['clsForm']->value->showInput("home_section2[cat_id1]");?>
</td>
	</tr>
	<tr>
		<td class="gridrow">Tiêu đề của section 2.3</td>
		<td class="gridrow1"><?php echo $_smarty_tpl->tpl_vars['clsForm']->value->showInput("home_section2[title2]");?>
</td>
	</tr>
	<tr>
		<td class="gridrow">|_Hiển thị tin bài từ các nhóm</td>
		<td class="gridrow1"><?php echo $_smarty_tpl->tpl_vars['clsForm']->value->showInput("home_section2[cat_id2]");?>
</td>
	</tr>
	<tr>
		<td class="gridrow">Tiêu đề của section 2.4</td>
		<td class="gridrow1"><?php echo $_smarty_tpl->tpl_vars['clsForm']->value->showInput("home_section2[title3]");?>
</td>
	</tr>
	<tr>
		<td class="gridrow">|_Hiển thị tin bài từ các nhóm</td>
		<td class="gridrow1"><?php echo $_smarty_tpl->tpl_vars['clsForm']->value->showInput("home_section2[cat_id3]");?>
</td>
	</tr>
	<tr>
		<td class="gridrow">Tiêu đề của section 2.5</td>
		<td class="gridrow1"><?php echo $_smarty_tpl->tpl_vars['clsForm']->value->showInput("home_section2[title4]");?>
</td>
	</tr>
	<tr>
		<td class="gridrow">|_Hiển thị tin bài từ các nhóm</td>
		<td class="gridrow1"><?php echo $_smarty_tpl->tpl_vars['clsForm']->value->showInput("home_section2[cat_id4]");?>
</td>
	</tr>
	
	<tr>
		<td colspan="2" class="gridheader1">Trang chủ Section 3</td>
	</tr>
	<tr>
		<td class="gridrow">Tiêu đề của section Trái</td>
		<td class="gridrow1"><?php echo $_smarty_tpl->tpl_vars['clsForm']->value->showInput("home_section3[title]");?>
</td>
	</tr>
	<tr>
		<td class="gridrow">|_Hiển thị tin bài từ các nhóm</td>
		<td class="gridrow1"><?php echo $_smarty_tpl->tpl_vars['clsForm']->value->showInput("home_section3[cat_id]");?>
</td>
	</tr>
	<tr>
		<td class="gridrow">Tiêu đề của section Giữa</td>
		<td class="gridrow1"><?php echo $_smarty_tpl->tpl_vars['clsForm']->value->showInput("home_section3[title1]");?>
</td>
	</tr>
	<tr>
		<td class="gridrow">|_Hiển thị tin bài từ các nhóm</td>
		<td class="gridrow1"><?php echo $_smarty_tpl->tpl_vars['clsForm']->value->showInput("home_section3[cat_id1]");?>
</td>
	</tr>
	<tr>
		<td class="gridrow">Tiêu đề của section Phải</td>
		<td class="gridrow1"><?php echo $_smarty_tpl->tpl_vars['clsForm']->value->showInput("home_section3[title2]");?>
</td>
	</tr>
	<tr>
		<td class="gridrow">|_Hiển thị tin bài từ các nhóm</td>
		<td class="gridrow1"><?php echo $_smarty_tpl->tpl_vars['clsForm']->value->showInput("home_section3[cat_id2]");?>
</td>
	</tr>
	<tr>
		<td class="gridrow">|_Link tới khi click nút 'Free Post'</td>
		<td class="gridrow1"><?php echo $_smarty_tpl->tpl_vars['clsForm']->value->showInput("home_section3[blink]");?>
</td>
	</tr>
	<!-- <tr>
		<td colspan="2" class="gridheader1">Cấu hình trang chủ -> Section 4</td>
	</tr>
	<tr>
		<td class="gridrow">Tiêu đề của section</td>
		<td class="gridrow1"><?php echo $_smarty_tpl->tpl_vars['clsForm']->value->showInput("home_section4[title]");?>
</td>
	</tr>
	<tr>
		<td class="gridrow">Tiêu đề phụ của section</td>
		<td class="gridrow1"><?php echo $_smarty_tpl->tpl_vars['clsForm']->value->showInput("home_section4[sub_title]");?>
</td>
	</tr>
	<tr>
		<td class="gridrow">Hiển thị tin bài từ các nhóm</td>
		<td class="gridrow1"><?php echo $_smarty_tpl->tpl_vars['clsForm']->value->showInput("home_section4[cat_id]");?>
</td>
	</tr>
	<tr>
		<td class="gridrow">Số lượng tin hiển thị</td>
		<td class="gridrow1"><?php echo $_smarty_tpl->tpl_vars['clsForm']->value->showInput("home_section4[limit]");?>
</td>
	</tr>
	<tr>
		<td colspan="2" class="gridheader1">Cấu hình trang chủ -> Section 5</td>
	</tr>
	<tr>
		<td class="gridrow">Nhúng bản đồ chỉ đường</td>
		<td class="gridrow1"><?php echo $_smarty_tpl->tpl_vars['clsForm']->value->showInput("home_section5_map");?>
</td>
	</tr> -->
	<!--  -->
	
	</table>
</td>
</tr>
</table>
</form><?php }
}
