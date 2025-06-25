<?php

class id_basica_addons_acf_field_signature_pad extends \acf_field {

	public $show_in_rest = true;
	private $env;

	public function __construct() {
		$this->name     = 'signature';
		$this->label    = __( 'Signature', 'id-basica-addons' );
		$this->category = 'content';
		$this->defaults = array();

		$this->env = array(
			'url'     => ID_BASICA_ADDONS_URL . 'acf-signature',
			'version' => '1.0.0',
		);

		parent::__construct();
	}

	public function render_field_settings( $field ) {
		// Optional
	}

	public function render_field( $field ) {
		/*
		 *  Review the data of $field.
		 *  This will show what data is available
		 */

		// echo '<pre>';
		// 	print_r( $field );
		// echo '</pre>';


		/*
		 *  Create a simple text input using the 'font_size' setting.
		 */

		?>
		<div class="acf-input-wrap">
            <div id="signature-pad" class="m-signature-pad">
                <input type="hidden" name="<?php echo $field['name']; ?>" value="<?php echo $field['value']; ?>" />
                <div class="m-signature-pad--body">
                    <canvas></canvas>
                </div>
                <div class="m-signature-pad--footer">
                    <a href="#clear" class="m-signature-pad--clear btn btn-default btn-xs button button-small" data-action="clear">
						<?php _e('Clear', 'id-basica-addons'); ?>
					</a>
                </div>
            </div>
        </div>
		<?php
	}

	public function input_admin_enqueue_scripts() {
		$url     = trailingslashit( $this->env['url'] );
		$version = $this->env['version'];

		wp_register_script(
			'id-basica-addons-signature-pad-lib',
			"{$url}js/signature_pad.js"
		);
		wp_enqueue_script( 'id-basica-addons-signature-pad-lib' );

		wp_register_script(
			'id-basica-addons-signature-pad',
			"{$url}js/field.js",
			array( 'acf-input', 'id-basica-addons-signature-pad-lib' )
		);
		wp_enqueue_script( 'id-basica-addons-signature-pad' );

		wp_register_style(
			'id-basica-addons-signature-pad',
			"{$url}css/field.css"
		);
		wp_enqueue_style( 'id-basica-addons-signature-pad' );
	}
}
