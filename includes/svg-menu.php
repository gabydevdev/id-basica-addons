<?php
/**
 * SVG Menu Functionality
 *
 * @package ID_Basica_Addons
 */

// Function to add SVG field to menu items
function id_basica_addons_add_svg_field( $menu_item ) {
	$menu_item->svg_icon = get_post_meta( $menu_item->ID, '_menu_item_svg_icon', true );
	return $menu_item;
}
add_filter( 'wp_setup_nav_menu_item', 'id_basica_addons_add_svg_field' );

// Function to save SVG field
function id_basica_addons_save_svg_field( $menu_id, $menu_item_db_id, $args ) {
	if ( isset( $_POST['menu-item-svg-icon'][ $menu_item_db_id ] ) ) {
		update_post_meta( $menu_item_db_id, '_menu_item_svg_icon', $_POST['menu-item-svg-icon'][ $menu_item_db_id ] );
	}
}
add_action( 'wp_update_nav_menu_item', 'id_basica_addons_save_svg_field', 10, 3 );

// Function to display SVG field in menu editor
function id_basica_addons_edit_nav_menu_walker( $walker, $menu_id ) {
	require_once plugin_dir_path( __FILE__ ) . 'class-id-basica-addons-menu-walker.php';
	return 'ID_Basica_Addons_Menu_Walker';
}
add_filter( 'wp_edit_nav_menu_walker', 'id_basica_addons_edit_nav_menu_walker', 10, 2 );

// Function to render SVG in menu items
function id_basica_addons_render_svg_icon( $item_output, $item, $depth, $args ) {
	if ( ! empty( $item->svg_icon ) ) {
		$svg         = '<span class="menu-item-svg">' . $item->svg_icon . '</span> ';
		$item_output = $svg . $item_output;
	}
	return $item_output;
}
add_filter( 'walker_nav_menu_start_el', 'id_basica_addons_render_svg_icon', 10, 4 );

// Function to add custom fields directly to menu items
function id_basica_addons_menu_item_custom_fields( $item_id, $item ) {
	$svg_icon_value = get_post_meta( $item_id, '_menu_item_svg_icon', true );
	?>
	<p class="field-svg-icon description description-wide">
		<label for="edit-menu-item-svg-icon-<?php echo esc_attr( $item_id ); ?>">
			<?php esc_html_e( 'SVG Icon HTML', 'id-basica-addons' ); ?><br />
			<textarea id="edit-menu-item-svg-icon-<?php echo esc_attr( $item_id ); ?>" class="widefat code" name="menu-item-svg-icon[<?php echo esc_attr( $item_id ); ?>]" rows="3"><?php echo esc_textarea( $svg_icon_value ); ?></textarea>
			<span class="description"><?php esc_html_e( 'Enter SVG HTML code to display before the menu item text.', 'id-basica-addons' ); ?></span>
		</label>
	</p>
	<?php
}
add_action( 'wp_nav_menu_item_custom_fields', 'id_basica_addons_menu_item_custom_fields', 10, 2 );

// Enqueue admin scripts for menu editor
function id_basica_addons_enqueue_admin_menu_scripts( $hook ) {
	if ( 'nav-menus.php' !== $hook ) {
		return;
	}

	wp_enqueue_script(
		'id-basica-admin-svg-menu',
		ID_BASICA_ADDONS_URL . 'assets/js/admin-svg-menu.js',
		array( 'jquery' ),
		ID_BASICA_ADDONS_VERSION,
		true
	);

	wp_localize_script(
		'id-basica-admin-svg-menu',
		'id_basica_menu_vars',
		array(
			'nonce' => wp_create_nonce( 'id_basica_menu_nonce' ),
		)
	);
}
add_action( 'admin_enqueue_scripts', 'id_basica_addons_enqueue_admin_menu_scripts' );

// Ajax handler to get menu item SVG icon
function id_basica_addons_get_menu_svg_icon() {
	// Security check
	if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( $_POST['nonce'], 'id_basica_menu_nonce' ) ) {
		wp_send_json_error( 'Invalid security token' );
		return;
	}

	$menu_item_id = isset( $_POST['menu_item_id'] ) ? absint( $_POST['menu_item_id'] ) : 0;

	if ( $menu_item_id ) {
		$svg_icon = get_post_meta( $menu_item_id, '_menu_item_svg_icon', true );
		wp_send_json_success( $svg_icon );
	}

	wp_send_json_error( 'Menu item ID not provided' );
}
add_action( 'wp_ajax_id_basica_get_menu_svg_icon', 'id_basica_addons_get_menu_svg_icon' );
