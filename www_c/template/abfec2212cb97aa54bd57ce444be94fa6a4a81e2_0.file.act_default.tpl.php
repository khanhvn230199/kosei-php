<?php
/* Smarty version 3.1.32, created on 2021-06-08 17:58:56
  from '/var/www/koseionline.vn/data/www/koseionline.vn/themes/template/syllabus/act_default.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_60bf4d7058d6c8_00484282',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'abfec2212cb97aa54bd57ce444be94fa6a4a81e2' => 
    array (
      0 => '/var/www/koseionline.vn/data/www/koseionline.vn/themes/template/syllabus/act_default.tpl',
      1 => 1618904766,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60bf4d7058d6c8_00484282 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/var/www/koseionline.vn/data/www/koseionline.vn/includes/smarty3/plugins/modifier.lang.php','function'=>'smarty_modifier_lang',),1=>array('file'=>'/var/www/koseionline.vn/data/www/koseionline.vn/includes/smarty3/plugins/modifier.date_format.php','function'=>'smarty_modifier_date_format',),2=>array('file'=>'/var/www/koseionline.vn/data/www/koseionline.vn/includes/smarty3/plugins/modifier.truncate.php','function'=>'smarty_modifier_truncate',),));
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
            <li class="breadcrumb-item active"><?php echo $_smarty_tpl->tpl_vars['curCat']->value['name'];?>
</li>
        </ol>
    </div>
</nav>
<section class="section mb-50">
    <div class="container">
        <h2 class="section__title"><?php echo $_smarty_tpl->tpl_vars['curCat']->value['name'];?>
</h2>
        <ul class="list-unstyled mb-40">
            <?php if ($_smarty_tpl->tpl_vars['arrListSyllabus']->value) {?>
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['arrListSyllabus']->value, 'syllabus', false, 'k');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['syllabus']->value) {
?>
                    <li class="mb-20">
                        <div class="subject media">
                            <a class="subject__iwrap-2" href="<?php echo $_smarty_tpl->tpl_vars['Rewrite']->value->url_syllabus($_smarty_tpl->tpl_vars['syllabus']->value);?>
">
                                <img src="<?php echo $_smarty_tpl->tpl_vars['VNCMS_URL']->value;?>
/img.php?pic=<?php echo $_smarty_tpl->tpl_vars['core']->value->callfunc('base64_encode',$_smarty_tpl->tpl_vars['syllabus']->value['image']);?>
&w=195&h=266&encode=1" onerror="this.src='<?php echo $_smarty_tpl->tpl_vars['URL_IMAGES']->value;?>
/nopic.png'" alt="<?php echo $_smarty_tpl->tpl_vars['syllabus']->value['title'];?>
" />
                            </a>
                            <div class="media-body">
                                <h3 class="subject__title">
                                    <a class="text-default" href="<?php echo $_smarty_tpl->tpl_vars['Rewrite']->value->url_syllabus($_smarty_tpl->tpl_vars['syllabus']->value);?>
"><?php echo $_smarty_tpl->tpl_vars['syllabus']->value['title'];?>
</a>
                                </h3>
                                <div class="subject__time"><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['syllabus']->value['reg_date'],"%d/%m/%Y | %H:%i");?>
</div>
                                <div class="subject__desc">
                                    <?php echo smarty_modifier_truncate(preg_replace('!<[^>]*?>!', ' ', htmlDecode($_smarty_tpl->tpl_vars['syllabus']->value['sapo'])),200,"...");?>

                                </div>
                            </div>
                        </div>
                    </li>
                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            <?php }?>
        </ul>
        <nav>
            <ul class="pagination">
                <?php echo $_smarty_tpl->tpl_vars['clsPaging']->value->showPagingNew2();?>

            </ul>
        </nav>
    </div>
</section><?php }
}
