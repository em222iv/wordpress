<?php get_header(); ?>

	<?php while ( have_posts() ) : the_post(); ?>

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
<!--
--><?php /*get_sidebar(); */?>
<?php get_footer(); ?>
