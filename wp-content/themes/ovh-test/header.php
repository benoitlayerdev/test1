<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>

	<header class="site-header">
		<a class="site-title" href="<?php echo esc_url( home_url( '/' ) ); ?>">
			<img class="site-logo" src="<?php echo esc_url( get_template_directory_uri() . '/assets/logo.svg' ); ?>" alt="" width="40" height="40">
			<?php bloginfo( 'name' ); ?>
		</a>
		<?php if ( get_bloginfo( 'description' ) ) : ?>
			<p class="site-tagline"><?php bloginfo( 'description' ); ?></p>
		<?php endif; ?>
		<?php
		wp_nav_menu( array(
			'theme_location' => 'primary',
			'container'      => 'nav',
			'fallback_cb'    => false,
			'depth'          => 1,
		) );
		?>
	</header>

	<p class="deploy-marker">
		<span class="deploy-dot" aria-hidden="true"></span>
		Déploiement : <?php echo esc_html( OVH_TEST_DEPLOY_MARKER ); ?>
	</p>
