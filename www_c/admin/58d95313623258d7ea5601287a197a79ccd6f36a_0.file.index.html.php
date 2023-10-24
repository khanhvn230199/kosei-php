<?php
/* Smarty version 3.1.32, created on 2021-06-08 14:13:44
  from '/var/www/koseionline.vn/data/www/koseionline.vn/admin/templates/_login/index.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_60bf18a894c681_14896994',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '58d95313623258d7ea5601287a197a79ccd6f36a' => 
    array (
      0 => '/var/www/koseionline.vn/data/www/koseionline.vn/admin/templates/_login/index.html',
      1 => 1616483394,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60bf18a894c681_14896994 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/var/www/koseionline.vn/data/www/koseionline.vn/includes/smarty3/plugins/modifier.date_format.php','function'=>'smarty_modifier_date_format',),));
?><!DOCTYPE html>
<html lang="en">
<head>
<title>Login | <?php echo $_smarty_tpl->tpl_vars['core']->value->_version;?>
</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['ADMIN_URL_CSS']->value;?>
/login.css" />

<!--[if lte IE 7]><style>.main{display:none;} .support-note .note-ie{display:block;}</style><![endif]-->
<style>
	@import url(css/ubuntu.css?family=Ubuntu:400,700);
	body {
		background: #563c55 url(images/blurred.jpg) no-repeat center top;
		-webkit-background-size: cover;
		-moz-background-size: cover;
		background-size: cover;
	}
	.container > header h1,
	.container > header h2 {
		color: #fff;
		text-shadow: 0 1px 1px rgba(0,0,0,0.7);
	}
</style>

</head>
<body>
<div class="container">
  <div class="codrops-top"> 
		<a href="<?php echo $_smarty_tpl->tpl_vars['VNCMS_URL']->value;?>
"> <strong>&laquo; </strong>Homepage</a> 
		<span class="right"> <a href="<?php echo $_smarty_tpl->tpl_vars['VNCMS_URL']->value;?>
/admin"> Login <strong>&raquo;</strong> </a> </span>
	</div>
  <header>
    <h1>Admin Area <strong>VnCMS</strong> <sup>&copy;<?php echo smarty_modifier_date_format(time(),"%Y");?>
</sup></h1>
    <h2>Content Management System v3.0.0</h2>
		<nav class="codrops-demos">
			<a href="<?php echo $_smarty_tpl->tpl_vars['VNCMS_URL']->value;?>
/admin">Login here:</a>
		</nav>

    <div class="support-note"> <span class="note-ie">No support this browser, change to new browser like Firefox or Chrome.</span> </div>
  </header>
  <section class="main">		
		<?php if ($_smarty_tpl->tpl_vars['isValid']->value == 0) {?>
		<div style="text-align:center; color:red">Login fail, please try again!</div>			
		<?php }?>
    <form class="form-3" action="" method="post" name="frmLogin" id="frmLogin">						
      <p class="clearfix">
        <label for="txtUsername">Username</label>
        <input type="text" name="txtUsername" id="txtUsername" placeholder="User name" value="<?php echo $_smarty_tpl->tpl_vars['txtUsername']->value;?>
" maxlength="32">
      </p>
      <p class="clearfix">
        <label for="txtPassword">Password</label>
        <input type="password" name="txtPassword" id="txtPassword" placeholder="Password" value="<?php echo $_smarty_tpl->tpl_vars['txtPassword']->value;?>
" autocomplete='off'>
      </p>
      <p class="clearfix">
        <label for="txtSecureCode">Security Code</label>
        <input type="password" name="txtSecureCode" id="txtSecureCode" placeholder="Security code" value="<?php echo $_smarty_tpl->tpl_vars['txtPassword']->value;?>
" autocomplete='off'>
      </p>
      <p class="clearfix">
        <input type="checkbox" name="remember" id="remember">
        <label for="remember">Remember</label>
      </p>
      <p class="clearfix">
        <input type="submit" name="btnLogin_x" value="Login">
      </p>
    </form>
  </section>
</div>
<?php echo '<script'; ?>
>document.frmLogin.txtUsername.focus();<?php echo '</script'; ?>
>
</body>
</html>
<?php }
}
