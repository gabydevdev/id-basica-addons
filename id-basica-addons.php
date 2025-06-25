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

// Include core plugin files
require_once ID_BASICA_ADDONS_DIR . 'includes/class-id-basica-addons.php';
require_once ID_BASICA_ADDONS_DIR . 'includes/activation.php';
require_once ID_BASICA_ADDONS_DIR . 'includes/deactivation.php';

// Include the custom field class
include_once ID_BASICA_ADDONS_DIR . '/acf-signature/acf-signature.php';

// Include SVG menu functionality
require_once ID_BASICA_ADDONS_DIR . 'includes/svg-menu.php';
require_once ID_BASICA_ADDONS_DIR . 'includes/svg-menu-styles.php';

// Initialize the core plugin class
if ( class_exists( 'ID_Basica_Addons' ) ) {
	new ID_Basica_Addons();
}

// Register activation and deactivation hooks
register_activation_hook( __FILE__, 'id_basica_addons_activate' );
register_deactivation_hook( __FILE__, 'id_basica_addons_deactivate' );
