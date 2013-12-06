<?php
// var_dump($vars["category"]);
// var_dump($vars["category_options"]);

$body = "<ul class='plugin-manager-categories elgg-admin-sidebar-menu clearfix'>";
foreach ($vars["category_options"] as $key => $category) {
	if ($key) {
		$key = preg_replace('/[^a-z0-9-]/i', '-', $key);
		$body .= "<li class='elgg-button float mas'><a href='#' rel='" . $key . "'>" . $category . "</a></li>";
	}
}
$body .= "</ul>";

echo elgg_view_module("", elgg_echo("filter"), $body);