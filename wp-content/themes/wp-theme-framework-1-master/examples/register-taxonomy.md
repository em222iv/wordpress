# Register taxonomy

Search and replace "Collection" and "collection" to rename example
[custom taxonomy](http://codex.wordpress.org/Function_Reference/register_taxonomy).

```php
add_action( 'init', 'wtf_taxonomy_collection_register' );

function wtf_taxonomy_collection_register() {

  $labels = array(
    'name'                       => __( 'Collections', 'wtf' ),
    'singular_name'              => __( 'Collection', 'wtf' ),
    'search_items'               => __( 'Search Collections', 'wtf' ),
    'popular_items'              => __( 'Popular Collections', 'wtf' ),
    'all_items'                  => __( 'All Collections', 'wtf' ),
    'parent_item'                => __( 'Parent Collection', 'wtf' ),
    'parent_item_colon'          => __( 'Parent Collection:', 'wtf' ),
    'edit_item'                  => __( 'Edit Collection', 'wtf' ),
    'update_item'                => __( 'Update Collection', 'wtf' ),
    'add_new_item'               => __( 'Add New Collection', 'wtf' ),
    'new_item_name'              => __( 'New Collection', 'wtf' ),
    'separate_items_with_commas' => __( 'Separate collections with commas', 'wtf' ),
    'add_or_remove_items'        => __( 'Add or remove collection', 'wtf' ),
    'choose_from_most_used'      => __( 'Choose from most used collections', 'wtf' ),
    'menu_name'                  => __( 'Collections', 'wtf' ),
  );

  $arguments = array(
    'labels'  => $labels,
    'rewrite' => array( 'with_front' => false ) // Exclude front base
  );

  // Attach to example post type "resource"
  register_taxonomy( 'collection', array( 'resource' ), $arguments );
}
```

## Templates

Create `taxonomy-collection.php` based on `index.php`.

Add [term list](http://codex.wordpress.org/Function_Reference/get_the_term_list) to posts.

```php
<?php echo get_the_term_list( $post->ID, 'collection', 'Collection: ', ', ', '' ); ?>
```
