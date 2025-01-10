export function previewPic(image="image", imagepreview="imagepreview") {
$(`#${image}`).on('change', function (e) {
    e.preventDefault();
    var file = e.target.files;
    previewImage(file);
});

function previewImage(files) {
    $(`#${imagepreview}`).html('');
    $.each(files, function (i, file) {
        if (file.type.startsWith('image/')) {
            var reader = new FileReader();
            reader.onload = function (e) {

                $("img.image").attr('src', e.target.result);
            };
            reader.readAsDataURL(file);
        }
    });
}
}