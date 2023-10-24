<?
/******************************************************
 * Class Rewrite (URL Rewrite Controller)
 *
 * Parse URL string to corresponding vars
 *
 * Project Name               :  ClientWebsite
 * Package Name                    :
 * Program ID                 :  clsRewrite.php
 * Environment                :  PHP  version 4, 5
 * Author                     :  TuanTA
 * Version                    :  1.0
 * Creation Date              :  20/01/2018
 *
 * Modification History     :
 * Version    Date            Person Name        Chng  Req   No    Remarks
 * 1.0        20/01/2018        banglcb          -        -     -     -
 *
 ********************************************************/

/**
 * Rewrite Class
 *
 * @author Tuanta
 *
 */
class Rewrite
{
    public $base   = "";
    public $actual = "";
    public $path   = "";
    public $rules  = array();
    public $e404   = "error404.php";
    public $exec   = 0;

    /**
     * Initialize class
     *
     * @param                : string $base
     * @return            : no
     */
    public function Rewrite ($base)
    {
        $this->path = parse_url($_SERVER['REQUEST_URI']);
        $this->actual = $this->path == "/" ? array("") : explode("/", $this->path['path']);
        $this->base = $base;
        $this->execute();
    }

    /**
     * Return page 404
     *
     * @param                : no
     * @return            : no
     */
    public function error404 ()
    {
        header('HTTP/1.1 404 Not Found');
        header('Status: 404 Not Found');
        if ($this->e404 != '') {
            require $this->e404;
        }

        exit();
    }

    /**
     * Parse URL path to detect params and assign to $_GET
     *
     * @param                : no
     * @return            : no
     */
    public function execute ()
    {
        global $_CAT_SLUG;
        $this->exec = 1;
        if (strpos($this->path['path'], 'http:') !== false || strpos($this->path['path'], '?') !== false) {
            $this->error404();
        }
        $ok = preg_match("/\.(jpg|jpeg|gif|ico|png|js|css|txt|swf|tpl|ttf|xml|doc|zip|rar|xls|mp3|avi)$/i", $this->path['path'], $match);
        if ($ok) {
            $this->error404();
            return 0;
        }
        $this->url_article();
        $this->url_teacher();
        $this->url_syllabus();
        $this->url_exam();
        $this->url_exam_detail();
        $this->url_practice();
        $this->url_trialtest();
        $this->url_trialtestregister();
        $this->url_retest();
        $this->url_search();
        $this->url_tags();
        $this->url_lesson();
        $this->url_stage();
        $this->url_checkout();
        $this->url_page();
        $this->url_home();
        $this->url_contact();
        $this->url_ranking();
        $this->url_viewcart();
        $this->url_account();
        $this->url_history();
        $this->url_historylearning();
        $this->url_login();
        $this->url_resetpass();
        $this->url_fbauth();
        $this->url_ggauth();
        $this->url_register();
        $this->url_logout();
        $this->url_changeinfo();
        $this->url_active();
        $this->url_favorite();
        $this->url_viewed();
        $this->url_category();
        $this->url_order();
        $this->exec = 0;
    }

    /**
     * Find type of category
     *
     * @param unknown $query
     * @return number
     */
    public function findCTYPE ($query)
    {
        global $_CAT_SLUG;
        $ctype = -1;
        $maxlen = 0;
        foreach ($_CAT_SLUG as $key => $val) {
            $ok = (strpos('a' . $query, $key) == 1 || $query == $key);
            if ($ok && $maxlen < strlen($key)) {
                $ctype = $val;
                $maxlen = strlen($key);
                $slug = $key;
            }
        }
        return $ctype;
    }

    /**
     *
     * @param string $category
     * @return string
     */
    public function url_category ($category = "")
    {
        global $_CONFIG;
        if ($this->exec) {
            $ok = preg_match("/^\/category\/([a-zA-Z0-9]+[a-zA-Z\_0-9\.-]*)$/i", $this->path['path'], $regs);
            if ($ok) {
                $ctype = $this->findCTYPE($regs[1]);
                if ($ctype == CTYPE_BV) {
                    $_GET["mod"] = "articles";
                    $_GET["slug"] = $regs[1];
                } else if ($ctype == CTYPE_KH) {
                    $_GET["mod"] = "lessons";
                    $_GET["slug"] = $regs[1];
                } else if ($ctype == CTYPE_CB) {
                    $_GET["mod"] = "lessons";
                    $_GET["act"] = "combo";
                    $_GET["slug"] = $regs[1];
                } else if ($ctype == CTYPE_GV) {
                    $_GET["mod"] = "teacher";
                    $_GET["slug"] = $regs[1];
                } else if ($ctype == CTYPE_GT) {
                    $_GET["mod"] = "syllabus";
                    $_GET["slug"] = $regs[1];
                } else {
                    $_GET["mod"] = "home";
                    $_GET["act"] = "notfound";
                }
                $this->exec = 0;
                return 1;
            }
            return 0;
        }
        if (!is_array($category)) {
            $html = VNCMS_URL . "/category/" . $category;
        } else {
            if ($_CONFIG['enable_urlrewrite'] == 1) {
                $html = VNCMS_URL . "/category/" . $category['slug'];
            } else {
                $html = VNCMS_URL . "/?mod=news&view_cat_id=" . $category['cat_id'] . "&view_cat_name=" . $category['slug'];
            }
        }
        return $html;
    }

