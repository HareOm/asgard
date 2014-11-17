<?php
/**
 * Roots includes
 */
require_once locate_template('/lib/utils.php');           // Utility functions
require_once locate_template('/lib/init.php');            // Initial theme setup and constants
require_once locate_template('/lib/wrapper.php');         // Theme wrapper class
require_once locate_template('/lib/sidebar.php');         // Sidebar class
require_once locate_template('/lib/config.php');          // Configuration
require_once locate_template('/lib/activation.php');      // Theme activation
require_once locate_template('/lib/titles.php');          // Page titles
require_once locate_template('/lib/cleanup.php');         // Cleanup
require_once locate_template('/lib/nav.php');             // Custom nav modifications
require_once locate_template('/lib/gallery.php');         // Custom [gallery] modifications
require_once locate_template('/lib/comments.php');        // Custom comments modifications
require_once locate_template('/lib/relative-urls.php');   // Root relative URLs
require_once locate_template('/lib/widgets.php');         // Sidebars and widgets
require_once locate_template('/lib/scripts.php');         // Scripts and stylesheets
require_once locate_template('/lib/custom.php');          // Custom functions
require_once locate_template('/lib/post-types.php');      // Register Custom Post Types


// Fix nav menu active classes for custom post types
function roots_cpt_active_menu($menu) {
  global $post;
  if ('image' === get_post_type()) {
    $menu = str_replace('active', '', $menu);
    $menu = str_replace('menu-images', 'menu-images active', $menu);
  }
  if ('video' === get_post_type()) {
    $menu = str_replace('active', '', $menu);
    $menu = str_replace('menu-videos', 'menu-videos active', $menu);
  }
  return $menu;
}
add_filter('nav_menu_css_class', 'roots_cpt_active_menu', 400);

// Add default value to voting meta
function set_default_meta($post_ID){
    $current_field_value = get_post_meta($post_ID, 'hethens_vote_count', true);
    $current_field_value2 = get_post_meta($post_ID, 'hethens_admin_vote_count', true);
    $default_meta = '0';
    if ($current_field_value == '' && !wp_is_post_revision($post_ID)){
        add_post_meta($post_ID, 'hethens_vote_count', $default_meta,true);
    }
    if ($current_field_value2 == '' && !wp_is_post_revision($post_ID)){
        add_post_meta($post_ID, 'hethens_admin_vote_count', $default_meta, true);
    }
    return $post_ID;
}
add_action('wp_insert_post','set_default_meta');
