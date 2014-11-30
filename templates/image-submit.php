<?php
/*
Template Name: Images Submit
*/
?>
<section class="col-md-8 col-md-offset-2">
  <h1 class="text-center">Submit an Image</h1>
  <div class="entry-content">
<?php
$status = isset($_GET['status']) ? $_GET['status'] : '';
if($status == 'error'){ ?>

    <div class="alert alert-danger center module">Hmm something went wrong :( Please try submitting again.</div>

<?php }elseif($status == 'pending'){ ?>

    <div class="alert alert-success center module">Your image has been successfully submitted! It will go live once it's been approved.</div>

<?php } ?>

<?php if ( current_user_can('edit_posts') || true ) { ?>

<div class="entry">
    <form enctype="multipart/form-data" action="<?php echo get_template_directory_uri(); ?>/lib/submitContent.php" method="POST" id="image-submit">

        <div id="preview">
            <div class="center module">
                <img class="imageEmbed"/>
            </div>
            <div class="form-group module">
                <label class="sr-only">Image Caption</label>
                <input placeholder="Image Caption" minlength="3" maxlength="<?php echo $options['titleMaxLength']; ?>" class="input-lg form-control required" type="text" title="Title" name="title" id="title"/>
            </div>
            <div class="form-group center module">
                <label style="font-size: 18px;"><b>Choose a category:</b></label>
                <select data-placeholder="Categories" class="required" name="cat">
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
            <button class="btn btn-success btn-xl btn-block" type="submit">Submit</button>
        </div>

        <div class="form-group center">
            <div class="relative embedContainer module">
                <input id="file" type="file" name="image"/>
                <button class="btn btn-primary btn-lg fileUpload">Upload an image</button>
            </div>
        </div>
        <input name="return" type="hidden" value="<?php the_permalink() ?>">
        <input name="type" type="hidden" value="image"/>
        <?php wp_nonce_field( 'submit_image' ); ?>

    </form>
</div>

<?php } else { ?>

<div class="alert alert-primary center">
    <h4>You must be be a <a href="/contribute">contributor</a> in order to post to HE!</h4>
    <p><a href="/contributors">Click here</a> to learn how to earn contributor status or <a href="/signin">sign in</a>.</p>
</div>

<?php } ?>

  </div>
</section>
