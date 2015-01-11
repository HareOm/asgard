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
  global $post;
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
    <li class="rrssb-pinterest">
        <!-- Replace href with your meta and URL information.  -->
        <a href="http://pinterest.com/pin/create/button/?url=<?php echo get_permalink() ?>&amp;media=<?php echo wp_get_attachment_url( get_post_thumbnail_id($post->ID) ) ?>&amp;description=<?php echo urlencode(get_the_title()) ?>">
            <span class="rrssb-icon">
                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="28px" height="28px" viewBox="0 0 28 28" enable-background="new 0 0 28 28" xml:space="preserve">
                <path d="M14.021,1.57C6.96,1.57,1.236,7.293,1.236,14.355c0,7.062,5.724,12.785,12.785,12.785c7.061,0,12.785-5.725,12.785-12.785
                    C26.807,7.294,21.082,1.57,14.021,1.57z M15.261,18.655c-1.161-0.09-1.649-0.666-2.559-1.219c-0.501,2.626-1.113,5.145-2.925,6.458
                    c-0.559-3.971,0.822-6.951,1.462-10.116c-1.093-1.84,0.132-5.545,2.438-4.632c2.837,1.123-2.458,6.842,1.099,7.557
                    c3.711,0.744,5.227-6.439,2.925-8.775c-3.325-3.374-9.678-0.077-8.897,4.754c0.19,1.178,1.408,1.538,0.489,3.168
                    C7.165,15.378,6.53,13.7,6.611,11.462c0.131-3.662,3.291-6.227,6.46-6.582c4.007-0.448,7.771,1.474,8.29,5.239
                    c0.579,4.255-1.816,8.865-6.102,8.533L15.261,18.655z"/>
                </svg>
            </span>
            <span class="rrssb-text">pinterest</span>
        </a>
    </li>
    <li class="rrssb-reddit">
            <a href="http://www.reddit.com/submit?url=<?php echo get_permalink() ?>">
                <span class="rrssb-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" width="28px" height="28px" viewBox="0 0 28 28" enable-background="new 0 0 28 28" xml:space="preserve"><g><path d="M11.794 15.316c0-1.029-0.835-1.895-1.866-1.895c-1.03 0-1.893 0.865-1.893 1.895s0.863 1.9 1.9 1.9 C10.958 17.2 11.8 16.3 11.8 15.316z"/><path d="M18.1 13.422c-1.029 0-1.895 0.864-1.895 1.895c0 1 0.9 1.9 1.9 1.865c1.031 0 1.869-0.836 1.869-1.865 C19.969 14.3 19.1 13.4 18.1 13.422z"/><path d="M17.527 19.791c-0.678 0.678-1.826 1.006-3.514 1.006c-0.004 0-0.009 0-0.014 0c-0.004 0-0.01 0-0.015 0 c-1.686 0-2.834-0.328-3.51-1.005c-0.264-0.265-0.693-0.265-0.958 0c-0.264 0.265-0.264 0.7 0 1 c0.943 0.9 2.4 1.4 4.5 1.402c0.005 0 0 0 0 0c0.005 0 0 0 0 0c2.066 0 3.527-0.459 4.47-1.402 c0.265-0.264 0.265-0.693 0.002-0.958C18.221 19.5 17.8 19.5 17.5 19.791z"/><path d="M27.707 13.267c0-1.785-1.453-3.237-3.236-3.237c-0.793 0-1.518 0.287-2.082 0.761c-2.039-1.295-4.646-2.069-7.438-2.219 l1.483-4.691l4.062 0.956c0.071 1.4 1.3 2.6 2.7 2.555c1.488 0 2.695-1.208 2.695-2.695C25.881 3.2 24.7 2 23.2 2 c-1.059 0-1.979 0.616-2.42 1.508l-4.633-1.091c-0.344-0.081-0.693 0.118-0.803 0.455l-1.793 5.7 C10.548 8.6 7.7 9.4 5.6 10.75C5.006 10.3 4.3 10 3.5 10.029c-1.785 0-3.237 1.452-3.237 3.2 c0 1.1 0.6 2.1 1.4 2.69c-0.04 0.272-0.061 0.551-0.061 0.831c0 2.3 1.3 4.4 3.7 5.9 c2.299 1.5 5.3 2.3 8.6 2.325c3.228 0 6.271-0.825 8.571-2.325c2.387-1.56 3.7-3.66 3.7-5.917 c0-0.26-0.016-0.514-0.051-0.768C27.088 15.5 27.7 14.4 27.7 13.267z M23.186 3.355c0.74 0 1.3 0.6 1.3 1.3 c0 0.738-0.6 1.34-1.34 1.34s-1.342-0.602-1.342-1.34C21.844 4 22.4 3.4 23.2 3.355z M1.648 13.3 c0-1.038 0.844-1.882 1.882-1.882c0.31 0 0.6 0.1 0.9 0.209c-1.049 0.868-1.813 1.861-2.26 2.9 C1.832 14.2 1.6 13.8 1.6 13.267z M21.773 21.57c-2.082 1.357-4.863 2.105-7.831 2.105c-2.967 0-5.747-0.748-7.828-2.105 c-1.991-1.301-3.088-3-3.088-4.782c0-1.784 1.097-3.484 3.088-4.784c2.081-1.358 4.861-2.106 7.828-2.106 c2.967 0 5.7 0.7 7.8 2.106c1.99 1.3 3.1 3 3.1 4.784C24.859 18.6 23.8 20.3 21.8 21.57z M25.787 14.6 c-0.432-1.084-1.191-2.095-2.244-2.977c0.273-0.156 0.59-0.245 0.928-0.245c1.035 0 1.9 0.8 1.9 1.9 C26.354 13.8 26.1 14.3 25.8 14.605z"/></g></svg>
                </span>
                <span class="rrssb-text">reddit</span>
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
