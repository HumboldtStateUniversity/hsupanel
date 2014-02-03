<?php

	# loading web fonts and external css

	function hsupanel_preprocess_html(&$variables) {
		drupal_add_css('https://fonts.googleapis.com/css?family=Open+Sans', array('type' => 'external'));
		drupal_add_css('https://fonts.googleapis.com/css?family=Droid+Serif', array('type' => 'external'));

	}
	
	
	function hsupanel_preprocess_page(&$variables) {


		# menu tree style navigation
		$main_menu_tree = menu_tree_all_data('main-menu', $link = NULL, $max_depth = 2);
		$variables['main_menu_expanded'] = menu_tree_output($main_menu_tree);

		/**
		 * add css for header background image
		 */
	  $options = array(
	    'type'  => 'inline',
	    'group' => CSS_THEME,
	  );

	  //Get theme setting for header image
	  $image_file = theme_get_setting('hsupanel_header_image');

	  //Build full path to image
	  $image_path = base_path() . drupal_get_path('theme', 'hsupanel') . '/img';
	  $image_path .= "/$image_file";

	  //Add selected header image as css background
	  $css = ".header-container {background:url('$image_path') no-repeat center top;}";
	  drupal_add_css($css, $options);	

	}

	/**
	 * Implements theme_menu_tree().
	 */
	function hsupanel_menu_tree($variables) {
	  return '<ul class="menu clearfix">' . $variables['tree'] . '</ul>';
	}		
	

