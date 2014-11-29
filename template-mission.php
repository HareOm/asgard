<?php
/*
Template Name: Mission
*/
?>

<article id="post-<?php the_ID(); ?>">

  <div class="mission-section ms-dark">
    <div class="container">
      <header class="ms-header">
        <?php the_content() ?>
      </header>
      <div class="ms-freedomculture">
        <div class="ms-fc-vid">
          <div class="vid-res"><?php
          $vid = get_field("featured_video");
          echo wp_oembed_get($vid,'365','648');
          ?></div>
        </div>
        <div class="ms-fc-def">
          <h2><i class="fa fa-info-circle"></i> Freedom Culture</h2>
          <p>A collective state of being that empowers and encourages all individuals to contribute their unique gifts to the world.
          <p>Through ecologically sustainable lifestyles, economic self-reliance in local communities, and global collaborative action for the benefit of all, freedom culture can become the new normal.
        </div>
      </div>
      <p class="ms-liaison"><a href="#ms-cta" class="btn btn-lg btn-primary">Here's how <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <section id="ms-cta" class="mission-section ms-lime">
    <div class="container text-center">
      <p>Play a part in making sustainability mainstream and proliferating<br>Freedom Culture by <strong>sharing this movement</strong> with others
      <p>
        <div class="juicy-btn-group">
          <div class="juicy-cta-btn">
            <i class="fa fa-facebook"></i>
            <div class="fb-like" data-href="https://www.facebook.com/valhalla.movement" data-width="80" data-layout="button" data-action="like" data-show-faces="false" data-share="true"></div>
          </div>
          <div class="juicy-cta-btn">
            <i class="fa fa-google-plus"></i>
            <div class="g-plusone" data-size="medium" data-annotation="none"></div>
          </div>
          <a href="/index.php?page_id=86" class="juicy-cta-btn">Help Out <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </p>
    </div>
  </section>
  <?php
    $args = array(
      'posts_per_page'   => -1,
      'orderby'          => 'menu_order',
      'order'            => 'ASC',
      'post_type'        => 'page',
      'post_parent'      => get_the_ID(),
      'post_status'      => 'publish',
      'suppress_filters' => true
    );
    $sections = get_posts($args);

    foreach($sections as $section):

    $bg = 'light';
    if(get_post_meta($section->ID,'background', TRUE)) {
      $bg = get_post_meta($section->ID,'background', TRUE);
    }

    $icon = FALSE;
    if(get_post_meta($section->ID,'icon', TRUE)) {
      $icon = ' <i class="fa fa-'.get_post_meta($section->ID,'icon', TRUE).'"></i>';
    }

  ?>
  <section class="mission-section ms-<?php echo $bg ?>">
    <div class="container">
      <h1>
        <?php
          if( has_post_thumbnail($section->ID) ) {
            echo get_the_post_thumbnail($section->ID) . "<br>";
          } elseif($icon) {
            echo $icon;
          }

          echo $section->post_title;
        ?>
      </h1>
      <?php echo $section->post_content ?>
    </div>
  </section>
  <?php endforeach ?>

</article>

<script>
jQuery(document).ready(function($) {
$('a[href*=#]:not([href=#])').click(function() {
  if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
    var target = $(this.hash);
    target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
    if (target.length) {
      $('html,body').animate({
        scrollTop: target.offset().top
      }, 1000);
      return false;
    }
  }
});
});
</script>
