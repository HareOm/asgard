<?php
/*
Template Name: Images Submit
*/
?>
<section>
    <div class="container slim">

        <?php
        $status = isset($_GET['status']) ? $_GET['status'] : '';
        if($status == 'error'){ ?>

            <div class="alert alert-danger center module">Hmm something went wrong :( Please try submitting again.</div>

        <?php }elseif($status == 'pending'){ ?>

            <div class="alert alert-success center module">Your image has been successfully submitted! It will go live once it's been approved.</div>

        <?php } ?>

        <h1 class="center page-title">Image Submission</h1>

        <?php if ( current_user_can('edit_posts') || true ) { ?>

        <div class="entry">
            <ul class="submission-rules">
                <li class="no"><i class="icon icon-ban"></i>Small or poor-resolution images</li>
                <li class="no"><i class="icon icon-ban"></i>Self-promotion</li>
            </ul>

            <form enctype="multipart/form-data" action="<?php echo get_template_directory_uri(); ?>/lib/submit-content.php" method="POST" id="image-submit">

                <div id="preview" class="hide">
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

                <input name="type" type="hidden" value="image"/>
                <?php wp_nonce_field( 'submit_image' ); ?>

            </form>
        </div>

        <script type="text/javascript">
        jQuery(document).ready(function($) {

            $("[name='image']").on('change', function(){
                input = this;
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('.imageEmbed').attr('src', e.target.result);
                        $('.fileUpload').text('Choose another image');
                        $('#preview').show();
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            });

            $.validator.addMethod('filesize', function(value, element, param) {
                // param = size (en bytes)
                // element = element to validate (<input>)
                // value = value of the element (file name)
                return this.optional(element) || (element.files[0].size <= param)
            });

            var validator = $("#image-submit").validate({
                messages: {
                    title: {
                        required: "Enter a title",
                        minlength: jQuery.format("Must be at least {0} characters"),
                        maxlength: jQuery.format("Cannot exceed {0} characters")
                    },
                    image: {
                            required: true,
                            accept: "png|jpe?g|gif",
                            filesize: 10048576
                    },
                    cat: {
                        required: "Please choose the best fit category"
                    }
                },
                errorPlacement: function(error, element) {
                    if(element.is('select')){
                        error.prependTo( element.parent());
                    }else if ( element.is(":file") ){
                            error.appendTo( element.parent().parent().prev() );
                    }else{
                        error.insertAfter( element.prev());
                    }
                },
                submitHandler: function(form) {
                    $('input[type="submit"]').attr("disabled", true);
                    form.submit();
                }
            });

        });
        </script>

        <?php } else { ?>

        <div class="alert alert-primary center">
            <h4>You must be be a <a href="/contribute">contributor</a> in order to post to HE!</h4>
            <p><a href="/contributors">Click here</a> to learn how to earn contributor status or <a href="/signin">sign in</a>.</p>
        </div>

        <?php } ?>

    </div>
</section>
