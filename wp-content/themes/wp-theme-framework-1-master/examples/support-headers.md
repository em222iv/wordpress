# Support headers

Tell WordPress to support custom headers.

```php
add_theme_support( 'custom-header', array(
  'width'         => 980,
  'height'        => 60,
  'default-image' => get_template_directory_uri() . '/assets/images/header.jpg',
  'uploads'       => true,
) );
```
