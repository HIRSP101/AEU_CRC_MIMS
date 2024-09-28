<div class="flex flex-wrap mx-3 my-3">
    <div class=" flex w-full md:w-1/4  mb-3">
        <p class="px-2">
            ឈ្មោះ
        </p>
        <p class="px-2 font-bold">
            {{$member->name_kh}}
        </p>
    </div>

    <div class="flex w-full md:w-1/4  mb-3">
        <p class="px-2">
            អក្សរឡាតាំង
        </p>
        <p class="px-2 font-bold">
            {{$member->name_en}}
        </p>
    </div>

    <div class="flex w-full md:w-1/4  mb-3">
        <p class="px-2">
            ភេទ
        </p>
        <p class="px-2 font-bold">
            {{$member->gender}}
        </p>
    </div>
    <div class="flex w-full md:w-1/2  mb-3">
        <p class="px-2">
            ថ្ងៃទី ខែ ឆ្នាំកំណើត (Date of Birth)
        </p>
        <p class="px-2 font-bold">
            {{$member->date_of_birth}}
        </p>
    </div>
    <div class="flex w-full md:w-1/2  mb-3">
        <p class="px-2">
            ទីកន្លែងកំណើត (Place of Birth)
        </p>
        <p class="px-2">
            {{$member_pob->village}}
        </p>
    </div>
    <div class="flex w-full md:w-full  mb-3">
        <p class="px-2">
            អសយដ្ធានបច្ចុប្បន្ន (Current Address)
        </p>
        <p class="px-2">
            ផ្ទះលេខ ៖ <span class="font-bold"> {{$member_addr->home_no}}</span>
        </p>
        <p class="px-2">
            ផ្លូវ​​​ ៖ <span class="font-bold"> {{$member_addr->street_no}} </span>
        </p>
        <p class="px-2">
            ភូមិ ៖ <span class="font-bold"> {{$member_addr->village}} </span>
        </p>

    </div>

    <div class="flex w-full md:w-1/3  mb-3">
        <p class="px-2">
            ឃុំ/សង្កាត់ ៖ <span class="font-bold">{{$member_addr->commune_sangkat}}</span>
        </p>
    </div>
    <div class="flex w-full md:w-1/3  mb-3">
        <p class="px-2">
            ស្រុក/ខណ្ទ ៖ <span class="font-bold">{{$member_addr->district_khan}}</span>
        </p>
    </div>
    <div class="flex w-full md:w-1/3  mb-3">
        <p class="px-2">
            ខេត្ត/រាជធានី ៖ <span class="font-bold">{{$member_addr->provience_city}}</span>
        </p>
    </div>

    <div class="flex w-full md:w-full  mb-3">
        <p class="px-2">
            កម្រិតវប្បធម៌ ឬថ្នាក់ទី ឬឆ្នាំទី (Education or Class or Year) ៖ <span
                class="font-bold">{{$member_edu->acadmedic_year}}</span>
        </p>
    </div>
    <div class="flex w-full md:w-full  mb-3">
        <p class="px-2">
            ភាសាបរទេស (Foreign language ) ៖ <span class="font-bold">{{$member_edu->language}}</span>
        </p>
    </div>
    <div class="flex w-full md:w-full  mb-3">
        <p class="px-2">
            ជំនាញផ្ទាល់ខ្លួន (Life Skills ) ៖
        </p>
        <P>{{$member_edu->major}}</P>
    </div>
    <div class="flex w-full md:w-full  mb-3">
        <p class="px-2">
            ថ្ងៃ ខែ ឆ្នាំ ចូលជាយុវជនកាកបាទក្រហមកម្ពុជា (RCY Recruitment Date) ៖ <span
                class="font-bold">{{$member_regis->registration_date}}</span>
        </p>
    </div>
    <div class="flex w-full md:w-full  mb-3">
        <p class="px-2">
            វគ្គបណ្ដុះបណ្ដាលទទួលបាន ៖
        </p>
        <P>{{$member_edu->misc_skill}}</P>
    </div>
    <div class="flex w-full md:w-full  mb-3">
        <p class="px-2">
            ឈ្មោះសាលារៀន ឬសាកលវិទ្យាល័យ (Name of School or University) ៖ <span
                class="font-bold">{{$member_edu->institute_id}}</span>
        </p>
    </div>
    <div class="flex w-full md:w-full  mb-3">
        <p class="px-2">
            ទំហំ អាវ ៖ <span class="font-bold">{{$member->shirt_size}}</span>
        </p>
    </div>
    <div class="flex w-full md:w-full  mb-3">
        <p class="px-2">
            លេខទូរសព្ទទំនាក់ទំនង (Phone Number) ៖ <span class="font-bold">{{$member->phone_number}}</span>
        </p>
    </div>
    <div class="flex w-full md:w-full  mb-3">
        <p class="px-2">
            អ៊ីម៉ែល និងហ្វេសប៊ុក (E-mail and Facebook) ៖
        </p>
        <P>{{$member->email}} {{$member->facebook}}</P>
    </div>
</div>