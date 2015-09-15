<?php
/**
 * Html template tag hook.
 */
function wtf_html( $class = '', $lang = '' ) {
  do_action( 'wtf_html', $class, $lang );
}

/**
 * Html template tag default output.
 */
add_action( 'wtf_html' , 'wtf_html_default', 10, 2 );

function wtf_html_default( $class, $lang ) {
  echo '<html class="' . $class . '" lang="' . ( $lang == 'en-US' ? 'en' : $lang ) . '">' . "\n";
}

/**
 * Title template tag.
 */
function wtf_title( $sep ) {
  echo apply_filters( 'wtf_title', wp_title( $sep, true, 'right' ) . bloginfo( 'name' ) );
}

/**
 * Body template tag hook.
 */
function wtf_body( $class = '' ) {
  do_action( 'wtf_body', $class );
}

/**
 * Body template tag default output.
 */
add_action( 'wtf_body' , 'wtf_body_default', 10, 2 );

function wtf_body_default( $class ) {
  echo '<body class="' . $class . '">' . "\n";
}

/**
 * Asset template tag.
 */
function wtf_asset( $file = '' ) {
  echo apply_filters( 'wtf_asset', get_template_directory_uri() . $file, $file );
}

/**
 * Navigation template tag.
 */
function wtf_nav_menu( $handle = '', $title = '', $class = '' ) {

  $args = array(
    'theme_location' => $handle,
    'container'      => false, // Remove wrapping container
    'echo'           => false,
    'fallback_cb'    => '' // Disable fallback
  );

  $output = '<nav class="navigation ' . $class . '" role="navigation">' .
            '<h1 class="visuallyhidden">' . $title . '</h1>' .
              wp_nav_menu( $args ) .
            '</nav>' . "\n";

  echo $output;
}

/**
 * Pagination template tag.
 */
function wtf_paginate( $title = '', $class = '' ) {

  $output = '';

  /* Posts page pagination. */
  if ( ! is_singular() && wtf_is_paginated() ):

    $output = '<nav class="pagination ' . $class .'" role="navigation">' .
              '<h1 class="visuallyhidden">' . $title . '</h1>' .
                get_next_posts_link( __( '&larr; Earlier posts', 'wtf' ) ) .
                get_previous_posts_link( __( 'Newer posts &rarr;', 'wtf' ) ) .
              '</nav>' . "\n";

  /* Singular posts and pages pagination. */
  elseif ( is_singular() && wtf_is_paginated() ):

    $args = array(
      'before'           => '',
      'after'            => '',
      'next_or_number'   => 'next',
      'nextpagelink'     => __( 'Next page &rarr;', 'wtf' ),
      'previouspagelink' => __( '&larr; Previous page', 'wtf' ),
      'echo'             => 0
    );

    $output = '<nav class="pagination ' . $class . '" role="navigation">' .
              '<h1 class="visuallyhidden">' . $title . '</h1>' .
                wp_link_pages( $args ) .
              '</nav>' . "\n";

  endif;

  echo $output;
}

/* End of file template.php */
/* Location: ./library/template.php */
