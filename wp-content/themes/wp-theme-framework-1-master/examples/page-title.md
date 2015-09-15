# Page title

Page title template tag to extend `index.php` for search results and archive pages, etc.

```php
function wtf_page_title( $title = '', $title_class = '', $description_class = '' ) {

  if ( is_search() ) :
    $title = sprintf( __( 'Search Results for: %s', 'wtf' ), '<span>' . get_search_query() . '</span>' );
  elseif ( is_category() ) :
    $title = sprintf( __( 'Category Archives: ', 'wtf' ) . '<span>' . single_cat_title( '', '' ) . '</span>' );
  elseif ( is_tag() ) :
    $title = sprintf( __( 'Tag Archives: ', 'wtf' ) . '<span>' . single_tag_title( '', '' ) . '</span>' );
  elseif ( is_day() ) :
    $title = sprintf( __( 'Daily Archives: %s', 'wtf' ), '<span>' . get_the_date() . '</span>' );
  elseif ( is_month() ) :
    $title = sprintf( __( 'Monthly Archives: %s', 'wtf' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'wtf' ) ) . '</span>' );
  elseif ( is_year() ) :
    $title = sprintf( __( 'Yearly Archives: %s', 'wtf' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'wtf' ) ) . '</span>' );
  else :
    // Silence is golden.
  endif;

  echo '<h1 class="' . $title_class . '">' . $title . '</h1>';
  if ( $desc = category_description() ) {
    echo '<div class="' . $description_class . '">' . $desc . '</div>';
  }
}
```

Template tag.

```php
<?php wtf_page_title(); ?>
```

```html
<!-- Default usage. -->

<div class="main" role="main">
  <?php wtf_page_title( 'Posts', 'page-title', 'page-description' ); ?>
  <!-- Main content goes here. -->
</div>
```

Default classes.

```css
.page-title {}
.page-description {}
```
