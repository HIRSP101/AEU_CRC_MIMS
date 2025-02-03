@extends('layouts.templates.att.master')
@push('CSS')
@endpush

@section('Content')
    <?php
    $member_addr = $member->member_current_address ?? '';
    $member_edu = $member->member_education_background ?? '';
    $member_regis = $member->member_registration_detail ?? '';
    $member_guardian = $member->member_guardian_detail ?? '';
    $member_pob = $member->member_pob_address ?? '';
    
    ?>
    <div>
        <div class="ml-10 p-4" id="source-html">
            <div class="flex justify-center">
                <div>
                    <div class="flex justify-center">
                        <img class="logo w-32" src="{{ asset('images/Logo_of_Cambodian_Red_Cross.svg') }}">
                    </div>
                    <div class="text-center">
                        <h1 class="text-2xl">សលាកបត្រព័ត៌មានផ្ទាល់ខ្លួន យុវជនកាកបាទក្រហមកម្ពុជា</h1>
                        <p class="title text-lg">Cambodian Red Cross Youth Individual Information</p>
                    </div>
                </div>
                <div class="ml-10 mb-10">
                    <img class="profile-image w-32 h-36 bg-red-300 rounded-md "
                        src="{{ asset($member->image ?? 'public/images/placeholder.png') }} ">
                </div>
            </div>
            <h2 class="text-xl">1-ព័ត៌មានលម្អិតផ្ទាល់ខ្លួន (Personal Detail)</h2>
            <div class="font-siemreap my-3 ">
                @include('member_detail.partials.detail')
            </div>
            <h2 class="text-xl">2-វគ្គបណ្ដុះបណ្ដាលដែលទទួលបានកន្លងមក (Training Skill)</h2>
            <div class="font-siemreap">
                @include('member_detail.partials.training_skill')
            </div>
            <h2 class="text-xl">3-ព័ត៌មានគ្រួសារ (Family Information)</h2>
            <div class="font-siemreap">
                @include('member_detail.partials.family_info')
            </div>
            <!--
        <button class="px-2 py-2 bg-red-500 text-white rounded-lg hover:bg-red-800">Export to PDF (EMT)</button>
        -->
            <button id="clear_btn" class="px-2 py-2 bg-red-500 text-white rounded-lg hover:bg-red-800">លុប</button>
            <button class="px-2 py-2 bg-green-500 text-white rounded-lg hover:bg-green-800">យល់ព្រម</button>
            <button class="word-btn px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-800" id="word-btn" onclick="exportHTML();">Export word</button>
        </div>
    @endsection

    @push('JS')
        <script type="module">
            import {
                insertorupdareopt
            } from "{{ asset('js/insertorupdateopt.js') }}";
        //    insertorupdareopt();

            function updateMember() {
                $.ajax({
                    type: 'POST',
                    url: '/createmember',
                    data: member,
                    contentType: false,
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        console.log(response.message);
                        $("#loading-overlay").hide();
                        alert(response.message);
                    },
                    error: function(error) {
                        console.error(error);
                    }
                })
            }
        </script>
        <script>
            function exportHTML() {
                var header = 
                    `<html xmlns:o='urn:schemas-microsoft-com:office:office'
                        xmlns:w='urn:schemas-microsoft-com:office:word'
                        xmlns='http://www.w3.org/TR/REC-html40'>

                    <head>
                        <meta charset='utf-8'>
                        <title>Export HTML to Word Document with JavaScript</title>
                        <style>
                            body {
                                font-family: 'Khmer OS Battambang', Arial, sans-serif;
                                font-size: 12px
                                line-height: 1.6;
                            }
                            
                            h1 {
                                font-size: 16px;
                                font-weight: bold;
                                text-align: center;
                            }
                            h2 {
                                font-size: 14px;
                                font-weight: bold;
                            }
                            h3 {
                                font-size: 12px;
                                font-weight: normal;
                            }
                            p {
                                font-size: 12px;
                                font-weight: bold; 
                            }
                            .title {
                                font-size: 14px;
                                text-align: center;
                            }
                            .container {
                                width: 90%;
                                margin: auto;
                                padding: 20px;
                            }
                            .logo {
                                width: 50px;
                                height: 50px;
                            }
                            .profile-image {
                                width: 100px;
                                height: 120px;
                                border-radius: 10px;
                                object-fit: cover;
                                border: 2px solid #ccc;
                                display: block;
                                margin: auto;
                            }
                        </style>        
                    </head>
                    <body>`;

                var content = document.getElementById("source-html").innerHTML;
                
                var formattedContent = `
                    <div class="container">
                        <img class="logo" src="{{ asset('images/Logo_of_Cambodian_Red_Cross.svg') }}" />
                        <h1>សលាកបត្រព័ត៌មានផ្ទាល់ខ្លួន យុវជនកាកបាទក្រហមកម្ពុជា</h1>
                        <p>Cambodian Red Cross Youth Individual Information</p>
                        <img class="profile-image" src="{{ asset($member->image ?? 'public/images/placeholder.png') }}" />
                        ${content}
                    </div>`;

                var footer = "</body></html>";
                var sourceHTML = header+document.getElementById("source-html").innerHTML+footer;

                var source = 'data:application/vnd.ms-word;charset=utf-8,' + encodeURIComponent(sourceHTML);
                var fileDownload = document.createElement("a");
                document.body.appendChild(fileDownload);
                fileDownload.href = source;
                fileDownload.download = 'document.doc';
                fileDownload.click();
                document.body.removeChild(fileDownload);
            }
        </script>
    @endpush
