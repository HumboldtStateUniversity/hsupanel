<?php

	# loading web fonts and external css

	function hsupanel_preprocess_html(&$variables) {
		drupal_add_css('https://fonts.googleapis.com/css?family=Source+Sans+Pro', array('type' => 'external'));
		drupal_add_css('https://fonts.googleapis.com/css?family=Belgrano', array('type' => 'external'));
	}
	
	# menu tree style navigation
	
	function hsupanel_preprocess_page(&$variables) {
	$main_menu_tree = menu_tree_all_data('main-menu', $link = NULL, $max_depth = 2);
		$variables['main_menu_expanded'] = menu_tree_output($main_menu_tree);
	}			
	

