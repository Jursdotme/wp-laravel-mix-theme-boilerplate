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

function get_primary_desktop_menu() {
  $menus = get_nav_menu_locations();
  // Replace your menu name, slug or ID carefully
  $items = wp_get_nav_menu_items($menus['primary-desktop-menu']);

  foreach ((array) $items as $key => $item) {

    $item_id = $item->object_id;
    $item->dropdown_type = get_field('dropdown_type', $item_id);
    $item->featured = get_field('featured', $item_id);
    $item->pill_label = get_field('pill_label', $item_id);
    $item->icon = get_field('icon', $item_id);
  }

  return $items;
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
  register_rest_route('wp/v2', 'primary_desktop_menu', array(
    'methods'  => WP_REST_Server::READABLE,
    // 'methods' => 'GET',
    'callback' => 'get_primary_desktop_menu',
    'permission_callback' => '__return_true'
  ));
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


function acf_location_rules_types($choices) {
  $choices['Menu']['menu_level'] = 'Menu Depth';
  return $choices;
}

// add_filter('acf/location/rule_types', 'acf_location_rules_types');

// add_filter('acf/location/rule_values/menu_level', 'acf_location_rule_values_level');
function acf_location_rule_values_level($choices) {
  $choices[0] = '0';
  $choices[1] = '1';

  return $choices;
}
// add_filter('acf/location/rule_match/menu_level', 'acf_location_rule_match_level', 10, 4);
function acf_location_rule_match_level($match, $rule, $options, $field_group) {
  $current_screen = get_current_screen();
  if ($current_screen->base == 'nav-menus') {
    if ($rule['operator'] == "==") {
      $match = ($options['nav_menu_item_depth'] == $rule['value']);
    }
  }
  return $match;
}
