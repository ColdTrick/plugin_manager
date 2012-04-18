<?php
	function plugin_manager_init(){
		extend_view("css", "plugin_manager/css");
		extend_view("js/initialise_elgg", "plugin_manager/js");
	}
	
	register_elgg_event_handler('init','system','plugin_manager_init');
		
?>