<!DOCTYPE html>
<html lang="vi">

<head>
    <title>{$_CONFIG.page_title}</title>
    <!-- REQUIRED meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="google-site-verification" content="6oc5hE5lN_GuUbqapN93ExomQNZ-_OeZGZFs8DD_vZ8" />
    <!-- Favicon tag -->
    {if $_CONFIG.site_favicon ne ""}
    <link rel="shortcut icon" href="{$URL_UPLOADS}/{$_CONFIG.site_favicon}" type="image/x-icon" />
    <link rel="icon" href="{$URL_UPLOADS}/{$_CONFIG.site_favicon}" type="image/x-icon">
    {else}
    <link rel="shortcut icon" href="{$VNCMS_URL}/favicon.ico" type="image/x-icon">
    <link rel="icon" href="{$VNCMS_URL}/favicon.ico" type="image/x-icon">
    {/if}
    <!-- SEO meta tags -->
    <meta name="keywords" content="{$_CONFIG.page_keywords}" />
    <meta name="description" content="{$_CONFIG.page_description}" />
    <meta name="author" content="{$_CONFIG.site_name}" />
    <!-- Social meta tags -->
    {if $og.title!=""}
    <meta name="DC.title" content="{$og.title}" />
    {/if}
    {if $og.fbadmin!=""}
    <meta property="fb:admins" content="{$og.fbadmin}" />
    {/if}
    {if $og.url!=""}
    <meta itemprop="url" content="{$og.url}" />
    {/if}
    {if $og.image!=""}
    <meta itemprop="image" content="{$og.image}" />
    <meta property="og:image" content="{$og.image}" />
    {/if}
    {if $og.title!=""}
    <meta property="og:title" content="{$og.title}" />
    {/if}
    {if $og.description!=""}
    <meta property="og:description" content="{$og.description}" />
    {/if}
    {if $og.type!=""}
    <meta property="og:type" content="{$og.type}" />
    {/if}
    <meta property="og:locale" content="vi_vn">
    {if $og.published ne ""}
    <meta property="article:published_time" content="{$og.published}" />
    <meta property="article:modified_time" content="{$og.modified}" />
    <meta property="article:author" content="{$_CONFIG.site_name}" />
    <meta property="article:section" content="{$og.section}" />
    {foreach key=k item=tag from=$og.tag}
    <meta property="article:tag" content="{$tag}" />
    {/foreach}
    <meta name="twitter:card" content="summary" />
    {/if}
    {if $og.site_name!=""}
    <meta property="og:site_name" content="{$og.site_name}" />
    {/if}
    {if $og.url!=""}
    <meta property="og:url" content="{$og.url}" />
    {/if}
    {if $og.alternate1!=""}
    <link rel="alternate" href="{$og.alternate1}" media="handheld" />
    {/if}
    {if $og.canonical}
    <link rel="canonical" href="{$og.canonical}" />
    {/if}
    <meta property="fb:admins" content="100003160964356" />
    <meta property="fb:app_id" content="331855394387685" />
    <!-- :::::-[ Vendors StyleSheets ]-:::::: -->
    <link rel="stylesheet" href="{$URL_VENDOR}/font-awesome-4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="{$URL_VENDOR}/swiper/css/swiper.min.css" />
    {*
    <link rel="stylesheet" href="{$URL_VENDOR}/audioplayer/css/audioplayer.css" />*}
    {*
    <link rel="stylesheet" href="{$URL_VENDOR}/videojs/css/video-js.min.css" />*}
    {if !$isTestSpeed}
    <link rel="stylesheet" href="{$URL_VENDOR}/mediaelementplayer/css/mediaelementplayer.min.css" />
    <link rel="stylesheet" href="{$URL_VENDOR}/mediaelementplayer/plugin/jump-forward/jump-forward.css">
    <link rel="stylesheet" href="{$URL_VENDOR}/mediaelementplayer/plugin/skip-back/skip-back.css">
    <link rel="stylesheet" href="{$URL_VENDOR}/mediaelementplayer/plugin/speed/speed.css">
    <link rel="stylesheet" href="{$URL_VENDOR}/mediaelementplayer/plugin/quality/quality.css">
    <link rel="stylesheet" href="{$URL_VENDOR}/sweetalert2/css/sweetalert2.min.css" />
    {/if}
    <!-- custom style-->
    <!-- Custom Styles -->
    <link rel="stylesheet" href="{$URL_CSS}/style.css?v=1.1" />
    <link rel="stylesheet" href="{$URL_CSS}/custom.css" />
    <!-- <link rel="stylesheet" href="{$URL_CSS}/w3.css" /> -->
    <!-- Custom JS Top -->
    <!--[if lt IE 9]>
    <script src="{$URL_JS}/html5.min.js"></script><![endif]-->
    {if !$isTestSpeed}
    {$_CONFIG.jscode_head|htmlDecode}
    {literal}
    <!-- Load Facebook SDK for JavaScript -->
    <!-- <div id="fb-root"></div>
    <script>
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
    </script> -->
    <!-- Your customer chat code -->
   <!--  <div class="fb-customerchat" attribution=setup_tool page_id="1671863919602248" logged_in_greeting="Chào bạn, Kosei có thể giúp gì cho bạn?" logged_out_greeting="Chào bạn, Kosei có thể giúp gì cho bạn?">
    </div> -->
    {/literal}
    {/if}
