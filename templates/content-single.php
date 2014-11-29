<?php while (have_posts()) : the_post(); ?>
  <article <?php post_class("row"); ?>>
    <div class="col-sm-12">
      <header class="entry-header">
        <h1 class="entry-title"><?php the_title(); ?></h1>
        <?php get_template_part('templates/entry-meta'); ?>
      </header>
    </div>
    <div class="col-md-8 col-md-offset-2">
      <?php
      $pf = get_post_format();
      var_dump($pf);
      ?>
      <?php if( get_post_format() == "video" ): ?>
        video
      <?php endif ?>
      <div class="entry-content">
        <?php the_content(); ?>
      </div>
      <footer>
        <?php wp_link_pages(array('before' => '<nav class="page-nav"><p>' . __('Pages:', 'roots'), 'after' => '</p></nav>')); ?>
      </footer>
      <?php comments_template('/templates/comments.php'); ?>
    </div>
  </article>
<?php endwhile; ?>
