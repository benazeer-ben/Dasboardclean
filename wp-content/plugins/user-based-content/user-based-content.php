<?php
/**
 * Plugin Name: User Based Content
 * Description: Showing content on the frontend based on the user
 * Version: 1.0.0
 * Author: Benazeer Hassan
 * Text Domain: user-based-content
 **/

class UserBasedContent
{

    public function __construct()

    {
        add_shortcode('PUBLIC_CONTENT', array($this, 'ubc_public_content'));
        add_shortcode('PRIVATE_CONTENT', array($this, 'ubc_private_content'));

    }


    public function ubc_private_content($attr, $content = null)
    {
        try {
            if (is_user_logged_in()) {
                $message = 'This is visible only to logged-in users.' . $content;
            } else {
                $message = "";
            }

        } catch (Exception $exception) {
            error_log($exception);

        }

        return $message;
    }

    public function ubc_public_content($attr, $content = null)
    {
        try {
            if (!is_user_logged_in()) {
                $message = $content;
            } else {
                $message = "";
            }

        } catch (Exception $exception) {
            error_log($exception);

        }
        return $message;
    }


}

new UserBasedContent();