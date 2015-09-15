<?php
/* Custom functions. */

/**
 * Add Google Analytics script.
 */
add_action( 'wp_head', 'wtf_google_analytics', 10 );

function wtf_google_analytics() { ?>

	<script>
		var _gaq = [['_setAccount', 'UA-XXXXX-X'], ['_trackPageview']];
		(function(d, t) {
			var ga = d.createElement(t),
					s = d.getElementsByTagName(t)[0];
			ga.async = true;
			ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
			s.parentNode.insertBefore(ga, s);
		})(document, 'script');
	</script>

<?php
}

/**
 * Add quicktag buttons to editor.
 */
add_action( 'admin_print_footer_scripts', 'wtf_quicktags' );

function wtf_quicktags() { ?>

	<script type="text/javascript">
		edButtons[edButtons.length] = new edButton(
			'nextpage',        // Button HTML ID (required)
			'nextpage',        // Button display, value="" attribute (required)
			'<!--nextpage-->', // Opening tag markup (required)

			'', // Closing tag markup (optional)
			'', // Access key, accesskey="" attribute for the button (optional)
			'', // Title, title="" attribute (optional)
			''  // Priority/position on bar, 1-9 = first, 11-19 = second, 21-29 = third, etc. (optional)
		);
		edButtons[edButtons.length] = new edButton(
			'h2',
			'h2',
			'<h2>',
			'</h2>'
		);
		edButtons[edButtons.length] = new edButton(
			'h3',
			'h3',
			'<h3>',
			'</h3>'
		);
	</script>

<?php
}

/**
 * Tell WordPress to use 'searchform.php' from the 'page-templates' directory.
 *
 * https://github.com/retlehs/roots
 */
add_filter( 'get_search_form', 'wtf_get_search_form' );

function wtf_get_search_form( $arg ) {
	if ( $arg === '' )
		locate_template( '/page-templates/searchform.php', true, false );
}

/**
 * Add search filter
 */

function search_filter($query) {
	if ( !is_admin() && $query->is_main_query() ) {
		if ($query->is_search) {
			$query->set('post_type', 'post');
		}
	}
}

/**
 * Hide admin bar
 */
show_admin_bar( false );


/**
 * Add custom body classes
 */
remove_action( 'wtf_body', 'wtf_body_default' );
add_action( 'wtf_body', 'wtf_body_custom', 10, 1 );

function wtf_body_custom( $class ) {

	global $post;

	if ( is_search() ) :
		$page_class = 'page-search ';
	elseif ( is_category() ) :
		$page_class = 'page-category ';
	elseif ( is_tag() ) :
		$page_class = 'page-tag ';
	elseif ( is_archive() ) :
		$page_class = 'page-archive ';
	elseif ( $object_id = wtf_get_object_id() ):
		$page_id = $post->post_name;
		$page_class = 'page-' . $page_id . ' ';
	elseif ( is_404() ) :
		$page_id = '404';
		$page_class = 'page-404 ';
	else :
		// Silence is golden.
	endif;

	$post_type = get_post_type();
	$class .= ' ' . $post_type;

	if( is_single() ):
		$class .= ' single';
	endif;

	if( is_page() ) :
		$ancestors = get_post_ancestors($post);
		$ancestors = array_reverse($ancestors);
		$parent = $ancestors[0];
		$parent = get_page($parent);
		$parent_slug = $parent->post_name;
		$class .= ' parent-' . $parent_slug;
	endif;

	echo '<body id="' . $page_id . '" class="' . ( isset( $page_class ) ? $page_class : '' ) . $class . '">';
}

// add_action('pre_get_posts','search_filter');

/* End of file custom.php */
/* Location: ./library/custom.php */
add_action('admin_enqueue_scripts', 'chrome_fix');
function chrome_fix() {
    if ( strpos( $_SERVER['HTTP_USER_AGENT'], 'Chrome' ) !== false )
        wp_add_inline_style( 'wp-admin', '#adminmenu { transform: translateZ(0); }' );
}