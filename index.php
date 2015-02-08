<?php
//SET UP VARS
$post_type = get_post_type();

$date = $_GET['date'];
$today = getdate();
$category = get_query_var('cat');

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

$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;

$args = array(
  'post_type'      => $post_type,
	'post_status'    => 'publish',
	'orderby'        => 'date',
	'order'          => 'DESC',
  'cat'            => $category,
	'date_query'     => array($date_query),
  'paged'          => $paged
);
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
      <h3>Submit</h3>
      <div class="btn-group btn-group-justified">
        <a href="<?php echo get_permalink(5437) ?>" class="btn btn-default btn-sm"><i class="fa fa-file-text"></i> Article</a>
        <a href="<?php echo get_permalink(5425) ?>" class="btn btn-default btn-sm"><i class="fa fa-video-camera"></i> Video</a>
        <a href="<?php echo get_permalink(5490) ?>" class="btn btn-default btn-sm"><i class="fa fa-image"></i> Image</a>
        <a href="<?php echo get_permalink(5466) ?>" class="btn btn-default btn-sm"><i class="fa fa-link"></i> Link</a>
      </div>
      <hr>
      <h2 class="h4">Filter</h2>
      <div class="form-group">
        <?php the_category_filter(); ?>
      </div>
      <div class="form-group">
        <?php the_type_filter("all") ?>
      </div>
      <div class="form-group">
        <?php the_date_filter() ?>
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
