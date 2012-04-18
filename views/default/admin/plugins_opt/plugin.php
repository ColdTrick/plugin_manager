<?php
	$plugin = $vars['plugin'];
	$details = $vars['details'];
	
	$active = $details['active'];
	$manifest = $details['manifest'];
	
	// Check elgg version if available
	$version_check_valid = false;
	if ($manifest['elgg_version']) {
		$version_check_valid = check_plugin_compatibility($manifest['elgg_version']);
	}
	
	$ts = time();
	$token = generate_action_token($ts);
	?>
	<div class="plugin_details <?php if ($active) echo "active"; else echo "not-active" ?>">
		<span class="plugin_reordering">
			
		<?php
			if($manifest && !empty($manifest['version'])){
				echo "<span class='manifest_version'>" . elgg_echo('admin:plugins:label:version') . ": ". $manifest['version'] . "</span>";
				
			}
			if ($vars['order'] > 10) {
		?>
			<a href="<?php echo $vars['url']; ?>action/admin/plugins/reorder?plugin=<?php echo $plugin; ?>&order=1&__elgg_token=<?php echo $token; ?>&__elgg_ts=<?php echo $ts; ?>">
				<span title="<?php echo elgg_echo("top"); ?>" class="plugin_manager_move_plugin move_top"></span>
			</a>				
			<a href="<?php echo $vars['url']; ?>action/admin/plugins/reorder?plugin=<?php echo $plugin; ?>&order=<?php echo $vars['order'] - 11; ?>&__elgg_token=<?php echo $token; ?>&__elgg_ts=<?php echo $ts; ?>">
				<span title="<?php echo elgg_echo("up"); ?>" class="plugin_manager_move_plugin move_up"></span>
			</a>
			
		<?php
			} else {
		?> 
			<span class="plugin_manager_move_plugin"></span>				
			<span class="plugin_manager_move_plugin"></span>
		<?php 	
			}
	
			if ($vars['order'] < $vars['maxorder']) {
		?>
			<a href="<?php echo $vars['url']; ?>action/admin/plugins/reorder?plugin=<?php echo $plugin; ?>&order=<?php echo $vars['order'] + 11; ?>&__elgg_token=<?php echo $token; ?>&__elgg_ts=<?php echo $ts; ?>">
				<span title="<?php echo elgg_echo("down"); ?>" class="plugin_manager_move_plugin move_down"></span>
			</a>
			<a href="<?php echo $vars['url']; ?>action/admin/plugins/reorder?plugin=<?php echo $plugin; ?>&order=<?php echo $vars['maxorder'] + 11; ?>&__elgg_token=<?php echo $token; ?>&__elgg_ts=<?php echo $ts; ?>">				
				<span title="<?php echo elgg_echo("bottom"); ?>" class="plugin_manager_move_plugin move_bottom"></span>
			</a>
			
		<?php
			} else {
		?> 
			<span class="plugin_manager_move_plugin"></span>				
			<span class="plugin_manager_move_plugin"></span>
		<?php 	
			}
		?>
		</span>
	<?php 
		if ($active) { 
			$checked = "checked='checked'";
			$link = $vars['url'] . "action/admin/plugins/disable?plugin=" . $plugin . "&__elgg_token=" . $token . "&__elgg_ts=" . $ts;
			$title = elgg_echo("disable");
		} else {
			$link = $vars['url'] . "action/admin/plugins/enable?plugin=" . $plugin . "&__elgg_token=" . $token . "&__elgg_ts=" . $ts;
			$title = elgg_echo("enable");
		} 
	?>
		<form method="post" action="<?php echo $link;?>">
			<input onclick="submit();" type="checkbox" <?php echo $checked; ?>" title="<?php echo $title; ?>">
		</form>

		<h3><?php echo $plugin; ?></h3>
	<?php  
		if(elgg_view("settings/{$plugin}/edit")) { 
			?>&nbsp<a class="pluginsettings_link">[<?php echo elgg_echo('settings'); ?>]</a><?php 
		} 
		if ($manifest) {
			?>&nbsp<a class="manifest_details"><?php echo elgg_echo("admin:plugins:label:moreinfo"); ?></a><?php 
		}
	
		if (elgg_view("settings/{$plugin}/edit")) { 
	?>
		<div class="pluginsettings">
				<div id="<?php echo $plugin; ?>_settings">
					<?php echo elgg_view("object/plugin", array('plugin' => $plugin, 'entity' => find_plugin_settings($plugin))) ?>
				</div>
		</div>
	<?php 
		} 
	?>
		<div class="manifest_file">
			
		<?php if ($manifest) { ?>
			<div class="plugin_description"><?php echo elgg_view('output/longtext',array('value' => $manifest['description'])); ?></div>
			<?php if ((!$version_check_valid) || (!isset($manifest['elgg_version']))) { ?>
			<div id="version_check">
				<?php
					if (!isset($manifest['elgg_version']))
						echo elgg_echo('admin:plugins:warning:elggversionunknown');
					else
						echo elgg_echo('admin:plugins:warning:elggtoolow');
				?>
			</div>
			<?php } ?>
			<div><?php echo elgg_echo('admin:plugins:label:version') . ": ". $manifest['version'] ?></div>
			<div><?php echo elgg_echo('admin:plugins:label:author') . ": ". $manifest['author'] ?></div>
			<div><?php echo elgg_echo('admin:plugins:label:copyright') . ": ". $manifest['copyright'] ?></div>
			<div><?php echo elgg_echo('admin:plugins:label:licence') . ": ". $manifest['licence'] . $manifest['license'] ?></div>
			<div><?php echo elgg_echo('admin:plugins:label:website') . ": "; ?><a href="<?php echo $manifest['website']; ?>"><?php echo $manifest['website']; ?></a></div>
		<?php } ?>
	
		</div>
	
	</div>