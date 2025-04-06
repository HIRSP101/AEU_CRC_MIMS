<div class="flex flex-wrap mx-3 my-3 gap-1">
    <div class="flex w-full md:w-1/2 md:mb-0 relative">
        <h3 class="px-2">
            - ឈ្មោះឪពុក(Father Name) ៖<span>..........................</span>
        </h3>
        <span class="absolute top-[-3px] left-[200px] font-bold"> {{$member_guardian->father_name}}</span>
    </div>
    <div class="flex w-full md:w-1/2 md:mb-0 relative">
        <h3 class="px-2">
            &ensp; ថ្ងៃខែឆ្នាំកំណើត ៖<span>..........................</span>
        </h3>
        <span class="absolute top-[-3px] left-[130px] font-bold"> {{$member_guardian->father_dob}}</span>
    </div>
    <div class="flex w-full md:w-full md:mb-0 relative">
        <h3 class="px-2">
            &ensp; អាសយដ្ឋាន និងមុខរបរ (Current Address & Job) ៖<span>..........................</span>
        </h3>
        <span class="absolute top-[-3px] left-[320px] font-bold"> {{$member_guardian->father_current_address}}
            {{$member_guardian->father_occupation}}</span>
    </div>
    <div class="flex w-full md:w-1/2 md:mb-0 relative">
        <h3 class="px-2">
            - ឈ្មោះម្ដាយ(Mother Name) ៖<span>..........................</span>
        </h3>
        <span class="absolute top-[-3px] left-[200px] font-bold"> {{$member_guardian->mother_name}}</span>
    </div>
    <div class="flex w-full md:w-1/2  mb-6 md:mb-0 relative">
        <h3 class="px-2">
            &ensp; ថ្ងៃខែឆ្នាំកំណើត ៖<span>..........................</span>
        </h3>
        <span class="absolute top-[-3px] left-[130px] font-bold"> {{$member_guardian->mother_dob}}</span>
    </div>
    <div class="flex w-full md:w-full md:mb-0 relative">
        <h3 class="px-2">
            &ensp;&ensp;អាសយដ្ឋាន និងមុខរបរ (Current Address & Job)
            ៖<span>...............................................</span>
        </h3>
        <span class="absolute top-[-3px] left-[320px] font-bold"> {{$member_guardian->mother_current_address}}
            {{$member_guardian->mother_occupation}}</span>
    </div>
    <div class="flex w-full md:w-full md:mb-0 relative">
        <h3 class="px-2">
            - លេខទូរសព្ទអាណាព្យាបាល (Protector Number) ៖<span>............................................</span>
        </h3>
        <span class="absolute top-[-3px] left-[310px] font-bold"> {{$member_guardian->guardian_phone}}</span>
    </div>
</div>