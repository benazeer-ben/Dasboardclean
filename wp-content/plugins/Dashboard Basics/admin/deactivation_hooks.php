<?php
/**
 * Created by PhpStorm.
 * User: benazeer-phases
 * Date: 5/2/20
 * Time: 5:32 PM
 */

class deactivation_hooks
{
    public static function delete_user_on_deactivation()
    {

        $user = get_user_by('login', 'custom_user');
        if ($user) {
            wp_delete_user($user->ID);
        }

    }
}

new deactivation_hooks();