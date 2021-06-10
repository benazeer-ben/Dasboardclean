<?php


class ModalView
{
    public function __construct()
    {
        add_action("wp_footer", array($this, "dp_modal_html"));
    }

    public function dp_modal_html()
    {
        $options = get_option('dp_settings_field_group_name');
        if (get_post_type() === 'page' || get_post_type() === 'post') {
            echo '<div class="container">
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Modal Header</h4>
                </div>
                <div class="modal-body">
                    <p>' . $options['popup_content'] . '</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>';

        }
    }
}

$modal_view = new ModalView();