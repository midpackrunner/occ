$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
});
$(document).on('click', 'a.jq-postback', function(e) {
    e.preventDefault(); // does not go through with the link.
    var $this = $(this);
    $.post({
        type: $this.data('method'),
        url: $this.attr('href')
    }).done(function (data) {
        if(data == 'forbidden') {
            alert('Forbidden: You do not have rights to edit Announcements');
        }    
        else if (data == 'success'){
            alert('Announcement has been removed from our system');
            location.reload(); 
        }
        else {
            alert('Unknown Error: an unkown error has occured.' +
                  'Please contact the website\'s Administrator');
            alert(data);
        }
    });
});
