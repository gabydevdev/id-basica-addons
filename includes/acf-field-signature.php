<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;

if( ! class_exists('acf_field_signature') ) :

class acf_field_signature extends acf_field {

	// Set up basic field settings
	function initialize() {
		$this->name = 'signature';
		$this->label = __('Signature', 'acf');
		$this->category = 'content';
		$this->defaults = array();
	}

	// Render field input
	function render_field( $field ) {
		$value = esc_attr($field['value']);
		// Placeholder for signature pad (to be replaced with JS canvas)
		echo '<div class="acf-signature-field">';
		echo '<input type="hidden" name="' . esc_attr($field['name']) . '" value="' . $value . '" />';
		echo '<canvas width="400" height="150" style="border:1px solid #ccc;"></canvas>';
		echo '<button type="button" class="acf-signature-clear">Clear</button>';
		echo '</div>';
	}

	// Enqueue JS/CSS for the field
	function input_admin_enqueue_scripts() {
		// Use the Webpack-bundled assets
		wp_enqueue_script('acf-signature-field', plugin_dir_url(__FILE__) . '../assets/js/acf-signature.js', array('jquery'), '1.0', true);
		wp_enqueue_style('acf-signature-field', plugin_dir_url(__FILE__) . '../assets/css/acf-signature.css');
	}
}

// Initialize
add_action('acf/include_field_types', function($version){
	new acf_field_signature();
});

endif;
