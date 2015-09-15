<?php
/**
 * Clean up 'wp_head' default output.
 *
 * http://wpengineer.com/1438/wordpress-header/
 * https://github.com/retlehs/roots
 */
add_action( 'init', 'wtf_wp_head' );

function wtf_wp_head() {

  remove_action( 'wp_head', 'feed_links', 2 );
  remove_action( 'wp_head', 'feed_links_extra', 3 );
  remove_action( 'wp_head', 'rsd_link' );
  remove_action( 'wp_head', 'wlwmanifest_link' );
  remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
  remove_action( 'wp_head', 'wp_generator' );
  remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );
  remove_action( 'wp_head', 'rel_canonical' );

  add_filter( 'use_default_gallery_style', '__return_null' );
  add_filter( 'the_generator', 'wtf_generator_meta' );

  add_action( 'wp_head', 'wtf_robots_meta' );

  if ( ! class_exists( 'WPSEO_Frontend' ) ) {
    remove_action( 'wp_head', 'rel_canonical' );
    add_action( 'wp_head', 'wtf_canonical_link' );
  }

}

function wtf_generator_meta() {
  return;
}
function wtf_robots_meta() {
  if ( is_search() || get_option( 'blog_public' ) === '0' )
    echo '<meta name="robots" content="noindex, nofollow">' . "\n";
}
function wtf_canonical_link() {
  if ( is_singular() && $page_id = wtf_get_object_id() )
    echo '<link rel="canonical" href="' . get_permalink( $page_id ) . '">' . "\n";
}

/**
 * Clean up navigation menu classes.
 */
add_filter( 'nav_menu_css_class', 'wtf_nav_menu_classes', 100, 1 );
add_filter( 'nav_menu_item_id', 'wtf_nav_menu_classes', 100, 1 );
add_filter( 'page_css_class', 'wtf_nav_menu_classes', 100, 1 );

function wtf_nav_menu_classes( $classes ) {

  $skip_classes = array(
    'menu-item',
    'current-menu-item',
    'current-menu-parent',
    'current_page_item',
    'current_page_parent'
  );

  $classes = is_array( $classes ) ? array_intersect( $classes, $skip_classes ) : '';
  $classes = preg_replace( '/_/', '-', $classes );

  return $classes;
}

/**
 * Clean up widget classes.
 *
 * https://github.com/retlehs/roots
 */
add_filter( 'dynamic_sidebar_params', 'wtf_widget_classes' );

function wtf_widget_classes( $params ) {
  $params[0]['before_widget'] = preg_replace( '/_/', '-', $params[0]['before_widget'] );

  return $params;
}

/**
 * Add 'class' and 'rel' attributes to pagination.
 */
add_filter( 'next_posts_link_attributes', 'wtf_next_posts_link_rel' );
add_filter( 'previous_posts_link_attributes', 'wtf_previous_posts_link_rel' );

function wtf_next_posts_link_rel() {
  return 'class="next-link" rel="next"';
}
function wtf_previous_posts_link_rel() {
  return 'class="previous-link" rel="prev"';
}

/**
 * Add custom 'more-link' markup.
 */
function wtf_more_link() {
  return ' <a href="' . esc_url( get_permalink() ) . '" class="more-link">' . wtf_more_link_text() . '</a>';
}

/**
 * Add the custom 'more-link' to post excerpts.
 */
add_filter( 'excerpt_more', 'wtf_default_excerpt_more_link' );          // Automatic excerpts
add_filter( 'the_content_more_link', 'wtf_default_excerpt_more_link' ); // Manual excerpts
add_filter( 'get_the_excerpt', 'wtf_custom_excerpt_more_link' );        // Custom post excerpts

function wtf_default_excerpt_more_link( $more_link ) {
  return wtf_more_link();
}
function wtf_custom_excerpt_more_link( $output ) {
  if ( has_excerpt() && ! is_attachment() )
    $output .= wtf_more_link();

  return $output;
}

/**
 * Wrap embedded media.
 *
 * https://gist.github.com/965956
 * https://github.com/retlehs/roots
 */
add_filter( 'embed_oembed_html', 'wtf_embeds_wrap', 10, 4 );
add_filter( 'embed_googlevideo', 'wtf_embeds_wrap', 10, 2 );

function wtf_embeds_wrap( $cache, $url, $attr = '', $post_ID = '' ) {
  return '<div class="asset">' . $cache . '</div>' . "\n";
}

/**
 * Wrap images in '<figure>' elements.
 */
add_filter( 'image_send_to_editor', 'wtf_images_wrap', 10, 8 );

function wtf_images_wrap( $html, $id, $caption, $title, $align, $url, $size, $alt ) {
  preg_match( '/width="(.*?)"/', $html, $match );
  $output = '<figure class="asset" width="' . $match[1] . '">' . $html . '</figure>' . "\n";

  return $output;
}

/**
 * Clean up 'img_caption_shortcode', wrap images with captions
 * in '<figure>' and '<figcaption>' elements.
 *
 * http://justintadlock.com/archives/2011/07/01/captions-in-wordpress
 * https://github.com/retlehs/roots
 */
add_filter( 'img_caption_shortcode', 'wtf_caption_shortcode', 10, 3 );

