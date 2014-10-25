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


  // turn off access for logo & favicon
  $form['theme_settings']['toggle_logo']['#access'] = FALSE;
  $form['theme_settings']['toggle_favicon']['#access'] = FALSE;
  $form['logo']['#access'] = FALSE;
  $form['favicon']['#access'] = FALSE;


  // Collapse Toggle Display
  $form['theme_settings']['#collapsible'] = TRUE;
  $form['theme_settings']['#collapsed'] = TRUE;

  // Create the form using Forms API: http://api.drupal.org/api/7
  $form['hsupanel_image'] = array(
    "#type"  => "fieldset",
    "#title" => "Header Image for hsupanel",
    '#collapsible' => TRUE,
    '#collapsed' => FALSE,
  );

  // Manually set hsupanel header images
  $header_options = array(
    t('hsupanel Headers')  => array(
      'gold-hgh.jpg'        => t('Harry Griffith Hall & Autumn Leaves'),
      'dunes.jpg'           => t('Buckwheat Beach Dunes'),
      'founders.jpg'        => t('Founders Hall'),
      'kra.jpg'             => t('Student Recreation Center'),
      'library.jpg'         => t('Library'),
      'quad-night.jpg'      => t('UC Quad at Night'),
      'students.jpg'        => t('Students'),
      'college-creek.jpg'   => t('College Creek'),
      'canoe.jpg'           => t('Canoes'),
      'redwoods.jpg'        => t('Redwoods'),
      'students-beach.jpg'  => t('Students at the Beach'),
      'bicycle.jpg'         => t('Bicycles'),
      'students-zoo.jpg'    => t('Students at the Zoo'),
      'jacks-fans.jpg'      => t('Lumberjack Fans'),
      'campus-night.jpg'    => t('Campus Rooftops at Night'),
      'bss.jpg'             => t('Behavioral & Social Sciences'),
    ),
  );


  // Select Header Image
  $form['hsupanel_image']['hsupanel_header_image'] = array(
    '#type'          => 'select',
    '#title'         => t('Select an Image'),
    '#options'       => $header_options,
    '#description'   => t("The image will appear behind your page title near the top of your site."),
    '#default_value' => theme_get_setting('hsupanel_header_image'),
    '#ajax'          => array(
      'callback'     => 'hsupanel_image_preview_callback',
      'wrapper'      => 'header_image_div',
     ),
  );

  // Header Image Preview
  $form['hsupanel_image']['hsupanel_header_image_preview'] = array(
    '#type'          => 'fieldset',
    '#title'         => t('Preview of Header Image for hsupanel'),
    'image'          => hsupanel_image_preview_initial(),
    '#collapsible'   => TRUE,
    '#collapsed'     => FALSE,
  );

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
  $image_path = drupal_get_path('theme', 'hsupanel') . '/img';
  $image_path .= "/$image_file";

  $variables = array(
    'path' => "$image_path",
    'alt' => 'Preview of header image',
    'title' => 'Preview of header image',
    'width' => '100%',
    'height' => '50%',
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
 * Social Media Options
 */

$form['social_media'] = array(
    '#type' => 'fieldset',
    '#title' => t('Social Media Links'),
    '#collapsible' => TRUE,
    '#collapsed' => FALSE,
    '#weight' => 15,
    '#description'   => t('If you would like to include links to your social media pages,
                           check the following box and then enter the appropriate information
                           in the optional fields below.'),
);

//Social media toggle
$form['social_media']['include_social_media'] = array(
  '#type'          => 'checkbox',
  '#title'         => t('Include Social Media Links'),
  '#default_value' => theme_get_setting('include_social_media'),
);

//Social media links
$form['social_media']['facebook_link'] = array(
  '#type' => 'textfield',
  '#title' => 'Facebook',
  '#default_value' => theme_get_setting('facebook_link'),
  '#description'   => t('Enter your Facebook username.'),
  '#states'        => array(
    'visible'      => array(
      ':input[name="include_social_media"]' => array('checked' => TRUE),
    ),
  ),
);

$form['social_media']['twitter_link'] = array(
  '#type' => 'textfield',
  '#title' => 'Twitter',
  '#default_value' => theme_get_setting('twitter_link'),
  '#description'   => t('Enter your Twitter username.'),
  '#states'        => array(
    'visible'      => array(
      ':input[name="include_social_media"]' => array('checked' => TRUE),
    ),
  ),
);

$form['social_media']['instagram_link'] = array(
  '#type' => 'textfield',
  '#title' => 'Instagram',
  '#default_value' => theme_get_setting('instagram_link'),
  '#description'   => t('Enter your Instagram username.'),
  '#states'        => array(
    'visible'      => array(
      ':input[name="include_social_media"]' => array('checked' => TRUE),
    ),
  ),
);

$form['social_media']['youtube_link'] = array(
  '#type' => 'textfield',
  '#title' => 'YouTube',
  '#default_value' => theme_get_setting('youtube_link'),
  '#description'   => t('Enter your YouTube Username.'),
  '#states'        => array(
    'visible'      => array(
      ':input[name="include_social_media"]' => array('checked' => TRUE),
    ),
  ),
);

$form['social_media']['flickr_link'] = array(
  '#type' => 'textfield',
  '#title' => 'Flickr',
  '#default_value' => theme_get_setting('flickr_link'),
  '#description'   => t('Enter your Flickr Username.'),
  '#states'        => array(
    'visible'      => array(
      ':input[name="include_social_media"]' => array('checked' => TRUE),
    ),
  ),
);
