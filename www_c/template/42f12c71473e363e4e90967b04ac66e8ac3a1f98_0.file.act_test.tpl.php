<?php
/* Smarty version 3.1.32, created on 2023-05-19 13:16:53
  from '/var/www/koseionline/data/www/koseionline.vn/themes/template/lessons/act_test.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_64671455ccc087_08803082',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '42f12c71473e363e4e90967b04ac66e8ac3a1f98' => 
    array (
      0 => '/var/www/koseionline/data/www/koseionline.vn/themes/template/lessons/act_test.tpl',
      1 => 1681368434,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:_blocks/_exercise.tpl' => 1,
    'file:_blocks/_lesson-search.tpl' => 1,
    'file:_blocks/_lesson-cats.tpl' => 1,
  ),
),false)) {
function content_64671455ccc087_08803082 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="container py-30">
    <div class="row">
        <div class="col-lg-8 mb-30">
            <?php if ($_smarty_tpl->tpl_vars['bigQuestions']->value) {?>
            <article class="js-test">
                <h2 class="vocab-page-title">Bài test đầu vào</h2>
                <?php $_smarty_tpl->_subTemplateRender("file:_blocks/_exercise.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
            </article>
            <?php }?>
        </div>
        <div class="col-lg-4 mb-30">
            <section class="float-sidebar" id="float-sidebar-1" style="z-index:2147483645">
                <div class="float-sidebar__header">
                    <div class="float-sidebar__close">
                        <div class="text-16 text-uppercase mr-2">Close</div>
                        <div class="navbar-toggle active"><span></span><span></span><span></span></div>
                    </div>
                </div>
                <div class="float-sidebar__body">
                    <?php $_smarty_tpl->_subTemplateRender("file:_blocks/_lesson-search.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
                    <section class="aside-2 mb-20 d-none d-lg-block">
                        <h2 class="aside-2__title">Hướng dẫn trước khi học</h2>
                        <div class="aside-2__body py-3">
                            <div class="expandable" data-height="300">
                                <div class="expandable__content">
                                    <?php echo htmlDecode($_smarty_tpl->tpl_vars['curCat']->value['instructions']);?>

                                </div>
                                <div class="expandable__footer"><a class="expandable__toggle" href="#!" data-label-expand="Xem thêm" data-label-collapse="Thu gọn"></a></div>
                            </div>
                        </div>
                    </section>
                    <?php $_smarty_tpl->_subTemplateRender("file:_blocks/_lesson-cats.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
                </div>
            </section>
            <section class="aside-2 mb-20 d-lg-none">
                <h2 class="aside-2__title">Hướng dẫn trước khi học</h2>
                <div class="aside-2__body py-3">
                    <div class="expandable" data-height="300">
                        <div class="expandable__content">
                            <?php echo htmlDecode($_smarty_tpl->tpl_vars['curCat']->value['instructions']);?>

                        </div>
                        <div class="expandable__footer"><a class="expandable__toggle" href="#!" data-label-expand="Xem thêm" data-label-collapse="Thu gọn"></a></div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <div class="fb-comments" data-href="<?php echo $_smarty_tpl->tpl_vars['Rewrite']->value->url_category($_smarty_tpl->tpl_vars['curCat']->value);?>
?test=1" data-width="100%" data-numposts="5"></div>
</div><?php }
}
