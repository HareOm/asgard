<?php
/*
  
  Template Name: Manifesto
  
*/
?>
<div class="faq container cf">
  <h1 class="page-title page-title-lined"><?php the_title() ?></h1>
  <nav id="nav-faq" class="nav-faq">
    <ol>
    <?php 
    $args=array(
      'post_type'         => 'manifesto',
      'orderby'           => 'menu_order',
      'order'             => 'ASC',
      'post_parent'       => 0,
      'posts_per_page'    => -1    
    );
    $parent_query = null;
    $parent_query = new WP_Query($args);
    ?>
    <?php while ( $parent_query->have_posts() ) : $parent_query->the_post(); ?>
    <?php if( $post->menu_order != 0 ): ?>    
    <li><a href="#<?php echo $post->post_name ?>"><span><?php echo $post->menu_order ?></span><?php the_title() ?></a>
      <?php 
      $args=array(
        'post_type'         => 'manifesto',
        'orderby'           => 'menu_order',
        'order'             => 'ASC',
        'post_parent'       => $post->ID,
        'posts_per_page'    => -1    
      );
      $child_query = null;
      $child_query = new WP_Query($args);
      if( $child_query->have_posts() ) echo "<ol>";
      ?>      
      <?php while ( $child_query->have_posts() ) : $child_query->the_post(); ?>
        <?php if( $post->menu_order != 0 ): ?>
        <li><a href="#<?php echo $post->post_name ?>"><?php the_title() ?></a>
          <?php 
          $args=array(
            'post_type'         => 'manifesto',
            'orderby'           => 'menu_order',
            'order'             => 'ASC',
            'post_parent'       => $post->ID,
            'posts_per_page'    => -1    
          );
          $grandchild_query = null;
          $grandchild_query = new WP_Query($args);
          if( $grandchild_query->have_posts() ) echo "<ol>";
          ?>
          <?php while ( $grandchild_query->have_posts() ) : $grandchild_query->the_post(); ?>
            <?php if( $post->menu_order != 0 ): ?>
            <li><a href="#<?php echo $post->post_name ?>"><?php the_title() ?></a>
        		<?php endif ?>
          <?php 
            endwhile; //GrandChildren
            if( $grandchild_query->have_posts() ) echo "</ol>";
            // Reset Post Data
            wp_reset_postdata();      
          ?>  		    
    		<?php endif ?>
      <?php 
        endwhile; //Children
        // Reset Post Data
        if( $child_query->have_posts() ) echo "</ol>";
        wp_reset_postdata();      
      ?>
		<?php endif ?>
  <?php 
    endwhile; //Parents
    if( $parent_query->have_posts() ) echo "</ol>";
    // Reset Post Data
    wp_reset_postdata();      
  ?>
    </ol>
  </nav>
  
  <article>  
  <?php 
  $args=array(
    'post_type'         => 'manifesto',
    'orderby'           => 'menu_order',
    'order'             => 'ASC',
    'post_parent'       => 0,
    'posts_per_page'    => -1    
  );
  $parent_query = null;
  $parent_query = new WP_Query($args);
  ?>
  <?php while ( $parent_query->have_posts() ) : $parent_query->the_post(); ?>
    <?php if( $post->menu_order != 0 ): ?>
    
		<section id="<?php echo $post->post_name ?>" class="faq-parent-section">
		  <h1><span><?php echo $post->menu_order ?></span><?php the_title() ?></h1>
		  <?php the_content() ?>

      <?php 
      $args=array(
        'post_type'         => 'manifesto',
        'orderby'           => 'menu_order',
        'order'             => 'ASC',
        'post_parent'       => $post->ID,
        'posts_per_page'    => -1    
      );
      $child_query = null;
      $child_query = new WP_Query($args);
      ?>
      <?php while ( $child_query->have_posts() ) : $child_query->the_post(); ?>
        <?php if( $post->menu_order != 0 ): ?>
        <section id="<?php echo $post->post_name ?>" class="faq-child-section">
  		    <h1><span><?php echo $post->menu_order ?>.<?php the_title() ?></span></h1>
  		    <?php the_content() ?>
          <?php 
          $args=array(
            'post_type'         => 'manifesto',
            'orderby'           => 'menu_order',
            'order'             => 'ASC',
            'post_parent'       => $post->ID,
            'posts_per_page'    => -1    
          );
          $grandchild_query = null;
          $grandchild_query = new WP_Query($args);
          ?>
          <?php while ( $grandchild_query->have_posts() ) : $grandchild_query->the_post(); ?>
            <?php if( $post->menu_order != 0 ): ?>
            <section id="<?php echo $post->post_name ?>" class="faq-grandchild-section">
      		    <h1><?php echo $post->menu_order ?>. <?php the_title() ?></h1>
      		    <?php the_content() ?>
      		  </section>
        		<?php endif ?>
          <?php 
            endwhile; //GrandChildren
            // Reset Post Data
            wp_reset_postdata();      
          ?>
  		    
  		  </section>
    		<?php endif ?>
      <?php 
        endwhile; //Children
        // Reset Post Data
        wp_reset_postdata();      
      ?>
		  
		</section>
		<?php endif ?>
  <?php 
    endwhile; //Parents
    // Reset Post Data
    wp_reset_postdata();      
  ?>
  </article>

</div>
<script>
jQuery(document).ready(function($) {
    $("#nav-faq").sticky({topSpacing:20});
    
  	var lastId,
  		topMenu = $("#nav-faq"),
  		//topMenuHeight = topMenu.outerHeight(),
  		topMenuHeight = 20,
  		// All list items
  		menuItems = topMenu.find("a"),
  		// Anchors corresponding to menu items
  		scrollItems = menuItems.map(function(){
  		  var item = $($(this).attr("href"));
  		  if (item.length) { return item; }
  		});
  
  	// Bind click handler to menu items
  	// so we can get a fancy scroll animation
  	menuItems.click(function(e){
  	  var href = $(this).attr("href"),
  		  offsetTop = href === "#" ? 0 : $(href).offset().top-topMenuHeight+1;
  	  $('html, body').stop().animate({ 
  		  scrollTop: offsetTop
  	  }, 300);
  	  e.preventDefault();
  	});
  
  	// Bind to scroll
  	$(window).scroll(function(){
  	   // Get container scroll position
  	   var fromTop = $(this).scrollTop()+topMenuHeight;
     
  	   // Get id of current scroll item
  	   var cur = scrollItems.map(function(){
  		 if ($(this).offset().top < fromTop)
  		   return this;
  	   });
  	   // Get the id of the current element
  	   cur = cur[cur.length-1];
  	   var id = cur && cur.length ? cur[0].id : "";
       
  	   if (lastId !== id) {
  		   lastId = id;
  		   // Set/remove active class
  		   menuItems
  			 .parents("li").removeClass("active")
  			 .end().filter("[href=#"+id+"]").parents("li").addClass("active");
  	   }                   
  	});
  
    
  });  
</script>