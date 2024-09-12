@extends('layouts.templates.att.master')
@push('CSS')
@endpush

@section('Content')

<div>

    <form method="post" enctype="multipart/form-data" id="image_upload_form" action="/uploadimage">
        <input type="file" name="images" id="images" accept="image/*" />
        <button type="submit" id="btn">Upload Files!</button>
    </form>

   <!-- <input type="file" id="myImage" accept="image/*" /> -->
</div>
@endsection
@push("JS")

<script>
    $("form#image_upload_form").on("submit", function (ev) {
        ev.preventDefault();
        var formData = new FormData();
        formData.append('image', $('#images')[0].files[0]);
        $.ajax({
            type: 'POST',
            url: '/uploadimage',
            data:  formData,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                console.log(response.message);
            },
            cache: false,
            contentType: false,
            processData: false,
            error: function (error) {
                console.error(error);
            }
        })
    })
    $("#myImage").on("change", function(e) {
        const [file] = e.target.files

        if (!file) return

        const {
            size,
            type
        } = file

        if (size > 2097152) {
            throw "too big"
        } else if (
            type !== "application/pdf" && type !== "application/wps-office.pdf" &&
            type !== "image/jpg" && type !== "image/jpeg" && type !== "image/png"
        ) {
            throw "not the right type"
        } else {
            console.log("file valid", file);
            $.ajax({
            type: 'POST',
            url: '/uploadimage',
            data: {
                image: file
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                console.log(response.message);
            },
            error: function (error) {
                console.error(error);
            }
        })
        }
    })

</script>
@endpush
