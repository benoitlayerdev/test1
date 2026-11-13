<?php
/**
 * Plugin Name: OVH Deploy Check (MU)
 * Description: MU-plugin témoin. Contrairement à une extension classique, il est chargé automatiquement dès que le fichier est sur le serveur : aucune activation en base de données.
 * Version: 1.0
 * Author: Layerdev
 */

defined( 'ABSPATH' ) || exit;

function ovh_deploy_check_mu_version() {
	return '1.0';
}

// En-tête HTTP visible dans l'onglet Réseau du navigateur : X-OVH-Deploy.
add_action( 'send_headers', function () {
	header( 'X-OVH-Deploy: mu-plugin v' . ovh_deploy_check_mu_version() );
} );

// Message sur le tableau de bord de l'admin.
add_action( 'admin_notices', function () {
	$screen = get_current_screen();
	if ( ! $screen || 'dashboard' !== $screen->id ) {
		return;
	}
	echo '<div class="notice notice-info"><p><strong>MU-plugin OVH Deploy Check v'
		. esc_html( ovh_deploy_check_mu_version() )
		. '</strong> chargé automatiquement (déployé par Git, aucune activation nécessaire).</p></div>';
} );
