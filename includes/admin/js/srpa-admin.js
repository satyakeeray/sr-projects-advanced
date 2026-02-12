jQuery(document).ready(function($){

    function toggleFields() {
        let paginationType = jQuery('input[name="srpa_settings[pagination_type]"]:checked').val();

        if (paginationType === 'pagination') {
            jQuery('input[name="srpa_settings[posts_per_page]"]').closest('tr').show();
            jQuery('input[name="srpa_settings[load_more_count]"]').closest('tr').hide();
            //jQuery('input[name="srpa_settings[pagination_mode]"]').closest('tr').show();
        } else {
            jQuery('input[name="srpa_settings[posts_per_page]"]').closest('tr').hide();
            jQuery('input[name="srpa_settings[load_more_count]"]').closest('tr').show();
            //jQuery('input[name="srpa_settings[pagination_mode]"]').closest('tr').hide();
        }
    }

    toggleFields();

    jQuery('input[name="srpa_settings[pagination_type]"]').on('change', toggleFields);
});
