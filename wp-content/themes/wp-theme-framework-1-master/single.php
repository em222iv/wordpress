<?php get_header(); ?>

  <?php while ( have_posts() ) : the_post(); ?>

    <article class="entry main" role="main">

      <h1 class="entry-title">
        <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
      </h1>

      <div class="entry-content">
        <?php the_content(); ?>
      </div>

      <?php wtf_paginate( 'Pagination', 'pagination-secondary clearfix' ); ?>

    </article>
    <!-- /main -->

  <?php endwhile; ?>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
