<?php
/**
 * Plugin Name:     ID Basica Addons
 * Plugin URI:      https://identidadbasica.com/
 * Description:     Custom ACF fields and configurations for ID Basica theme
 * Author:          Gabriela C.
 * Author URI:      https://github.com/gabydevdev
 * Text Domain:     id-basica-addons
 * Domain Path:     /languages
 * Version:         0.1.0
 *
 * @package         ID_Basica_Addons
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Define plugin constants.
define( 'ID_BASICA_ADDONS_VERSION', '0.1.0' );
define( 'ID_BASICA_ADDONS_DIR', plugin_dir_path( __FILE__ ) );
define( 'ID_BASICA_ADDONS_URL', plugin_dir_url( __FILE__ ) );

/**
 * Registers the ACF field type.
 */
function id_basica_addons_include_acf_field_signature_pad() {
	if ( ! function_exists( 'acf_register_field_type' ) ) {
		return;
	}

	// Ensure the required file exists before including
	if ( file_exists( ID_BASICA_ADDONS_DIR . '/inc/class-id-basica-addons-acf-field-signature-pad.php' ) ) {
		require_once ID_BASICA_ADDONS_DIR . '/inc/class-id-basica-addons-acf-field-signature-pad.php';
	} else {
		error_log( 'Required file class-id-basica-addons-acf-field-signature-pad.php is missing.' );
		return;
	}

	// Ensure the argument passed to acf_register_field_type is an instance of the required class
	if ( class_exists( 'id_basica_addons_acf_field_signature_pad' ) ) {
		acf_register_field_type( new id_basica_addons_acf_field_signature_pad() );
	} else {
		error_log( 'Class id_basica_addons_acf_field_signature_pad does not exist.' );
	}
}
add_action( 'init', 'id_basica_addons_include_acf_field_signature_pad' );

// Include core plugin files
require_once ID_BASICA_ADDONS_DIR . 'includes/class-id-basica-addons.php';
require_once ID_BASICA_ADDONS_DIR . 'includes/activation.php';
require_once ID_BASICA_ADDONS_DIR . 'includes/deactivation.php';

// Include the custom field class
require_once ID_BASICA_ADDONS_DIR . 'includes/class-id-basica-addons-acf-field-signature-pad.php';

// Initialize the core plugin class
if ( class_exists( 'ID_Basica_Addons' ) ) {
    new ID_Basica_Addons();
}

// Register activation and deactivation hooks
register_activation_hook( __FILE__, 'id_basica_addons_activate' );
register_deactivation_hook( __FILE__, 'id_basica_addons_deactivate' );