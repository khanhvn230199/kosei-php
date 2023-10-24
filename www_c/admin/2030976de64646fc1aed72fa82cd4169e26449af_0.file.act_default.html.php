<?php
/* Smarty version 3.1.32, created on 2023-02-02 15:30:03
  from '/var/www/koseionline/data/www/koseionline.vn/admin/templates/transactions/act_default.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_63db748b32b458_69496942',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2030976de64646fc1aed72fa82cd4169e26449af' => 
    array (
      0 => '/var/www/koseionline/data/www/koseionline.vn/admin/templates/transactions/act_default.html',
      1 => 1675326496,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:_block_inner_head.html' => 1,
  ),
),false)) {
function content_63db748b32b458_69496942 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:_block_inner_head.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
<form name="theForm" action="" method="post" id="theForm">
    <table width="100%" border="0">
        <tr>
            <td style="padding:10px">
                <div style="font-size:14px; float:left; width:30%">
                    <strong><?php echo $_smarty_tpl->tpl_vars['core']->value->getLang("ListOf");?>
 <?php echo $_smarty_tpl->tpl_vars['clsDataGrid']->value->getTitle();?>
</strong>
                </div>
                <div style="float:right;font-size:12px;" align="right">
                    <input type="text" name="s_name" value="<?php echo $_smarty_tpl->tpl_vars['s_name']->value;?>
" style="width:100px" placeholder="Name" />
                    <input type="text" name="s_email" value="<?php echo $_smarty_tpl->tpl_vars['s_email']->value;?>
" style="width:100px" placeholder="Email" />
                    <input type="text" name="s_mobile" value="<?php echo $_smarty_tpl->tpl_vars['s_mobile']->value;?>
" style="width:100px" placeholder="Phone" />
                    <select name="status" id="status">
                        <option <?php if ($_smarty_tpl->tpl_vars['status']->value == '') {?>selected<?php }?> value="-1">Chọn trạng thái</option>
                        <?php
$__section_i_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['arrStatusOptions']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_i_0_total = $__section_i_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_i'] = new Smarty_Variable(array());
if ($__section_i_0_total !== 0) {
for ($__section_i_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] = 0; $__section_i_0_iteration <= $__section_i_0_total; $__section_i_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']++){
?>
                        <option value="<?php echo (isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null);?>
" <?php if ($_smarty_tpl->tpl_vars['status']->value == (isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)) {?>selected<?php }?>> <?php echo $_smarty_tpl->tpl_vars['arrStatusOptions']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)];?>
 </option> <?php
}
}
?> </select> Từ ngày: <?php echo $_smarty_tpl->tpl_vars['clsFromDate']->value->showInputDate(false);?>
&nbsp;- đến&nbsp;<?php echo $_smarty_tpl->tpl_vars['clsToDate']->value->showInputDate(false);?>
&nbsp;
                            <input type="submit" value="Lọc" name="btnFilter" />
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
</form><?php }
}
