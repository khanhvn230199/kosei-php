<?php
/* Smarty version 3.1.32, created on 2021-06-08 14:17:43
  from '/var/www/koseionline.vn/data/www/koseionline.vn/admin/templates/default/act_default.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_60bf1997707eb4_83398822',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8ed7a0ea0869ce212feba851384d3532f823e6e7' => 
    array (
      0 => '/var/www/koseionline.vn/data/www/koseionline.vn/admin/templates/default/act_default.html',
      1 => 1616483392,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60bf1997707eb4_83398822 (Smarty_Internal_Template $_smarty_tpl) {
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
