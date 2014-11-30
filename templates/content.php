<article <?php post_class("article-item"); ?>>
  <div class="article-item-meta">
    <div class="vote">
    <?php if(function_exists('the_voting_html')){
        echo get_the_voting_html(false);
    } ?>
    </div>
    <a href="<?php the_permalink(); ?>" class="article-item-meta-link"><i class="fa fa-link"></i></a>
  </div>
  <?php
    if(has_post_thumbnail()) {
      the_post_thumbnail('thumbnail');
    }
  ?>
  <a href="<?php the_permalink(); ?>" class="article-item-content">
    <header>
      <h2 class="article-item-title"><?php the_title(); ?></h2>
    </header>
    <?php the_excerpt(); ?>
  </a>
</article>
