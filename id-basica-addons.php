<?php
/**
 * Plugin Name:     ID Basica Addons
 * Plugin URI:      https://identidadbasica.com/
 * Description:     Custom ACF fields and configurations for ID Basica theme
 * Author:          Gabriela C.
 * Author URI:      https://github.com/gabydevdev
 * Text Domain:     idbasica-addons
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

	require_once ID_BASICA_ADDONS_DIR . '/includes/class-idbasica-addons-acf-field-signature-pad.php';

	acf_register_field_type( 'id_basica_addons_acf_field_signature_pad' );
}
add_action( 'init', 'id_basica_addons_include_acf_field_signature_pad' );