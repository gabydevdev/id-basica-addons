<?php
/**
 * Custom ACF Field: Signature Pad
 */
if ( ! class_exists( 'id_basica_addons_acf_field_signature_pad' ) ) {

    class id_basica_addons_acf_field_signature_pad extends acf_field {

        /**
         * Constructor
         */
        public function __construct() {
            $this->name = 'signature_pad';
            $this->label = __( 'Signature Pad', 'id-basica-addons' );
            $this->category = 'basic';
            $this->defaults = [];

            // Enqueue assets
            add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_assets' ] );

            parent::__construct();
        }

        /**
         * Enqueue JavaScript and CSS
         */
        public function enqueue_assets() {
            wp_enqueue_script( 'signature-pad', ID_BASICA_ADDONS_URL . 'assets/js/signature-pad.js', [ 'jquery' ], ID_BASICA_ADDONS_VERSION, true );
            wp_enqueue_style( 'signature-pad', ID_BASICA_ADDONS_URL . 'assets/css/signature-pad.css', [], ID_BASICA_ADDONS_VERSION );
        }

        /**
         * Render the field
         */
        public function render_field( $field ) {
            echo '<div class="signature-pad-container">';
            echo '<canvas class="signature-pad"></canvas>';
            echo '<input type="hidden" name="' . esc_attr( $field['name'] ) . '" value="' . esc_attr( $field['value'] ) . '" />';
            echo '</div>';
        }
    }
}
