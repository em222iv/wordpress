# Pubdate

Add pubdate to templates [as suggested](http://www.readability.com/publishers/guidelines)
by Readability.

```html
<time class="updated" datetime="<?php the_time( 'Y-m-d' ) ?>" pubdate>
  <?php the_time( get_option( 'date_format' ) ) ?>
</time>
```

Default classes.

```css
.updated {}
```
