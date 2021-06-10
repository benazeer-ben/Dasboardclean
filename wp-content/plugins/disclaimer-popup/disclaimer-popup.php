<?php
/**
 * Plugin Name: Disclaimer Popup
 * Description: Showing a disclaimer popup on pages / posts
 * Version: 1.0.0
 * Author: Benazeer Hassan
 * Text Domain: disclaimer-popup
 **/

require_once __DIR__ . '/dashboard/AdminSettings.php';
require_once __DIR__ . '/frontend/ModalView.php';


//add_action('plugins_loaded', array('AdminSettings', 'init_actions'));
//registration hook
//error handling

add_action('admin_enqueue_scripts', 'dp_scripts');
add_action('wp_enqueue_scripts', 'dp_scripts');
function dp_scripts()
{

    wp_enqueue_script('jquery');
    wp_enqueue_script('dp-scripts', plugin_dir_url(__FILE__) . 'assets/dp-scripts.js', array('jquery'), '2.1');
    wp_enqueue_style('dp-bootstrap-style', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css', '', '');
    wp_enqueue_script('dp-bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js', array('jquery'), '2.1');
}
