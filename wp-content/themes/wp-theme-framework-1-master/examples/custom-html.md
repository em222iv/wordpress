# Custom html

Modify `wtf_html` output with no-js and
[conditional ie-classes](http://paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/).

```php
remove_action( 'wtf_html', 'wtf_html_default' );
add_action( 'wtf_html', 'wtf_html_custom', 10, 2 );

function wtf_html_custom( $class, $lang ) {

  $lang = ( $lang == 'en-US' ) ? 'en' : $lang;

  $output = '<!--[if lt IE 7]>      <html class="' . $class . ' lt-ie9 lt-ie8 lt-ie7" lang="' . $lang . '"> <![endif]-->' . "\n" .
            '<!--[if IE 7]>         <html class="' . $class . ' lt-ie9 lt-ie8 ie7" lang="' . $lang . '"> <![endif]-->' . "\n" .
            '<!--[if IE 8]>         <html class="' . $class . ' lt-ie9 ie8" lang="' . $lang . '"> <![endif]-->' . "\n" .
            '<!--[if gt IE 8]><!--> <html class="' . $class . '" lang="' . $lang . '"> <!--<![endif]-->' . "\n";

  echo $output;
}
```

Default classes.

```css
.no-js {}

.lt-ie9 {}
.ie8 {}
.lt-ie8 {}
.ie7 {}
.lt-ie7 {}
```
