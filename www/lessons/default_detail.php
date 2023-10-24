<?php
use Vimeo\Vimeo;

function default_detail() {
	global $assign_list, $_CONFIG, $_SITE_ROOT, $mod, $act, $clsRewrite, $VIMEO_API, $isMobile, $_LANG_ID, $core, $dbconn;

	$clsLessons = new Lessons();
	$clsQuestions = new Questions();
	$clsCategory = new Category();
	$clsStage = new Stage();
	$clsPayment = new Payment();
	$clsUsers = new Users();

	$clsTransactions = new Transactions();
	$clsCandidates = new Candidates();
	$clsTest = new Test();
	$clsExam = new Exam();

	// Get lesson
	$lesson = $clsLessons->getByIdOrSlug();
	
	$btnUpdateTime = POST("btnUpdateTime", "");
	if ($btnUpdateTime != "") {
		$arrJson = array("status" => "ERROR", "message" => "Error occur");
		if ($core->_SESS->isLoggedin()) {

			$beginTime = POST("beginTime", 0);
			$endTime = POST("endTime", 0);
			if ($beginTime > 1000 && $endTime > 1000) {
				$beginTime = intval($beginTime / 1000);
				$endTime = intval($endTime / 1000);

				$clsLessons->updateStudyHistory($lesson['lesson_id'], $beginTime, $endTime);

				$arrJson['status'] = "OK";
			}

		}
		echo json_encode($arrJson);
		exit();
	}

	$btnUpdatePoint = POST("btnUpdatePoint", "");
	if ($btnUpdatePoint != "") {
		$arrJson = array("status" => "ERROR", "message" => "Error occur");
		if ($core->_SESS->isLoggedin()) {

			$scores = POST("scores", 0);
			$total_question = POST("total_question", 0);
			$result = POST("result", "");
			if ($total_question > 0) {
				$clsLessons->updateStudyPoint($lesson['lesson_id'], $scores, $total_question, $result);

				$arrJson['status'] = "OK";
				$arrJson['message'] = "";
			}

		}
		echo json_encode($arrJson);
		exit();
	}

	// print_r($lesson);

	// Lấy video
	$video = getVideo($lesson);

	// print_r($video);
	if (is_array($video)) {
		$clsLessons->initStudyHistory($lesson['lesson_id']);
	}

	// Get others lessons
	$otherLessons = $clsLessons->getSiblings($lesson);

	// Get questions
	$bigQuestions = $clsQuestions->getAll("lesson_id = $lesson[lesson_id] AND parent_id=0 AND lang_code = '$_LANG_ID' AND is_online = 1 ORDER BY questions_id ASC");
	// echo 123;
	// print_r($bigQuestions);

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

	// Lấy danh sách giai đoạn và bài học
	$stages = $clsStage->getAll("lang_code='$_LANG_ID' AND is_online=1 AND parent_id = 0 AND cat_id = $lesson[cat_id] ORDER BY order_no, reg_date ASC");

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

	// Get others
	$curCat = $clsCategory->getOne($lesson['cat_id']);
	$cat_id = $curCat['cat_id'];

	// Lấy trạng thái thanh toán
	$paymentStatus = Transactions::getPaymentStatus($lesson['cat_id']);

	// Get user info
	if ($core->_SESS->isLoggedin()) {
		$user_id = $core->_USER['user_id'];
		$user = $clsUsers->getOne($user_id);
	}

	// Get bank accounts
	$bankAccounts = $clsPayment->getAll("is_online = 1 AND ctype=0 AND lang_code = '$_LANG_ID' ORDER BY order_no ASC, reg_date DESC");

	// Get department
	$locations = $clsPayment->getAll("is_online = 1 AND ctype=1 AND lang_code = '$_LANG_ID' ORDER BY order_no ASC, reg_date DESC");

	// Show audio tag or not
	$showAudioTag = true;

	$cat_id_trail = $curCat['cat_id'];
	// echo $cat_id_trail;
	$arrListTrailCategory = $clsLessons->getAllSimple("a.is_online =1 AND a.cat_id = $cat_id_trail AND a.video_id !='' AND a.is_trial=1 ORDER BY reg_date ASC LIMIT 0,12");
	// print_r($arrListTrailCategory);

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


	// số điểm làm bài tập

	// print_r($lesson);

	$studyhistory = $clsLessons->getStudyHistory($user_id, $lesson['lesson_id']);
	// print_r($studyhistory);
	if (is_array($studyhistory)){
		$scores = $studyhistory['scores'];
		$total_question = $studyhistory['total_question'];
		$question_result = br2nl(htmlDecode($studyhistory['question_result']));
		$question_result = str_replace("js-answer-input", "", $question_result);
	}
	// End

	// print_r($stagesresult);

	$assign_list['arrListTransactions'] = $arrListTransactions;
	$assign_list["stagesresult"] = $stagesresult;

	// Assign
	$assign_list["lesson"] = $lesson;
	$assign_list["video"] = $video;
	$assign_list["otherLessons"] = $otherLessons;
	$assign_list["bigQuestions"] = $bigQuestions;
	$assign_list["curCat"] = $curCat;
	$assign_list["stages"] = $stages;
	$assign_list["user"] = $user;
	$assign_list["bankAccounts"] = $bankAccounts;
	$assign_list["locations"] = $locations;
	$assign_list["paymentStatus"] = $paymentStatus;
	$assign_list["showAudioTag"] = $showAudioTag;
	$assign_list["arrListTrailCategory"] = $arrListTrailCategory;

	// Lấy số điểm và số câu hỏi
	$assign_list["scores"] = $scores;
	$assign_list["total_question"] = $total_question;
	$assign_list["question_result"] = $question_result;

	// echo $scores;
	// echo $total_question;

	// echo $total_question;

	// SEOmoz
	$_CONFIG['page_title'] = $lesson['name'] . " - " . $_CONFIG['site_title'];
	$_CONFIG['page_keywords'] = $arrOneTopic['meta_keywords'];
	$_CONFIG['page_description'] = $arrOneTopic['meta_des'];
	unset($tags, $des);
}

function getVideo($lesson) {
	$cat_id = $lesson['cat_id'];

	$video = [
		'image' => $lesson['image'],
	];

	$paymentCheck = Transactions::checkPaymentStatus($cat_id);

	// Check requirement
	if (empty($lesson['is_trial'])) {
		if (!Users::checkLoggedIn()) {
			$video['requirement'] = 1;
		} else if (!Transactions::checkPaymentStatus($cat_id)) {
			$video['requirement'] = 2;
		}
	}

	if (empty($video['requirement'])) {
		$video['attachment'] = $lesson['attachment'];
		$video['arrStream'] = getVideoStream($lesson);
	}

	return $video;
}

function getVideoStream($lesson) {
	global $VIMEO_API;

	if ($lesson['vimeo_id']) {
		$vimeo = new Vimeo($VIMEO_API['client_id'], $VIMEO_API['client_secret'], $VIMEO_API['access_token']);

		$videoStream = Vimeo_getAllStream($vimeo->request('/videos/' . $lesson['vimeo_id']), "mp4");

		if (is_array($videoStream) && !empty($videoStream)) {
			return $videoStream;
		}
	} else
	if ($lesson['video_id']) {
		$youtube = new Youtube();

		$obj = $youtube->setVideoID($lesson['video_id']);

		if ($obj->hasVideo()) {
			$videoStream = $obj->getAllStream("mp4");

			if (is_array($videoStream) && !empty($videoStream)) {
				return $videoStream;
			}
		}
	}

	return null;
}
