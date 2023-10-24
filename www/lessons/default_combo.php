<?php

require_once DIR_COMMON . "/clsPaging.php";

use Vimeo\Vimeo;

function default_default()
{

    // echo 123;

    global $assign_list, $_CONFIG, $_SITE_ROOT, $mod, $act, $clsRewrite, $VIMEO_API, $core, $_LANG_ID;

    $clsStage = new Stage();
    $clsCategory = new Category();
    $clsTransactions = new Transactions();
    $clsUsers = new Users();
    $clsPayment = new Payment();

    $clsCategory->getParentArray();

    // Get current category
    if (GET('cat_id')) {
        $curCat = $clsCategory->getOne(GET('cat_id'));
    }

    if (!$curCat) {
        $curCat = $clsCategory->getBySlug(GET('slug'));
    }

    if (!$curCat) {
        showErrorFatalBox("notfound");
        exit();
    }

    $parCat = $clsCategory->getOne($curCat['parent_id']);
    $cat_id = $curCat['cat_id'];
    $h1_title = $curCat['name'];
    $user_id = $core->_USER['user_id'];

    $video['name'] = $curCat['name'];
    $video['image'] = $curCat['image'];
    $video['attachment'] = $curCat['attachment'];
    $video['arrStream'] = getVideoCat($curCat);

    // Lấy trạng thái thanh toán
    $paymentStatus = Transactions::getPaymentStatus($cat_id);

    // Get user info
    if ($core->_SESS->isLoggedin()) {
        $user_id = $core->_USER['user_id'];
        $user = $clsUsers->getOne($user_id);
    }

    // Get bank accounts
    $bankAccounts = $clsPayment->getAll("is_online = 1 AND ctype=0 AND lang_code = '$_LANG_ID' ORDER BY order_no ASC, reg_date DESC");

    // Get department
    $locations = $clsPayment->getAll("is_online = 1 AND ctype=1 AND lang_code = '$_LANG_ID' ORDER BY order_no ASC, reg_date DESC");

    // Lấy combo khác
    $otherCombos = $clsCategory->getAll("is_online=1 AND cat_id<>$cat_id AND CTYPE=" . CTYPE_CB . " ORDER BY order_no");

    //Begin Assign
    $assign_list["h1_title"] = $h1_title;
    $assign_list["curCat"] = $curCat;
    $assign_list["parCat"] = $parCat;
    $assign_list["video"] = $video;
    $assign_list["otherCombos"] = $otherCombos;
    $assign_list["user"] = $user;
    $assign_list["bankAccounts"] = $bankAccounts;
    $assign_list["locations"] = $locations;
    $assign_list["paymentStatus"] = $paymentStatus;
    //End Assign

    //Begin SEOmoz
    $page_title = ($curCat['page_title'] != "") ? $curCat['page_title'] : $curCat['name'];

    $page_title .= " - " . $_CONFIG['site_title'];
    $_CONFIG['page_title'] = $page_title;
    $_CONFIG['page_keywords'] = $curCat['meta_keywords'];
    $_CONFIG['page_description'] = $curCat['meta_des'];
    //End SEOmoz
}

// function getVideo($video)
// {
//     if ($video['video_id']) {
//         $youtube = new Youtube();

//         $obj = $youtube->setVideoID($video['video_id']);

//         if ($obj->hasVideo()) {
//             $videoStream = $obj->getAllStream("mp4");

//             if (is_array($videoStream) && !empty($videoStream)) {
//                 return $videoStream;
//             }
//         }
//     }

//     if ($video['vimeo_id']) {
//         $vimeo = new Vimeo($VIMEO_API['client_id'], $VIMEO_API['client_secret'], $VIMEO_API['access_token']);

//         $videoStream = $vimeo->getAllStream($vimeo->request('/videos/' . $video['vimeo_id']), "mp4");

//         if (is_array($videoStream) && !empty($videoStream)) {
//             return $videoStream;
//         }
//     }

//     return null;
// }
