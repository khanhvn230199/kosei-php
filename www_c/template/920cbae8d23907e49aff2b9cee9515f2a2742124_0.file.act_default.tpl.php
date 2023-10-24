<?php
/* Smarty version 3.1.32, created on 2023-05-19 10:38:27
  from '/var/www/koseionline/data/www/koseionline.vn/themes/template/account/act_default.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_6466ef33a63429_56098803',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '920cbae8d23907e49aff2b9cee9515f2a2742124' => 
    array (
      0 => '/var/www/koseionline/data/www/koseionline.vn/themes/template/account/act_default.tpl',
      1 => 1677662663,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6466ef33a63429_56098803 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/var/www/koseionline/data/www/koseionline.vn/includes/smarty3/plugins/modifier.lang.php','function'=>'smarty_modifier_lang',),1=>array('file'=>'/var/www/koseionline/data/www/koseionline.vn/includes/smarty3/plugins/modifier.phone_format.php','function'=>'smarty_modifier_phone_format',),2=>array('file'=>'/var/www/koseionline/data/www/koseionline.vn/includes/smarty3/plugins/modifier.date_format.php','function'=>'smarty_modifier_date_format',),));
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
            <li class="breadcrumb-item active"><?php echo smarty_modifier_lang('Profile');?>
</li>
        </ol>
    </div>
</nav>
<section class="section mb-50">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="profile-panel card">
                    <h2 class="card-header"><?php echo smarty_modifier_lang('Profile');?>
</h2>
                    <div class="list-group list-group-flush">
                        <a class="list-group-item list-group-item-active" href="<?php echo $_smarty_tpl->tpl_vars['Rewrite']->value->url_history();?>
">
                            <img src="<?php echo $_smarty_tpl->tpl_vars['URL_IMAGES']->value;?>
/icon-file-list.png" alt="<?php echo smarty_modifier_lang('Learning_information');?>
">
                            <span><?php echo smarty_modifier_lang('Learning_information');?>
</span>
                        </a>
                        <a class="list-group-item list-group-item-active active" href="javascript:;">
                            <img src="<?php echo $_smarty_tpl->tpl_vars['URL_IMAGES']->value;?>
/icon-user-blue.png" alt="<?php echo smarty_modifier_lang('Profile');?>
">
                            <span><?php echo smarty_modifier_lang('Profile');?>
</span>
                        </a>
                        <a class="list-group-item list-group-item-active" href="<?php echo $_smarty_tpl->tpl_vars['Rewrite']->value->url_historylearning();?>
">
                            <img src="<?php echo $_smarty_tpl->tpl_vars['URL_IMAGES']->value;?>
/icon-file-list.png" alt="<?php echo smarty_modifier_lang('Lịch sử học tập');?>
">
                            <span><?php echo smarty_modifier_lang('Lịch sử học tập');?>
</span>
                        </a>
                        <a class="list-group-item list-group-item-active" href="<?php echo $_smarty_tpl->tpl_vars['Rewrite']->value->url_logout();?>
">
                            <img src="<?php echo $_smarty_tpl->tpl_vars['URL_IMAGES']->value;?>
/icon-power-off-blue.png" alt="<?php echo smarty_modifier_lang('Logout');?>
">
                            <span><?php echo smarty_modifier_lang('Logout');?>
</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <section class="profile-section">
                    <h2 class="profile-section__title"><?php echo $_smarty_tpl->tpl_vars['core']->value->getLang('Account_information');?>
</h2>
                    <ul class="profile-info">
                        <li>
                            <span>Email:</span>
                            <span><?php echo $_smarty_tpl->tpl_vars['core']->value->_USER['email'];?>
</span>
                            <a class="profile-info__edit" href="<?php echo $_smarty_tpl->tpl_vars['Rewrite']->value->url_changeinfo();?>
"><?php echo smarty_modifier_lang('Change_email');?>
</a>
                        </li>
                        <li>
                            <span><?php echo smarty_modifier_lang('Phone');?>
:</span>
                            <a class="profile-info__number" href="tel:<?php echo $_smarty_tpl->tpl_vars['core']->value->_USER['mobile'];?>
"><?php echo smarty_modifier_phone_format($_smarty_tpl->tpl_vars['core']->value->_USER['mobile']);?>
</a>
                            <a class="profile-info__edit" href="<?php echo $_smarty_tpl->tpl_vars['Rewrite']->value->url_changeinfo();?>
"><?php echo smarty_modifier_lang('Change_phone_number');?>
</a>
                        </li>
                        <li>
                            <span><?php echo smarty_modifier_lang('Password');?>
:</span>
                            <span>********</span>
                            <a class="profile-info__edit" href="<?php echo $_smarty_tpl->tpl_vars['Rewrite']->value->url_changeinfo();?>
"><?php echo smarty_modifier_lang('Change_password');?>
</a>
                        </li>
                    </ul>
                </section>
                <section class="profile-section">
                    <h2 class="profile-section__title"><?php echo smarty_modifier_lang('Profile');?>
</h2>
                    <form class="profile" method="post" enctype="multipart/form-data">
                        <div class="media">
                            <div class="profile__thumbs">
                                <div class="profile__thumbs-iwrap">
                                                                                                                                                                                                <img id="avatar" class="js-thumb-img" src="<?php echo $_smarty_tpl->tpl_vars['URL_UPLOADS']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['core']->value->_USER['avatar'];?>
" onerror="this.src='<?php echo $_smarty_tpl->tpl_vars['URL_IMAGES']->value;?>
/no_profile.png'" alt="<?php echo smarty_modifier_lang('Fullname');?>
">
                                </div>
                                <label class="profile__thumbs-btn">
                                    <input class="js-thumb-input" name="avatar" onChange="setPreviewAvatar(this, 'avatar');" accept=".jpg,.png,.bmp,.gif" type="file" />
                                    <i class="fa fa-picture-o"></i>
                                    <span><?php echo smarty_modifier_lang('Choose_avatar');?>
</span>
                                </label>
                            </div>
                            <div class="media-body">
                                <div class="form-group row">
                                    <label class="col-form-label col-xl-2"><?php echo smarty_modifier_lang('Full_name');?>
</label>
                                    <div class="col-xl-10">
                                        <input class="form-control" type="text" name="fullname" value="<?php echo $_smarty_tpl->tpl_vars['core']->value->_USER['fullname'];?>
" placeholder="<?php echo smarty_modifier_lang('Example_name');?>
">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-xl-2"><?php echo smarty_modifier_lang('Date_of_birth');?>
</label>
                                    <div class="col-xl-10">
                                        <div class="form-row">
                                            <?php $_smarty_tpl->_assignInScope('birthday', smarty_modifier_date_format($_smarty_tpl->tpl_vars['core']->value->_USER['birthday'],"%d/%m/%Y"));?>
                                            <?php $_smarty_tpl->_assignInScope('arrBirthday', explode("/",$_smarty_tpl->tpl_vars['birthday']->value));?>
                                            <div class="col-2">
                                                <select name="ngay" class="form-control">
                                                    <?php
$_smarty_tpl->tpl_vars['ngay'] = new Smarty_Variable(null, $_smarty_tpl->isRenderingCache);$_smarty_tpl->tpl_vars['ngay']->step = 1;$_smarty_tpl->tpl_vars['ngay']->total = (int) ceil(($_smarty_tpl->tpl_vars['ngay']->step > 0 ? 31+1 - (1) : 1-(31)+1)/abs($_smarty_tpl->tpl_vars['ngay']->step));
if ($_smarty_tpl->tpl_vars['ngay']->total > 0) {
for ($_smarty_tpl->tpl_vars['ngay']->value = 1, $_smarty_tpl->tpl_vars['ngay']->iteration = 1;$_smarty_tpl->tpl_vars['ngay']->iteration <= $_smarty_tpl->tpl_vars['ngay']->total;$_smarty_tpl->tpl_vars['ngay']->value += $_smarty_tpl->tpl_vars['ngay']->step, $_smarty_tpl->tpl_vars['ngay']->iteration++) {
$_smarty_tpl->tpl_vars['ngay']->first = $_smarty_tpl->tpl_vars['ngay']->iteration === 1;$_smarty_tpl->tpl_vars['ngay']->last = $_smarty_tpl->tpl_vars['ngay']->iteration === $_smarty_tpl->tpl_vars['ngay']->total;?>
                                                    <?php if ($_smarty_tpl->tpl_vars['ngay']->value < 10) {?> <?php $_smarty_tpl->_assignInScope('ngay', "0".((string)$_smarty_tpl->tpl_vars['ngay']->value));?> <?php }?> <option <?php if ($_smarty_tpl->tpl_vars['ngay']->value == $_smarty_tpl->tpl_vars['arrBirthday']->value[0]) {?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['ngay']->value;?>
 </option> <?php }
}
?> </select> </div> <div class="col-2">
                                                        <select name="thang" class="form-control">
                                                            <?php
$_smarty_tpl->tpl_vars['thang'] = new Smarty_Variable(null, $_smarty_tpl->isRenderingCache);$_smarty_tpl->tpl_vars['thang']->step = 1;$_smarty_tpl->tpl_vars['thang']->total = (int) ceil(($_smarty_tpl->tpl_vars['thang']->step > 0 ? 12+1 - (1) : 1-(12)+1)/abs($_smarty_tpl->tpl_vars['thang']->step));
if ($_smarty_tpl->tpl_vars['thang']->total > 0) {
for ($_smarty_tpl->tpl_vars['thang']->value = 1, $_smarty_tpl->tpl_vars['thang']->iteration = 1;$_smarty_tpl->tpl_vars['thang']->iteration <= $_smarty_tpl->tpl_vars['thang']->total;$_smarty_tpl->tpl_vars['thang']->value += $_smarty_tpl->tpl_vars['thang']->step, $_smarty_tpl->tpl_vars['thang']->iteration++) {
$_smarty_tpl->tpl_vars['thang']->first = $_smarty_tpl->tpl_vars['thang']->iteration === 1;$_smarty_tpl->tpl_vars['thang']->last = $_smarty_tpl->tpl_vars['thang']->iteration === $_smarty_tpl->tpl_vars['thang']->total;?>
                                                            <?php if ($_smarty_tpl->tpl_vars['thang']->value < 10) {?> <?php $_smarty_tpl->_assignInScope('thang', "0".((string)$_smarty_tpl->tpl_vars['thang']->value));?> <?php }?> <option <?php if ($_smarty_tpl->tpl_vars['thang']->value == $_smarty_tpl->tpl_vars['arrBirthday']->value[1]) {?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['thang']->value;?>
 </option> <?php }
}
?> </select> </div> <div class="col-2">
                                                                <select name="nam" class="form-control">
                                                                    <?php
$_smarty_tpl->tpl_vars['nam'] = new Smarty_Variable(null, $_smarty_tpl->isRenderingCache);$_smarty_tpl->tpl_vars['nam']->step = 1;$_smarty_tpl->tpl_vars['nam']->total = (int) ceil(($_smarty_tpl->tpl_vars['nam']->step > 0 ? date('Y')+1 - (1900) : 1900-(date('Y'))+1)/abs($_smarty_tpl->tpl_vars['nam']->step));
if ($_smarty_tpl->tpl_vars['nam']->total > 0) {
for ($_smarty_tpl->tpl_vars['nam']->value = 1900, $_smarty_tpl->tpl_vars['nam']->iteration = 1;$_smarty_tpl->tpl_vars['nam']->iteration <= $_smarty_tpl->tpl_vars['nam']->total;$_smarty_tpl->tpl_vars['nam']->value += $_smarty_tpl->tpl_vars['nam']->step, $_smarty_tpl->tpl_vars['nam']->iteration++) {
$_smarty_tpl->tpl_vars['nam']->first = $_smarty_tpl->tpl_vars['nam']->iteration === 1;$_smarty_tpl->tpl_vars['nam']->last = $_smarty_tpl->tpl_vars['nam']->iteration === $_smarty_tpl->tpl_vars['nam']->total;?>
                                                                    <option <?php if ($_smarty_tpl->tpl_vars['nam']->value == $_smarty_tpl->tpl_vars['arrBirthday']->value[2]) {?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['nam']->value;?>
 </option> <?php }
}
?> </select> </div> </div> </div> </div> <div class="form-group row">
                                                                        <label class="col-form-label col-xl-2"><?php echo smarty_modifier_lang('Province_City');?>
</label>
                                                                        <div class="col-xl-10">
                                                                            <select class="form-control" name="province_id">
                                                                                <?php echo $_smarty_tpl->tpl_vars['htmlOptionKhuvuc']->value;?>

                                                                            </select>
                                                                        </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-form-label col-xl-2"><?php echo smarty_modifier_lang('Address');?>
</label>
                                                <div class="col-xl-10">
                                                    <input class="form-control" type="text" name="address" value="<?php echo $_smarty_tpl->tpl_vars['core']->value->_USER['address'];?>
">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-form-label col-xl-2"><?php echo smarty_modifier_lang('Gender');?>
</label>
                                                <div class="col-xl-10">
                                                    <select class="form-control" name="gender">
                                                        <option value="0"><?php echo smarty_modifier_lang('Male');?>
</option>
                                                        <option value="1"><?php echo smarty_modifier_lang('Female');?>
</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button class="btn btn-primary text-700 px-35 py-2" type="submit" name="btnSubmit" value="UpdateAccount"><?php echo smarty_modifier_lang('Update');?>
</button>
                                    </div>
                    </form>
                </section>
            </div>
        </div>
    </div>
</section><?php }
}
