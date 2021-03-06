<?php
//SET UP VARS
$post_type = array('post','image','video','link');

if( $_GET['date'] ) {
  $date = $_GET['date'];
} elseif(get_option('default_date')) {
  $date = get_option('default_date');
} else {
  $date = "all";
}

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
  'order'          => 'DESC',
  'meta_key'       => 'hethens_vote_count',
  'orderby'        => 'meta_value_num date',
  'cat'            => $category,
  'paged'          => $paged,
//  'date_query'     => array($date_query)
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
      <h3>Submit</h3>
      <div class="btn-group btn-group-justified">
        <a href="<?php echo get_permalink(get_theme_mod('contribute_page')) ?>" class="btn btn-default btn-sm"><i class="fa fa-file-text"></i> Article</a>
        <a href="<?php echo get_permalink(get_theme_mod('submit_video_page')) ?>" class="btn btn-default btn-sm"><i class="fa fa-video-camera"></i> Video</a>
        <a href="<?php echo get_permalink(get_theme_mod('submit_image_page')) ?>" class="btn btn-default btn-sm"><i class="fa fa-image"></i> Image</a>
        <a href="<?php echo get_permalink(get_theme_mod('submit_link_page')) ?>" class="btn btn-default btn-sm"><i class="fa fa-link"></i> Link</a>
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
        <?php the_date_filter(NULL, $date) ?>
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
