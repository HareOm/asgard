<?php the_type_filter($post_type) ?>
<hr>
<?php the_date_filter($post_type) ?>
<hr>
<?php the_category_filter($post_type); ?>

<?php dynamic_sidebar('sidebar-primary'); ?>
