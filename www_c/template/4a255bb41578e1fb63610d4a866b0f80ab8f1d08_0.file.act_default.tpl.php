<?php
/* Smarty version 3.1.32, created on 2023-05-29 09:24:17
  from '/var/www/koseionline/data/www/koseionline.vn/themes/template/home/act_default.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_64740cd1a3b582_22215234',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4a255bb41578e1fb63610d4a866b0f80ab8f1d08' => 
    array (
      0 => '/var/www/koseionline/data/www/koseionline.vn/themes/template/home/act_default.tpl',
      1 => 1685327046,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:_slider/_main.tpl' => 1,
  ),
),false)) {
function content_64740cd1a3b582_22215234 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/var/www/koseionline/data/www/koseionline.vn/includes/smarty3/plugins/modifier.lang.php','function'=>'smarty_modifier_lang',),));
?><!-- banner-->
<?php $_smarty_tpl->_subTemplateRender("file:_slider/_main.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
<!-- các khoá học online-->
<section class="section-2">
    <div class="container">
        <h2 class="section-2__title"><span>Các khoá học Online</span><img src="<?php echo $_smarty_tpl->tpl_vars['URL_IMAGES']->value;?>
/icon-mountain-red.png" alt=""></h2>
        <ul class="nav n-tabs">
            <li class="nav-item"><a class="nav-link active" href="#course-tab-1" data-toggle="tab"><img class="n-tabs__bg" src="<?php echo $_smarty_tpl->tpl_vars['URL_IMAGES']->value;?>
/n-tab-link-bg.png" alt=""><img src="<?php echo $_smarty_tpl->tpl_vars['URL_IMAGES']->value;?>
/icon-jp-flag.png" alt=""><span>Các khoá học</span></a></li>
            <li class="nav-item"><a class="nav-link" href="#course-tab-2" data-toggle="tab"><img class="n-tabs__bg" src="<?php echo $_smarty_tpl->tpl_vars['URL_IMAGES']->value;?>
/n-tab-link-bg.png" alt=""><span>Combo khoá học</span></a></li>
        </ul>
        <div class="n-tabs-content">
            <div class="tab-content">
                <div class="tab-pane fade show active" id="course-tab-1">
                    <?php if ($_smarty_tpl->tpl_vars['courses']->value) {?>
                    <div class="course-slider">
                        <div class="course-slider__prev"><i class="fa fa-angle-left"></i></div>
                        <div class="course-slider__next"><i class="fa fa-angle-right"></i></div>
                        <div class="course-slider__container swiper-container">
                            <div class="swiper-wrapper">
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['courses']->value, 'course', false, 'key', 'name', array (
));
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['course']->value) {
?>
                                <div class="swiper-slide">
                                    <div class="course-2">
                                        <div class="course-2__header"><?php echo $_smarty_tpl->tpl_vars['course']->value['name'];?>
</div>
                                        <div class="course-2__body">
                                            <div class="course-2__price">
                                                <div><?php echo $_smarty_tpl->tpl_vars['core']->value->callfunc('number_format',$_smarty_tpl->tpl_vars['course']->value['price_vn']);?>
 Vnđ</div>
                                                <div><?php echo $_smarty_tpl->tpl_vars['core']->value->callfunc('number_format',$_smarty_tpl->tpl_vars['course']->value['price_jp']);?>
 ¥</div>
                                            </div>
                                            <div class="mt-1">Thời gian: <?php echo $_smarty_tpl->tpl_vars['course']->value['duration'];?>
 tháng</div>
                                        </div>
                                        <div class="course-2__footer">
                                            <div class="course-2__btn">Khám phá</div>
                                        </div>
                                        <div class="course-2__overlay">
                                            <div class="course-2__name"><span><?php echo $_smarty_tpl->tpl_vars['course']->value['name'];?>
</span><img src="<?php echo $_smarty_tpl->tpl_vars['URL_IMAGES']->value;?>
/icon-lantern.png" alt="" /></div>
                                            <div class="course-2__desc"><?php echo preg_replace('!<[^>]*?>!', ' ', htmlDecode($_smarty_tpl->tpl_vars['course']->value['des']));?>
</div>
                                            <div class="course-2__footer"><a class="course-2__btn" href="<?php echo $_smarty_tpl->tpl_vars['Rewrite']->value->url_category($_smarty_tpl->tpl_vars['course']->value);?>
">Khám phá</a></div>
                                        </div>
                                    </div>
                                </div>
                                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                            </div>
                        </div>
                    </div>
                    <?php }?>
                </div>
                <div class="tab-pane fade" id="course-tab-2">
                    <?php if ($_smarty_tpl->tpl_vars['combos']->value) {?>
                    <div class="course-slider">
                        <div class="course-slider__prev"><i class="fa fa-angle-left"></i></div>
                        <div class="course-slider__next"><i class="fa fa-angle-right"></i></div>
                        <div class="course-slider__container swiper-container">
                            <div class="swiper-wrapper">
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['combos']->value, 'combo', false, 'key', 'name', array (
));
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['combo']->value) {
?>
                                <div class="swiper-slide">
                                    <div class="course-2">
                                        <div class="course-2__header"><?php echo $_smarty_tpl->tpl_vars['combo']->value['name'];?>
</div>
                                        <div class="course-2__body">
                                            <div class="course-2__price">
                                                <div><?php echo $_smarty_tpl->tpl_vars['core']->value->callfunc('number_format',$_smarty_tpl->tpl_vars['combo']->value['price_vn']);?>
 Vnđ</div>
                                                <div><?php echo $_smarty_tpl->tpl_vars['core']->value->callfunc('number_format',$_smarty_tpl->tpl_vars['combo']->value['price_jp']);?>
 ¥</div>
                                            </div>
                                            <div class="mt-1">Thời gian: <?php echo $_smarty_tpl->tpl_vars['combo']->value['duration'];?>
 tháng</div>
                                        </div>
                                        <div class="course-2__footer">
                                            <div class="course-2__btn">Mua khóa học</div>
                                        </div>
                                        <div class="course-2__overlay">
                                            <div class="course-2__name"><span><?php echo $_smarty_tpl->tpl_vars['combo']->value['name'];?>
</span><img src="<?php echo $_smarty_tpl->tpl_vars['URL_IMAGES']->value;?>
/icon-lantern.png" alt="" /></div>
                                            <div class="course-2__desc"><?php echo preg_replace('!<[^>]*?>!', ' ', htmlDecode($_smarty_tpl->tpl_vars['combo']->value['des']));?>
</div>
                                            <div class="course-2__footer"><a class="course-2__btn" href="<?php echo $_smarty_tpl->tpl_vars['Rewrite']->value->url_category($_smarty_tpl->tpl_vars['combo']->value);?>
#detail-tab-2">Mua khóa học</a></div>
                                        </div>
                                    </div>
                                </div>
                                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                            </div>
                        </div>
                    </div>
                    <?php }?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php echo $_smarty_tpl->tpl_vars['core']->value->echoAdverNonTime('why','why');?>

<!-- xem thử bài giảng-->
<?php if (!$_smarty_tpl->tpl_vars['isTestSpeed']->value) {
if ($_smarty_tpl->tpl_vars['trialLevels']->value) {?>
<section class="section-2 bg-light">
    <div class="container">
        <h2 class="section-2__title"><span>Xem thử bài giảng</span><img src="<?php echo $_smarty_tpl->tpl_vars['URL_IMAGES']->value;?>
/icon-jp-flag.png" alt=""></h2>
        <ul class="nav n-tabs">
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['trialLevels']->value, 'level', false, 'key', 'name', array (
));
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['level']->value) {
?>
            <?php if ($_smarty_tpl->tpl_vars['level']->value['lessons']) {?>
            <li class="nav-item">
                <a class="nav-link 
                <?php if ($_smarty_tpl->tpl_vars['level']->value['lessons']) {?>
                <?php if ($_smarty_tpl->tpl_vars['key']->value == 1) {?>active<?php }?>
                <?php } else { ?>
                <?php if ($_smarty_tpl->tpl_vars['key']->value == 0) {?>active<?php }?>
                <?php }?>

                " href="#lesson-tab-<?php echo $_smarty_tpl->tpl_vars['key']->value+1;?>
" data-toggle="tab">
                    <img class="n-tabs__bg" src="<?php echo $_smarty_tpl->tpl_vars['URL_IMAGES']->value;?>
/n-tab-link-bg.png" alt="">
                    <img src="<?php echo $_smarty_tpl->tpl_vars['URL_IMAGES']->value;?>
/icon-jp-flag.png" alt="">
                    <span>Bài giảng <?php echo $_smarty_tpl->tpl_vars['level']->value['code'];?>
</span>
                </a>
            </li>
            <?php }?>
            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        </ul>
        <div class="n-tabs-content">
            <div class="tab-content">
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['trialLevels']->value, 'level', false, 'key', 'name', array (
));
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['level']->value) {
?>
                <div class="tab-pane fade <?php if ($_smarty_tpl->tpl_vars['key']->value == 1) {?>show active<?php }?>" id="lesson-tab-<?php echo $_smarty_tpl->tpl_vars['key']->value+1;?>
">
                    <?php if ($_smarty_tpl->tpl_vars['level']->value['lessons']) {?>
                    <div class="course-slider">
                        <div class="course-slider__prev"><i class="fa fa-angle-left"></i></div>
                        <div class="course-slider__next"><i class="fa fa-angle-right"></i></div>
                        <div class="course-slider__container swiper-container">
                            <div class="swiper-wrapper">
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['level']->value['lessons'], 'lesson', false, 'i', 'name', array (
));
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['i']->value => $_smarty_tpl->tpl_vars['lesson']->value) {
?>
                                <div class="swiper-slide">
                                    <a class="lesson-3" href="<?php echo $_smarty_tpl->tpl_vars['Rewrite']->value->url_lesson($_smarty_tpl->tpl_vars['lesson']->value);?>
">
                                        <?php if ($_smarty_tpl->tpl_vars['lesson']->value['image']) {?>
                                        <img src="<?php echo $_smarty_tpl->tpl_vars['URL_UPLOADS']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['lesson']->value['image'];?>
" alt="<?php echo $_smarty_tpl->tpl_vars['lesson']->value['name'];?>
" />
                                        <?php } else { ?>
                                        <img src="<?php echo $_smarty_tpl->tpl_vars['URL_IMAGES']->value;?>
/nopic.png" alt="<?php echo $_smarty_tpl->tpl_vars['lesson']->value['name'];?>
" />
                                        <?php }?>
                                    </a>
                                </div>
                                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                            </div>
                        </div>
                    </div>
                    <?php }?>
                </div>
                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            </div>
        </div>
    </div>
    <div class="aside-2__body py-3 text-center">
        <a class="button" href="https://m.me/111871621739031?ref=koseionline-vn">Nhận tư vấn ngay</a>
    </div>
</section>
<?php }
}
if (!$_smarty_tpl->tpl_vars['isTestSpeed']->value) {?>
<!-- End -->
<?php if ($_smarty_tpl->tpl_vars['arrListTeacher']->value) {?>
<!-- thông tin giảng viên-->
<section class="section-2">
    <div class="container">
        <h2 class="section-2__title"><span><?php echo smarty_modifier_lang('You_will_learn_with_a_good_and_dedicated_teacher');?>
</span><img src="<?php echo $_smarty_tpl->tpl_vars['URL_IMAGES']->value;?>
/icon-jp-woman.png" alt=""></h2>
        <div class="teacher-slider">
            <div class="teacher-slider__prev"><i class="fa fa-angle-left"></i></div>
            <div class="teacher-slider__next"><i class="fa fa-angle-right"></i></div>
            <div class="teacher-slider__container swiper-container">
                <div class="swiper-wrapper">
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['arrListTeacher']->value, 'teacher', false, 'i');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['i']->value => $_smarty_tpl->tpl_vars['teacher']->value) {
?>
                    <div class="swiper-slide">
                        <div class="teacher"><a class="teacher__frame" href="<?php echo $_smarty_tpl->tpl_vars['Rewrite']->value->url_teacher($_smarty_tpl->tpl_vars['teacher']->value);?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['URL_UPLOADS']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['teacher']->value['image'];?>
" alt="<?php echo $_smarty_tpl->tpl_vars['teacher']->value['title'];?>
" /></a>
                            <div class="teacher__body">
                                <h3 class="teacher__name"><a class="text-default" href="<?php echo $_smarty_tpl->tpl_vars['Rewrite']->value->url_teacher($_smarty_tpl->tpl_vars['teacher']->value);?>
"><?php echo $_smarty_tpl->tpl_vars['teacher']->value['title'];?>
</a></h3>
                                <div class="teacher__info"> <?php echo htmlDecode($_smarty_tpl->tpl_vars['teacher']->value['sapo']);?>
</div>
                                <div class="teacher__contacts">
                                    <a class="teacher__contact" href="<?php echo $_smarty_tpl->tpl_vars['teacher']->value['facebook'];?>
"><i class="fa fa-fw fa-facebook"></i></a>
                                    <a class="teacher__contact" href="<?php echo $_smarty_tpl->tpl_vars['teacher']->value['instagram'];?>
"><i class="fa fa-fw fa-instagram"></i></a>
                                    <a class="teacher__contact" href="<?php echo $_smarty_tpl->tpl_vars['teacher']->value['twitter'];?>
"><i class="fa fa-fw fa-twitter"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php }
}
if (!$_smarty_tpl->tpl_vars['isTestSpeed']->value) {?>
<!-- Cảm nhận học viên-->
<?php echo $_smarty_tpl->tpl_vars['core']->value->echoAdverNonTime('CR','customer_reviews');?>

<?php }?>
<!-- đăng ký tư vấn-->
<?php }
}
