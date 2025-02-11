{{-- <div class="flex flex-wrap mx-3 my-3 gap-4">
    <div class=" flex w-full md:w-1/4  mb-6 md:mb-0">
        <h3 class="px-2">
            ឈ្មោះ <span class="font-bold">{{$member->name_kh ?? ""}}</span>
        </h3>
    </div>

    <div class="flex w-full md:w-1/4  mb-6 md:mb-0">
        <h3 class="px-2">
            អក្សរឡាតាំង <span class="font-bold"> {{$member->name_en ?? ""}}</span>
        </h3>
    </div>

    <div class="flex w-full md:w-1/4  mb-6 md:mb-0">
        <h3 class="px-2">
            ភេទ <span class="font-bold"> {{$member->gender ?? ""}}</span>
        </h3>
    </div>
    <div class="flex w-full md:w-1/2  mb-6 md:mb-0">
        <h3 class="px-2">
            ថ្ងៃទី ខែ ឆ្នាំកំណើត (Date of Birth) <span class="font-bold">  {{$member->date_of_birth ?? ""}}</span>
        </h3>
    </div>
    <div class="flex flex-wrap w-full md:w-full  mb-6 md:mb-0">
        <h3 class="px-2">
            ទីកន្លែងកំណើត (Place of Birth)
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
            រាជធានី/ខេត្ត ៖​ <span class="font-bold">{{$member_pob->provience_city ?? ""}}</span>
        </h3>
    </div>
    <div class="flex  w-full md:w-1/2  mb-6 md:mb-0">
        <h3 class="px-2">
            អសយដ្ធានបច្ចុប្បន្ន (Current Address)
        </h3>
    </div>
    <div class="flex w-full md:w-1/3 mb-6 md:mb-0">
        <h3 class="px-2">
            ផ្ទះលេខ ៖ <span class="font-bold"> {{$member_addr->home_no ?? ""}}</span>
        </h3>
    </div>
    <div class="flex w-full md:w-1/3  mb-6 md:mb-0">
        <h3 class="px-2">
            ផ្លូវ​​​ ៖ <span class="font-bold"> {{$member_addr->street_no ?? ""}} </span>
        </h3>
    </div>
    <div class="flex w-full md:w-1/4  mb-6 md:mb-0">
        <h3 class="px-2">
            ភូមិ ៖ <span class="font-bold"> {{$member_addr->village ?? ""}} </span>
        </h3>

    </div>
    <div class="flex w-full md:w-1/4  mb-6 md:mb-0">
        <h3 class="px-2">
            ឃុំ/សង្កាត់ ៖ <span class="font-bold">{{$member_addr->commune_sangkat ?? ""}}</span>
        </h3>
    </div>
    <div class="flex w-full md:w-1/3  mb-6 md:mb-0">
        <h3 class="px-2">
            ស្រុក/ខណ្ទ ៖ <span class="font-bold">{{$member_addr->district_khan ?? ""}}</span>
        </h3>
    </div>
    <div class="flex w-full md:w-1/3  mb-6 md:mb-0">
        <h3 class="px-2">
            ខេត្ត/រាជធានី ៖ <span class="font-bold">{{$member_addr->provience_city ?? ""}}</span>
        </h3>

    </div>

    <div class="flex w-full md:w-full  mb-6 md:mb-0">
        <h3 class="px-2">
            កម្រិតវប្បធម៌ ឬថ្នាក់ទី ឬឆ្នាំទី (Education or Class or Year) ៖ <span
                class="font-bold">{{$member_edu->acadmedic_year ?? ""}}</span>
        </h3>
    </div>
    <div class="flex w-full md:w-full  mb-6 md:mb-0">
        <h3 class="px-2">
            ភាសាបរទេស (Foreign language ) ៖ <span class="font-bold">{{$member_edu->language}}</span>
        </h3>
    </div>
    <div class="flex w-full md:w-full  mb-6 md:mb-0">
        <h3 class="px-2">
            ជំនាញផ្ទាល់ខ្លួន (Life Skills ) ៖
        </h3>
        <P>{{$member_edu->major}}</P>
    </div>
    <div class="flex w-full md:w-full  mb-6 md:mb-0">
        <h3 class="px-2">
            ថ្ងៃ ខែ ឆ្នាំ ចូលជាយុវជនកាកបាទក្រហមកម្ពុជា (RCY Recruitment Date) ៖ <span
                class="font-bold">{{$member_regis->registration_date}}</span>
        </h3>
    </div>
    <div class="flex w-full md:w-full  mb-6 md:mb-0">
        <h3 class="px-2">
            ថ្ងៃ ខែ ឆ្នាំ ចូលជាយុវជនជាតិកាយរឹទ្ធិកម្ពុជា (Scout Youth Recruitment Date) ៖ <span
                class="font-bold">{{$member_regis->registration_date}}</span>
        </h3>
    </div>
    <div class="flex w-full md:w-full  mb-6 md:mb-0">
        <h3 class="px-2">
            ថ្ងៃ ខែ ឆ្នាំ ចូលជាយុវជន ស.ស.យ​.ក (UYFC Recruitment Date) ៖ <span
                class="font-bold">{{$member_regis->registration_date}}</span>
        </h3>
    </div>
    <div class="flex w-full md:w-full  mb-6 md:mb-0">
        <h3 class="px-2">
            ថ្ងៃ ខែ ឆ្នាំ ចូលជាអង្គការចាត់តាំងយុវជនផ្សេងៗ (Other NGos Recruitment Date) ៖ <span
                class="font-bold">{{$member_regis->registration_date}}</span>
        </h3>
    </div>
    <div class="flex w-full md:w-full  mb-6 md:mb-0">
        <h3 class="px-2">
            វគ្គបណ្ដុះបណ្ដាលទទួលបាន ៖
        </h3>
        <P>{{$member_edu->misc_skill}}</P>
    </div>
    <div class="flex w-full md:w-full  mb-6 md:mb-0">
        <h3 class="px-2">
            ឈ្មោះសាលារៀន ឬសាកលវិទ្យាល័យ (Name of School or University) ៖ <span
                class="font-bold">{{$member_edu->institute_id}}</span>
        </h3>
    </div>
    <div class="flex w-full md:w-full  mb-6 md:mb-0">
        <h3 class="px-2">
            ទំហំ អាវ ៖ <span class="font-bold">{{$member->shirt_size}}</span>
        </h3>
    </div>
    <div class="flex w-full md:w-full  mb-6 md:mb-0">
        <h3 class="px-2">
            លេខទូរសព្ទទំនាក់ទំនង (Phone Number) ៖ <span class="font-bold">{{$member->phone_number}}</span>
        </h3>
    </div>
    <div class="flex w-full md:w-full  mb-6 md:mb-0">
        <h3 class="px-2">
            អ៊ីម៉ែល និងហ្វេសប៊ុក (E-mail and Facebook) ៖
        </h3>
        <P>{{$member->email}} {{$member->facebook}}</P>
    </div>
</div>
 --}}


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
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
    <div class="container1">
        <div>
            ឈ្មោះ <span class="">{{$member->name_kh ?? ""}}</span>
        </div>
        <div>
            អក្សរឡាតាំង <span class=""> {{$member->name_en ?? ""}}</span>
        </div>
       <div>
            ភេទ <span class=""> {{$member->gender ?? ""}}</span>
       </div>
    </div>    
    <div>
        <p>ថ្ងៃទី ខែ ឆ្នាំកំណើត (Date of Birth): <span class="font-bold"> {{$member->date_of_birth ?? ""}}</span></p>
    </div>    
    <div>
        <p>ទីកន្លែងកំណើត (Place of Birth):</p>
    </div>             
            
                    {{-- ភូមិ ៖ <span class="font-bold">{{$member_pob->village ?? ""}}</span>
                
                    ឃុំ/សង្កាត់ ៖
                   
                    ស្រុក/ខណ្ទ ៖ <span class="font-bold">{{$member_pob->district_khan ?? ""}}</span>
                
                    រាជធានី/ខេត្ត ៖​ <span class="font-bold">{{$member_pob->provience_city ?? ""}}</span> --}}
            
    <div class="container2">
        <div>
            អសយដ្ធានបច្ចុប្បន្ន (Current Address) ផ្ទះលេខ ៖ <span class="font-bold"> {{$member_addr->home_no ?? ""}}</span>
        </div>
            
        <div>
            ផ្លូវ​​​ ៖ <span class="font-bold"> {{$member_addr->street_no ?? ""}} </span>
        </div>
           
        <div>
            ភូមិ ៖ <span class="font-bold"> {{$member_addr->village ?? ""}} </span>
        </div>
          
    </div>    
    <div class="container3">
        <div>
            <p>ឃុំ/សង្កាត់ ៖ <span class="font-bold">{{$member_addr->commune_sangkat ?? ""}}</span></p>
        </div>
        <div>
            <p>ស្រុក/ខណ្ទ ៖ <span class="font-bold">{{$member_addr->district_khan ?? ""}}</span></p>
        </div>
        <div>
            <p>ខេត្ត/រាជធានី ៖ <span class="font-bold">{{$member_addr->provience_city ?? ""}}</span></p>
        </div>
    </div>   
    <div>
        <p>
            កម្រិតវប្បធម៌ ឬថ្នាក់ទី ឬឆ្នាំទី (Education or Class or Year) ៖ <span
            class="font-bold">{{$member_edu->acadmedic_year ?? ""}}</span>
        </p>
        <p>
            ភាសាបរទេស (Foreign language ) ៖ <span class="font-bold">{{$member_edu->language}}</span>
        </p>
        <p>
            ជំនាញផ្ទាល់ខ្លួន (Life Skills ) ៖ {{$member_edu->major}}
        </p>
        <p>
            ថ្ងៃ ខែ ឆ្នាំ ចូលជាយុវជនកាកបាទក្រហមកម្ពុជា (RCY Recruitment Date) ៖ <span
                    class="font-bold">{{$member_regis->registration_date}}</span>
        </p>
        <p>
            ថ្ងៃ ខែ ឆ្នាំ ចូលជាយុវជនជាតិកាយរឹទ្ធិកម្ពុជា (Scout Youth Recruitment Date) ៖ <span
                    class="font-bold">{{$member_regis->registration_date}}</span>
        </p>
        <p>
            ថ្ងៃ ខែ ឆ្នាំ ចូលជាយុវជន ស.ស.យ​.ក (UYFC Recruitment Date) ៖ <span
                    class="font-bold">{{$member_regis->registration_date}}</span>
        </p>
        <p>
            ថ្ងៃ ខែ ឆ្នាំ ចូលជាអង្គការចាត់តាំងយុវជនផ្សេងៗ (Other NGos Recruitment Date) ៖ <span
                    class="font-bold">{{$member_regis->registration_date}}</span>
        </p>
        <p>
            វគ្គបណ្ដុះបណ្ដាលទទួលបាន ៖ {{$member_edu->misc_skill}}
        </p>
        <p>
            ឈ្មោះសាលារៀន ឬសាកលវិទ្យាល័យ (Name of School or University) ៖ <span
                    class="font-bold">{{$member_edu->institute_id}}</span>
        </p>
        <p>
            ទំហំ អាវ ៖ <span class="font-bold">{{$member->shirt_size}}</span>
        </p>
        <p>
            លេខទូរសព្ទទំនាក់ទំនង (Phone Number) ៖ <span class="font-bold">{{$member->phone_number}}</span>
        </p>
        <p>
            អ៊ីម៉ែល និងហ្វេសប៊ុក (E-mail and Facebook) ៖ <P>{{$member->email}} {{$member->facebook}}</P>
        </p>
    </div>    
</body>
</html>