</head>

<body oncontextmenu="return false" oncopy="return false" oncut="return false" onpaste="return true">
    <!-- Custom JS Body -->
    {if !$isTestSpeed}
    {$_CONFIG.jscode_openbody|htmlDecode}
    {/if}
    {include file="_header.tpl"}
    {include file="$mod/index.tpl"}
    {include file="_footer.tpl"}
    {include file="_modals.tpl"}
    <script>
    var VNCMS_URL = "{$VNCMS_URL}";
    var URL_IMAGES = "{$URL_IMAGES}";
    var URL_CSS = "{$URL_CSS}";
    var URL_UPLOAD = "{$URL_UPLOADS}";
    </script>
    <!-- :::::-[ Vendors JS ]-:::::: -->
    <script src="{$URL_VENDOR}/jquery/jquery-3.3.1.min.js"></script>
    <script src="{$URL_VENDOR}/popper/popper.min.js"></script>
    <script src="{$URL_VENDOR}/bootstrap/js/bootstrap.min.js"></script>
    {if !$isTestSpeed}
    <script src="{$URL_VENDOR}/swiper/js/swiper.min.js"></script>
    <script src="https://apis.google.com/js/platform.js"></script>
    {/if}
    {*<script src="{$URL_VENDOR}/audioplayer/js/audioplayer.min.js"></script>*}
    {*<script src="{$URL_VENDOR}/videojs/js/video.min.js"></script>*}
    {if !$isTestSpeed}
    <script src="{$URL_VENDOR}/mediaelementplayer/js/mediaelement-and-player.js"></script>
    <script src="{$URL_VENDOR}/mediaelementplayer/plugin/jump-forward/jump-forward.js"></script>
    <script src="{$URL_VENDOR}/mediaelementplayer/plugin/skip-back/skip-back.js"></script>
    <script src="{$URL_VENDOR}/mediaelementplayer/plugin/speed/speed.js"></script>
    <script src="{$URL_VENDOR}/mediaelementplayer/plugin/quality/quality.js"></script>
    <script src="{$URL_VENDOR}/sweetalert2/js/sweetalert2.all.min.js"></script>
    {/if}
    {if !$isTestSpeed}
    <script src="https://images.dmca.com/Badges/DMCABadgeHelper.min.js"></script>
    {/if}
    <!-- Custom JS Bottom -->
    <script src="{$URL_JS}/globals.js?v=1.2"></script>
    <script src="{$URL_JS}/jquery_cookie.js"></script>
    {if $mod eq "trialtest" or ($mod eq 'account' and $act eq 'history')}
    {if $arrOneTest.level_id eq 9 or $arrOneTest.level_id eq 4}
    <!-- học thử N5 thì hiện thị bảng điển cộng dồn từ vựng , ngữ pháp , đọc hiểu -->
    <script src="{$URL_JS}/test4.js?v=1.3"></script>
    <!-- End -->
    {else}
    <script src="{$URL_JS}/test3.js?v=1.3"></script>
    {/if}
    {else}
    <script src="{$URL_JS}/test.js?v=1.3"></script>
    {/if}
    <script src="{$URL_JS}/publish.js?v=1.5"></script>
    {if !$isTestSpeed}
    {$_CONFIG.google_analytics|htmlDecode}
    {$_CONFIG.jscode_closebody|htmlDecode}
    {/if}
    {if $arr_error.message}
    <script>
    Swal.queue([{
        title: "Thông báo",
        type: "{$arr_error.status}",
        text: "{$arr_error.message}",
        showLoaderOnConfirm: true,
        preConfirm: () => {
            if ("{$arr_error.location}" !== "") {
                return window.location.href = "{$arr_error.location}";
            }
        }
    }])
    </script>
    {/if}
</body>
{if !$isTestSpeed}
<div id="fb-root"></div>
<script crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v3.3&appId=331855394387685&autoLogAppEvents=1"></script>
{/if}

</html>