<?php
/* Smarty version 3.1.32, created on 2021-06-08 13:54:05
  from '/var/www/koseionline.vn/data/www/koseionline.vn/themes/template/_blocks/_lesson-search.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_60bf140df05a43_69381448',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ee2348be8d1a5a38eab49b26e99bcd1a785c7d2f' => 
    array (
      0 => '/var/www/koseionline.vn/data/www/koseionline.vn/themes/template/_blocks/_lesson-search.tpl',
      1 => 1620635678,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60bf140df05a43_69381448 (Smarty_Internal_Template $_smarty_tpl) {
?><section class="aside-2 mb-20 position-relative" style="z-index: 30">
  <h2 class="aside-2__title">Tìm kiếm</h2>
  <div class="aside-2__body py-3 text-center">
    <form action="" class="aside-2__search">
      <div class="input-group">
        <input type="text" class="form-control js-lesson-search" placeholder="Tìm kiếm bài học" name="name" data-cat-id="<?php echo $_smarty_tpl->tpl_vars['curCat']->value['cat_id'];?>
" autocomplete="off">
        <div class="input-group-append">
          <button class="input-group-text" type="button">
            <i class="fa fa-search"></i>
          </button>
        </div>
      </div>
      <div class="aside-2__search-result">
              </div>
    </form>
  </div>
</section>
<?php }
}
