<?php
/* Smarty version 3.1.32, created on 2023-10-04 16:58:42
  from '/var/www/koseionline/data/www/koseionline.vn/admin/templates/combo/act_tree.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_651d375233b2e1_70791664',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4b0ee2d6d001598060233c7ead95a51d78f0e4d6' => 
    array (
      0 => '/var/www/koseionline/data/www/koseionline.vn/admin/templates/combo/act_tree.html',
      1 => 1670384083,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_651d375233b2e1_70791664 (Smarty_Internal_Template $_smarty_tpl) {
?><link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['ADMIN_URL_CSS']->value;?>
/treeview.css" type="text/css">
<div class="tree">
	<ul>
		<?php
$__section_i_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['arrCatTree']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_i_0_total = $__section_i_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_i'] = new Smarty_Variable(array());
if ($__section_i_0_total !== 0) {
for ($__section_i_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] = 0; $__section_i_0_iteration <= $__section_i_0_total; $__section_i_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']++){
?>
		<li>
			<a href="?mod=<?php echo $_smarty_tpl->tpl_vars['mod']->value;?>
&act=add&cat_id=<?php echo $_smarty_tpl->tpl_vars['arrCatTree']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['cat_id'];?>
&<?php echo $_smarty_tpl->tpl_vars['returnExp']->value;?>
" title="Click để sửa"><strong><?php echo $_smarty_tpl->tpl_vars['arrCatTree']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['name'];?>
</strong></a>
			<?php $_smarty_tpl->_assignInScope('arrCatTree1', $_smarty_tpl->tpl_vars['arrCatTree']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)]['subcat']);?>
			<?php if ($_smarty_tpl->tpl_vars['core']->value->callfunc('is_array',$_smarty_tpl->tpl_vars['arrCatTree1']->value) == 1) {?>
			<ul>
				<?php
$__section_i1_1_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['arrCatTree1']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_i1_1_total = $__section_i1_1_loop;
$_smarty_tpl->tpl_vars['__smarty_section_i1'] = new Smarty_Variable(array());
if ($__section_i1_1_total !== 0) {
for ($__section_i1_1_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_i1']->value['index'] = 0; $__section_i1_1_iteration <= $__section_i1_1_total; $__section_i1_1_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_i1']->value['index']++){
?>				
				<li>
					<a href="?mod=<?php echo $_smarty_tpl->tpl_vars['mod']->value;?>
&act=add&cat_id=<?php echo $_smarty_tpl->tpl_vars['arrCatTree1']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i1']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i1']->value['index'] : null)]['cat_id'];?>
&<?php echo $_smarty_tpl->tpl_vars['returnExp']->value;?>
" title="Click để sửa"><?php echo $_smarty_tpl->tpl_vars['arrCatTree1']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i1']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i1']->value['index'] : null)]['name'];?>
</a>
					<?php $_smarty_tpl->_assignInScope('arrCatTree2', $_smarty_tpl->tpl_vars['arrCatTree1']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i1']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i1']->value['index'] : null)]['subcat']);?>
					<?php if ($_smarty_tpl->tpl_vars['core']->value->callfunc('is_array',$_smarty_tpl->tpl_vars['arrCatTree2']->value) == 1) {?>
					<ul>
					<?php
$__section_i2_2_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['arrCatTree2']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_i2_2_total = $__section_i2_2_loop;
$_smarty_tpl->tpl_vars['__smarty_section_i2'] = new Smarty_Variable(array());
if ($__section_i2_2_total !== 0) {
for ($__section_i2_2_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_i2']->value['index'] = 0; $__section_i2_2_iteration <= $__section_i2_2_total; $__section_i2_2_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_i2']->value['index']++){
?>
						<li>
							<a href="?mod=<?php echo $_smarty_tpl->tpl_vars['mod']->value;?>
&act=add&cat_id=<?php echo $_smarty_tpl->tpl_vars['arrCatTree2']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i2']->value['index'] : null)]['cat_id'];?>
&<?php echo $_smarty_tpl->tpl_vars['returnExp']->value;?>
" title="Click để sửa"><?php echo $_smarty_tpl->tpl_vars['arrCatTree2']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i2']->value['index'] : null)]['name'];?>
</a>
							<?php $_smarty_tpl->_assignInScope('arrCatTree3', $_smarty_tpl->tpl_vars['arrCatTree2']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i2']->value['index'] : null)]['subcat']);?>
							<?php if ($_smarty_tpl->tpl_vars['core']->value->callfunc('is_array',$_smarty_tpl->tpl_vars['arrCatTree3']->value) == 1) {?>
							<ul>
								<?php
$__section_i3_3_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['arrCatTree3']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_i3_3_total = $__section_i3_3_loop;
$_smarty_tpl->tpl_vars['__smarty_section_i3'] = new Smarty_Variable(array());
if ($__section_i3_3_total !== 0) {
for ($__section_i3_3_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_i3']->value['index'] = 0; $__section_i3_3_iteration <= $__section_i3_3_total; $__section_i3_3_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_i3']->value['index']++){
?>
								<li>
									<a href="?mod=<?php echo $_smarty_tpl->tpl_vars['mod']->value;?>
&act=add&cat_id=<?php echo $_smarty_tpl->tpl_vars['arrCatTree3']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i3']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i3']->value['index'] : null)]['cat_id'];?>
&<?php echo $_smarty_tpl->tpl_vars['returnExp']->value;?>
" title="Click để sửa"><?php echo $_smarty_tpl->tpl_vars['arrCatTree3']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_i3']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i3']->value['index'] : null)]['name'];?>
</a>
								</li>
								<?php
}
}
?>
							</ul>
							<?php }?>
						</li>					
					<?php
}
}
?>
					</ul>
					<?php }?>
				</li>
				<?php
}
}
?>
			</ul>	
			<?php }?>		
		</li>
		<?php
}
}
?>
	</ul>
</div><?php }
}