    /**
     *
     * @param string $article
     * @return string
     */
    public function url_article ($article = "")
    {
        global $_CONFIG;
        if ($this->exec) {
            $ok = preg_match("/^\/([a-zA-Z0-9]+[a-zA-Z\_0-9\.-]*)-tin([0-9]+)([^0-9]*)$/i", $this->path['path'], $regs);
            if ($ok) {
                $_GET["mod"] = "articles";
                $_GET["act"] = "detail";
                $_GET["article_id"] = $regs[2];
                if ($regs[3] != '') {
                    $_GET["mod"] = "home";
                    $_GET["act"] = "notfound";
                }
                $this->exec = 0;
                return 1;
            }
            return 0;
        }
        if (!is_array($article)) {
            $html = VNCMS_URL . "/" . $article;
        } else {
            if ($_CONFIG['enable_urlrewrite'] == 1) {
                $html = VNCMS_URL . "/" . $article['slug'] . "-tin" . $article['article_id'];
            } else {
                $html = VNCMS_URL . "/?mod=articles&view_article_id=" . $article['article_id'] . "&view_slug=" . $article['slug'];
            }
        }
        return $html;
    }

    /**
     *
     * @param string $teacher
     * @return string
     */
    public function url_teacher ($teacher = "")
    {
        global $_CONFIG;
        if ($this->exec) {
            $ok = preg_match("/^\/([a-zA-Z0-9]+[a-zA-Z\_0-9\.-]*)-gv([0-9]+)([^0-9]*)$/i", $this->path['path'], $regs);
            if ($ok) {
                $_GET["mod"] = "teacher";
                $_GET["act"] = "detail";
                $_GET["article_id"] = $regs[2];
                if ($regs[3] != '') {
                    $_GET["mod"] = "home";
                    $_GET["act"] = "notfound";
                }
                $this->exec = 0;
                return 1;
            }
            return 0;
        }
        if (!is_array($teacher)) {
            $html = VNCMS_URL . "/" . $teacher;
        } else {
            if ($_CONFIG['enable_urlrewrite'] == 1) {
                $html = VNCMS_URL . "/" . $teacher['slug'] . "-gv" . $teacher['article_id'];
            } else {
                $html = VNCMS_URL . "/?mod=teacher&view_article_id=" . $teacher['article_id'] . "&view_slug=" . $teacher['slug'];
            }
        }
        return $html;
    }

    /**
     *
     * @param string $syllabus
     * @return string
     */
    public function url_syllabus ($syllabus = "")
    {
        global $_CONFIG;
        if ($this->exec) {
            $ok = preg_match("/^\/([a-zA-Z0-9]+[a-zA-Z\_0-9\.-]*)-gt([0-9]+)([^0-9]*)$/i", $this->path['path'], $regs);
            if ($ok) {
                $_GET["mod"] = "syllabus";
                $_GET["act"] = "detail";
                $_GET["article_id"] = $regs[2];
                if ($regs[3] != '') {
                    $_GET["mod"] = "home";
                    $_GET["act"] = "notfound";
                }
                $this->exec = 0;
                return 1;
            }
            return 0;
        }
        if (!is_array($syllabus)) {
            $html = VNCMS_URL . "/" . $syllabus;
        } else {
            if ($_CONFIG['enable_urlrewrite'] == 1) {
                $html = VNCMS_URL . "/" . $syllabus['slug'] . "-gt" . $syllabus['article_id'];
            } else {
                $html = VNCMS_URL . "/?mod=syllabus&view_article_id=" . $syllabus['article_id'] . "&view_slug=" . $syllabus['slug'];
            }
        }
        return $html;
    }