function wtf_caption_shortcode( $output, $attr, $content ) {

  if ( is_feed() )
    return $output;

  $defaults = array(
    'id'      => '',
    'align'   => '',
    'width'   => '',
    'caption' => ''
  );

  $attr = shortcode_atts( $defaults, $attr );

  $class = ( ! empty( $attr['id'] ) ? esc_attr( $attr['id'] ) : '' );
  $align = ( ! empty( $attr['align'] ) ? esc_attr( $attr['align'] ) : '' );
  $width = ( ! empty( $attr['width'] ) ? esc_attr( $attr['width'] ) : '' );

  $output = '<figure class="asset ' . $class . ' ' . $align .'" style="width: ' . $width . 'px">' .
              do_shortcode( $content ) .
            '<figcaption class="caption">' . strip_tags( $attr['caption'] ) . '</figcaption>' .
            '</figure>' . "\n";

  return $output;
}

/**
 * Clean up 'gallery_shortcode'.
 *
 * https://github.com/retlehs/roots
 */
remove_shortcode( 'gallery' );
add_shortcode( 'gallery', 'wtf_gallery_shortcode' );

function wtf_gallery_shortcode( $attr ) {
  $post = get_post();

  static $instance = 0;
  $instance++;

  if ( ! empty( $attr['ids'] ) ) {
    if ( empty( $attr['orderby'] ) ) {
      $attr['orderby'] = 'post__in';
    }
    $attr['include'] = $attr['ids'];
  }

  $output = apply_filters( 'post_gallery', '', $attr );

  if ( $output != '' ) {
    return $output;
  }

  if ( isset( $attr['orderby'] ) ) {
    $attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
    if ( ! $attr['orderby'] ) {
      unset( $attr['orderby'] );
    }
  }

  extract( shortcode_atts( array(
    'order'      => 'ASC',
    'orderby'    => 'menu_order ID',
    'id'         => $post->ID,
    'itemtag'    => '',
    'icontag'    => '',
    'captiontag' => '',
    'columns'    => 3,
    'size'       => 'thumbnail',
    'include'    => '',
    'exclude'    => ''
  ), $attr ) );

  $id = intval( $id );

  if ( $order === 'RAND' ) {
    $orderby = 'none';
  }

  if ( ! empty( $include ) ) {
    $_attachments = get_posts( array( 'include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby ) );

    $attachments = array();
    foreach ( $_attachments as $key => $val ) {
      $attachments[$val->ID] = $_attachments[$key];
    }
  } elseif ( ! empty( $exclude ) ) {
    $attachments = get_children( array( 'post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby ) );
  } else {
    $attachments = get_children( array( 'post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby ) );
  }

  if ( empty( $attachments ) ) {
    return '';
  }

  if ( is_feed() ) {
    $output = "\n";
    foreach ( $attachments as $att_id => $attachment ) {
      $output .= wp_get_attachment_link( $att_id, $size, true ) . "\n";
    }
    return $output;
  }

  $output = '<ul class="gallery">';

  $i = 0;
  foreach ( $attachments as $id => $attachment ) {
    $link = isset( $attr['link'] ) && 'file' == $attr['link'] ? wp_get_attachment_link( $id, $size, false, false ) : wp_get_attachment_link( $id, $size, true, false );

    $output .= '<li>' . $link;
    if ( trim( $attachment->post_excerpt ) ) {
      $output .= '<div class="caption">' . wptexturize( $attachment->post_excerpt ) . '</div>';
    }
    $output .= '</li>';
  }

  $output .= '</ul>';

  return $output;
}

/**
 * Add 'class="thumbnail"' to attachment items.
 *
 * https://github.com/retlehs/roots
 */
add_filter( 'wp_get_attachment_link', 'wtf_attachment_link_class', 10, 1 );

function wtf_attachment_link_class( $html ) {
  $postid = get_the_ID();
  $html = str_replace( '<a', '<a class="thumbnail"', $html );

  return $html;
}

/**
 * Allow more tags in TinyMCE including '<iframe>' and '<script>'.
 *
 * https://github.com/retlehs/roots
 */
add_filter( 'tiny_mce_before_init', 'wtf_tinymce_tags' );

function wtf_tinymce_tags( $options ) {
  $extra = 'pre[id|name|class|style],iframe[align|longdesc|name|width|height|frameborder|scrolling|marginheight|marginwidth|src],script[charset|defer|language|src|type]';

  if ( isset( $initArray['extended_valid_elements'] ) )
    $options['extended_valid_elements'] .= ',' . $extra;
  else
    $options['extended_valid_elements'] = $extra;

  return $options;
}

/**
 * Redirects from '/?s=query' to '/search/query/' and converts '%20' to '+'.
 *
 * http://txfx.net/wordpress-plugins/nice-search/
 * https://github.com/retlehs/roots
 */
add_action( 'template_redirect', 'wtf_nice_search_redirect' );

function wtf_nice_search_redirect() {
  global $wp_rewrite;

  if ( ! isset( $wp_rewrite ) || ! is_object( $wp_rewrite ) || ! $wp_rewrite->using_permalinks() )
    return;

  $search_base = $wp_rewrite->search_base;
  if ( is_search() && ! is_admin() && strpos( $_SERVER['REQUEST_URI'], "/{$search_base}/" ) === false ) {
    wp_redirect( home_url( "/{$search_base}/" . urlencode( get_query_var('s') ) ) );
    exit();
  }

}

/**
 * Fix for empty search queries redirecting to home page.
 *
 * http://wordpress.org/support/topic/blank-search-sends-you-to-the-homepage#post-1772565
 * http://core.trac.wordpress.org/ticket/11330
 * https://github.com/retlehs/roots
 */
add_filter( 'request', 'wtf_request_filter' );

function wtf_request_filter( $query ) {
  if ( isset( $_GET['s'] ) && empty( $_GET['s'] ) )
    $query['s'] = ' ';

  return $query;
}

/* End of file cleanup.php */
/* Location: ./library/cleanup.php */
