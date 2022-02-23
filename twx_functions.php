<?php
/*
   Plugin Name: TwX Custom tags for Woo / CF7
   Description: Time, countries WooCommerce allowed and their states tags for Contact Form 7
   Version: 1.0
   Requires at least: 5.9
   Tested up to: 5.9
   Author: TwXDesign
   Author URI: https://www.twxdesign.com/
   Text Domain: twx-woo-cf7
   Domain Path: /languages/
   License: GPL-2.0+
   License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */
namespace TwxCf7;

if ( ! defined( 'TWX_BASENAME' ) ) {
        define( 'TWX_BASENAME', plugin_basename( __FILE__ ) );
}
if ( ! defined( 'TWX_PATH' ) ) {
        define( 'TWX_PATH', plugin_dir_path( __FILE__ ) );
}
if ( ! defined( 'TWX_URL' ) ) {
        define( 'TWX_URL', plugin_dir_url( __FILE__ )  );
}

class TwxCf7CustomTags
{
    public function __construct()
    {
        add_action( 'plugins_loaded', [ $this, 'twx_load_plugin_textdomain' ] );
        add_action( 'admin_init', [ $this, 'twx_has_parents_woo_cf7' ] );
        add_action( 'plugins_loaded', [ $this, 'twx_autoload' ] );
    }
    
    public function twx_load_plugin_textdomain() 
    {
        load_plugin_textdomain( 'twx-woo-cf7', false, dirname( TWX_BASENAME ) . '/languages/');
    }
        
    public function twx_has_parents_woo_cf7() {
        if ( is_admin() && current_user_can( 'activate_plugins' )
                && !is_plugin_active( 'woocommerce/woocommerce.php' )
                && !is_plugin_active( 'contact-form-7/wp-contact-form-7.php' ) ) {
            add_action('admin_notices', [ $this, 'twx_error_notice' ], 0);

            deactivate_plugins( TWX_BASENAME ); 

            if ( isset( $_GET['activate'] ) ) {
                unset( $_GET['activate'] );
            }
        }
    }
	
    public function twx_error_notice()
    {
        $message = sprintf( esc_html__( 'The TwX Custom tags for Woo / CF7 plugin requires Contact form 7 and WooCommerce plugins to be installed and active.', 'twx-woo-cf7' ),'<strong>', '</strong>');
        printf( '<div class="notice notice-error"><p>%1$s</p></div>', wp_kses_post( $message ) );
    }
    
    public function twx_autoload()
    {
	require TWX_PATH. 'includes/tag/countries-dropdown.php';
	require TWX_PATH. 'includes/tag/states-dropdown.php';
	require TWX_PATH. 'includes/tag/time-input.php';
	require TWX_PATH. 'includes/embed-js.php';
        require TWX_PATH. 'includes/ajax-actions.php';
    }
    
}
new TwxCf7CustomTags();