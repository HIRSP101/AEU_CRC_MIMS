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

    @include('components.member_navigation', ['id' => $member->id])

    {{-- button --}}
    <div class="px-4 mb-4">
        <button id="clear_btn" class="bg-red-500 text-white hover:bg-red-400 font-battambang focus:ring-2 focus:outline-none rounded-xl px-4 py-2 text-center inline-flex items-center justify-between mr-2 mb-2">លុប</button>
        <button class="focus:ring-2 bg-green-500 text-white hover:bg-green-400 font-battambang focus:outline-none rounded-xl px-4 py-2 text-center inline-flex items-center justify-between mr-2 mb-2">យល់ព្រម</button>
        <button class="word-btn text-white text-[17px] bg-[#4285F4] hover:bg-[#4285F4]/90 focus:ring-2 focus:outline-none rounded-xl px-4 py-2 text-center inline-flex items-center justify-between mr-2 mb-2" id="word-btn" onclick="exportHTML();">Export word</button>
    </div>

    {{-- content A4 --}}
    <div class="w-[210mm] h-[330mm] bg-white shadow-lg mx-auto">
        <div class="px-12 hidden" id="source-html">
            <div class="grid grid-cols-6 ">
                <div class="col-span-5 flex flex-col items-center justify-center mb-5 ml-24 mt-6">
                    <img class="w-[120px] h-[120px] mb-1" src="{{ asset('images/Logo_of_Cambodian_Red_Cross.svg') }}"
                        alt="">
                    <h1 class="text-[14px] font-khmer text-blue-600">សលាកបត្រព័ត៍មានផ្ទាល់ខ្លួន យុវជនកាកបាទក្រហមកម្ពុជា</h1>
                    <h1 class="text-[14px]">Cambodian Red Cross Youth Individual Information</h1>
                    <p class="text-xs">── ✦ 𝒯𝒜𝒞𝒯𝐼𝐸𝒩𝒢 ✦ ──</p>
                </div>
                
                <div class="flex justify-end mt-8">
                    <div class="w-28 h-36 border border-black text-center p-2">
                        <p class="text-[12px] font-battambang">ភ្ជាប់មកនូវ</p>
                        <p class="text-[12px] font-battambang">រូបថត</p>
                        <p class="text-[13px] mt-2">4x6</p>
                        <p class="text-[13px]">3x4</p>
                    </div>
                </div>
            </div>           

            <h2 class="text-[14px] font-khmer text-blue-600">១-ព័ត៌មានលម្អិតផ្ទាល់ខ្លួន (Personal Detail)</h2>
            <div class="font-battambang my-3 text-[15px]">
                @include('member_detail.partials.detail')
            </div>
            <h2 class="text-[14px] font-khmer text-blue-600">២-វគ្គបណ្ដុះបណ្ដាលដែលទទួលបានកន្លងមក (Training Skill)</h2>
            <div class="font-battambang text-[15px]">
                @include('member_detail.partials.training_skill')
            </div>
            <h2 class="text-[14px] font-khmer text-blue-600">៣-ព័ត៌មានគ្រួសារ (Family Information)</h2>
            <div class="font-battambang text-[15px]">
                @include('member_detail.partials.family_info')
            </div>
            <h2 class="text-[14px] font-khmer text-blue-600">៤-កិច្ចសន្យា (Contract)</h2>
            <div class="font-battambang mb-8 mt-4 text-[15px]">
                <h3 class="px-2">&nbsp; ខ្ញុំបាទ/នាងខ្ញុំ សូមបញ្ញាក់ថា រាល់ព័ត៌មានដែលបានរៀបរាប់ជូនខាងលើ ពិតជាត្រឹមត្រូវពិតប្រាកដមែន ហើយយល់</h3>
                <h3>ព្រមចូលជាសមាជិកយុវជនកាកបាទក្រហម ចាប់ពីថ្ងៃចុះហត្ថលេខានេះតទៅ</h3>
            </div>
                <!--
            <button class="px-2 py-2 bg-red-500 text-white rounded-lg hover:bg-red-800">Export to PDF (EMT)</button>
            -->
        </div>   
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
            document.addEventListener('DOMContentLoaded', function () {
                $("#source-html").show();
                $("#form-detail").on('click', () => {
                    $("#source-html").toggle(200);
                })
                $("#request-form").on('click', () => {
                    $("#source-html").show();
                })
                $("#card").on('click', () => {
                    $("#source-html").show();
                })
            })

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
