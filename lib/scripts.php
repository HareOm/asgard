<?php
/**
 * Enqueue scripts and stylesheets
 *
 * Enqueue stylesheets in the following order:
 * 1. /theme/assets/css/main.min.css
 *
 * Enqueue scripts in the following order:
 * 1. jquery-1.11.0.min.js via Google CDN
 * 2. /theme/assets/js/vendor/modernizr-2.7.0.min.js
 * 3. /theme/assets/js/main.min.js (in footer)
 */
function roots_scripts() {
  global $google_maps_api_key;
  wp_enqueue_style('roots_main', get_template_directory_uri() . '/assets/css/main.min.css', false, '833531224df46071bd8ed1d472028207');

  // jQuery is loaded using the same method from HTML5 Boilerplate:
  // Grab Google CDN's latest jQuery with a protocol relative URL; fallback to local if offline
  // It's kept in the header instead of footer to avoid conflicts with plugins.
  if (!is_admin() && current_theme_supports('jquery-cdn')) {
    wp_deregister_script('jquery');
    wp_register_script('jquery', '//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js', array(), null, false);
    add_filter('script_loader_src', 'roots_jquery_local_fallback', 10, 2);
  }

  if (is_single() && comments_open() && get_option('thread_comments')) {
    wp_enqueue_script('comment-reply');
  }

  wp_register_script('modernizr', get_template_directory_uri() . '/assets/js/vendor/modernizr-2.7.0.min.js', array(), null, false);
  wp_register_script('roots_scripts', get_template_directory_uri() . '/assets/js/scripts.min.js', array(), '5ff819b201b8191eca3521933e6d2b84', true);
  wp_register_script('jquery-validation', get_template_directory_uri() . '/assets/vendor/jquery-validation/dist/jquery.validate.min.js', array('jquery'), null, true);
  wp_register_script('jquery-waypoints', get_template_directory_uri() . '/assets/vendor/jquery-waypoints/waypoints.min.js', array('jquery'), null, true);
  wp_register_script('jquery-waypoints-sticky', get_template_directory_uri() . '/assets/vendor/jquery-waypoints/shortcuts/sticky-elements/waypoints-sticky.min.js', array('jquery','jquery-waypoints'), null, true);
  wp_register_script('fitvids', get_template_directory_uri() . '/assets/vendor/fitvids/jquery.fitvids.js', array('jquery'), null, true);
  wp_register_script('RRSSB', get_template_directory_uri() . '/assets/vendor/RRSSB/js/rrssb.min.js', array('jquery'), null, true);
  wp_register_script('gmaps', 'https://maps.googleapis.com/maps/api/js?key=' . $google_maps_api_key, array(), "3.0", false);
  wp_register_script('asgard-helpout', get_template_directory_uri() . '/assets/js/helpout.js', array('jquery'), null, true);

  if( is_page_template('template-helpout.php') ) {
    wp_enqueue_script('asgard-helpout');
  }

  if( is_page_template("template-home.php") ) {
    wp_enqueue_script('gmaps');
  }

  wp_enqueue_script('modernizr');
  wp_enqueue_script('jquery');
  wp_enqueue_script('jquery-validation');
  wp_enqueue_script('jquery-waypoints');
  wp_enqueue_script('jquery-waypoints-sticky');
  wp_enqueue_script('fitvids');
  wp_enqueue_script('RRSSB');
  wp_enqueue_script('roots_scripts');

}
add_action('wp_enqueue_scripts', 'roots_scripts', 100);

function asgard_add_fb_root(){
  echo '<div id="fb-root"></div>';
}
add_action('after_body_open','asgard_add_fb_root');

// http://wordpress.stackexchange.com/a/12450
function roots_jquery_local_fallback($src, $handle = null) {
  static $add_jquery_fallback = false;

  if ($add_jquery_fallback) {
    echo '<script>window.jQuery || document.write(\'<script src="' . get_template_directory_uri() . '/assets/js/vendor/jquery-1.11.0.min.js"><\/script>\')</script>' . "\n";
    $add_jquery_fallback = false;
  }

  if ($handle === 'jquery') {
    $add_jquery_fallback = true;
  }

  return $src;
}
add_action('wp_head', 'roots_jquery_local_fallback');

function roots_google_analytics() { ?>
<script>
  (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
  function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
  e=o.createElement(i);r=o.getElementsByTagName(i)[0];
  e.src='//www.google-analytics.com/analytics.js';
  r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
  ga('create','<?php echo GOOGLE_ANALYTICS_ID; ?>');ga('send','pageview');
</script>

<?php }
if (GOOGLE_ANALYTICS_ID && !current_user_can('manage_options')) {
  add_action('wp_footer', 'roots_google_analytics', 20);
}
