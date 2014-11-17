<?php
/**
 * Custom functions
 */

function the_date_filter($post_type = NULL) {

if( !$post_type ){
  $post_type = get_post_type();
}

?>

<ul class="nav nav-pills" role="tablist">
  <li<?php if( $_GET['date'] == 'today') echo ' class="active"'; ?>><a href="<?php echo add_query_arg("date", "today") ?>">Today</a>
  <li<?php if( $_GET['date'] == 'week') echo ' class="active"'; ?>><a href="<?php echo add_query_arg("date", "week") ?>">This Week</a>
  <li<?php if( $_GET['date'] == 'month') echo ' class="active"'; ?>><a href="<?php echo add_query_arg("date", "month") ?>">This Month</a>
  <li<?php if( $_GET['date'] == 'all') echo ' class="active"'; ?>><a href="<?php echo add_query_arg("date", "all") ?>">All Time</a>
</ul>

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

<ul class="nav nav-pills" role="tablist">
<?php foreach($post_types as $pt): ?>
  <?php if( !in_array($pt, $exclude_post_types) ): ?>
  <?php
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

  ?>
  <li<?php if($post_type == $pt) echo ' class="active"' ?>>
    <a href="<?php echo $url; ?>"><?php echo $name ?></a>
  <?php endif ?>
<?php endforeach; ?>
</ul>
<?php

}

function the_category_filter($post_type) {
$this_cat_id = get_query_var('cat');
$categories = get_terms_by_post_type(array("category"), array($post_type));
?>
<ul class="nav nav-pills" role="tablist">
<?php foreach($categories as $cat): ?>
  <li<?php if($this_cat_id == $cat->term_id) echo ' class="active"' ?>>
    <a href="<?php echo home_url('category/'. $cat->slug . '?post_type=' . $post_type) ?>"><?php echo $cat->name ?></a>
<?php endforeach; ?>
</ul>
<?php
}

function get_terms_by_post_type( $taxonomies, $post_types ) {

    global $wpdb;

    $query = $wpdb->prepare( "SELECT t.*, COUNT(*) from $wpdb->terms AS t INNER JOIN $wpdb->term_taxonomy AS tt ON t.term_id = tt.term_id INNER JOIN $wpdb->term_relationships AS r ON r.term_taxonomy_id = tt.term_taxonomy_id INNER JOIN $wpdb->posts AS p ON p.ID = r.object_id WHERE p.post_type IN('".join( "', '", $post_types )."') AND tt.taxonomy IN('".join( "', '", $taxonomies )."') GROUP BY t.term_id");

    $results = $wpdb->get_results( $query );

    return $results;

}
