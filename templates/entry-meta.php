<time class="published" datetime="<?php echo get_the_time('c'); ?>"><?php echo get_the_date(); ?></time>
<p class="byline author vcard"><?php echo __('By', 'roots'); ?> <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" rel="author" class="fn"><?php echo get_the_author(); ?></a></p>

<?php
$categories = get_the_terms( $post->ID, 'category' );
if( count($categories) > 0 ) {
  echo '<p>';
  foreach($categories as $cat){
    echo '<a class="label label-primary" href="'. home_url('category/'. $cat->slug . '?post_type=' . get_post_type()) .'">' . $cat->name . '</a> ';
  }
  echo '</p>';
}
?>
