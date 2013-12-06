<?php
?>
elgg.provide("elgg.plugin_manager");

elgg.plugin_manager.init = function() {

	// category filtering
	$(".plugin-manager-categories a").live('click', function(event) {
		// remove selected state from all buttons
		$(".plugin-manager-categories li").removeClass("elgg-state-selected");
	
		// show plugins with the selected category
		$(".elgg-plugin").hide();
		$(".elgg-plugin-category-" + $(this).attr("rel")).show();
		$(this).parent().addClass("elgg-state-selected");
	});
	
	// details selection
	$(".plugin-manager-details-container > ul >li").live('click', function(event) {
		// remove selected state from all buttons
		$(".plugin-manager-details-container > ul > li").removeClass("elgg-state-selected");
		
		$(".plugin-manager-details-container > div > div").hide();
		$(".plugin-manager-details-container ." + $(this).attr("rel")).show();
		
		$(this).addClass("elgg-state-selected");
	});
	
	// screenshots
	$(".plugin-manager-details-screenshots .elgg-plugin-screenshot").live({
		mouseenter: function() {
			$(this).parent().find(".elgg-plugin-screenshot").removeClass("elgg-state-selected");
			$(this).addClass("elgg-state-selected");
			
			$(".plugin-manager-details-screenshots > div > img").hide();
			$(".plugin-manager-details-screenshots > div > img[rel='" + $(this).attr("rel") + "']").show();
		}
	});
	
	
};

// register init hook
elgg.register_hook_handler("init", "system", elgg.plugin_manager.init);
