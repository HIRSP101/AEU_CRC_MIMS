@extends('layouts.templates.att.master')
@push('CSS')
@endpush

@section('Content')

<div class="p-5 md:ml-24 md:mr-24 bg-white font-siemreap shadow-xl rounded-lg my-3">
    <div class="grid grid-cols-6 ">
        <div class="col-span-5 flex flex-col items-center justify-center mb-10 ml-24">
            <img class="w-[125px] h-[125px] mb-3" src="{{asset('images/Logo_of_Cambodian_Red_Cross.svg')}}" alt="">
            <h1 class="mb-1">សលាកបត្រព័ត៍មានផ្ទាល់ខ្លួន យុវជនកាកបាទក្រហមកម្ពុជា</h1>
            <h1>Cambodian Red Cross Youth Individual Information</h1>
        </div>
        <div class="">
            @if ($member->image == null)
                <img class="image w-28 h-32 bg-red-300" src="" alt="">
            @endif
            @if ($member->image != null)
                <img class="image w-28 h-32 bg-red-300" src="{{asset($member->image)}}" alt="">
            @endif
        </div>
    </div>
    @csrf
    <input id="member_id" name="member_id" value="{{$member->member_id}}" hidden>
    @include('member.update.partials.personal_detail')
    <hr>
    @include('member.update.partials.pob')
    <hr>
    @include('member.update.partials.current_address')
    <hr>
    @include('member.update.partials.personal_training')
    <hr>
    @include('member.update.partials.guardian')
    <div class="flex justify-end">
        <a class="border-solid m-2 border-2 bg-red-400 p-2 rounded-md hover:bg-red-500 active:bg-red-600 focus:outline-none focus:ring focus:ring-red-300"
            id="clear_btn">លុប</a>
        <button
            class="border-solid m-2 border-2 bg-green-500 p-2 rounded-md hover:bg-green-600 active:bg-green-700 focus:outline-none focus:ring focus:ring-green-300"
            type="submit" id="submit_btn">យល់ព្រម
        </button>
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
            var formData = new FormData();
            var memberId = $("input#member_id").val();

            var memberObj = {
                0: {
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
                    "street_no": $("input#street").val(),
                    "pob_village": $("input#village").val(),
                    "pob_commune_sangkat": $("input#commune").val(),
                    "pob_district_khan": $("input#district").val(),
                    "branch_id": $("#current_proviencelist option").filter(function () {
                        return $(this).val() == $("input#current_provience").val();
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
                    // "member_status": $("input#member_status").val(),
                    //  "education_level" : "",
                    "language": $("input#language").val(),
                    "member_type": $("input#member_type").val(),
                    "training_received": $("input#training_received").val(),
                    "computer_skill": $("input#computer_skill").val(),
                    "misc_skill": $("input#misc_skill").val(),
                    "registration_date": $("input#recruitment_date").val()
                }
            }

            formData.append('image', $("#image")[0].files[0]);
            console.log(memberObj);
            formData.append('members', JSON.stringify(memberObj));

            console.log(memberId);
            console.log(FormData);

            updateMember(memberId, formData);
        })
        function updateMember(member_id, member) {
            const membersJSON = member.get('members');
            const membersObj = JSON.parse(membersJSON);

            $.ajax({
                type: 'POST',
                url: `/update-member/${member_id}`, // Update if necessary, e.g., '/api/updatemember'
                data: member,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                success: function (response) {
                    console.log(response.message);
                    console.log(response.data);
                    alert(response.message);
                },
                error: function (error) {
                    console.error(error);
                }
            });
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