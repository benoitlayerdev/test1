<?php
/**
 * Shortcode [ovh_deploy_info] : à coller dans une page ou un article pour afficher l'état du déploiement.
 */

defined( 'ABSPATH' ) || exit;

add_shortcode( 'ovh_deploy_info', function () {
	$theme = wp_get_theme();

	return sprintf(
		'<div style="padding:1rem 1.25rem;border:2px dashed #5b3cc4;border-radius:10px;background:#efeafd;">'
		. '<strong>Shortcode OK</strong> · thème %1$s v%2$s · extension v%3$s · %4$d fichier(s) dans uploads/'
		. '</div>',
		esc_html( $theme->get( 'Name' ) ),
		esc_html( $theme->get( 'Version' ) ),
		esc_html( OVH_TEST_DEPLOY_PLUGIN_VERSION ),
		(int) ovh_test_deploy_uploads_count()
	);
} );
