<?php
/*
Template Name: Home
*/
?>
<?php
  $image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
?>
<div class="home-splash" style="background-image:url(<?php echo $image ?>)">
  <div class="home-splash-tagline">
    <p><?php echo $post->post_content ?></p>
  </div>
  <?php if( get_field("has_video") == 1 ): ?>
  <a href="<?php the_field("video_url") ?>" class="home-splash-watch" data-toggle="lightbox">
    <i class="fa fa-youtube-play"></i>
    <span>Watch Video</span>
  </a>
  <?php endif ?>
</div>

<section class="home-signup">
  <h1>Stay Updated on the Movement</h1>
  <p class="lead">Oh, and if you want free plans to an Earthship Greenhouse, sign up below!</p>
  <form accept-charset="UTF-8" action="https://madmimi.com/signups/subscribe/116070" method="post" target="_blank">
    <input name="utf8" type="hidden" value="✓">
    <input name="authenticity_token" type="hidden" value="koCHtDE5F6ssVOJILNMH17QnMF+JvATRouyaeP+Oa9U=">
    <div class="input-group">
		  <input id="signup_email" name="signup[email]" type="text" data-required-field="This field is required" placeholder="you@example.com" class="required form-control">
		  <span class="input-group-btn">
			  <input id="webform_submit_button" value="Subscribe Via Email" type="submit" class="btn btn-primary">
		  </span>
		</div>
  </form>
  <p>
  	<div class="fb-like" data-href="http://facebook.com/valhalla.movement" data-send="true" data-layout="button_count" data-width="450" data-show-faces="false"></div>
   	<a href="https://twitter.com/share" class="twitter-share-button" data-url="http://valhallamovement.com" data-text="The Valhalla Movement" data-related="govalhalla">Tweet</a>
  </p>
</div>
</section>
<section class="home-media">
  <ul>
    <?php $ft_post = get_field("featured_post") ?>
    <?php
    if( $ft_post ) {
      $post = $ft_post;
    } else {
      $post = get_posts(
        array(
          'posts_per_page'   => 1,
          'meta_key'         => '_thumbnail_id',
          'post_type'        => 'post',
          'post_status'      => 'publish' )
      );
      $post = array_shift($post);
    }
    $post_image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'medium' );
    $post_image_src = $post_image[0];
    $ft_post_id = $post->ID;
    ?>
    <li style="background-image: url(<?php echo $post_image_src ?>)">
      <h2 class="home-media-title">Featured</h2>
      <a href="<?php echo get_permalink($post->ID) ?>">
        <span><?php echo get_the_title($post->ID) ?></span>
      </a>
    </li>
    <?php
      $post = get_posts(
        array(
          'posts_per_page'   => 1,
          'meta_key'         => '_thumbnail_id',
          'post_type'        => 'video',
          'post_status'      => 'publish' )
      );
      $post = array_shift($post);
      $post_image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'medium' );
      $post_image_src = $post_image[0];
    ?>
    <li style="background-image: url(<?php echo $post_image_src ?>)">
      <h2 class="home-media-title">Video</h2>
      <a href="<?php echo get_permalink($post->ID) ?>">
        <span><?php echo get_the_title($post->ID) ?></span>
      </a>
    </li>
    <?php
      $post = get_posts(
        array(
          'posts_per_page'   => 1,
          'meta_key'         => '_thumbnail_id',
          'post_type'        => 'image',
          'post_status'      => 'publish' )
      );
      $post = array_shift($post);
      $post_image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'medium' );
      $post_image_src = $post_image[0];
    ?>
    <li style="background-image: url(<?php echo $post_image_src ?>)">
      <h2 class="home-media-title">Image</h2>
      <a href="<?php echo get_permalink($post->ID) ?>">
        <span><?php echo get_the_title($post->ID) ?></span>
      </a>
    </li>
    <?php
      $post = get_posts(
        array(
          'posts_per_page'   => 1,
          'meta_key'         => '_thumbnail_id',
          'post_type'        => 'post',
          'exclude'          => array($ft_post_id),
          'post_status'      => 'publish' )
      );
      $post = array_shift($post);
      $post_image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'medium' );
      $post_image_src = $post_image[0];
    ?>
    <li style="background-image: url(<?php echo $post_image_src ?>)">
      <h2 class="home-media-title">Article</h2>
      <a href="<?php echo get_permalink($post->ID) ?>">
        <span><?php echo get_the_title($post->ID) ?></span>
      </a>
    </li>
    <li>
      <h2 class="home-media-title">More</h2>
      <a href="#">
        <span>Read More</span>
      </a>
    </li>
  </ul>
</section>
<section class="home-network">
  <h1>The Valhalla Movement's Network</h1>
  <p class="lead">Valhalla's network of sustainable communities, sister and child organizations, are growing everyday.</p>
  <p><a href="#" class="btn btn-primary btn-lg">Learn More</a></p>
  <div class="home-map" id="map-canvas"></div>
</section>
<script>
//GMAPS
function initialize() {
  var myLatlng = new google.maps.LatLng(45.400914, -73.376678);
  var mapOptions = {
    scrollwheel: false,
    zoom: 12,
    center: myLatlng
  };
  var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

  var marker = new google.maps.Marker({
      position: myLatlng,
      map: map,
      title: 'Hello World!'
  });
}

function loadScript() {
  var script = document.createElement('script');
  script.type = 'text/javascript';
  script.src = 'https://maps.googleapis.com/maps/api/js?v=3.exp&' +
      'callback=initialize';
  document.body.appendChild(script);
}

window.onload = loadScript;
</script>
