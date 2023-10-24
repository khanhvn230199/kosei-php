<?php

function default_ranking()
{
    global $assign_list, $_CONFIG, $dbconn;

    $test_id = GET("test_id");

    // Ckeck isset test_id
    $test = (new Test)->getOne($test_id);

    // Top học viên đạt điểm cao
    $sql = "SELECT a.*, b.*, c.fullname, c.avatar FROM _candidates a INNER JOIN (SELECT user_id, MAX(total_score) as max_score FROM _candidates WHERE test_id = $test_id GROUP BY user_id) AS b INNER JOIN _users c WHERE a.test_id = $test_id AND a.user_id = b.user_id AND a.user_id = c.user_id AND a.total_score = b.max_score AND a.total_score>0 GROUP BY a.user_id ORDER BY b.max_score DESC";

    $highScores = $dbconn->GetAll($sql, false);

    // Assign
    $assign_list["test"] = $test;
    $assign_list["highScores"] = $highScores;

    //Begin SEOmoz
    $page_title .= " - " . $_CONFIG['site_title'];
    $_CONFIG['page_title'] = $page_title;
}
