<?php
/* Smarty version 3.1.32, created on 2021-06-26 09:28:18
  from '/var/www/koseionline.vn/data/www/koseionline.vn/admin/templates/accessstats/act_default.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_60d690c2497139_07133564',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd9ef406b1dd49968d44ca2c1efe24779341c0cc1' => 
    array (
      0 => '/var/www/koseionline.vn/data/www/koseionline.vn/admin/templates/accessstats/act_default.html',
      1 => 1616483390,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60d690c2497139_07133564 (Smarty_Internal_Template $_smarty_tpl) {
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
	<strong><?php echo $_smarty_tpl->tpl_vars['core']->value->getLang("AccessStatstics");?>
</strong>
	</div>
</td>
</tr>
<tr>
<td style="padding:0px 10px" width="100%" valign="top">
	
	
<!--Start Table-->
<?php echo '<script'; ?>
><?php echo $_smarty_tpl->tpl_vars['regdateHtml']->value[0];
echo '</script'; ?>
>

<table cellpadding="5" cellspacing="1"  class="girdtable" width="400">
<tr>
	<td class="gridrow"><?php echo $_smarty_tpl->tpl_vars['core']->value->getLang("Total_visitor");?>
:</td>
	<td style="color:red" class="gridrow1"><strong><?php echo $_smarty_tpl->tpl_vars['aStats']->value['total_visitor'];?>
</strong></td>
</tr>
<tr>
	<td class="gridrow"><?php echo $_smarty_tpl->tpl_vars['core']->value->getLang("Max_access");?>
:</td>
	<td class="gridrow1"><font color="red"><strong><?php echo $_smarty_tpl->tpl_vars['aStats']->value['max_online_number'];?>
</strong></font></td>
</tr>
<tr>
	<td align="right" class="gridrow"><?php echo $_smarty_tpl->tpl_vars['core']->value->getLang("at_time");?>
</td>
	<td class="gridrow1"><font color="red"><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['aStats']->value['max_online_day'],"%m/%d/%Y %Hh:%M");?>
</font></td>
</tr>
<tr>
	<td class="gridrow2"><?php echo $_smarty_tpl->tpl_vars['core']->value->getLang("Total_Online");?>
:</td>
	<td class="gridrow3"><font color="red"><strong><?php echo $_smarty_tpl->tpl_vars['intTotalOnline']->value;?>
</strong></font>&nbsp;&nbsp;[<a href="?mod=<?php echo $_smarty_tpl->tpl_vars['mod']->value;?>
&act=viewonline"><?php echo $_smarty_tpl->tpl_vars['core']->value->getLang("Detail");?>
</a>]</td>
</tr>
</table>
<br>
<table cellpadding="5" cellspacing="0" class="smallgrey1" width="<?php echo $_smarty_tpl->tpl_vars['tblwidth']->value;?>
" style="display:none">
<tr>
	<td align="left">
	<?php echo $_smarty_tpl->tpl_vars['regdateHtml']->value[1];?>

	<input type="submit" name="searchBtn" value="<<< View by day " class="inputfield">
	</td>
</tr>
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
