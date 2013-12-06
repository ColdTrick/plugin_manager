<?php
?>
.elgg-plugin {
	padding: 0 5px;
	margin: 0;
	
	border-width: 1px;
	border-color: #CCC;
}

.elgg-plugin:hover {
	border-color: #999;
}

.elgg-plugin .elgg-head {
	white-space: nowrap;
}

.elgg-plugin.elgg-state-inactive {
	background: #EEE;
}

.elgg-plugin-dependencies th {
	white-space: nowrap;
}

.elgg-plugin-screenshot img {
	width: 50px;
	height: 50px;
}

.elgg-plugin-screenshot:hover img,
.elgg-plugin-screenshot.elgg-state-selected img {
	border-color: #333333;
	cursor: pointer;
}

.plugin-manager-categories li {
	font-weight: normal;
	font-size: 1em;
	margin: 0 !important;
}

.plugin-manager-list-description {
	display: inline-block;
	color: #999;
}

.elgg-state-active .plugin-manager-list-reordering {
	background: white;
}

.elgg-state-inactive .plugin-manager-list-reordering {
	background: #EEE;
}

.elgg-state-cannot-activate .plugin-manager-list-reordering {
	background: #FBEDB5;
}

.elgg-plugin.elgg-state-cannot-activate {
	background: #FBEDB5;
}

.plugin-manager-list-reordering {
	float: right;
	display: none;
	position: relative;
}
.elgg-plugin:hover .plugin-manager-list-reordering {
	display: block;
}

.plugin-manager-list-reordering li {
	float:left;
	margin-left: 5px;
}

.plugin-manager-icon {
	background: transparent url(<?php echo elgg_get_site_url(); ?>_graphics/elgg_sprites.png) no-repeat left;
	width: 16px;
	height: 16px;
	margin: 0 2px;
	
	display: inline-block;
}

.plugin-manager-icon-deactivate {
	background-position: 0 -126px;
}
.plugin-manager-icon-deactivate:hover {
	background-position: 0 -144px;
}

.plugin-manager-icon-activate {
	background-position: 0 -144px;
}
.plugin-manager-icon-activate:hover {
	background-position: 0 -126px;
}

.plugin-manager-icon-cannot-activate {
	background-position: 0 -54px;
}

.elgg-module-plugin-details .elgg-plugin {
	border: none;
	margin: 0;
	padding: 0;
}

.elgg-module-plugin-details {
	width: 700px;
}

.elgg-module-plugin-details .elgg-head h3 {
	background: #EEE;
    color: #666666;
    font-size: 40px;
    height: 45px;
    line-height: 45px;
    overflow: hidden;
    padding-left: 10px;
}

.elgg-module-plugin-details .elgg-body {
	border: 5px solid #EEE;
	padding: 10px;
	height: 500px;
}

.plugin-manager-details-categories {
	border-bottom: 1px dotted #EEE;
	padding-bottom: 5px;
}

.plugin-manager-details-container {
	margin: 10px 0;
}

.plugin-manager-details-container > ul {
	float: left;
    width: 160px;
}

.plugin-manager-details-container > ul > li {
	text-align: right;
	padding: 7px 10px 7px 5px;
	margin-bottom: 5px;
	
	-webkit-border-radius: 5px 0 0 5px;
	-moz-border-radius: 5px 0 0 5px;
	border-radius: 5px 0 0 5px;
}

.plugin-manager-details-container > ul > li:hover,
.plugin-manager-details-container > ul > li.elgg-state-selected {
	background: #EEE;
}

.plugin-manager-details-container > div {
	border: 2px solid #EEE;
    float: left;
    min-height: 450px;
    width: 495px;
    padding: 5px;
}

.plugin-manager-details-screenshots > ul {
	text-align: center;
}

.plugin-manager-details-screenshots > div {
	text-align: center;
}

.plugin-manager-details-screenshots > div > img {
	max-height: 400px;
	max-width: 480px;
}

.plugin-manager-details-screenshots > div > img.elgg-state-selected {
	display: inline-block;
}