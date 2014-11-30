<?php
/*
Template Name: Images Submit
*/
?>
<section>
  <h1>Submit an Image</h1>
  <div class="entry-content">
    <?php if( isset( $_GET['post_id'] ) ): ?>
    <div class="alert alert-success">
      Image ( <?php echo $_GET['post_id'] ?> ) successfully submitted.
    </div>
    <?php endif ?>
    <form action="<?php echo get_stylesheet_directory_uri() ?>/lib/submit-content.php" method="post">
      <?php wp_nonce_field('asgard_image_submit', 'asgard_image_submit_nonce'); ?>
      <input type="hidden" value="image">
      <input type="hidden" name="return" value="<?php echo get_permalink( $post->ID ); ?>">
      <div class="form-group">
        <label for="post_thumbnail">Title</label>
        <input type="file" id="post_thumbnail" name="post_thumbnail" class="form-control">
      </div>
      <div class="form-group">
        <label for="post_title">Title</label>
        <input type="text" id="post_title" name="title" class="form-control">
      </div>
      <div class="form-group">
        <label for="post_description">Description</label>
        <textarea name="description" id="post_description" class="form-control"></textarea>
      </div>
      <div class="form-group">
        <select class="form-control" name="category">
        <?php
          $cats = get_categories(array('type' => 'image'));
          foreach($cats as $cat):
        ?>
        <option value="<?php echo $cat->term_id ?>"><?php echo $cat->name ?>
        <?php endforeach ?>
        </select>
      </div>
      <button type="submit" class="btn btn-primary btn-lg">Submit Image</button>
    </form>
  </div>
</section>
