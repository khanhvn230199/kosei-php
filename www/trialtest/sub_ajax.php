<?

function ajax_default()
{
    global $assign_list, $_CONFIG, $_SITE_ROOT, $mod;
    global $core, $_LANG_ID;
    exit();
}

function ajax_save_score()
{
    global $core, $dbconn, $_LANG_ID;

    $clsCandidates = new Candidates();
    $user_id = $core->_USER['user_id'];

$clsTest = new Test();


    if (!is_array($_POST) || $user_id == 0) {
        echo 'No input';
        exit();
    }

    $test_id = POST('test_id', 0);
    $tt_id = POST('tt_id', 0);
    
    $level_id = POST('level_id', 0);


    $arrOneTest = $clsTest->getOneSimple("a.test_id=$test_id AND tt_id = $tt_id AND a.lang_code='$_LANG_ID' AND a.is_online = 1");
    if ($level_id=="" || $level_id==0){
        $level_id = $arrOneTest['level_id'];
    }

    
    $vocab = POST('vocab', 0);
    $reading = POST('reading', 0);
    $listening = POST('listening', 0);
    $total = POST('total', 0);
    $answers = POST('answers');

    if (!$total || !$test_id || !$tt_id) {
        echo 'Wrong input!';
        exit();
    }

    $reg_date = time();
    $clsCandidates->setDebug();
    $ok = (new Candidates)->insertOne("test_id, level_id,tt_id, user_id, vocabulary_score, reading_score, listening_score, total_score, reg_date, answers", "$test_id,$level_id, $tt_id, $user_id, $vocab, $reading, $listening, $total, $reg_date, '$answers'");

    if (!$ok) {
        echo 'Can not insert to database!';
        exit();
    }

    echo 'Success';
    exit();
}
