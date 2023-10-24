<?php
/* Smarty version 3.1.32, created on 2021-06-26 09:28:24
  from '/var/www/koseionline.vn/data/www/koseionline.vn/admin/templates/accessstats/act_viewonline.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_60d690c8344fa0_38986649',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0aae263081d647558eae809420ea7d696fa94f55' => 
    array (
      0 => '/var/www/koseionline.vn/data/www/koseionline.vn/admin/templates/accessstats/act_viewonline.html',
      1 => 1616483390,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60d690c8344fa0_38986649 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/var/www/koseionline.vn/data/www/koseionline.vn/includes/smarty3/plugins/modifier.date_format.php','function'=>'smarty_modifier_date_format',),));
?><div class="inner_head_title">
<table cellpadding="0" cellspacing="0" width="100%" border="0">
<tr style="background:#FBFBFB">
	<td width="55px" style="padding:5px;">
	<a href="?mod=<?php echo $_smarty_tpl->tpl_vars['mod']->value;?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['ADMIN_URL_IMAGES']->value;?>
/largeicon/websitestats.png" border="0"/></a>
	</td>
	<td>
	<span class="title1"><?php echo $_smarty_tpl->tpl_vars['core']->value->getLang("AccessStatstics");?>
</span><br />
	<span class="title2"><?php echo $_smarty_tpl->tpl_vars['core']->value->getLang("AccessStatstics");?>
</span>
	</td>
	<td style="padding:5px;" align="right">
			<?php echo $_smarty_tpl->tpl_vars['clsButtonNav']->value->render();?>
		
	</td>
</tr>
</table>
</div>
<form name="theForm" action="" method="post">
<table width="100%" border="0">
<tr>
<td style="padding:10px">
	<div style="padding-bottom:5px;font-size:14px">
	<strong>Online? <?php echo $_smarty_tpl->tpl_vars['intTotalOnline']->value;?>
 user(s)</strong>
	</div>
</td>
</tr>
<tr>
<td style="padding:0px 10px" width="100%" valign="top">
	
<!--Start Table-->

<table cellpadding="0" cellspacing="0" width="50%" border="0" class="girdtable">
<tr>
	<td class="gridheader" nowrap width="5%">#</td>
	<td class="gridheader" nowrap width="10%">UserId</td>
	<td class="gridheader" nowrap width="20%" align="center">IP</td>
	<td class="gridheader" nowrap width="20%" align="center">At time</td>
	<td class="gridheader1" nowrap width="5%">Logged In?</td>
</tr>
<?php
$__section_id_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['arrListSession']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_id_0_total = $__section_id_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_id'] = new Smarty_Variable(array());
if ($__section_id_0_total !== 0) {
for ($__section_id_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_id']->value['index'] = 0; $__section_id_0_iteration <= $__section_id_0_total; $__section_id_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_id']->value['index']++){
$_smarty_tpl->tpl_vars['__smarty_section_id']->value['rownum'] = $__section_id_0_iteration;
$_smarty_tpl->tpl_vars['__smarty_section_id']->value['last'] = ($__section_id_0_iteration === $__section_id_0_total);
if ((isset($_smarty_tpl->tpl_vars['__smarty_section_id']->value['last']) ? $_smarty_tpl->tpl_vars['__smarty_section_id']->value['last'] : null)) {?>
	<?php $_smarty_tpl->_assignInScope('class1', "gridrow2");?>
	<?php $_smarty_tpl->_assignInScope('class2', "gridrow3");
} else { ?>
	<?php $_smarty_tpl->_assignInScope('class1', "gridrow");?>
	<?php $_smarty_tpl->_assignInScope('class2', "gridrow1");
}?>
<tr>
	<td align="center" class="<?php echo $_smarty_tpl->tpl_vars['class1']->value;?>
"><?php echo (isset($_smarty_tpl->tpl_vars['__smarty_section_id']->value['rownum']) ? $_smarty_tpl->tpl_vars['__smarty_section_id']->value['rownum'] : null);?>
</td>
	<td align="center" class="<?php echo $_smarty_tpl->tpl_vars['class1']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['arrListSession']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_id']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_id']->value['index'] : null)]['user_id'];?>
&nbsp;</td>
	<td align="center" class="<?php echo $_smarty_tpl->tpl_vars['class1']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['arrListSession']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_id']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_id']->value['index'] : null)]['ip_address'];?>
</td>
	<td align="center" class="<?php echo $_smarty_tpl->tpl_vars['class1']->value;?>
"><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['arrListSession']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_id']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_id']->value['index'] : null)]['running_time'],"%H:%M:%S %d/%m/%Y");?>
</td>
	<td align="center" class="<?php echo $_smarty_tpl->tpl_vars['class2']->value;?>
"><?php if ($_smarty_tpl->tpl_vars['arrListSession']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_id']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_id']->value['index'] : null)]['loggedin'] == 0) {?>No<?php } else { ?>Yes<?php }?></td>
</tr>
<?php
}
}
?>
</table>

<!--End Table-->	
	
</td>
</tr>
<tr>
<td  style="padding-left:10px;padding-right:10px">
	
</td>
</tr>
</table>
</form>
<?php }
}
