<?php

$postType = $_POST['type'];

require_once('../../../../wp-load.php');

// Make sure this came from the real form + site
if(wp_verify_nonce( $_POST['_wpnonce'], 'submit_' . $postType) )  {

    // Do some minor form validation to make sure there is content
    if ( isset($_POST['title']) ) {

        // Security precautions
        $title = $_POST['title'];
        $content = $_POST['content'];
        $excerpt = $_POST['excerpt'];
        $cat = $_POST['cat'];

        // Add the content of the form to $post as an array
        $post = array(
            'post_title'    => $title,
            'post_content'  => $content,
            'post_excerpt'  => $excerpt,
            'post_category' => array($cat),  // Usable for custom taxonomies too
            'post_status'   => 'publish',  // Choose: publish, preview, future, etc.
            'post_type'     => $postType  // Use a custom post type if you want to
        );

        $postID = wp_insert_post($post, true);  // Pass  the value of $post to WordPress the insert

        if($postID){

            // Loop through and update post meta fields
            foreach($_POST as $key => $value){
              if(!in_array($key, array('title', 'content', 'cat', 'tag', 'excerpt', 'image')))
              {
                add_post_meta($postID, $key, $value, true);
                //Add link thumb as featured image too
                if( $key == "link_thumbnail_url" ) {
                  set_featured_image_from_src( $value, $postID );
                }
              }
            }

            // Loop through submitted images and save the first one as featured image
            if (isset($_FILES['image']) && $_FILES['image']['size'] > 0) {
                array_reverse($_FILES);
                $i = 0;
                foreach ($_FILES as $file => $array) {
                    if ($i == 0) $set_feature = 1;
                    else $set_feature = 0;
                    $newUpload = insert_attachment($file, $postID, $set_feature);
                }
            }

            //$return_url = add_query_arg('status', 'pending', $_POST['return']);
            wp_redirect(get_permalink($postID));
            exit;

        }else{

          $return_url = add_query_arg('status', 'error', $_POST['return']);
          wp_redirect($return_url);
          exit;

        }
    }else{
        $return_url = add_query_arg('status', 'error', $_POST['return']);
        wp_redirect($return_url);
        exit;
    }

}else{
    echo 'You smell fishy.';
    die();
}

?>
