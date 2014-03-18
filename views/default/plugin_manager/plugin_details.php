<?php

$guid = get_input("guid");

if (!$guid) {
	return;
}

$plugin = get_entity($guid);
if (!elgg_instanceof($plugin)) {
	return;
}

$active = $plugin->isActive();
$can_activate = $plugin->canActivate();

// always let them deactivate
$options = array(
	'is_action' => true,
	'is_trusted' => true,
);

if ($active) {
	$classes[] = 'elgg-state-active';
	$action = 'deactivate';
	$options['text'] = "<span title='" . elgg_echo('admin:plugins:deactivate') . "' class='plugin-manager-icon plugin-manager-icon-deactivate'></span>";

	if (!$can_activate) {
		$classes[] = 'elgg-state-active';
		$options['class'] = 'elgg-button elgg-state-warning';
	}
} elseif ($can_activate) {
	$classes[] = 'elgg-state-inactive';
	$action = 'activate';
	$options['text'] = "<span title='" . elgg_echo('admin:plugins:activate') . "' class='plugin-manager-icon plugin-manager-icon-activate'></span>";

} else {
	$classes[] = 'elgg-state-inactive';
	$action = '';
	$options['text'] = elgg_echo('admin:plugins:cannot_activate');
	$options['text'] = "<span title='" . elgg_echo('admin:plugins:cannot_activate') . "' class='plugin-manager-icon plugin-manager-icon-cannot-activate'></span>";

	$options['disabled'] = 'disabled';
}

if ($action) {
	$url = elgg_http_add_url_query_elements($actions_base . $action, array(
		'plugin_guids[]' => $plugin->guid
	));

	$options['href'] = $url;
}

$action_button = elgg_view('output/url', $options);

$action_button = elgg_trigger_plugin_hook("action_button", "plugin", array("entity" => $plugin), $action_button);

$categories = $plugin->getManifest()->getCategories();
$categories_html = '';
if ($categories) {
	foreach ($categories as $category) {
		$friendly_category = htmlspecialchars(ElggPluginManifest::getFriendlyCategory($category));
		$categories_html .= "<li class=\"elgg-plugin-category prm\">$friendly_category</li>";
	}
}

$screenshots_menu = '';
$screenshots_body = '';
$screenshots = $plugin->getManifest()->getScreenshots();
if ($screenshots) {
	$base_url = elgg_get_plugins_path() . $plugin->getID() . '/';
	foreach ($screenshots as $key => $screenshot) {
		
		$state = "";
		$rel = "plugin-manager-details-screenshot-" . $key;
		if ($key == 0) {
			$state = " elgg-state-selected";
		}
		
		$desc = elgg_echo($screenshot['description']);
		$alt = htmlentities($desc, ENT_QUOTES, 'UTF-8');
		$screenshot_full = "{$vars['url']}admin_plugin_screenshot/{$plugin->getID()}/full/{$screenshot['path']}";
		$screenshot_src = "{$vars['url']}admin_plugin_screenshot/{$plugin->getID()}/thumbnail/{$screenshot['path']}";

		$screenshots_menu .= "<li rel='$rel' class=\"elgg-plugin-screenshot pas $state\" title='" . $alt . "'><img src=\"$screenshot_src\" alt=\"$alt\"></li>";
		
		$screenshots_body .= "<img rel='$rel' class='hidden $state' src=\"$screenshot_full\" alt=\"$alt\" title='" . $alt . "'>";
	}
	
	$screenshots_menu = "<ul>" . $screenshots_menu . "</ul>";
	$screenshots_body = "<div>" . $screenshots_body . "</div>";
}

$info_html = "<table class='elgg-table'>";
$info_html .= "<tr><td>" . elgg_echo('admin:plugins:label:name') . "</td><td>" . elgg_view('output/text', array('value' => $plugin->getManifest()->getName())) . "</td></tr>";
$info_html .= "<tr><td>" . elgg_echo('admin:plugins:label:id') . "</td><td>" . elgg_view('output/text', array('value' => $plugin->getID())) . "</td></tr>";
$info_html .= "<tr><td>" . elgg_echo('admin:plugins:label:version') . "</td><td>" . htmlspecialchars($plugin->getManifest()->getVersion()) . "</td></tr>";
$info_html .= "<tr><td>" . elgg_echo('admin:plugins:label:author') . "</td><td>" . elgg_view('output/text', array('value' => $plugin->getManifest()->getAuthor())) . "</td></tr>";
$info_html .= "<tr><td>" . elgg_echo('admin:plugins:label:website') . "</td><td>" . elgg_view('output/url', array(
		'href' => $plugin->getManifest()->getWebsite(),
		'text' => $plugin->getManifest()->getWebsite(),
		'is_trusted' => true,
)) . "</td></tr>";

