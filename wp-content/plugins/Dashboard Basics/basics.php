<?php
/**
 * Plugin Name: Dashboard Basics
 * Description: Basic dashboard settings includes custom user, hiding unwanted menu from specific user
 * Version: 1.0.0
 * Author: Phases - Ben
 * Text Domain: dashboard_basics
 **/
require_once __DIR__ . '/admin/basics_functions.php';
require_once __DIR__ . '/admin/activation_hooks.php';
require_once __DIR__ . '/admin/deactivation_hooks.php';


register_activation_hook(__FILE__, array('activation_hooks', 'create_user_on_activation'));


register_deactivation_hook(__FILE__, array('deactivation_hooks', 'delete_user_on_deactivation'));
