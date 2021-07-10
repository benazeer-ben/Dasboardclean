<?php
/**
 * Plugin Name: Disclaimer Popup Plugin
 * Description: Showing a disclaimer popup on pages / posts
 * Version: 1.0.0
 * Author: Benazeer Hassan
 * Text Domain: disclaimer-popup-plugin
 **/

/**
 * Adding required class files
 */

require_once __DIR__ . '/dashboard/AdminSettings.php';
require_once __DIR__ . '/frontend/ModalView.php';


/**
 * Getting plugin field values from Option and save it in a constant
 */
define('OPTIONS', get_option('dp_settings_field_group_name'));


/**
 * Including scripts and styles for frontend
 */
add_action('wp_enqueue_scripts', 'dp_scripts');
function dp_scripts()
{
    wp_enqueue_script('jquery');
    /**
     * This is an extra option added since there is confusion whether I can use any css plugin or will it develop by myself.
     */
    if (OPTIONS['modal_type'] == 1):
        wp_enqueue_style('dp-bootstrap-style', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css', '', '');
        wp_enqueue_script('dp-bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js', array('jquery'), '2.1');
        wp_enqueue_script('dp-bootstrap-custom-script', plugin_dir_url(__FILE__) . 'assets/dp-bootstrap-custom-script.js', array('jquery'), '2.1');

    else:
        wp_enqueue_style('dp-styles', plugin_dir_url(__FILE__) . 'assets/dp-styles.css', '', '');
        wp_enqueue_script('dp-scripts', plugin_dir_url(__FILE__) . 'assets/dp-scripts.js', array('jquery'), '2.1');
    endif;
}
