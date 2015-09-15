<?php
/**
 * Template Name: Front Page Template
 *
 * http://en.support.wordpress.com/pages/front-page/
 */
?>

<?php get_header(); ?>

	<?php while ( have_posts() ) : the_post(); ?>

	<div class="container help-grid full-width">
		<div class="span12">
		</div>
	</div>

		<article class="entry main" role="main">

			<h1 class="entry-title">
				<?php the_title(); ?>
			</h1>

			<div class="entry-content">
				<?php the_content(); ?>
			</div>

		</article>
		<!-- /main -->

	<?php endwhile; ?>

<?php get_footer(); ?>
