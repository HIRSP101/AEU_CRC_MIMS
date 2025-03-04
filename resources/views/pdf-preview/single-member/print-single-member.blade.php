<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>pdf preview</title>
    @stack('JS')
    <style>
        @font-face {
            font-family: 'khmerOSSiemreap';
            src: url('{{ realpath(storage_path('fonts/KhmerOSSiemreap-Regular.ttf')) }}') format('truetype');
        }

        @font-face {
            font-family: 'khmer';
            src: url({{ storage_path('fonts/KhmerOSBattambang-Regular.ttf') }}) format('truetype');
        }

        @font-face {
            font-family: 'khmerOsMoulLight';
            src: url({{ storage_path('fonts/KhmerOSMuolLight-Regular.ttf') }});
        }

        .logo {
            width: 150px;
            height: 150px;
        }

        body {
            margin: 20px;
            display: flex;
            justify-content: center;
            font-family: 'khmer';
        }

        h4 {
            font-family: khmer;
            font-weight: 400
        }

        .title {
            font-family: khmerOsMoulLight;
            font-size: 18px;
            text-align: center;
        }

        .sub-title {
            font-size: 16px;
            text-align: center;
        }

        .profile-image {
            display: flex;
            justify-content: end;
            align-items: center;
        }

        .container1 {
            display: grid;
            grid-template-columns: auto auto auto;
        }

        .container2 {
            display: grid;
            grid-template-columns: auto auto auto;
        }

        .container3 {
            display: grid;
            grid-template-columns: auto auto auto;
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
                    <div class="flex justify-center"
                        style="justify-content : center; display: flex; text-align: center">
                        <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/CRC LOGO_3_inch.svg'))) }}"
                            width="150" alt="Company Logo">
                    </div>
                    <div>
                        <h4 class="title">សលាកបត្រព័ត៌មានផ្ទាល់ខ្លួន យុវជនកាកបាទក្រហមកម្ពុជា</h4>
                        <p class="sub-title">Cambodian Red Cross Youth Individual Information</p>
                    </div>
                </div>
                <div class="ml-10 mb-10 profile-image" style="border-color: red">
                    <img class="profile-image w-32 h-36 bg-red-300 rounded-md border-2 border-gray-300"
                        src="{{ asset($member->member_image ?? 'public/images/placeholder.png') }}" alt="Profile Image">
                </div>
            </div>
            <h4>1-ព័ត៌មានលម្អិតផ្ទាល់ខ្លួន (Personal Detail)</h4>
            <div class="font-battambang">

                <div class="container1">
                    <div>
                        ឈ្មោះ <span class="">{{ $member->name_kh ?? '' }}</span>
                    </div>
                    <div>
                        អក្សរឡាតាំង <span class=""> {{ $member->name_en ?? '' }}</span>
                    </div>
                    <div>
                        ភេទ <span class=""> {{ $member->gender ?? '' }}</span>
                    </div>
                </div>
                <div>
                    <p>ថ្ងៃទី ខែ ឆ្នាំកំណើត (Date of Birth): <span class="font-bold">
                            {{ $member->date_of_birth ?? '' }}</span></p>
                </div>
                <div>
                    <p>ទីកន្លែងកំណើត (Place of Birth):</p>
                </div>

                ភូមិ ៖ <span class="font-bold">{{ $member_pob->village ?? '' }}</span>

                ឃុំ/សង្កាត់ ៖

                ស្រុក/ខណ្ទ ៖ <span class="font-bold">{{ $member_pob->district_khan ?? '' }}</span>

                រាជធានី/ខេត្ត ៖​ <span class="font-bold">{{ $member_pob->provience_city ?? '' }}</span>

                <div class="container2">
                    <div>
                        អសយដ្ធានបច្ចុប្បន្ន (Current Address) ផ្ទះលេខ ៖ <span class="font-bold">
                            {{ $member_addr->home_no ?? '' }}</span>
                    </div>

                    <div>
                        ផ្លូវ​​​ ៖ <span class="font-bold"> {{ $member_addr->street_no ?? '' }} </span>
                    </div>

                    <div>
                        ភូមិ ៖ <span class="font-bold"> {{ $member_addr->village ?? '' }} </span>
                    </div>

                </div>
                <div class="container3">
                    <div>
                        <p>ឃុំ/សង្កាត់ ៖ <span class="font-bold">{{ $member_addr->commune_sangkat ?? '' }}</span></p>
                    </div>
                    <div>
                        <p>ស្រុក/ខណ្ទ ៖ <span class="font-bold">{{ $member_addr->district_khan ?? '' }}</span></p>
                    </div>
                    <div>
                        <p>ខេត្ត/រាជធានី ៖ <span class="font-bold">{{ $member_addr->provience_city ?? '' }}</span></p>
                    </div>
                </div>
                <div>
                    <p>
                        កម្រិតវប្បធម៌ ឬថ្នាក់ទី ឬឆ្នាំទី (Education or Class or Year) ៖ <span
                            class="font-bold">{{ $member_edu->acadmedic_year ?? '' }}</span>
                    </p>
                    <p>
                        ភាសាបរទេស (Foreign language ) ៖ <span class="font-bold">{{ $member_edu->language }}</span>
                    </p>
                    <p>
                        ជំនាញផ្ទាល់ខ្លួន (Life Skills ) ៖ {{ $member_edu->major ?? '' }}
                    </p>
                    <p>
                        ថ្ងៃ ខែ ឆ្នាំ ចូលជាយុវជនកាកបាទក្រហមកម្ពុជា (RCY Recruitment Date) ៖ <span
                            class="font-bold">{{ $member_regis->registration_date ?? '' }}</span>
                    </p>
                    <p>
                        ថ្ងៃ ខែ ឆ្នាំ ចូលជាយុវជនជាតិកាយរឹទ្ធិកម្ពុជា (Scout Youth Recruitment Date) ៖ <span
                            class="font-bold">{{ $member_regis->registration_date }}</span>
                    </p>
                    <p>
                        ថ្ងៃ ខែ ឆ្នាំ ចូលជាយុវជន ស.ស.យ​.ក (UYFC Recruitment Date) ៖ <span
                            class="font-bold">{{ $member_regis->registration_date }}</span>
                    </p>
                    <p>
                        ថ្ងៃ ខែ ឆ្នាំ ចូលជាអង្គការចាត់តាំងយុវជនផ្សេងៗ (Other NGos Recruitment Date) ៖ <span
                            class="font-bold">{{ $member_regis->registration_date }}</span>
                    </p>
                    <p>
                        វគ្គបណ្ដុះបណ្ដាលទទួលបាន ៖ {{ $member_edu->misc_skill ?? '' }}
                    </p>
                    <p>
                        ឈ្មោះសាលារៀន ឬសាកលវិទ្យាល័យ (Name of School or University) ៖ <span
                            class="font-bold">{{ $member_edu->institute_id }}</span>
                    </p>
                    <p>
                        ទំហំ អាវ ៖ <span class="font-bold">{{ $member->shirt_size ?? '' }}</span>
                    </p>
                    <p>
                        លេខទូរសព្ទទំនាក់ទំនង (Phone Number) ៖ <span
                            class="font-bold">{{ $member->phone_number }}</span>
                    </p>
                    <p>
                        អ៊ីម៉ែល និងហ្វេសប៊ុក (E-mail and Facebook) ៖
                    <P>{{ $member->email }} {{ $member->facebook }}</P>
                    </p>
                </div>
            </div>

            {{-- single member skill --}}
            <h4 class="text-xl khmerBold">2-វគ្គបណ្ដុះបណ្ដាលដែលទទួលបានកន្លងមក (Training Skill)</h4>
            <div class="font-battambang">
                <div class="">
                    <p>ជំនាញភាសាបរទេស(Language Skill) ៖<span>{{ $member_edu->language ?? '' }}</span></p>
                    <p>ជំនាញកុំព្យូទ័រ(Computer Skill) ៖ {{ $member_edu->computer_skill ?? '' }}</p>
                    <p>ជំនាញផ្សេងៗ (Other Skill) ៖ <span>{{ $member_edu->misc_skill ?? '' }}</span></p>
                    <p>ជំនាញផ្សេងៗ (Other Skill) ៖ {{ $member->misc ?? '' }}</p>
                </div>
            </div>
            <h4 class="text-xl khmerBold">3-ព័ត៌មានគ្រួសារ (Family Information)</h4>
            <div class="font-battambang">
                <div class="content1">
                    <div>
                        ឈ្មោះឪពុក(Father Name) ៖ {{ $member_guardian->father_name }}
                    </div>
                    <div>
                        ថ្ងៃខែឆ្នាំកំណើត ៖ {{ $member_guardian->father_dob }}
                    </div>
                    <div>
                        អាសយដ្ឋាន និងមុខរបរ (Current Address & Job) ៖ {{ $member_guardian->father_current_address }}
                        {{ $member_guardian->father_occupation }}
                    </div>
                </div>

                <div class="content2">

                    <div>
                        ឈ្មោះម្ដាយ(Mother Name) ៖ {{ $member_guardian->mother_name }}
                    </div>
                    <div>
                        ថ្ងៃខែឆ្នាំកំណើត ៖ {{ $member_guardian->mother_dob }}
                    </div>
                    <div>
                        អាសយដ្ឋាន និងមុខរបរ (Current Address & Job) ៖ {{ $member_guardian->mother_current_address }}
                        {{ $member_guardian->mother_occupation }}
                    </div>
                </div>
                <div class="phone">
                    <div>
                        លេខទូរសព្ទអាណាព្យាបាល (Protector Number) ៖ {{ $member_guardian->guardian_phone }}
                    </div>
                </div>
            </div>
            <h4 class="khmerBold">4-កិច្ចសន្យា (Contract)</h4>
            <div class="mb-8 mt-4">
                <p>ខ្ញុំបាទ/នាងខ្ញុំ សូមបញ្ញាក់ថា រាល់ព័ត៌មានដែលបានរៀបរាប់ជូនខាងលើ ពិតជាត្រឹមត្រូវពិតប្រាកដមែន
                    ហើយយល់ព្រមចូលជាសមាជិកយុវជនកាកបាទក្រហម ចាប់ពីថ្ងៃចុះហត្ថលេខានេះតទៅ</p>
            </div>
          
        </div>
    </div>
</body>

</html>
