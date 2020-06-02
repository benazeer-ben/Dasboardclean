<?php
/**
 * Created by PhpStorm.
 * User: benazeer-phases
 * Date: 3/2/20
 * Time: 11:21 AM
 */

class Dashboard_Basics
{

    public function __construct()
    {
        add_action('admin_init', array($this, 'remove_dashboard_unwanted_widgets'));
        add_action('admin_menu', array($this, 'remove_dashboard_unwanted_menus'));
        add_action('init', array($this, 'custom_user_role'));
        add_action('init', array($this, 'dm_disable_wp_emojicons'));

        add_filter('authenticate', array($this, 'check_attempted_login'), 30, 3);

        add_action('wp_login_failed', array($this, 'login_failed'), 10, 1);


    }

    public static function dm_disable_wp_emojicons()
    {
        remove_action('admin_print_styles', 'print_emoji_styles');
        remove_action('wp_head', 'print_emoji_detection_script', 7);
        remove_action('admin_print_scripts', 'print_emoji_detection_script');
        remove_action('wp_print_styles', 'print_emoji_styles');
        remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
        remove_filter('the_content_feed', 'wp_staticize_emoji');
        remove_filter('comment_text_rss', 'wp_staticize_emoji');
    }

    public static function remove_dashboard_unwanted_widgets()
    {
        remove_meta_box('dashboard_primary', 'dashboard', 'side');//Removes the 'News and Events' widget
        remove_meta_box('dashboard_activity', 'dashboard', 'normal'); //Removes the 'Activity' widget
        remove_meta_box('dashboard_right_now', 'dashboard', 'normal'); //Removes the 'At a Glance' widget
        remove_meta_box('dashboard_recent_drafts', 'dashboard', 'side'); //Removes the 'Recent draft' widget
        remove_action('welcome_panel', 'wp_welcome_panel');


    }

    public static function remove_dashboard_unwanted_menus()
    {
        $user = wp_get_current_user();
        global $submenu;
        if (in_array('custom_editor', (array)$user->roles)) {
            unset($submenu['themes.php'][5]); // Removes 'Themes'
            unset($submenu['options-general.php'][20]); // Reading
            unset($submenu['themes.php'][6]);
            remove_menu_page('plugins.php');
            remove_menu_page('Wordfence');
            remove_menu_page('update-core.php');
            remove_menu_page('users.php'); // Users
            remove_menu_page('tools.php'); // Tools

            add_action('admin_init', 'remove_acf_options_page', 99);
            function remove_acf_options_page()
            {
                remove_menu_page('theme-site-settings');
            }

        }
        remove_menu_page('edit-comments.php');
        unset($submenu['options-general.php'][15]); // Writing
        unset($submenu['options-general.php'][25]); // Discussion


    }


    public function custom_user_role()
    {
        $adm = get_role('administrator');
        $adm_cap = array_keys($adm->capabilities);
        add_role('custom_editor', 'Site Editor', array('read' => true));
        $new_role = get_role('custom_editor');
        foreach ($adm_cap as $cap) {
            $new_role->add_cap($cap);
        }

    }

    public function check_attempted_login($user, $username, $password)
    {
        if (get_transient('attempted_login')) {
            $datas = get_transient('attempted_login');

            if ($datas['tried'] >= 3) {


                $until = get_option('_transient_timeout_' . 'attempted_login');
                $time = time_to_go($until);
                return new WP_Error('too_many_tried', sprintf(__('<strong>ERROR</strong>: You have reached authentication limit, you will be able to try again in %1$s.'), $time));
            }
        }

        return $user;
    }

    public function login_failed($username)
    {
        if (get_transient('attempted_login')) {
            $datas = get_transient('attempted_login');
            $datas['tried']++;

            if ($datas['tried'] <= 3)
                set_transient('attempted_login', $datas, 300);
        } else {
            $datas = array(
                'tried' => 1
            );
            set_transient('attempted_login', $datas, 300);
        }
    }


}

new Dashboard_Basics();