    /**
     *
     * @param string $exam
     * @return string
     */
    public function url_exam ($exam = "")
    {
        global $_CONFIG;
        if ($this->exec) {
            $ok = preg_match("/^\/practice\/level-([0-9]+)([^0-9]*)\/skill-([0-9]+)([^0-9]*)$/i", $this->path['path'], $regs);
            if ($ok) {
                $_GET["mod"] = "exams";
                $_GET["act"] = "default";
                $_GET["level_id"] = $regs[1];
                $_GET["skill_id"] = $regs[3];
                if ($regs[4] != '') {
                    $_GET["mod"] = "home";
                    $_GET["act"] = "notfound";
                }
                $this->exec = 0;
                return 1;
            }
            $ok = preg_match("/^\/exams$/i", $this->path['path'], $regs);
            if ($ok) {
                $_GET["mod"] = "exams";
                $this->exec = 0;
                return 1;
            }
            $ok = preg_match("/^\/exams\/ajax\/([a-zA-Z0-9\_]+)$/i", $this->path['path'], $regs);
            if ($ok) {
                $_GET["mod"] = "exams";
                $_GET["sub"] = "ajax";
                $_GET["act"] = $regs[1];
                $this->exec = 0;
                return 1;
            }
            return 0;
        }
        if (!is_array($exam)) {
            $html = VNCMS_URL . "/practice/level-$_GET[level_id]/" . $exam;
        } else {
            if ($_CONFIG['enable_urlrewrite'] == 1) {
                $html = VNCMS_URL . "/practice/level-$_GET[level_id]/skill-" . $exam['skill_id'];
            } else {
                $html = VNCMS_URL . "/?mod=exams&view_level_id=$exam[level_id]&view_skill_id=$exam[skill_id]";
            }
        }
        return $html;
    }

    /**
     *
     * @param string $exam
     * @return string
     */
    public function url_exam_detail ($exam = "")
    {
        global $_CONFIG;
        if ($this->exec) {
            $ok = preg_match("/^\/exams\/([a-zA-Z0-9]+[a-zA-Z\_0-9\.-]*)-ex([0-9]+)([^0-9]*)$/i", $this->path['path'], $regs);
            if ($ok) {
                $_GET["mod"] = "exams";
                $_GET["act"] = "detail";
                $_GET["exam_id"] = $regs[2];
                if ($regs[3] != '') {
                    $_GET["mod"] = "home";
                    $_GET["act"] = "notfound";
                }
                $this->exec = 0;
                return 1;
            }
            $ok = preg_match("/^\/exams\/preview-e([0-9]+)([^0-9]*)$/i", $this->path['path'], $regs);
            if ($ok) {
                $_GET["mod"] = "exams";
                $_GET["act"] = "preview";
                $_GET["exam_id"] = $regs[1];
                if ($regs[2] != '') {
                    $_GET["mod"] = "home";
                    $_GET["act"] = "notfound";
                }
                $this->exec = 0;
                return 1;
            }
            return 0;
        }
        if (!is_array($exam)) {
            $html = VNCMS_URL . "/exams" . $exam;
        } else {
            if ($_CONFIG['enable_urlrewrite'] == 1) {
                $html = VNCMS_URL . "/exams/" . $exam['slug'] . "-ex" . $exam['exam_id'];
            } else {
                $html = VNCMS_URL . "/?mod=exams&view_exam_id=" . $exam['exam_id'] . "&view_slug=" . $exam['slug'];
            }
        }
        return $html;
    }

    /**
     *
     * @param string $level
     * @return string
     */
    public function url_practice ($level = "")
    {
        global $_CONFIG;
        if ($this->exec) {
            $ok = preg_match("/^\/practice\/([a-zA-Z0-9]+[a-zA-Z\_0-9\.-]*)-([0-9]+)([^0-9]*)$/i", $this->path['path'], $regs);
            if ($ok) {
                $_GET["mod"] = "practice";
                $_GET["act"] = "skill";
                $_GET["level_id"] = $regs[2];
                if ($regs[3] != '') {
                    $_GET["mod"] = "home";
                    $_GET["act"] = "notfound";
                }
                $this->exec = 0;
                return 1;
            }
            $ok = preg_match("/^\/practice$/i", $this->path['path'], $regs);
            if ($ok) {
                $_GET["mod"] = "practice";
                $this->exec = 0;
                return 1;
            }
            return 0;
        }
        if (!is_array($level)) {
            $html = VNCMS_URL . "/practice" . $level;
        } else {
            if ($_CONFIG['enable_urlrewrite'] == 1) {
                $html = VNCMS_URL . "/practice/level-" . $level['level_id'];
            } else {
                $html = VNCMS_URL . "/?mod=practice&view_level_id=" . $level['level_id'] . "&view_code=" . $level['code'];
            }
        }
        return $html;
    }

