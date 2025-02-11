<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        @font-face {
            font-family: 'khmerOSSiemreap';
            src: url('{{ realpath(storage_path('fonts/KhmerOSSiemreap-Regular.ttf')) }}') format('truetype');
        }

        @font-face {
            font-family: 'khmer_font';
            src: url('{{ realpath(storage_path('fonts/KhmerOSBattambang-Regular.ttf')) }}') format('truetype');
        }
        .logo {
            width: 150px;
            height: 150px;
        }
        body {
            margin: 20px;
            display: flex;
            justify-content: center;
            font-family: 'khmer_font';
        }
    </style>
</head>
<body>
    <?php
    $member_addr = $member->member_current_address ?? '';
    $member_edu = $member->member_education_background ?? '';
    $member_regis = $member->member_registration_detail ?? '';
    $member_guardian = $member->member_guardian_detail ?? '';
    $member_pob = $member->member_pob_address ?? '';
    ?>
    <div class="bg-white mx-4">
        <div class="ml-20 p-4 hidden" id="source-html">
            <div class="flex justify-center">
                <div>
                    <div class="flex justify-center" style="justify-content : center; display: flex; text-align: center">
                        <img  src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/CRC LOGO_3_inch.svg'))) }}" width="150" 
                        alt="Company Logo">
                    </div>
                    {{-- <div>
                        <h2 style="font-family: 'khmer_font'">សលាកបត្រព័ត៌មានផ្ទាល់ខ្លួន យុវជនកាកបាទក្រហមកម្ពុជា</h2>
                        <p class="title">Cambodian Red Cross Youth Individual Information</p>

                    </div> --}}
                </div>
                <div>
                    <h2 style="font-family: 'khmer_font">ដដដដដដ</h2>
                </div>
                <div class="ml-10 mb-10" style="display: flex; justify-content: end;">
                    <img class="profile-image w-32 h-36 bg-red-300 rounded-md"
                        src="{{ asset($member->image ?? 'public/images/placeholder.png') }} ">
                </div>
            </div>
            <h4 style="font-family: 'khmer_font">1-ព័ត៌មានលម្អិតផ្ទាល់ខ្លួន (Personal Detail)</h4>
            <div class="font-siemreap">
                @include('member_detail.partials.detail')
            </div>
            <h4 class="text-xl">2-វគ្គបណ្ដុះបណ្ដាលដែលទទួលបានកន្លងមក (Training Skill)</h4>
            <div class="font-siemreap">
                @include('member_detail.partials.training_skill')
            </div>
            <h4 class="text-xl">3-ព័ត៌មានគ្រួសារ (Family Information)</h4>
            <div class="font-siemreap">
                @include('member_detail.partials.family_info')
            </div>
            <h4 class="">4-កិច្ចសន្យា (Contract)</h4>
            <div class="mb-8 mt-4">
                <p>ខ្ញុំបាទ/នាងខ្ញុំ សូមបញ្ញាក់ថា រាល់ព័ត៌មានដែលបានរៀបរាប់ជូនខាងលើ ពិតជាត្រឹមត្រូវពិតប្រាកដមែន ហើយយល់ព្រមចូលជាសមាជិកយុវជនកាកបាទក្រហម ចាប់ពីថ្ងៃចុះហត្ថលេខានេះតទៅ</p>
            </div>
                <!--
            <button class="px-2 py-2 bg-red-500 text-white rounded-lg hover:bg-red-800">Export to PDF (EMT)</button>
            -->
        </div>    
    </div>
</body>
</html>