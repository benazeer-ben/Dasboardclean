<?php
/**
 * AdminSettings class for plugin admin page settings
 */
if (!class_exists('AdminSettings')) :
    class AdminSettings
    {
        /**
         * Adding admin menu action to construct
         * Hook into admin _init in order to start the process of creating admin settings form.
         */
        public function __construct()
        {
            add_action("admin_menu", array($this, "dp_menu_settings"));
            add_action('admin_init', array($this, 'dp_admin_settings_page_fields'));
        }

        /**
         * Start the process of adding menu to the left sidebar under settings ( parent menu )
         */
        public function dp_menu_settings()
        {
            try {
                // check user capabilities
                if (!current_user_can('manage_options')) {
                    return;
                }
                add_submenu_page(
                    'options-general.php',
                    'Disclaimer Popup',
                    'Disclaimer Popup',
                    'manage_options',
                    'disclaimer-plugin-menu',
                    array($this, 'dp_admin_settings_page'));
            } catch (Exception $exception) {
                error_log("dp_menu_settings");
                error_log($exception);
            }
        }

        /**
         *  Define the page that shows up when a user clicks on plugin name in the left sidebar
         * Provide a admin area view for the plugin
         */
        public static function dp_admin_settings_page()
        {
            try {
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
                            'textarea_name' => "dp_settings_field_group_name[popup_content]",
                        );
                        $textarea_value = isset(OPTIONS['popup_content']) ? esc_attr(OPTIONS['popup_content']) : '';
                        wp_editor($textarea_value, 'popup_content', $args);
                        submit_button('', '', 'dp-submit-btn', '');
                        ?>
                        <style>input#dp-submit-btn {
                                background: green;
                                color: white;
                                margin-top: 30px;
                            }</style>
                    </form>
                </div>
                <?php
            } catch (Exception $exception) {
                error_log("dp_admin_settings_page");
                error_log($exception);
            }
        }

        /**
         * Add settings for plugin admin page fields
         */
        public function dp_admin_settings_page_fields()
        {
            try {
                if (!current_user_can('manage_options')) {
                    return;
                }
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
                    'Add Popup Details', // Title
                    array($this, 'popup_content_callback'), // Callback
                    'disclaimer-plugin-menu', // Page
                    'dp_setting_section_id' // Section
                );
                add_settings_field(
                    'modal_type', // ID
                    'Choose Modal Type', // Title
                    array($this, 'modal_type_callback'), // Callback
                    'disclaimer-plugin-menu', // Page
                    'dp_setting_section_id' // Section
                );
            } catch (Exception $exception) {
                error_log("dp_admin_settings_page_fields");
                error_log($exception);
            }
        }

        /**
         * Callback function for popup content field
         */
        public function popup_content_callback()
        {
        }

        /**
         * Callback function for popup content field
         */
        public function modal_type_callback()
        {
            $modal_type = isset(OPTIONS['modal_type']) ? esc_attr(OPTIONS['modal_type']) : '';
            $html = '<input type="radio" id="radio_example_one" name="dp_settings_field_group_name[modal_type]" value="1"' . checked(1, $modal_type, false) . '/>';
            $html .= '<label for="radio_example_one">Bootstrap Modal</label><br>';

            $html .= '<input type="radio" id="radio_example_two" name="dp_settings_field_group_name[modal_type]" value="2"' . checked(2, $modal_type, false) . '/>';
            $html .= '<label for="radio_example_two">Custom Style & Script for Modal</label><br>';

            echo $html;

            echo $note = "<br><i>NOTE: This is an extra option added since there is confusion whether I can use any css plugin or will it develop by myself. So using both ways.</i>";
        }


        /**
         * Sanitize input field
         * @param array $input Contains all settings fields as array keys
         * @return $new_input
         */
        public function sanitize($input)
        {
            try {
                $new_input = array();
                if (isset($input['popup_content']))
                    $new_input['popup_content'] = $input['popup_content'];
                if (isset($input['modal_type']))
                    $new_input['modal_type'] = $input['modal_type'];
                return $new_input;
            } catch (Exception $exception) {
                error_log("sanitize");
                error_log($exception);
            }
        }
    }
endif;
$adminSettings = new AdminSettings();