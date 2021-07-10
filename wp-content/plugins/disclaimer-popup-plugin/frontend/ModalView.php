<?php


class ModalView
{
    public function __construct()
    {
        add_action("wp_footer", array($this, "dp_modal_html"));
    }

    /**
     * Html with option field value to show in the frontend popup
     */
    public function dp_modal_html()
    {
        try {
            if (isset(OPTIONS['popup_content'])) {
                if (get_post_type() === 'page' || get_post_type() === 'post') {
                    echo '<div class="container">
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-header modal-content">
                <div class="modal-body">
                    <p>' . OPTIONS['popup_content'] . '</p>
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
        } catch (Exception $exception) {
            error_log("dp_modal_html");
            error_log($exception);
        }
    }
}

$modal_view = new ModalView();