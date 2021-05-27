<?php

function university_files()
{
  wp_enqueue_style(
    'custom-google-fonts',
    '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i'
  );
  wp_enqueue_style(
    'font-awesome',
    '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'
  );
  if (strstr($_SERVER['SERVER_NAME'], 'fictional-university.local')) {
    wp_enqueue_script(
      'main-university-js',
      'http://localhost:3000/bundled.js',
      null,
      '1.0',
      true
    );
  } else {
    wp_enqueue_script(
      'our-vendors-js',
      get_theme_file_uri(
        '/bundled-assets/vendors~scripts.8c97d901916ad616a264.js'
      ),
      null,
      '1.0',
      true
    );
    wp_enqueue_script(
      'main-university-js',
      get_theme_file_uri('/bundled-assets/scripts.361ae884830d52b8ba98.js'),
      null,
      '1.0',
      true
    );
    wp_enqueue_style(
      'our-main-style',
      get_theme_file_uri('/bundled-assets/styles.361ae884830d52b8ba98.css')
    );
  }
}

add_action('wp_enqueue_scripts', 'university_files');

function university_features()
{
  add_theme_support('title-tag');
}

add_action('after_setup_theme', 'university_features');
