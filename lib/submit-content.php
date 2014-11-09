<?php

require_once('../../../../wp-load.php');
$options = get_option( 'hethen_theme_options' );

$postType = $_POST['type'];

// Make sure this came from the real form + site
if(wp_verify_nonce( $_POST['_wpnonce'], 'submit_' . $postType)){

    // Do some minor form validation to make sure there is content
    if (isset ($_POST['title'])) {

        $modOption = $postType . 'Moderation';
        $moderation = $options[$modOption];
        $status = $moderation ? 'draft' : 'publish';

        // Security precautions
        $title = cleanText($_POST['title']);
        $content = cleanHtml($_POST['content']);
        $excerpt = cleanHtml($_POST['excerpt']);
        $cat = cleanText($_POST['cat']);

        // Add the content of the form to $post as an array
        $post = array(
            'post_title'    => $title,
            'post_content'  => $content,
            'post_excerpt'  => $excerpt,
            'post_category' => array($cat),  // Usable for custom taxonomies too
            'post_status'   => $status,  // Choose: publish, preview, future, etc.
            'post_type'     => $postType  // Use a custom post type if you want to
        );
        $postID = wp_insert_post($post, true);  // Pass  the value of $post to WordPress the insert

        if($postID){

            // Loop through and update post meta fields
            foreach($_POST as $key => $value){
                if(!in_array($key, array('title', 'content', 'cat', 'tag', 'excerpt', 'image')))
                {
                    $key = cleanText($key);
                    add_post_meta($postID, $key, $value, true);
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

            if(!$moderation){
                 wp_redirect( '/?p=' . $postID );
             }else{
                 wp_redirect('/' . $postType . 's/submit?status=pending');
             }

        }else{

            wp_redirect('/' . $postType . 's/submit?status=error');

        }
    }else{
        wp_redirect('/' . $postType . 's/submit?status=error');
    }

}else{
    echo 'Nice try :)';
    die();
}