    /**
     *
     * @param string $trialtest
     * @return string
     */
    public function url_trialtest ($trialtest = "")
    {
        global $_CONFIG;
        if ($this->exec) {
            $ok = preg_match("/^\/trial-test\/register$/i", $this->path['path'], $regs);
            if ($ok) {
                $_GET["mod"] = "trialtest";
                $_GET["act"] = "register";
                $_GET["test_id"] = $regs[1];
                if ($regs[2] != '') {
                    $_GET["mod"] = "home";
                    $_GET["act"] = "notfound";
                }
                $this->exec = 0;
                return 1;
            }
            $ok = preg_match("/^\/trial-test\/([a-zA-Z0-9]+[a-zA-Z\_0-9\.-]*)-t([0-9]+)([^0-9]*)$/i", $this->path['path'], $regs);
            if ($ok) {
                $_GET["mod"] = "trialtest";
                $_GET["act"] = "detail";
                $_GET["test_id"] = $regs[2];
                if ($regs[3] != '') {
                    $_GET["mod"] = "home";
                    $_GET["act"] = "notfound";
                }
                $this->exec = 0;
                return 1;
            }
            $ok = preg_match("/^\/trial-test\/preview-([0-9]+)([^0-9]*)$/i", $this->path['path'], $regs);
            if ($ok) {
                $_GET["mod"] = "trialtest";
                $_GET["act"] = "preview";
                $_GET["test_id"] = $regs[1];
                if ($regs[2] != '') {
                    $_GET["mod"] = "home";
                    $_GET["act"] = "notfound";
                }
                $this->exec = 0;
                return 1;
            }
            $ok = preg_match("/^\/trial-test$/i", $this->path['path'], $regs);
            if ($ok) {
                $_GET["mod"] = "trialtest";
                $this->exec = 0;
                return 1;
            }
            $ok = preg_match("/^\/trial-test\/ajax\/([a-zA-Z0-9\_]+)$/i", $this->path['path'], $regs);
            if ($ok) {
                $_GET["mod"] = "trialtest";
                $_GET["sub"] = "ajax";
                $_GET["act"] = $regs[1];
                $this->exec = 0;
                return 1;
            }
            return 0;
        }
        if (!is_array($trialtest)) {
            $html = VNCMS_URL . "/trial-test" . $trialtest;
        } else {
            if ($_CONFIG['enable_urlrewrite'] == 1) {
                $html = VNCMS_URL . "/trial-test/" . $trialtest['slug'] . "-t" . $trialtest['test_id'];
            } else {
                $html = VNCMS_URL . "/?mod=trialtest&test_id=" . $trialtest['test_id'] . "&view_slug=" . $trialtest['slug'];
            }
        }
        return $html;
    }

    /**
     *
     * @return string
     */
    public function url_trialtestregister ()
    {
        global $_CONFIG;
        if ($this->exec) {
            $ok = preg_match("/^\/trial-test-register$/i", $this->path['path'], $regs);
            if ($ok) {
                $_GET["mod"] = "account";
                $_GET["act"] = "trialtestregister";
                $this->exec = 0;
                return 1;
            }
            return 0;
        }
        if ($_CONFIG['enable_urlrewrite'] == 1) {
            $html = VNCMS_URL . "/trial-test-register";
        } else {
            $html = VNCMS_URL . "/?mod=account&act=trialtestregister";
        }
        return $html;
    }

    /**
     *
     * @param string $exam
     * @return string
     */
    public function url_retest ($exam = "")
    {
        global $_CONFIG;
        if ($this->exec) {
            $ok = preg_match("/^\/retest\/([a-zA-Z0-9]+[a-zA-Z\_0-9\.-]*)-rex([0-9]+)([^0-9]*)$/i", $this->path['path'], $regs);
            if ($ok) {
                $_GET["mod"] = "exams";
                $_GET["act"] = "retest";
                $_GET["result_id"] = $regs[2];
                if ($regs[3] != '') {
                    $_GET["mod"] = "home";
                    $_GET["act"] = "notfound";
                }
                $this->exec = 0;
                return 1;
            }
            return 0;
        }
        if (!is_array($exam)) {
            $html = VNCMS_URL . "/retest" . $exam;
        } else {
            if ($_CONFIG['enable_urlrewrite'] == 1) {
                $html = VNCMS_URL . "/retest/" . $exam['slug'] . "-rex" . $exam['result_id'];
            } else {
                $html = VNCMS_URL . "/?mod=exams&act=retest&result_id=" . $exam['result_id'];
            }
        }
        return $html;
    }

    /**
     * @param string $Keyword
     * @return int|string
     */

