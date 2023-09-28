<?php
/**
 * This file represents an example of the code that themes would use to register
 * the required plugins.
 *
 * It is expected that theme authors would copy and paste this code into their
 * functions.php file, and amend to suit.
 *
 * @see http://tgmpluginactivation.com/configuration/ for detailed documentation.
 *
 * @package    TGM-Plugin-Activation
 * @subpackage Example
 * @version    2.6.1 for parent theme Tws  Required
 * @author     Thomas Griffin, Gary Jones, Juliette Reinders Folmer
 * @copyright  Copyright (c) 2011, Thomas Griffin
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/TGMPA/TGM-Plugin-Activation
 */

/**
 * Include the TGM_Plugin_Activation class.
 *
 * Depending on your implementation, you may want to change the include call:
 *
 * Parent Theme:
 * require_once get_template_directory() . '/path/to/class-tgm-plugin-activation.php';
 *
 * Child Theme:
 * require_once get_stylesheet_directory() . '/path/to/class-tgm-plugin-activation.php';
 *
 * Plugin:
 * require_once dirname( __FILE__ ) . '/path/to/class-tgm-plugin-activation.php';
 */
require_once get_template_directory() . '/inc/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'tws__required_register_required_plugins' );

function tws__required_register_required_plugins() {
	$plugins = array(

		// This is an example of how to include a plugin from the WordPress Plugin Repository.
		array(
			'name'      => 'WooCommerce',
			'slug'      => 'woocommerce',
			'required'  => true,
		),

	);

	$config = array(
		'id'           => 'tws__required',    		// Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                     	// Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', 	// Menu slug.
		'parent_slug'  => 'index.php',            	// Parent menu slug.
		'capability'   => 'edit_theme_options',    	// Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true,                    	// Show admin notices or not.
		'dismissable'  => true,                    	// If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      	// If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   	// Automatically activate plugins after installation or not.
		'message'      => '',                      	// Message to output right before the plugins table.
	);

	tgmpa( $plugins, $config );
}