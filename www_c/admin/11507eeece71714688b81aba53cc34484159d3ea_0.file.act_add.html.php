<?php
/* Smarty version 3.1.32, created on 2023-08-11 08:42:35
  from '/var/www/koseionline/data/www/koseionline.vn/admin/templates/promotion/act_add.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_64d5920bbecca7_29719531',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '11507eeece71714688b81aba53cc34484159d3ea' => 
    array (
      0 => '/var/www/koseionline/data/www/koseionline.vn/admin/templates/promotion/act_add.html',
      1 => 1670384085,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:_block_inner_head_add.html' => 1,
  ),
),false)) {
function content_64d5920bbecca7_29719531 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:_block_inner_head_add.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
<form name="theForm" action="" method="post">
<table width="100%" border="0">
<tr>
<td style="padding:10px" colspan="4">
	<div style="padding-bottom:5px; font-size:14px; float:left">
	<strong><?php if ($_smarty_tpl->tpl_vars['clsForm']->value->pval != '') {
echo $_smarty_tpl->tpl_vars['core']->value->getLang("Edit");?>
 <?php echo $_smarty_tpl->tpl_vars['clsForm']->value->getTitle();?>
: #<?php echo $_smarty_tpl->tpl_vars['clsForm']->value->pval;?>

			<?php } else {
echo $_smarty_tpl->tpl_vars['core']->value->getLang("Add");?>
 <?php echo $_smarty_tpl->tpl_vars['clsForm']->value->getTitle();?>

			<?php }?></strong>
	<?php if ($_smarty_tpl->tpl_vars['arrParent']->value['name'] != '') {?>
	[Trang cha: <b><?php echo $_smarty_tpl->tpl_vars['arrParent']->value['name'];?>
</b>]
	<?php }?>

	</div>
	<div style="float:right;font-size:12px; color:blue" align="right">
	</div>
</td>
</tr>
<tr>
<td style="padding:0px 10px" width="100%" valign="top">
	<input type="hidden" id="is_page" value="1" />
	<?php echo $_smarty_tpl->tpl_vars['clsForm']->value->showJS();?>

	<table cellpadding="0" cellspacing="0" width="100%" border="0" class="girdtable">
	<tr>
		<td colspan="2" class="gridheader1"><?php echo $_smarty_tpl->tpl_vars['core']->value->getLang("InputCorrectlyAllBelowFields");?>
</td>
	</tr>
	<?php if ($_smarty_tpl->tpl_vars['clsForm']->value->isValid != 1) {?>
	<tr>
		<td class="gridrow1" style="color:red; padding:5px" colspan="2">
		<?php echo $_smarty_tpl->tpl_vars['clsForm']->value->showAllError();?>

		</td>
	</tr>
	<?php }?>
	<?php echo $_smarty_tpl->tpl_vars['clsForm']->value->showForm();?>

	</table>
	<em><font style="font-size:10px"><?php echo $_smarty_tpl->tpl_vars['core']->value->getLang("Note");?>
: * <?php echo $_smarty_tpl->tpl_vars['core']->value->getLang("isrequired");?>
</font></em>
</td>
</tr>
</table>
</form>

<?php echo '<script'; ?>
>
	$("#course_name").after('<div class="ac_results" id="search_result"></div>');
	$("#course_name").keyup(function (e) {
		if (e.which != 13) {
			$.ajax({
				type: "POST",
				url: vncms_url + "/ajax/getcourses",
				dataType: "text",
				data: {'keyword': $("#course_name").val()}
			}).done(function (str) {
				if (str != "") {
					$("#search_result").show();
					$("#search_result").html(str);
				} else {
					$("#search_result").hide();
				}

			});
		}
	});
	function selectTag(obj) {
		var value = $(obj).attr("tag-value");
		var title = $(obj).attr("tag-title");
		$('#course_name').val(title);
		$('#course_id').val(value);
		$("#search_result").hide();
	}
<?php echo '</script'; ?>
>
<?php }
}
