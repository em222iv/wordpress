# Flush head

Flush head [as suggested](http://developer.yahoo.com/performance/rules.html#flush)
by Yahoo Developer Network.

```php
add_action( 'wp_head', 'wtf_flush_head', 999 );

function wtf_flush_head() {
  flush();
}
```
