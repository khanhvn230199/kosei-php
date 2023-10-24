<?php
/* Smarty version 3.1.32, created on 2023-05-20 06:30:09
  from '/var/www/koseionline/data/www/koseionline.vn/themes/template/articles/act_detail.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_64680681602cb5_10281269',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'db8a9060e124a6e55f26c98351e728759612cc99' => 
    array (
      0 => '/var/www/koseionline/data/www/koseionline.vn/themes/template/articles/act_detail.tpl',
      1 => 1670384108,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_64680681602cb5_10281269 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/var/www/koseionline/data/www/koseionline.vn/includes/smarty3/plugins/modifier.lang.php','function'=>'smarty_modifier_lang',),1=>array('file'=>'/var/www/koseionline/data/www/koseionline.vn/includes/smarty3/plugins/modifier.truncate.php','function'=>'smarty_modifier_truncate',),));
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
            <li class="breadcrumb-item">
                <a class="link-unstyled" href="<?php echo $_smarty_tpl->tpl_vars['Rewrite']->value->url_category($_smarty_tpl->tpl_vars['curCat']->value);?>
"><?php echo $_smarty_tpl->tpl_vars['curCat']->value['name'];?>
</a>
            </li>
            <li class="breadcrumb-item active"><?php echo $_smarty_tpl->tpl_vars['arrOneArticle']->value['title'];?>
</li>
        </ol>
    </div>
</nav>
<section class="section mb-50">
    <div class="container">
        <div class="section__title"><?php echo $_smarty_tpl->tpl_vars['curCat']->value['name'];?>
</div>
        <article class="post">
            <h1 class="post-title"><?php echo $_smarty_tpl->tpl_vars['arrOneArticle']->value['title'];?>
</h1>
            <div class="mb-3">
                <div class="fb-like" data-href="<?php echo $_smarty_tpl->tpl_vars['Rewrite']->value->url_article($_smarty_tpl->tpl_vars['arrOneArticle']->value);?>
" data-layout="button_count"
                     data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
            </div>
            <h2 class="post-sapo"><?php echo htmlDecode($_smarty_tpl->tpl_vars['arrOneArticle']->value['sapo']);?>
</h2>
            <div class="post-content">
                <?php echo htmlDecode($_smarty_tpl->tpl_vars['arrOneArticle']->value['content']);?>

                <p>
                    <img src="<?php echo $_smarty_tpl->tpl_vars['URL_IMAGES']->value;?>
/dmca.png" alt="<?php echo $_smarty_tpl->tpl_vars['arrOneArticle']->value['title'];?>
"/>
                </p>
            </div>
        </article>
    </div>
</section>
<section class="mb-50 over-hidden">
    <div class="container">
        <?php if ($_smarty_tpl->tpl_vars['arrListOtherArticles']->value) {?>
            <h2 class="section__title"><?php echo smarty_modifier_lang('Related_news');?>
</h2>
            <div class="subject-slider js-subject-slider mb-30">
                <div class="subject-slider__prev">
                    <img src="<?php echo $_smarty_tpl->tpl_vars['URL_IMAGES']->value;?>
/icon-angle-left-blue.png" alt="prev"/>
                </div>
                <div class="subject-slider__next">
                    <img src="<?php echo $_smarty_tpl->tpl_vars['URL_IMAGES']->value;?>
/icon-angle-left-blue.png" alt="next"/>
                </div>
                <div class="swiper-container">
                    <div class="swiper-wrapper">
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['arrListOtherArticles']->value, 'news', false, 'n');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['n']->value => $_smarty_tpl->tpl_vars['news']->value) {
?>
                            <div class="swiper-slide">
                                <div class="subject-3">
                                    <a class="subject-3__iwrap" href="<?php echo $_smarty_tpl->tpl_vars['Rewrite']->value->url_article($_smarty_tpl->tpl_vars['news']->value);?>
"
                                       title="<?php echo $_smarty_tpl->tpl_vars['news']->value['title'];?>
">
                                        <img src="<?php echo $_smarty_tpl->tpl_vars['NVCMS_URL']->value;?>
/img.php?pic=<?php echo $_smarty_tpl->tpl_vars['core']->value->callfunc('base64_encode',$_smarty_tpl->tpl_vars['news']->value['image']);?>
&w=198&h=270&encode=1"
                                             onerror="this.src='<?php echo $_smarty_tpl->tpl_vars['URL_IMAGES']->value;?>
/nopic.png'" alt="<?php echo $_smarty_tpl->tpl_vars['news']->value['title'];?>
"/>
                                    </a>
                                    <h3 class="subject-3__title">
                                        <a class="text-default" href="<?php echo $_smarty_tpl->tpl_vars['Rewrite']->value->url_article($_smarty_tpl->tpl_vars['news']->value);?>
"
                                           title="<?php echo $_smarty_tpl->tpl_vars['news']->value['title'];?>
"><?php echo $_smarty_tpl->tpl_vars['news']->value['title'];?>
</a>
                                    </h3>
                                    <div class="subject-3__desc"><?php echo smarty_modifier_truncate(preg_replace('!<[^>]*?>!', ' ', htmlDecode($_smarty_tpl->tpl_vars['news']->value['sapo'])),200,"...");?>
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
        <div>
            <div class="fb-comments" data-href="<?php echo $_smarty_tpl->tpl_vars['Rewrite']->value->url_article($_smarty_tpl->tpl_vars['arrOneArticle']->value);?>
" data-width="100%"
                 data-numposts="10"></div>
        </div>
    </div>
</section><?php }
}
