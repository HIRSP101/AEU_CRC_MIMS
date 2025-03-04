<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print single member</title>
    <link rel="stylesheet" href="../css/app.css">
    <style>
        import url('https://fonts.googleapis.com/css2?family=Battambang:wght@100;300;400;700;900&family=EB+Garamond:ital,wght@0,400..800;1,400..800&family=Moul&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

        @font-face {
            font-family: 'khmer-battambang';
            src: url({{ storage_path('fonts/KhmerOSBattambang-Regular.ttf') }}) format('truetype');
        }

        @font-face {
            font-family: 'khmerOsMoulLight';
            src: url({{ storage_path('fonts/KhmerOSMuolLight-Regular.ttf') }});
        }

        .battambang-thin {
            font-family: "Battambang", system-ui;
            font-weight: 100;
            font-style: normal;
        }

        .battambang-light {
            font-family: "Battambang", system-ui;
            font-weight: 300;
            font-style: normal;
        }

        .battambang-regular,
        h3 {
            font-family: "Battambang", system-ui;
            font-weight: 400;
            font-style: normal;
            font-size: 15px;
        }

        .battambang-bold {
            font-family: "Battambang", system-ui;
            font-weight: 700;
            font-style: normal;
        }

        .battambang-black {
            font-family: "Battambang", system-ui;
            font-weight: 900;
            font-style: normal;
        }

        .logo {
            width: 150px;
            height: 150px;
        }

        body {
            margin: 20px;
            display: flex;
            justify-content: center;
        }

        .title {
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

        ភូមិ ៖ <span class="font-bold">{{ $member->member_pob_address->village ?? '' }}</span>

        ឃុំ/សង្កាត់ ៖

        ស្រុក/ខណ្ទ ៖ <span class="font-bold">{{ $member->member_pob_address->district_khan ?? '' }}</span>

        រាជធានី/ខេត្ត ៖​ <span class="font-bold">{{ $member->member_pob_address->provience_city ?? '' }}</span>

        <div class="container2">
            <div>
                អសយដ្ធានបច្ចុប្បន្ន (Current Address) ផ្ទះលេខ ៖ <span class="font-bold">
                    {{ $member->member_current_address->home_no ?? '' }}</span>
            </div>

            <div>
                ផ្លូវ​​​ ៖ <span class="font-bold"> {{ $member->member_current_address->street_no ?? '' }} </span>
            </div>

            <div>
                ភូមិ ៖ <span class="font-bold"> {{ $member->member_current_address->village ?? '' }} </span>
            </div>

        </div>
        <div class="container3">
            <div>
                <p>ឃុំ/សង្កាត់ ៖ <span
                        class="font-bold">{{ $member->member_current_address->commune_sangkat ?? '' }}</span></p>
            </div>
            <div>
                <p>ស្រុក/ខណ្ទ ៖ <span
                        class="font-bold">{{ $member->member_current_address->district_khan ?? '' }}</span></p>
            </div>
            <div>
                <p>ខេត្ត/រាជធានី ៖ <span
                        class="font-bold">{{ $member->member_current_address->provience_city ?? '' }}</span></p>
            </div>
        </div>
        <div>
            <p>
                កម្រិតវប្បធម៌ ឬថ្នាក់ទី ឬឆ្នាំទី (Education or Class or Year) ៖ <span
                    class="font-bold">{{ $member->member_education_background->acadmedic_year ?? '' }}</span>
            </p>
            <p>
                ភាសាបរទេស (Foreign language ) ៖ <span
                    class="font-bold">{{ $member->member_education_background->language }}</span>
            </p>
            <p>
                ជំនាញផ្ទាល់ខ្លួន (Life Skills ) ៖ {{ $member->member_education_background->major ?? '' }}
            </p>
            <p>
                ថ្ងៃ ខែ ឆ្នាំ ចូលជាយុវជនកាកបាទក្រហមកម្ពុជា (RCY Recruitment Date) ៖ <span
                    class="font-bold">{{ $member->member_education_background->registration_date ?? '' }}</span>
            </p>
            <p>
                ថ្ងៃ ខែ ឆ្នាំ ចូលជាយុវជនជាតិកាយរឹទ្ធិកម្ពុជា (Scout Youth Recruitment Date) ៖ <span
                    class="font-bold">{{ $member->member_education_background->registration_date }}</span>
            </p>
            <p>
                ថ្ងៃ ខែ ឆ្នាំ ចូលជាយុវជន ស.ស.យ​.ក (UYFC Recruitment Date) ៖ <span
                    class="font-bold">{{ $member->member_education_background->registration_date }}</span>
            </p>
            <p>
                ថ្ងៃ ខែ ឆ្នាំ ចូលជាអង្គការចាត់តាំងយុវជនផ្សេងៗ (Other NGos Recruitment Date) ៖ <span
                    class="font-bold">{{ $member->member_education_background->registration_date }}</span>
            </p>
            <p>
                វគ្គបណ្ដុះបណ្ដាលទទួលបាន ៖ {{ $member->member_education_background->misc_skill ?? '' }}
            </p>
            <p>
                ឈ្មោះសាលារៀន ឬសាកលវិទ្យាល័យ (Name of School or University) ៖ <span
                    class="font-bold">{{ $member->member_education_background->institute_id }}</span>
            </p>
            <p>
                ទំហំ អាវ ៖ <span class="font-bold">{{ $member->shirt_size ?? '' }}</span>
            </p>
            <p>
                លេខទូរសព្ទទំនាក់ទំនង (Phone Number) ៖ <span class="font-bold">{{ $member->phone_number }}</span>
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

</body>
<script></script>

</html>
