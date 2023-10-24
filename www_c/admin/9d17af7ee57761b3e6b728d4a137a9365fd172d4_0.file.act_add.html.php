<?php
/* Smarty version 3.1.32, created on 2021-06-09 09:11:26
  from '/var/www/koseionline.vn/data/www/koseionline.vn/admin/templates/level/act_add.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_60c0234e449493_04740583',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9d17af7ee57761b3e6b728d4a137a9365fd172d4' => 
    array (
      0 => '/var/www/koseionline.vn/data/www/koseionline.vn/admin/templates/level/act_add.html',
      1 => 1616483392,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:_block_inner_head_add.html' => 1,
  ),
),false)) {
function content_60c0234e449493_04740583 (Smarty_Internal_Template $_smarty_tpl) {
?><link href="<?php echo $_smarty_tpl->tpl_vars['ADMIN_URL_CSS']->value;?>
/jquery.tagit.css" rel="stylesheet" type="text/css">
<link href="<?php echo $_smarty_tpl->tpl_vars['ADMIN_URL_CSS']->value;?>
/tagit.ui-zendesk.css" rel="stylesheet" type="text/css">
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['ADMIN_URL_JS']->value;?>
/jquery-ui.min.js" type="text/javascript" charset="utf-8"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['ADMIN_URL_JS']->value;?>
/tag-it.min.js" type="text/javascript" charset="utf-8"><?php echo '</script'; ?>
>


<?php $_smarty_tpl->_subTemplateRender("file:_block_inner_head_add.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
<form name="theForm" action="" method="post">
    <table width="100%" border="0">
        <tr>
            <td style="padding:10px">
                <div style="padding-bottom:5px; font-size:14px; float:left">
                    <strong><?php if ($_smarty_tpl->tpl_vars['clsForm']->value->pval != '') {
echo $_smarty_tpl->tpl_vars['core']->value->getLang("Edit");?>
 <?php echo $_smarty_tpl->tpl_vars['clsForm']->value->getTitle();?>
: #<?php echo $_smarty_tpl->tpl_vars['clsForm']->value->pval;?>

                        <?php } else {
echo $_smarty_tpl->tpl_vars['core']->value->getLang("Add");?>
 <?php echo $_smarty_tpl->tpl_vars['clsForm']->value->getTitle();?>

                        <?php }?></strong>
                </div>
                <div style="float:right;font-size:12px; color:blue" align="right">
                    Ngôn ngữ: <?php echo $_smarty_tpl->tpl_vars['lang_code_name']->value;?>

                </div>
            </td>
        </tr>
        <tr>
            <td style="padding:0px 10px" width="100%" valign="top">
                <input type="hidden" id="is_post" value="1"/>
                <?php echo $_smarty_tpl->tpl_vars['clsForm']->value->showJS();?>

                <table cellpadding="0" cellspacing="0" width="100%" border="0" class="girdtable">
                    <tr>
                        <td colspan="2" class="gridheader1"><?php echo $_smarty_tpl->tpl_vars['core']->value->getLang("InputCorrectlyAllBelowFields");?>
</td>
                    </tr>
                    <?php if ($_smarty_tpl->tpl_vars['clsForm']->value->isValid != 1) {?>
                    <tr>
                        <td class="gridrow1" style="color:red; padding:5px" colspan="2">
                            <?php echo $_smarty_tpl->tpl_vars['clsForm']->value->showAllError();?>

                        </td>
                    </tr>
                    <?php }?>
                    <?php echo $_smarty_tpl->tpl_vars['clsForm']->value->showForm();?>


                </table>
                <em><font style="font-size:10px"><?php echo $_smarty_tpl->tpl_vars['core']->value->getLang("Note");?>
: * <?php echo $_smarty_tpl->tpl_vars['core']->value->getLang("isrequired");?>
</font></em>
            </td>
        </tr>
        <tr style="background:#FBFBFB">
            <td style="padding-right:10px; border-bottom:1px #CCCCCC solid;" align="right">
                <div>
                    <table cellpadding="2px" border="0">
                        <tr>
                            <?php echo $_smarty_tpl->tpl_vars['clsButtonNav']->value->last_render;?>

                        </tr>
                    </table>
                </div>
            </td>
        </tr>

    </table>
</form>
<?php echo '<script'; ?>
>
    var sampleTags = [<?php echo $_smarty_tpl->tpl_vars['sampleTags']->value;?>
];
<?php echo '</script'; ?>
>

<?php echo '<script'; ?>
>
    $('#tags').tagit({
        availableTags: sampleTags,
        allowSpaces: true
    });
<?php echo '</script'; ?>
>
<?php }
}
