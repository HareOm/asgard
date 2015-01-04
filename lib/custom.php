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

function the_category_filter($post_type = NULL) {
$this_cat_id = get_query_var('cat');

if( $post_type ) {
  $categories = get_terms_by_post_type(array("category"), array($post_type));
} else {
  $categories = get_terms('category');
}
?>
<select class="form-control input-sm" onchange="javascript:location.href = this.value;">
<?php if(!$this_cat_id): ?>
<option>Choose a Category</option>
<?php endif; ?>
<?php foreach($categories as $cat): ?>
  <option<?php if($this_cat_id == $cat->term_id) echo ' selected' ?> value="<?php echo home_url('category/'. $cat->slug . '?post_type=' . $post_type) ?>"><?php echo $cat->name ?>
<?php endforeach; ?>
</select>
<?php
}

function asgard_share_post(){
  ?>
<div class="share-post">
  <ul class="rrssb-buttons clearfix">
    <li class="rrssb-facebook">
      <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()) ?>" class="popup">
        <span class="rrssb-icon">
          <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="28px" height="28px" viewBox="0 0 28 28" enable-background="new 0 0 28 28" xml:space="preserve">
            <path d="M27.825,4.783c0-2.427-2.182-4.608-4.608-4.608H4.783c-2.422,0-4.608,2.182-4.608,4.608v18.434
          c0,2.427,2.181,4.608,4.608,4.608H14V17.379h-3.379v-4.608H14v-1.795c0-3.089,2.335-5.885,5.192-5.885h3.718v4.608h-3.726
          c-0.408,0-0.884,0.492-0.884,1.236v1.836h4.609v4.608h-4.609v10.446h4.916c2.422,0,4.608-2.188,4.608-4.608V4.783z"/>
          </svg>
        </span>
        <span class="rrssb-text">facebook</span>
      </a>
    </li>
    <li class="rrssb-twitter">
      <a href="http://twitter.com/home?status=<?php echo urlencode(get_the_title() . ' ' . get_permalink() ) ?>" class="popup">
        <span class="rrssb-icon">
          <svg version="1.1" id="Layer_2" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
          width="28px" height="28px" viewBox="0 0 28 28" enable-background="new 0 0 28 28" xml:space="preserve">
            <path d="M24.253,8.756C24.689,17.08,18.297,24.182,9.97,24.62c-3.122,0.162-6.219-0.646-8.861-2.32
          c2.703,0.179,5.376-0.648,7.508-2.321c-2.072-0.247-3.818-1.661-4.489-3.638c0.801,0.128,1.62,0.076,2.399-0.155
          C4.045,15.72,2.215,13.6,2.115,11.077c0.688,0.275,1.426,0.407,2.168,0.386c-2.135-1.65-2.729-4.621-1.394-6.965
          C5.575,7.816,9.54,9.84,13.803,10.071c-0.842-2.739,0.694-5.64,3.434-6.482c2.018-0.623,4.212,0.044,5.546,1.683
          c1.186-0.213,2.318-0.662,3.329-1.317c-0.385,1.256-1.247,2.312-2.399,2.942c1.048-0.106,2.069-0.394,3.019-0.851
          C26.275,7.229,25.39,8.196,24.253,8.756z"/>
          </svg>
        </span>
        <span class="rrssb-text">Twitter</span>
      </a>
    </li>
    <li class="rrssb-googleplus">
      <a href="https://plus.google.com/share?url=<?php echo urlencode(get_the_title() . ' ' . get_permalink() ) ?>" class="popup">
        <span class="rrssb-icon">
          <svg version="1.1" id="Layer_3" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="28px" height="28px" viewBox="0 0 28 28" enable-background="new 0 0 28 28" xml:space="preserve">
            <g>
                <g>
                    <path d="M14.703,15.854l-1.219-0.948c-0.372-0.308-0.88-0.715-0.88-1.459c0-0.748,0.508-1.223,0.95-1.663
                        c1.42-1.119,2.839-2.309,2.839-4.817c0-2.58-1.621-3.937-2.399-4.581h2.097l2.202-1.383h-6.67c-1.83,0-4.467,0.433-6.398,2.027
                        C3.768,4.287,3.059,6.018,3.059,7.576c0,2.634,2.022,5.328,5.604,5.328c0.339,0,0.71-0.033,1.083-0.068
                        c-0.167,0.408-0.336,0.748-0.336,1.324c0,1.04,0.551,1.685,1.011,2.297c-1.524,0.104-4.37,0.273-6.467,1.562
                        c-1.998,1.188-2.605,2.916-2.605,4.137c0,2.512,2.358,4.84,7.289,4.84c5.822,0,8.904-3.223,8.904-6.41
                        c0.008-2.327-1.359-3.489-2.829-4.731H14.703z M10.269,11.951c-2.912,0-4.231-3.765-4.231-6.037c0-0.884,0.168-1.797,0.744-2.511
                        c0.543-0.679,1.489-1.12,2.372-1.12c2.807,0,4.256,3.798,4.256,6.242c0,0.612-0.067,1.694-0.845,2.478
                        c-0.537,0.55-1.438,0.948-2.295,0.951V11.951z M10.302,25.609c-3.621,0-5.957-1.732-5.957-4.142c0-2.408,2.165-3.223,2.911-3.492
                        c1.421-0.479,3.25-0.545,3.555-0.545c0.338,0,0.52,0,0.766,0.034c2.574,1.838,3.706,2.757,3.706,4.479
                        c-0.002,2.073-1.736,3.665-4.982,3.649L10.302,25.609z"/>
                    <polygon points="23.254,11.89 23.254,8.521 21.569,8.521 21.569,11.89 18.202,11.89 18.202,13.604 21.569,13.604 21.569,17.004
                        23.254,17.004 23.254,13.604 26.653,13.604 26.653,11.89      "/>
                </g>
            </g>
          </svg>
        </span>
        <span class="rrssb-text">google+</span>
      </a>
    </li>
    <li class="rrssb-email">
      <a href="mailto:?subject=<?php echo urlencode(get_the_title()) ?>&amp;body=<?php echo urlencode(get_permalink()) ?>">
        <span class="rrssb-icon">
          <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" width="28px" height="28px" viewBox="0 0 28 28" enable-background="new 0 0 28 28" xml:space="preserve"><g><path d="M20.111 26.147c-2.336 1.051-4.361 1.401-7.125 1.401c-6.462 0-12.146-4.633-12.146-12.265 c0-7.94 5.762-14.833 14.561-14.833c6.853 0 11.8 4.7 11.8 11.252c0 5.684-3.194 9.265-7.399 9.3 c-1.829 0-3.153-0.934-3.347-2.997h-0.077c-1.208 1.986-2.96 2.997-5.023 2.997c-2.532 0-4.361-1.868-4.361-5.062 c0-4.749 3.504-9.071 9.111-9.071c1.713 0 3.7 0.4 4.6 0.973l-1.169 7.203c-0.388 2.298-0.116 3.3 1 3.4 c1.673 0 3.773-2.102 3.773-6.58c0-5.061-3.27-8.994-9.303-8.994c-5.957 0-11.175 4.673-11.175 12.1 c0 6.5 4.2 10.2 10 10.201c1.986 0 4.089-0.43 5.646-1.245L20.111 26.147z M16.646 10.1 c-0.311-0.078-0.701-0.155-1.207-0.155c-2.571 0-4.595 2.53-4.595 5.529c0 1.5 0.7 2.4 1.9 2.4 c1.441 0 2.959-1.828 3.311-4.087L16.646 10.068z"/></g></svg>
        </span>
        <span class="rrssb-text">email</span>
      </a>
    </li>
  </ul>
</div>

  <?php
}

// Replaces the excerpt "more" text by a link
function new_excerpt_more($more) {
	return;
}
add_filter('excerpt_more', 'new_excerpt_more');


function get_terms_by_post_type( $taxonomies, $post_types ) {

    global $wpdb;

    $query = $wpdb->prepare( "SELECT t.*, COUNT(*) from $wpdb->terms AS t INNER JOIN $wpdb->term_taxonomy AS tt ON t.term_id = tt.term_id INNER JOIN $wpdb->term_relationships AS r ON r.term_taxonomy_id = tt.term_taxonomy_id INNER JOIN $wpdb->posts AS p ON p.ID = r.object_id WHERE p.post_type IN('".join( "', '", $post_types )."') AND tt.taxonomy IN('".join( "', '", $taxonomies )."') GROUP BY t.term_id");

    $results = $wpdb->get_results( $query );

    return $results;

}