    public function url_search ($Keyword = "")
    {
        global $_CONFIG;
        if ($this->exec) {
            $ok = preg_match("/^\/articles\/search$/i", $this->path['path'], $regs);
            if ($ok) {
                $_GET["mod"] = "articles";
                $_GET["act"] = "search";
                $this->exec = 0;
                return 1;
            }
            return 0;
        }
        if ($_CONFIG['enable_urlrewrite'] == 1) {
            $html = VNCMS_URL . "/search?key=$Keyword";
        } else {
            $html = VNCMS_URL . "/?mod=articles&act=search?key=$Keyword";
        }
        return $html;
    }

    /**
     * @param string $Tags
     * @return int|string
     */

    public function url_tags ($Tags = "")
    {
        global $_CONFIG;
        if ($this->exec) {
            $ok = preg_match("/^\/articles\/tags$/i", $this->path['path'], $regs);
            if ($ok) {
                $_GET["mod"] = "articles";
                $_GET["act"] = "tags";
                $this->exec = 0;
                return 1;
            }
            return 0;
        }
        if ($_CONFIG['enable_urlrewrite'] == 1) {
            $html = VNCMS_URL . "/tags/" . utf8_nosign_noblank($Tags);
        } else {
            $html = VNCMS_URL . "/?mod=articles&act=tags&key=$Tags";
        }
        return $html;
    }

    /**
     *
     * @param string $lessons
     * @return string
     */
    public function url_lesson ($lessons = "")
    {
        global $_CONFIG;
        if ($this->exec) {
            $ok = preg_match("/^\/([a-zA-Z0-9]+[a-zA-Z\_0-9\.-]*)-l([0-9]+)([^0-9]*)$/i", $this->path['path'], $regs);
            if ($ok) {
                $_GET["mod"] = "lessons";
                $_GET["act"] = "detail";
                $_GET["lesson_id"] = $regs[2];
                if ($regs[3] != '') {
                    $_GET["mod"] = "home";
                    $_GET["act"] = "notfound";
                }
                $this->exec = 0;
                return 1;
            }
            $ok = preg_match("/lessons\/search$/i", $this->path['path'], $regs);
            if ($ok) {
                $_GET["mod"] = "lessons";
                $_GET["act"] = "search";
                $this->exec = 0;
                return 1;
            }
            $ok = preg_match("/^\/lessons\/ajax\/([a-zA-Z0-9\_]+)$/i", $this->path['path'], $regs);
            if ($ok) {
                $_GET["mod"] = "lessons";
                $_GET["sub"] = "ajax";
                $_GET["act"] = $regs[1];
                $this->exec = 0;
                return 1;
            }
            return 0;
        }
        if (!is_array($lessons)) {
            $html = VNCMS_URL . "/" . $lessons;
        } else {
            if ($_CONFIG['enable_urlrewrite'] == 1) {
                // $cat = (new Category)->getOne($lessons['cat_id']);
                // $html = $this->url_category($cat) . "?lesson_id=" . $lessons['lesson_id'];
                $html = VNCMS_URL . "/" . $lessons['slug'] . "-l" . $lessons['lesson_id'];
            } else {
                $html = VNCMS_URL . "/?mod=lessons&view_lesson_id=" . $lessons['lesson_id'] . "&view_slug=" . $lessons['slug'];
            }
        }
        return $html;
    }

    /**
     *
     * @param string $stage
     * @return string
     */
    public function url_stage ($stage = "")
    {
        global $_CONFIG;
        if ($this->exec) {
            $ok = preg_match("/^\/([a-zA-Z0-9]+[a-zA-Z\_0-9\.-]*)-st([0-9]+)([^0-9]*)$/i", $this->path['path'], $regs);
            if ($ok) {
                $_GET["mod"] = "lessons";
                $_GET["stage_id"] = $regs[2];
                if ($regs[3] != '') {
                    $_GET["mod"] = "home";
                    $_GET["act"] = "notfound";
                }
                $this->exec = 0;
                return 1;
            }
            $ok = preg_match("/stage\/search$/i", $this->path['path'], $regs);
            if ($ok) {
                $_GET["mod"] = "stage";
                $_GET["act"] = "search";
                $this->exec = 0;
                return 1;
            }
            $ok = preg_match("/^\/stage\/ajax\/([a-zA-Z0-9\_]+)$/i", $this->path['path'], $regs);
            if ($ok) {
                $_GET["mod"] = "stage";
                $_GET["sub"] = "ajax";
                $_GET["act"] = $regs[1];
                $this->exec = 0;
                return 1;
            }
            return 0;
        }
        if (!is_array($stage)) {
            $html = VNCMS_URL . "/" . $stage;
        } else {
            if ($_CONFIG['enable_urlrewrite'] == 1) {
                $html = VNCMS_URL . "/" . $stage['slug'] . "-st" . $stage['stage_id'];
            } else {
                $html = VNCMS_URL . "/?mod=stage&view_stage_id=" . $stage['stage_id'] . "&view_slug=" . $stage['slug'];
            }
        }
        return $html;
    }

