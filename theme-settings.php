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



  // Create the form using Forms API: http://api.drupal.org/api/7
  $form['hsupanel_image'] = array(
    "#type"  => "fieldset",
    "#title" => "Header Image for hsupanel",
    '#collapsible' => TRUE,
    '#collapsed' => FALSE,
  );

  // Manually set hsupanel header images - see below for alternate option
  $header_options = array(
    t('hsupanel Headers')  => array(
      'gold-hgh.jpg'         => t('Harry Griffith Hall & Autumn Leaves'),
      'banner-test.jpg'         => t('Test Photo'),
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

