<?php
/* Smarty version 3.1.32, created on 2021-06-20 19:02:52
  from '/var/www/koseionline.vn/data/www/koseionline.vn/admin/templates/settings/act_generalsetting.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_60cf2e6c6e50f3_10050245',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c133d5bfb1bbeb72797067f5db875dbf9998187f' => 
    array (
      0 => '/var/www/koseionline.vn/data/www/koseionline.vn/admin/templates/settings/act_generalsetting.html',
      1 => 1616483394,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60cf2e6c6e50f3_10050245 (Smarty_Internal_Template $_smarty_tpl) {
echo $_smarty_tpl->tpl_vars['clsForm']->value->showJS();?>

<div class="inner_head_title">
    <table cellpadding="0" cellspacing="0" width="100%" border="0">
        <tr style="background:#FBFBFB">
            <td width="55px" style="padding:5px;">
                <a href="?mod=<?php echo $_smarty_tpl->tpl_vars['mod']->value;?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['ADMIN_URL_IMAGES']->value;?>
/largeicon/config.png" border="0"/></a>
            </td>
            <td>
                <span class="title1"><?php echo $_smarty_tpl->tpl_vars['core']->value->getLang("GeneralSettings");?>
</span><br/>
                <span class="title2"><?php echo $_smarty_tpl->tpl_vars['core']->value->getLang("GeneralSettings");?>
 (<?php echo $_smarty_tpl->tpl_vars['lang_code_name']->value;?>
)</span>
            </td>
            <td style="padding:5px;" align="right">
                <?php echo $_smarty_tpl->tpl_vars['clsButtonNav']->value->render();?>

            </td>
        </tr>
    </table>
</div>
<form name="theForm" action="" method="post" id="theForm">
    <table width="100%" border="0">
        <tr>
            <td style="padding:10px">
                <div style="padding-bottom:5px;font-size:14px; float:left">
                    <strong><?php echo $_smarty_tpl->tpl_vars['core']->value->getLang("GeneralSettings");?>
</strong>
                </div>
                <div style="float:right;font-size:12px; width:30%; color:blue" align="right">
                    Ngôn ngữ: <?php echo $_smarty_tpl->tpl_vars['lang_code_name']->value;?>

                </div>
            </td>
        </tr>
        <tr>
            <td style="padding:0px 10px" width="100%" valign="top">
                <table cellpadding="0" cellspacing="0" width="100%" border="0" class="girdtable">
                    <tr>
                        <td colspan="2" class="gridheader1"><?php echo $_smarty_tpl->tpl_vars['core']->value->getLang("InputCorrectlyAllBelowFields");?>
</td>
                    </tr>
                    <tr>
                        <td class="gridrow" width="30%"><?php echo $_smarty_tpl->tpl_vars['core']->value->getLang("SiteTitle");?>
</td>
                        <td class="gridrow1">
                            <input type="text" name="site_title" value="<?php echo $_smarty_tpl->tpl_vars['site_title']->value;?>
" style="width:50%"/>
                        </td>
                    </tr>
                    <tr>
                        <td class="gridrow" width="30%"><?php echo $_smarty_tpl->tpl_vars['core']->value->getLang("Logo");?>

                            <small>(Logo của website)</small>
                        </td>
                        <td class="gridrow1">
                            <?php echo $_smarty_tpl->tpl_vars['clsForm']->value->showInput("site_logo");?>

                        </td>
                    </tr>
                    <tr>
                        <td class="gridrow" width="30%"><?php echo $_smarty_tpl->tpl_vars['core']->value->getLang("Favicon");?>

                            <small>(Hiển thị trên thanh bar của trình duyệt)</small>
                        </td>
                        <td class="gridrow1">
                            <?php echo $_smarty_tpl->tpl_vars['clsForm']->value->showInput("site_favicon");?>

                        </td>
                    </tr>
                    <tr>
                        <td class="gridrow"><?php echo $_smarty_tpl->tpl_vars['core']->value->getLang("SiteName");?>
</td>
                        <td class="gridrow1">
                            <input type="text" name="site_name" value="<?php echo $_smarty_tpl->tpl_vars['site_name']->value;?>
" style="width:50%"/>
                        </td>
                    </tr>
                    <tr>
                        <td class="gridrow">Tên công ty/tổ chức</td>
                        <td class="gridrow1">
                            <input type="text" name="site_comname" value="<?php echo $_smarty_tpl->tpl_vars['site_comname']->value;?>
" style="width:50%"/>
                        </td>
                    </tr>
                    <tr>
                        <td class="gridrow"><?php echo $_smarty_tpl->tpl_vars['core']->value->getLang("Phone");?>

                            <small>(Có nhiều thì dùng dấu ; để ngăn cách)</small>
                        </td>
                        <td class="gridrow1">
                            <input type="text" name="site_phone" value="<?php echo $_smarty_tpl->tpl_vars['site_phone']->value;?>
" style="width:50%"/>
                        </td>
                    </tr>
                    <tr>
                        <td class="gridrow"><?php echo $_smarty_tpl->tpl_vars['core']->value->getLang("Hotline");?>

                            <small>(Có nhiều thì dùng dấu ; để ngăn cách)</small>
                        </td>
                        <td class="gridrow1">
                            <input type="text" name="site_hotline" value="<?php echo $_smarty_tpl->tpl_vars['site_hotline']->value;?>
" style="width:50%"/>
                        </td>
                    </tr>
                    <tr>
                        <td class="gridrow"><?php echo $_smarty_tpl->tpl_vars['core']->value->getLang("Email");?>

                            <small>(Có nhiều thì dùng dấu ; để ngăn cách)</small>
                        </td>
                        <td class="gridrow1">
                            <input type="text" name="site_email" value="<?php echo $_smarty_tpl->tpl_vars['site_email']->value;?>
" style="width:50%"/>
                        </td>
                    </tr>
                    <tr>
                        <td class="gridrow"><?php echo $_smarty_tpl->tpl_vars['core']->value->getLang("Address");?>
</td>
                        <td class="gridrow1">
                            <input type="text" name="site_address" value="<?php echo $_smarty_tpl->tpl_vars['site_address']->value;?>
" style="width:50%"/>
                        </td>
                    </tr>
                    <tr>
                        <td class="gridrow"><?php echo $_smarty_tpl->tpl_vars['core']->value->getLang("Copyright_text");?>
</td>
                        <td class="gridrow1">
                            <input type="text" name="copyright" value="<?php echo $_smarty_tpl->tpl_vars['copyright']->value;?>
" style="width:99%"/>
                        </td>
                    </tr>
                    <tr>
                        <td class="gridrow" width="30%"><?php echo $_smarty_tpl->tpl_vars['core']->value->getLang('Điều khoản đăng ký');?>
</td>
                        <td class="gridrow1">
                            <?php echo $_smarty_tpl->tpl_vars['clsForm']->value->showInput("terms_of_use");?>

                        </td>
                    </tr>
                    <tr>
                        <td class="gridrow" width="30%"><?php echo $_smarty_tpl->tpl_vars['core']->value->getLang('Thông tin giới thiệu');?>
</td>
                        <td class="gridrow1">
                            <?php echo $_smarty_tpl->tpl_vars['clsForm']->value->showInput("about");?>

                        </td>
                    </tr>
                    <tr>
                        <td class="gridrow" width="30%"><?php echo $_smarty_tpl->tpl_vars['core']->value->getLang('Thông tin liên hệ');?>
</td>
                        <td class="gridrow1">
                            <?php echo $_smarty_tpl->tpl_vars['clsForm']->value->showInput("contact_info");?>

                        </td>
                    </tr>
                    <tr>
                        <td class="gridrow" width="30%"><?php echo $_smarty_tpl->tpl_vars['core']->value->getLang('Thông tin chân trang');?>
</td>
                        <td class="gridrow1">
                            <?php echo $_smarty_tpl->tpl_vars['clsForm']->value->showInput("footer_info");?>

                        </td>
                    </tr>
                    <tr>
                        <td class="gridrow2" style="color:red"><?php echo $_smarty_tpl->tpl_vars['core']->value->getLang("Do_you_close_website");?>
?</td>
                        <td class="gridrow3" style="color:red" valign="top">
                            <select name="is_close_site" class="content">
                                <option value="1" <?php if ($_smarty_tpl->tpl_vars['is_close_site']->value == 1) {?>selected<?php }?>>
                                    <?php echo $_smarty_tpl->tpl_vars['core']->value->getLang("Yes_For_maintenance");?>

                                </option>
                                <option value="0" <?php if ($_smarty_tpl->tpl_vars['is_close_site']->value == 0) {?>selected<?php }?>>
                                    <?php echo $_smarty_tpl->tpl_vars['core']->value->getLang("No_Active_normally");?>

                                </option>
                            </select>
                            <div id="close_site_notice_id" style="display:none; padding-top:10px">
                                <?php echo $_smarty_tpl->tpl_vars['core']->value->getLang("Notification_when_closing");?>
:
                                <?php echo $_smarty_tpl->tpl_vars['clsForm']->value->showInput("close_site_notice");?>

                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="gridheader1"><?php echo $_smarty_tpl->tpl_vars['core']->value->getLang("SMTP_Setting");?>
</td>
                    </tr>
                    <tr>
                        <td class="gridrow"><?php echo $_smarty_tpl->tpl_vars['core']->value->getLang("Webmaster_email");?>
</td>
                        <td class="gridrow1">
                            <input type="text" name="webmaster_email" value="<?php echo $_smarty_tpl->tpl_vars['webmaster_email']->value;?>
" style="width:50%"/>
                        </td>
                    </tr>
                    <tr>
                        <td class="gridrow"><?php echo $_smarty_tpl->tpl_vars['core']->value->getLang("SMTP_Server");?>
 / Port</td>
                        <td class="gridrow1">
                            <input type="text" name="smtp_server" value="<?php echo $_smarty_tpl->tpl_vars['smtp_server']->value;?>
" style="width:50%"
                                   placeholder="vd: smtp.gmail.com"/>
                            <input type="text" name="smtp_port" value="<?php echo $_smarty_tpl->tpl_vars['smtp_port']->value;?>
" style="width:50px" maxlength="4"
                                   placeholder="vd: 465"/>
                        </td>
                    </tr>
                    <tr>
                        <td class="gridrow"><?php echo $_smarty_tpl->tpl_vars['core']->value->getLang("SMTP_Username");?>
</td>
                        <td class="gridrow1">
                            <input type="text" name="smtp_user" value="<?php echo $_smarty_tpl->tpl_vars['smtp_user']->value;?>
" style="width:50%" autocomplete="Off" placeholder="vd: abc@gmail.com"/>
                        </td>
                    </tr>
                    <tr>
                        <td class="gridrow"><?php echo $_smarty_tpl->tpl_vars['core']->value->getLang("SMTP_Password");?>
</td>
                        <td class="gridrow1">
                            <input type="password" name="smtp_pass" value="<?php echo $_smarty_tpl->tpl_vars['smtp_pass']->value;?>
" autocomplete="Off" style="width:50%"
                                   placeholder="mật khẩu *****"/>
                        </td>
                    </tr>
                </table>
                <em><font style="font-size:10px"><?php echo $_smarty_tpl->tpl_vars['core']->value->getLang("Note");?>
: * <?php echo $_smarty_tpl->tpl_vars['core']->value->getLang("isrequired");?>
</font></em>
            </td>
        </tr>
    </table>
</form><?php }
}
