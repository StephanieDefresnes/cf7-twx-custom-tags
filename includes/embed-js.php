<?php

/**
 * Include js
 */
add_action( 'wp_enqueue_scripts', 'twx_embed_script' );
function twx_embed_script() {
    
    wp_enqueue_script( 'twx-country-auto-script', TWX_URL . 'assets/js/script.js', array( 'jquery' ) );
    
    wp_localize_script( 'twx-country-auto-script', 'twx_auto_ajax', array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('twx_ajax_nonce')
        )
    );
    
}