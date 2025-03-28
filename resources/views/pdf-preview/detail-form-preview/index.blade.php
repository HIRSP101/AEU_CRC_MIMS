<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <?php
$member_addr = $member->member_current_address ?? '';
$member_edu = $member->member_education_background ?? '';
$member_regis = $member->member_registration_detail ?? '';
$member_guardian = $member->member_guardian_detail ?? '';
$member_pob = $member->member_pob_address ?? '';
    ?>
    <div class="w-[210mm] h-[330mm] bg-white shadow-lg mx-auto">
        <div class="px-12 hidden" id="source-html">
            <div class="grid grid-cols-6 ">
                <div class="col-span-5 flex flex-col items-center justify-center mb-5 ml-24 mt-6">
                    <img class="w-[120px] h-[120px] mb-1" src="{{ asset('images/Logo_of_Cambodian_Red_Cross.svg') }}"
                        alt="">
                    <h1 class="text-[14px] font-khmer text-blue-600">សលាកបត្រព័ត៍មានផ្ទាល់ខ្លួន យុវជនកាកបាទក្រហមកម្ពុជា
                    </h1>
                    <h1 class="text-[14px]">Cambodian Red Cross Youth Individual Information</h1>
                    {{-- <p class="text-xs">── ✦ 𝒯𝒜𝒞𝒯𝐼𝐸𝒩𝒢 ✦ ──</p> --}}
                </div>

                <div class="flex justify-end mt-8">
                    <div class="w-28 h-36 border border-black text-center p-2">
                        <p class="text-[12px] font-battambang">ភ្ជាប់មកនូវ</p>
                        <p class="text-[12px] font-battambang">រូបថត</p>
                        <p class="text-[12px] mt-2">4x6</p>
                        <p class="text-[12px]">3x4</p>
                    </div>
                </div>
            </div>

            <h2 class="text-[15px] font-khmer text-blue-600">១-ព័ត៌មានលម្អិតផ្ទាល់ខ្លួន (Personal Detail)</h2>
            <div class="font-battambang my-3 text-[14px]">
                <div class="flex flex-wrap mx-3 my-3 gap-1">
                    <div class=" flex w-full md:w-1/3 md:mb-0">
                        <h3 class="px-2">
                            - ឈ្មោះ <span class="font-bold">{{$member->name_kh ?? ""}}</span>
                        </h3>
                    </div>

                    <div class="flex w-full md:w-1/2 md:mb-0">
                        <h3 class="px-2">
                            អក្សរឡាតាំង <span class="font-bold"> {{$member->name_en ?? ""}}</span>
                        </h3>
                    </div>

                    <div class="flex w-full md:w-[80px] md:mb-0">
                        <h3 class="px-2">
                            ភេទ <span class="font-bold"> {{$member->gender ?? ""}}</span>
                        </h3>
                    </div>
                    <div class="flex w-full md:w-1/2 md:mb-0">
                        <h3 class="px-2">
                            - ថ្ងៃទី ខែ ឆ្នាំកំណើត (Date of Birth) <span class="font-bold">
                                {{$member->date_of_birth ?? ""}}</span>
                        </h3>
                    </div>
                    <div class="flex flex-wrap w-full md:w-full md:mb-0">
                        <h3 class="px-2">
                            &ensp; ទីកន្លែងកំណើត (Place of Birth)
                        </h3>
                        <h3 class="px-2">
                            ភូមិ ៖ <span class="font-bold">{{$member_pob->village ?? ""}}</span>
                        </h3>
                        <h3 class="px-2">
                            ឃុំ/សង្កាត់ ៖
                            <span class="font-bold">{{$member_pob->commune_sangkat ?? ""}}</span>
                        </h3>
                        <h3 class="px-2">
                            ស្រុក/ខណ្ទ ៖ <span class="font-bold">{{$member_pob->district_khan ?? ""}}</span>
                        </h3>
                        <h3 class="px-2">
                            - រាជធានី/ខេត្ត ៖​ <span class="font-bold">{{$member_pob->provience_city ?? ""}}</span>
                        </h3>
                    </div>
                    <div class="flex  w-full md:w-1/2  md:mb-0">
                        <h3 class="px-2">
                            - អសយដ្ធានបច្ចុប្បន្ន (Current Address)
                        </h3>
                    </div>
                    <div class="flex w-full md:w-1/3 md:mb-0">
                        <h3 class="px-2">
                            ផ្ទះលេខ ៖ <span class="font-bold"> {{$member_addr->home_no ?? ""}}</span>
                        </h3>
                    </div>
                    <div class="flex w-full md:w-1/3  md:mb-0">
                        <h3 class="px-2">
                            &ensp; ផ្លូវ​​​ ៖ <span class="font-bold"> {{$member_addr->street_no ?? ""}} </span>
                        </h3>
                    </div>
                    <div class="flex w-full md:w-1/4  md:mb-0">
                        <h3 class="px-2">
                            ភូមិ ៖ <span class="font-bold"> {{$member_addr->village ?? ""}} </span>
                        </h3>

                    </div>
                    <div class="flex w-full md:w-1/4 md:mb-0">
                        <h3 class="px-2">
                            ឃុំ/សង្កាត់ ៖ <span class="font-bold">{{$member_addr->commune_sangkat ?? ""}}</span>
                        </h3>
                    </div>
                    <div class="flex w-full md:w-1/3  md:mb-0">
                        <h3 class="px-2">
                            &ensp; ស្រុក/ខណ្ឌ ៖ <span class="font-bold">{{$member_addr->district_khan ?? ""}}</span>
                        </h3>
                    </div>
                    <div class="flex w-full md:w-1/3 md:mb-0">
                        <h3 class="px-2">
                            ខេត្ត/រាជធានី ៖ <span class="font-bold">{{$member_addr->provience_city ?? ""}}</span>
                        </h3>

                    </div>

                    <div class="flex w-full md:w-full md:mb-0">
                        <h3 class="px-2">
                            - កម្រិតវប្បធម៌ ឬថ្នាក់ទី ឬឆ្នាំទី (Education or Class or Year) ៖ <span
                                class="font-bold">{{$member_edu->acadmedic_year ?? ""}}</span>
                        </h3>
                    </div>
                    <div class="flex w-full md:w-full md:mb-0">
                        <h3 class="px-2">
                            - ភាសាបរទេស (Foreign language ) ៖ <span class="font-bold">{{$member_edu->language}}</span>
                        </h3>
                    </div>
                    <div class="flex w-full md:w-full md:mb-0">
                        <h3 class="px-2">
                            - ជំនាញផ្ទាល់ខ្លួន (Life Skills ) ៖
                        </h3>
                        <P>{{$member_edu->major}}</P>
                    </div>
                    <div class="flex w-full md:w-full md:mb-0">
                        <h3 class="px-2">
                            - ថ្ងៃ ខែ ឆ្នាំ ចូលជាយុវជនកាកបាទក្រហមកម្ពុជា (RCY Recruitment Date) ៖ <span
                                class="font-bold">{{$member_regis->registration_date}}</span>
                        </h3>
                    </div>
                    <div class="flex w-full md:w-full md:mb-0">
                        <h3 class="px-2">
                            - ថ្ងៃ ខែ ឆ្នាំ ចូលជាយុវជនជាតិកាយរឹទ្ធិកម្ពុជា (Scout Youth Recruitment Date) ៖ <span
                                class="font-bold">{{$member_regis->registration_date}}</span>
                        </h3>
                    </div>
                    <div class="flex w-full md:w-full md:mb-0">
                        <h3 class="px-2">
                            - ថ្ងៃ ខែ ឆ្នាំ ចូលជាយុវជន ស.ស.យ​.ក (UYFC Recruitment Date) ៖ <span
                                class="font-bold">{{$member_regis->registration_date}}</span>
                        </h3>
                    </div>
                    <div class="flex w-full md:w-full md:mb-0">
                        <h3 class="px-2">
                            - ថ្ងៃ ខែ ឆ្នាំ ចូលជាអង្គការចាត់តាំងយុវជនផ្សេងៗ (Other NGos Recruitment Date) ៖ <span
                                class="font-bold">{{$member_regis->registration_date}}</span>
                        </h3>
                    </div>
                    <div class="flex w-full md:w-full md:mb-0">
                        <h3 class="px-2">
                            - វគ្គបណ្ដុះបណ្ដាលទទួលបាន ៖
                        </h3>
                        <P>{{$member_edu->misc_skill}}</P>
                    </div>
                    <div class="flex w-full md:w-full md:mb-0">
                        <h3 class="px-2">
                            - ឈ្មោះសាលារៀន ឬសាកលវិទ្យាល័យ (Name of School or University) ៖ <span
                                class="font-bold">{{$member_edu->institute_id}}</span>
                        </h3>
                    </div>
                    <div class="flex w-full md:w-full md:mb-0">
                        <h3 class="px-2">
                            - ទំហំ អាវ ៖ <span class="font-bold">{{$member->shirt_size}}</span>
                        </h3>
                    </div>
                    <div class="flex w-full md:w-full md:mb-0">
                        <h3 class="px-2">
                            - លេខទូរសព្ទទំនាក់ទំនង (Phone Number) ៖ <span
                                class="font-bold">{{$member->phone_number}}</span>
                        </h3>
                    </div>
                    <div class="flex w-full md:w-full  md:mb-0">
                        <h3 class="px-2">
                            - អ៊ីម៉ែល និងហ្វេសប៊ុក (E-mail and Facebook) ៖
                        </h3>
                        <P>{{$member->email}} {{$member->facebook}}</P>
                    </div>
                </div>
            </div>
            <h2 class="text-[15px] font-khmer text-blue-600">២-វគ្គបណ្ដុះបណ្ដាលដែលទទួលបានកន្លងមក (Training Skill)</h2>
            <div class="font-battambang text-[14px]">
                <div class="flex flex-wrap mx-3 my-3 gap-1">
                    <div class="flex w-full md:w-full md:mb-0">
                        <h3 class="px-2">
                            - ជំនាញភាសាបរទេស(Language Skill) ៖<span>{{$member_edu->language}}</span>
                        </h3>
                    </div>
                    <div class="flex w-full md:w-full  md:mb-0">
                        <h3 class="px-2">
                            - ជំនាញកុំព្យូទ័រ(Computer Skill) ៖
                        </h3>
                        <P>{{$member_edu->computer_skill}}</P>
                    </div>
                    <div class="flex w-full md:w-full md:mb-0">
                        <h3 class="px-2">
                            - ជំនាញផ្សេងៗ (Other Skill) ៖ <span>{{$member_edu->misc_skill}}</span>
                        </h3>
                    </div>
                    <div class="flex w-full md:w-full md:mb-0">
                        <h3 class="px-2">
                            - ជំនាញផ្សេងៗ (Other Skill) ៖
                        </h3>
                        <P>{{$member->misc}}</P>

                    </div>
                </div>

            </div>
            <h2 class="text-[15px] font-khmer text-blue-600">៣-ព័ត៌មានគ្រួសារ (Family Information)</h2>
            <div class="font-battambang text-[14px]">
                <div class="flex flex-wrap mx-3 my-3 gap-1">
                    <div class="flex w-full md:w-1/2 md:mb-0">
                        <h3 class="px-2">
                            - ឈ្មោះឪពុក(Father Name) ៖
                        </h3>
                        <P>{{$member_guardian->father_name}}</P>
                    </div>
                    <div class="flex w-full md:w-1/2 md:mb-0">
                        <h3 class="px-2">
                            &ensp; ថ្ងៃខែឆ្នាំកំណើត ៖
                        </h3>
                        <P>{{$member_guardian->father_dob}}</P>
                    </div>
                    <div class="flex w-full md:w-full md:mb-0">
                        <h3 class="px-2">
                            &ensp; អាសយដ្ឋាន និងមុខរបរ (Current Address & Job) ៖
                        </h3>
                        <P>{{$member_guardian->father_current_address}} {{$member_guardian->father_occupation}}</P>
                    </div>
                    <div class="flex w-full md:w-1/2 md:mb-0">
                        <h3 class="px-2">
                            - ឈ្មោះម្ដាយ(Mother Name) ៖
                        </h3>
                        <P>{{$member_guardian->mother_name}}</P>
                    </div>
                    <div class="flex w-full md:w-1/2  mb-6 md:mb-0">
                        <h3 class="px-2">
                            &ensp; ថ្ងៃខែឆ្នាំកំណើត ៖
                        </h3>
                        <P>{{$member_guardian->mother_dob}}</P>
                    </div>
                    <div class="flex-1 w-full md:w-full md:mb-0">
                        <h3 class="px-2">
                            អាសយដ្ឋាន និងមុខរបរ (Current Address & Job) ៖
                        </h3>
                        <P>{{$member_guardian->mother_current_address}} {{$member_guardian->mother_occupation}}</P>

                    </div>
                    <div class="flex w-full md:w-full md:mb-0">
                        <h3 class="px-2">
                            - លេខទូរសព្ទអាណាព្យាបាល (Protector Number) ៖
                        </h3>
                        <P>{{$member_guardian->guardian_phone}}</P>
                    </div>
                </div>
            </div>
            <h2 class="text-[15px] font-khmer text-blue-600">៤-កិច្ចសន្យា (Contract)</h2>
            <div class="font-battambang mb-8 mt-4 text-[14px]">
                <h3>&nbsp; ខ្ញុំបាទ/នាងខ្ញុំ សូមបញ្ញាក់ថា រាល់ព័ត៌មានដែលបានរៀបរាប់ជូនខាងលើ ពិតជាត្រឹមត្រូវពិតប្រាកដមែន
                    ហើយយល់</h3>
                <h3>ព្រមចូលជាសមាជិកយុវជនកាកបាទក្រហម ចាប់ពីថ្ងៃចុះហត្ថលេខានេះតទៅ</h3>
            </div>
        </div>
    </div>
</body>

</html>