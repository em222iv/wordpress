# Htaccess

Add rules to `.htaccess`.

```php
if ( current_user_can( 'administrator' ) ) {
  add_action( 'mod_rewrite_rules', 'wtf_htaccess', 10, 1 );
}

function wtf_htaccess() {
  global $wp_filesystem;

  if ( !defined( 'FS_METHOD' ) )
    define( 'FS_METHOD', 'direct' );

  if ( is_null( $wp_filesystem ) )
    WP_Filesystem( array(), ABSPATH );

  $rules .= $wp_filesystem->get_contents( locate_template( '/includes/htaccess-custom', false, false ) );

  return $rules;
}
```

Example `htaccess-custom` rules.

```apache
# ----------------------------------------------------------------------
# Block the include-only files
# ----------------------------------------------------------------------

RewriteEngine On
RewriteBase /
RewriteRule ^wp-admin/includes/ - [F,L]
RewriteRule !^wp-includes/ - [S=3]
RewriteRule ^wp-includes/[^/]+\.php$ - [F,L]
RewriteRule ^wp-includes/js/tinymce/langs/.+\.php - [F,L]
RewriteRule ^wp-includes/theme-compat/ - [F,L]

# ----------------------------------------------------------------------
# Protect from Script Injections
# ----------------------------------------------------------------------

Options +FollowSymLinks
RewriteCond %{QUERY_STRING} (\<|%3C).*script.*(\>|%3E) [NC,OR]
RewriteCond %{QUERY_STRING} GLOBALS(=|\[|\%[0-9A-Z]{0,2}) [OR]
RewriteCond %{QUERY_STRING} _REQUEST(=|\[|\%[0-9A-Z]{0,2})
RewriteRule ^(.*)$ index.php [F,L]

# ----------------------------------------------------------------------
# Block access to wp-config.php
# ----------------------------------------------------------------------

<Files wp-config.php>
  Order Deny,Allow
  Deny from All
</Files>
<FilesMatch ^wp-config.php$>
  deny from all
</FilesMatch>
```