    /**
     *
     * @return string
     */
    public function url_checkout ()
    {
        global $_CONFIG;
        if ($this->exec) {
            $ok = preg_match("/course\/checkout$/i", $this->path['path'], $regs);
            if ($ok) {
                $_GET["mod"] = "stage";
                $_GET["act"] = "checkout";
                $this->exec = 0;
                return 1;
            }
            return 0;
        }
        if ($_CONFIG['enable_urlrewrite'] == 1) {
            $html = VNCMS_URL . "/course/checkout";
        } else {
            $html = VNCMS_URL . "/?mod=stage&act=checkout";
        }
        return $html;
    }

    /**
     *
     * @param string $arrOnePage
     * @return string
     */
    public function url_page ($arrOnePage = "")
    {
        global $_CONFIG;
        if ($this->exec) {
            $ok = preg_match("/^\/page\/([a-zA-Z0-9]+[a-zA-Z\_0-9\.-]*)$/i", $this->path['path'], $regs);
            if ($ok) {
                $_GET["mod"] = "home";
                $_GET["act"] = "page";
                $_GET["slug"] = $regs[1];
                $this->exec = 0;
                return 1;
            }
            return 0;
        }
        if (!is_array($arrOnePage)) {
            return VNCMS_URL . "/page/" . $arrOnePage;
        }
        if ($_CONFIG['enable_urlrewrite'] == 1) {
            $html = VNCMS_URL . "/page/" . $arrOnePage['slug'];
        } else {
            $html = VNCMS_URL . "/?pid=" . $arrOnePage['slug'];
        }
        return $html;
    }

    /**
     *
     * @return string
     */
    public function url_home ()
    {
        if ($this->exec) {
            $ok = preg_match("/^\/api\/([a-zA-Z\_0-9]+)$/i", $this->path['path'], $regs);
            if ($ok) {
                $_GET["mod"] = "home";
                $_GET["sub"] = "api";
                $_GET["act"] = $regs[1];
                return 1;
            }
            $ok = preg_match("/^\/ajax\/([a-zA-Z\_0-9]+)$/i", $this->path['path'], $regs);
            if ($ok) {
                $_GET["mod"] = "home";
                $_GET["sub"] = "ajax";
                $_GET["act"] = $regs[1];
                return 1;
            }
            $ok = preg_match("/.+$/i", $this->path['path'], $regs);
            if ($ok) {
                $_GET["mod"] = "home";
                $_GET["act"] = "default";
                return 1;
            }
            return 0;
        }
        $html = VNCMS_URL;
        return $html;
    }

    /**
     *
     * @return string
     */
    public function url_contact ()
    {
        global $_CONFIG;
        if ($this->exec) {
            $ok = preg_match("/contact$/i", $this->path['path'], $regs);
            if ($ok) {
                $_GET["mod"] = "home";
                $_GET["act"] = "contact";
                return 1;
            }
            return 0;
        }
        if ($_CONFIG['enable_urlrewrite'] == 1) {
            $html = VNCMS_URL . "/contact";
        } else {
            $html = VNCMS_URL . "/?mod=home&act=contact";
        }
        return $html;
    }

    /**
     *
     * @return string
     */
    public function url_ranking ()
    {
        global $_CONFIG;
        if ($this->exec) {
            $ok = preg_match("/ranking$/i", $this->path['path'], $regs);
            if ($ok) {
                $_GET["mod"] = "trialtest";
                $_GET["act"] = "ranking";
                return 1;
            }
            return 0;
        }

        if ($_CONFIG['enable_urlrewrite'] == 1) {
            $html = VNCMS_URL . "/ranking";
        } else {
            $html = VNCMS_URL . "/?mod=home&act=contact";
        }
        return $html;
    }

    public function url_viewcart ()
    {
        global $_CONFIG;
        if ($this->exec) {
            $ok = preg_match("/^\/cart/i", $this->path['path'], $regs);
            if ($ok) {
                $_GET["mod"] = "cart";
                $_GET["sub"] = "default";
                $this->exec = 0;
                return 1;
            }
            return 0;
        }
        if ($_CONFIG['enable_urlrewrite'] == 1) {
            $html = VNCMS_URL . "/cart";
        } else {
            $html = VNCMS_URL . "/?mod=cart";
        }
        return $html;
    }

