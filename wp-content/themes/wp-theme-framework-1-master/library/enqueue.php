<?php
/**
 * Admin styles.
 */
add_action( 'admin_enqueue_scripts', 'wtf_admin_enqueue_styles' );

function wtf_admin_enqueue_styles() {
  wp_enqueue_style( 'admin_styles', get_template_directory_uri() . '/assets/stylesheets/admin.css' );
}

/**
 * Admin scripts.
 */
add_action( 'admin_enqueue_scripts', 'wtf_admin_enqueue_scripts' );

function wtf_admin_enqueue_scripts() {
  wp_enqueue_script( 'admin_scripts', get_template_directory_uri() . '/assets/javascripts/admin.js' );
}

/**
 * Public styles.
 */
// add_action( 'wp_enqueue_scripts', 'wtf_enqueue_styles' );
//
// function wtf_enqueue_styles() {}

/**
 * Public scripts.
 */
// add_action( 'wp_enqueue_scripts', 'wtf_enqueue_scripts' );
//
// function wtf_enqueue_scripts() {}

/* End of file enqueue.php */
/* Location: ./library/enqueue.php */
