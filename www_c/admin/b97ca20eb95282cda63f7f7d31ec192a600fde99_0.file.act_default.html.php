<?php
/* Smarty version 3.1.32, created on 2023-05-19 10:28:46
  from '/var/www/koseionline/data/www/koseionline.vn/admin/templates/questions/act_default.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_6466eceed42749_03573433',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b97ca20eb95282cda63f7f7d31ec192a600fde99' => 
    array (
      0 => '/var/www/koseionline/data/www/koseionline.vn/admin/templates/questions/act_default.html',
      1 => 1670384085,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:_block_inner_head.html' => 1,
  ),
),false)) {
function content_6466eceed42749_03573433 (Smarty_Internal_Template $_smarty_tpl) {
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
                <div style="float:left; width:38%; text-align:center">
                    <input type="text" value="<?php echo $_smarty_tpl->tpl_vars['skeyword']->value;?>
" name="skeyword" placeholder="<?php echo $_smarty_tpl->tpl_vars['core']->value->getLang('Keyword');?>
"/>
                    <input type="submit" value="<?php echo $_smarty_tpl->tpl_vars['core']->value->getLang('Search');?>
" name="searchBtn"/>
                </div>
                <div style="float:right;font-size:12px; width:30%; color:blue" align="right">
                    Ngôn ngữ: <?php echo $_smarty_tpl->tpl_vars['lang_code_name']->value;?>

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