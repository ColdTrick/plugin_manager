<?php
?>
//<script>
elgg.provide("elgg.plugin_manager");

elgg.plugin_manager.init = function() {

	// category filtering
	$(document).on('click', '.plugin-manager-categories a', function(event) {
		// remove selected state from all buttons
		$(".plugin-manager-categories li").removeClass("elgg-state-selected");
	
		// show plugins with the selected category
		$(".elgg-plugin").hide();
		$(".elgg-plugin-category-" + $(this).attr("rel")).show();
		$(this).parent().addClass("elgg-state-selected");
	});
	
	// details selection
	$(document).on('click', '.plugin-manager-details-container > ul > li', function(event) {
		// remove selected state from all buttons
		$(".plugin-manager-details-container > ul > li").removeClass("elgg-state-selected");
		
		$(".plugin-manager-details-container > div > div").hide();
		$(".plugin-manager-details-container ." + $(this).attr("rel")).show();
		
		$(this).addClass("elgg-state-selected");
	});
	
	// screenshots
	$(document).on('mouseenter', '.plugin-manager-details-screenshots .elgg-plugin-screenshot', function() {
		$(this).parent().find(".elgg-plugin-screenshot").removeClass("elgg-state-selected");
		$(this).addClass("elgg-state-selected");
		
		$(".plugin-manager-details-screenshots > div > img").hide();
		$(".plugin-manager-details-screenshots > div > img[rel='" + $(this).attr("rel") + "']").show();
	});
};

// register init hook
elgg.register_hook_handler("init", "system", elgg.plugin_manager.init);
