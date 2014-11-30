<?php
/*
Template Name: Images Submit
*/
?>
<section class="col-md-8 col-md-offset-2">
  <h1 class="text-center"><?php the_title() ?></h1>
  <div class="entry-content">
  <?php
  $status = isset($_GET['status']) ? $_GET['status'] : '';
  if($status == 'error'):
  ?>

  <div class="alert alert-danger center module">Hmm something went wrong :( Please try submitting again.</div>

  <?php elseif($status == 'pending'): ?>

  <div class="alert alert-success center module">Your image has been successfully submitted! It will go live once it's been approved.</div>

  <?php endif ?>

  <?php if ( current_user_can('edit_posts') ): ?>

  <form enctype="multipart/form-data" action="<?php echo get_template_directory_uri(); ?>/lib/submitContent.php" method="POST" id="image-submit">

      <div class="form-group module">
        <label class="sr-only">Image Caption</label>
        <input placeholder="Image Caption" minlength="3" maxlength="<?php echo $options['titleMaxLength']; ?>" class="input-lg form-control required" type="text" title="Title" name="title" id="title"/>
      </div>
      <div class="form-group">
        <label>Choose a category:</label>
        <select class="form-control" name="cat" required>
            <option value=""></option>
            <?php
            $args = array(
                'orderby' => 'name',
                'order' => 'ASC',
                'hide_empty' => false
            );
            $categories = get_categories($args);
            foreach ($categories as $category) {
                $option = '<option value="'.$category->cat_ID.'">';
                $option .= $category->name;
                $option .= '</option>';
                echo $option;
            } ?>
        </select>
      </div>

      <div class="form-group center">
        <label for="file">Upload an image</label>
        <input id="file" type="file" name="image"/>
      </div>
      <input name="return" type="hidden" value="<?php the_permalink() ?>">
      <input name="type" type="hidden" value="image"/>
      <?php wp_nonce_field( 'submit_image' ); ?>
      <button class="btn btn-success btn-lg btn-block" type="submit">Submit</button>
  </form>

  <?php else: ?>

  <div class="alert alert-primary center">
    <h4>You must be be a <a href="<?php echo home_url('contribute') ?>">contributor</a> in order to post to Valhalla Movement!</h4>
    <p><a href="<?php echo home_url('contributors') ?>">Click here</a> to learn how to earn contributor status or <a href="<?php echo home_url('signin') ?>">sign in</a>.</p>
  </div>

  <?php endif ?>

  </div>
</section>
