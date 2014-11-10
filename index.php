<?php get_template_part('templates/page', 'header'); ?>

<?php if (!have_posts()) : ?>
  <div class="alert alert-warning">
    <?php _e('Sorry, no results were found.', 'roots'); ?>
  </div>
  <?php get_search_form(); ?>
<?php endif; ?>


<?php
$post_type = get_post_type();
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

  ?>
  <li<?php if($post_type == $pt) echo ' class="active"' ?>><a href="#"><?php echo $name ?></a>
  <?php endif ?>
<?php endforeach; ?>
</ul>


<hr>
<?php
$term = get_query_var( "term" );
$filters = get_terms_by_post_type(array("category"), array(get_post_type()));
?>

<ul class="nav nav-pills" role="tablist">
<?php foreach($filters as $filter): ?>
  <li<?php if($term == $filter->slug) echo ' class="active"' ?>><a href="<?php echo get_term_link($filter) ?>"><?php echo $filter->name ?></a>
<?php endforeach; ?>
</ul>


<?php while (have_posts()) : the_post(); ?>
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
