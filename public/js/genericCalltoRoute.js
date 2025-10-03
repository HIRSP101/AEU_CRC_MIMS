export default function ajaxtoRoute(type = "", url = "", data = []) {
    $.ajax({
        type: type,
        url: url,
        data: {
            arr: data,
        },
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        success: function (response) {
            console.log(response);
            location.reload();
        },
        error: function (error) {
            console.error(error);
        },
    });
}
