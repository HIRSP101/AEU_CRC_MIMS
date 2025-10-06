@extends('public_form.partials.header')
@push('CSS')
@endpush

@section('Content')
    @include('public_form.partials.member_form')

    </div>

@endsection

@push('JS')
    <script>
        $("#image").on('change', function (e) {
            e.preventDefault();
            var file = e.target.files;
            previewImage(file);
        });

        $("#clear_btn").click(function (e) {
            e.preventDefault();
            $("input").val("");
        })
        $("#submit_btn").click(function (e) {
            e.preventDefault();
            var formData = new FormData();
            var memberObj = {
                0: {
                    // "member_id": window.location.href.split("/")[4],
                    "name_kh": $("input#name_kh").val(),
                    "name_en": $("input#name_en").val(),
                    "gender": $("select#gender").val(),
                    "nationality": $("input#nationality").val(),
                    "date_of_birth": $("input#dateofbirth").val(),
                    "full_current_address": `${$("input#housenumber").val()}, ${$("input#street").val()}, ${$("input#current_village").val()}, ${$("input#current_commune").val()}, ${$("input#current_district").val()}, ${$("input#current_provience").val()}`,
                    "phone_number": $("input#phone_number").val(),
                    "facebook": $("input#facebook").val(),
                    "email": $("input#memberemail").val(),
                    "shirt_size": $("select#shirt_size").val(),
                    "home_no": $("input#housenumber").val(),
                    "pob_village": $("input#village").val(),
                    "pob_commune_sangkat": $("input#commune").val(),
                    "pob_district_khan": $("input#district").val(),
                    "branch_id": $("#current_proviencelist option").filter(function () {
                        return $(this).val() == $("input#current_provience").val();
                    }).data('id') || null,
                    "branchhei_id": $("#branchname_list option").filter(function () {
                        return $(this).val() == $("input#branch_name").val();
                    }).data('id') || null,
                    "pob_provience_city": $("input#provience").val(),
                    "village": $("input#current_village").val(),
                    "commune_sangkat": $("input#current_commune").val(),
                    "district_khan": $("input#current_district").val(),
                    "provience_city": $("input#current_provience").val(),
                    "institute_id": $("input#branch_name").val(),
                    "acadmedic_year": $("input#education_level").val(),
                    "major": $("input#major").val(),
                    //"batch" : $("input#batch").val(),
                    //"shift" : $("input#shift").val(),
                    "father_name": $("input#father_name").val(),
                    "father_dob": $("input#father_dob").val(),
                    "father_occupation": $("input#father_occupation").val(),
                    "father_current_address": $("input#father_current_address").val(),
                    "mother_name": $("input#mother_name").val(),
                    "mother_dob": $("input#mother_dob").val(),
                    "mother_occupation": $("input#mother_occupation").val(),
                    "mother_current_address": $("input#mother_current_address").val(),
                    "guardian_phone": $("input#guardian_number").val(),
                    "education_level": $("#education_level").val(),
                    "training_received": $("#training_received").val(),
                    "type": $("input#type").val(),
                    "language": $("input#language").val(),
                    "computer_skill": "",
                    "misc_skill": "",
                    "registration_date": $("input#recruitment_date").val()
                }
            }

            formData.append('image', $("#image")[0].files[0]);
            //  console.log(memberObj);
            formData.append('members', JSON.stringify(memberObj));

            console.log(formData);
            $("#loading-overlay").show();
            insertMember(formData);
        })

        function insertMember(member) {
            $.ajax({
                type: 'POST',
                url: '/createmember',
                data: member,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    console.log(response.message);
                    //   $("#loading-overlay").hide();
                    alert(response.message);
                    $("#loading-overlay").hide();
                },
                error: function (error) {
                    $("#loading-overlay").hide();
                    console.error(error);
                }
            })
        }

        function previewImage(files) {
            $("#imagepreview").html('');
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
    </script>
@endpush