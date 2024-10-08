@extends('layouts.templates.att.master')
@push('CSS')
@endpush

@section('Content')

<div class="p-5 md:ml-24 md:mr-24 bg-white font-siemreap shadow-xl rounded-lg my-3">
    <div class="flex flex-col items-center justify-center mb-10">
        <img class="w-[125px] h-[125px] mb-3" src="{{asset('images/Logo_of_Cambodian_Red_Cross.svg')}}" alt="">
        <h1 class="mb-1">សលាកបត្រព័ត៍មានផ្ទាល់ខ្លួន យុវជនកាកបាទក្រហមកម្ពុជា</h1>
        <h1>Cambodian Red Cross Youth Individual Information</h1>
    </div>
    {{-- <form class="w-full" method="POST" action="/insertmember" enctype="multipart/form-data">
        @csrf --}}
    <form class="w-full" method="POST" action="{{ isset($member) ? route('updateMember', $member->member_id) : '/insertmember' }}" enctype="multipart/form-data">
        @csrf
        @if(isset($member))
            @method('PUT')
        @endif    
        @include('member.partials.personal_detail')
        <hr>
        @include('member.partials.pob')
        <hr>
        @include('member.partials.current_address')
        <hr>
        @include('member.partials.personal_training')
        <hr>
        @include('member.partials.guardian')
        <div class="flex justify-end">
            <a class="border-solid m-2 border-2 bg-red-400 p-2 rounded-md hover:bg-red-500 active:bg-red-600 focus:outline-none focus:ring focus:ring-red-300"
               id="clear_btn">លុប</a>
            <button
                class="border-solid m-2 border-2 bg-green-500 p-2 rounded-md hover:bg-green-600 active:bg-green-700 focus:outline-none focus:ring focus:ring-green-300"
                type="submit" id="submit_btn">យល់ព្រម
            </button>
        </div>
    </form>
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
    } )
    $("#submit_btn").click(function (e) {
    e.preventDefault();
    
    var formData = new FormData();
    var method = "{{ isset($member) ? 'PUT' : 'POST' }}"; // Set method dynamically
    var url = "{{ isset($member) ? route('updateMember', $member->member_id) : route('createmember') }}";

    formData.append('_method', method); // Include the method in FormData for PUT
    formData.append('name_kh', $("input#name_kh").val());
    formData.append('image', $("#image")[0].files[0]);
    $.ajax({
        type: 'POST',
        url: url,
        data: formData,
        contentType: false,
        processData: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {
            console.log(response.message);
            window.location.href = '/branch';
        },
        error: function (error) {
            console.error(error);
        }
    });
    function previewImage(files) {
        $("#imagepreview").html('');
        $.each(files, function(i, file) {
            if (file.type.startsWith('image/')) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    var imgElement = $('<img />', {
                        src: e.target.result,
                        css: {
                            maxWidth: '150px',
                            margin: '10px',
                            border: '2px solid #ddd',
                            padding: '5px'
                        }
                    });
                    $("#imagepreview").append(imgElement);
                };
                reader.readAsDataURL(file);
            }
        });
    }
    });    

</script>
@endpush
