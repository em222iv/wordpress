# Register post type

Search and replace "Resource" and "resource" to rename example
[custom post type](http://codex.wordpress.org/Function_Reference/register_post_type).

```php
add_action( 'init', 'wtf_post_resource_register' );

function wtf_post_resource_register() {

  $labels = array(
    'name'               => __( 'Resources', 'wtf' ),
    'singular_name'      => __( 'Resource', 'wtf' ),
    'add_new'            => __( 'Add New', 'wtf' ),
    'add_new_item'       => __( 'Add New Resource', 'wtf' ),
    'edit_item'          => __( 'Edit Resource', 'wtf' ),
    'new_item'           => __( 'New Resource', 'wtf' ),
    'view_item'          => __( 'View Resource', 'wtf' ),
    'search_items'       => __( 'Search Resources', 'wtf' ),
    'not_found'          => __( 'No resources found', 'wtf' ),
    'not_found_in_trash' => __( 'No resources found in Trash', 'wtf' ),
    'parent_item_colon'  => __( 'Parent Resource:', 'wtf' ),
    'menu_name'          => __( 'Resources', 'wtf' )
  );

  $arguments = array(
    'labels'        => $labels,
    'description'   => __( 'Resource post type', 'wtf' ),
    'public'        => true,
    'hierarchical'  => true, // Enable custom menu order
    'menu_position' => 5,
    'supports'      => array( 'title', 'editor', 'revisions' ),
    'rewrite'       => array( 'with_front' => false ) // Exclude front base
  );

  register_post_type( 'resource', $arguments );
}
```

## Templates

Create `single-resource.php` based on `single.php`.

Create `template-resource.php`.

```php
<?php
/**
 * Template Name: Resources
 */
?>

  <?php
    query_posts( array(
      'post_type' => 'resource',
      'orderby'   => 'menu_order',
      'order'     => 'ASC',

      // Enable pagination.
      'posts_per_page' => 10,
      'paged' => ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1
    ) );

    // Enable more-link.
    global $more;
    $more = 0;
  ?>

    <!-- Default loop. -->

  <?php wp_reset_query(); ?>
```

## Extras

Updated messages.

```php
add_filter( 'post_updated_messages', 'wtf_post_resource_messages' );

function wtf_post_resource_messages( $messages ) {
  global $post, $post_ID;

  $messages['resource'] = array(
    0  => '',
    1  => sprintf( __( 'Resource updated. <a href="%s">View resource</a>', 'wtf' ), esc_url( get_permalink( $post_ID ) ) ),
    2  => __( 'Resource field updated.', 'wtf' ),
    3  => __( 'Resource field deleted.', 'wtf' ),
    4  => __( 'Resource updated.', 'wtf' ),
    5  => isset( $_GET['revision'] ) ? sprintf( __( 'Resource restored to revision from %s', 'wtf' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
    6  => sprintf( __( 'Resource published. <a href="%s">View resource</a>', 'wtf' ), esc_url( get_permalink( $post_ID ) ) ),
    7  => __( 'Resource saved.', 'wtf' ),
    8  => sprintf( __( 'Resource submitted. <a target="_blank" href="%s">Preview resource</a>', 'wtf' ), esc_url( add_query_arg( 'preview', 'true', get_permalink( $post_ID ) ) ) ),
    9  => sprintf( __( 'Resource scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview resource</a>', 'wtf' ), date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink( $post_ID ) ) ),
    10 => sprintf( __( 'Resource draft updated. <a target="_blank" href="%s">Preview resource</a>', 'wtf' ), esc_url( add_query_arg( 'preview', 'true', get_permalink( $post_ID ) ) ) ),
  );

  return $messages;
}
```

Contextual help.

```php
add_action( 'admin_head', 'wtf_post_resource_help' );

function wtf_post_resource_help() {
  global $post_ID;

  $screen = get_current_screen();

  if ( isset( $_GET['post_type'] ) )
    $post_type = $_GET['post_type'];
  else
    $post_type = get_post_type( $post_ID );

  if ( $post_type == 'resource' ) :

    $output = '<h3>Help Title</h3>' .
              '<p>Help text.</p>';

    $screen->add_help_tab( array(
      'id'      => 'help_resource', // Unique id for the tab.
      'title'   => 'Help Tab',      // Unique visible title for the tab.
      'content' => $output,         // Help text content.
    ) );

  endif;
}
```
