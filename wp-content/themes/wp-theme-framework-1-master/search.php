<?php get_header(); ?>

	<?php if ( have_posts() ) : ?>

	<header class="page-header">
		<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'twentythirteen' ), get_search_query() ); ?></h1>
	</header>

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

<?php get_sidebar(); ?>
<?php get_footer(); ?>