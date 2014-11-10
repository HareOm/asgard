<?php
/**
 * Custom functions
 */

function get_terms_by_post_type( $taxonomies, $post_types ) {

    global $wpdb;

    $query = $wpdb->prepare( "SELECT t.*, COUNT(*) from $wpdb->terms AS t INNER JOIN $wpdb->term_taxonomy AS tt ON t.term_id = tt.term_id INNER JOIN $wpdb->term_relationships AS r ON r.term_taxonomy_id = tt.term_taxonomy_id INNER JOIN $wpdb->posts AS p ON p.ID = r.object_id WHERE p.post_type IN('".join( "', '", $post_types )."') AND tt.taxonomy IN('".join( "', '", $taxonomies )."') GROUP BY t.term_id");

    $results = $wpdb->get_results( $query );

    return $results;

}
