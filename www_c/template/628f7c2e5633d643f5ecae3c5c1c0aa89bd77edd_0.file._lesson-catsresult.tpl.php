<?php
/* Smarty version 3.1.32, created on 2023-05-19 09:49:18
  from '/var/www/koseionline/data/www/koseionline.vn/themes/template/_blocks/_lesson-catsresult.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_6466e3ae89d618_75384272',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '628f7c2e5633d643f5ecae3c5c1c0aa89bd77edd' => 
    array (
      0 => '/var/www/koseionline/data/www/koseionline.vn/themes/template/_blocks/_lesson-catsresult.tpl',
      1 => 1683359070,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6466e3ae89d618_75384272 (Smarty_Internal_Template $_smarty_tpl) {
?><section class="section" style="margin-bottom: 20px;">
    <div class="container">
        <h2 class="section__title text-uppercase"><?php echo $_smarty_tpl->tpl_vars['arrOneCourse']->value['name'];?>
</h2>
        <?php if (!$_smarty_tpl->tpl_vars['hideSection']->value) {?>
        <section class="aside-2">
            <?php }?>
            <ul class="nav n-tabs n-tabs--sm">
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['stagesresult']->value, 'stage', false, 'ls');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['ls']->value => $_smarty_tpl->tpl_vars['stage']->value) {
?>
                <li class="nav-item"><a class="nav-link <?php if ($_smarty_tpl->tpl_vars['ls']->value == 0) {?>active<?php }?>" href="#<?php echo $_smarty_tpl->tpl_vars['prev']->value;?>
-tab-<?php echo $_smarty_tpl->tpl_vars['ls']->value+1;?>
" data-toggle="tab"><img class="n-tabs__bg" src="<?php echo $_smarty_tpl->tpl_vars['URL_IMAGES']->value;?>
/n-tab-link-bg.png" alt=""><span><?php echo $_smarty_tpl->tpl_vars['stage']->value['name'];?>
</span></a></li>
                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            </ul>
            <div class="n-tabs-content n-tabs-content--aside">
                <div class="tab-content">
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['stagesresult']->value, 'stage', false, 'ls');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['ls']->value => $_smarty_tpl->tpl_vars['stage']->value) {
?>
                    <div class="tab-pane fade show <?php if ($_smarty_tpl->tpl_vars['ls']->value == 0) {?>active<?php }?>" id="<?php echo $_smarty_tpl->tpl_vars['prev']->value;?>
-tab-<?php echo $_smarty_tpl->tpl_vars['ls']->value+1;?>
">
                        <ul class="nav as-nav">
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['stage']->value['cats'], 'subStage', false, 'sc');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['sc']->value => $_smarty_tpl->tpl_vars['subStage']->value) {
?>
                            <li class="nav-item"><a class="nav-link" href="#<?php echo $_smarty_tpl->tpl_vars['prev']->value;?>
-tab-<?php echo $_smarty_tpl->tpl_vars['ls']->value+1;?>
-<?php echo $_smarty_tpl->tpl_vars['sc']->value+1;?>
" data-toggle="tab"><span><?php echo $_smarty_tpl->tpl_vars['subStage']->value['name'];?>
</span><img src="<?php echo $_smarty_tpl->tpl_vars['URL_UPLOADS']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['subStage']->value['image'];?>
" alt=""></a></li>
                            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        </ul>
                        <div class="tab-content">
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['stage']->value['cats'], 'subStage', false, 'sc');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['sc']->value => $_smarty_tpl->tpl_vars['subStage']->value) {
?>
                            <div class="tab-pane fade" id="<?php echo $_smarty_tpl->tpl_vars['prev']->value;?>
-tab-<?php echo $_smarty_tpl->tpl_vars['ls']->value+1;?>
-<?php echo $_smarty_tpl->tpl_vars['sc']->value+1;?>
">
                                <ul class="n-menu mt-20">
                                    <li class="n-menu__title">Video bài học</li>
                                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['subStage']->value['lessons'], 'les', false, 'j');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['j']->value => $_smarty_tpl->tpl_vars['les']->value) {
?>
                                    <li class="n-menu__item">
                                        <a class="n-menu__link" href="#!" style="position: relative;">
                                            <div class="persent" style="width: <?php if ($_smarty_tpl->tpl_vars['les']->value['pt'] < 100) {
echo $_smarty_tpl->tpl_vars['les']->value['pt'];
} else { ?>100<?php }?>%;background: #ddd;position: absolute;left: 0;height: 100%;top: 0;"> </div>
                                            <div style="z-index: 1000;display: flex;justify-content: space-between;width: 100%; position: relative;">
                                                <?php echo $_smarty_tpl->tpl_vars['les']->value['name'];?>
 <span class="text-muted font-weight-normal"><?php if ($_smarty_tpl->tpl_vars['les']->value['pt'] < 100) {
echo $_smarty_tpl->tpl_vars['les']->value['pt'];?>
%<?php } else { ?>100%<?php }?></span>
                                            </div>
                                        </a>
                                        <ul class="n-menu__sub">
                                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['les']->value['sublessons'], 'sub', false, 'j');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['j']->value => $_smarty_tpl->tpl_vars['sub']->value) {
?>                                            
                                                                                        <?php $_smarty_tpl->_assignInScope('pt', $_smarty_tpl->tpl_vars['sub']->value['pt']);?>
                                            <li class="n-menu__item">
                                                <a class="n-menu__link" href="<?php echo $_smarty_tpl->tpl_vars['Rewrite']->value->url_lesson($_smarty_tpl->tpl_vars['sub']->value);?>
" style="position: relative;">
                                                    <div class="persent" style="width: <?php echo $_smarty_tpl->tpl_vars['pt']->value;?>
%;background: #ddd;position: absolute;left: 0;height: 100%;top: 0;"> </div>
                                                    <div style="z-index: 1000;display: flex;justify-content: space-between;width: 100%;">
                                                        <?php echo $_smarty_tpl->tpl_vars['sub']->value['name'];?>

                                                        <?php if ($_smarty_tpl->tpl_vars['pt']->value < 100) {?> <span class="text-muted font-weight-normal"><?php echo ceil($_smarty_tpl->tpl_vars['pt']->value);?>
% <?php if ($_smarty_tpl->tpl_vars['sub']->value['scores'] > 0) {?> | P:<?php echo $_smarty_tpl->tpl_vars['sub']->value['scores'];
}?></span>
                                                            <?php } else { ?>
                                                            <span class="text-muted font-weight-normal">100%</span>
                                                            <?php }?>
                                                    </div>
                                                </a>
                                                                                            </li>                                            
                                            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                        </ul>
                                    </li>
                                    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                </ul>
                            </div>
                            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        </div>
                    </div>
                    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                </div>
            </div>
            <?php if (!$_smarty_tpl->tpl_vars['hideSection']->value) {?>
        </section>
        <?php }?>
</section><?php }
}
