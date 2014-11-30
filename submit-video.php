<?php
/*
Template Name: Video Submit
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

  <div class="alert alert-success center module">Your video has been successfully submitted! It will go live once it's been approved.</div>

  <?php endif ?>

  <?php if ( current_user_can('edit_posts') ): ?>

<form enctype="multipart/form-data" action="<?php echo get_template_directory_uri(); ?>/lib/submitContent.php" method="POST" id="video-submit">

  <div class="form-group">
    <input class="form-control input-lg moduleTight" type="text" id="url" placeholder="Video URL, eg. http://youtube.com/?v=h4jdfk3k4k" name="video_url"/>
  </div>

  <div class="form-group">
    <label>Title</label>
    <input minlength="3" maxlength="155" class="input-lg form-control required" type="text" title="Title" name="title" id="title"/>
  </div>
  <div class="form-group">
    <label>Description</label>
    <textarea minlength="12" class="form-control required" maxlength="155" name="excerpt" placeholder="Enter a quick but useful description..." id="description"></textarea>
  </div>
  <div class="form-group">
    <label for="cat">Choose a category:</label>
    <select id="cat" name="cat" required>
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

  <input name="type" type="hidden" value="video"/>
  <input name="return" type="hidden" value="<?php the_permalink() ?>"/>
  <?php wp_nonce_field( 'submit_video' ); ?>

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
