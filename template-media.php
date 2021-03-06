<?php
/*
* Template Name: Media
*/
?>
<?php
//SET UP VARS

//Set the post type in the page template's custom field
if( get_post_meta($post->ID, 'post_type', TRUE) ) {
  $post_type = get_post_meta($post->ID, 'post_type', TRUE);
} else {
  $post_type = 'post';
}

if( $_GET['date'] ) {
  $date = $_GET['date'];
} elseif(get_option('default_date')) {
  $date = get_option('default_date');
} else {
  $date = "all";
}

$today = getdate();

if( $date == "week" ) {
  $date_query = array(
    'after' => '1 week ago'
  );
} elseif( $date == "month" ) {
  $date_query = array(
    'year'  => $today['year'],
    'month' => $today['mon'],
  );
} elseif( $date == "today" ) {
  $date_query = array(
    'year'  => $today['year'],
    'month' => $today['mon'],
    'day'   => $today['mday'],
  );
}

$args = array(
  'post_type'      => $post_type,
  'post_status'    => 'publish',
  'order'          => 'DESC',
  'meta_key'       => 'hethens_vote_count',
  'orderby'        => 'meta_value_num date',
  //'date_query'     => array($date_query),
);
if( $date != "all" ) {
  $args['date_query'] = array($date_query);
}
$media_query = new WP_Query( $args );


?>

<div class="row">
  <div class="col-md-4">
    <div class="media-header">
      <h1>
        <?php echo roots_title(); ?>
      </h1>
      <?php if(!is_user_logged_in()): ?>
      <div class="media-widget">
        <?php asgard_registration(); ?>
      </div>
      <?php endif ?>
      <?php
        if( $post_type == "image" ) {
          $submit_page_id = get_theme_mod('submit_image_page');
        } elseif( $post_type == "video" ) {
          $submit_page_id = get_theme_mod('submit_video_page');
        } elseif( $post_type == "link" ) {
          $submit_page_id = get_theme_mod('submit_link_page');
        } else {
          $submit_page_id = get_theme_mod('contribute_page');
        }
      ?>
      <p><a href="<?php echo get_permalink($submit_page_id) ?>" class="btn btn-primary btn-block"><i class="fa fa-plus-circle"></i> Submit <?php echo ucfirst($post_type) ?></a></p>
      <hr>
      <h2 class="h4">Filter</h2>
      <div class="form-group">
        <?php the_category_filter($post_type); ?>
      </div>
      <div class="form-group">
        <?php the_type_filter($post_type) ?>
      </div>
      <div class="form-group">
        <?php the_date_filter($post_type, $date) ?>
      </div>
    </div>
  </div>
  <div class="col-md-8">
    <div style="padding:30px 0">
    <?php if (!$media_query->have_posts()) : ?>
      <div class="alert alert-warning">
        <?php _e('Sorry, no results were found.', 'roots'); ?>
      </div>
      <?php get_search_form(); ?>
    <?php endif; ?>
    <?php while ($media_query->have_posts()) : $media_query->the_post(); ?>
      <?php get_template_part('templates/content', get_post_format()); ?>
    <?php endwhile; ?>
    </div>
  </div>
</div>

<?php if ($wp_query->max_num_pages > 1) : ?>
  <nav class="post-nav">
    <ul class="pager">
      <li class="previous"><?php next_posts_link(__('&larr; Older posts', 'roots')); ?></li>
      <li class="next"><?php previous_posts_link(__('Newer posts &rarr;', 'roots')); ?></li>
    </ul>
  </nav>
<?php endif; ?>
