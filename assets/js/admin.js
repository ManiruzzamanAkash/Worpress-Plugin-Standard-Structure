// Self invoking anynomous function
;(function ($) {
    // $('wp-list-table widefat fixed striped table-view-list contacts')
    $('table.wp-list-table.contacts').on('click', 'a.submitdelete', function (event) {
        event.preventDefault();
        
        if (!confirm(weDevsAcademy.confirm)) {
            return;
        }

        var self    = $(this),
            id      = self.data('id');

        wp.ajax.post( 'wd-ac-delete-address' , {
            id: id,
            _wpnonce: weDevsAcademy.nonce
        })
        .done(function(response) {
            console.log('response', response);
            self.closest('tr')
                .css('background-color', 'red')
                .hide(500, function(){
                    $(this).remove();
                })
        })
        .fail(function(error){
            alert(weDevsAcademy.error);
            console.log('error', error);
        })

    });
})(jQuery)
