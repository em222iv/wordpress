# Custom body

Modify `wtf_body` output with current page classes.

```php
remove_action( 'wtf_body', 'wtf_body_default' );
add_action( 'wtf_body', 'wtf_body_custom', 10, 1 );

function wtf_body_custom( $class ) {

  if ( is_search() ) :
    $page_class = 'page-search ';
  elseif ( is_category() ) :
    $page_class = 'page-category ';
  elseif ( is_tag() ) :
    $page_class = 'page-tag ';
  elseif ( is_archive() ) :
    $page_class = 'page-archive ';
  elseif ( $object_id = wtf_get_object_id() ):
    $page_class = 'page-' . strtolower( str_replace( ' ', '-', get_the_title( $object_id ) ) ) . ' ';
  else :
    // Silence is golden.
  endif;

  echo '<body class="' . ( isset( $page_class ) ? $page_class : '' ) . $class . '">';
}
```

Default classes.

```css
.page-search {}
.page-category {}
.page-tag {}
.page-archive {}

/* Dynamically generated page class. */
.page-[entry-title] {}
```
