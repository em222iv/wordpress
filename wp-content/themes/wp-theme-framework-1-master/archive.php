<?php
/**
 * The template for displaying Archive pages.
 */

get_header(); ?>

	<?php if ( have_posts() ) : ?>

	<header class="archive-header">
		<h1 class="archive-title"><?php
			if ( is_day() ) :
				printf( __( 'Daily Archives: %s', 'twentythirteen' ), get_the_date() );
			elseif ( is_month() ) :
				printf( __( 'Monthly Archives: %s', 'twentythirteen' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'twentythirteen' ) ) );
			elseif ( is_year() ) :
				printf( __( 'Yearly Archives: %s', 'twentythirteen' ), get_the_date( _x( 'Y', 'yearly archives date format', 'twentythirteen' ) ) );
			elseif ( is_tag() ) :
				printf( __( 'Tag Archive: %s', 'twentythirteen' ), single_tag_title('', false) );
			elseif ( is_author() ) :
				// Post Author
				setup_postdata($post);
				$author_id = get_the_author_meta('ID');
				$blog_post['author']['name'] = get_the_author_meta('first_name');
				$blog_post['author']['avatar'] =  get_avatar( $author_id, 'full');
				printf( __( 'Posts written by: %s', 'twentythirteen' ), get_the_author() );
				wp_reset_postdata();
			else :
				_e( 'Archives', 'twentythirteen' );
			endif;?>
		</h1>
	</header><!-- .archive-header -->

	<section class="entry main" role="main">

	<?php while ( have_posts() ) : the_post(); ?>
		<article>
			<h1 class="entry-title">
				<?php the_title(); ?>
			</h1>
			<div class="entry-content">
				<?php the_content(); ?>
			</div>
		</article>
	<?php endwhile; ?>

	</section>
	<!-- /main -->

	<?php else : ?>
		<?php // get_template_part( 'content', 'none' ); ?>
	<?php endif; ?>

<?php get_footer(); ?>
