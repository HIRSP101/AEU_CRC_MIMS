
/*
$('#member_submit').click(function(e) {
    e.preventDefault();
    var member_data = {};
    $("input").each(function() {
        if ($(this).attr('id') !== undefined) {
        member_data[$(this).attr('id')] = $(this).val();
        }
    })
    console.log(member_data);

    $.ajax({
        type: 'POST',
        url: '/insertmemberfr',
        data: member_data,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            console.log(response.message);
        },
        error: function(error) {
            console.error(error);
        }
    })

})
*/



