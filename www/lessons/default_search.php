<?php
/**
 * Module: [Products]
 * Posts function with $sub=default, $act=search
 * Display search of a product
 *
 * @param                : no params
 * @return                : no need return
 * @exception
 * @throws
 */
function default_search()
{
    global $assign_list, $_CONFIG, $_SITE_ROOT, $mod;
    global $core, $_LANG_ID;
    $clsProducts = new Products;
    $clsCategory = new Category;
    $clsCategory->getParentArray();
    require_once DIR_COMMON . "/clsPaging.php";

    $key = isset($_GET['key']) ? $_GET['key'] : '';
    $type = isset($_GET['type']) ? $_GET['type'] : 'product';

    if ($key != '') {
        $arrKey = explode(' ', $key);
        $strSearch = '';
        $strSearch_product = '';
        foreach ($arrKey as $v) {
            $v2 = utf8_nosign_noblank($v);
            if ($strSearch != '') {
                $strSearch .= " && a.slug LIKE '%$v2%' ";
            } else {
                $strSearch .= " a.slug LIKE '%$v2%' ";
            }
        }
        $strSearch_product .= " (a.name LIKE '%$key%' OR a.code LIKE '%$key%') ";

        $strSearchEND_product = "( ($strSearch) OR ($strSearch_product) )";

        $cond_product = "a.is_online = 1 AND $strSearchEND_product AND a.lang_code='$_LANG_ID' GROUP BY a.product_id";
        $cond_count = "a.is_online = 1 AND $strSearchEND_product AND a.lang_code='$_LANG_ID'";

    }
    
    //Begin Right Sidebar
    $arrListCategory = $clsCategory->getAllCatArr(0, "lang_code = '$_LANG_ID' AND ctype=" . CTYPE_KH);
    //End Right Sidebar
    
    //Begin Paging
    $rowPerPage = 9;
    $curPage = (isset($_GET["page"]) && $_GET["page"] > 0) ? ($_GET["page"]) : 0;

    $clsPaging = new Paging($curPage, $rowPerPage, "news");
    //Check loại tìm kiếm để phân trang
    $clsPaging->setBaseURL(VNCMS_URL . "/products/search?key=$key");
    $totalItem = $clsProducts->countItem($cond_count);
    $arrListProducts = $clsProducts->getAllSimple2($clsPaging->getQueryLimit($cond_product));

    $clsPaging->setTotalRows($totalItem);
    $clsPaging->setShowStatstic(false);
    $clsPaging->setShowGotoBox(false);

    //End Paging

    $assign_list["totalItem"] = $totalItem;
    $assign_list["arrListProducts"] = $arrListProducts;
    $assign_list["clsPaging"] = $clsPaging;
    $assign_list["key"] = $key;
    $assign_list["type"] = $type;
    $assign_list["arrListCategory"] = $arrListCategory;

}

?>