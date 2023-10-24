<?php
/* Smarty version 3.1.32, created on 2021-06-08 15:15:30
  from '/var/www/koseionline.vn/data/www/koseionline.vn/admin/templates/transactions/act_default.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_60bf2722758803_15064138',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'bd075d8840b5aa8e5966be6ed68d25bae2a55419' => 
    array (
      0 => '/var/www/koseionline.vn/data/www/koseionline.vn/admin/templates/transactions/act_default.html',
      1 => 1616483394,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:_block_inner_head.html' => 1,
  ),
),false)) {
function content_60bf2722758803_15064138 (Smarty_Internal_Template $_smarty_tpl) {
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
" <?php if ($_smarty_tpl->tpl_vars['status']->value == (isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)) {?>selected<?php }?>>
                            <?php echo $_smarty_tpl->tpl_vars['arrStatusOptions']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)];?>

                        </option>
                        <?php
}
}
?>
                    </select>
                    Từ ngày: <?php echo $_smarty_tpl->tpl_vars['clsFromDate']->value->showInputDate(false);?>
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
