<?php
/**
 * Module: [settings]
 * Home function with $sub=default, $act=generalsetting
 * Display General Setting Page
 *
 * @param                : no params
 * @return                : no need return
 * @exception
 * @throws
 */
function default_generalsetting()
{
    global $assign_list, $_CONFIG, $_SITE_ROOT, $mod, $act;
    global $core, $clsModule, $clsButtonNav, $lang_code;
    $classTable = "Settings";
    $clsClassTable = new $classTable;
    $tableName = $clsClassTable->tbl;
    $pkeyTable = $clsClassTable->pkey;
    //get _GET, _POST
    $pvalTable = isset($_GET[$pkeyTable]) ? $_GET[$pkeyTable] : 1;
    $btnSave = isset($_POST["btnSave"]) ? $_POST["btnSave"] : "";
    //init Button
    $clsForm = new Form();
    $clsButtonNav->set("Save", "/icon/disks2.png", "Save", 1, "save");
    $clsButtonNav->set("Cancel", "/icon/undo.png", "?");

    $arrListKey = array(
        "site_title",
        "site_logo",
        "site_favicon",
        "site_name",
        "webmaster_email",
        "smtp_server",
        "smtp_port",
        "smtp_user",
        "smtp_pass",
        "copyright",
        "is_close_site",
        "close_site_notice",
        "site_phone",
        "site_email",
        "site_address",
        "site_hotline",
        "site_comname",
        "about",
        "contact_info",
        "footer_info",
        "terms_of_use"
    );

    foreach ($arrListKey as $key => $val) {
        ${$val} = isset($_POST[$val]) ? $_POST[$val] : "";
    }
    if ($btnSave != "") {
        $about = br2nl($about);
        $close_site_notice = br2nl($close_site_notice);
        $contact_info = br2nl($contact_info);
        $footer_info = br2nl($footer_info);
        $terms_of_use = br2nl($terms_of_use);
        foreach ($arrListKey as $key => $val) {
            $clsClassTable->setValue($val, ${$val}, $lang_code);
        }
        header("location: ?mod=$mod&act=$act");
        exit();
    } else {
        foreach ($arrListKey as $key => $val) {
            ${$val} = $clsClassTable->getValue($val, $lang_code);
        }
    }

    $clsForm->setTextAreaType("full");
    $clsForm->addInputFile("site_logo", $site_logo, "Image (jpg, gif, png)", "jpg, gif, png", 1, "style='width:300px'");
    $clsForm->addInputFile("site_favicon", $site_favicon, "Image (jpg, gif, png)", "jpg, gif, png", 1, "style='width:300px'");
    $clsForm->addInputTextArea("about", $about, "", 1000, 10, 5, 1, "style='width:100%; height:300px'", "SMALL");
    $clsForm->addInputTextArea("contact_info", $contact_info, "", 1000, 10, 5, 1, "style='width:100%; height:300px'", "SMALL");
    $clsForm->addInputTextArea("footer_info", $footer_info, "", 1000, 10, 5, 1, "style='width:100%; height:300px'", "SMALL");
    $clsForm->addInputTextArea("terms_of_use", $terms_of_use, "", 1000, 10, 5, 1, "style='width:100%; height:300px'", "FULL");
    $clsForm->addInputTextArea("close_site_notice", $close_site_notice, "", 1000, 10, 5, 1, "style='width:100%; height:300px'", "SMALL");

    foreach ($arrListKey as $key => $val) {
        $assign_list[$val] = ${$val};
    }
    $assign_list["clsModule"] = $clsModule;
    $assign_list["clsForm"] = $clsForm;
    $assign_list[$pkeyTable] = $pvalTable;
}

?>