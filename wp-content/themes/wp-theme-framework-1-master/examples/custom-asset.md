# Custom asset

Modify `wtf_asset` output for query string-based cache busting.

```php
add_filter( 'wtf_asset', 'wtf_asset_custom', 10, 2 );

function wtf_asset_custom( $output, $file ) {
  echo $output . '?' . date( 'YmdHis', filemtime( get_theme_root() . '/' . get_template() . $file ) );
}
```
