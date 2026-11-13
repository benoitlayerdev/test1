<?php get_header(); ?>

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

<?php get_footer(); ?>
