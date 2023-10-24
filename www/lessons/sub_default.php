<?php
require_once DIR_COMMON . "/clsPaging.php";

function default_default() {
	global $assign_list, $_CONFIG, $_SITE_ROOT, $mod, $act, $clsRewrite, $VIMEO_API, $core, $_LANG_ID, $dbconn;

	$clsUsers = new Users();
	$clsCategory = new Category();
	$clsStage = new Stage();
	$clsLessons = new Lessons();
	$clsQuestions = new Questions();
	$clsPayment = new Payment();

	$clsTransactions = new Transactions();
	$clsCandidates = new Candidates();
	$clsTest = new Test();
	$clsExam = new Exam();
	$clsQuestions = new Questions();

	// Get current category
	$curCat = $clsCategory->getByIdOrSlug();

	$level_id = $curCat['level_id'];
	// echo  $level_id;

	$parCat = $clsCategory->getOne($curCat['parent_id']);
	$cat_id = $curCat['cat_id'];

	// echo $cat_id;
	$h1_title = $curCat['name'];

	$video['image'] = $curCat['image'];
	$video['attachment'] = $curCat['attachment'];
	$video['arrStream'] = getVideoCat($curCat);

	// Lấy danh sách giai đoạn và bài học
	$stages = $clsStage->getAll("lang_code='$_LANG_ID' AND is_online=1 AND parent_id = 0 AND cat_id=$cat_id ORDER BY order_no, reg_date ASC");
	// print_r($stages);
	// die();
	if ($stages) {
		foreach ($stages as $key => $stage) {
			$cats = $clsStage->getAll("parent_id = {$stage['stage_id']} AND lang_code = '$_LANG_ID' AND is_online = 1 ORDER BY order_no, reg_date ASC");

			if (is_array($cats)) {

				foreach ($cats as $key2 => $cat) {
					$lessons = $clsLessons->getAll("lang_code = '$_LANG_ID' AND is_online=1 AND stage_id={$cat['stage_id']} AND parent_id=0");

					if (is_array($lessons)) {
						foreach ($lessons as $k => $v) {
							$lessons[$k]['sublessons'] = $clsLessons->getAll("parent_id = {$v['lesson_id']} AND lang_code = '$_LANG_ID' AND is_online = 1 ORDER BY order_no, reg_date ASC");
						}

						$cats[$key2]['lessons'] = $lessons;
					}
				}
			}

			$stages[$key]['cats'] = $cats;
		}
	}

	// Lấy trạng thái thanh toán
	$paymentStatus = Transactions::getPaymentStatus($cat_id);

	// print_r($paymentStatus);

	// lấy bài học , thông tin bài học của học viên đã học

	$user_id = $core->_USER['user_id'];

	// Lấy danh sách giao dịch khóa học đã mua
	$arrListTransactions = $clsTransactions->getAllTransactionsByUser($user_id);

	if (is_array($arrListTransactions)) {
		foreach ($arrListTransactions as $key => $cat) {
			if ($cat['status'] != 2) {
				continue;
			}

			$row = $clsLessons->getCatHistory($user_id, $cat['cat_id']);
			if (is_array($row) && !empty($row)) {
				$arrListTransactions[$key]['total_time'] = $row['total_time'];
				$arrListTransactions[$key]['first_time'] = $row['first_time'];
				$arrListTransactions[$key]['last_time'] = $row['last_time'];
			}
		}
	}
	//print_r($arrListTransactions);
	//$cat_id = GET("cid", 0);

	// Lấy danh sách giai đoạn và bài học khóa học đã mua

	// echo $cat_id;

	$stagesresult = 0;
	if ($cat_id > 0) {

		$arrOneCourse = $clsCategory->getByCond("is_online =1 AND cat_id = $cat_id");
		$assign_list["arrOneCourse"] = $arrOneCourse;

		// lấy bài học gần đây nhất dự vào thời gian học cuối cùng
		$sql = "SELECT `lesson_id`, MAX(last_time) FROM _study_history WHERE user_id = $user_id AND course_id =$cat_id";
		// echo $sql;
		$arrone = $dbconn->GetAll($sql);
		if (is_array($arrone)) {
			foreach ($arrone as $k => $v) {

				$lessons_id = $v['lesson_id'];
				$arrOneLesson = $clsLessons->getByCond("is_online = 1 AND lesson_id = $lessons_id");

				// print_r($arrOneLesson);

				$assign_list["arrOneLesson"] = $arrOneLesson;
			}

		}
		//End

		$stagesresult = $clsStage->getAll("lang_code='$_LANG_ID' AND is_online=1 AND parent_id = 0 AND cat_id=$cat_id ORDER BY order_no, reg_date ASC");
	}
	// print_r( $stagesresult);
	// die();

	if (is_array($stagesresult) && !empty($stagesresult)) {
		foreach ($stagesresult as $key => $stage) {
			$cats = $clsStage->getAll("parent_id = {$stage['stage_id']} AND lang_code = '$_LANG_ID' AND is_online = 1 ORDER BY order_no, reg_date ASC");

			if (is_array($cats)) {

				foreach ($cats as $key2 => $cat) {
					$lessons = $clsLessons->getAll("lang_code = '$_LANG_ID' AND is_online=1 AND stage_id={$cat['stage_id']} AND parent_id=0");

					if (is_array($lessons)) {
						foreach ($lessons as $k => $v) {
							$sublessons = $clsLessons->getAll("parent_id = {$v['lesson_id']} AND lang_code = '$_LANG_ID' AND is_online = 1 ORDER BY order_no, reg_date ASC");

							$pt = 0;
							$c = 0;

							if (is_array($sublessons)) {
								foreach ($sublessons as $kk => $vv) {
									$studyhistory = $clsLessons->getStudyHistory($user_id, $vv['lesson_id']);
									$total_time = $studyhistory['total_time'];
									$scores = $studyhistory['scores'];
									$total_question = $studyhistory['total_question'];
									$sublessons[$kk]['total_time'] = $total_time;
									$sublessons[$kk]['scores'] = $scores;
									$sublessons[$kk]['total_question'] = $total_question;
									$sublessons[$kk]['pt'] = $pt1 = ($vv['duration']>0)? ceil( ($total_time / $vv['duration']) * 100) : 0;

									$pt += $pt1;
									$c++;
								}
							}

							$lessons[$k]['pt'] = ($c>0)? ceil( $pt/$c ) : 0;
							$lessons[$k]['sublessons'] = $sublessons;
						}

						$cats[$key2]['lessons'] = $lessons;
					}
				}
			}

			$stagesresult[$key]['cats'] = $cats;
		}
	}

	// print_r($stagesresult);

	$assign_list['arrListTransactions'] = $arrListTransactions;
	$assign_list["stagesresult"] = $stagesresult;

	// End

	// Lấy danh sách câu hỏi thi thử
	// $questions = $clsQuestions->getByCategory($curCat);
	$bigQuestions = $clsQuestions->getAll("cat_id = $cat_id AND parent_id=0 AND lang_code = '$_LANG_ID' AND is_online = 1 ORDER BY questions_id ASC");

	if (is_array($bigQuestions)) {
		foreach ($bigQuestions as &$bigQuestion) {
			$limit = "";

			if ($bigQuestion['question_limit'] > 0) {
				$limit = "LIMIT $bigQuestion[question_limit]";
			}

			$questions = $clsQuestions->getAll("parent_id = $bigQuestion[questions_id] AND lang_code = '$_LANG_ID' AND is_online = 1 ORDER BY questions_id ASC $limit");

			if (is_array($questions)) {
				foreach ($questions as &$question) {
					$smallQuestions = $clsQuestions->getAll("parent_id = $question[questions_id] AND is_online = 1 ORDER BY questions_id ASC");

					if (is_array($smallQuestions)) {
						foreach ($smallQuestions as &$smallQuestion) {
							getAnswers($smallQuestion);
						}

						$question['smallQuestions'] = $smallQuestions;
					} else {
						getAnswers($question);
					}
				}

				$bigQuestion['questions'] = $questions;

			} else {
				getAnswers($bigQuestion);
			}
		}
	}

	// Regirect to test page
	if (GET('test') && is_array($bigQuestions)) {
		$act = 'test';
		// Show audio tag or not
		$showAudioTag = true;
		$assign_list["showAudioTag"] = $showAudioTag;
	}

	// Get user info
	if ($core->_SESS->isLoggedin()) {
		$user_id = $core->_USER['user_id'];
		$user = $clsUsers->getOne($user_id);
	}

	// Get bank accounts
	$bankAccounts = $clsPayment->getAll("is_online = 1 AND ctype=0 AND lang_code = '$_LANG_ID' ORDER BY order_no ASC, reg_date DESC");

	// Get department
	$locations = $clsPayment->getAll("is_online = 1 AND ctype=1 AND lang_code = '$_LANG_ID' ORDER BY order_no ASC, reg_date DESC");

//    dd($video);

	// phuonghv2022 danh sach cac bai cho thu theo khoa học
	// echo 123;
	// $clsLessons->setDebug();
	$arrListTrailCategory = $clsLessons->getAllSimple("a.is_online =1 AND a.cat_id = $cat_id AND a.video_id !='' AND a.is_trial=1 ORDER BY reg_date ASC LIMIT 0,12");
	// print_r($arrListTrailCategory);

	//End

	//Begin Assign
	$assign_list["h1_title"] = $h1_title;
	$assign_list["curCat"] = $curCat;
	$assign_list["parCat"] = $parCat;
	$assign_list["bigQuestions"] = $bigQuestions;
	$assign_list["stages"] = $stages;
	$assign_list["video"] = $video;
	$assign_list["user"] = $user;
	$assign_list["bankAccounts"] = $bankAccounts;
	$assign_list["locations"] = $locations;
	$assign_list["paymentStatus"] = $paymentStatus;
	$assign_list["arrListTrailCategory"] = $arrListTrailCategory;
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