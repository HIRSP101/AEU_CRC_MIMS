@php
    use App\Helpers\DateTimeFormat; 
@endphp
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
            - ថ្ងៃទី ខែ ឆ្នាំកំណើត (Date of Birth) : <span>..................................................................................................................................</span>
        </h3>
        <span class="absolute top-[-3px] left-[230px] font-bold"> {{DateTimeFormat::convertEnglishToKhmerNumbersAndMonth($member->date_of_birth) ?? ""}}</span>
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
            - រាជធានី/ខេត្ត ៖​ <span>.......................................................................................................................................................................</span>
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
        <span class="absolute top-[-3px] left-[70px] font-bold"> {{$member->current_house_number ?? ""}}</span>
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
        <h3 >
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
            - កម្រិតវប្បធម៌ ឬថ្នាក់ទី ឬឆ្នាំទី (Education or Class or Year) ៖ <span>.........................................................................................</span>
        </h3>
        <span class="absolute top-[-3px] left-[370px] font-bold"> {{DateTimeFormat::convertEnglishToKhmerNumbers($member->acadmedic_year) ?? ""}}</span>
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
        <span class="absolute top-[-3px] left-[430px] font-bold"> {{DateTimeFormat::convertEnglishToKhmerNumbersAndMonth($member->registration_date) ?? ""}}</span>
    </div>
    <div class="flex w-full md:w-full md:mb-0 relative">
        <h3 class="px-2">
            - ថ្ងៃ ខែ ឆ្នាំ ចូលជាយុវជនជាតិកាយរឹទ្ធិកម្ពុជា (Scout Youth Recruitment Date) ៖
            <span>.............................................................</span>
        </h3>
        <span class="absolute top-[-3px] left-[470px] font-bold"> {{DateTimeFormat::convertEnglishToKhmerNumbersAndMonth($member->scout_youth_registration_date) ?? ""}}</span>
    </div>
    <div class="flex w-full md:w-full md:mb-0 relative">
        <h3 class="px-2">
            - ថ្ងៃ ខែ ឆ្នាំ ចូលជាយុវជន ស.ស.យ​.ក (UYFC Recruitment Date) ៖ <span>..................................................................................</span>
        </h3>
        <span class="absolute top-[-3px] left-[400px] font-bold"> {{DateTimeFormat::convertEnglishToKhmerNumbersAndMonth($member->uyfc_registration_date)?? ""}}</span>
    </div>
    <div class="flex w-full md:w-full md:mb-0 relative">
        <h3 class="px-2">
            - ថ្ងៃ ខែ ឆ្នាំ ចូលជាអង្គការចាត់តាំងយុវជនផ្សេងៗ (Other NGos Recruitment Date) ៖
            <span>.........................................................</span>
        </h3>
        <span class="absolute top-[-3px] left-[480px] font-bold"> {{DateTimeFormat::convertEnglishToKhmerNumbersAndMonth($member->other_ngos_registration_date) ?? ""}}</span>
    </div>
    <div class="flex w-full md:w-full md:mb-0 relative">
        <h3 class="px-2">
            - វគ្គបណ្ដុះបណ្ដាលទទួលបាន ៖ <span>...................................................................................................................................................</span>
        </h3>
        <span class="absolute top-[-3px] left-[180px] font-bold"> {{$member->training_received}}</span>
    </div>
    <div class="flex w-full md:w-full md:mb-0 relative">
        <h3 class="px-2">
            - ឈ្មោះសាលារៀន ឬសាកលវិទ្យាល័យ (Name of School or University) ៖ <span>......................................................................</span>
        </h3>
        <span class="absolute top-[-3px] left-[440px] font-bold"> {{$member->school_name ?? $member->institute_kh}}</span>
    </div>
    <div class="flex w-full md:w-full md:mb-0 relative">
        <h3 class="px-2">
            - ទំហំ អាវ ៖ <span>..............................................................................................................................................................................</span>
        </h3>
        <span class="absolute top-[-3px] left-[90px] font-bold"> {{$member->shirt_size}}</span>
    </div>
    <div class="flex w-full md:w-full md:mb-0 relative">
        <h3 class="px-2">
            - លេខទូរសព្ទទំនាក់ទំនង (Phone Number) ៖ <span>.......................................................................................................................</span>
        </h3>
        <span class="absolute top-[-3px] left-[270px] font-bold"> {{DateTimeFormat::convertEnglishToKhmerNumbers($member->phone_number)}}</span>
    </div>
    <div class="flex w-full md:w-full  md:mb-0 relative">
        <h3 class="px-2">
            - អ៊ីម៉ែល និងហ្វេសប៊ុក (E-mail and Facebook) ៖ <span>...............................................................................................................</span>
        </h3>
        <span class="absolute top-[-3px] left-[300px] font-bold"> {{$member->email}}
            {{$member->facebook}}</span>
    </div>
</div>