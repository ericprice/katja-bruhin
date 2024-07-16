<?php

add_action('after_setup_theme', function() {
  add_theme_support('html5', ['script', 'style']);
  remove_action('wp_enqueue_scripts', 'wp_enqueue_global_styles');
  remove_action('wp_footer', 'wp_enqueue_global_styles', 1);
});

function katja_assets() {
  $katja_version = '0.12';
  if (!is_admin()) {
    wp_deregister_script('wp-embed');
  }
  if (!is_admin()) {
    wp_deregister_script('jquery');
    wp_register_script(
      'jquery',
      "https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js",
      null,
      null,
      false
    );
    wp_enqueue_script('jquery');
  }
  wp_enqueue_style('katja-style', get_stylesheet_uri(), null, $katja_version);
  wp_enqueue_script(
    'katja-scripts',
    get_template_directory_uri() . '/js/katjabruhin.min.js',
    null,
    $katja_version,
    false
  );
}
add_action('wp_enqueue_scripts', 'katja_assets');

add_theme_support('post-thumbnails');
add_theme_support('title-tag');
add_filter('wp_lazy_loading_enabled', '__return_false');


add_action('init', 'katja_register_post_types', 9);
function katja_register_post_types() {
  register_post_type('katja_projects', array(
    'labels' => array(
      'name' => __('Projects'),
      'singular_name' => __('Project'),
      'all_items' => __('All Projects'),
      'add_new_item' => __('Add New Project'),
      'search_items' => __('Search Projects'),
      'not_found' => __('No projects found'),
      'not_found_in_trash' => __('No projects found in Trash')
    ),
    'capability_type' => 'page',
    'hierarchical' => true,
    'public' => true,
    'has_archive' => true,
    'menu_icon' => 'dashicons-art',
    'taxonomies' => array('category'),
    'supports' => array('title', 'editor', 'thumbnail', 'page-attributes'),
    'rewrite' => array('slug' => 'projects'),
    'menu_position' => 4
  ));
}

function katja_remove_wp_block_library_css(){
  wp_dequeue_style('wp-block-library');
  wp_dequeue_style('wp-block-library-theme');
}
add_action('wp_enqueue_scripts', 'katja_remove_wp_block_library_css', 100);


add_filter('intermediate_image_sizes_advanced', 'katja_remove_default_images');
function katja_remove_default_images($sizes) {
  unset($sizes['small']);
  unset($sizes['medium']);
  unset($sizes['large']);
  return $sizes;
}

$my_image_sizes = [
  [
    'name' => 'katja_s',
    'width' => 300,
    'height' => 300,
    'crop' => false,
  ],
  [
    'name' => 'katja_m',
    'width' => 900,
    'height' => 900,
    'crop' => false,
  ],
  [
    'name' => 'katja_l',
    'width' => 1600,
    'height' => 1600,
    'crop' => false,
  ],
];

foreach ($my_image_sizes as $my_image_size) {
  add_image_size(
    $my_image_size['name'],
    $my_image_size['width'],
    $my_image_size['height'],
    $my_image_size['crop']
  );
  update_option($my_image_size['name'] . "_size_w", $my_image_size['width']);
  update_option($my_image_size['name'] . "_size_h", $my_image_size['height']);
  update_option($my_image_size['name'] . "_crop", $my_image_size['crop']);
}

add_filter('intermediate_image_sizes', 'my_add_image_sizes');
function my_add_image_sizes($sizes) {
  global $my_image_sizes;
  foreach ($my_image_sizes as $my_image_size) {
    $sizes[] = $my_image_size['name'];
  }
  return $sizes;
}

if (function_exists('set_image_size_quality')) {
  set_image_size_quality('katja_s', 70);
  set_image_size_quality('katja_m', 75);
  set_image_size_quality('katja_l', 80);
}

add_filter('wp_calculate_image_srcset', '__return_false');

remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('admin_print_styles', 'print_emoji_styles');

add_action('admin_menu', 'katja_remove_admin_menus');
function katja_remove_admin_menus() {
  remove_menu_page('edit.php');
  remove_menu_page('edit-comments.php');
}
add_action('init', 'remove_comment_support', 100);

function remove_comment_support() {
  remove_post_type_support('post', 'comments');
  remove_post_type_support('page', 'comments');
}
function mytheme_admin_bar_render() {
  global $wp_admin_bar;
  $wp_admin_bar->remove_menu('comments');
}
add_action('wp_before_admin_bar_render', 'mytheme_admin_bar_render');


add_filter('get_the_archive_title', function ($title) {
  if (is_category()) {
      $title = single_cat_title('', false);
  } elseif (is_tag()) {
      $title = single_tag_title('', false);
  } elseif (is_author()) {
      $title = '<span class="vcard">' . get_the_author() . '</span>';
  } elseif (is_tax()) { //for custom post types
      $title = sprintf(__('%1$s'), single_term_title('', false));
  } elseif (is_post_type_archive()) {
      $title = post_type_archive_title('', false);
  }
  return $title;
});


add_filter('tiny_mce_before_init', 'katja_tinymce_paste_as_text');
function katja_tinymce_paste_as_text( $init ) {
  $init['paste_as_text'] = true;
  return $init;
}

