<?php
/* Smarty version 3.1.32, created on 2023-05-19 15:47:38
  from '/var/www/koseionline/data/www/koseionline.vn/admin/templates/candidates/act_default.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_646737aa4c6141_85291698',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'fe55c8af853de760adf1a24a63e00ff295458d47' => 
    array (
      0 => '/var/www/koseionline/data/www/koseionline.vn/admin/templates/candidates/act_default.html',
      1 => 1670384083,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:_block_inner_head.html' => 1,
  ),
),false)) {
function content_646737aa4c6141_85291698 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:_block_inner_head.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
<form name="theForm" action="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
" method="post" id="theForm">
    <table width="100%" border="0">
        <tr>
            <td style="padding:10px">
                <div style="font-size:14px; float:left; width:30%">
                    <strong><?php echo $_smarty_tpl->tpl_vars['core']->value->getLang("ListOf");?>
 <?php echo $_smarty_tpl->tpl_vars['clsDataGrid']->value->getTitle();?>
</strong>
                </div>
                <div style="float:right;font-size:12px;" align="right">
                    Trình độ
                    <select name="level_id" id="level_id">
                        <option <?php if ($_smarty_tpl->tpl_vars['level_id']->value == '') {?>selected<?php }?> value="">Chọn trình độ</option>
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['arrListLevel']->value, 'level', false, 'l');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['l']->value => $_smarty_tpl->tpl_vars['level']->value) {
?>
                            <option value="<?php echo $_smarty_tpl->tpl_vars['level']->value['level_id'];?>
" <?php if ($_smarty_tpl->tpl_vars['level_id']->value == $_smarty_tpl->tpl_vars['level']->value['level_id']) {?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['level']->value['name'];?>
</option>
                        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    </select>
                    Kỳ thi
                    <select name="tt_id" id="tt_id">
                        <option <?php if ($_smarty_tpl->tpl_vars['tt_id']->value == '') {?>selected<?php }?> value="">Chọn kỳ thi</option>
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['arrListTrialTest']->value, 'test', false, 't');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['t']->value => $_smarty_tpl->tpl_vars['test']->value) {
?>
                            <option value="<?php echo $_smarty_tpl->tpl_vars['test']->value['tt_id'];?>
" <?php if ($_smarty_tpl->tpl_vars['tt_id']->value == $_smarty_tpl->tpl_vars['test']->value['tt_id']) {?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['test']->value['name'];?>
</option>
                        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    </select>
                    Thời gian đăng ký từ: <?php echo $_smarty_tpl->tpl_vars['clsFromDate']->value->showInputDate(false);?>
&nbsp;- đến&nbsp;<?php echo $_smarty_tpl->tpl_vars['clsToDate']->value->showInputDate(false);?>
&nbsp;
                    <input type="submit" value="Lọc" name="btnFilter"/>
                </div>
            </td>
        </tr>
        <tr>
            <td style="padding:0px 10px" width="100%" valign="top">
                <?php echo $_smarty_tpl->tpl_vars['clsDataGrid']->value->showDataGrid("theForm");?>

            </td>
        </tr>
        <tr>
            <td style="padding:0px 10px">
                <?php echo $_smarty_tpl->tpl_vars['clsDataGrid']->value->showPaging("theForm");?>

            </td>
        </tr>
    </table>
</form>
<?php }
}
