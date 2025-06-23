/**
 * Admin JavaScript for SVG Menu Icons
 */
jQuery(document).ready(function($) {
    // Check if the wp_nav_menu_item_custom_fields hook doesn't work
    // by checking if our fields already exist
    if ($('.field-svg-icon').length === 0) {
        // Handle legacy WordPress versions by adding the fields dynamically
        $('#menu-to-edit li.menu-item').each(function() {
            var menuItem = $(this);
            var menuItemId = menuItem.attr('id').replace('menu-item-', '');
            var descriptionFieldsContainer = menuItem.find('.menu-item-settings .description-thin').parent();
            
            // Get the SVG icon value for this menu item via Ajax
            $.ajax({
                url: ajaxurl,
                type: 'POST',
                data: {
                    action: 'id_basica_get_menu_svg_icon',
                    menu_item_id: menuItemId,
                    nonce: id_basica_menu_vars.nonce
                },
                success: function(response) {
                    if (response.success) {
                        // Create the SVG icon field
                        var svgField = 
                            '<p class="field-svg-icon description description-wide">' +
                                '<label for="edit-menu-item-svg-icon-' + menuItemId + '">' +
                                    'SVG Icon HTML<br />' +
                                    '<textarea id="edit-menu-item-svg-icon-' + menuItemId + '" ' +
                                        'class="widefat code edit-menu-item-svg-icon" ' +
                                        'name="menu-item-svg-icon[' + menuItemId + ']" ' +
                                        'rows="3">' + response.data + '</textarea>' +
                                    '<span class="description">Enter SVG HTML code to display before the menu item text.</span>' +
                                '</label>' +
                            '</p>';
                        
                        // Add the field before the Move section
                        menuItem.find('.menu-item-settings .field-move').before(svgField);
                    }
                }
            });
        });
    }
});
