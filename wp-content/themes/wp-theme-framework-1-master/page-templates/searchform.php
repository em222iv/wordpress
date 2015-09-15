<form method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" class="search search-primary" role="search">
  <label for="s" class="search-label">Search</label>
  <input type="text" name="s" id="s" class="search-input" placeholder="<?php _e( 'Search Term', 'wtf' ) ?>">
  <input type="submit" name="submit" class="search-submit" value="<?php _e( 'Search', 'wtf' ) ?>">
</form>
