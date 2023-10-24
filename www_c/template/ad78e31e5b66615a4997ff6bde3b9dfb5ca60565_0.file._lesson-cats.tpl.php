<?php
/* Smarty version 3.1.32, created on 2021-06-11 17:44:09
  from '/var/www/koseionline.vn/data/www/koseionline.vn/themes/template/_blocks/_lesson-cats.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_60c33e79682bd8_30976396',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ad78e31e5b66615a4997ff6bde3b9dfb5ca60565' => 
    array (
      0 => '/var/www/koseionline.vn/data/www/koseionline.vn/themes/template/_blocks/_lesson-cats.tpl',
      1 => 1623408207,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60c33e79682bd8_30976396 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['stages']->value) {?>
  <?php if (!$_smarty_tpl->tpl_vars['hideSection']->value) {?>
  <section class="aside-2">
    <h2 class="aside-2__title mb-3">Bắt đầu học</h2>
  <?php }?>
    <ul class="nav n-tabs n-tabs--sm">
      <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['stages']->value, 'stage', false, 'ls');
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
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['stages']->value, 'stage', false, 'ls');
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
                        <a class="n-menu__link" href="#!"><?php echo $_smarty_tpl->tpl_vars['les']->value['name'];?>
</a>
                        <ul class="n-menu__sub">
                          <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['les']->value['sublessons'], 'sub', false, 'j');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['j']->value => $_smarty_tpl->tpl_vars['sub']->value) {
?>
                            <li class="n-menu__item">
                              <a class="n-menu__link" href="<?php echo $_smarty_tpl->tpl_vars['Rewrite']->value->url_lesson($_smarty_tpl->tpl_vars['sub']->value);?>
"> <?php echo $_smarty_tpl->tpl_vars['sub']->value['name'];?>
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
  <?php }
}
}
}
