<?php
/* Smarty version 3.1.32, created on 2021-11-30 15:41:13
  from '/var/www/koseionline.vn/data/www/koseionline.vn/themes/template/trialtest/act_ranking.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_61a5e3a9a1de61_29774927',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '88a7a4dc841035a0a4122592ade32ca7a16dfa17' => 
    array (
      0 => '/var/www/koseionline.vn/data/www/koseionline.vn/themes/template/trialtest/act_ranking.tpl',
      1 => 1638261672,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_61a5e3a9a1de61_29774927 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/var/www/koseionline.vn/data/www/koseionline.vn/includes/smarty3/plugins/modifier.lang.php','function'=>'smarty_modifier_lang',),1=>array('file'=>'/var/www/koseionline.vn/data/www/koseionline.vn/includes/smarty3/plugins/modifier.date_format.php','function'=>'smarty_modifier_date_format',),));
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
        <a class="link-unstyled" href="<?php echo $_smarty_tpl->tpl_vars['Rewrite']->value->url_trialtest($_smarty_tpl->tpl_vars['test']->value);?>
"><?php echo $_smarty_tpl->tpl_vars['test']->value['name'];?>
</a>
      </li>
      <li class="breadcrumb-item active">Xếp hạng</li>
    </ol>
  </div>
</nav>

<section class="section mb-50">
  <div class="container">
    <h1 class="text-24 text-700 text-uppercase text-center"><?php echo $_smarty_tpl->tpl_vars['test']->value['name'];?>
</h1>
    <h2 class="text-16 text-700 text-uppercase text-center mb-30">Bảng xếp hạng điểm cao</h2>
    <?php if (!$_smarty_tpl->tpl_vars['test']->value) {?>
      <div class="alert alert-danger">Bài thi không tồn tại!</div>
    <?php } elseif (!$_smarty_tpl->tpl_vars['highScores']->value) {?>
      <div class="alert alert-warning">Chưa có thí sinh tham gia!</div>
    <?php } else { ?>
      <div class="table-responsive">
        <table class="table table-bordered table-hover">
          <thead>
            <tr>
              <th class="bg-primary text-white text-center">STT</th>
              <th class="bg-primary text-white">Họ và tên</th>
              <th class="bg-primary text-white text-center">Ngày thi</th>
              <?php if ($_smarty_tpl->tpl_vars['test']->value['level_id'] == 9 || $_smarty_tpl->tpl_vars['test']->value['level_id'] == 4) {?>
              <th class="bg-primary text-white text-right">Từ vựng + Ngữ pháp + Đọc hiểu</th>
              <?php } else { ?>
              <th class="bg-primary text-white text-right">Từ vựng + Ngữ pháp</th>
              <th class="bg-primary text-white text-right">Đọc hiểu</th>
              <?php }?>
              <th class="bg-primary text-white text-right">Nghe hiểu</th>
              <th class="bg-primary text-white text-right">Tổng điểm</th>
            </tr>
          </thead>
          <tbody>
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['highScores']->value, 'score', false, 'i');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['i']->value => $_smarty_tpl->tpl_vars['score']->value) {
?>
              <tr>
                <td class="text-center"><?php echo $_smarty_tpl->tpl_vars['i']->value+1;?>
</td>
                <td>
                  <div class="media align-items-center">
                    <img src="<?php echo $_smarty_tpl->tpl_vars['core']->value->callfunc("validAvatar",$_smarty_tpl->tpl_vars['score']->value['avatar']);?>
" class="mr-3" alt="" width="35" height="35" style="border-radius: 50%">
                    <div class="media-body"><?php echo $_smarty_tpl->tpl_vars['score']->value['fullname'];?>
</div>
                  </div>
                </td>
                <td class="text-center"><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['score']->value['reg_date'],"%d/%m/%Y");?>
</td>
                <?php if ($_smarty_tpl->tpl_vars['test']->value['level_id'] == 9 || $_smarty_tpl->tpl_vars['test']->value['level_id'] == 4) {?>
                <td class="text-right text-16"><?php echo ($_smarty_tpl->tpl_vars['score']->value['vocabulary_score']+$_smarty_tpl->tpl_vars['score']->value['reading_score']);?>
/120</td>
                <?php } else { ?>
                <td class="text-right text-16"><?php echo $_smarty_tpl->tpl_vars['score']->value['vocabulary_score'];?>
/60</td>
                <td class="text-right text-16"><?php echo $_smarty_tpl->tpl_vars['score']->value['reading_score'];?>
/60</td>
                <?php }?>
                <td class="text-right text-16"><?php echo $_smarty_tpl->tpl_vars['score']->value['listening_score'];?>
/60</td>
                <td class="text-right text-16 text-700 text-danger"><?php echo $_smarty_tpl->tpl_vars['score']->value['total_score'];?>
/180</td>
              </tr>
            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
          </tbody>
        </table>
      </div>
    <?php }?>
  </div>
</section>
<?php }
}
