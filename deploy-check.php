<?php
/**
 * Page de contrôle du déploiement : https://<site>/deploy-check.php
 * Fichier PHP hors thème et hors extension, à la racine du site.
 * À SUPPRIMER avant la mise en production (il affiche des infos techniques).
 */

require __DIR__ . '/wp-load.php';

header( 'X-Robots-Tag: noindex, nofollow' );

$theme  = wp_get_theme();
$checks = array(
	'Ce fichier (racine)'        => 'OK, déployé le ' . wp_date( 'd/m/Y H:i:s', filemtime( __FILE__ ) ),
	'Thème actif'                => $theme->get( 'Name' ) . ' v' . $theme->get( 'Version' ),
	'Marqueur du thème'          => defined( 'OVH_TEST_DEPLOY_MARKER' ) ? OVH_TEST_DEPLOY_MARKER : 'non chargé',
	'Extension OVH Test Deploy'  => function_exists( 'ovh_test_deploy_plugin_version' ) ? 'active v' . ovh_test_deploy_plugin_version() : 'inactive ou absente',
	'MU-plugin OVH Deploy Check' => function_exists( 'ovh_deploy_check_mu_version' ) ? 'chargé v' . ovh_deploy_check_mu_version() : 'absent',
	'Fichiers dans uploads/'     => function_exists( 'ovh_test_deploy_uploads_count' ) ? (string) ovh_test_deploy_uploads_count() : 'activer l’extension pour compter',
	'Fichier test-suppression'   => file_exists( __DIR__ . '/test-suppression.txt' ) ? 'présent' : 'absent',
	'PHP / WordPress'            => PHP_VERSION . ' / ' . get_bloginfo( 'version' ),
);
?>
<!doctype html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<meta name="robots" content="noindex, nofollow">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Contrôle du déploiement</title>
	<style>
		body { font-family: system-ui, sans-serif; max-width: 640px; margin: 3rem auto; padding: 0 1rem; color: #14213d; }
		table { width: 100%; border-collapse: collapse; }
		th, td { text-align: left; padding: .6rem .75rem; border-bottom: 1px solid #dfe3ec; }
		th { width: 45%; color: #5c677d; font-weight: 600; }
	</style>
</head>
<body>
	<h1>Contrôle du déploiement</h1>
	<table>
		<?php foreach ( $checks as $label => $value ) : ?>
			<tr><th><?php echo esc_html( $label ); ?></th><td><?php echo esc_html( $value ); ?></td></tr>
		<?php endforeach; ?>
	</table>
</body>
</html>
