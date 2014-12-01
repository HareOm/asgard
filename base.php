<?php get_template_part('templates/head'); ?>
<body <?php body_class(); ?>>
  <?php do_action('after_body_open') ?>
  <!--[if lt IE 8]>
    <div class="alert alert-warning">
      <?php _e('You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.', 'roots'); ?>
    </div>
  <![endif]-->

  <?php
    do_action('get_header');
    // Use Bootstrap's navbar if enabled in config.php
    if (current_theme_supports('bootstrap-top-navbar')) {
      get_template_part('templates/header-top-navbar');
    } else {
      get_template_part('templates/header');
    }

  ?>

  <?php if( !in_array(get_page_template_slug(), $asgard_full_width_templates) ): //full width ?>
  <div class="wrap container" role="document">
    <div class="content row">
      <main class="main <?php echo apply_filters('roots/main_class'); ?>" role="main">
        <?php include roots_template_path(); ?>
      </main><!-- /.main -->
      <?php if (roots_display_sidebar()) : ?>
        <aside class="sidebar <?php echo apply_filters('roots/sidebar_class'); ?>" role="complementary">
          <?php include roots_sidebar_path(); ?>
        </aside><!-- /.sidebar -->
      <?php endif; ?>
    </div><!-- /.content -->
  </div><!-- /.wrap -->
  <?php else: ?>
  <div role="document">
    <div class="content">
      <main class="main" role="main">
        <?php include roots_template_path(); ?>
      </main><!-- /.main -->
    </div><!-- /.content -->
  </div><!-- /.wrap -->
  <?php endif ?>

  <?php get_template_part('templates/footer'); ?>
</body>
</html>
