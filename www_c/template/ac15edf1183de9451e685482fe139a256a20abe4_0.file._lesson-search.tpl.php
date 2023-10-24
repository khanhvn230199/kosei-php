<?php
/* Smarty version 3.1.32, created on 2023-05-19 09:48:14
  from '/var/www/koseionline/data/www/koseionline.vn/themes/template/_blocks/_lesson-search.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_6466e36ee2f569_75359326',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ac15edf1183de9451e685482fe139a256a20abe4' => 
    array (
      0 => '/var/www/koseionline/data/www/koseionline.vn/themes/template/_blocks/_lesson-search.tpl',
      1 => 1679370171,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6466e36ee2f569_75359326 (Smarty_Internal_Template $_smarty_tpl) {
?><section class="aside-2 mb-20 position-relative" style="z-index: 30">
    <h2 class="aside-2__title"><?php echo $_smarty_tpl->tpl_vars['curCat']->value['name'];?>
</h2>
    <div class="aside-2__body py-3 text-center">
         <?php if ($_smarty_tpl->tpl_vars['isLogin']->value != 1) {?>
         <a class="button" href=".md-login" data-toggle="modal" >MUA KHÓA HỌC NÀY</a>
         <?php } else { ?>
        <a class="button js-show-tab" href="#detail-tab-2">MUA KHÓA HỌC NÀY</a>
        <?php }?>

    </div>
</section><?php }
}
