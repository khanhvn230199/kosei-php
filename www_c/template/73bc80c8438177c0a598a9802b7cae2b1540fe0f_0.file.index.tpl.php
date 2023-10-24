<?php
/* Smarty version 3.1.32, created on 2023-06-17 15:21:19
  from '/var/www/koseionline/data/www/koseionline.vn/themes/template/index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_648d6cffae0337_68974224',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '73bc80c8438177c0a598a9802b7cae2b1540fe0f' => 
    array (
      0 => '/var/www/koseionline/data/www/koseionline.vn/themes/template/index.tpl',
      1 => 1686990069,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:_header.tpl' => 1,
    'file:_footer.tpl' => 1,
    'file:_modals.tpl' => 1,
  ),
),false)) {
function content_648d6cffae0337_68974224 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="vi">

<head>
    <title><?php echo $_smarty_tpl->tpl_vars['_CONFIG']->value['page_title'];?>
</title>
    <!-- REQUIRED meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="google-site-verification" content="6oc5hE5lN_GuUbqapN93ExomQNZ-_OeZGZFs8DD_vZ8" />
    <!-- Favicon tag -->
    <?php if ($_smarty_tpl->tpl_vars['_CONFIG']->value['site_favicon'] != '') {?>
    <link rel="shortcut icon" href="<?php echo $_smarty_tpl->tpl_vars['URL_UPLOADS']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['_CONFIG']->value['site_favicon'];?>
" type="image/x-icon" />
    <link rel="icon" href="<?php echo $_smarty_tpl->tpl_vars['URL_UPLOADS']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['_CONFIG']->value['site_favicon'];?>
" type="image/x-icon">
    <?php } else { ?>
    <link rel="shortcut icon" href="<?php echo $_smarty_tpl->tpl_vars['VNCMS_URL']->value;?>
/favicon.ico" type="image/x-icon">
    <link rel="icon" href="<?php echo $_smarty_tpl->tpl_vars['VNCMS_URL']->value;?>
/favicon.ico" type="image/x-icon">
    <?php }?>
    <!-- SEO meta tags -->
    <meta name="keywords" content="<?php echo $_smarty_tpl->tpl_vars['_CONFIG']->value['page_keywords'];?>
" />
    <meta name="description" content="<?php echo $_smarty_tpl->tpl_vars['_CONFIG']->value['page_description'];?>
" />
    <meta name="author" content="<?php echo $_smarty_tpl->tpl_vars['_CONFIG']->value['site_name'];?>
" />
    <!-- Social meta tags -->
    <?php if ($_smarty_tpl->tpl_vars['og']->value['title'] != '') {?>
    <meta name="DC.title" content="<?php echo $_smarty_tpl->tpl_vars['og']->value['title'];?>
" />
    <?php }?>
    <?php if ($_smarty_tpl->tpl_vars['og']->value['fbadmin'] != '') {?>
    <meta property="fb:admins" content="<?php echo $_smarty_tpl->tpl_vars['og']->value['fbadmin'];?>
" />
    <?php }?>
    <?php if ($_smarty_tpl->tpl_vars['og']->value['url'] != '') {?>
    <meta itemprop="url" content="<?php echo $_smarty_tpl->tpl_vars['og']->value['url'];?>
" />
    <?php }?>
    <?php if ($_smarty_tpl->tpl_vars['og']->value['image'] != '') {?>
    <meta itemprop="image" content="<?php echo $_smarty_tpl->tpl_vars['og']->value['image'];?>
" />
    <meta property="og:image" content="<?php echo $_smarty_tpl->tpl_vars['og']->value['image'];?>
" />
    <?php }?>
    <?php if ($_smarty_tpl->tpl_vars['og']->value['title'] != '') {?>
    <meta property="og:title" content="<?php echo $_smarty_tpl->tpl_vars['og']->value['title'];?>
" />
    <?php }?>
    <?php if ($_smarty_tpl->tpl_vars['og']->value['description'] != '') {?>
    <meta property="og:description" content="<?php echo $_smarty_tpl->tpl_vars['og']->value['description'];?>
" />
    <?php }?>
    <?php if ($_smarty_tpl->tpl_vars['og']->value['type'] != '') {?>
    <meta property="og:type" content="<?php echo $_smarty_tpl->tpl_vars['og']->value['type'];?>
" />
    <?php }?>
    <meta property="og:locale" content="vi_vn">
    <?php if ($_smarty_tpl->tpl_vars['og']->value['published'] != '') {?>
    <meta property="article:published_time" content="<?php echo $_smarty_tpl->tpl_vars['og']->value['published'];?>
" />
    <meta property="article:modified_time" content="<?php echo $_smarty_tpl->tpl_vars['og']->value['modified'];?>
" />
    <meta property="article:author" content="<?php echo $_smarty_tpl->tpl_vars['_CONFIG']->value['site_name'];?>
" />
    <meta property="article:section" content="<?php echo $_smarty_tpl->tpl_vars['og']->value['section'];?>
" />
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['og']->value['tag'], 'tag', false, 'k');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['tag']->value) {
?>
    <meta property="article:tag" content="<?php echo $_smarty_tpl->tpl_vars['tag']->value;?>
" />
    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    <meta name="twitter:card" content="summary" />
    <?php }?>
    <?php if ($_smarty_tpl->tpl_vars['og']->value['site_name'] != '') {?>
    <meta property="og:site_name" content="<?php echo $_smarty_tpl->tpl_vars['og']->value['site_name'];?>
" />
    <?php }?>
    <?php if ($_smarty_tpl->tpl_vars['og']->value['url'] != '') {?>
    <meta property="og:url" content="<?php echo $_smarty_tpl->tpl_vars['og']->value['url'];?>
" />
    <?php }?>
    <?php if ($_smarty_tpl->tpl_vars['og']->value['alternate1'] != '') {?>
    <link rel="alternate" href="<?php echo $_smarty_tpl->tpl_vars['og']->value['alternate1'];?>
" media="handheld" />
    <?php }?>
    <?php if ($_smarty_tpl->tpl_vars['og']->value['canonical']) {?>
    <link rel="canonical" href="<?php echo $_smarty_tpl->tpl_vars['og']->value['canonical'];?>
" />
    <?php }?>
    <meta property="fb:admins" content="100003160964356" />
    <meta property="fb:app_id" content="331855394387685" />
    <!-- :::::-[ Vendors StyleSheets ]-:::::: -->
    <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['URL_VENDOR']->value;?>
/font-awesome-4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['URL_VENDOR']->value;?>
/swiper/css/swiper.min.css" />
            <?php if (!$_smarty_tpl->tpl_vars['isTestSpeed']->value) {?>
    <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['URL_VENDOR']->value;?>
/mediaelementplayer/css/mediaelementplayer.min.css" />
    <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['URL_VENDOR']->value;?>
/mediaelementplayer/plugin/jump-forward/jump-forward.css">
    <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['URL_VENDOR']->value;?>
/mediaelementplayer/plugin/skip-back/skip-back.css">
    <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['URL_VENDOR']->value;?>
/mediaelementplayer/plugin/speed/speed.css">
    <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['URL_VENDOR']->value;?>
/mediaelementplayer/plugin/quality/quality.css">
    <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['URL_VENDOR']->value;?>
/sweetalert2/css/sweetalert2.min.css" />
    <?php }?>
    <!-- custom style-->
    <!-- Custom Styles -->
    <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['URL_CSS']->value;?>
/style.css?v=1.1" />
    <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['URL_CSS']->value;?>
/custom.css" />
    <!-- <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['URL_CSS']->value;?>
/w3.css" /> -->
    <!-- Custom JS Top -->
    <!--[if lt IE 9]>
    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['URL_JS']->value;?>
/html5.min.js"><?php echo '</script'; ?>
><![endif]-->
    <?php if (!$_smarty_tpl->tpl_vars['isTestSpeed']->value) {?>
    <?php echo htmlDecode($_smarty_tpl->tpl_vars['_CONFIG']->value['jscode_head']);?>

    
    <!-- Load Facebook SDK for JavaScript -->
    <!-- <div id="fb-root"></div>
    <?php echo '<script'; ?>
>
    window.fbAsyncInit = function() {
        FB.init({
            xfbml: true,
            version: 'v6.0'
        });
    };

    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s);
        js.id = id;
        js.src = 'https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
    <?php echo '</script'; ?>
> -->
    <!-- Your customer chat code -->
   <!--  <div class="fb-customerchat" attribution=setup_tool page_id="1671863919602248" logged_in_greeting="Chào bạn, Kosei có thể giúp gì cho bạn?" logged_out_greeting="Chào bạn, Kosei có thể giúp gì cho bạn?">
    </div> -->
    
    <?php }?>
</head>

<body oncontextmenu="return false" oncopy="return false" oncut="return false" onpaste="return true">
    <!-- Custom JS Body -->
    <?php if (!$_smarty_tpl->tpl_vars['isTestSpeed']->value) {?>
    <?php echo htmlDecode($_smarty_tpl->tpl_vars['_CONFIG']->value['jscode_openbody']);?>

    <?php }?>
    <?php $_smarty_tpl->_subTemplateRender("file:_header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
    <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['mod']->value)."/index.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
    <?php $_smarty_tpl->_subTemplateRender("file:_footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
    <?php $_smarty_tpl->_subTemplateRender("file:_modals.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
    <?php echo '<script'; ?>
>
    var VNCMS_URL = "<?php echo $_smarty_tpl->tpl_vars['VNCMS_URL']->value;?>
";
    var URL_IMAGES = "<?php echo $_smarty_tpl->tpl_vars['URL_IMAGES']->value;?>
";
    var URL_CSS = "<?php echo $_smarty_tpl->tpl_vars['URL_CSS']->value;?>
";
    var URL_UPLOAD = "<?php echo $_smarty_tpl->tpl_vars['URL_UPLOADS']->value;?>
";
    <?php echo '</script'; ?>
>
    <!-- :::::-[ Vendors JS ]-:::::: -->
    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['URL_VENDOR']->value;?>
/jquery/jquery-3.3.1.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['URL_VENDOR']->value;?>
/popper/popper.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['URL_VENDOR']->value;?>
/bootstrap/js/bootstrap.min.js"><?php echo '</script'; ?>
>
    <?php if (!$_smarty_tpl->tpl_vars['isTestSpeed']->value) {?>
    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['URL_VENDOR']->value;?>
/swiper/js/swiper.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="https://apis.google.com/js/platform.js"><?php echo '</script'; ?>
>
    <?php }?>
            <?php if (!$_smarty_tpl->tpl_vars['isTestSpeed']->value) {?>
    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['URL_VENDOR']->value;?>
/mediaelementplayer/js/mediaelement-and-player.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['URL_VENDOR']->value;?>
/mediaelementplayer/plugin/jump-forward/jump-forward.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['URL_VENDOR']->value;?>
/mediaelementplayer/plugin/skip-back/skip-back.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['URL_VENDOR']->value;?>
/mediaelementplayer/plugin/speed/speed.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['URL_VENDOR']->value;?>
/mediaelementplayer/plugin/quality/quality.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['URL_VENDOR']->value;?>
/sweetalert2/js/sweetalert2.all.min.js"><?php echo '</script'; ?>
>
    <?php }?>
    <?php if (!$_smarty_tpl->tpl_vars['isTestSpeed']->value) {?>
    <?php echo '<script'; ?>
 src="https://images.dmca.com/Badges/DMCABadgeHelper.min.js"><?php echo '</script'; ?>
>
    <?php }?>
    <!-- Custom JS Bottom -->
    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['URL_JS']->value;?>
/globals.js?v=1.2"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['URL_JS']->value;?>
/jquery_cookie.js"><?php echo '</script'; ?>
>
    <?php if ($_smarty_tpl->tpl_vars['mod']->value == "trialtest" || ($_smarty_tpl->tpl_vars['mod']->value == 'account' && $_smarty_tpl->tpl_vars['act']->value == 'history')) {?>
    <?php if ($_smarty_tpl->tpl_vars['arrOneTest']->value['level_id'] == 9 || $_smarty_tpl->tpl_vars['arrOneTest']->value['level_id'] == 4) {?>
    <!-- học thử N5 thì hiện thị bảng điển cộng dồn từ vựng , ngữ pháp , đọc hiểu -->
    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['URL_JS']->value;?>
/test4.js?v=1.3"><?php echo '</script'; ?>
>
    <!-- End -->
    <?php } else { ?>
    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['URL_JS']->value;?>
/test3.js?v=1.3"><?php echo '</script'; ?>
>
    <?php }?>
    <?php } else { ?>
    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['URL_JS']->value;?>
/test.js?v=1.3"><?php echo '</script'; ?>
>
    <?php }?>
    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['URL_JS']->value;?>
/publish.js?v=1.5"><?php echo '</script'; ?>
>
    <?php if (!$_smarty_tpl->tpl_vars['isTestSpeed']->value) {?>
    <?php echo htmlDecode($_smarty_tpl->tpl_vars['_CONFIG']->value['google_analytics']);?>

    <?php echo htmlDecode($_smarty_tpl->tpl_vars['_CONFIG']->value['jscode_closebody']);?>

    <?php }?>
    <?php if ($_smarty_tpl->tpl_vars['arr_error']->value['message']) {?>
    <?php echo '<script'; ?>
>
    Swal.queue([{
        title: "Thông báo",
        type: "<?php echo $_smarty_tpl->tpl_vars['arr_error']->value['status'];?>
",
        text: "<?php echo $_smarty_tpl->tpl_vars['arr_error']->value['message'];?>
",
        showLoaderOnConfirm: true,
        preConfirm: () => {
            if ("<?php echo $_smarty_tpl->tpl_vars['arr_error']->value['location'];?>
" !== "") {
                return window.location.href = "<?php echo $_smarty_tpl->tpl_vars['arr_error']->value['location'];?>
";
            }
        }
    }])
    <?php echo '</script'; ?>
>
    <?php }?>
</body>
<?php if (!$_smarty_tpl->tpl_vars['isTestSpeed']->value) {?>
<div id="fb-root"></div>
<?php echo '<script'; ?>
 crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v3.3&appId=331855394387685&autoLogAppEvents=1"><?php echo '</script'; ?>
>
<?php }?>

</html><?php }
}
