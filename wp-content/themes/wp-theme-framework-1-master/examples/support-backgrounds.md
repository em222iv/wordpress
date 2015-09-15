# Support backgrounds

Tell WordPress to support custom backgrounds.

```php
add_theme_support( 'custom-background', array(
  'wp-head-callback' => 'wtf_custom_background_cb',
) );
```

Custom backgrounds callback.

```php
function wtf_custom_background_cb() {
  $background = get_background_image();
  $color = get_background_color();
?>

  <style>
    <?php if ( ! isset( $background ) ) : ?>
      html {
        background: url(<?= $background; ?>) no-repeat center center fixed;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
      }
    <?php else : ?>
      html {
        background-color: #<?= $color; ?>;
      }
    <?php endif ?>
  </style>

<?php
}
```
