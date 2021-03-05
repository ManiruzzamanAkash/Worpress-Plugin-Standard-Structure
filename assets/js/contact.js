;(function ($) {
    
    $('#wedevs-contact-form form').on('submit', function(e) {
        e.preventDefault();
        
        var data = $(this).serialize();
        
        $.post(weDevsAcademy.ajaxurl, data, function(data) {
            console.log("Error", data);
        })
        .fail(function(error) {
            console.log("Error", weDevsAcademy.error);
            // alert('Something went wrong !! ');
        })
        console.log(e)
    });

})(jQuery)
