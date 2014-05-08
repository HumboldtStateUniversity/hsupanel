<?php

	function hsupanel_preprocess_html(&$variables) {

		/**
		 * loading web fonts and external css
		 */
		drupal_add_css('//fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,700', array('type' => 'external'));
		drupal_add_css('//fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic', array('type' => 'external'));

	}
	
	
	function hsupanel_preprocess_page(&$variables) {

		/**
		 * menu tree style navigation
		 */
		# $main_menu_tree = menu_tree_all_data('main-menu', $link = NULL, $max_depth = 2);
		# $variables['main_menu_expanded'] = menu_tree_output($main_menu_tree);



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



		/**
		 * social media links
		 */

	  $social_links = array();

	  if (theme_get_setting('facebook_link')) {
	    $facebook_link = "http://www.facebook.com/" . theme_get_setting('facebook_link');
	    $social_links[] = l('Facebook', $facebook_link, array('attributes' => array('class' => array('facebook-link'))));
	  }

	  if (theme_get_setting('twitter_link')) {
	    $twitter_link = "http://twitter.com/" . theme_get_setting('twitter_link');
	    $social_links[] = l('Twitter', $twitter_link, array('attributes' => array('class' => array('twitter-link'))));
	  }

	  if (theme_get_setting('instagram_link')) {
	    $instagram_link = "http://instagram.com/" . theme_get_setting('instagram_link');
	    $social_links[] = l('Instagram', $instagram_link, array('attributes' => array('class' => array('instagram-link'))));
	  }

	  if (theme_get_setting('youtube_link')) {
	    $youtube_link = "http://www.youtube.com/user/" . theme_get_setting('youtube_link');
	    $social_links[] = l('YouTube', $youtube_link, array('attributes' => array('class' => array('youtube-link'))));
	  }

	  if (theme_get_setting('flickr_link')) {
	    $flickr_link = "http://www.flickr.com/photos/" . theme_get_setting('flickr_link');
	    $social_links[] = l('Flickr', $flickr_link, array('attributes' => array('class' => array('flickr-link'))));
	  }

	  $variables['include_social'] = theme_get_setting('include_social_media') ? TRUE : FALSE;

	  $variables['social_links'] = theme('item_list', array('items' => $social_links));

	}

	/**
	 * Implements theme_menu_tree().
	 */
	function hsupanel_menu_tree($variables) {
	  return '<ul class="menu clearfix">' . $variables['tree'] . '</ul>';
	}		
	

