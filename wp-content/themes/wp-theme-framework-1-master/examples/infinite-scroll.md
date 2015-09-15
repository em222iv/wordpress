# Infinite scroll

Create template `content-loop.php` and copy loop from `index.php`.

Replace loop and include template.

```php
<?php get_template_part( 'content', 'loop' ); ?>
```

Modify pagination.

```php
<?php wtf_paginate( 'Pagination', 'loading' ); ?>
```

Get posts from template.

```php
add_action( 'wp_ajax_infinite_scroll', 'wtf_infinite_scroll' );
add_action( 'wp_ajax_nopriv_infinite_scroll', 'wtf_infinite_scroll' );

function wtf_infinite_scroll() {
  query_posts( array( 'paged' => $_POST['page'] ) );
  get_template_part( $_POST['template'] );
  exit;
}
```

Define variables in `footer.php`.

```html
<script>
  var ajaxUrl = "<?= home_url(); ?>/wp-admin/admin-ajax.php",
      pages = <?= $wp_query->max_num_pages; ?>;
</script>
```

Add script to `main.js`.

```js
var $container = $(".main"),
    $pagination = $container.find(".loading").text("Loading posts..."),
    count = 2;

$(window).scroll(function() {
  if (pages >= count && $(this).scrollTop() == $(document).height() - $(this).height()) {
    $pagination.fadeIn(250);

    $.ajax({
      url: ajaxUrl,
      type: "POST",
      data: "action=infinite_scroll&page=" + count++ + "&template=content-loop",
    }).success(function(posts) {
      $container.append(posts);
    }).complete(function() {
      $pagination.fadeOut(600);
    });
  }
});
```

Default classes.

```css
.loading {}
```
