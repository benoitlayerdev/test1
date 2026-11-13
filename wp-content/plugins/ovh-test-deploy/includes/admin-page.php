<?php
/**
 * Page d'admin : Outils → Test déploiement.
 */

defined( 'ABSPATH' ) || exit;

add_action( 'admin_menu', function () {
	add_management_page(
		'Test déploiement',
		'Test déploiement',
		'manage_options',
		'ovh-test-deploy',
		'ovh_test_deploy_render_admin_page'
	);
} );

function ovh_test_deploy_render_admin_page() {
	$theme = wp_get_theme();
	$rows  = array(
		'Thème actif'                 => $theme->get( 'Name' ) . ' v' . $theme->get( 'Version' ),
		'Extension OVH Test Deploy'   => 'v' . OVH_TEST_DEPLOY_PLUGIN_VERSION,
		'MU-plugin OVH Deploy Check'  => function_exists( 'ovh_deploy_check_mu_version' ) ? 'v' . ovh_deploy_check_mu_version() : 'absent',
		'Fichiers dans uploads/'      => ovh_test_deploy_uploads_count(),
		'Extension déployée le'       => wp_date( 'd/m/Y H:i:s', filemtime( OVH_TEST_DEPLOY_PLUGIN_DIR . 'ovh-test-deploy.php' ) ),
		'PHP'                         => PHP_VERSION,
		'WordPress'                   => get_bloginfo( 'version' ),
	);
	?>
	<div class="wrap">
		<h1>Test déploiement Git</h1>
		<p>Si cette page s'affiche, les fichiers du sous-dossier <code>includes/</code> ont bien été déployés.</p>
		<table class="widefat striped" style="max-width:640px">
			<tbody>
			<?php foreach ( $rows as $label => $value ) : ?>
				<tr>
					<th scope="row"><?php echo esc_html( $label ); ?></th>
					<td><?php echo esc_html( (string) $value ); ?></td>
				</tr>
			<?php endforeach; ?>
			</tbody>
		</table>
		<p>Note le nombre de fichiers dans <code>uploads/</code> avant un déploiement, puis revérifie après : il doit être identique.</p>
	</div>
	<?php
}
