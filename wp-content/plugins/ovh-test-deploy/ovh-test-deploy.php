<?php
/**
 * Plugin Name: OVH Test Deploy
 * Description: Extension témoin pour tester le déploiement Git sur OVH. Badge dans la barre d'admin, page Outils → Test déploiement, shortcode [ovh_deploy_info].
 * Version: 1.1
 * Author: Layerdev
 * Text Domain: ovh-test-deploy
 * Requires PHP: 7.4
 */

defined( 'ABSPATH' ) || exit;

define( 'OVH_TEST_DEPLOY_PLUGIN_VERSION', '1.1' );
define( 'OVH_TEST_DEPLOY_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

function ovh_test_deploy_plugin_version() {
	return OVH_TEST_DEPLOY_PLUGIN_VERSION;
}

/**
 * Nombre de fichiers dans uploads/ : permet de vérifier qu'un déploiement ne les a pas supprimés.
 */
function ovh_test_deploy_uploads_count() {
	$dir = wp_upload_dir();
	$dir = $dir['basedir'];
	if ( ! is_dir( $dir ) ) {
		return 0;
	}
	$count = 0;
	$files = new RecursiveIteratorIterator( new RecursiveDirectoryIterator( $dir, FilesystemIterator::SKIP_DOTS ) );
	foreach ( $files as $file ) {
		if ( $file->isFile() ) {
			$count++;
		}
	}
	return $count;
}

// Fichiers dans un sous-dossier : teste le déploiement de nouveaux dossiers.
require_once OVH_TEST_DEPLOY_PLUGIN_DIR . 'includes/admin-page.php';
require_once OVH_TEST_DEPLOY_PLUGIN_DIR . 'includes/shortcode.php';

// Badge dans la barre d'admin (visible quand on est connecté).
add_action( 'admin_bar_menu', function ( $admin_bar ) {
	$admin_bar->add_node( array(
		'id'    => 'ovh-test-deploy',
		'title' => '🚀 Extension Git v' . OVH_TEST_DEPLOY_PLUGIN_VERSION,
		'href'  => admin_url( 'tools.php?page=ovh-test-deploy' ),
	) );
}, 100 );

// Ligne en bas de chaque page du site public.
add_action( 'wp_footer', function () {
	printf(
		'<p style="text-align:center;font-size:.8rem;opacity:.7;margin:2rem 0 1rem;">Extension « OVH Test Deploy » v%s active</p>',
		esc_html( OVH_TEST_DEPLOY_PLUGIN_VERSION )
	);
} );
