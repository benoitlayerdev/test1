<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<h1><?php bloginfo( 'name' ); ?></h1>
	<p class="deploy-marker">Déploiement : <?php echo esc_html( OVH_TEST_DEPLOY_MARKER ); ?></p>

	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<article>
			<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
			<?php the_content(); ?>
		</article>
	<?php endwhile; endif; ?>

	<?php wp_footer(); ?>
</body>
</html>
