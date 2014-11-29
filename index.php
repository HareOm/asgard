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

$args = array(
  'post_type'      => $post_type,
	'post_status'    => 'publish',
	'orderby'        => 'date',
	'order'          => 'DESC',
  'cat'            => $category,
	'date_query'     => array($date_query),
);
$the_query = new WP_Query( $args );

?>
<div class="page-header">
  <div class="pull-right form-inline">
    <?php the_category_filter($post_type); ?>
    <?php the_type_filter($post_type) ?>
    <?php the_date_filter($post_type) ?>
  </div>
  <h1>
    <?php echo roots_title(); ?>
  </h1>
</div>


<?php if (!$the_query->have_posts()) : ?>
  <div class="alert alert-warning">
    <?php _e('Sorry, no results were found.', 'roots'); ?>
  </div>
  <?php get_search_form(); ?>
<?php endif; ?>

<?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
  <?php get_template_part('templates/content', get_post_format()); ?>
<?php endwhile; ?>

<?php if ($wp_query->max_num_pages > 1) : ?>
  <nav class="post-nav">
    <ul class="pager">
      <li class="previous"><?php next_posts_link(__('&larr; Older posts', 'roots')); ?></li>
      <li class="next"><?php previous_posts_link(__('Newer posts &rarr;', 'roots')); ?></li>
    </ul>
  </nav>
<?php endif; ?>
