<!DOCTYPE html>
<?php wtf_html( '', get_bloginfo( 'language' ) ); ?>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<title><?php wtf_title( '–' ); ?></title>

		<link rel="stylesheet" href="<?php wtf_asset( '/assets/stylesheets/main.css' ); ?>">
		<link rel="stylesheet" href="<?php wtf_asset( '/assets/stylesheets/rare.css' ); ?>">

		<script src="<?php wtf_asset( '/assets/javascripts/vendor/modernizr/modernizr.js' ); ?>"></script>

		<?php wp_head(); ?>

	</head>
	<?php wtf_body( 'wrap clearfix' ) ?>

		<header class="header" role="banner">
            <div class="navtext">
                <hgroup>
                    <h1><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                    <h2><?php bloginfo( 'description' ); ?></h2>
                </hgroup>
            </div>

			<?php wtf_nav_menu( 'navigation-primary', 'Primary Navigation', 'navigation-primary clearfix' ); ?>

		</header>
		<!-- /header -->

		<div class="content">
