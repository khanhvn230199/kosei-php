<?
/******************************************************
 * Admin Header File
 * Load before module file called
 *
 * Project Name               :  Shopping Themes DVS
 * Package Name                    :
 * Program ID                 :  header.php
 * Environment                :  PHP  version version 4, 5
 * Author                     :  TuanTA
 * Version                    :  1.0
 * Creation Date              :  2014/02/10
 *
 * Modification History     :
 * Version    Date            Person Name        Chng  Req   No    Remarks
 * 1.0        2014/02/10        TuanTA          -        -     -     -
 *
 ********************************************************/
/*Language START*/
$clsLanguage = new Language();
$lang_code = getPOST("lang_code", LANG_DEFAULT); //Ngôn ngữ dữ liệu
$lang_code_name = $clsLanguage->getName($lang_code);
$_LANG_ID_NAME = $clsLanguage->getName($_LANG_ID); //Ngôn ngữ của giao diện
/*Language END*/

#Button Navigation
$clsButtonNav = new ButtonNav();

$default_permiss_name = array(
    "category_default_default" => "[" . $core->getLang("ContentManagement") . "] " . $core->getLang("Categories"),
    "articles_default_default" => "[" . $core->getLang("ContentManagement") . "] " . $core->getLang("Articles"),
    "comments_default_default" => "[" . $core->getLang("ContentManagement") . "] " . $core->getLang("FeedbackNews"),
    "pages_default_default" => "[" . $core->getLang("ContentManagement") . "] " . $core->getLang("Pages"),

    "menu_default_default" => "[" . $core->getLang("SettingManagement") . "] " . $core->getLang("Menu"),
    "settings_default_generalsetting" => "[" . $core->getLang("SettingManagement") . "] " . $core->getLang("GeneralSettings"),
    "settings_default_catsetting" => "[" . $core->getLang("SettingManagement") . "] " . $core->getLang("FrontEndSettings"),
    "settings_default_seosetting" => "[" . $core->getLang("SettingManagement") . "] " . $core->getLang("SEOSettings"),
    "settings_default_adsense" => "[" . $core->getLang("SettingManagement") . "] " . $core->getLang("WebmasterTools"),

    "accessstats_default_default" => "[" . $core->getLang("SystemManagement") . "] " . $core->getLang("AccessStats"),
    "adminmanager_default_default" => "[" . $core->getLang("SystemManagement") . "] " . $core->getLang("AdminManagement"),

);
$default_permiss_key = array_keys($default_permiss_name);
$default_permiss_array = array();
foreach ($default_permiss_key as $key => $val) {
    $default_permiss_array[$val] = 0;
}
$clsLessons = new Lessons();
$clsTransactions = new Transactions();
$clsPromotion = new Promotion();
$clsUsers = new Users();
$clsOrders = new Orders();
$clsCoupon = new Coupon();
$clsCategory = new Category();
$clsArticles = new Articles();
$clsFeedBacks = new FeedBacks();
$clsAdvisory = new Advisory();
$clsComments = new Comments();
$clsPages = new Pages();
$clsStage = new Stage();
$clsSkills = new Skills();
$clsPayment = new Payment();
$clsTrialTest = new TrialTest();
$clsCandidates = new Candidates();
$clsLevel = new Level();
$clsExam = new Exam();
$clsQuestions = new Questions();
$clsRegion = new Region();
$clsCountry = new Country();
$clsProvince = new Province();
$clsDistrict = new District();
$clsSliders = new Sliders();
$clsAdver = new Adver();
$clsTrial = new Trial();




