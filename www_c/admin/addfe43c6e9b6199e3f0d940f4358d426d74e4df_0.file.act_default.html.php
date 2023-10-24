<?php
/* Smarty version 3.1.32, created on 2023-05-19 09:55:48
  from '/var/www/koseionline/data/www/koseionline.vn/admin/templates/default/act_default.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_6466e534cb3276_50955124',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'addfe43c6e9b6199e3f0d940f4358d426d74e4df' => 
    array (
      0 => '/var/www/koseionline/data/www/koseionline.vn/admin/templates/default/act_default.html',
      1 => 1670384084,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6466e534cb3276_50955124 (Smarty_Internal_Template $_smarty_tpl) {
echo '<script'; ?>
 language="javascript">
function changeSection(tbl_id, img_id){
	contract(tbl_id);
	obj_img_id = getObj(img_id);
	var str = obj_img_id.obj.src.toString();
	if (str.indexOf("minus", 0)>-1){
		createCookie(tbl_id, 2, 1);//collapsed
		obj_img_id.obj.src = str.replace(/minus/gi, "plus");
	}else{
		createCookie(tbl_id, 1, 1);//expanded
		obj_img_id.obj.src = str.replace(/plus/gi, "minus");
	}
}
<?php echo '</script'; ?>
>

<div class="container-fluid mt-3" id="sectionDashIcon">
<?php echo $_smarty_tpl->tpl_vars['clsCP']->value->showAllSection();?>

<?php echo $_smarty_tpl->tpl_vars['clsCP']->value->showOnLoadFunc();?>

</div><?php }
}
