# Robots

[Add rules](http://codex.wordpress.org/Function_Reference/do_robots) to `robots.txt`.

```php
add_action( 'do_robots', 'wtf_robots' );

function wtf_robots() {
  $output = "User-agent: *\n" .
            "Disallow: /wp-admin\n" .
            "Disallow: /wp-includes\n" .
            "Disallow: /wp-content/plugins\n" .
            "Disallow: /wp-content/cache\n" .
            "Disallow: /wp-content/themes\n" .
            "Allow: /wp-content/uploads\n" .
            "Sitemap: " . home_url() . "/sitemap.xml\n";

  echo $output;
}
```
