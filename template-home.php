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
    <div class="container">
      <p><?php echo $post->post_content ?></p>
    </div>
  </div>
  <?php if( get_field("has_video") == 1 ): ?>
  <a href="<?php the_field("video_url") ?>" class="home-splash-watch">
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
<section>
  <div class="home-map" id="map-canvas"></div>
</section>
