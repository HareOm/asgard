<header class="banner" role="banner">
  <div class="container">
    <div class="nav-para">
    <?php
      if (has_nav_menu('secondary_navigation')) :
        wp_nav_menu(array('theme_location' => 'secondary_navigation', 'menu_class' => 'list-inline' ));
      endif;
    ?>
    </div>
  </div>
  <div class="navbar navbar-default navbar-static-top">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="<?php echo home_url(); ?>/"><?php bloginfo('name'); ?></a>
      </div>

      <div class="navbar-right" role="navigation">
        <?php
          if (has_nav_menu('logged_navigation')) :
            wp_nav_menu(array('theme_location' => 'submit_navigation', 'menu_class' => 'nav navbar-nav'));
          endif;
        ?>
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