$info_html .= "<tr><td>" . elgg_echo('admin:plugins:label:copyright') . "</td><td>" . elgg_view('output/text', array('value' => $plugin->getManifest()->getCopyright())) . "</td></tr>";
$info_html .= "<tr><td>" . elgg_echo('admin:plugins:label:license') . "</td><td>" . elgg_view('output/text', array('value' => $plugin->getManifest()->getLicense())) . "</td></tr>";
$info_html .= "<tr><td>" . elgg_echo('admin:plugins:label:location') . "</td><td>" . htmlspecialchars($plugin->getPath()) . "</td></tr>";

$info_html .= "</table>";

$extra_info = elgg_echo("admin:plugins:info:" . $plugin->getID());
if ($extra_info !== ("admin:plugins:info:" . $plugin->getID())) {
	$info_html .= "<div class='mtm'>" . $extra_info . "</div>";
}

$resources = array(
	'repository' => $plugin->getManifest()->getRepositoryURL(),
	'bugtracker' => $plugin->getManifest()->getBugTrackerURL(),
	'donate' => $plugin->getManifest()->getDonationsPageURL(),
);

$resources_html = "";
foreach ($resources as $id => $href) {
	if ($href) {
		$resources_html .= "<li>";
		$resources_html .= elgg_view('output/url', array(
				'href' => $href,
				'text' => elgg_echo("admin:plugins:label:$id"),
				'is_trusted' => true,
		));
		$resources_html .= "</li>";
	}
}

if (!empty($resources_html)) {
	$resources_html = "<ul>" . $resources_html . "</ul>";
}

// show links to text files
$files = $plugin->getAvailableTextFiles();

$files_html = '';
if ($files) {
	$files_html = '<ul>';
	foreach ($files as $file => $path) {
		$url = 'admin_plugin_text_file/' . $plugin->getID() . "/$file";
		$link = elgg_view('output/url', array(
				'text' => $file,
				'href' => $url,
				'is_trusted' => true,
		));
		$files_html .= "<li>$link</li>";

	}
	$files_html .= '</ul>';
}

$body = "<div class='elgg-plugin'>";

if ($categories_html) {
	$body .= "<div class='plugin-manager-details-categories'>";
	$body .= elgg_echo('admin:plugins:label:categories') . ": <ul class=\"elgg-plugin-categories\">$categories_html</ul>";
	$body .= "</div>";
}

$body .= "<div class='plugin-manager-details-container clearfix'>";

$body .= "<ul>";
if ($can_activate) {
	$body .= "<li rel='plugin-manager-details-info' class='elgg-state-selected'>";
} else {
	$body .= "<li rel='plugin-manager-details-info'>";
}

$body .= elgg_echo("plugin_manager:plugins:label:info") . "</li>";

if ($resources_html) {
	$body .= "<li rel='plugin-manager-details-resources'>" . elgg_echo("plugin_manager:plugins:label:resources") . "</li>";
}

if ($files_html) {
	$body .= "<li rel='plugin-manager-details-files'>" . elgg_echo("plugin_manager:plugins:label:files") . "</li>";
}

if ($screenshots) {
	$body .= "<li rel='plugin-manager-details-screenshots'>" . elgg_echo("plugin_manager:plugins:label:screenshots") . "</li>";
}

if ($can_activate) {
	$body .= "<li rel='plugin-manager-details-dependencies'>";
} else {
	$body .= "<li rel='plugin-manager-details-dependencies' class='elgg-state-selected'>";
}
$body .= elgg_echo("admin:plugins:label:dependencies") . "</li>";
$body .= "</ul>";

$body .= "<div>";

// info
if ($can_activate) {
	$body .= "<div class='plugin-manager-details-info'>";
} else {
	$body .= "<div class='plugin-manager-details-info hidden'>";
}
$body .= $info_html;
$body .= "</div>";

// resources
if ($resources_html) {
	$body .= "<div class='plugin-manager-details-resources hidden'>";
	$body .= $resources_html;
	$body .= "</div>";
}

// files
if ($files_html) {
	$body .= "<div class='plugin-manager-details-files hidden'>";
	$body .= $files_html;
	$body .= "</div>";
}

// screenshots
if ($screenshots) {
	$body .= "<div class='plugin-manager-details-screenshots hidden'>";
	$body .= $screenshots_menu;
	$body .= $screenshots_body;
	$body .= "</div>";
}

// dependencies
if ($can_activate) {
	$body .= "<div class='plugin-manager-details-dependencies hidden'>";
} else {
	$body .= "<div class='plugin-manager-details-dependencies'>";
}
$body .= elgg_view('object/plugin/elements/dependencies', array('plugin' => $plugin));
$body .= "</div>";

$body .= "</div>";

$body .= "</div>";

$body .= "</div>";

echo elgg_view_module("plugin-details", $plugin->getManifest()->getName(), $body);
