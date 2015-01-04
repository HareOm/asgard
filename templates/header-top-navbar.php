<header class="banner" role="banner">
  <div class="nav-para">
    <div class="container">
    <?php
      if (has_nav_menu('secondary_navigation')) :
        wp_nav_menu(array('theme_location' => 'secondary_navigation', 'menu_class' => 'list-inline' ));
      endif;
    ?>
    </div>
  </div>
  <div class="navbar navbar-inverse navbar-asgard navbar-static-top">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="<?php echo home_url(); ?>/"><?php bloginfo('name'); ?></a>
        <div class="navbar-text">
          <h2 class="site-tagline"><a href="<?php echo home_url('index.php?page_id=3700') ?>"><?php bloginfo('description') ?></a></h2>
        </div>
      </div>

      <nav class="collapse navbar-collapse navbar-right" role="navigation">
        <?php
          if (has_nav_menu('primary_navigation')) :
            wp_nav_menu(array('theme_location' => 'primary_navigation', 'menu_class' => 'nav navbar-nav'));
          endif;
        ?>
      </nav>
    </div>
  </div>
</header>
