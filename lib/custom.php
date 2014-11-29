<?php
/**
 * Custom functions
 */

function the_date_filter($post_type = NULL) {

if( !$post_type ){
  $post_type = get_post_type();
}

?>

<select class="form-control input-sm" onchange="javascript:location.href = this.value;">
  <option<?php if( $_GET['date'] == 'today') echo ' selected'; ?> value="<?php echo add_query_arg("date", "today") ?>">Today
  <option<?php if( $_GET['date'] == 'week') echo ' selected'; ?> value="<?php echo add_query_arg("date", "week") ?>">This Week
  <option<?php if( $_GET['date'] == 'month') echo ' selected'; ?> value="<?php echo add_query_arg("date", "month") ?>">This Month
  <option<?php if( $_GET['date'] == 'all') echo ' selected'; ?> value="<?php echo add_query_arg("date", "all") ?>">All Time
</select>

<?php
}


function the_type_filter($post_type = NULL) {
if( !$post_type ){
  $post_type = get_post_type();
}
$post_types = get_post_types(array(
  "publicly_queryable" => true,
));
$exclude_post_types = array("attachment", "manifesto", "press_release");
?>

<select class="form-control input-sm" onchange="javascript:location.href = this.value;">
<?php
  foreach($post_types as $pt) {
    if( !in_array($pt, $exclude_post_types) ) {
      if( $pt == "post" ) {
        $name = "Article";
      } else {
        $name = ucfirst($pt);
      }

      if( is_category() ) {
        $url = add_query_arg("post_type", $pt);
      } elseif($pt == "image") {
        $url = home_url("images");
      } elseif($pt == "video") {
        $url = home_url("videos");
      } else {
        $url = home_url("articles");
      }

      echo "<option";
      if($post_type == $pt) echo ' selected';
      echo " value=\"$url\">$name";

    }
  }

?>
</select>
<?php

}

function the_category_filter($post_type) {
$this_cat_id = get_query_var('cat');
$categories = get_terms_by_post_type(array("category"), array($post_type));
?>
<select class="form-control input-sm" onchange="javascript:location.href = this.value;">
<?php foreach($categories as $cat): ?>
  <option<?php if($this_cat_id == $cat->term_id) echo ' selected' ?> value="<?php echo home_url('category/'. $cat->slug . '?post_type=' . $post_type) ?>"><?php echo $cat->name ?>
<?php endforeach; ?>
</select>
<?php
}

//add_filter('roots/main_class', 'roots_main_class_adjust');

// function roots_main_class_adjust($class) {
//
//   global $class;
//
//   if (roots_display_sidebar()) {
//
//     // Classes on pages with the sidebar
//     $class = 'col-sm-1';
//
//   } else {
//
//     // Classes on full width pages
//     $class = 'col-sm-12';
//   }
//
//   return $class;
// }


function get_terms_by_post_type( $taxonomies, $post_types ) {

    global $wpdb;

    $query = $wpdb->prepare( "SELECT t.*, COUNT(*) from $wpdb->terms AS t INNER JOIN $wpdb->term_taxonomy AS tt ON t.term_id = tt.term_id INNER JOIN $wpdb->term_relationships AS r ON r.term_taxonomy_id = tt.term_taxonomy_id INNER JOIN $wpdb->posts AS p ON p.ID = r.object_id WHERE p.post_type IN('".join( "', '", $post_types )."') AND tt.taxonomy IN('".join( "', '", $taxonomies )."') GROUP BY t.term_id");

    $results = $wpdb->get_results( $query );

    return $results;

}
