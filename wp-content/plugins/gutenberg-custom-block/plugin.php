<?php
/**
 * Created by PhpStorm.
 * User: benazeer-phases
 * Date: 6/2/20
 * Time: 3:22 PM
 * Plugin Name: Gutenberg Custom Plugin
 * Author: benazeer-phases
 * Version: 1.0.0
 */

function Gutenberg_Custom_Block()
{

    wp_enqueue_script('gutenberg-custom-block', plugin_dir_path(__FILE__) . 'plugin-script.js', array('wp-blocks', 'wp-editor'), true);

    register_block_type( 'gutenberg-examples/example-01-basic-esnext', array(
        'editor_script' => 'gutenberg-examples-01-esnext',
    ) );

}
add_action( 'init', 'Gutenberg_Custom_Block' );