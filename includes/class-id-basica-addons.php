<?php
/**
 * Core plugin class for ID Basica Addons.
 */
class ID_Basica_Addons {

    /**
     * Initialize the plugin by setting up hooks.
     */
    public function __construct() {
        add_action( 'init', [ $this, 'register_acf_field' ] );
    }

    /**
     * Register the ACF field type.
     */
    public function register_acf_field() {
        if ( ! function_exists( 'acf_register_field_type' ) ) {
            return;
        }

        if ( file_exists( ID_BASICA_ADDONS_DIR . 'includes/class-id-basica-addons-acf-field-signature-pad.php' ) ) {
            require_once ID_BASICA_ADDONS_DIR . 'includes/class-id-basica-addons-acf-field-signature-pad.php';
            if ( class_exists( 'id_basica_addons_acf_field_signature_pad' ) ) {
                // Correct the argument passed to acf_register_field_type
                acf_register_field_type( 'id_basica_addons_acf_field_signature_pad' );
            }
        }
    }
}
