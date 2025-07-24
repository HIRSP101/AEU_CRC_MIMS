@extends('member_input_form.partials.header')
@push('CSS')
@endpush

@section('Content')
@include('member_input_form.partials.member_form')
  <div id="loadingSpinner" class="fixed top-0 left-0 z-50 w-screen h-screen bg-gray-300 bg-opacity-50 h-full hidden">
        <p id="textload" class="hidden textload text-center font-siemreap">សូមរងចាំ...</p>
        <p id="textsucc" class="hidden textload text-center font-siemreap">បញ្ចូលជោគជ័យ</p>
        <div id="spinner" class="spinner hidden"></div>
        <div id="tick" class="hidden text-center text-green-500 text-6xl">✔</div>
        <div class="flex justify-center items-center mt-2">
            <button id="ok" class="hidden w-32 text-center bg-green-500 text-white px-4 py-2 rounded">OK</button>
        </div>
    </div>
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
        $("#personal_btn").click(function (e) {

            e.preventDefault();

            const requiredFields = [
                'name_kh',
                'name_en',
                'gender',
                'nationality',
                'village',
                'commune',
                'district',
                'province',
                'dateofbirth'
            ];
            let allValid = true;
            requiredFields.forEach(id => {
                const input = document.getElementById(id);
                if (!input || input.value.trim() === "") {
                    allValid = false;
                    input.classList.add("border-red-500");
                } else {
                    input.classList.remove("border-red-500");
                }
            });

            if (!allValid) {
                alert("សូមបំពេញព័ត៌មានដែលត្រូវបានទាមទារ។"); // Please fill in the required information.
                return;
            }
            $("#section1").addClass('hidden');
            $("#section2").removeClass('hidden');
        })
        $("#section2_back").click(function (e) {
            e.preventDefault();

            const requiredFields = [
                'recruitment_date',
                'branch_name',
                'phone_number',

            ];
            let allValid = true;
            requiredFields.forEach(id => {
                const input = document.getElementById(id);
                if (!input || input.value.trim() === "") {
                    allValid = false;
                    input.classList.add("border-red-500");
                } else {
                    input.classList.remove("border-red-500");
                }
            });

            if (!allValid) {
                alert("សូមបំពេញព័ត៌មានដែលត្រូវបានទាមទារ។"); // Please fill in the required information.
                return;
            }

            $("#section2").addClass('hidden');
            $("#section1").removeClass('hidden');
        })
        $("#training_btn").click(function (e) {
            e.preventDefault();

            const requiredFields = [
                'recruitment_date',
                'branch_name',
                'phone_number',
            ];
            let allValid = true;
            requiredFields.forEach(id => {
                const input = document.getElementById(id);
                if (!input || input.value.trim() === "") {
                    allValid = false;
                    input.classList.add("border-red-500");
                } else {
                    input.classList.remove("border-red-500");
                }
            });

            if (!allValid) {
                alert("សូមបំពេញព័ត៌មានដែលត្រូវបានទាមទារ។"); // Please fill in the required information.
                return;
            }

            $("#section2").addClass('hidden');
            $("#section3").removeClass('hidden');
        })
        $("#section3_back").click(function (e) {
            e.preventDefault();
            $("#section3").addClass('hidden');
            $("#section2").removeClass('hidden');
        })


        $("#submit_btn").click(function (e) {
            e.preventDefault();
             const requiredFields = [
                'father_name',
                'guardian_number',
                'mother_name',
            ];
            let allValid = true;
            requiredFields.forEach(id => {
                const input = document.getElementById(id);
                if (!input || input.value.trim() === "") {
                    allValid = false;
                    input.classList.add("border-red-500");
                } else {
                    input.classList.remove("border-red-500");
                }
            });

            if (!allValid) {
                alert("សូមបំពេញព័ត៌មានដែលត្រូវបានទាមទារ។"); // Please fill in the required information.
                return;
            }
             $("#loadingSpinner").show();
                        $("#textload").show();
                        $("#spinner").show();
                        $("#textsucc").hide();
                        $("#tick").hide();
                        $("#ok").hide();
            var formData = new FormData();
            const selectedVal = $("input#branch_name").val();
            const selectedOption = $("#branchname_list option").filter(function () {
                return $(this).val() === selectedVal;
            });

            const dataId = selectedOption.data('id') || '';

            let branchhei_id = null;
            let school_id = null;

            if (dataId.startsWith('bhei_')) {
                branchhei_id = dataId.replace('bhei_', '');
            } else if (dataId.startsWith('school_')) {
                school_id = dataId.replace('school_', '');
            }
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
                    "branch_id": $("#proviencelist2 option").filter(function () {
                        return $(this).val() == $("input#current_provience").val();
                    }).data('id') || null,
                    "branchhei_id": branchhei_id,
                    "pob_provience_city": $("input#provience").val(),
                    "village": $("input#current_village").val(),
                    "commune_sangkat": $("input#current_commune").val(),
                    "district_khan": $("input#current_district").val(),
                    "provience_city": $("input#current_provience").val(),
                    "school_id": school_id,
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
                    "language": $("input#language").val(),
                    "computer_skill": "",
                    "misc_skill": "",
                    "registration_date": $("input#recruitment_date").val(),
                    "scout_youth_registration_date": $("input#scout_youth_registration_date").val(),
                    "uyfc_registration_date": $("input#uyfc_registration_date").val(),
                    "other_ngos_registration_date": $("input#other_ngos_registration_date").val(),
                    "member_type": $("select#member_type").val(),
                    "member_status": $("input#member_status").val(),
                    "approved": 0,
                    "token": @json($token)
                }
            }

            formData.append('image', $("#image")[0].files[0]);
            formData.append('members', JSON.stringify(memberObj));
            console.log(formData);
            insertMember(formData);
        })

        function insertMember(member) {
            $.ajax({
                type: 'POST',
                url: `/member-rigistration`,
                data: member,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    console.log(response);
                      $("#loadingSpinner").show();
                                $("#textload").hide();
                                $("#spinner").hide();
                                $("#textsucc").show();
                                $("#tick").show();
                                $("#ok").show();
                                $("#ok").on("click", function () {
                                    $("#loadingSpinner").hide();
                                    $("#textload").hide();
                                    $("#spinner").hide();
                                    $("#textsucc").hide();
                                    $("#tick").hide();
                                    $("#ok").hide();
                                });
                },
                error: function (error) {
                    $("#loadingSpinner").hide();
                    alert(error);
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