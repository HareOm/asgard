<?php
/*

  Template Name: m-helpout

*/
?>

<div class="entry-header">
  <h1><?php the_title() ?></h1>
</div>
<section class="m-helpout">
  <nav class="m-helpout-nav">
    <ul>
      <li class="nav prev"><i class="fa fa-chevron-left"></i>
      <li>Follow
      <li>Spread the Word
      <li>Use Our Media
      <li>Donate
      <li class="nav next"><i class="fa fa-chevron-right"></i>
    </ul>
  </nav>

  <section class="step">

    <h1>Follow <small>Stay Up to Date</small></h1>

    <div class="m-helpout-follow">
      <div class="m-helpout-follow-widgets">
        <h2><i class="fa fa-share-alt"></i> Our Social Networks</h2>
        <p>Get news, updates and media through the big three:</p>
        <ul class="m-helpout-follow-social">
          <li><div class="fb-like" data-href="https://www.facebook.com/valhalla.movement" data-width="80" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div>
          <li><a href="https://twitter.com/govalhalla" class="twitter-follow-button" data-show-count="false" data-lang="en">Follow @govalhalla</a>
          <li><div class="g-follow" data-annotation="none" data-height="20" data-href="https://plus.google.com/114507753098106674242" data-rel="publisher"></div>
        </ul>

        <div style="margin-top:40px">
          <h2><i class="fa fa-envelope"></i> A Reliable Email Newsletter</h2>
          <p>Get only the juiciest of updates:</p>
          <form method="post" class="m-helpout-signup">
            <input id="m-helpout_subscribe" name="email_subscribe" type="text" placeholder="your-email@example.com" class="required">
            <input style="display:none;" type="checkbox" id="list_738915" name="lists[]" value="800024" checked="checked">
          	<input style="display:none;" id="volunteer_check" name="lists[]" value="837226" type="checkbox" checked="checked">
            <input id="webform_submit_button" value="Subscribe Via Email" type="submit" data-default-text="Subscribe Via Email" data-submitting-text="Submitting.." data-invalid-text="You forgot some required fields">
          </form>
        </div>
      </div>
      <div class="m-helpout-follow-video">
        <h2><i class="fa fa-film"></i> Video <a href="http://www.youtube.com/subscription_center?add_user=TheValhallaMovement"><img src="<?php echo get_stylesheet_directory_uri() ?>/assets/img/youtube_subscribe.png" width="109" alt="Youtube Subscribe"></a></h2>
        <p class="small-text">Valhalla is constantly working at creating high quality content to keep you up to date with your progress, expose you to new ways of thinking, and entertain you while remaining informative.
        <p><a href="http://www.youtube.com/user/TheValhallaMovement" target="_blank" class="m-helpout-btn m-helpout-btn-block"><i class="fa fa-youtube">Youtube</i> Channel</a>

        <h3>Podcasts</h3>
        <p class="small-text">Rate Comment & Subscribe to Valhalla's Superhero Academy Podcast
        <p><a href="https://itunes.apple.com/ca/podcast/valhallas-superhero-academy/id888603342?mt=2&uo=4" class="m-helpout-btn m-helpout-btn-block"><img src="<?php echo get_stylesheet_directory_uri() ?>/assets/img/itunes.png" height="40" alt="Itunes"></a>
      </div>
    </div>

  </section>

  <section class="step">

    <h1>Spread the Word <small>Share on</small></h1>
    <div class="m-helpout-spread">
      <ul>
        <li><a href="javascript:;" class="m-helpout-share" data-rel="facebook"><i class="fa fa-facebook"></i> <span class="hidden-access">Facebook</span></a>
        <li><a href="javascript:;" class="m-helpout-share" data-rel="twitter"><i class="fa fa-twitter"></i> <span class="hidden-access">Twitter</span></a>
        <li><a href="javascript:;" class="m-helpout-share" data-rel="googleplus"><i class="fa fa-google-plus"></i> <span class="hidden-access">Google+</span></a>
      </ul>
      <textarea id="m-helpout-message">Check out @GoValhalla -- they're trying to make sustainable communal living mainstream! http://youtu.be/pg4v035zGjA</textarea>
    </div>

  </section>

  <section class="step">

    <h1>Use Our Media</h1>
    <div class="m-helpout-media">
      <a href="<?php echo home_url("valhalla-graphics.zip") ?>"><span>Download Media Package</span></a>
      <p class="small-text center"><strong>Includes:</strong> Facebook Cover Photo, Twitter Cover Photo, Google Plus Cover Photo, Logos of all shapes and sizes!
    </div>

  </section>

  <section class="step">

    <h1>Donate <small>and receive the solar shed plans!</small></h1>
    <div class="m-helpout-donate">
      <p><a href="https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=info%40valhallamovement%2ecom&lc=US&item_name=Valhalla%20Movement&no_note=0&currency_code=USD&bn=PP%2dDonationsBF%3abtn_donateCC_LG%2egif%3aNonHostedGuest" class="m-helpout-btn">Donate <i class="fa fa-heart"></i></a>
      <p>Donate to help us grow and you'll receive<br> our <strong>Farm of the Future Greenhouse Plans</strong> by entering your email below.

      <form  accept-charset="UTF-8" action="https://madmimi.com/signups/subscribe/116070" method="post" target="_blank" class="m-helpout-signup">
        <input id="signup_email" name="signup[email]" type="text" data-required-field="This field is required" placeholder="you@example.com" class="required"/>
        <input name="utf8" type="hidden" value="✓"/>
        <input name="authenticity_token" type="hidden" value="koCHtDE5F6ssVOJILNMH17QnMF+JvATRouyaeP+Oa9U="/>
        <input id="webform_submit_button" value="Subscribe Via Email" type="submit" data-default-text="Subscribe Via Email" data-submitting-text="Submitting.." data-invalid-text="You forgot some required fields">
      </form>
    </div>

  </section>


</section>
