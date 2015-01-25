<?php
/*
Template Name: Link Submit
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

  <div class="alert alert-success center module">Your link has been successfully submitted! It will go live once it's been approved.</div>

  <?php endif ?>

  <?php if ( current_user_can('edit_posts') ): ?>

<form enctype="multipart/form-data" action="<?php echo get_template_directory_uri(); ?>/lib/submitContent.php" method="POST" id="link-submit">
    <input class="form-control" type="text" id="url" placeholder="Link URL, eg. http://website.com/awesome-article"/>
    <div class="alert alert-danger" id="error" style="display:none"></div>
    <div class="hide" id="loading"><img width="50" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/ajax-loader.gif"/></div>

    <div id="preview" class="link-preview" style="display:none">
        <div class="form-group moduleTight">
            <label>Title</label>
            <input minlength="3" maxlength="<?php echo $options['titleMaxLength']; ?>" class="input-lg form-control required" type="text" title="Title" name="title" id="title"/>
        </div>
        <div class="row">
            <div class="col-sm-8">
              <label>Description</label>
              <textarea minlength="12" class="form-control required" maxlength="<?php echo $options['descMaxLength']; ?>" name="excerpt" placeholder="Enter a quick but useful description..." id="description"></textarea>
            </div>
            <br class="visible-xs"/>
            <div class="col-sm-4">
              <div class="relative embedContainer">
                  <img class="embed">
                  <!-- <input id="file" type="file" name="image"/>
                  <button class="fileUpload">Upload an image</button> -->
              </div>
            </div>
        </div>
        <hr>
        <div class="form-group">
            <div class="clearfix"></div>
            <label style="font-size: 18px;">Choose a category:</label>
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
        <hr>
        <div class="module center" style="font-size: 18px;">
            <b class="white">This links to an...</b>
            &nbsp;&nbsp;&nbsp;
            <label>
                <input type="radio" name="is_article" value="1">
                &nbsp;Article
            </label>
            &nbsp;&nbsp;
            <label>
                <input type="radio" name="is_article" value="0" checked>
                &nbsp;Something else
            </label>
        </div>
        <button class="btn btn-success btn-xl btn-block" type="submit">Submit</button>
    </div>

    <input name="content" type="hidden"/>
    <input name="site_name" type="hidden"/>
    <input name="site_url" type="hidden"/>
    <input name="link_thumbnail_url" type="hidden"/>
    <input name="link_url" type="hidden"/>
    <input name="type" type="hidden" value="link"/>
    <input name="return" type="hidden" value="<?php the_permalink() ?>"/>
    <?php wp_nonce_field( 'submit_link' ); ?>

</form>
<script type="text/javascript">
(function($) {

    $(window).keydown(function(event){
        if(event.keyCode == 13) {
            event.preventDefault();
            return false;
        }
    });

    var delay = (function(){
        var timer = 0;
        return function(callback, ms){
            clearTimeout (timer);
            timer = setTimeout(callback, ms);
        };
    })();

    $('input#url').keyup(function(){
        delay(function(){
            url_preview();
        }, 750 );
    });

    $("[name='image']").on('change', function(){
        input = this;
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('.embed').attr('src', e.target.result).show();
                $('.fileUpload').text('Choose another image');
            }
            reader.readAsDataURL(input.files[0]);
        }
    });

    function url_preview(){

        $('#preview').hide();
        $('#loading').show();
        var url = $('input#url').val();

        if (url == ''){
            $('#loading').hide();
        }

        else{

            var url = escape(url);
            var key = 'a68e57d81dea11e1a5be4040d3dc5c07';
            var api_url = 'http://api.embed.ly/1/extract?key=' + key + '&url=' + url + '&callback=?&format=json';

            $.getJSON( api_url, function(json) {
                console.log(json);
                $('#loading').hide();

                var type = json.type;
                if(json.error){
                    $('#error').html(json.error-message).slideDown();
            <?php if($options['videos']) : ?>
                }else if(type == 'video'){
                    $('#error').html('Videos should be submitted <a href="/videos/submit">here</a>').slideDown();
            <?php endif; if($options['images']) : ?>
                }else if( type == 'image'){
                    $('#error').html('Images should be submitted <a href="/images/submit">here</a>').slideDown();
            <?php endif; ?>
                }else{
                    $('#error').html('').slideUp(300);

                    // Check for duplicates
                    $.ajax({
                        url: '<?php echo get_template_directory_uri(); ?>/lib/duplicateCheck.php',
                        type: 'GET',
                        data: {'postType' : 'link', 'field' : 'link_url', 'value' : json.url },
                        success: function(response){
                            if(response == 'duplicate'){
                                $('#error').html('That link has already been submitted').slideDown();
                                $('#preview').slideUp(300);
                                $('#loading').hide();
                                return false;
                            }else{
                                if(json.images[0]){
                                    var thumbnail_url = json.images[0].url,
                                    thumbnail_height = json.images[0].height,
                                    thumbnail_width = json.images[0].width;
                                    $('img.embed').attr({src: thumbnail_url, width: thumbnail_width, height: thumbnail_height }).show();
                                    $('[name="link_thumbnail_url"]').val(thumbnail_url);
                                }else{
                                    $('img.embed').hide();
                                }
                                $('[name="title"]').val(json.title);
                                $('[name="excerpt"]').val(json.description);
                                $('[name="content"]').val(json.content);
                                $('[name="link_url"]').val(json.url);
                                $('[name="site_url"]').val(json.provider_url);
                                $('[name="site_name"]').val(json.provider_name);
                                $('div#preview').slideDown(300);
                            }
                        }
                    });
                }
            });
        }
    };

    // var validator = $("#link-submit").validate({
    //     rules: {
    //         image: {
    //             accept: "png|jpe?g|gif",
    //             filesize: 10048576
    //         }
    //     },
    //     messages: {
    //         title: {
    //             required: "Enter a title",
    //             minlength: $.format("Must be at least {0} characters"),
    //             maxlength: $.format("Cannot exceed {0} characters")
    //         },
    //         excerpt: {
    //             required: "Enter a description",
    //             minlength: $.format("Must be at least {0} characters"),
    //             maxlength: $.format("Cannot exceed {0} characters")
    //         },
    //         image: "Only jpg, png and gif files, max size 10 MB",
    //         cat: {
    //             required: "Please choose the best fit category"
    //         }
    //     },
    //     errorPlacement: function(error, element) {
    //         if(element.is('select')){
    //             error.prependTo( element.parent());
    //         }else{
    //             error.insertAfter( element.prev());
    //         }
    //     },
    //     submitHandler: function(form) {
    //         $('input[type="submit"]').attr("disabled", true);
    //         form.submit();
    //     }
    // });
})(jQuery);
</script>


  <?php else: ?>

  <div class="alert alert-primary center">
    <h4>You must be be a <a href="<?php echo home_url('contribute') ?>">contributor</a> in order to post to Valhalla Movement!</h4>
    <p><a href="<?php echo home_url('contributors') ?>">Click here</a> to learn how to earn contributor status or <a href="<?php echo home_url('signin') ?>">sign in</a>.</p>
  </div>

  <?php endif ?>

  </div>
</section>
