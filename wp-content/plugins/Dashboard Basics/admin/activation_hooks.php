<?php
/**
 * Created by PhpStorm.
 * User: benazeer-phases
 * Date: 5/2/20
 * Time: 5:08 PM
 */

class activation_hooks
{

    public static function create_user_on_activation()
    {


        $user_login = 'custom_user';
        if (!username_exists($user_login)):
            $user_pass = wp_generate_password(16, false);

            $user_id = wp_insert_user(
                array(
                    'user_login' => $user_login,
                    'user_pass' => $user_pass,
                    'first_name' => 'Custom',
                    'last_name' => 'User',
                    'role' => 'custom_editor',
                )
            );
            wp_new_user_notification($user_id, null, 'admin');

        endif;

    }
}

new activation_hooks();