<?php
/* Smarty version 3.1.32, created on 2021-06-09 04:00:29
  from '/var/www/koseionline.vn/data/www/koseionline.vn/themes/template/home/act_page.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_60bfda6d952214_26713284',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a9706bdd27ec89cc47584f52d3c649e9d35fe624' => 
    array (
      0 => '/var/www/koseionline.vn/data/www/koseionline.vn/themes/template/home/act_page.tpl',
      1 => 1618904760,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60bfda6d952214_26713284 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/var/www/koseionline.vn/data/www/koseionline.vn/includes/smarty3/plugins/modifier.lang.php','function'=>'smarty_modifier_lang',),));
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
            <li class="breadcrumb-item active"><?php echo $_smarty_tpl->tpl_vars['arrOnePage']->value['name'];?>
</li>
        </ol>
    </div>
</nav>
<section class="section mb-50">
    <div class="container">
        <h1 class="section__title"><?php echo $_smarty_tpl->tpl_vars['arrOnePage']->value['name'];?>
</h1>
        <article class="post">
            <div class="mb-3">
                <div class="fb-like" data-href="<?php echo $_smarty_tpl->tpl_vars['Rewrite']->value->url_article($_smarty_tpl->tpl_vars['arrOnePage']->value);?>
" data-layout="button_count" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
            </div>
            <h2 class="post-sapo"><?php echo htmlDecode($_smarty_tpl->tpl_vars['arrOnePage']->value['sapo']);?>
</h2>
            <div class="post-content">
                <?php echo htmlDecode($_smarty_tpl->tpl_vars['arrOnePage']->value['content']);?>

                <p>
                    <img src="<?php echo $_smarty_tpl->tpl_vars['URL_IMAGES']->value;?>
/dmca.png" alt="<?php echo $_smarty_tpl->tpl_vars['arrOnePage']->value['name'];?>
" />
                </p>
            </div>
        </article>
    </div>
</section>
<section class="mb-50 over-hidden">
    <div class="container">
        <div>
            <div class="fb-comments" data-href="<?php echo $_smarty_tpl->tpl_vars['Rewrite']->value->url_article($_smarty_tpl->tpl_vars['arrOnePage']->value);?>
" data-width="100%" data-numposts="10"></div>
        </div>
    </div>
</section>

    <?php }
}
