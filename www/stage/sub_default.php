<?php
require_once DIR_INCLUDES . "/Vimeo/Autoloader.php";
require_once DIR_COMMON . "/clsPaging.php";

use Vimeo\Vimeo;

function default_default()
{
    global $assign_list, $_CONFIG, $_SITE_ROOT, $mod, $act, $clsRewrite, $VIMEO_API, $core, $_LANG_ID, $dbconn;

    $clsUsers = new Users();
    $clsCategory = new Category();
    $clsStage = new Stage();
    $clsLessons = new Lessons();
    $clsQuestions = new Questions();

    // Get current category
    $curCat = $clsCategory->getByIdOrSlug();
    $parCat = $clsCategory->getOne($curCat['parent_id']);
    $cat_id = $curCat['cat_id'];
    $h1_title = $curCat['name'];

    $video['image'] = $curCat['image'];
    $video['attachment'] = $curCat['attachment'];
    $video['arrStream'] = getVideo($curCat);

    // Lấy danh sách giai đoạn và bài học
    $stages = $clsStage->getAll("lang_code='$_LANG_ID' AND is_online=1 AND parent_id = 0 AND cat_id=$cat_id ORDER BY order_no, reg_date ASC");

    foreach ($stages as $key => $stage) {
        $cats = $clsStage->getAll("parent_id = {$stage[stage_id]} AND lang_code = '$_LANG_ID' AND is_online = 1 ORDER BY order_no, reg_date ASC");

        if (is_array($cats)) {

            foreach ($cats as $key2 => $cat) {
                $lessons = $clsLessons->getAll("lang_code = '$_LANG_ID' AND is_online=1 AND stage_id={$cat['stage_id']} AND parent_id=0");

                if (is_array($lessons)) {
                    foreach ($lessons as $k => $v) {
                        $lessons[$k]['sublessons'] = $clsLessons->getAll("parent_id = {$v[lesson_id]} AND lang_code = '$_LANG_ID' AND is_online = 1 ORDER BY order_no, reg_date ASC");
                    }

                    $cats[$key2]['lessons'] = $lessons;
                }
            }
        }

        $stages[$key]['cats'] = $cats;
    }

    $paymentStatus = Transactions::checkPaymentStatus($cat_id);

    $questions = $clsQuestions->getByCategory($curCat);

    // Regirect to test page
    if (GET('test') && is_array($questions)) {
        $act = 'test';
    }

    //Begin Assign
    $assign_list["curCat"] = $curCat;
    $assign_list["parCat"] = $parCat;
    $assign_list["questions"] = $questions;
    $assign_list["stages"] = $stages;
    $assign_list["video"] = $video;
    $assign_list["h1_title"] = $h1_title;
    $assign_list["paymentStatus"] = $paymentStatus;
    //End Assign

    //Begin SEOmoz
    $page_title = ($curCat['page_title'] != "") ? $curCat['page_title'] : $curCat['name'];

    if ($page_title == "") {
        $site_title = "Giai đoạn";
    }

    $page_title .= " - " . $_CONFIG['site_title'];
    $_CONFIG['page_title'] = $page_title;
    $_CONFIG['page_keywords'] = $curCat['meta_keywords'];
    $_CONFIG['page_description'] = $curCat['meta_des'];
    //End SEOmoz
}

function getVideo($video)
{
    if ($video['video_id']) {
        $youtube = new Youtube();

        $obj = $youtube->setVideoID($video['video_id']);

        if ($obj->hasVideo()) {
            $videoStream = $obj->getAllStream("mp4");

            if (is_array($videoStream) && !empty($videoStream)) {
                return $videoStream;
            }
        }
    }

    if ($video['vimeo_id']) {
        $vimeo = new Vimeo($VIMEO_API['client_id'], $VIMEO_API['client_secret'], $VIMEO_API['access_token']);

        $videoStream = $vimeo->getAllStream($vimeo->request('/videos/' . $video['vimeo_id']), "mp4");

        if (is_array($videoStream) && !empty($videoStream)) {
            return $videoStream;
        }
    }

    return null;
}
