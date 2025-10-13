@extends('layouts.templates.att.master')
@push('CSS')
@endpush
@canany(['2', '3'])
    @section('Content')
        <div class="bg-gray-100 font-battambang m-5">
            @include('loading_view')
            <div class="p-5 bg-white shadow-md rounded-lg">
                <h1 class="text-2xl font-medium text-center font-koulen text-blue-600">
                    {{ $title }}
                </h1>
                <div class="mt-14">
                    <div class="relative flex justify-center items-start mb-3">
                        <img class="w-28 h-28" src="{{ asset('images/Logo_of_Cambodian_Red_Cross.svg') }}" alt="Red Cross Logo">
                        <div class="absolute right-0 top-0">
                            <img class="w-28 h-32 bg-red-300 border rounded-sm"
                                src="{{ asset('images/members/default-profile.jpg') }}" alt="Profile Image">
                        </div>
                    </div>
                    <div class="text-center mb-10 font-battambang">
                        <h1 class="mb-1 text-[18px]">សលាកបត្រព័ត៍មានផ្ទាល់ខ្លួន យុវជនកាកបាទក្រហមកម្ពុជា</h1>
                        <h1 class="text-[18px]">Cambodian Red Cross Youth Individual Information</h1>
                    </div>
                    @csrf
                    @include('member.components.partials.personal_detail')
                    <hr>
                    @include('member.components.partials.pob')
                    <hr>
                    @include('member.components.partials.current_address')
                    <hr>
                    @include('member.components.partials.personal_training')
                    <hr>
                    @include('member.components.partials.guardian')
                    <div class="flex justify-end gap-3 font-battambang text-white">
                        <a class="border-solid bg-red-500 py-2 font-medium px-4 rounded-md hover:bg-red-600 active:bg-red-700 focus:outline-none focus:ring focus:ring-red-300"
                            id="clear_btn">លុប</a>
                        <button
                            class="border-solid bg-green-500 px-4 font-medium py-2 rounded-md hover:bg-green-600 active:bg-green-700 focus:outline-none focus:ring focus:ring-green-300"
                            type="submit" id="submit_btn">យល់ព្រម
                        </button>
                    </div>
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
            $("#submit_btn").click(function (e) {
                e.preventDefault();
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
                var formData = new FormData();
                var memberObj = {
                    0: {
                        "name_kh": $("input#name_kh").val(),
                        "name_en": $("input#name_en").val(),
                        "gender": $("select#gender").val(),
                        "nationality": $("input#nationality").val(),
                        "date_of_birth": $("input#dateofbirth").val(),
                        "full_current_address": `${$("input#current_housenumber").val()}, ${$("input#current_street").val()}, ${$("input#current_village").val()}, ${$("input#current_commune").val()}, ${$("input#current_district").val()}, ${$("input#current_provience").val()}`,
                        "phone_number": $("input#phone_number").val(),
                        "facebook": $("input#facebook").val(),
                        "email": $("input#memberemail").val(),
                        "shirt_size": $("select#shirt_size").val(),
                        "pob_home_no": null,
                        "pob_street_no": null,
                        "pob_village": $("input#village").val(),
                        "pob_commune_sangkat": $("input#commune").val(),
                        "pob_district_khan": $("input#district").val(),
                        "branch_id": $("#proviencelist option").filter(function () {
                            return $(this).val() == $("input#current_provience").val();
                        }).data('id') || null,
                        "branchhei_id": branchhei_id,
                        "pob_provience_city": $("input#provience").val(),
                        "home_no": $("input#current_housenumber").val(),
                        "street_no": $("input#current_street").val(),
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
                        "computer_skill": $("input#computer_skill").val(),
                        "misc_skill": $("input#misc_skill").val(),
                        "registration_date": $("input#recruitment_date").val(),
                        "scout_youth_registration_date": $("input#scout_youth_registration_date").val(),
                        "uyfc_registration_date": $("input#uyfc_registration_date").val(),
                        "other_ngos_registration_date": $("input#other_ngos_registration_date").val(),
                        "member_type": $("select#member_type").val(),
                        "member_status": $("input#member_status").val(),
                        "acadmedic_year": null
                    }
                }

                formData.append('image', $("#image")[0].files[0]);
                console.log(memberObj);
                formData.append('members', JSON.stringify(memberObj));

                console.log(formData);
                // $("#loading-overlay").show();
                insertMember(formData);
            })


            function insertMember(member) {
                $("#loadingSpinner").show();
                $("#textload").show();
                $("#spinner").show();
                $("#textsucc").hide();
                $("#tick").hide();
                $("#ok").hide();
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
                        //  alert("on success");
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
                            $("input").val("");
                            $("img.image").attr('src', '{{ asset('images/members/default-profile.jpg') }}');
                        });
                        // console.log(response.message);
                        // //   $("#loading-overlay").hide();
                        // alert(response.message);
                    },
                    error: function (error) {
                        //  alert("on error/failure");
                        $("#loadingSpinner").hide();
                        $("#textload").hide();
                        $("#spinner").hide();
                        $("#textsucc").hide();
                        $("#tick").hide();
                        $("#ok").hide();

                        $("#loadingSpinnerFail").show();
                        $("#textloadfail").hide();
                        $("#spinnerfail").hide();
                        // $("#textfail").show();
                        $("#tickfail").show();
                        $("#spinner").hide();
                        $("#okfail").show();
                        $("#okfail").on("click", function () {
                            $("#loadingSpinnerFail").hide();
                            $("#textloadfail").hide();
                            $("#spinnerfail").hide();
                            $("#textfail").hide();
                            $("#tickfail").hide();
                            $("#okfail").hide();
                            $("input").val("");
                            $("img.image").attr('src', '{{ asset('images/members/default-profile.jpg') }}');
                        });
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
@endcanany
@include('not_allow')