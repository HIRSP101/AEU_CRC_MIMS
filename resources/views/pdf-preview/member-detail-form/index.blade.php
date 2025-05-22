<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Report</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Battambang:wght@100;300;400;700;900&family=Khmer&family=Moul&family=Siemreap&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body>
    <div class="px-12 " id="source-html">
        <div class="grid grid-cols-6 ">
            <div class="col-span-5 flex flex-col items-center justify-center mb-5 ml-24 mt-6">
                <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path($member->member_image ?? 'images/crc.png'))) }}"
                    width="100" alt="Company Logo">
                <h1 class="text-[14px] text-blue-600" style="font-family: 'Moul'">
                    សលាកបត្រព័ត៍មានផ្ទាល់ខ្លួន យុវជនកាកបាទក្រហមកម្ពុជា
                </h1>
                <h1 class="text-[14px]" style="font-family: 'Battambang'">Cambodian Red Cross Youth Individual
                    Information</h1>
            </div>

            <div class="flex justify-end mt-8">
                <div class="w-28 h-36 border border-black text-center p-2">
                    <p class="text-[12px]" style="font-family: 'Battambang'">ភ្ជាប់មកនូវ</p>
                    <p class="text-[12px]" style="font-family: 'Battambang'">រូបថត</p>
                    <p class="text-[12px] mt-2" style="font-family: 'Battambang'">4x6</p>
                    <p class="text-[12px]" style="font-family: 'Battambang'">3x4</p>
                </div>
            </div>
        </div>

        <h2 class="text-[15px] font-khmer text-blue-600" style="font-family: 'Moul'">១-ព័ត៌មានលម្អិតផ្ទាល់ខ្លួន
            (Personal Detail)</h2>
        <div class="my-3 text-[14px]" style="font-family: 'Battambang'">
            <div class="flex flex-wrap mx-3 my-3 gap-1">
                <div class=" flex w-full md:w-1/3 md:mb-0 relative">
                    <h3 class="px-2">
                        - ឈ្មោះ <span>..........................................</span>
                    </h3>
                    <span class="absolute top-[-3px] left-[90px] font-bold">{{$member->name_kh ?? ""}}</span>
                </div>

                <div class="flex w-full md:w-1/2 md:mb-0 relative">
                    <h3 class="px-2">
                        អក្សរឡាតាំង <span> ......................................</span>
                    </h3>
                    <span class="absolute top-[-3px] left-[90px] font-bold">{{$member->name_en ?? ""}}</span>
                </div>


                <div class="flex w-full md:w-[80px] md:mb-0 relative">
                    <h3 class="px-2">
                        ភេទ <span>......</span>
                    </h3>
                    <span class="absolute top-[-3px] left-[35px] font-bold">{{$member->gender ?? ""}}</span>
                </div>
                <div class="flex w-full md:w-1/2 md:mb-0 relative">
                    <h3 class="px-2">
                        - ថ្ងៃទី ខែ ឆ្នាំកំណើត (Date of Birth) : <span>...........................</span>
                    </h3>
                    <span class="absolute top-[-3px] left-[230px] font-bold"> {{$member->date_of_birth ?? ""}}</span>
                </div>
                <div class="flex flex-wrap w-full md:w-full md:mb-0 relative">
                    <h3 class="px-2">
                        &ensp; ទីកន្លែងកំណើត (Place of Birth)
                    </h3>
                    <h3 class="px-2">
                        ភូមិ ៖ <span>..................</span>
                    </h3>
                    <span class="absolute top-[-3px] left-[250px] font-bold"> {{$member->village ?? ""}}</span>
                    <h3 class="px-2">
                        ឃុំ/សង្កាត់ ៖
                        <span>......................</span>
                    </h3>
                    <span class="absolute top-[-3px] left-[400px] font-bold">
                        {{$member->commune_sangkat ?? ""}}</span>
                    <h3 class="px-2">
                        ស្រុក/ខណ្ទ ៖ <span>.....................</span>
                    </h3>
                    <span class="absolute top-[-3px] left-[560px] font-bold">
                        {{$member->district_khan ?? ""}}</span>
                    <h3 class="px-2">
                        - រាជធានី/ខេត្ត ៖​ <span>..........................</span>
                    </h3>
                    <span class="absolute top-[18px] left-[120px] font-bold">
                        {{$member->provience_city ?? ""}}</span>
                </div>
                <div class="flex  w-full md:w-1/2  md:mb-0">
                    <h3 class="px-2">
                        - អសយដ្ធានបច្ចុប្បន្ន (Current Address)
                    </h3>
                </div>
                <div class="flex w-full md:w-1/3 md:mb-0 relative">
                    <h3 class="px-2">
                        ផ្ទះលេខ ៖ <span>..................</span>
                    </h3>
                    <span class="absolute top-[-3px] left-[70px] font-bold"> {{$member->home_no ?? ""}}</span>
                </div>
                <div class="flex w-full md:w-1/3  md:mb-0 relative">
                    <h3 class="px-2">
                        &ensp; ផ្លូវ​​​ ៖ <span>..................</span>
                    </h3>
                    <span class="absolute top-[-3px] left-[60px] font-bold"> {{$member->street_no ?? ""}}</span>
                </div>
                <div class="flex w-full md:w-1/4  md:mb-0 relative">
                    <h3 class="px-2">
                        ភូមិ ៖ <span>...................... </span>
                    </h3>
                    <span class="absolute top-[-4px] left-[50px] font-bold"> {{$member->village_current ?? ""}}</span>
                </div>
                <div class="flex w-full md:w-1/4 md:mb-0 relative">
                    <h3 class="px-2">
                        ឃុំ/សង្កាត់ ៖ <span>....................</span>
                    </h3>
                    <span class="absolute top-[-4px] left-[80px] font-bold">
                        {{$member->commune_sangkat_current ?? ""}}</span>
                </div>
                <div class="flex w-full md:w-1/3  md:mb-0 relative">
                    <h3 class="px-2">
                        &ensp; ស្រុក/ខណ្ឌ ៖ <span>..........................</span>
                    </h3>
                    <span class="absolute top-[-4px] left-[100px] font-bold">
                        {{$member->district_khan_current ?? ""}}</span>
                </div>
                <div class="flex w-full md:w-1/3 md:mb-0 relative">
                    <h3 class="px-2">
                        ខេត្ត/រាជធានី ៖ <span>...........................</span>
                    </h3>
                    <span class="absolute top-[-4px] left-[90px] font-bold">
                        {{$member->provience_city_current ?? ""}}</span>
                </div>

                <div class="flex w-full md:w-full md:mb-0 relative">
                    <h3 class="px-2">
                        - កម្រិតវប្បធម៌ ឬថ្នាក់ទី ឬឆ្នាំទី (Education or Class or Year) ៖
                        <span>............................</span>
                    </h3>
                    <span class="absolute top-[-3px] left-[370px] font-bold">
                        {{$member->acadmedic_year ?? ""}}</span>
                </div>
                <div class="flex w-full md:w-full md:mb-0 relative">
                    <h3 class="px-2">
                        - ភាសាបរទេស (Foreign language ) ៖
                        <span>...............................................................................................................</span>
                    </h3>
                    <span class="absolute top-[-3px] left-[250px] font-bold"> {{$member->language}}</span>
                </div>
                <div class="flex w-full md:w-full md:mb-0 relative">
                    <h3 class="px-2">
                        - ជំនាញផ្ទាល់ខ្លួន (Life Skills ) ៖
                        <span>..........................................................................................................................</span>
                    </h3>
                    <span class="absolute top-[-3px] left-[210px] font-bold"> {{$member->major}}</span>
                </div>
                <div class="flex w-full md:w-full md:mb-0 relative">
                    <h3 class="px-2">
                        - ថ្ងៃ ខែ ឆ្នាំ ចូលជាយុវជនកាកបាទក្រហមកម្ពុជា (RCY Recruitment Date) ៖
                        <span>...........................</span>
                    </h3>
                    <span class="absolute top-[-3px] left-[430px] font-bold"> {{$member->registration_date}}</span>
                </div>
                <div class="flex w-full md:w-full md:mb-0 relative">
                    <h3 class="px-2">
                        - ថ្ងៃ ខែ ឆ្នាំ ចូលជាយុវជនជាតិកាយរឹទ្ធិកម្ពុជា (Scout Youth Recruitment Date) ៖
                        <span>...........................</span>
                    </h3>
                    <span class="absolute top-[-3px] left-[470px] font-bold"></span>
                </div>
                <div class="flex w-full md:w-full md:mb-0 relative">
                    <h3 class="px-2">
                        - ថ្ងៃ ខែ ឆ្នាំ ចូលជាយុវជន ស.ស.យ​.ក (UYFC Recruitment Date) ៖
                        <span>............................</span>
                    </h3>
                    <span class="absolute top-[-3px] left-[400px] font-bold"></span>
                </div>
                <div class="flex w-full md:w-full md:mb-0 relative">
                    <h3 class="px-2">
                        - ថ្ងៃ ខែ ឆ្នាំ ចូលជាអង្គការចាត់តាំងយុវជនផ្សេងៗ (Other NGos Recruitment Date) ៖
                        <span>............................</span>
                    </h3>
                    <span class="absolute top-[-3px] left-[480px] font-bold"> </span>
                </div>
                <div class="flex w-full md:w-full md:mb-0 relative">
                    <h3 class="px-2">
                        - វគ្គបណ្ដុះបណ្ដាលទទួលបាន ៖ <span>...........................</span>
                    </h3>
                    {{-- <span class="absolute top-[-3px] left-[180px] font-bold"> {{$member->misc_skill}}</span> --}}
                </div>
                <div class="flex w-full md:w-full md:mb-0 relative">
                    <h3 class="px-2">
                        - ឈ្មោះសាលារៀន ឬសាកលវិទ្យាល័យ (Name of School or University) ៖
                        <span>............................</span>
                    </h3>
                    <span class="absolute top-[-3px] left-[440px] font-bold"> {{$member->institute_kh ?? $member->school_name}}</span>
                </div>
                <div class="flex w-full md:w-full md:mb-0 relative">
                    <h3 class="px-2">
                        - ទំហំ អាវ ៖ <span>.............</span>
                    </h3>
                    <span class="absolute top-[-3px] left-[90px] font-bold"> {{$member->shirt_size}}</span>
                </div>
                <div class="flex w-full md:w-full md:mb-0 relative">
                    <h3 class="px-2">
                        - លេខទូរសព្ទទំនាក់ទំនង (Phone Number) ៖ <span>.........................</span>
                    </h3>
                    <span class="absolute top-[-3px] left-[270px] font-bold"> {{$member->phone_number}}</span>
                </div>
                <div class="flex w-full md:w-full  md:mb-0 relative">
                    <h3 class="px-2">
                        - អ៊ីម៉ែល និងហ្វេសប៊ុក (E-mail and Facebook) ៖ <span>..............................</span>
                    </h3>
                    <span class="absolute top-[-3px] left-[300px] font-bold"> {{$member->email}}
                        {{$member->facebook}}</span>
                </div>
            </div>
        </div>
        <h2 class="text-[15px] font-khmer text-blue-600" style="font-family: 'Moul'">
            ២-វគ្គបណ្ដុះបណ្ដាលដែលទទួលបានកន្លងមក (Training Skill)</h2>
        <div class="text-[14px]" style="font-family: 'Battambang'">
            <div class="flex flex-wrap mx-3 my-3 gap-1">
                <div class="flex w-full md:w-full md:mb-0 relative">
                    <h3 class="px-2">
                        - ជំនាញភាសាបរទេស(Language Skill) ៖<span>......................</span>
                    </h3>
                    <span class="absolute top-[-3px] left-[250px] font-bold"> {{$member->language}}</span>
                </div>
                <div class="flex w-full md:w-full  md:mb-0 relative">
                    <h3 class="px-2">
                        - ជំនាញកុំព្យូទ័រ(Computer Skill) ៖<span>........................</span>
                    </h3>
                    {{-- <span class="absolute top-[-3px] left-[220px] font-bold">
                        {{$member_edu->computer_skill}}</span> --}}
                </div>
                <div class="flex w-full md:w-full md:mb-0 relative">
                    <h3 class="px-2">
                        - ជំនាញផ្សេងៗ (Other Skill) ៖ <span>.........................</span>
                    </h3>
                    {{-- <span class="absolute top-[-3px] left-[200px] font-bold"> {{$member_edu->misc_skill}}</span>
                    --}}
                </div>
            </div>
        </div>
        <h2 class="text-[15px] font-khmer text-blue-600" style="font-family: 'Moul'">៣-ព័ត៌មានគ្រួសារ (Family
            Information)</h2>
        <div class="text-[14px]" style="font-family: 'Battambang'">
            <div class="flex flex-wrap mx-3 my-3 gap-1">
                <div class="flex w-full md:w-1/2 md:mb-0 relative">
                    <h3 class="px-2">
                        - ឈ្មោះឪពុក(Father Name) ៖<span>..........................</span>
                    </h3>
                    <span class="absolute top-[-3px] left-[200px] font-bold"> {{$member->father_name}}</span>
                </div>
                <div class="flex w-full md:w-1/2 md:mb-0 relative">
                    <h3 class="px-2">
                        &ensp; ថ្ងៃខែឆ្នាំកំណើត ៖<span>..........................</span>
                    </h3>
                    <span class="absolute top-[-3px] left-[130px] font-bold"> {{$member->father_dob}}</span>
                </div>
                <div class="flex w-full md:w-full md:mb-0 relative">
                    <h3 class="px-2">
                        &ensp; អាសយដ្ឋាន និងមុខរបរ (Current Address & Job) ៖<span>..........................</span>
                    </h3>
                    <span class="absolute top-[-3px] left-[320px] font-bold"> {{$member->father_current_address}}
                        {{$member->father_occupation}}</span>
                </div>
                <div class="flex w-full md:w-1/2 md:mb-0 relative">
                    <h3 class="px-2">
                        - ឈ្មោះម្ដាយ(Mother Name) ៖<span>..........................</span>
                    </h3>
                    <span class="absolute top-[-3px] left-[200px] font-bold"> {{$member->mother_name}}</span>
                </div>
                <div class="flex w-full md:w-1/2  mb-6 md:mb-0 relative">
                    <h3 class="px-2">
                        &ensp; ថ្ងៃខែឆ្នាំកំណើត ៖<span>..........................</span>
                    </h3>
                    <span class="absolute top-[-3px] left-[130px] font-bold"> {{$member->mother_dob}}</span>
                </div>
                <div class="flex w-full md:w-full md:mb-0 relative">
                    <h3 class="px-2">
                        &ensp;&ensp;អាសយដ្ឋាន និងមុខរបរ (Current Address & Job) ៖<span>..........................</span>
                    </h3>
                    <span class="absolute top-[-3px] left-[320px] font-bold"> {{$member->mother_current_address}}
                        {{$member->mother_occupation}}</span>
                </div>
                <div class="flex w-full md:w-full md:mb-0 relative">
                    <h3 class="px-2">
                        - លេខទូរសព្ទអាណាព្យាបាល (Protector Number)
                        ៖<span>........................................</span>
                    </h3>
                    <span class="absolute top-[-3px] left-[310px] font-bold"> {{$member->guardian_phone}}</span>
                </div>
            </div>
        </div>
        <h2 class="text-[15px] font-khmer text-blue-600" style="font-family: 'Moul'">៤-កិច្ចសន្យា (Contract)</h2>
        <div class="mb-8 mt-4 text-[14px]" style="font-family: 'Battambang'">
            <h3>&nbsp;&nbsp;&nbsp;&nbsp; ខ្ញុំបាទ/នាងខ្ញុំ សូមបញ្ញាក់ថា រាល់ព័ត៌មានដែលបានរៀបរាប់ជូនខាងលើ
                ពិតជាត្រឹមត្រូវពិតប្រាកដមែន
                ហើយយល់</h3>
            <h3>ព្រមចូលជាសមាជិកយុវជនកាកបាទក្រហម ចាប់ពីថ្ងៃចុះហត្ថលេខានេះតទៅ ។</h3>
        </div>
    </div>
</body>
</html>