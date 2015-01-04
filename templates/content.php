<article <?php post_class("article-item"); ?>>
  <div class="article-item-meta">
    <div class="vote">
    <?php if(function_exists('the_voting_html')){
        echo get_the_voting_html(false);
    } ?>
    </div>
    <a href="<?php the_permalink(); ?>#comments" class="article-item-meta-comments">
      <i class="fa fa-comment-o"></i>
      <?php if( get_comments_number() > 0 ) echo get_comments_number(); ?>
    </a>
    <a href="<?php the_permalink(); ?>" class="article-item-meta-link"><i class="fa fa-link"></i></a>
  </div>
  <a href="<?php the_permalink(); ?>">
    <?php
      if(has_post_thumbnail()) {
        the_post_thumbnail('thumbnail');
      }
    ?>
    <div class="article-item-content">
      <header>
        <h2 class="article-item-title"><?php the_title(); ?></h2>
      </header>
      <?php the_excerpt(); ?>
    </div>
  </a>
</article>
