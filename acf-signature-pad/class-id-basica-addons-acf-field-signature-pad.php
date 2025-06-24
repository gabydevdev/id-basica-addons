<?php
if ( ! defined( 'ABSPATH' ) )
	exit;

class id_basica_addons_acf_field_signature_pad extends \acf_field {

	public $show_in_rest = true;
	private $env;

	public function __construct() {
		$this->name     = 'signature_pad';
		$this->label    = __( 'Signature Pad', 'id-basica-addons' );
		$this->category = 'content';
		$this->defaults = array();
		$this->l10n     = array(
			'error' => __( 'Error! Please enter a higher value', 'id-basica-addons' ),
		);

		$this->env = array(
			'url'     => site_url( str_replace( ABSPATH, '', __DIR__ ) ),
			'version' => '1.0.0',
		);

		$this->preview_image = $this->env['url'] . '/assets/images/field-preview-custom.png';

		parent::__construct();
	}

	public function render_field_settings( $field ) {
		// Optional
	}

	public function render_field( $field ) {
		$value      = esc_attr( $field['value'] );
		$field_id   = esc_attr( $field['id'] );
		$field_name = esc_attr( $field['name'] );

		echo '<div class="acf-signature-wrapper">';
		echo '<canvas class="acf-signature-canvas" width="400" height="200"></canvas>';
		echo '<input type="hidden" name="' . $field_name . '" value="' . $value . '" class="acf-signature-input" />';
		echo '<button type="button" class="acf-signature-clear button">' . __( 'Clear', 'id-basica-addons' ) . '</button>';
		echo '</div>';
	}

	public function input_admin_enqueue_scripts() {
		$url     = trailingslashit( $this->env['url'] );
		$version = $this->env['version'];

		wp_register_script(
			'id-basica-addons-signature-pad',
			"{$url}assets/js/acf-signature.js",
			array( 'acf-input', 'id-basica-addons-signature-pad-lib' ),
			$version,
			true
		);

		wp_register_style(
			'id-basica-addons-signature-pad',
			"{$url}assets/css/acf-signature.css",
			array( 'acf-input' ),
			$version
		);

		wp_enqueue_script( 'id-basica-addons-signature-pad-lib' );
		wp_enqueue_script( 'id-basica-addons-signature-pad' );
		wp_enqueue_style( 'id-basica-addons-signature-pad' );
	}
}
