<?php
/* Smarty version 3.1.32, created on 2023-05-29 08:44:34
  from '/var/www/koseionline/data/www/koseionline.vn/admin/templates/course/act_default.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_647403825185b2_69645756',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '95a1d416cd5971192d35b344f575786da5171cdd' => 
    array (
      0 => '/var/www/koseionline/data/www/koseionline.vn/admin/templates/course/act_default.html',
      1 => 1670384084,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:_block_inner_head.html' => 1,
  ),
),false)) {
function content_647403825185b2_69645756 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:_block_inner_head.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
<form name="theForm" action="" method="post" id="theForm">
    <table width="100%" border="0">
        <tr>
            <td style="padding:10px">
                <div style="float:left; width:38%; text-align:center">
                    Hiển thị:
                    <?php if ($_smarty_tpl->tpl_vars['view_type']->value == "group") {?>
                    <strong><img src="<?php echo $_smarty_tpl->tpl_vars['ADMIN_URL_IMAGES']->value;?>
/checked.png"/> Theo nhóm</strong> | <a
                        href="?mod=<?php echo $_smarty_tpl->tpl_vars['mod']->value;?>
&view_type=tree">Tree View</a> | <a href="?mod=<?php echo $_smarty_tpl->tpl_vars['mod']->value;?>
&view_type=all">Tất cả</a>
                    <?php } elseif ($_smarty_tpl->tpl_vars['view_type']->value == 'all') {?>
                    <a href="?mod=<?php echo $_smarty_tpl->tpl_vars['mod']->value;?>
&view_type=group">Theo nhóm</a> | <a href="?mod=<?php echo $_smarty_tpl->tpl_vars['mod']->value;?>
&view_type=tree">Tree
                    View</a> | <strong><img src="<?php echo $_smarty_tpl->tpl_vars['ADMIN_URL_IMAGES']->value;?>
/checked.png"/> Tất cả</strong>
                    <?php } else { ?>
                    <a href="?mod=<?php echo $_smarty_tpl->tpl_vars['mod']->value;?>
&view_type=group">Theo nhóm</a> | <strong><img
                        src="<?php echo $_smarty_tpl->tpl_vars['ADMIN_URL_IMAGES']->value;?>
/checked.png"/> Tree View</strong> | <a
                        href="?mod=<?php echo $_smarty_tpl->tpl_vars['mod']->value;?>
&view_type=all">Tất cả</a>
                    <?php }?>
                </div>
                <div style="float:right;font-size:12px; width:30%; color:blue" align="right">
                    Ngôn ngữ: <?php echo $_smarty_tpl->tpl_vars['lang_code_name']->value;?>

                </div>
            </td>
        </tr>
        <tr>
            <td style="padding:0px 10px" width="100%" valign="top">
                <?php if ($_smarty_tpl->tpl_vars['view_type']->value == 'group') {?>
                <div class="navpath">Bạn đang ở: <?php echo $_smarty_tpl->tpl_vars['catPathAdmin']->value;?>
</div>
                <?php echo $_smarty_tpl->tpl_vars['clsDataGrid']->value->showDataGrid("theForm");?>

                <?php } elseif ($_smarty_tpl->tpl_vars['view_type']->value == 'all') {?>
                <?php echo $_smarty_tpl->tpl_vars['clsDataGrid']->value->showDataGrid("theForm");?>

                <?php }?>
            </td>
        </tr>
        <tr>
            <td style="padding:0px 10px">
                <?php echo $_smarty_tpl->tpl_vars['clsDataGrid']->value->showPaging("theForm");?>

            </td>
        </tr>
    </table>
</form>
<?php if ($_smarty_tpl->tpl_vars['view_type']->value == 'tree') {
$_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['mod']->value)."/act_tree.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
}
}
}
