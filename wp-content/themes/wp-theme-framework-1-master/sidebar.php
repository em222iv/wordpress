<aside class="sidebar sidebar-primary" role="complementary">

  <h1 class="sidebar-title visuallyhidden">
    <?php _e( 'Sidebar', 'wtf' ) ?>
  </h1>

  <?php if ( is_active_sidebar( 'sidebar-primary' ) ) : ?>
    <?php dynamic_sidebar( 'sidebar-primary' ); ?>
  <?php endif; ?>

</aside>
<!-- /sidebar -->
