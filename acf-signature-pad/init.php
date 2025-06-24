<?php
/**
 * Registration logic for the ACF Signature Pad field.
 */

if ( ! defined( 'ABSPATH' ) )
	exit;

function id_basica_addons_include_acf_field_signature_pad( $version = false ) {
	require_once __DIR__ . '/class-id-basica-addons-acf-field-signature-pad.php';
	acf_register_field_type( 'id_basica_addons_acf_field_signature_pad' );
}
add_action( 'acf/include_field_types', 'id_basica_addons_include_acf_field_signature_pad' );

// AJAX handler to save the signature image
add_action( 'wp_ajax_save_signature_image', 'id_basica_addons_save_signature_image' );
add_action( 'wp_ajax_nopriv_save_signature_image', 'id_basica_addons_save_signature_image' );

function id_basica_addons_save_signature_image() {
	if ( ! isset( $_FILES['signature'] ) || empty( $_FILES['signature']['tmp_name'] ) ) {
		wp_send_json_error( [ 'message' => 'No signature received.' ] );
	}

	$file = $_FILES['signature'];
	$type = mime_content_type( $file['tmp_name'] );
	if ( $type !== 'image/png' ) {
		wp_send_json_error( [ 'message' => 'Invalid file type.' ] );
	}

	$upload_dir     = wp_upload_dir();
	$signatures_dir = trailingslashit( $upload_dir['basedir'] ) . 'signatures';
	if ( ! file_exists( $signatures_dir ) ) {
		wp_mkdir_p( $signatures_dir );
	}

	$filename    = 'signature-' . uniqid() . '.png';
	$destination = trailingslashit( $signatures_dir ) . $filename;

	if ( ! move_uploaded_file( $file['tmp_name'], $destination ) ) {
		wp_send_json_error( [ 'message' => 'Could not save file.' ] );
	}

	$url = trailingslashit( $upload_dir['baseurl'] ) . 'signatures/' . $filename;
	wp_send_json_success( [ 'url' => $url ] );
}
