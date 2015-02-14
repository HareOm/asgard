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

//Asgard Includes
require_once locate_template('/vendor/advanced-custom-fields/acf.php');      // Advanced Custom Fields

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

// For uploading images/featured image from front-end
function insert_attachment($file_handler,$post_id,$setthumb='false') {
    // check to make sure its a successful upload
    if ($_FILES[$file_handler]['error'] !== UPLOAD_ERR_OK) __return_false();

    require_once(ABSPATH . "wp-admin" . '/includes/image.php');
    require_once(ABSPATH . "wp-admin" . '/includes/file.php');
    require_once(ABSPATH . "wp-admin" . '/includes/media.php');

    $attach_id = media_handle_upload( $file_handler, $post_id );

    if ($setthumb) update_post_meta($post_id,'_thumbnail_id',$attach_id);
    return $attach_id;
}

function set_featured_image_from_src( $image_url, $post_id ){
  // Add Featured Image to Post
  $upload_dir = wp_upload_dir(); // Set upload folder
  $image_data = file_get_contents($image_url); // Get image data
  $filename   = basename($image_url); // Create image file name

  // Check folder permission and define file location
  if( wp_mkdir_p( $upload_dir['path'] ) ) {
      $file = $upload_dir['path'] . '/' . $filename;
  } else {
      $file = $upload_dir['basedir'] . '/' . $filename;
  }

  // Create the image  file on the server
  file_put_contents( $file, $image_data );

  // Check image file type
  $wp_filetype = wp_check_filetype( $filename, null );

  // Set attachment data
  $attachment = array(
      'post_mime_type' => $wp_filetype['type'],
      'post_title'     => sanitize_file_name( $filename ),
      'post_content'   => '',
      'post_status'    => 'inherit'
  );

  // Create the attachment
  $attach_id = wp_insert_attachment( $attachment, $file, $post_id );

  // Include image.php
  require_once(ABSPATH . 'wp-admin/includes/image.php');

  // Define attachment metadata
  $attach_data = wp_generate_attachment_metadata( $attach_id, $file );

  // Assign metadata to attachment
  wp_update_attachment_metadata( $attach_id, $attach_data );

  // And finally assign featured image to post
  set_post_thumbnail( $post_id, $attach_id );
}

// Handy function for cleaning non-html input submissions
function cleanText($s){
        return htmlentities(trim(strip_tags(stripslashes($s))), ENT_NOQUOTES, "UTF-8");
}

// Handy function for cleaning non-html input submissions
function cleanHtml($s){
        return trim(stripslashes($s));
}


//CUSTOM LOGIN CSS
function asgard_login_css() {
  echo '<link rel="stylesheet" href="'.get_stylesheet_directory_uri() . '/assets/css/login.min.css">';
}
add_action('login_head', 'asgard_login_css');

//CUSTOM EXCERPT LENGTH
function custom_excerpt_length( $length ) {
	return 52;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );


add_action( 'after_setup_theme', 'asgard_rss_template' );
/**
 * Register custom RSS template.
 */
function asgard_rss_template() {
	add_feed( 'weeklyDigest', 'asgard_rss_render' );
}

/**
 * Custom RSS template callback.
 */
function asgard_rss_render() {
	get_template_part( 'feed', 'weeklyDigest' );
}

function asgard_no_orphans( $title ) {
  global $post;
  if( $title == $post->post_title ){
    //Take apart
    $title_words = explode(' ', $title);
    $tile_without_last_word = array_slice($title_words, 0, -1);
    $last_word = array_slice($title_words, -1, 1);

    //Put back together
    $new_title = implode(' ', $tile_without_last_word);
    //add in non-breaking space
    $new_title .= '&nbsp;' . $last_word[0];
    $title = $new_title;
  }
  return $title;
}
add_filter( 'the_title', 'asgard_no_orphans', 10, 2 );


function asgard_sanitize_integer( $input ) {
  if( is_numeric( $input ) ) {
    return intval( $input );
  }
}
function asgard_customizer( $wp_customize ) {

  $wp_customize->add_section( 'media_options', array(
      'title' => 'Media Options',
      'description' => 'Options for media pages.',
  ) );
  //Article Page
  $wp_customize->add_setting( 'article_page', array(
      'sanitize_callback' => 'asgard_sanitize_integer',
  ) );

  $wp_customize->add_control( 'article_page', array(
      'type' => 'dropdown-pages',
      'label' => 'Article Page',
      'section' => 'media_options',
  ) );

  //Contribute Page
  $wp_customize->add_setting( 'contribute_page', array(
      'sanitize_callback' => 'asgard_sanitize_integer',
  ) );

  $wp_customize->add_control( 'contribute_page', array(
      'type' => 'dropdown-pages',
      'label' => 'Contribute Page',
      'section' => 'media_options',
  ) );

  //Image Page
  $wp_customize->add_setting( 'image_page', array(
      'sanitize_callback' => 'asgard_sanitize_integer',
  ) );

  $wp_customize->add_control( 'image_page', array(
      'type' => 'dropdown-pages',
      'label' => 'Image Page',
      'section' => 'media_options',
  ) );

  //Submit Image Page
  $wp_customize->add_setting( 'submit_image_page', array(
      'sanitize_callback' => 'asgard_sanitize_integer',
  ) );

  $wp_customize->add_control( 'submit_image_page', array(
      'type' => 'dropdown-pages',
      'label' => 'Submit Image Page',
      'section' => 'media_options',
  ) );

  //Video Page
  $wp_customize->add_setting( 'video_page', array(
      'sanitize_callback' => 'asgard_sanitize_integer',
  ) );

  $wp_customize->add_control( 'video_page', array(
      'type' => 'dropdown-pages',
      'label' => 'Video Page',
      'section' => 'media_options',
  ) );

  //Submit Video Page
  $wp_customize->add_setting( 'submit_video_page', array(
      'sanitize_callback' => 'asgard_sanitize_integer',
  ) );

  $wp_customize->add_control( 'submit_video_page', array(
      'type' => 'dropdown-pages',
      'label' => 'Submit Video Page',
      'section' => 'media_options',
  ) );

  //Link Page
  $wp_customize->add_setting( 'link_page', array(
      'sanitize_callback' => 'asgard_sanitize_integer',
  ) );

  $wp_customize->add_control( 'link_page', array(
      'type' => 'dropdown-pages',
      'label' => 'Link Page',
      'section' => 'media_options',
  ) );

  //Submit Link Page
  $wp_customize->add_setting( 'submit_link_page', array(
      'sanitize_callback' => 'asgard_sanitize_integer',
  ) );

  $wp_customize->add_control( 'submit_link_page', array(
      'type' => 'dropdown-pages',
      'label' => 'Submit Link Page',
      'section' => 'media_options',
  ) );
}
add_action( 'customize_register', 'asgard_customizer' );
