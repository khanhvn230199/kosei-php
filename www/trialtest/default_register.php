<?php

function default_register() {
    global $assign_list, $_CONFIG;
    global $core, $_LANG_ID;


    $assign_list["optionLevel"] = makeListLevel($assign_list['level_id']);

    // Begin SEOmoz
    $page_title = $core->getLang('JLPT_exam_inventory');
    $page_title .= " - " . $_CONFIG['site_title'];
    $_CONFIG['page_title'] = $page_title;
    // End SEOmoz
}
