<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambodian Red Cross Youth Individual Information</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Battambang:wght@100;300;400;700;900&family=Khmer&family=Moul&family=Siemreap&display=swap"
        rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
@php
    use App\Helpers\DateTimeFormat; 
@endphp

<body>
    <div>
        <div class="grid grid-cols-6 ">
            <div class="col-span-5 flex flex-col items-center justify-center mb-5 ml-24">
                <img class="w-[120px] h-[120px] mb-1" src="{{ asset('images/Logo_of_Cambodian_Red_Cross.svg') }}"
                    alt="">
                <h1 class="text-[14px] font-khmer text-blue-600">សលាកបត្រព័ត៍មានផ្ទាល់ខ្លួន យុវជនកាកបាទក្រហមកម្ពុជា
                </h1>
                <h1 class="text-[14px]">Cambodian Red Cross Youth Individual Information</h1>
                {{-- <p class="text-xs">── ✦ 𝒯𝒜𝒞𝒯𝐼𝐸𝒩𝒢 ✦ ──</p> --}}
            </div>

            <div class="flex justify-end mt-8">
                @if ($member->member_image != null)
                    <div class="w-28 h-36 border border-black text-center">
                        <img class="h-36 w-28" src="{{asset($member->member_image)}}" alt="member-image">
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

        <h2 class="text-[15px] font-khmer text-blue-600">១-ព័ត៌មានលម្អិតផ្ទាល់ខ្លួន (Personal Detail)</h2>
        <div class="text-[14px]" style="font-family: 'Battambang'">
            <div class="flex flex-wrap mx-3 my-2 gap-1">
                <div class=" flex ml-2 w-full md:w-1/3 md:mb-0 relative">
                    <h3 class="">
                        - ឈ្មោះ <span>.............................................</span>
                    </h3>
                    <span class="absolute top-[-3px] left-[90px] font-bold">{{$member->name_kh ?? ""}}</span>
                </div>

                <div class="flex w-full md:w-[280px] md:mb-0 relative">
                    <h3 class="">
                        អក្សរឡាតាំង <span> .............................................................</span>
                    </h3>
                    <span class="absolute top-[-3px] left-[90px] font-bold">{{$member->name_en ?? ""}}</span>
                </div>

                <div class="flex md:mb-0 relative">
                    <h3 class="">
                        ភេទ <span>..................................</span>
                    </h3>
                    <span class="absolute top-[-3px] left-[35px] font-bold">{{$member->gender ?? ""}}</span>
                </div>
                <div class="flex w-full  md:mb-0 relative">
                    <h3 class="px-2">
                        - ថ្ងៃទី ខែ ឆ្នាំកំណើត (Date of Birth) :
                        <span>..................................................................................................................................</span>
                    </h3>
                    <span class="absolute top-[-3px] left-[230px] font-bold">
                        {{DateTimeFormat::convertEnglishToKhmerNumbersAndMonth($member->date_of_birth) ?? ""}}</span>
                </div>
                <div class="flex flex-wrap w-full md:w-full md:mb-0 relative">
                    <h3 class="px-2">
                        &ensp; ទីកន្លែងកំណើត (Place of Birth)
                    </h3>
                    <h3 class="px-2">
                        ភូមិ ៖ <span>.....................</span>
                    </h3>
                    <span class="absolute top-[-3px] left-[250px] font-bold"> {{$member->pob_village ?? ""}}</span>
                    <h3 class="px-2">
                        ឃុំ/សង្កាត់ ៖
                        <span>......................</span>
                    </h3>
                    <span class="absolute top-[-3px] left-[400px] font-bold"> {{$member->pob_commune ?? ""}}</span>
                    <h3 class="px-2">
                        ស្រុក/ខណ្ទ ៖ <span>............................</span>
                    </h3>
                    <span class="absolute top-[-3px] left-[560px] font-bold"> {{$member->pob_district ?? ""}}</span>
                    <h3 class="px-2">
                        - រាជធានី/ខេត្ត ៖​
                        <span>.......................................................................................................................................................................</span>
                    </h3>
                    <span class="absolute top-[18px] left-[120px] font-bold"> {{$member->pob_province ?? ""}}</span>
                </div>
                <div class="flex md:mb-0">
                    <h3 class="px-2">
                        - អសយដ្ធានបច្ចុប្បន្ន (Current Address)
                    </h3>
                </div>
                <div class="flex  md:mb-0 relative">
                    <h3 class="px-2">
                        ផ្ទះលេខ ៖ <span>..................</span>
                    </h3>
                    <span class="absolute top-[-3px] left-[70px] font-bold">
                        {{$member->current_house_number ?? ""}}</span>
                </div>
                <div class="flex  md:mb-0 relative">
                    <h3 class="px-2">
                        &ensp; ផ្លូវ​​​ ៖ <span>..................</span>
                    </h3>
                    <span class="absolute top-[-3px] left-[60px] font-bold"> {{$member->current_street ?? ""}}</span>
                </div>
                <div class="flex w-full md:w-1/4  md:mb-0 relative">
                    <h3 class="px-2">
                        ភូមិ ៖ <span>...................................</span>
                    </h3>
                    <span class="absolute top-[-4px] left-[50px] font-bold"> {{$member->current_village ?? ""}}</span>
                </div>
                <div class="flex ml-4 w-full md:w-1/4 md:mb-0 relative">
                    <h3>
                        ឃុំ/សង្កាត់ ៖ <span>.............................</span>
                    </h3>
                    <span class="absolute top-[-4px] left-[80px] font-bold"> {{$member->current_commune ?? ""}}</span>
                </div>
                <div class="flex w-full md:w-1/3  md:mb-0 relative">
                    <h3 class="px-2">
                        &ensp; ស្រុក/ខណ្ឌ ៖ <span>....................................</span>
                    </h3>
                    <span class="absolute top-[-4px] left-[100px] font-bold"> {{$member->current_district ?? ""}}</span>
                </div>
                <div class="flex  md:mb-0 relative">
                    <h3 class="">
                        ខេត្ត/រាជធានី ៖ <span>.................................................</span>
                    </h3>
                    <span class="absolute top-[-4px] left-[90px] font-bold"> {{$member->current_province ?? ""}}</span>
                </div>

                <div class="flex w-full md:w-full md:mb-0 relative">
                    <h3 class="px-2">
                        - កម្រិតវប្បធម៌ ឬថ្នាក់ទី ឬឆ្នាំទី (Education or Class or Year) ៖
                        <span>.........................................................................................</span>
                    </h3>
                    <span class="absolute top-[-3px] left-[370px] font-bold">
                        {{DateTimeFormat::convertEnglishToKhmerNumbers($member->acadmedic_year) ?? ""}}</span>
                </div>
                <div class="flex w-full md:w-full md:mb-0 relative">
                    <h3 class="px-2">
                        - ភាសាបរទេស (Foreign language ) ៖
                        <span>...............................................................................................................................</span>
                    </h3>
                    <span class="absolute top-[-3px] left-[250px] font-bold"> {{$member->language}}</span>
                </div>
                <div class="flex w-full md:w-full md:mb-0 relative">
                    <h3 class="px-2">
                        - ជំនាញផ្ទាល់ខ្លួន (Life Skills ) ៖
                        <span>...........................................................................................................................................</span>
                    </h3>
                    <span class="absolute top-[-3px] left-[210px] font-bold"> {{$member->major}}</span>
                </div>
                <div class="flex w-full md:w-full md:mb-0 relative">
                    <h3 class="px-2">
                        - ថ្ងៃ ខែ ឆ្នាំ ចូលជាយុវជនកាកបាទក្រហមកម្ពុជា (RCY Recruitment Date) ៖
                        <span>........................................................................</span>
                    </h3>
                    <span class="absolute top-[-3px] left-[430px] font-bold">
                        {{DateTimeFormat::convertEnglishToKhmerNumbersAndMonth($member->registration_date)}}</span>
                </div>
                <div class="flex w-full md:w-full md:mb-0 relative">
                    <h3 class="px-2">
                        - ថ្ងៃ ខែ ឆ្នាំ ចូលជាយុវជនជាតិកាយរឹទ្ធិកម្ពុជា (Scout Youth Recruitment Date) ៖
                        <span>.............................................................</span>
                    </h3>
                    <span
                        class="absolute top-[-3px] left-[470px] font-bold">{{DateTimeFormat::convertEnglishToKhmerNumbersAndMonth($member->scout_youth_registration_date)}}</span>
                </div>
                <div class="flex w-full md:w-full md:mb-0 relative">
                    <h3 class="px-2">
                        - ថ្ងៃ ខែ ឆ្នាំ ចូលជាយុវជន ស.ស.យ​.ក (UYFC Recruitment Date) ៖
                        <span>..................................................................................</span>
                    </h3>
                    <span
                        class="absolute top-[-3px] left-[400px] font-bold">{{DateTimeFormat::convertEnglishToKhmerNumbersAndMonth($member->uyfc_registration_date)}}</span>
                </div>
                <div class="flex w-full md:w-full md:mb-0 relative">
                    <h3 class="px-2">
                        - ថ្ងៃ ខែ ឆ្នាំ ចូលជាអង្គការចាត់តាំងយុវជនផ្សេងៗ (Other NGos Recruitment Date) ៖
                        <span>.........................................................</span>
                    </h3>
                    <span
                        class="absolute top-[-3px] left-[480px] font-bold">{{DateTimeFormat::convertEnglishToKhmerNumbersAndMonth($member->other_ngos_registration_date)}}</span>
                </div>
                <div class="flex w-full md:w-full md:mb-0 relative">
                    <h3 class="px-2">
                        - វគ្គបណ្ដុះបណ្ដាលទទួលបាន ៖
                        <span>...................................................................................................................................................</span>
                    </h3>
                    <span class="absolute top-[-3px] left-[180px] font-bold"> {{$member->misc_skill}}</span>
                </div>
                <div class="flex w-full md:w-full md:mb-0 relative">
                    <h3 class="px-2">
                        - ឈ្មោះសាលារៀន ឬសាកលវិទ្យាល័យ (Name of School or University) ៖
                        <span>......................................................................</span>
                    </h3>
                    <span class="absolute top-[-3px] left-[440px] font-bold">
                        {{$member->school_name ?? $member->institute_kh}}</span>
                </div>
                <div class="flex w-full md:w-full md:mb-0 relative">
                    <h3 class="px-2">
                        - ទំហំ អាវ ៖
                        <span>..............................................................................................................................................................................</span>
                    </h3>
                    <span class="absolute top-[-3px] left-[90px] font-bold"> {{$member->shirt_size}}</span>
                </div>
                <div class="flex w-full md:w-full md:mb-0 relative">
                    <h3 class="px-2">
                        - លេខទូរសព្ទទំនាក់ទំនង (Phone Number) ៖
                        <span>.......................................................................................................................</span>
                    </h3>
                    <span class="absolute top-[-3px] left-[270px] font-bold">
                        {{DateTimeFormat::convertEnglishToKhmerNumbers($member->phone_number)}}</span>
                </div>
                <div class="flex w-full md:w-full  md:mb-0 relative">
                    <h3 class="px-2">
                        - អ៊ីម៉ែល និងហ្វេសប៊ុក (E-mail and Facebook) ៖
                        <span>...............................................................................................................</span>
                    </h3>
                    <span class="absolute top-[-3px] left-[300px] font-bold"> {{$member->email}}
                        {{$member->facebook}}</span>
                </div>
            </div>
        </div>
        <h2 class="text-[15px] font-khmer text-blue-600">២-វគ្គបណ្ដុះបណ្ដាលដែលទទួលបានកន្លងមក (Training Skill)</h2>
        <div class="text-[14px]" style="font-family: 'Battambang'">
            <div class="flex flex-wrap mx-3 my-2 gap-1">
                <div class="flex w-full md:w-full md:mb-0 relative">
                    <h3 class="px-2">
                        - ជំនាញភាសាបរទេស(Language Skill)
                        ៖<span>..............................................................................................................................</span>
                    </h3>
                    <span class="absolute top-[-3px] left-[250px] font-bold"> {{$member->language}}</span>
                </div>
                <div class="flex w-full md:w-full  md:mb-0 relative">
                    <h3 class="px-2">
                        - ជំនាញកុំព្យូទ័រ(Computer Skill)
                        ៖<span>........................................................................................................................................</span>
                    </h3>
                    <span class="absolute top-[-3px] left-[220px] font-bold"> {{$member->computer_skill}}</span>
                </div>
                <div class="flex w-full md:w-full md:mb-0 relative">
                    <h3 class="px-2">
                        - ជំនាញផ្សេងៗ (Other Skill) ៖
                        <span>.............................................................................................................................................</span>
                    </h3>
                    <span class="absolute top-[-3px] left-[200px] font-bold"> {{$member->misc_skill}}</span>
                </div>
            </div>
        </div>
        <h2 class="text-[15px] font-khmer text-blue-600">៣-ព័ត៌មានគ្រួសារ (Family Information)</h2>
        <div class="text-[14px]" style="font-family: 'Battambang'">
            <div class="flex flex-wrap mx-3 my-2 ">
                <div class="flex w-full md:w-1/2 md:mb-0 relative">
                    <h3 class="px-2">
                        - ឈ្មោះឪពុក(Father Name) ៖<span>..........................................</span>
                    </h3>
                    <span class="absolute top-[-3px] left-[200px] font-bold"> {{$member->father_name}}</span>
                </div>
                <div class="flex w-full md:w-1/2 md:mb-0 relative">
                    <h3 class="px-2">
                        &ensp; ថ្ងៃខែឆ្នាំកំណើត
                        ៖<span>.................................................................</span>
                    </h3>
                    <span class="absolute top-[-3px] left-[130px] font-bold"> {{$member->father_dob}}</span>
                </div>
                <div class="flex w-full md:w-full md:mb-0 relative">
                    <h3 class="px-2">
                        &ensp; អាសយដ្ឋាន និងមុខរបរ (Current Address & Job)
                        ៖<span>.........................................................................................................</span>
                    </h3>
                    <span class="absolute top-[-3px] left-[320px] font-bold"> {{$member->father_current_address}}
                        {{$member->father_occupation}}</span>
                </div>
                <div class="flex w-full md:w-1/2 md:mb-0 relative">
                    <h3 class="px-2">
                        - ឈ្មោះម្ដាយ(Mother Name) ៖<span>..........................................</span>
                    </h3>
                    <span class="absolute top-[-3px] left-[200px] font-bold"> {{$member->mother_name}}</span>
                </div>
                <div class="flex w-full md:w-1/2  mb-6 md:mb-0 relative">
                    <h3 class="px-2">
                        &ensp; ថ្ងៃខែឆ្នាំកំណើត
                        ៖<span>.................................................................</span>
                    </h3>
                    <span class="absolute top-[-3px] left-[130px] font-bold"> {{$member->mother_dob}}</span>
                </div>
                <div class="flex w-full md:w-full md:mb-0 relative">
                    <h3 class="px-2">
                        &ensp;&ensp;អាសយដ្ឋាន និងមុខរបរ (Current Address & Job)
                        ៖<span>.........................................................................................................</span>
                    </h3>
                    <span class="absolute top-[-3px] left-[320px] font-bold"> {{$member->mother_current_address}}
                        {{$member->mother_occupation}}</span>
                </div>
                <div class="flex w-full md:w-full md:mb-0 relative">
                    <h3 class="px-2">
                        - លេខទូរសព្ទអាណាព្យាបាល (Protector Number)
                        ៖<span>.............................................................................................................</span>
                    </h3>
                    <span class="absolute top-[-3px] left-[310px] font-bold">
                        {{DateTimeFormat::convertEnglishToKhmerNumbers($member->guardian_phone)}}</span>
                </div>
            </div>
        </div>
        <h2 class="text-[15px] font-khmer text-blue-600">៤-កិច្ចសន្យា (Contract)</h2>
        <div class="mb-8 mt-2 text-[14px]" style="font-family: 'Battambang'">
            <h3>&nbsp;&nbsp;&nbsp;&nbsp; ខ្ញុំបាទ/នាងខ្ញុំ សូមបញ្ញាក់ថា រាល់ព័ត៌មានដែលបានរៀបរាប់ជូនខាងលើ
                ពិតជាត្រឹមត្រូវពិតប្រាកដមែន
                ហើយយល់</h3>
            <h3>ព្រមចូលជាសមាជិកយុវជនកាកបាទក្រហម ចាប់ពីថ្ងៃចុះហត្ថលេខានេះតទៅ ។</h3>
        </div>
    </div>
</body>
</html>