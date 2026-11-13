<?php $ovh_info = ovh_test_deploy_info(); ?>
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
		<a class="site-title" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
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
		Déploiement : <?php echo esc_html( $ovh_info['marker'] ); ?>
	</p>

	<main>
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<article <?php post_class( 'card' ); ?>>
				<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
				<p class="post-meta"><?php echo esc_html( get_the_date() ); ?> · <?php the_author(); ?></p>
				<?php is_singular() ? the_content() : the_excerpt(); ?>
			</article>
		<?php endwhile; ?>
			<?php the_posts_pagination(); ?>
		<?php else : ?>
			<p class="card">Aucun contenu pour le moment.</p>
		<?php endif; ?>
	</main>

	<footer class="site-footer">
		<p>Thème OVH Test v<?php echo esc_html( $ovh_info['version'] ); ?> · fichiers déployés le <?php echo esc_html( $ovh_info['deployed'] ); ?></p>
		<p>WordPress <?php echo esc_html( $ovh_info['wp'] ); ?> · PHP <?php echo esc_html( $ovh_info['php'] ); ?></p>
		<p>Extension OVH Test Deploy : <strong><?php echo esc_html( $ovh_info['plugin'] ); ?></strong></p>
	</footer>

	<?php wp_footer(); ?>
</body>
</html>