$total_lessons = $clsLessons->countItem();
$total_transactions = $clsTransactions->countItem();
$total_promotion = $clsPromotion->countItem();
$total_candidates = $clsCandidates->countItem();
$total_orders = $clsOrders->countItem("status=0");
$total_coupon = $clsCoupon->countItem("is_online=1 AND quantity>0");
$total_users = $clsUsers->countItem("is_active>=0 AND user_group_id != 6");
$total_cates = $clsCategory->countItem("is_online=1 AND lang_code='$lang_code' AND ctype!=" . CTYPE_KH);
$total_combo = $clsCategory->countItem("is_online=1 AND lang_code='$lang_code' AND ctype=" . CTYPE_CB);
$total_courses = $clsCategory->countItem("is_online=1 AND lang_code='$lang_code' AND ctype=" . CTYPE_KH);
$total_stages = $clsStage->countItem("is_online=1 AND lang_code='$lang_code'");
$total_skills = $clsSkills->countItem("is_online=1 AND lang_code='$lang_code'");
$total_payment = $clsPayment->countItem("is_online=1 AND lang_code='$lang_code'");
$total_trialtest = $clsTrialTest->countItem("is_online=1 AND lang_code='$lang_code'");
$total_level = $clsLevel->countItem("is_online=1 AND lang_code='$lang_code'");
$total_exams = $clsExam->countItem("is_online=1 AND test_id=0 AND lang_code='$lang_code'");
$total_questions = $clsQuestions->countItem("is_online=1 AND lang_code='$lang_code' AND exam_id!=''");
$total_articles = $clsArticles->countItem("is_online=1 AND is_verify=1 AND lang_code='$lang_code' AND ctype=" . CTYPE_BV);
$total_teacher = $clsArticles->countItem("is_online=1 AND is_verify=1 AND lang_code='$lang_code' AND ctype=" . CTYPE_GV);
$total_syllabus = $clsArticles->countItem("is_online=1 AND is_verify=1 AND lang_code='$lang_code' AND ctype=" . CTYPE_GT);
$total_advisory = $clsAdvisory->countItem("lang_code='$lang_code'");
$total_feedbacks = $clsFeedBacks->countItem("is_read=0 AND lang_code='$lang_code'");
$total_comments = $clsComments->countItem("is_online=1 AND lang_code='$lang_code'");
$total_pages = $clsPages->countItem("is_online=1 AND lang_code='$lang_code'");
$total_regions = $clsRegion->countItem("is_online=1");
$total_country = $clsCountry->countItem("is_online=1");
$total_provinces = $clsProvince->countItem("is_online=1");
$total_districts = $clsDistrict->countItem("1");
$total_sliders = $clsSliders->countItem("is_online=1");
$total_advers = $clsAdver->countItem("is_online=1");

$total_trials = $clsTrial->countItem("lang_code='$lang_code'");



unset($clsArticles, $clsFeedBacks, $clsComments, $clsPages);

$clsCP->addSection("course", $core->getLang("CoursesManagement"), "Courses", "product.png");
$clsCP->addLink("course", "level_default_default", $core->getLang("Level"), "?mod=level&reset", "largeicon/level.png", $total_level);
$clsCP->addLink("course", "combo_default_default", $core->getLang("Combo khóa học"), "?mod=combo&reset", "largeicon/icon-combo.png", $total_combo);
$clsCP->addLink("course", "course_default_default", $core->getLang("Khóa học"), "?mod=course&reset", "largeicon/courses.png", $total_courses);
$clsCP->addLink("course", "stage_default_default", $core->getLang("Giai đoạn"), "?mod=stage&reset", "largeicon/stage.png", $total_stages);
$clsCP->addLink("course", "lesson_default_default", $core->getLang("Bài giảng"), "?mod=lesson&reset", "largeicon/lesson.png", $total_lessons);
$clsCP->addLink("course", "transactions_default_default", $core->getLang("Transactions"), "?mod=transactions&reset", "largeicon/transaction.png", $total_transactions);
$clsCP->addLink("course", "promotion_default_default", $core->getLang("Khuyến mại"), "?mod=promotion", "largeicon/promotion.png", $total_promotion);
$clsCP->addLink("course", "payment_default_default", $core->getLang("Payment"), "?mod=payment", "largeicon/payment.png", $total_payment);
$clsCP->addLink("course", "coupon_default_default", $core->getLang("Mã giảm giá"), "?mod=coupon", "largeicon/coupon.png", $total_coupon);

$clsCP->addSection("exam", $core->getLang("ExamManagement"), "Exam", "exam.png");
$clsCP->addLink("exam", "skills_default_default", $core->getLang("Kỹ năng"), "?mod=skills&reset", "largeicon/skills.png", $total_skills);
$clsCP->addLink("exam", "exam_default_default", $core->getLang("Luyện đề"), "?mod=exam&reset", "largeicon/exam.png", $total_exams);
$clsCP->addLink("exam", "trialtest_default_default", $core->getLang("Thi thử"), "?mod=trialtest", "largeicon/trialtest.png", $total_trialtest);
$clsCP->addLink("exam", "score_default_default", $core->getLang("Bảng điểm"), "?mod=score", "largeicon/icon-score.png");
$clsCP->addLink("exam", "score_default_default", $core->getLang("Đăng ký thi thử"), "?mod=trial", "largeicon/newsletter-icon.png",$total_trials);

