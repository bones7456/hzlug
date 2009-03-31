<?php
  function phptemplate_settings($saved_settings) {

    // Set default variables
    $defaults = array(
      'wrapper_width' => 874,
      'banner_display' => 1,
      'banner_text' => 'We suggest downloading and installing <a href="http://www.mozilla.com/en-US/firefox/">Firefox</a> to secure your browsing experience and take full advantage of this site.',
      'custom_footer_left' => '&copy; 2007 Canonical Ltd. Ubuntu and Canonical are registered trademarks of Canonical Ltd.',
      'custom_footer_right' => 'Theme created by the <a href="https://launchpad.net/~ubuntu-drupal-themes">Ubuntu Drupal</a> team.',
    );

    // Replace defualts with changes
    $settings = array_merge($defaults, $saved_settings);

    // Merge the saved variables and their default values
    $settings = array_merge($defaults, $saved_settings);

    // Create the form widgets using Forms API
    $form['wrapper_width'] = array(
      '#type' => 'textfield',
      '#title' => t('Page Width (default=874)'),
      '#default_value' => $settings['wrapper_width'],
    );
    $form['banner_display'] = array(
      '#type' => 'checkbox',
      '#title' => t('Show IE Banner'),
      '#default_value' => $settings['banner_display'],
    );
    $form['banner_text'] = array(
      '#type' => 'textarea',
      '#title' => t('IE Banner Text'),
      '#default_value' => $settings['banner_text'],
    );
    $form['custom_footer_left'] = array(
      '#type' => 'textarea',
      '#disabled' => 'true',
      '#title' => t('Footer Text (Left)'),
      '#default_value' => $settings['custom_footer_left'],
    );
    $form['custom_footer_right'] = array(
      '#type' => 'textarea',
      '#title' => t('Footer Text (Right)'),
      '#default_value' => $settings['custom_footer_right'],
    );

    // Return the additional form widgets
    return $form;
  }
?>
