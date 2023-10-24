<?php
/* Smarty version 3.1.32, created on 2023-05-19 09:55:48
  from '/var/www/koseionline/data/www/koseionline.vn/admin/templates/index.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_6466e534c7d770_77319163',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '65079f4879cbba885d2b65729d94b563a296aba5' => 
    array (
      0 => '/var/www/koseionline/data/www/koseionline.vn/admin/templates/index.html',
      1 => 1670384055,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:_header.html' => 1,
    'file:_footer.html' => 1,
  ),
),false)) {
function content_6466e534c7d770_77319163 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html>
<head>
<title>Admin Control Panel</title>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta name="robots" content="NOINDEX, NOFOLLOW">
<?php echo '<script'; ?>
>var vncms_url = "<?php echo $_smarty_tpl->tpl_vars['VNCMS_URL']->value;?>
";var vncms_url_admin = "<?php echo $_smarty_tpl->tpl_vars['VNCMS_URL']->value;?>
/admin";<?php echo '</script'; ?>
>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" />
<link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['ADMIN_URL_CSS']->value;?>
/chosen.min.css" type="text/css">
<link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['ADMIN_URL_CSS']->value;?>
/admin.css" type="text/css">
<?php echo '<script'; ?>
 src="https://code.jquery.com/jquery-3.3.1.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" defer="defer"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['ADMIN_URL_JS']->value;?>
/chosen.jquery.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['ADMIN_URL_JS']->value;?>
/global.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['ADMIN_URL_JS']->value;?>
/admin.js"><?php echo '</script'; ?>
>
</head>
<body class="skin-blue">
<?php if ($_GET['clearCache'] == 1) {
echo '<script'; ?>
>alertClearCacheDone();<?php echo '</script'; ?>
>
<?php }
$_smarty_tpl->_subTemplateRender("file:_header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['mod']->value)."/index.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
$_smarty_tpl->_subTemplateRender("file:_footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
</body>
</html>
<?php }
}
