
$("#user_form_btn").on("click", function () {
    $("#user_form").toggle('hidden');
})
$("button#cancel").on("click", function (e) {
    e.preventDefault();
    $("#user_form").toggle('hidden');
})
$("button#saveprofile").click(function (e) {
    e.preventDefault();
    $("#user_form_form").submit();
})
$('.delude').on("click", function() {
    if (confirm("Are you sure you want to delete this user?")) {
        ded('/deleteuser', $(this).attr('data-id'));
    }
})


function ded(url, id) {

    $.ajax({
    type: 'POST',
    url: url,
    data: {
        id: id
    },
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    success: function (response) {
        location.reload();
        console.log(response.message);
    },
    error: function (error) {
        console.error(error);
    }
})
}
