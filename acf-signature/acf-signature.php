<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function id_basica_addons_include_acf_field_signature_pad( $version = false ) {
	require_once ID_BASICA_ADDONS_DIR . 'acf-signature/class-id-basica-addons-acf-field-signature-pad.php';
	acf_register_field_type( 'id_basica_addons_acf_field_signature_pad' );
}
add_action( 'acf/include_field_types', 'id_basica_addons_include_acf_field_signature_pad' );

// function include_field_types_signature( $version ) {
// 	include_once('acf-signature-v5.php');
// }
// add_action('acf/include_field_types', 'include_field_types_signature');
