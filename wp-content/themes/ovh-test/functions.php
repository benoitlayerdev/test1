<?php
// Thème témoin : change la valeur ci-dessous pour vérifier qu'un déploiement a bien eu lieu.
define( 'OVH_TEST_DEPLOY_MARKER', 'Version 1 - branche dev' );

add_action( 'after_setup_theme', function () {
	add_theme_support( 'title-tag' );
} );
