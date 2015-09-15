<?php
/**
 * Template Name: Cases Page Template
 *
 */
?>

<?php get_header(); ?>

	<?php while ( have_posts() ) : the_post(); ?>

        <h1>test</h1>
        <?php
            $field2 = get_field('pic');
            $text = get_field('text');
        ;?>
        <div class="field">
            <img src="<?php print_r($field2[sizes][thumbnail]) ?>">
            <div class="field-text">
                <?php echo $text  ?>
            </div>
        </div>

        <div class="container help-grid full-width">
	</div>

	<div class="container help-grid">

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

<?php /*get_sidebar(); */?>
<?php get_footer(); ?>
