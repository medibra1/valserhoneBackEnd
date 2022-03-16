
jQuery(document).ready(function($) {

        $('.delmodal').click( function () {
            let url = $(this).attr('data-url');
            $('#deleteForm').attr('action', url);
        })

});