<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Report</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Battambang:wght@100;300;400;700;900&family=Nunito:wght@700&display=swap"
        rel="stylesheet">
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
                        ភូមិ ៖ <span class="font-bold">{{$member->village ?? ""}}</span>
                    </h3>
                    <h3 class="px-2">
                        ឃុំ/សង្កាត់ ៖
                        <span class="font-bold">{{$member->commune_sangkat ?? ""}}</span>
                    </h3>
                    <h3 class="px-2">
                        ស្រុក/ខណ្ទ ៖ <span class="font-bold">{{$member->district_khan ?? ""}}</span>
                    </h3>
                    <h3 class="px-2">
                        - រាជធានី/ខេត្ត ៖​ <span class="font-bold">{{$member->provience_city ?? ""}}</span>
                    </h3>
                </div>
                <div class="flex  w-full md:w-1/2  md:mb-0">
                    <h3 class="px-2">
                        - អសយដ្ធានបច្ចុប្បន្ន (Current Address)
                    </h3>
                </div>
                <div class="flex w-full md:w-1/3 md:mb-0">
                    <h3 class="px-2">
                        ផ្ទះលេខ ៖ <span class="font-bold"> {{$member->home_no ?? ""}}</span>
                    </h3>
                </div>
                <div class="flex w-full md:w-1/3  md:mb-0">
                    <h3 class="px-2">
                        &ensp; ផ្លូវ​​​ ៖ <span class="font-bold"> {{$member->street_no ?? ""}} </span>
                    </h3>
                </div>
                <div class="flex w-full md:w-1/4  md:mb-0">
                    <h3 class="px-2">
                        ភូមិ ៖ <span class="font-bold"> {{$member->village_current ?? ""}} </span>
                    </h3>
                </div>
                <div class="flex w-full md:w-1/4 md:mb-0">
                    <h3 class="px-2">
                        ឃុំ/សង្កាត់ ៖ <span class="font-bold">{{$member->commune_sangkat_current ?? ""}}</span>
                    </h3>
                </div>
                <div class="flex w-full md:w-1/3  md:mb-0">
                    <h3 class="px-2">
                        &ensp; ស្រុក/ខណ្ឌ ៖ <span class="font-bold">{{$member->district_khan_current ?? ""}}</span>
                    </h3>
                </div>
                <div class="flex w-full md:w-1/3 md:mb-0">
                    <h3 class="px-2">
                        ខេត្ត/រាជធានី ៖ <span class="font-bold">{{$member->provience_city_current ?? ""}}</span>
                    </h3>

                </div>

                <div class="flex w-full md:w-full md:mb-0">
                    <h3 class="px-2">
                        - កម្រិតវប្បធម៌ ឬថ្នាក់ទី ឬឆ្នាំទី (Education or Class or Year) ៖ <span
                            class="font-bold">{{$member->acadmedic_year ?? ""}}</span>
                    </h3>
                </div>
                <div class="flex w-full md:w-full md:mb-0">
                    <h3 class="px-2">
                        - ភាសាបរទេស (Foreign language ) ៖ <span class="font-bold">{{$member->language}}</span>
                    </h3>
                </div>
                <div class="flex w-full md:w-full md:mb-0">
                    <h3 class="px-2">
                        - ជំនាញផ្ទាល់ខ្លួន (Life Skills ) ៖
                    </h3>
                    <P>{{$member->major}}</P>
                </div>
                <div class="flex w-full md:w-full md:mb-0">
                    <h3 class="px-2">
                        - ថ្ងៃ ខែ ឆ្នាំ ចូលជាយុវជនកាកបាទក្រហមកម្ពុជា (RCY Recruitment Date) ៖ <span
                            class="font-bold">{{$member->registration_date}}</span>
                    </h3>
                </div>
                <div class="flex w-full md:w-full md:mb-0">
                    <h3 class="px-2">
                        - ថ្ងៃ ខែ ឆ្នាំ ចូលជាយុវជនជាតិកាយរឹទ្ធិកម្ពុជា (Scout Youth Recruitment Date) ៖ <span
                            class="font-bold">{{$member->registration_date}}</span>
                    </h3>
                </div>
                <div class="flex w-full md:w-full md:mb-0">
                    <h3 class="px-2">
                        - ថ្ងៃ ខែ ឆ្នាំ ចូលជាយុវជន ស.ស.យ​.ក (UYFC Recruitment Date) ៖ <span
                            class="font-bold">{{$member->registration_date}}</span>
                    </h3>
                </div>
                <div class="flex w-full md:w-full md:mb-0">
                    <h3 class="px-2">
                        - ថ្ងៃ ខែ ឆ្នាំ ចូលជាអង្គការចាត់តាំងយុវជនផ្សេងៗ (Other NGos Recruitment Date) ៖ <span
                            class="font-bold">{{$member->registration_date}}</span>
                    </h3>
                </div>
                <div class="flex w-full md:w-full md:mb-0">
                    <h3 class="px-2">
                        - វគ្គបណ្ដុះបណ្ដាលទទួលបាន ៖
                    </h3>
                    {{-- <P>{{$member->misc_skill}}</P> --}}
                </div>
                <div class="flex w-full md:w-full md:mb-0">
                    <h3 class="px-2">
                        - ឈ្មោះសាលារៀន ឬសាកលវិទ្យាល័យ (Name of School or University) ៖ <span
                            class="font-bold">{{$member->institute_id}}</span>
                    </h3>
                </div>
                <div class="flex w-full md:w-full md:mb-0">
                    <h3 class="px-2">
                        - ទំហំ អាវ ៖ <span class="font-bold">{{$member->shirt_size}}</span>
                    </h3>
                </div>
                <div class="flex w-full md:w-full md:mb-0">
                    <h3 class="px-2">
                        - លេខទូរសព្ទទំនាក់ទំនង (Phone Number) ៖ <span class="font-bold">{{$member->phone_number}}</span>
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
        <h2 class="text-[15px] font-khmer text-blue-600" style="font-family: 'Moul'">
            ២-វគ្គបណ្ដុះបណ្ដាលដែលទទួលបានកន្លងមក (Training Skill)</h2>
        <div class="text-[14px]" style="font-family: 'Battambang'">
            <div class="flex flex-wrap mx-3 my-3 gap-1">
                <div class="flex w-full md:w-full md:mb-0">
                    <h3 class="px-2">
                        - ជំនាញភាសាបរទេស(Language Skill) ៖<span>{{$member->language}}</span>
                    </h3>
                </div>
                <div class="flex w-full md:w-full  md:mb-0">
                    <h3 class="px-2">
                        - ជំនាញកុំព្យូទ័រ(Computer Skill) ៖
                    </h3>
                    {{-- <P>{{$member->computer_skill}}</P> --}}
                </div>
                <div class="flex w-full md:w-full md:mb-0">
                    <h3 class="px-2">
                        - ជំនាញផ្សេងៗ (Other Skill) ៖
                    </h3>
                    {{-- <P>{{$member->misc}}</P> --}}

                </div>
            </div>
        </div>
        <h2 class="text-[15px] font-khmer text-blue-600" style="font-family: 'Moul'">៣-ព័ត៌មានគ្រួសារ (Family
            Information)</h2>
        <div class="text-[14px]" style="font-family: 'Battambang'">
            <div class="flex flex-wrap mx-3 my-3 gap-1">
                <div class="flex w-full md:w-1/2 md:mb-0">
                    <h3 class="px-2">
                        - ឈ្មោះឪពុក(Father Name) ៖
                    </h3>
                    <P>{{$member->father_name}}</P>
                </div>
                <div class="flex w-full md:w-1/2 md:mb-0">
                    <h3 class="px-2">
                        &ensp; ថ្ងៃខែឆ្នាំកំណើត ៖
                    </h3>
                    <P>{{$member->father_dob}}</P>
                </div>
                <div class="flex w-full md:w-full md:mb-0">
                    <h3 class="px-2">
                        &ensp; អាសយដ្ឋាន និងមុខរបរ (Current Address & Job) ៖
                    </h3>
                    <P>{{$member->father_current_address}} {{$member->father_occupation}}</P>
                </div>
                <div class="flex w-full md:w-1/2 md:mb-0">
                    <h3 class="px-2">
                        - ឈ្មោះម្ដាយ(Mother Name) ៖
                    </h3>
                    <P>{{$member->mother_name}}</P>
                </div>
                <div class="flex w-full md:w-1/2  mb-6 md:mb-0">
                    <h3 class="px-2">
                        &ensp; ថ្ងៃខែឆ្នាំកំណើត ៖
                    </h3>
                    <P>{{$member->mother_dob}}</P>
                </div>
                <div class="flex w-full md:w-full md:mb-0">
                    <h3 class="px-2">
                        អាសយដ្ឋាន និងមុខរបរ (Current Address & Job) ៖
                    </h3>
                    <P>{{$member->mother_current_address}} {{$member->mother_occupation}}</P>

                </div>
                <div class="flex w-full md:w-full md:mb-0">
                    <h3 class="px-2">
                        - លេខទូរសព្ទអាណាព្យាបាល (Protector Number) ៖
                    </h3>
                    <P>{{$member->guardian_phone}}</P>
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