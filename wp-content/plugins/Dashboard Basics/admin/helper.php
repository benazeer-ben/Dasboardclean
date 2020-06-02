<?php

function time_to_go($timestamp)
{

    // converting the mysql timestamp to php time
    $periods = array(
        "second",
        "minute",
        "hour",
        "day",
        "week",
        "month",
        "year"
    );
    $lengths = array(
        "60",
        "60",
        "24",
        "7",
        "4.35",
        "12"
    );
    $current_timestamp = time();
    $difference = abs($current_timestamp - $timestamp);
    for ($i = 0; $difference >= $lengths[$i] && $i < count($lengths) - 1; $i++) {
        $difference /= $lengths[$i];
    }
    $difference = round($difference);
    if (isset($difference)) {
        if ($difference != 1)
            $periods[$i] .= "s";
        $output = "$difference $periods[$i]";
        return $output;
    } else {
        return false;
    }
}


function basics_create_custom_user()
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

    endif;

    return $user_id;
}