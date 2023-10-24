<?

class Questions extends dbBasic
{
    public function Questions()
    {
        $this->pkey = "questions_id";
        $this->tbl = "_questions";
    }
    //SELECT

    /**
     * Get list Questions by ID or array ID
     *
     * @param number $id
     */
    public function getListQuestionsById($id = 0)
    {
        $cond = "";
        if (is_numeric($id)) {
            $cond = "questions_id=$id";
        } else
        if (is_array($id)) {
            $s = implode(',', $id);
            $cond = "questions_id IN ($s)";
        } else
        if (strpos(',', $id) !== false) {
            $cond = "questions_id IN ($id)";
        }
        $cond .= " ORDER BY order_no";
        return $this->getAll($cond);
    }
    //INSERT
    //UPDATE
    //DELETE
    //OTHER

    public function cur_level($questions_id, $level = 1)
    {
        if (isset($questions_id) && $questions_id > 0) {
            $arrQuestion = $this->getOne($questions_id);
            if ($arrQuestion['parent_id'] > 0) {
                return $this->cur_level($arrQuestion['parent_id'], $level + 1);
            } else {
                return $level + 1;
            }
        } else {
            return $level;
        }
    }

    public function getByLesson($lesson)
    {
        global $_LANG_ID;

        $questions = $this->getAll("lesson_id = $lesson[lesson_id] AND parent_id = 0 AND lang_code = '$_LANG_ID' AND is_online = 1 ORDER BY questions_id");

        $questions = $this->getChildren($questions);

        return $questions;
    }

    public function getByCategory($cat)
    {
        global $_LANG_ID;

        $questions = $this->getAll("cat_id = $cat[cat_id] AND parent_id = 0 AND lang_code = '$_LANG_ID' AND is_online = 1 ORDER BY questions_id");

        $questions = $this->getChildren($questions);

        return $questions;
    }

    public function getChildren($questions)
    {
        if (is_array($questions)) {

            $questions = array_map(function ($question) {
                $children = $this->getAll("parent_id = {$question['questions_id']} AND is_online = 1 ORDER BY questions_id LIMIT {$question['question_limit']}");

                if (is_array($children)) {
                    $children = array_map(function ($child) {
                        $child['children'] = $this->getAll("parent_id = $child[questions_id] AND is_online = 1 ORDER BY questions_id");

                        return $child;
                    }, $children);
                }

                $question['children'] = $children;

                return $question;
            }, $questions);
        }

        return $questions;
    }
}

function makeArrayListQuestions(&$ret, $short = 0)
{
    global $dbconn;
    $sql = "SELECT a.*,c.name as course_name FROM _questions AS a INNER JOIN _category as c ON a.cat_id = c.cat_id WHERE a.is_online=1";
    $sql .= " ORDER BY a.order_no, a.questions_id";
    $arrListQuestions = $dbconn->GetAll($sql);
    if (is_array($arrListQuestions)) {
        foreach ($arrListQuestions as $k => $v) {
            $value = $v["questions_id"];
            $option = ($short == 1) ? $v["name"] . " &lt;" . $v["course_name"] . "&gt;" : $v["name"];
            $ret["$value"] = $option;
        }
        unset($arrListQuestions);
        return "";
    }
    unset($arrListQuestions);
    return "";
}
