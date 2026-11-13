<?php $ovh_info = ovh_test_deploy_info(); ?>
	<footer class="site-footer">
		<p>Thème OVH Test v<?php echo esc_html( $ovh_info['version'] ); ?> · fichiers déployés le <?php echo esc_html( $ovh_info['deployed'] ); ?></p>
		<p>WordPress <?php echo esc_html( $ovh_info['wp'] ); ?> · PHP <?php echo esc_html( $ovh_info['php'] ); ?></p>
		<p>Extension OVH Test Deploy : <strong><?php echo esc_html( $ovh_info['plugin'] ); ?></strong></p>
		<p>MU-plugin OVH Deploy Check : <strong><?php echo esc_html( $ovh_info['mu'] ); ?></strong></p>
	</footer>

	<?php wp_footer(); ?>
</body>
</html>
