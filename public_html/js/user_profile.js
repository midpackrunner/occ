$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
});
$(document).on('click', 'a.jq-postback', function(e) {
    e.preventDefault(); // does not go through with the link.
    var $this = $(this);
    console.log($this.data('method'));
    console.log($this.attr('href'));

    $.post({
        type: $this.data('method'),
        url: $this.attr('href')
    }).done(function (data) {
        if(data == 'forbidden') {
            alert('Forbidden: You do not have rights to this User\'s Profile');
        }    
        else if (data == 'success'){
            alert('success');
            location.reload(); 
        }
        else {
            alert('Unknown Error: an unkown error has occured.' +
                  'Please contact the website\'s Administrator');
        }
        console.log(data);
    });
});
