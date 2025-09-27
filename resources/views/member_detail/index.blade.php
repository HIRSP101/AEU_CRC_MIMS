@extends('layouts.templates.att.master')
@push('CSS')
@endpush
@if ($member != null)
    @section('Content')
        @include('loading_view')
        @include('components.member_navigation', ['id' => $member->member_id])
        <div class="w-[210mm] h-auto m-5 bg-white shadow-lg mx-auto" id="source-html">
            <div class="px-12 mt-6">
                <div id="pdfMemberDeatailContent">
                    <div class="grid grid-cols-6 ">
                        <div class="col-span-5 flex flex-col items-center justify-center mb-5 ml-24">
                            <img class="w-[120px] h-[120px] mb-1" src="{{ url('images/Logo_of_Cambodian_Red_Cross.svg') }}"
                                alt="logo">
                            <h1 class="text-[14px] font-khmer text-blue-600">សលាកបត្រព័ត៍មានផ្ទាល់ខ្លួន យុវជនកាកបាទក្រហមកម្ពុជា
                            </h1>
                            <h1 class="text-[14px]">Cambodian Red Cross Youth Individual Information</h1>
                            {{-- <p class="text-xs">── ✦ 𝒯𝒜𝒞𝒯𝐼𝐸𝒩𝒢 ✦ ──</p> --}}
                        </div>

                        <div class="flex justify-end mt-8">
                            @if ($member->member_image != null)
                                <div class="w-28 h-36 border border-black text-center">
                                    <img class="h-36 w-28" src="{{ url($member->member_image) }}" alt="member-image">
                                </div>
                            @else
                                <div class="w-28 h-36 border border-black text-center p-2">
                                    <p class="text-[12px] font-battambang">ភ្ជាប់មកនូវ</p>
                                    <p class="text-[12px] font-battambang">រូបថត</p>
                                    <p class="text-[12px] mt-2">4x6</p>
                                    <p class="text-[12px]">3x4</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <h2 class="text-[15px] font-khmer text-blue-600">១-ព័ត៌មានលម្អិតផ្ទាល់ខ្លួន (Personal Detail)</h2>
                <div class="font-battambang text-[14px]">
                    @include('member_detail.partials.detail')
                </div>
                <h2 class="text-[15px] font-khmer text-blue-600">២-វគ្គបណ្ដុះបណ្ដាលដែលទទួលបានកន្លងមក (Training Skill)</h2>
                <div class="font-battambang text-[14px]">
                    @include('member_detail.partials.training_skill')
                </div>
                <h2 class="text-[15px] font-khmer text-blue-600">៣-ព័ត៌មានគ្រួសារ (Family Information)</h2>
                <div class="font-battambang text-[14px]">
                    @include('member_detail.partials.family_info')
                </div>
                <h2 class="text-[15px] font-khmer text-blue-600">៤-កិច្ចសន្យា (Contract)</h2>
                <div class="font-battambang mb-8 mt-2 text-[14px]">
                    <h3>&nbsp; ខ្ញុំបាទ/នាងខ្ញុំ សូមបញ្ញាក់ថា រាល់ព័ត៌មានដែលបានរៀបរាប់ជូនខាងលើ ពិតជាត្រឹមត្រូវពិតប្រាកដមែន
                        ហើយយល់</h3>
                    <h3>ព្រមចូលជាសមាជិកយុវជនកាកបាទក្រហម ចាប់ពីថ្ងៃចុះហត្ថលេខានេះតទៅ</h3>
                </div>
            </div>
            <div class="p-5">
                @canany(['3', '2'])
                    <button
                        class="word-btn text-white text-[17px] bg-[#4285F4] hover:bg-[#4285F4]/90 focus:ring-2 focus:outline-none rounded-xl px-4 py-2 text-center inline-flex items-center justify-between "
                        id="word-btn" onclick="exportHTML();">Export word</button>
                    <button
                        class="pdf-detail-btn text-white text-[17px] bg-[#4285F4] hover:bg-[#4285F4]/90 focus:ring-2 focus:outline-none rounded-xl px-4 py-2 text-center inline-flex items-center justify-between"
                        id="exportDetailPdf">Export Pdf</button>
                @endcanany
            </div>
        </div>
        <div class="request-form">
            <div>
                @include('member_detail.option.request-form')
            </div>
            <div>
                @include('member_detail.option.card')
            </div>
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

                });
                $("#request-form-btn").on('click', () => {
                    $("#request-form").removeClass('hidden');
                    $("#source-html").addClass('hidden');
                    $("#card").addClass('hidden');

                });
                $("#card-btn").on('click', () => {
                    $("#card").removeClass('hidden');
                    $("#request-form").addClass('hidden');
                    $("#source-html").addClass('hidden');
                });
                $("#delete-btn").on('click', () => {
                    $.ajax({
                        type: 'POST',
                        url: '/deletemember',
                        data: {
                            arr: [{{ $member->member_id }}]
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (response) {
                            console.log(response.message);
                            alert(response.message);
                            window.location.href = document.referrer;
                        },
                        error: function (error) {
                            console.error(error);
                        }
                    });
                });

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
                    success: function (response) {
                        console.log(response.message);
                        $("#loading-overlay").hide();
                        alert(response.message);
                    },
                    error: function (error) {
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
        .title {
        text-align: center;
        }
        h1 {
        font-size: 20px;
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

        .head1 {
        font: Khmer;
        }
        .header-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 10px;
        position: relative;
        }
        .header-container .left {
        flex: 1;
        }    
        .img-logo {
        flex: 1;
        text-align: center;
        }
        .mem-img {
        flex: 1;
        text-align: right;
        }
        </style>        
        </head>
        <body>`;

                var content = document.getElementById("source-html").innerHTML;

                var formattedContent = `
        <div class="header-container">
        <div class="left"></div>
        <div class="img-logo">
        <img class="logo" 
        src="{{ url('images/Logo_of_Cambodian_Red_Cross.svg') }}" width="100" height="100" />
        </div>
        <div class="mem-img">
        <img class="mems-img" src="{{ url($member->member_image) }}" width="100" height="120"/>
        </div>
        <h1 class="head1">សលាកបត្រព័ត៌មានផ្ទាល់ខ្លួន យុវជនកាកបាទក្រហមកម្ពុជា</h1>
        <p class="title">Cambodian Red Cross Youth Individual Information</p>
        <h4 class="content-head">១-ព័ត៌មានលម្អិតផ្ទាល់ខ្លួន (Personal Detail)</h4>
        <table>
        <tr>
        <td>
        ឈ្មោះ {{ $member->name_kh ?? "........." }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        អក្សរឡាតាំង {{ $member->name_en ?? "..........." }}
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
        អសយដ្ធានបច្ចុប្បន្ន (Current Address) ផ្ទះលេខ ៖ {{$member->home_no ?? "....."}}
        ផ្លូវ​​​ ៖ {{$member->street_no ?? "....."}}
        &nbsp;&nbsp;&nbsp;
        ភូមិ ៖ {{$member->village ?? "........."}}
        </td>

        </tr>
        <tr>
        <td>
        ឃុំ/សង្កាត់ ៖ {{$member->commune_sangkat ?? "........."}}
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        ស្រុក/ខណ្ទ ៖ {{$member->district_khan ?? "........."}}
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        ខេត្ត/រាជធានី ៖ {{$member->provience_city ?? "........"}}
        </td>
        </tr>
        <tr merge 2 col>
        <td>កម្រិតវប្បធម៌ ឬថ្នាក់ទី ឬឆ្នាំទី (Education or Class) ៖ <span style="font-size: 14px;">{{$member->acadmedic_year ?? "........."}}</span></td>
        </tr>
        <tr merge 2 col>
        <td>ភាសាបរទេស (Foreign language ) ៖ {{$member->language ?? "..........."}}</td>
        </tr>
        <tr merge 2 col>
        <td>ជំនាញផ្ទាល់ខ្លួន (Life Skills ) ៖ {{$member->major ?? "..........."}}</td>
        </tr>
        <tr merge 2 col>
        <td>ថ្ងៃ ខែ ឆ្នាំ ចូលជាយុវជនកាកបាទក្រហមកម្ពុជា (RCY Recruitment Date) ៖ {{$member->registration_date ?? "..........."}}</td>
        </tr>
        <tr merge 2 col>
        <td>ថ្ងៃ ខែ ឆ្នាំ ចូលជាយុវជនជាតិកាយរឹទ្ធិកម្ពុជា (Scout Youth Recruitment Date) ៖ {{$member->registration_date ?? "..........."}}</td>
        </tr>
        <tr merge 2 col>
        <td>ថ្ងៃ ខែ ឆ្នាំ ចូលជាយុវជន ស.ស.យ​.ក (UYFC Recruitment Date) ៖ {{$member->registration_date ?? "..........."}}</td>
        </tr>
        <tr merge 2 col>
        <td>ថ្ងៃ ខែ ឆ្នាំ ចូលជាអង្គការចាត់តាំងយុវជនផ្សេងៗ (Other NGos Recruitment Date) ៖ {{$member->registration_date ?? "..........."}}</td>
        </tr>
        <tr merge 2 col>
        <td>វគ្គបណ្ដុះបណ្ដាលទទួលបាន ៖ {{$member->misc_skill ?? "..........."}}</td>
        </tr>
        <tr merge 2 col>
        <td>ឈ្មោះសាលារៀន ឬសាកលវិទ្យាល័យ (Name of School or University) ៖ {{$member->institute_id ?? "..........."}}</td>
        </tr>
        <tr>
        <td>ទំហំ អាវ ៖ {{$member->shirt_size ?? "..........."}}</td>
        </tr>
        <tr merge 2 col>
        <td>លេខទូរសព្ទទំនាក់ទំនង (Phone Number) ៖ <span style="font-size: 14px;">{{$member->phone_number ?? "..........."}}</span></td>
        </tr>
                                                                                                                <tr merge 2 col>
                                                                                                                <td>អ៊ីម៉ែល និងហ្វេសប៊ុក (E-mail and Facebook) ៖ {{$member->email ?? "..........."}} {{$member->facebook}}</td>
                                                                                                                </tr>
                                                                                                                </table>
                                                                                                                <h4 class="content-head">២-វគ្គបណ្ដុះបណ្ដាលដែលទទួលបានកន្លងមក (Training Skill)</h4>
                                                                                                                <table>
                                                                                                                <tr>
                                                                                                                <td>- ជំនាញភាសាបរទេស(Language Skill) ៖ <span>{{$member->language ?? "..........."}}</span></td>
                                                                                                                </tr>
                                                                                                                <tr>
                                                                                                                <td>- ជំនាញកុំព្យូទ័រ(Computer Skill{{$member->computer_skill ?? "..........."}}) ៖ </td>
                                                                                                                </tr>
                                                                                                                <tr>
                                                                                                                - ជំនាញផ្សេងៗ (Other Skill) ៖ <span>{{$member->misc_skill ?? "..........."}}</span><td></td>
                                                                                                                </tr>
                                                                                                                <tr>
                                                                                                                <td>- ជំនាញផ្សេងៗ (Other Skill) ៖ {{$member->misc ?? "..........."}}</td>
                                                                                                                </tr>

                                                                                                                </table>
                                                                                                                <h4 class="content-head">៣-ព័ត៌មានគ្រួសារ (Family Information)</h4>
                                                                                                                <table>
                                                                                                                <tr>
                                                                                                                <td> - ឈ្មោះឪពុក(Father Name) ៖ {{$member->father_name ?? "..........."}}</td>
                                                                                                                </tr>
                                                                                                                <tr>
                                                                                                                <td> - ថ្ងៃខែឆ្នាំកំណើត ៖ {{$member->father_dob ?? "..........."}}</td>
                                                                                                                </tr>
                                                                                                                <tr>
                                                                                                                <td> - អាសយដ្ឋាន និងមុខរបរ (Current Address & Job) ៖ {{$member->father_current_address ?? "..........."}} {{$member->father_occupation}}</td>
                                                                                                                </tr>
                                                                                                                <tr>
                                                                                                                <td> - ឈ្មោះម្ដាយ(Mother Name) ៖ {{$member->mother_name ?? "..........."}}</td>
                                                                                                                </tr>
                                                                                                                <tr>
                                                                                                                <td> - ថ្ងៃខែឆ្នាំកំណើត ៖ {{$member->mother_dob ?? "..........."}}</td>
                                                                                                                </tr>
                                                                                                                <tr>
                                                                                                                <td> - អាសយដ្ឋាន និងមុខរបរ (Current Address & Job) ៖ {{$member->mother_current_address ?? "..........."}} {{$member->mother_occupation}}</td>
                                                                                                                </tr>
                                                                                                                <tr>
                                                                                                                <td> - លេខទូរសព្ទអាណាព្យាបាល (Protector Number) ៖ {{$member->guardian_phone ?? "..........."}}</td>
                                                                                                                </tr>
                                                                                                                </table>
                                                                                                                <h4 class="content-head">៤-កិច្ចសន្យា (Contract)</h4>
                                                                                                                <p>ខ្ញុំបាទ/នាងខ្ញុំ សូមបញ្ញាក់ថា រាល់ព័ត៌មានដែលបានរៀបរាប់ជូនខាងលើ ពិតជាត្រឹមត្រូវពិតប្រាកដមែនហើយយល់ព្រមចូលជាសមាជិកយុវជនកាកបាទក្រហម ចាប់ពីថ្ងៃចុះហត្ថលេខានេះតទៅ</p>
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
        <script>
            function exportRequestForm() {
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
                                                                                                                font-size: 1px
                                                                                                                }
                                                                                                                .ita {
                                                                                                                font-style: italic;

                                                                                                                }
                                                                                                                h4 {
                                                                                                                font: Khmer;
                                                                                                                }
                                                                                                                p {
                                                                                                                font-size: 14px;
                                                                                                                }
                                                                                                                .foot-small {
                                                                                                                font-size: 8px;
                                                                                                                }
                                                                                                                .tbltitle {
                                                                                                                text-align: center;
                                                                                                                margin: 12px 50px;
                                                                                                                }
                                                                                                                .verify {
                                                                                                                text-decoration: underline;
                                                                                                                }
                                                                                                                .head1 {
                                                                                                                text-align:center
                                                                                                                }

                                                                                                                </style>        
                                                                                                                </head>
                                                                                                                <body>`;
                var content = document.getElementById("request-form").innerHTML;
                var formattedContent = `
                                                                                                                <div>
                                                                                                                <table>
                                                                                                                <tr>
                                                                                                                <td>
                                                                                                                <div class="head1">
                                                                                                                <h4>សាខាកាកបាទក្រហមកម្ពុជារាជធានី ខេត្ត</h4>
                                                                                                                <p>លេខ.....................កក្រក...........</p>
                                                                                                                </div>
                                                                                                                </td>
                                                                                                                <td></td>
                                                                                                                </tr>
                                                                                                                <tr>
                                                                                                                <td></td>
                                                                                                                <td class="ita">
                                                                                                                <p>ថ្ងៃ................ខែ..........ឆ្នាំថោះ បញ្ចស័ក ព.ស.២៥.....</p>
                                                                                                                <p>រាជធានីភ្នំពេញ/ខេត្ត ថ្ងៃទី ខែ....... ឆ្នាំ២០........</p>
                                                                                                                </td>
                                                                                                                </tr>
                                                                                                                </table>
                                                                                                                <table>    
                                                                                                                <tr>
                                                                                                                <td>
                                                                                                                <div class="tbltitle">
                                                                                                                <h4>វិញ្ញាបនបត្ររដ្ឋបាល<br>សាខាកាកបាទក្រហមកម្ពុជា រាជធានី ខេត្ត....................</h4>
                                                                                                                <h4 class="verify">សូមបញ្ជាក់ថា</h4>
                                                                                                                </div>
                                                                                                                </td>
                                                                                                                </tr>
                                                                                                                <tr>
                                                                                                                <td>
                                                                                                                <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;លោក/កញ្ញា សូ សាងជួប ភេទ ស្រី ជនជាតិខ្មែរ សញ្ជាតិខ្មែរ ថ្ងៃខែឆ្នាំកំណើត 1999-07-12មានអាសយដ្ឋាននៅផ្ទះលេខ ...... ផ្លូវ ...... ភូមិឈូក ឃុំសំរោង ស្រុកសំរោង ខេត្តឧត្តរមានជ័យ ។ បានចូលស្ម័គ្រចិត្តជាយុវជនកាកបាទក្រហមកម្ពុជា វិទ្យាល័យ ......................... រាជធានី/ខេត្ត ..............ចាប់តាំងពីថ្ងៃទី ........ខែ.............ឆ្នាំ..................... ដល់ថ្ងៃទី........ខែ.............ឆ្នាំ..................... ពិតប្រាកដមែន។</p>

                                                                                                                <p>
                                                                                                                នៅក្នុងរយៈពេលស្ម័គ្រចិត្តបម្រើការងារនេះ សាមីខ្លួនបានលះបង់ពេលវេលាចំពោះកម្លាំងកាយ ប្រាជ្ញា ស្មារតីថវិកាផ្ទាល់ខ្លួន និងយកចិត្តទុកដាក់សកម្មចូលរួមជាមួយកាកបាទក្រហមកម្ពុជា ក្នុងតួនាទីជាយុវជនស្ម័គ្រចិត្តដើម្បីបុព្វហេតុមនុស្សធម៌។
                                                                                                                </p>
                                                                                                                <p>
                                                                                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;វិញ្ញាបនបត្ររដ្ឋបាលនេះ ចេញជូនសាមីខ្លួនសម្រាប់ប្រើប្រាស់តាមច្បាប់ដែលអាចប្រើទៅបាន និងក្នុងគោលបំណងផ្ទេរជីវភាពពីគ្រឹះស្ថានសិក្សា បន្ដចូលគ្រឹះស្ថានសិក្សា រាជធានី ខេត្ត ដែលមានបណ្ដាញក្លឹបយុវជនកាកបាទក្រហមកម្ពុជា។
                                                                                                                </p>
                                                                                                                </td>
                                                                                                                </tr>
                                                                                                                <tr class="blank-space">
                                                                                                                <td>

                                                                                                                </td>
                                                                                                                </tr>
                                                                                                                <tr>
                                                                                                                <td>

                                                                                                                </td>
                                                                                                                </tr>
                                                                                                                <tr>
                                                                                                                <td></td>
                                                                                                                </td>
                                                                                                                <tr>
                                                                                                                <td></td>
                                                                                                                </td>
                                                                                                                <tr>
                                                                                                                <td></td>
                                                                                                                </td>
                                                                                                                <tr>
                                                                                                                <td></td>
                                                                                                                </td>
                                                                                                                <tr>
                                                                                                                <td></td>
                                                                                                                </td>
                                                                                                                <tr>
                                                                                                                <td></td>
                                                                                                                </td>
                                                                                                                <tr>
                                                                                                                <td></td>
                                                                                                                </td>
                                                                                                                <tr>
                                                                                                                <td></td>
                                                                                                                </td>
                                                                                                                <tr>
                                                                                                                <td></td>
                                                                                                                </td>
                                                                                                                <tr>
                                                                                                                <td></td>
                                                                                                                </td>
                                                                                                                <tr>
                                                                                                                <td></td>
                                                                                                                </td>
                                                                                                                <tr>
                                                                                                                <td></td>
                                                                                                                </td>
                                                                                                                <tr>
                                                                                                                <td></td>
                                                                                                                </td>
                                                                                                                <tr>
                                                                                                                <td></td>
                                                                                                                </td>
                                                                                                                <tr>
                                                                                                                <td></td>
                                                                                                                </td>
                                                                                                                <tr>
                                                                                                                <td></td>
                                                                                                                </td>
                                                                                                                <tr>
                                                                                                                <td>
                                                                                                                <div>
                                                                                                                <p class="foot-small">
                                                                                                                កន្លែងទទួល៖ <br>
                                                                                                                - គ្រឹះស្ថានសិក្សា ទូទាំង ២៥ រាជធានី ខេត្ត <br>
                                                                                                                - សាមីខ្លួន <br>
                                                                                                                - ឯកសារ កាលប្បវត្តិ <br>
                                                                                                                </p>

                                                                                                                </div>
                                                                                                                </td>
                                                                                                                </tr>
                                                                                                                </table>
                                                                                                                </div>
                                                                                                                `;

                var footer = "</body></html>";
                var sourceForm = header + formattedContent + footer;

                var source = 'data:application/vnd.ms-word;charset=utf-8,' + encodeURIComponent(sourceForm);
                var fileDownload = document.createElement("a");
                document.body.appendChild(fileDownload);
                fileDownload.href = source;
                fileDownload.download = 'document.doc';
                fileDownload.click();
                document.body.removeChild(fileDownload);
            }

            $("#exportDetailPdf").on("click", function () {
                $("#loadingSpinner").show();
                $("#textload").show();
                $("#spinner").show();
                $("#textsucc").hide();
                $("#tick").hide();
                $("#ok").hide();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '/generate-detail-form',
                    method: 'POST',
                    contentType: 'application/json',
                    data: JSON.stringify({
                        member_id: {{ $member->member_id }},
                    }),
                    success: function (response) {
                        generatePDFfromHTML(response, `សលាកបត្រព័ត៍មានផ្ទាល់ខ្លួន_${@json($member->name_kh)}`);
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
                    error: function (xhr, status, error) {
                        $("#loadingSpinner").hide();
                        console.error("Error generating report:", error);
                    }
                });
            });
            $("#exportPdfRequestForm").on("click", function () {
                $("#loadingSpinner").show();
                $("#textload").show();
                $("#spinner").show();
                $("#textsucc").hide();
                $("#tick").hide();
                $("#ok").hide();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '/generate-request-form',
                    method: 'POST',
                    contentType: 'application/json',
                    data: JSON.stringify({
                        member_id: {{ $member->member_id }}
                                                                                                                                                                                                                                                                            }),
                    success: function (response) {
                        generatePDFfromHTML(response, `វិញ្ញាបនបត្ររដ្ឋបាល_${@json($member->name_kh)}`);
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
                    error: function (xhr, status, error) {
                        $("#loadingSpinner").hide();
                        console.error("Error generating report:", error);
                    }
                });
            });
            function generatePDFfromHTML(responseHtml, fileName) {
                const options = {
                    margin: 0.5,
                    filename: fileName + ".pdf",
                    jsPDF: { unit: "in", format: "a4", orientation: "portrait" },
                };

                html2pdf().set(options).from(responseHtml).save();
            }
        </script>
    @endpush
@else
    @section('Content')
        @include('null_view')
    @endsection
@endif