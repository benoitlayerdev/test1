<?php
/**
 * Plugin Name: OVH Test Deploy
 * Description: Extension témoin pour tester le déploiement Git sur OVH. Ajoute un badge dans la barre d'admin et une ligne en pied de page.
 * Version: 1.0
 * Author: Layerdev
 * Text Domain: ovh-test-deploy
 * Requires PHP: 7.4
 */

defined( 'ABSPATH' ) || exit;

define( 'OVH_TEST_DEPLOY_PLUGIN_VERSION', '1.0' );

function ovh_test_deploy_plugin_version() {
	return OVH_TEST_DEPLOY_PLUGIN_VERSION;
}

// Badge dans la barre d'admin (visible quand on est connecté).
add_action( 'admin_bar_menu', function ( $admin_bar ) {
	$admin_bar->add_node( array(
		'id'    => 'ovh-test-deploy',
		'title' => '🚀 Extension Git v' . OVH_TEST_DEPLOY_PLUGIN_VERSION,
	) );
}, 100 );

// Ligne en bas de chaque page du site public.
add_action( 'wp_footer', function () {
	printf(
		'<p style="text-align:center;font-size:.8rem;opacity:.7;margin:2rem 0 1rem;">Extension « OVH Test Deploy » v%s active</p>',
		esc_html( OVH_TEST_DEPLOY_PLUGIN_VERSION )
	);
} );
