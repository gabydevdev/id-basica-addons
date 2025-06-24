<?php
/**
 * Custom Walker for Menu Editor
 *
 * @package ID_Basica_Addons
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Custom Walker Class for Nav Menu Editor
 * 
 * Extends the WordPress Walker_Nav_Menu_Edit to add a custom field for SVG icons
 */
class ID_Basica_Addons_Menu_Walker extends Walker_Nav_Menu_Edit {
	/**
	 * Start the element output.
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item   Menu item data object.
	 * @param int    $depth  Depth of menu item.
	 * @param array  $args   Menu item args.
	 * @param int    $id     Nav menu ID.
	 */
	function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
		// Call original Walker_Nav_Menu_Edit
		$original_output = '';
		parent::start_el( $original_output, $item, $depth, $args, $id );        // Find the position to add our custom field
		// Look for the closing div of the menu-item-settings
		$position = strpos( $original_output, '<fieldset class="field-move">' );

		// SVG icon field HTML
		$svg_icon_value = get_post_meta( $item->ID, '_menu_item_svg_icon', true );
		$svg_field      = '
            <p class="field-svg-icon description description-wide">
                <label for="edit-menu-item-svg-icon-' . $item->ID . '">
                    ' . esc_html__( 'SVG Icon HTML', 'id-basica-addons' ) . '<br />
                    <textarea id="edit-menu-item-svg-icon-' . $item->ID . '" 
                        class="widefat code edit-menu-item-svg-icon" 
                        name="menu-item-svg-icon[' . $item->ID . ']" 
                        rows="3">' . esc_textarea( $svg_icon_value ) . '</textarea>
                    <span class="description">' . esc_html__( 'Enter SVG HTML code to display before the menu item text.', 'id-basica-addons' ) . '</span>
                </label>
            </p>';
		// Insert the custom field before the closing </div>
		if ( $position !== false ) {
			$output .= substr( $original_output, 0, $position );
			$output .= $svg_field;
			$output .= substr( $original_output, $position );
		} else {
			$output .= $original_output;
		}
	}
}
