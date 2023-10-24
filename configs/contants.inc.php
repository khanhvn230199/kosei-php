<?
/******************************************************
 * Vars&Conts Definition
 *
 * Define some variables & contants for project
 *
 *
 * Project Name               :  ClientWebsite
 * Package Name                    :
 * Program ID                 :  contants.inc.php
 * Environment                :  PHP  version 5.3
 * Author                     :  TuanTA
 * Version                    :  1.0
 * Creation Date              :  20/01/2018
 *
 * Modification History     :
 * Version    Date            Person Name        Chng  Req   No    Remarks
 * 1.0        20/01/2018        banglcb          -        -     -     -
 *
 ********************************************************/
$arrBBCodeImg = array();
$arrAdsPositionOptions = array(
    "CR" => "Đánh giá của học viên",
    "CN" => "Chi nhánh",
    "L" => "Trái",
    "R" => "Phải",
    "banner" => "Banner slider",
    "why" => "Tại sao chọn chúng tôi",
    "PU" => "POPUP Sự kiện",
);
$arrAdsPositionOptionsSize = array(
    "L" => "Text",
);
$arrMod2Name = array(
    "All" => "Tất cả các trang",
    "home_default_default" => "Trang chủ",
    "home_default_page" => "Trang Nội dung tĩnh",
    "article_default_default" => "Trang Nhóm Tin tức",
    "article_default_detail" => "Trang Chi tiết tin",
);
$arrMod2NamePosition = array(
    "All" => array("CR", "CN", "banner","why","PU"),
    "home_default_default" => array(""),
    "home_default_page" => array(""),
    "article_default_default" => array(""),
    "article_default_detail" => array(""),
);
$arrTargetOptions = array(
    '_blank' => "Blank page",
    '_parent' => "Self page",
);
//config slides format
$_arr_slider_format = array(
    "t_title" => array("Title", 255, "", ""), //title, length, default value, place holder
    "t_des" => array("Description", 255, "", ""),
    "t_url" => array("URL", 255, "", ""),
);
$_arr_slider_type = array(
    "main" => "Sldie PC",
    // "mobile"        =>    "Sldie Mobile",
);
//config category
$_max_category_level = 3;
define("MAX_LEVEL_CATEGORY", 3);
//config menu type
$_arr_menu_type = array(
    "top" => "Menu đầu trang",
    "main" => "Menu chính",
//    "bottom" => "Menu chân trang"
);
$_max_menu_level = 2;

define("CTYPE_BV", 0);
define("CTYPE_KH", 1);
define("CTYPE_GV", 2);
define("CTYPE_GT", 3);
define("CTYPE_CB", 4);

$arrCtypeOptions = array(
    CTYPE_BV => "Nhóm Bài viết",
    CTYPE_KH => "Nhóm Khóa học",
    CTYPE_GV => "Nhóm Giáo viên",
    CTYPE_GT => "Nhóm Giáo trình",
    CTYPE_CB => "Combo khoá học",
);

$arrTemplateOption[CTYPE_BV] = array('default' => "Mặc định", 'list' => "Danh sách");
$arrTemplateOption['PAGE'] = array('default' => "Mặc định", 'ndt' => "Nhà đầu tư");
$arrTestOptions = array('' => "--", 'js-vocab' => "Từ vựng", 'js-grammar' => "Ngữ pháp", 'js-reading' => "Đọc hiểu", 'js-listening' => "Nghe hiểu");

$paymentMethodOptions = array(0 => "Chuyển khoản qua ngân hàng", 1 => "Thanh toán trực tiếp", 2 => "Thanh toán qua thẻ visa hoặc thẻ tín dụng");
$shippingMethodOptions = array(1 => "Vận chuyển qua bưu điện", 2 => "Đăng ký trực tiếp tại Văn Phòng");
$transactionStatusOptions = array(0 => "Chờ thanh toán", 1 => "Chưa thanh toán", 2 => "Đã thanh toán");
$arrInboxPriority = array(0 => "Bình thường", 1 => "Quan trọng", 2 => "Khẩn cấp");
$arrYesNoOptions = array(0 => "Không", 1 => "Có");
$arrGenderOptions = array(0 => "Nam", 1 => "Nữ");
$arrActiveOptions = array(0 => "Không hoạt động", 1 => "Hoạt động");
$arrGroupOptions = array(2 => "Người dùng", 4 => "Moderator");
$arrDiscountTypeOptions = array(0 => "Phần trăm (%)", 1 => "Số tiền");

//Facebook App definition
//phuonghv 22/11/2021 
// $FB_APP = array(
//     "appId" => "323376168551960",
//     "secret" => "6da540ed4f91195be9d7d5aa5829f246",
//     "cookie" => true,
//     "version" => "v15.0",
// );

$FB_APP = array(
    "appId" => "2225594884390247",
    "secret" => "ab274656833127aad1f3e99f309ad2c3",
    "cookie" => true,
    "version" => "v3.2"
);



//Tuanta 13/03/2022
// $FB_APP = array(
//     "appId" => "960357538128719",
//     "secret" => "f39411decafa1769b141b59946919a2b",
//     "cookie" => true,
//     "version" => "v13.0",
// );
//End

// $FB_APP = array(
//     "appId" => "473563110733984",
//     "secret" => "6da290942121bf0a8b6cca086b16fc7b",
//     "cookie" => true,
//     "version" => "v3.2",
// );


// $FB_APP = array(
//     "appId" => "435782773643958",
//     "secret" => "bc5dc6cb52c6071fe1569402498c1820",
//     "cookie" => true,
//     "version" => "v3.2"
// );

//Google API definition
$GG_API = array(
    "client_id" => "767842852540-s923rjtiteripo0cs8874m5csornno9p.apps.googleusercontent.com",
    "client_secret" => "PTtZiqv3nlM7UIi6umflMDfB",
);

//Vimeo API definition
$VIMEO_API = array(
    "client_id" => "7ccdc915d06deaed3530c186e667ace465e0b7c3",
    "client_secret" => "b7MD047KcCWwcGZQuppkS7GGCk7j6BRUv9nfxFiMoFu60lR0PXj1LbRL0zfjzvATFluselNvrk6kKvX3/XzE8xJKjB0tpMOX2n28jj0wzECff8Gtl5BzP47+ktdPNxwf",
    "access_token" => "62ac963fdaf3305c41c63fd149e7081b",
);
