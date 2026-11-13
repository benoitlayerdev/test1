<?php
// Thème témoin : change la valeur ci-dessous pour vérifier qu'un déploiement a bien eu lieu.
define( 'OVH_TEST_DEPLOY_MARKER', 'Version 6 - multi-fichiers' );
define( 'OVH_TEST_THEME_VERSION', '1.3' );

add_action( 'after_setup_theme', function () {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array( 'search-form', 'gallery', 'caption', 'style', 'script' ) );

	register_nav_menus( array(
		'primary' => __( 'Menu principal', 'ovh-test' ),
	) );
} );

// Charge style.css (la version sert aussi de cache-busting après chaque déploiement).
add_action( 'wp_enqueue_scripts', function () {
	wp_enqueue_style( 'ovh-test-style', get_stylesheet_uri(), array(), OVH_TEST_THEME_VERSION );
} );

/**
 * Infos de déploiement affichées dans le pied de page :
 * date de modification de functions.php = date à laquelle le fichier a été déployé sur le serveur.
 */
function ovh_test_deploy_info() {
	return array(
		'marker'   => OVH_TEST_DEPLOY_MARKER,
		'version'  => OVH_TEST_THEME_VERSION,
		'deployed' => wp_date( 'd/m/Y H:i:s', filemtime( __FILE__ ) ),
		'php'      => PHP_VERSION,
		'wp'       => get_bloginfo( 'version' ),
		// L'extension est déployée par Git, mais son activation est stockée en base de données.
		'plugin'   => function_exists( 'ovh_test_deploy_plugin_version' )
			? 'active (v' . ovh_test_deploy_plugin_version() . ')'
			: 'inactive ou absente',
		// Le MU-plugin, lui, est chargé automatiquement dès que le fichier est sur le serveur.
		'mu'       => function_exists( 'ovh_deploy_check_mu_version' )
			? 'chargé (v' . ovh_deploy_check_mu_version() . ')'
			: 'absent',
	);
}
