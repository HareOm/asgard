<article <?php post_class("row"); ?>>
  <div class="col-md-3">
    <div class="votes">
        <?php if(function_exists('the_voting_html')){
            echo get_the_voting_html(false);
        } ?>
    </div>
  </div>
  <div class="col-md-9">
    <header>
      <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
      <?php get_template_part('templates/entry-meta'); ?>
    </header>
    <div class="entry-summary">
      <?php the_excerpt(); ?>
    </div>
  </div>
</article>
