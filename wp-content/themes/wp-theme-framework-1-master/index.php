<?php get_header(); ?>

  <div class="main" role="main">

    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

      <article class="entry">

        <h1 class="entry-title">
          <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
        </h1>

        <div class="entry-content">
          <?php the_content(); ?>
        </div>

      </article>

    <?php endwhile; ?>
      <?php wtf_paginate( 'Pagination', 'pagination-primary clearfix' ); ?>
    <?php else: ?>
      <?php get_template_part( 'content', '404' ); ?>
    <?php endif; ?>

  </div>
  <!-- /main -->

<?php /*get_sidebar(); */?>
<?php get_footer(); ?>