$clsCP->addSection("content", $core->getLang("ContentManagement"), "Content", "content.png");
$clsCP->addLink("content", "articles_default_default", $core->getLang("Articles"), "?mod=articles&reset", "largeicon/articles.png", $total_articles);
$clsCP->addLink("content", "teacher_default_default", $core->getLang("Teacher"), "?mod=teacher&reset", "largeicon/teacher.png", $total_teacher);
$clsCP->addLink("content", "syllabus_default_default", $core->getLang("Syllabus"), "?mod=syllabus&reset", "largeicon/syllabus.png", $total_syllabus);
$clsCP->addLink("content", "pages_default_default", $core->getLang("Pages"), "?mod=pages", "largeicon/page.png", $total_pages);
$clsCP->addLink("content", "adver_default_default", $core->getLang("Advertisment"), "?mod=adver", "largeicon/adver.png", $total_advers);
$clsCP->addLink("content", "advisory_default_default", $core->getLang("Đăng ký tư vấn"), "?mod=advisory", "largeicon/advisory.png", $total_advisory);
$clsCP->addLink("content", "feedbacks_default_default", $core->getLang("Contact"), "?mod=feedbacks", "largeicon/feedback.png", $total_feedbacks);
//$clsCP->addLink("content", "comments_default_default", $core->getLang("Feedback"), "?mod=comments", "largeicon/comment.png", $total_comments);
//$clsCP->addLink("content", "gallery_default_default", $core->getLang("Gallery"), "?mod=gallery", "largeicon/thuvienanh.png");

$clsCP->addSection("settings", $core->getLang("Setting"), "Setting", "setting.png", "140px");
$clsCP->addLink("settings", "category_default_default", $core->getLang("Categories"), "?mod=category&reset", "largeicon/folder.png", $total_cates);
//$clsCP->addLink("settings", "country_default_default", $core->getLang("Country"), "?mod=country&reset", "largeicon/country.png", $total_country);
//$clsCP->addLink("settings", "region_default_default", $core->getLang("Region"), "?mod=region&reset", "largeicon/region.png", $total_regions);
//$clsCP->addLink("settings", "province_default_default", $core->getLang("Province"), "?mod=province&reset", "largeicon/province.png", $total_provinces);
//$clsCP->addLink("settings", "district_default_default", $core->getLang("District"), "?mod=district", "largeicon/district.png", $total_districts);
$clsCP->addLink("settings", "menu_default_default", $core->getLang("Menu"), "?mod=menu&reset", "largeicon/menu.png");
$clsCP->addLink("settings", "sliders_default_default", $core->getLang("Sliders"), "?mod=sliders", "largeicon/slider.png", $total_sliders);
$clsCP->addLink("settings", "settings_default_generalsetting", $core->getLang("GeneralSettings"), "?mod=settings&act=generalsetting", "largeicon/config.png");
$clsCP->addLink("settings", "settings_default_catsetting", $core->getLang("FrontEndSettings"), "?mod=settings&act=catsetting", "largeicon/configfront.png");
$clsCP->addLink("settings", "settings_default_seosetting", $core->getLang("SEOSettings"), "?mod=settings&act=seosetting", "largeicon/settingseo.png");
$clsCP->addLink("settings", "settings_default_admintool", $core->getLang("WebmasterTools"), "?mod=settings&act=admintool", "largeicon/webmaster_tools.png");
$clsCP->addLink("settings", "settings_default_email", $core->getLang("EmailConfigs"), "?mod=settings&act=email", "largeicon/inbox.png");

$clsCP->addSection("system", $core->getLang("System"), "System", "system.png", "130px");
$clsCP->addLink("system", "users_default_default", $core->getLang("Học viên"), "?mod=users", "largeicon/user.png", $total_users);
$clsCP->addLink("system", "candidates_default_default", $core->getLang("Thí sinh"), "?mod=candidates", "largeicon/candidates.png", $total_candidates);
$clsCP->addLink("system", "settings_default_editlang", $core->getLang("Edit_Language"), "?mod=settings&act=editlang", "largeicon/translate.png");
$clsCP->addLink("system", "accessstats_default_default", $core->getLang("AccessStats"), "?mod=accessstats", "largeicon/websitestats.png");
$clsCP->addLink("system", "adminmanager_default_default", $core->getLang("AdminManagement"), "?mod=adminmanager&reset", "largeicon/useradmin.png");

$clsRecycleBin = new RecycleBin();
$totalItem = $clsRecycleBin->Count();
$icon_recyclebin = $clsRecycleBin->getIcon($totalItem);
unset($clsRecycleBin);
if ($core->isSuper()) {
    $clsCP->addLink("system", "recyclebin_default_default", $core->getLang("RecycleBin"), "?mod=recyclebin", "largeicon/$icon_recyclebin");
}
/*Setting Loader START*/
$clsSettings = new Settings();
$_CONFIG = $clsSettings->getAllSettings($lang_code);
unset($clsSettings);
/*Setting Loader END*/
