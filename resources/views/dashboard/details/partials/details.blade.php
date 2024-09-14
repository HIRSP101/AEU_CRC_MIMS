<div class="flex flex-wrap mx-3 mb-6">
    <div class=" flex w-full md:w-1/3  mb-6 md:mb-0">
        <h1 class="px-2">
            ឈ្មោះ
        </h1>
        <h1 class="px-2">
            {{$member->name_kh}}
        </h1>
    </div>

    <div class="flex w-full md:w-1/3  mb-6 md:mb-0">
        <h1 class="px-2">
            អក្សរឡាតាំង
        </h1>
        <h1 class="px-2">
            {{$member->name_en}}
        </h1>
    </div>

    <div class="flex w-full md:w-1/3  mb-6 md:mb-0">
        <h1 class="px-2">
            ភេទ
        </h1>
        <h1 class="px-2">
            {{$member->gender}}
        </h1>
    </div>
    <div class="flex w-full md:w-1/2  mb-6 md:mb-0">
        <h1 class="px-2">
            ថ្ងៃទី ខែ ឆ្នាំកំណើត (Date of Birth)
        </h1>
        <h1 class="px-2">
            {{$member->date_of_birth}}
        </h1>
    </div>
    <div class="flex w-full md:w-1/2  mb-6 md:mb-0">
        <h1 class="px-2">
            ទីកន្លែងកំណើត (Place of Birth)
        </h1>
        <h1 class="px-2">
            {{$member_pob->village}}
        </h1>
    </div>
    <div class="flex w-full md:w-1/2  mb-6 md:mb-0">
        <h1 class="px-2">
            អសយដ្ធានបច្ចុប្បន្ន (Current Address)
        </h1>
        <P class="px-2">
            ផ្ទះលេខ​ ៖ {{$member_addr->home_no}}
        </P>
    </div>
    <div class="flex w-full md:w-1/4  mb-6 md:mb-0">
        <h1 class="px-2">
            ផ្លូវ​​​ ៖
        </h1>
        <P>{{$member_addr->street_no}}</P>
    </div>
    <div class="flex w-full md:w-1/4  mb-6 md:mb-0">
        <h1 class="px-2">
            ភូមិ ៖
        </h1>
        <P>{{$member_addr->village}}</P>
    </div>
    <div class="flex w-full md:w-1/3  mb-6 md:mb-0">
        <h1 class="px-2">
            ឃុំ/សង្កាត់ ៖
        </h1>
        <P>{{$member_addr->commune_sangkat}}</P>
    </div>
    <div class="flex w-full md:w-1/3  mb-6 md:mb-0">
        <h1 class="px-2">
            ស្រុក/ខណ្ទ ៖
        </h1>
        <P>{{$member_addr->district_khan}}</P>
    </div>
    <div class="flex w-full md:w-1/3  mb-6 md:mb-0">
        <h1 class="px-2">
            ខេត្ត/រាជធានី ៖
        </h1>
        <P>{{$member_addr->provience_city}}</P>
    </div>

    <div class="flex w-full md:w-full  mb-6 md:mb-0">
        <h1 class="px-2">
            កម្រិតវប្បធម៌ ឬថ្នាក់ទី ឬឆ្នាំទី (Education or Class or Year) ៖
        </h1>
        <P>{{$member_edu->acadmedic_year}}</P>
    </div>
    <div class="flex w-full md:w-full  mb-6 md:mb-0">
        <h1 class="px-2">
            ភាសាបរទេស (Foreign language ) ៖
        </h1>
        <P>{{$member_edu->language}}</P>
    </div>
    <div class="flex w-full md:w-full  mb-6 md:mb-0">
        <h1 class="px-2">
            ជំនាញផ្ទាល់ខ្លួន (Life Skills ) ៖
        </h1>
        <P>{{$member_edu->major}}</P>
    </div>
    <div class="flex w-full md:w-full  mb-6 md:mb-0">
        <h1 class="px-2">
            ថ្ងៃ ខែ ឆ្នាំ ចូលជាយុវជនកាកបាទក្រហមកម្ពុជា (RCY Recruitment Date) ៖
        </h1>
        <P>{{$member_regis->registration_date}}</P>
    </div>
    <div class="flex w-full md:w-full  mb-6 md:mb-0">
        <h1 class="px-2">
            ថ្ងៃ ខែ ឆ្នាំ ចូលជាយុវជនជាតិកាយរឹទ្ធិកម្ពុជា (Scout Youth Recruitment Date) ៖
        </h1>
        <P>{{$member_edu->major}}</P>
    </div>
    <div class="flex w-full md:w-full  mb-6 md:mb-0">
        <h1 class="px-2">
            ថ្ងៃ ខែ ឆ្នាំ ចូលជាយុវជន ស.ស.យ.ក. (UYFC Recruitment Date) ៖
        </h1>
        <P>{{$member_edu->major}}</P>
    </div>
    <div class="flex w-full md:w-full  mb-6 md:mb-0">
        <h1 class="px-2">
            ថ្ងៃ ខែ ឆ្នាំ ចូលជាអង្គការចាត់តាំងយុវជនផ្សេងៗ (Other NGos Recruitment Date) ៖
        </h1>
        <P>{{$member_edu->major}}</P>
    </div>
    <div class="flex w-full md:w-full  mb-6 md:mb-0">
        <h1 class="px-2">
            វគ្គបណ្ដុះបណ្ដាលទទួលបាន ៖
        </h1>
        <P>{{$member_edu->misc_skill}}</P>
    </div>
    <div class="flex w-full md:w-full  mb-6 md:mb-0">
        <h1 class="px-2">
            ឈ្មោះសាលារៀន ឬសាកលវិទ្យាល័យ (Name of School or University) ៖
        </h1>
        <P>{{$member_edu->institute_id}}</P>
    </div>
    <div class="flex w-full md:w-full  mb-6 md:mb-0">
        <h1 class="px-2">
            ទំហំ អាវ ៖
        </h1>
        <P>{{$member->shirt_size}}</P>
    </div>
    <div class="flex w-full md:w-full  mb-6 md:mb-0">
        <h1 class="px-2">
            លេខទូរសព្ទទំនាក់ទំនង (Phone Number) ៖
        </h1>
        <P>{{$member->phone_number}}</P>
    </div>
    <div class="flex w-full md:w-full  mb-6 md:mb-0">
        <h1 class="px-2">
            អ៊ីម៉ែល និងហ្វេសប៊ុក (E-mail and Facebook) ៖
        </h1>
        <P>{{$member->email}} {{$member->facebook}}</P>
    </div>
</div>