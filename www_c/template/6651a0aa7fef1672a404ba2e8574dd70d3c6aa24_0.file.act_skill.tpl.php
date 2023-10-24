<?php
/* Smarty version 3.1.32, created on 2023-05-20 06:35:15
  from '/var/www/koseionline/data/www/koseionline.vn/themes/template/practice/act_skill.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_646807b35c84b3_25674867',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6651a0aa7fef1672a404ba2e8574dd70d3c6aa24' => 
    array (
      0 => '/var/www/koseionline/data/www/koseionline.vn/themes/template/practice/act_skill.tpl',
      1 => 1670384118,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_646807b35c84b3_25674867 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/var/www/koseionline/data/www/koseionline.vn/includes/smarty3/plugins/modifier.lang.php','function'=>'smarty_modifier_lang',),));
?><div class="container">
    <div class="border-top"></div>
</div>
<nav>
    <div class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a class="link-unstyled" href="<?php echo $_smarty_tpl->tpl_vars['VNCMS_URL']->value;?>
"><?php echo smarty_modifier_lang('Home');?>
</a>
            </li>
            <li class="breadcrumb-item active"><?php echo smarty_modifier_lang('JLPT_exam_inventory');?>
</li>
        </ol>
    </div>
</nav>

<section class="section mb-50">
    <div class="container">
        <h2 class="section__title"><?php echo smarty_modifier_lang('Choose_skill');?>
</h2>
        <div class="row">
            <?php if ($_smarty_tpl->tpl_vars['arrListSkills']->value) {?>
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['arrListSkills']->value, 'skill', false, 's');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['s']->value => $_smarty_tpl->tpl_vars['skill']->value) {
?>
                    <div class="col-lg-4 col-sm-6 mb-30">
                        <div class="lesson">
                            <a class="lesson__iwrap" href="<?php echo $_smarty_tpl->tpl_vars['Rewrite']->value->url_exam($_smarty_tpl->tpl_vars['skill']->value);?>
">
                                <img src="<?php echo $_smarty_tpl->tpl_vars['URL_UPLOADS']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['skill']->value['image'];?>
" onerror="this.src='<?php echo $_smarty_tpl->tpl_vars['URL_IMAGES']->value;?>
/nopic.png'"  alt="<?php echo $_smarty_tpl->tpl_vars['skill']->value['name'];?>
" />
                            </a>
                            <h3 class="lesson__title">
                                <a class="text-default" href="<?php echo $_smarty_tpl->tpl_vars['Rewrite']->value->url_exam($_smarty_tpl->tpl_vars['skill']->value);?>
"><?php echo $_smarty_tpl->tpl_vars['skill']->value['name'];?>
</a>
                            </h3>
                        </div>
                    </div>
                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            <?php }?>
        </div>
    </div>
</section><?php }
}
