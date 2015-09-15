<?php
/**
 * Setup theme defaults and register selected WordPress features.
 */
add_action( 'after_setup_theme', 'wtf_setup' );

function wtf_setup() {

  // Make theme available for translation
  load_theme_textdomain( 'wtf', get_template_directory() . '/languages' );

  // Register navigation menus
  register_nav_menus( array(
    'navigation-primary' => __( 'Primary Navigation', 'wtf' )
  ) );


  // Register sidebars
  register_sidebar( array(
    'name'          => __( 'Primary Sidebar', 'wtf' ),
    'id'            => 'sidebar-primary',
    'description'   => '',
    'before_widget' => '<section class="widget %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h1 class="widget-title">',
    'after_title'   => '</h1>',
  ) );

}

/**
 * Define custom 'more-link' text.
 */
function wtf_more_link_text() {
  return __( 'Continue reading', 'wtf' );
}

/**
 * Define custom excerpt length.
 */
add_filter( 'excerpt_length', 'wtf_excerpt_length' );

function wtf_excerpt_length( $length = '' ) {
  return '40';
}

/* End of file setup.php */
/* Location: ./library/setup.php */
