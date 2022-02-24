<?php
add_theme_support('menus');

add_action('init', 'register_my_menus');

function register_my_menus() {
  register_nav_menus(
    array(
      'primary-desktop-menu' => __('Primary Desktop Menu'),
      'primary-mobile-menu' => __('Primary Mobile Menu'),
      'secondary-mobile-menu' => __('Secondary Mobile Menu'),
    )
  );
}

function get_primary_mobile_menu() {
  $menus = get_nav_menu_locations();
  // Replace your menu name, slug or ID carefully
  return wp_get_nav_menu_items($menus['primary-mobile-menu']);
}

function get_secondary_mobile_menu() {
  // Replace your menu name, slug or ID carefully
  $menus = get_nav_menu_locations();
  return wp_get_nav_menu_items($menus['secondary-mobile-menu']);
}




add_action('rest_api_init', function () {
  register_rest_route('wp/v2', 'primary_mobile_menu', array(
    'methods'  => WP_REST_Server::READABLE,
    // 'methods' => 'GET',
    'callback' => 'get_primary_mobile_menu',
    'permission_callback' => '__return_true'
  ));
  register_rest_route('wp/v2', 'secondary_mobile_menu', array(
    'methods'  => WP_REST_Server::READABLE,
    // 'methods' => 'GET',
    'callback' => 'get_secondary_mobile_menu',
    'permission_callback' => '__return_true'
  ));
});
