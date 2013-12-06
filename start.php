<?php

// register default Elgg events
elgg_register_event_handler("init", "system", "plugin_manager_init");

function plugin_manager_init(){
	elgg_extend_view("css/admin", "css/plugin_manager/admin");
	elgg_extend_view("js/admin", "js/plugin_manager/admin");
	
	elgg_register_ajax_view('plugin_manager/plugin_details');
}
