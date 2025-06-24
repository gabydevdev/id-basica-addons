# ID Basica Addons Plugin Structure

```
📁id-basica-addons
├── 📁acf-signature-pad              # ACF Signature Pad field type
│   ├── 📁assets                     # Field-specific assets
│   │   ├── 📁css
│   │   │   └── field.css            # Styles for the signature field
│   │   ├── 📁images
│   │   │   └── field-preview-custom.png  # Preview image for the field
│   │   └── 📁js
│   │       └── field.js             # JavaScript for the signature field
│   ├── class-id-basica-addons-acf-field-signature-pad.php  # Field class implementation
│   └── init.php                     # Field initialization
├── 📁admin                          # Admin-specific functionalities
├── 📁assets                         # Global plugin assets
│   ├── 📁css
│   │   └── svg-menu-icons.css       # Styles for SVG menu icons
│   └── 📁js
│       └── admin-svg-menu.js        # JavaScript for admin SVG menu
├── 📁includes                       # Core PHP files for plugin functionality
│   ├── activation.php               # Plugin activation hooks
│   ├── class-id-basica-addons-menu-walker.php  # Custom menu walker
│   ├── class-id-basica-addons.php   # Main plugin class
│   ├── deactivation.php             # Plugin deactivation hooks
│   ├── svg-menu-styles.php          # SVG menu styling functions
│   └── svg-menu.php                 # SVG menu functionality
├── 📁languages                      # Translation files
├── 📁public                         # Public-facing assets and code
├── 📁src                            # Source files for custom scripts
│   └── 📁js
│       └── acf-signature.js         # Source JavaScript for ACF integration
├── gruntfile.js                     # Grunt task runner configuration
├── id-basica-addons.php             # Main plugin file
├── package.json                     # Node.js dependencies and scripts
└── webpack.config.js                # Webpack configuration
```
