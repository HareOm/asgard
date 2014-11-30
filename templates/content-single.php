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
        if( get_post_type() == "video" ):
          $video_url = get_post_meta($post->ID, "video_url", true);
          $video_url = urldecode($video_url);
          $video_embed = wp_oembed_get($video_url);
      ?>
      <div class="the-video vid-res">
        <?php echo $video_embed; ?>
      </div>

      <?php elseif( has_post_thumbnail() ): ?>
      <div class="the-image">
        <?php the_post_thumbnail() ?>
      </div>
      <?php endif ?>

      <?php if( $post->post_content != "" ): ?>
      <div class="entry-content">
        <?php the_content(); ?>
      </div>
      <?php endif ?>

      <footer>
        <?php wp_link_pages(array('before' => '<nav class="page-nav"><p>' . __('Pages:', 'roots'), 'after' => '</p></nav>')); ?>
      </footer>
      <?php comments_template('/templates/comments.php'); ?>
    </div>
  </article>
<?php endwhile; ?>
