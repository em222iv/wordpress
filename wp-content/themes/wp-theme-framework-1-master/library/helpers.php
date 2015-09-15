<?php
/**
 * Return true if current page require pagination.
 */
function wtf_is_paginated() {
  global $wp_query, $numpages;
  return ( $numpages > 1 || $wp_query->max_num_pages > 1 );
}

/**
 * Get correct object ID.
 */
function wtf_get_object_id() {
  global $wp_query;

  $object_id = $wp_query->get_queried_object_id();

  if ( is_home() )
    if ( 'page' == get_option( 'show_on_front' ) )
      if ( is_front_page() )
        $object_id = get_option( 'page_on_front' );
      else
        $object_id = get_option( 'page_for_posts' );

  return isset( $object_id ) ? $object_id : null;
}

/* End of file helpers.php */
/* Location: ./library/helpers.php */
