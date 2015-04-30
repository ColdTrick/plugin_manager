<?php

$categories = elgg_extract('category_options', $vars);
if (empty($categories)) {
	return;
}

$body = "<ul class='plugin-manager-categories elgg-admin-sidebar-menu'>";

foreach ($categories as $key => $category) {
	if (empty($key)) {
		continue;
	}
	
	$key = preg_replace('/[^a-z0-9-]/i', '-', $key);
	$link = elgg_view('output/url', array(
		'text' => $category,
		'href' => '#',
		'rel' => $key
	));
	
	$body .= elgg_format_element('li', array(), $link);
}
$body .= "</ul>";

echo elgg_view_module("", elgg_echo("filter"), $body);