    public function url_account ()
    {
        global $_CONFIG;
        if ($this->exec) {
            $ok = preg_match("/^\/account$/i", $this->path['path'], $regs);
            if ($ok) {
                $_GET["mod"] = "account";
                $_GET["sub"] = "default";
                $this->exec = 0;
                return 1;
            }
            $ok = preg_match("/^\/account\/ajax\/([a-zA-Z0-9]+)$/i", $this->path['path'], $regs);
            if ($ok) {
                $_GET["mod"] = "account";
                $_GET["sub"] = "ajax";
                $_GET["act"] = $regs[1];
                $this->exec = 0;
                return 1;
            }
            return 0;
        }
        if ($_CONFIG['enable_urlrewrite'] == 1) {
            $html = VNCMS_URL . "/account";
        } else {
            $html = VNCMS_URL . "/?mod=account";
        }
        return $html;
    }

    public function url_history ()
    {
        global $_CONFIG;
        if ($this->exec) {
            $ok = preg_match("/^\/account\/history$/i", $this->path['path'], $regs);
            if ($ok) {
                $_GET["mod"] = "account";
                $_GET["act"] = "history";
                $this->exec = 0;
                return 1;
            }
            return 0;
        }
        if ($_CONFIG['enable_urlrewrite'] == 1) {
            $html = VNCMS_URL . "/account/history";
        } else {
            $html = VNCMS_URL . "/?mod=account&act=history";
        }
        return $html;
    }

     public function url_historylearning ()
    {
        global $_CONFIG;
        if ($this->exec) {
            $ok = preg_match("/^\/account\/historylearning$/i", $this->path['path'], $regs);
            if ($ok) {
                $_GET["mod"] = "account";
                $_GET["act"] = "historylearning";
                $this->exec = 0;
                return 1;
            }
            return 0;
        }
        if ($_CONFIG['enable_urlrewrite'] == 1) {
            $html = VNCMS_URL . "/account/historylearning";
        } else {
            $html = VNCMS_URL . "/?mod=account&act=historylearning";
        }
        return $html;
    }


    public function url_login ()
    {
        global $_CONFIG;
        if ($this->exec) {
            $ok = preg_match("/^\/login$/i", $this->path['path'], $regs);
            if ($ok) {
                $_GET["mod"] = "account";
                $_GET["act"] = "login";
                $this->exec = 0;
                return 1;
            }
            return 0;
        }
        if ($_CONFIG['enable_urlrewrite'] == 1) {
            $html = VNCMS_URL . "/login";
        } else {
            $html = VNCMS_URL . "/?mod=account&act=login";
        }
        return $html;
    }

    public function url_fbauth ()
    {
        global $_CONFIG;
        if ($this->exec) {
            $ok = preg_match("/^\/facebook-authentication$/i", $this->path['path'], $regs);
            if ($ok) {
                $_GET["mod"] = "account";
                $_GET["act"] = "fbauth";
                $this->exec = 0;
                return 1;
            }
            return 0;
        }
        if ($_CONFIG['enable_urlrewrite'] == 1) {
            $html = VNCMS_URL . "/facebook-authentication";
        } else {
            $html = VNCMS_URL . "/?mod=account&act=fbauth";
        }
        return $html;
    }

    public function url_ggauth ()
    {
        global $_CONFIG;
        if ($this->exec) {
            $ok = preg_match("/^\/google-authentication$/i", $this->path['path'], $regs);
            if ($ok) {
                $_GET["mod"] = "account";
                $_GET["act"] = "ggauth";
                $this->exec = 0;
                return 1;
            }
            return 0;
        }
        if ($_CONFIG['enable_urlrewrite'] == 1) {
            $html = VNCMS_URL . "/google-authentication";
        } else {
            $html = VNCMS_URL . "/?mod=account&act=ggauth";
        }
        return $html;
    }

    public function url_register ()
    {
        global $_CONFIG;
        if ($this->exec) {
            $ok = preg_match("/^\/register$/i", $this->path['path'], $regs);
            if ($ok) {
                $_GET["mod"] = "account";
                $_GET["act"] = "register";
                $this->exec = 0;
                return 1;
            }
            return 0;
        }
        if ($_CONFIG['enable_urlrewrite'] == 1) {
            $html = VNCMS_URL . "/register";
        } else {
            $html = VNCMS_URL . "/?mod=account&act=register";
        }
        return $html;
    }

    public function url_logout ()
    {
        global $_CONFIG;
        if ($this->exec) {
            $ok = preg_match("/^\/logout$/i", $this->path['path'], $regs);
            if ($ok) {
                $_GET["mod"] = "account";
                $_GET["act"] = "logout";
                $this->exec = 0;
                return 1;
            }
            return 0;
        }
        if ($_CONFIG['enable_urlrewrite'] == 1) {
            $html = VNCMS_URL . "/logout";
        } else {
            $html = VNCMS_URL . "/?mod=account&act=logout";
        }
        return $html;
    }

