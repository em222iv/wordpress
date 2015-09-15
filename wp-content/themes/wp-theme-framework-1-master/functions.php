<?php
opcache_reset();
/**
 * Functions and definitions.
 */
locate_template( '/library/helpers.php',  true, true );
locate_template( '/library/setup.php',    true, true );
locate_template( '/library/enqueue.php',  true, true );
locate_template( '/library/cleanup.php',  true, true );
locate_template( '/library/template.php', true, true );
locate_template( '/library/custom.php',   true, true );

/* End of file functions.php */
/* Location: ./functions.php */
