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
    <div class="bg-white mx-4 ">
        <div class="ml-20 p-4 hidden" id="source-html">
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
            <h2 class="text-xl">4-កិច្ចសន្យា (Contract)</h2>
            <div class="font-siemreap mb-8 mt-4">
                <h3>ខ្ញុំបាទ/នាងខ្ញុំ សូមបញ្ញាក់ថា រាល់ព័ត៌មានដែលបានរៀបរាប់ជូនខាងលើ ពិតជាត្រឹមត្រូវពិតប្រាកដមែន ហើយយល់ព្រមចូលជាសមាជិកយុវជនកាកបាទក្រហម ចាប់ពីថ្ងៃចុះហត្ថលេខានេះតទៅ</h3>
            </div>
                <!--
            <button class="px-2 py-2 bg-red-500 text-white rounded-lg hover:bg-red-800">Export to PDF (EMT)</button>
            -->
        </div>
        
        @include('member_detail.option.request-form')
        @include('member_detail.option.card') 
    </div>
    <div class="mr-4 mt-4 mb-4 text-end">
        <button id="clear_btn" class="px-2 py-2 bg-red-500 text-white rounded-lg hover:bg-red-800">លុប</button>
        <button class="px-2 py-2 bg-green-500 text-white rounded-lg hover:bg-green-800">យល់ព្រម</button>
        <button class="word-btn px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-800" id="word-btn" onclick="exportHTML();">Export word</button>
    </div>
    @endsection
    
    @push('JS')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                $("#source-html").removeClass('hidden');
                $("#request-form").addClass('hidden');      
                $("#card").addClass('hidden');
                
                $("#form-detail-btn").on('click', () => {
                    $("#source-html").removeClass('hidden');
                    $("#request-form").addClass('hidden');      
                    $("#card").addClass('hidden');
                   
                })
                $("#request-form-btn").on('click', () => {
                    $("#request-form").removeClass('hidden');
                    $("#source-html").addClass('hidden');
                    $("#card").addClass('hidden');
                    
                })  
                $("#card-btn").on('click', () => {
                    $("#card").removeClass('hidden');
                    $("#request-form").addClass('hidden');
                    $("#source-html").addClass('hidden');
                    
                })
            })
        </script>
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
                            h1, h2 {
                                text-align: center;
                            }
                            table {
                                width: 100%;
                                border-collapse: collapse;
                            }
                            td, th {
                                
                                padding: auto;
                            }
                            .logo {
                                margin: 0 auto;
                                width: 100px;
                            }
                        </style>        
                    </head>
                    <body>`;

                var content = document.getElementById("source-html").innerHTML;
                
                var formattedContent = `
                    <div>
                        <img class="logo" src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/Logo_of_Cambodian_Red_Cross.svg'))) }}" />
                        <h1>សលាកបត្រព័ត៌មានផ្ទាល់ខ្លួន យុវជនកាកបាទក្រហមកម្ពុជា</h1>
                        <p>Cambodian Red Cross Youth Individual Information</p>
                        <table>
                            <tr>
                                <td>
                                    ឈ្មោះ {{ $member->name_kh ?? "........." }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    អក្សរឡាតាំង {{ $member->name_en ?? "..........." }}
                                   
                                </td>
                                <td>
                                     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ភេទ {{$member->gender}}
                                </td>
                            </tr>
                            <tr>
                                <td>ថ្ងៃទី ខែ ឆ្នាំកំណើត (Date of Birth): {{$member->date_of_birth ?? "........................."}}</td>
                            </tr>
                            <tr>
                                <td>ទីកន្លែងកំណើត (Place of Birth): {{$member->pob ?? "............................."}}</td>
                            </tr>
                            <tr>
                                <td>
                                    អសយដ្ធានបច្ចុប្បន្ន (Current Address) ផ្ទះលេខ ៖ {{$member_addr->home_no ?? "......."}}
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    ផ្លូវ​​​ ៖ {{$member_addr->street_no ?? "........"}}
                                </td>
                                <td>ភូមិ ៖ {{$member_addr->village ?? "........."}}</td>
                            </tr>
                            <tr>
                                <td>
                                    ឃុំ/សង្កាត់ ៖ {{$member_addr->commune_sangkat ?? "........."}}
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    ស្រុក/ខណ្ទ ៖ {{$member_addr->district_khan ?? "........."}}
                                </td>
                                <td>ខេត្ត/រាជធានី ៖ {{$member_addr->provience_city ?? ""}}</td>
                            </tr>
                            <tr merge 2 col>
                                <td>កម្រិតវប្បធម៌ ឬថ្នាក់ទី ឬឆ្នាំទី (Education or Class) ៖ {{$member_edu->acadmedic_year ?? "........."}}</td>
                            </tr>
                            <tr merge 2 col>
                                <td>ភាសាបរទេស (Foreign language ) ៖ {{$member_edu->language}}</td>
                            </tr>
                            <tr merge 2 col>
                                <td>ជំនាញផ្ទាល់ខ្លួន (Life Skills ) ៖ {{$member_edu->major}}</td>
                            </tr>
                            <tr merge 2 col>
                                <td>ថ្ងៃ ខែ ឆ្នាំ ចូលជាយុវជនកាកបាទក្រហមកម្ពុជា (RCY Recruitment Date) ៖ {{$member_regis->registration_date}}</td>
                            </tr>
                            <tr merge 2 col>
                                <td>ថ្ងៃ ខែ ឆ្នាំ ចូលជាយុវជនជាតិកាយរឹទ្ធិកម្ពុជា (Scout Youth Recruitment Date) ៖ {{$member_regis->registration_date}}</td>
                            </tr>
                            <tr merge 2 col>
                                <td>ថ្ងៃ ខែ ឆ្នាំ ចូលជាយុវជន ស.ស.យ​.ក (UYFC Recruitment Date) ៖ {{$member_regis->registration_date}}</td>
                            </tr>
                            <tr merge 2 col>
                                <td>ថ្ងៃ ខែ ឆ្នាំ ចូលជាអង្គការចាត់តាំងយុវជនផ្សេងៗ (Other NGos Recruitment Date) ៖ {{$member_regis->registration_date}}</td>
                            </tr>
                            <tr merge 2 col>
                                <td>វគ្គបណ្ដុះបណ្ដាលទទួលបាន ៖ {{$member_edu->misc_skill}}</td>
                            </tr>
                            <tr merge 2 col>
                                <td>ឈ្មោះសាលារៀន ឬសាកលវិទ្យាល័យ (Name of School or University) ៖ {{$member_edu->institute_id}}</td>
                            </tr>
                            <tr>
                                <td>ទំហំ អាវ ៖ {{$member->shirt_size}}</td>
                            </tr>
                            <tr merge 2 col>
                                <td>លេខទូរសព្ទទំនាក់ទំនង (Phone Number) ៖ {{$member->phone_number}}</td>
                            </tr>
                            <tr merge 2 col>
                                <td>អ៊ីម៉ែល និងហ្វេសប៊ុក (E-mail and Facebook) ៖ {{$member->email}} {{$member->facebook}}</td>
                            </tr>
                            <tr>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                            </tr>
                        </table>
                    </div>`;

                var footer = "</body></html>";
                var sourceHTML = header + formattedContent + footer;
                //var sourceHTML = header+document.getElementById("source-html").innerHTML+footer;

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