    public function url_changeinfo ()
    {
        global $_CONFIG;
        if ($this->exec) {
            $ok = preg_match("/^\/account\/change-info$/i", $this->path['path'], $regs);
            if ($ok) {
                $_GET["mod"] = "account";
                $_GET["act"] = "changeinfo";
                $this->exec = 0;
                return 1;
            }
            return 0;
        }
        if ($_CONFIG['enable_urlrewrite'] == 1) {
            $html = VNCMS_URL . "/account/change-info";
        } else {
            $html = VNCMS_URL . "/?mod=account&act=changeinfo";
        }
        return $html;
    }

    public function url_resetpass ()
    {
        global $_CONFIG;
        if ($this->exec) {
            $ok = preg_match("/^\/resetpass$/i", $this->path['path'], $regs);
            if ($ok) {
                $_GET["mod"] = "account";
                $_GET["act"] = "resetpass";
                $this->exec = 0;
                return 1;
            }
            return 0;
        }
        if ($_CONFIG['enable_urlrewrite'] == 1) {
            $html = VNCMS_URL . "/resetpass";
        } else {
            $html = VNCMS_URL . "/?mod=account&act=resetpass";
        }
        return $html;
    }

    public function url_active ()
    {
        global $_CONFIG;
        if ($this->exec) {
            $ok = preg_match("/^\/active$/i", $this->path['path'], $regs);
            if ($ok) {
                $_GET["mod"] = "account";
                $_GET["act"] = "activeacc";
                $this->exec = 0;
                return 1;
            }
            return 0;
        }
        if ($_CONFIG['enable_urlrewrite'] == 1) {
            $html = VNCMS_URL . "/active";
        } else {
            $html = VNCMS_URL . "/?mod=account&act=activeacc";
        }
        return $html;
    }

    public function url_favorite ()
    {
        global $_CONFIG;
        if ($this->exec) {
            $ok = preg_match("/^\/account\/favorite-product$/i", $this->path['path'], $regs);
            if ($ok) {
                $_GET["mod"] = "account";
                $_GET["act"] = "favorite";
                $this->exec = 0;
                return 1;
            }
            return 0;
        }
        if ($_CONFIG['enable_urlrewrite'] == 1) {
            $html = VNCMS_URL . "/account/favorite-product";
        } else {
            $html = VNCMS_URL . "/?mod=account&act=favorite";
        }
        return $html;
    }

    public function url_viewed ()
    {
        global $_CONFIG;
        if ($this->exec) {
            $ok = preg_match("/^\/account\/viewed-product$/i", $this->path['path'], $regs);
            if ($ok) {
                $_GET["mod"] = "account";
                $_GET["act"] = "viewed";
                $this->exec = 0;
                return 1;
            }
            return 0;
        }
        if ($_CONFIG['enable_urlrewrite'] == 1) {
            $html = VNCMS_URL . "/account/viewed-product";
        } else {
            $html = VNCMS_URL . "/?mod=account&act=viewed";
        }
        return $html;
    }

    /**
     *
     * @param string $arrOneOrder
     * @return string
     */
    public function url_order ($arrOneOrder = "")
    {
        global $_CONFIG;
        if ($this->exec) {
            $ok = preg_match("/^\/account\/order-managerment$/i", $this->path['path'], $regs);
            if ($ok) {
                $_GET["mod"] = "account";
                $_GET["sub"] = "order";
                $this->exec = 0;
                return 1;
            }
            $ok = preg_match("/^\/account\/order\/([a-zA-Z0-9]+)$/i", $this->path['path'], $regs);
            if ($ok) {
                $_GET["mod"] = "account";
                $_GET["sub"] = "order";
                $_GET["act"] = "detail";
                $_GET["order_code"] = $regs[1];
                $this->exec = 0;
                return 1;
            }
            return 0;
        }
        if (!is_array($arrOneOrder)) {
            return VNCMS_URL . "/account/order/" . $arrOneOrder;
        }
        if ($_CONFIG['enable_urlrewrite'] == 1) {
            $html = VNCMS_URL . "/account/order/" . $arrOneOrder['order_code'];
        } else {
            $html = VNCMS_URL . "?mod=account&sub=order&act=detail&order_code=" . $arrOneOrder['order_code'];
        }
        return $html;
    }

}

$base = trim(dirname(" " . $_SERVER['SCRIPT_NAME']));
$clsRewrite = new Rewrite($base);
