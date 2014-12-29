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
} else {
  $date_query = array();
}

$args = array(
  'post_type'      => $post_type,
  'post_status'    => 'publish',
  'order'          => 'DESC',
  'meta_key'       => 'hethens_vote_count',
  'orderby'        => 'meta_value_num date',
  'date_query'     => array($date_query),
);
$media_query = new WP_Query( $args );


?>

<div class="row">
  <div class="col-md-4">
    <div class="media-header">
      <h1>
        <?php echo roots_title(); ?>
      </h1>
      <?php
        if( $post_type == "image" ) {
          $submit_page_id = 5102;
        } elseif( $post_type == "video" ) {
          $submit_page_id = 5425;
        } else {
          $submit_page_id = 5437; //contribute page
        }
      ?>
      <p><a href="<?php echo get_permalink($submit_page_id) ?>" class="btn btn-primary btn-block"><i class="fa fa-plus-circle"></i> Submit <?php echo ucfirst($post_type) ?></a></p>
      <div class="form-group">
        <?php the_category_filter($post_type); ?>
      </div>
      <div class="form-group">
        <?php the_type_filter($post_type) ?>
      </div>
      <div class="form-group">
        <?php the_date_filter($post_type) ?>
      </div>
      <?php dynamic_sidebar('sidebar-media'); ?>
    </div>
  </div>
  <div class="col-md-8">
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

<?php if ($wp_query->max_num_pages > 1) : ?>
  <nav class="post-nav">
    <ul class="pager">
      <li class="previous"><?php next_posts_link(__('&larr; Older posts', 'roots')); ?></li>
      <li class="next"><?php previous_posts_link(__('Newer posts &rarr;', 'roots')); ?></li>
    </ul>
  </nav>
<?php endif; ?>
