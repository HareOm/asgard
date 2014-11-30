<?php
//print_r($_POST); die();
require_once('../../../../wp-load.php');

if ( !isset( $_POST['asgard_image_submit_nonce'] ) || !wp_verify_nonce( $_POST['asgard_image_submit_nonce'], 'asgard_image_submit' ) ) {
  print 'Sorry, your nonce did not verify.';
  exit;
}

// NONCE checks out, continue with the good stuff
// Create a new post
$post = array(
 'post_status'  => 'draft' ,
 'post_title'  => $_POST["title"],
 'post_content' => $_POST["description"],
 'post_thumbnail' => $_POST["post_thumbnail"],
 'post_type'  => 'image'
);

// insert the post
$post_id = wp_insert_post( $post );

echo $_POST["post_thumbnail"];
die();

$filename = $_POST["post_thumbnail"];
$wp_filetype = wp_check_filetype(basename($filename), null );
$attachment = array(
   'post_mime_type' => $wp_filetype['type'],
   'post_title' => preg_replace('/\.[^.]+$/', '', basename($filename)),
   'post_content' => '',
   'post_status' => 'inherit'
);

$attach_id = wp_insert_attachment( $attachment, $filename, $post_id );

$attach_data = wp_generate_attachment_metadata( $attach_id, $filename );
wp_update_attachment_metadata( $attach_id, $attach_data );

set_post_thumbnail( $post_id, $attach_id );

// update $_POST['return']
$_POST['return'] = add_query_arg( array('post_id' => $post_id), $_POST['return'] );

header("Location: " . $_POST['return']);
// return the new ID
//echo $post_id;
