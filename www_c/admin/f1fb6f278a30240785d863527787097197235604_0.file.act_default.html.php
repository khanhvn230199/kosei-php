<?php
/* Smarty version 3.1.32, created on 2023-05-19 10:36:44
  from '/var/www/koseionline/data/www/koseionline.vn/admin/templates/score/act_default.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_6466eecc45a920_90269817',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f1fb6f278a30240785d863527787097197235604' => 
    array (
      0 => '/var/www/koseionline/data/www/koseionline.vn/admin/templates/score/act_default.html',
      1 => 1670384086,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:_block_inner_head.html' => 1,
  ),
),false)) {
function content_6466eecc45a920_90269817 (Smarty_Internal_Template $_smarty_tpl) {
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
                    <span class="mr-2">Kỳ thi</span>
                    <select name="tt_id" id="tt_id" onchange="this.form.submit()">
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['trialTests']->value, 'trial', false, 't');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['t']->value => $_smarty_tpl->tpl_vars['trial']->value) {
?>
                            <option value="<?php echo $_smarty_tpl->tpl_vars['trial']->value['tt_id'];?>
" <?php if ($_smarty_tpl->tpl_vars['tt_id']->value == $_smarty_tpl->tpl_vars['trial']->value['tt_id']) {?> selected <?php }?>><?php echo $_smarty_tpl->tpl_vars['trial']->value['name'];?>
</option>
                        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    </select>
                    <input type="hidden" name="old_tt_id" value="<?php echo $_smarty_tpl->tpl_vars['tt_id']->value;?>
">
                    <span class="mr-2 ml-3">Bài thi</span>
                    <select name="test_id" id="test_id" onchange="this.form.submit()">
                        <?php if ($_smarty_tpl->tpl_vars['tests']->value) {?>
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['tests']->value, 'test', false, 't');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['t']->value => $_smarty_tpl->tpl_vars['test']->value) {
?>
                            <option value="<?php echo $_smarty_tpl->tpl_vars['test']->value['test_id'];?>
" <?php if ($_smarty_tpl->tpl_vars['test_id']->value == $_smarty_tpl->tpl_vars['test']->value['test_id']) {?> selected <?php }?>><?php echo $_smarty_tpl->tpl_vars['test']->value['name'];?>
</option>
                        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        <?php } else { ?>
                            <option value="0">-- Chưa có bài thi nào --</option>
                        <?php }?>
                    </select>

                    <!-- <input type="submit" value="Lọc" name="btnFilter"/> -->
                </div>
            </td>
        </tr>
        <tr>
            <td style="padding:0px 10px" width="100%" valign="top">
                <?php if (!$_smarty_tpl->tpl_vars['trialTests']->value) {?>
                    <h3>Chưa có kỳ thi nào được tạo, vui long quay lại sau!</h3>
                <?php } elseif (!$_smarty_tpl->tpl_vars['tests']->value) {?>
                    <h3>Chưa có bài thi nào được tạo cho kỳ thi này, vui lòng quay lại sau!</h3>
                <?php } else { ?>
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

<style>
    .gridrow2,
    .gridrow3 {
        border-bottom: 1px solid #ccc !important;
    }
</style>
<?php }
}
