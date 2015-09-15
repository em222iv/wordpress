# Post format

Entry post format template tag for using additional post formats.

```php
function wtf_post_format() {
  global $post;
  if ( ! $format = get_post_format( $post ) )
    $format = 'default';

  echo $format;
}
```

Template tag.

```php
<?php wtf_post_format(); ?>
```

```html
<!-- Default usage. -->

<article class="entry entry-<?php wtf_post_format(); ?>">
```

Support additional post formats.

```php
add_theme_support( 'post-formats', array( 'link', 'quote', 'status', 'image', 'video', 'audio' ) );
```

Default classes.

```css
/* Dynamically generated post format class. */
.entry-[format] {}
```
