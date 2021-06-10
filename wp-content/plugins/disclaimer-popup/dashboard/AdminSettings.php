<?php
if (!class_exists('AdminSettings')) :
    class AdminSettings
    {
        public function __construct()
        {
            add_action("admin_menu", array($this, "dp_menu_settings"));
            add_action('admin_init', array($this, 'dp_admin_settings_page_fields'));
        }
        public function dp_menu_settings()
        {

            try {
                add_submenu_page(
                    'options-general.php',
                    'Disclaimer Popup',
                    'Disclaimer Popup',
                    'manage_options',
                    'disclaimer-plugin-menu',
                    array($this, 'dp_admin_settings_page'));
            } catch (Exception $exception) {
                error_log($exception);
            }
        }
        public static function dp_admin_settings_page()
        {
            $options = get_option('dp_settings_field_group_name');
            ?>
            <div class="wrap">
                <h2>Disclaimer Popup Settings Page</h2>
                <form method="post" action="options.php">
                    <?php
                    settings_fields('dp_settings_field_group');
                    do_settings_sections('disclaimer-plugin-menu');
                    $args = array(
                        'media_buttons' => false,
                        'textarea_rows' => '10',
                        'textarea_name' => "dp_settings_field_group_name[popup_content]"
                    );
                    $textarea_value = isset($options['popup_content']) ? esc_attr($options['popup_content']) : '';
                    wp_editor($textarea_value, 'popup_content', $args);

                    submit_button();
                    ?>
                </form>
            </div>
        <?php }

        public function dp_admin_settings_page_fields()
        {
            register_setting(
                'dp_settings_field_group', // Option group
                'dp_settings_field_group_name', // Option name
                array($this, 'sanitize') // Sanitize
            );

            add_settings_section(
                'dp_setting_section_id', // ID
                '', // Title
                '', // Callback
                'disclaimer-plugin-menu' // Page
            );

            add_settings_field(
                'popup_content', // ID
                'Add Disclaimer text here:', // Title
                array($this, 'popup_content_callback'), // Callback
                'disclaimer-plugin-menu', // Page
                'dp_setting_section_id' // Section
            );

        }
        public function popup_content_callback()
        {
        }
        /**
         * Sanitize each setting field as needed
         *
         * @param array $input Contains all settings fields as array keys
         */
        public function sanitize($input)
        {
            $new_input = array();
            if (isset($input['popup_content']))
                $new_input['popup_content'] = $input['popup_content'];

            return $new_input;
        }
    }
endif;
$adminSettings = new AdminSettings();