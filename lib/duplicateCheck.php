<?php

require_once('../../../../wp-load.php');

$postType = $_GET['postType'];
$field = $_GET['field'];
$value = $_GET['value'];

// args to query for your key
 $args = array(
   'post_type' => $postType,
   'post_status' => array('publish','pending','draft','future','private'),
   'meta_query' => array(
       array(
           'key' => $field,
           'value' => $value
       )
   ),
   'fields' => 'ids'
 );

$query = new WP_Query( $args );
$duplicates = $query->posts;

$duplicates = array_filter( $duplicates );

 // do something if the key-value-pair exists in another post
$result = empty( $duplicates) ? 'none' : 'duplicate';

header('Content-type: application/json');
echo json_encode($result);

?>