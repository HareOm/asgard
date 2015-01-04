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
    $post_image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large' );
    $post_image_src = $post_image[0];
    $ft_post_id = $post->ID;
    ?>
    <li style="background-image: url(<?php echo $post_image_src ?>)">
      <a href="<?php echo get_permalink($post->ID) ?>">
        <i class="fa fa-star"></i>
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
      <a href="<?php echo get_permalink($post->ID) ?>">
        <i class="fa fa-video-camera"></i>
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
      <a href="<?php echo get_permalink($post->ID) ?>">
        <i class="fa fa-image"></i>
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
      <a href="<?php echo get_permalink($post->ID) ?>">
        <i class="fa fa-file-text"></i>
        <span><?php echo get_the_title($post->ID) ?></span>
      </a>
    </li>
    <li>
      <a href="#">
        <span>Read More</span>
      </a>
    </li>
  </ul>
</section>
<section class="home-network">
  <h1>The Valhalla Movement's Network</h1>
  <p class="lead">Valhalla's network of sustainable communities, sister and child organizations, are growing everyday.</p>
  <p style="margin-bottom:30px"><a href="<?php echo home_url('index.php?page_id=5097') ?>" class="btn btn-primary btn-lg">Learn More</a></p>
  <div class="home-map" id="map-canvas"></div>
</section>
<script>
//GMAPS

   var locations = [
      ['Valhalla Montreal', 45.400914, -73.376678, 3],
      ['Sirius Community', 42.421172,-72.423914, 3],
      ['Valhalla Arizona', 34.1682185,-111.930907, 3]
    ];

   var map = new google.maps.Map(document.getElementById('map-canvas'), {
      zoom: 4,
      center: new google.maps.LatLng(45.400914, -73.376678),
      scrollwheel: false,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    });

    var infowindow = new google.maps.InfoWindow();

    var marker, i;

    for (i = 0; i < locations.length; i++) {
      marker = new google.maps.Marker({
        position: new google.maps.LatLng(locations[i][1], locations[i][2]),
        map: map
      });

      google.maps.event.addListener(marker, 'click', (function(marker, i) {
        return function() {
          infowindow.setContent(locations[i][0]);
          infowindow.open(map, marker);
        }
      })(marker, i));
    }
</script>
