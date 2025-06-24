<?php
/**
 * SVG Menu CSS Enqueue
 *
 * @package ID_Basica_Addons
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Enqueue SVG menu icon styles
 */
function id_basica_addons_enqueue_svg_menu_styles() {
	// For frontend
	wp_enqueue_style(
		'id-basica-svg-menu-icons',
		ID_BASICA_ADDONS_URL . 'assets/css/svg-menu-icons.css',
		array(),
		ID_BASICA_ADDONS_VERSION
	);

	// For admin menu editor
	add_action( 'admin_enqueue_scripts', 'id_basica_addons_admin_svg_menu_styles' );
}
add_action( 'wp_enqueue_scripts', 'id_basica_addons_enqueue_svg_menu_styles' );

/**
 * Enqueue SVG menu icon styles for admin
 * 
 * @param string $hook Current admin page.
 */
function id_basica_addons_admin_svg_menu_styles( $hook ) {
	// Only add to nav-menus.php admin page
	if ( 'nav-menus.php' === $hook ) {
		wp_enqueue_style(
			'id-basica-admin-svg-menu-icons',
			ID_BASICA_ADDONS_URL . 'assets/css/svg-menu-icons.css',
			array(),
			ID_BASICA_ADDONS_VERSION
		);
	}
}
