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

?>
<?php get_template_part('templates/page', 'header'); ?>

<?php

$query = array(
  "post_type" => $post_type,
  "orderby" => "date",
  "order" => "DESC"
);
$media_query = new WP_Query($query);

?>

<?php if (!$media_query->have_posts()) : ?>
  <div class="alert alert-warning">
    <?php _e('Sorry, no results were found.', 'roots'); ?>
  </div>
  <?php get_search_form(); ?>
<?php endif; ?>

<?php the_date_filter($post_type) ?>
<hr>
<?php the_type_filter($post_type) ?>
<hr>
<?php the_category_filter($post_type); ?>

<?php while ($media_query->have_posts()) : $media_query->the_post(); ?>
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
