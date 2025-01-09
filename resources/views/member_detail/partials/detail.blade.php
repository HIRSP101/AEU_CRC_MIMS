<div class="flex flex-wrap mx-3 my-3 gap-4">
    <div class=" flex w-full md:w-1/4  mb-6 md:mb-0">
        <h1 class="px-2">
            ឈ្មោះ
        </h1>
        <h1 class="px-2 font-bold">
            {{$member->name_kh ?? ""}}
        </h1>
    </div>

    <div class="flex w-full md:w-1/4  mb-6 md:mb-0">
        <h1 class="px-2">
            អក្សរឡាតាំង
        </h1>
        <h1 class="px-2 font-bold">
            {{$member->name_en ?? ""}}
        </h1>
    </div>

    <div class="flex w-full md:w-1/4  mb-6 md:mb-0">
        <h1 class="px-2">
            ភេទ
        </h1>
        <h1 class="px-2 font-bold">
            {{$member->gender ?? ""}}
        </h1>
    </div>
    <div class="flex w-full md:w-1/2  mb-6 md:mb-0">
        <h1 class="px-2">
            ថ្ងៃទី ខែ ឆ្នាំកំណើត (Date of Birth)
        </h1>
        <h1 class="px-2 font-bold">
            {{$member->date_of_birth ?? ""}}
        </h1>
    </div>
    <div class="flex flex-wrap w-full md:w-full  mb-6 md:mb-0">
        <h1 class="px-2">
            ទីកន្លែងកំណើត (Place of Birth)
        </h1>
        <h1 class="px-2">
            ភូមិ ៖ <span class="font-bold">{{$member_pob->village ?? ""}}</span>
        </h1>
        <h1 class="px-2">
            ឃុំ/សង្កាត់ ៖
            <span class="font-bold">{{$member_pob->commune_sangkat ?? ""}}</span>
        </h1>
        <h1 class="px-2">
            ស្រុក/ខណ្ទ ៖ <span class="font-bold">{{$member_pob->district_khan ?? ""}}</span>
        </h1>
        <h1 class="px-2">
            រាជធានី/ខេត្ត ៖​ <span class="font-bold">{{$member_pob->provience_city ?? ""}}</span>
        </h1>
    </div>
    <div class="flex  w-full md:w-1/2  mb-6 md:mb-0">
        <h1 class="px-2">
            អសយដ្ធានបច្ចុប្បន្ន (Current Address)
        </h1>
    </div>
    <div class="flex w-full md:w-1/3 mb-6 md:mb-0">
        <h1 class="px-2">
            ផ្ទះលេខ ៖ <span class="font-bold"> {{$member_addr->home_no ?? ""}}</span>
        </h1>
    </div>
    <div class="flex w-full md:w-1/3  mb-6 md:mb-0">
        <h1 class="px-2">
            ផ្លូវ​​​ ៖ <span class="font-bold"> {{$member_addr->street_no ?? ""}} </span>
        </h1>
    </div>
    <div class="flex w-full md:w-1/4  mb-6 md:mb-0">
        <h1 class="px-2">
            ភូមិ ៖ <span class="font-bold"> {{$member_addr->village ?? ""}} </span>
        </h1>

    </div>
    <div class="flex w-full md:w-1/4  mb-6 md:mb-0">
        <h1 class="px-2">
            ឃុំ/សង្កាត់ ៖ <span class="font-bold">{{$member_addr->commune_sangkat ?? ""}}</span>
        </h1>
    </div>
    <div class="flex w-full md:w-1/3  mb-6 md:mb-0">
        <h1 class="px-2">
            ស្រុក/ខណ្ទ ៖ <span class="font-bold">{{$member_addr->district_khan ?? ""}}</span>
        </h1>
    </div>
    <div class="flex w-full md:w-1/3  mb-6 md:mb-0">
        <h1 class="px-2">
            ខេត្ត/រាជធានី ៖ <span class="font-bold">{{$member_addr->provience_city ?? ""}}</span>
        </h1>

    </div>

    <div class="flex w-full md:w-full  mb-6 md:mb-0">
        <h1 class="px-2">
            កម្រិតវប្បធម៌ ឬថ្នាក់ទី ឬឆ្នាំទី (Education or Class or Year) ៖ <span
                class="font-bold">{{$member_edu->acadmedic_year ?? ""}}</span>
        </h1>
    </div>
    <div class="flex w-full md:w-full  mb-6 md:mb-0">
        <h1 class="px-2">
            ភាសាបរទេស (Foreign language ) ៖ <span class="font-bold">{{$member_edu->language}}</span>
        </h1>
    </div>
    <div class="flex w-full md:w-full  mb-6 md:mb-0">
        <h1 class="px-2">
            ជំនាញផ្ទាល់ខ្លួន (Life Skills ) ៖
        </h1>
        <P>{{$member_edu->major}}</P>
    </div>
    <div class="flex w-full md:w-full  mb-6 md:mb-0">
        <h1 class="px-2">
            ថ្ងៃ ខែ ឆ្នាំ ចូលជាយុវជនកាកបាទក្រហមកម្ពុជា (RCY Recruitment Date) ៖ <span
                class="font-bold">{{$member_regis->registration_date}}</span>
        </h1>
    </div>
    <div class="flex w-full md:w-full  mb-6 md:mb-0">
        <h1 class="px-2">
            វគ្គបណ្ដុះបណ្ដាលទទួលបាន ៖
        </h1>
        <P>{{$member_edu->misc_skill}}</P>
    </div>
    <div class="flex w-full md:w-full  mb-6 md:mb-0">
        <h1 class="px-2">
            ឈ្មោះសាលារៀន ឬសាកលវិទ្យាល័យ (Name of School or University) ៖ <span
                class="font-bold">{{$member_edu->institute_id}}</span>
        </h1>
    </div>
    <div class="flex w-full md:w-full  mb-6 md:mb-0">
        <h1 class="px-2">
            ទំហំ អាវ ៖ <span class="font-bold">{{$member->shirt_size}}</span>
        </h1>
    </div>
    <div class="flex w-full md:w-full  mb-6 md:mb-0">
        <h1 class="px-2">
            លេខទូរសព្ទទំនាក់ទំនង (Phone Number) ៖ <span class="font-bold">{{$member->phone_number}}</span>
        </h1>
    </div>
    <div class="flex w-full md:w-full  mb-6 md:mb-0">
        <h1 class="px-2">
            អ៊ីម៉ែល និងហ្វេសប៊ុក (E-mail and Facebook) ៖
        </h1>
        <P>{{$member->email}} {{$member->facebook}}</P>
    </div>
</div>