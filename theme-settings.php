<?php

/**
 * hsupanel Theme - theme-settings.php
 */

/**
 * Implements hook_form_system_theme_settings_alter().
 *
 * @param $form
 *   Nested array of form elements that comprise the form.
 * @param $form_state
 *   A keyed array containing the current state of the form.
 */
function hsupanel_form_system_theme_settings_alter(&$form, &$form_state, $form_id = NULL)  {
  // Work-around for a core bug affecting admin themes. See issue #943212.
  if (isset($form_id)) {
    return;
  }

  // Collapse fieldsets for standard theme settings
  $form['theme_settings']['#collapsible'] = TRUE;
  $form['theme_settings']['#collapsed'] = TRUE;
  $form['logo']['#collapsible'] = TRUE;
  $form['logo']['#collapsed'] = TRUE;
  $form['favicon']['#collapsible'] = TRUE;
  $form['favicon']['#collapsed'] = TRUE;
  $form['breadcrumb']['#collapsible'] = TRUE;
  $form['breadcrumb']['#collapsed'] = TRUE;
  $form['support']['#collapsible'] = TRUE;
  $form['support']['#collapsed'] = TRUE;
  $form['themedev']['#collapsible'] = TRUE;
  $form['themedev']['#collapsed'] = TRUE;

  // Create the form using Forms API: http://api.drupal.org/api/7
  $form['hsupanel_settings'] = array(
    "#type"  => "fieldset",
    "#title" => "hsupanel Settings",
    '#collapsible' => TRUE,
    '#collapsed' => FALSE,
  );

  // Manually set hsupanel header images - see below for alternate option
  $header_options = array(
    t('hsupanel Headers')  => array(
      'header-abstract.png'         => t('Abstract'),
      'header-aerial.png'           => t('Aerial'),
      'header-arch-detail-1.png'    => t('Architectural Details 1'),
      'header-arch-detail-2.png'    => t('Architectural Details 2'),
      'header-arch-detail-3.png'    => t('Architectural Details 3'),
      'header-arch-detail-4.png'    => t('Architectural Details 4'),
      'header-arch-detail-5.png'    => t('Architectural Details 5'),
      'header-arch-detail-6.png'    => t('Architectural Details 6'),
      'header-bas-relief-1.png'     => t('Bas Relief 1'),
      'header-bas-relief-2.png'     => t('Bas Relief 2'),
      'header-bas-relief-3.png'     => t('Bas Relief 3'),
      'header-campanile-1.png'      => t('Campanile 1'),
      'header-campanile-2.png'      => t('Campanile 2'),
      'header-campanile-3.png'      => t('Campanile 3'),
      'header-library.png'          => t('Campus Library'),
      'header-campus-path.png'      => t('Campus Path'),
      'header-campus-trees-1.png'   => t('Campus Trees 1'),
      'header-campus-trees-2.png'   => t('Campus Trees 2'),
      'header-campus-trees-3.png'   => t('Campus Trees 3'),
      'header-campus-trees-4.png'   => t('Campus Trees 4'),
      'header-campus-trees-5.png'   => t('Campus Trees 5'),
      'header-center-gradient.png'  => t('Center Gradient'),
      'header-hearst-mining.png'    => t('Hearst Mining'),
      'header-molecules.png'        => t('Molecules'),
      'header-mosaic.png'           => t('Mosaic'),
      'header-sathergate-1.png'     => t('Sather Gate 1'),
      'header-sathergate-2.png'     => t('Sather Gate 2'),
      'header-south-hall.png'       => t('South Hall'),
      'header-sproul.png'           => t('Sproul'),
      'header-students.png'         => t('Students'),
      'header-three-arches.png'     => t('Three Arches'),
    ),
  );

  /* Delete this line for alternate option to get available images in 'header-images' directory
  $header_options = hsupanel_get_available_images();
  //Or could change 'header-images' directory in hsupanel_get_available_images function
  //and merge with original $header_options:
  //$header_options = array_merge($header_options, hsupanel_get_available_images());
  //*/

  // Select Header Image
  $form['hsupanel_settings']['hsupanel_header_image'] = array(
    '#type'          => 'select',
    '#title'         => t('Header Image for hsupanel'),
    '#options'       => $header_options,
    '#description'   => t("Select the header image you would like to use."),
    '#default_value' => theme_get_setting('hsupanel_header_image'),
    '#ajax'          => array(
      'callback'     => 'hsupanel_image_preview_callback',
      'wrapper'      => 'header_image_div',
     ),
  );

  // Header Image Preview
  $form['hsupanel_settings']['hsupanel_header_image_preview'] = array(
    '#type'          => 'fieldset',
    '#title'         => t('Preview of Header Image for hsupanel'),
    'image'          => hsupanel_image_preview_initial(),
    '#collapsible'   => TRUE,
    '#collapsed'     => FALSE,
  );

  
  // Quick Links
  $form['hsupanel_settings']['quick_links'] = array(
    '#type' => 'fieldset',
    '#title' => t('Quick Links'),
    '#collapsible' => TRUE,
    '#collapsed' => FALSE,
    '#description'   => t('If you would like to include a Quick Links widget at the top of the page,
                           check the following box. You can then add blocks to this region via
                           the <a href="@href">Blocks configuration page</a>.',
                           array('@href' => '/admin/structure/block',)),
  );

  //Optional Quick Links widget
  $form['hsupanel_settings']['quick_links']['include_quick_links'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('Include Quick Links'),
    '#default_value' => theme_get_setting('include_quick_links'),
  );

  // Define the link for Quick Links without Javascript enabled
  $form['hsupanel_settings']['quick_links']['quicklinks_link'] = array(
    '#type' => 'textfield',
    '#title' => 'If Javascript is disabled, link to:',
    '#default_value' => theme_get_setting('quicklinks_link'),
    '#description'   => t('Enter the node you would like to link to if the user has Javascript disabled. Example: node/1'),
    '#states'        => array(
      'visible'      => array(
        // Display only when "Include Quick Links" is checked. See http://api.drupal.org/api/examples/form_example%21form_example_states.inc/function/form_example_states_form/7
        ':input[name="include_quick_links"]' => array('checked' => TRUE),
      ),
    ),
  );

  // Define the social media links
  $form['hsupanel_settings']['social_media'] = array(
    '#type' => 'fieldset',
    '#title' => t('Social Media Links in Footer'),
    '#collapsible' => TRUE,
    '#collapsed' => FALSE,
    '#description'   => t('If you would like to include links to your social media pages,
                           check the following box and then enter the appropriate information
                           in the optional fields below.'),
  );

  //Social media option
  $form['hsupanel_settings']['social_media']['include_social_media'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('Include Social Media Links'),
    '#default_value' => theme_get_setting('include_social_media'),
  );

  // Define the facebook link
  $form['hsupanel_settings']['social_media']['facebook_link'] = array(
    '#type' => 'textfield',
    '#title' => 'Facebook',
    '#default_value' => theme_get_setting('facebook_link'),
    '#description'   => t('Enter your Facebook username.'),
    '#states'        => array(
      'visible'      => array(
        // Display only when "Include Social Media Links" is checked. See http://api.drupal.org/api/examples/form_example%21form_example_states.inc/function/form_example_states_form/7
        ':input[name="include_social_media"]' => array('checked' => TRUE),
      ),
    ),
  );

  // Define the twitter link
  $form['hsupanel_settings']['social_media']['twitter_link'] = array(
    '#type' => 'textfield',
    '#title' => 'Twitter',
    '#default_value' => theme_get_setting('twitter_link'),
    '#description'   => t('Enter your Twitter username.'),
    '#states'        => array(
      'visible'      => array(
        // Display only when "Include Social Media Links" is checked. See http://api.drupal.org/api/examples/form_example%21form_example_states.inc/function/form_example_states_form/7
        ':input[name="include_social_media"]' => array('checked' => TRUE),
      ),
    ),
  );

  // Define the linkedin link
  $form['hsupanel_settings']['social_media']['linkedin_link'] = array(
    '#type' => 'textfield',
    '#title' => 'LinkedIn',
    '#default_value' => theme_get_setting('linkedin_link'),
    '#description'   => t('Enter your LinkedIn URL. Example: http://www.linkedin.com/company/uc-hsupanel'),
    '#states'        => array(
      'visible'      => array(
        // Display only when "Include Social Media Links" is checked. See http://api.drupal.org/api/examples/form_example%21form_example_states.inc/function/form_example_states_form/7
        ':input[name="include_social_media"]' => array('checked' => TRUE),
      ),
    ),
  );

  // Define the foursquare link
  $form['hsupanel_settings']['social_media']['foursquare_link'] = array(
    '#type' => 'textfield',
    '#title' => 'Foursquare',
    '#default_value' => theme_get_setting('foursquare_link'),
    '#description'   => t('Enter your Foursquare URL. Example: https://foursquare.com/cal'),
    '#states'        => array(
      'visible'      => array(
        // Display only when "Include Social Media Links" is checked. See http://api.drupal.org/api/examples/form_example%21form_example_states.inc/function/form_example_states_form/7
        ':input[name="include_social_media"]' => array('checked' => TRUE),
      ),
    ),
  );

  // Define the youtube link
  $form['hsupanel_settings']['social_media']['youtube_link'] = array(
    '#type' => 'textfield',
    '#title' => 'YouTube',
    '#default_value' => theme_get_setting('youtube_link'),
    '#description'   => t('Enter your YouTube Username.'),
    '#states'        => array(
      'visible'      => array(
        // Display only when "Include Social Media Links" is checked. See http://api.drupal.org/api/examples/form_example%21form_example_states.inc/function/form_example_states_form/7
        ':input[name="include_social_media"]' => array('checked' => TRUE),
      ),
    ),
  );

  // Define the google+ link
  $form['hsupanel_settings']['social_media']['googleplus_link'] = array(
    '#type' => 'textfield',
    '#title' => 'Google+',
    '#default_value' => theme_get_setting('googleplus_link'),
    '#description'   => t('Enter your Google+ User ID Number.'),
    '#states'        => array(
      'visible'      => array(
        // Display only when "Include Social Media Links" is checked. See http://api.drupal.org/api/examples/form_example%21form_example_states.inc/function/form_example_states_form/7
        ':input[name="include_social_media"]' => array('checked' => TRUE),
      ),
    ),
  );

  // Define the google+ link
  $form['hsupanel_settings']['social_media']['flickr_link'] = array(
    '#type' => 'textfield',
    '#title' => 'Flickr',
    '#default_value' => theme_get_setting('flickr_link'),
    '#description'   => t('Enter your Flickr URL. Example: http://www.flickr.com/photos/hsupanellab'),
    '#states'        => array(
      'visible'      => array(
        // Display only when "Include Social Media Links" is checked. See http://api.drupal.org/api/examples/form_example%21form_example_states.inc/function/form_example_states_form/7
        ':input[name="include_social_media"]' => array('checked' => TRUE),
      ),
    ),
  );

  // Define the rss link
  $form['hsupanel_settings']['social_media']['rss_link'] = array(
    '#type' => 'textfield',
    '#title' => 'Rss',
    '#default_value' => theme_get_setting('rss_link'),
    '#description'   => t('Enter the full path to your primary RSS feed. Example: http://events.hsupanel.edu/index.php/rss/sn/pubaff/type/day/tab/all_events.html'),
    '#states'        => array(
      'visible'      => array(
        // Display only when "Include Social Media Links" is checked. See http://api.drupal.org/api/examples/form_example%21form_example_states.inc/function/form_example_states_form/7
        ':input[name="include_social_media"]' => array('checked' => TRUE),
      ),
    ),
  );

  //Optional AddThis widget
  $form['hsupanel_settings']['social_media']['sharing_addthis'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('Sharing and Bookmarking'),
    '#default_value' => theme_get_setting('sharing_addthis'),
    '#description'   => t('Check this box to include a <a href="@href"> sharing and bookmarking widget</a>.',
                        array('@href' => 'http://www.addthis.com/',)),
  );

  // Extended main menu
  $form['hsupanel_settings']['extended_menu'] = array(
    '#type' => 'fieldset',
    '#title' => t('Extended Main Menu'),
    '#collapsible' => TRUE,
    '#collapsed' => FALSE,
    '#description'   => t('This theme is designed to work with a limited number of main menu items (e.g., fewer than 6),
                           with words that are short and meaningful.
                           If you need to slightly extend the number of main menu items, check the following box.'),
  );

  //Optional Extended Main Menu Items
  $form['hsupanel_settings']['extended_menu']['extended_menu_items'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('Extend number of main menu items'),
    '#default_value' => theme_get_setting('extended_menu_items'),
  );

  // Extended Site Name
  $form['hsupanel_settings']['extended_sitename'] = array(
    '#type' => 'fieldset',
    '#title' => t('Extended Site Name'),
    '#collapsible' => TRUE,
    '#collapsed' => FALSE,
    '#description'   => t('If you are using a long Site Name (e.g., more than 35 characters), check the following box.'),
  );

  //Optional Extended Main Menu Items
  $form['hsupanel_settings']['extended_sitename']['long_sitename'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('Use a long site name'),
    '#default_value' => theme_get_setting('long_sitename'),
  );

  /**
   * Options for Open hsupanel
   */

  // Open hsupanel section
  $form['hsupanel_settings']['openhsupanel'] = array(
    '#type' => 'fieldset',
    '#title' => t('Open hsupanel'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
    '#description'   => t('This theme is designed to work with the Open hsupanel distribution.
                           For more information about Open hsupanel, contact <a href="@href">IST Drupal</a>.
                           Check the appropriate items below to apply standard styling.',
                           array('@href' => 'mailto:ist-drupal@lists.hsupanel.edu',)),
  );

  //Standard styling for News Archive view
  $form['hsupanel_settings']['openhsupanel']['openhsupanel_newsarchive'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('Add standard styling for News Archive view'),
    '#default_value' => theme_get_setting('openhsupanel_newsarchive'),
  );

  //Standard styling for FAQ
  if (module_exists('faq')) {
    $form['hsupanel_settings']['openhsupanel']['openhsupanel_faq'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('Add standard styling for FAQ (requires <a href="@href">FAQ module</a>)',
                        array('@href' => 'http://drupal.org/project/faq',)),
    '#default_value' => theme_get_setting('openhsupanel_faq'),
  );
  }

  // Remove some of the base theme's settings.
  /* -- Delete this line if you want to turn off this setting.
  unset($form['themedev']['zen_wireframes']); // We don't need to toggle wireframes on this site.
  // */

  // We are editing the $form in place, so we don't need to return anything.
}


/**
 * Display the initial header image
 */
function hsupanel_image_preview_initial() {

  //Get theme setting for header image
  $image_file = theme_get_setting('hsupanel_header_image');

  return hsupanel_image_preview($image_file);

}

/**
 * Ajax callback for selected header image
 */
function hsupanel_image_preview_callback($form, $form_state) {

  //Get current header image from $form_state
  $image_file = $form_state['values']['hsupanel_header_image'];

  return hsupanel_image_preview($image_file);

}

/**
 * Preview the selected header image
 */
function hsupanel_image_preview($image_file) {

  $image_preview = array();

  //Build full path to image
  $image_path = '/' . drupal_get_path('theme', 'hsupanel') . '/header-images';
  $image_path .= "/$image_file";

  $variables = array(
    'path' => "$image_path",
    'alt' => 'Preview of header image',
    'title' => 'Preview of header image',
    'width' => '100%',
    'height' => '50%',
    //'attributes' => array('class' => 'some-img', 'id' => 'my-img'),
  );

  // Image preview
  $image_preview = array(
    '#markup' => theme('image', $variables),
    '#prefix' => '<div id="header_image_div">',
    '#suffix' => '</div>',

  );

  return $image_preview;
}

/**
 * Get a list of all available images in 'header-images' directory - adapted from http://drupal.org/project/noggin
 */
function hsupanel_get_available_images() {
  // Search for png and jpg files by default
  $allowed_extensions = array('jpg', 'png');
  // Path to theme
  $theme_path = drupal_get_path('theme', 'hsupanel');
  // Build the available images array
  $images = array();
  foreach ($allowed_extensions as $extension) {
    $files = drupal_system_listing("/\.$extension$/", "$theme_path/header-images", 'name', 0);
    foreach ($files as $name => $image) {
      $images["$image->filename"] = $image->filename;
    }
  }
  if (count($images)) {
    $options['Available Images'] = $images;
  }
  return $options;
}

