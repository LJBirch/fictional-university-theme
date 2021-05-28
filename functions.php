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
  add_theme_support('post-thumbnails');
  add_image_size('professorLandscape', 400, 260, true);
  add_image_size('professorPortrait', 480, 650, true);
}

add_action('after_setup_theme', 'university_features');

function university_adjust_queries($query)
{
  if (
    !is_admin() and
    is_post_type_archive('program') and
    $query->is_main_query()
  ) {
    $query->set('orderby', 'title');
    $query->set('order', 'ASC');
    $query->set('posts_per_page', -1);
  }

  if (
    !is_admin() and
    is_post_type_archive('event') and
    $query->is_main_query()
  ) {
    $today = date('Ymd');
    $query->set('meta_key', 'event_date');
    $query->set('orderby', 'meta_value_num');
    $query->set('order', 'ASC');
    $query->set('meta_query', [
      [
        'key' => 'event_date',
        'compare' => '>=',
        'value' => $today,
        'type' => 'numeric',
      ],
    ]);
  }
}

add_action('pre_get_posts', 'university_adjust_queries');
