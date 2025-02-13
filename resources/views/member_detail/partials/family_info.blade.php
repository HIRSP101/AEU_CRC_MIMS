<div class="flex flex-wrap mx-3 my-3 gap-1">
    <div class="flex w-full md:w-1/2 md:mb-0">
        <h3>
            - ឈ្មោះឪពុក(Father Name) ៖
        </h3>
        <P>{{$member_guardian->father_name}}</P>
    </div>
    <div class="flex w-full md:w-1/2 md:mb-0">
        <h3>
            ថ្ងៃខែឆ្នាំកំណើត ៖
        </h3>
        <P>{{$member_guardian->father_dob}}</P>
    </div>
    <div class="flex w-full md:w-full md:mb-0">
        <h3>
            អាសយដ្ឋាន និងមុខរបរ (Current Address & Job) ៖
        </h3>
        <P>{{$member_guardian->father_current_address}} {{$member_guardian->father_occupation}}</P>
    </div>
    <div class="flex w-full md:w-1/2 md:mb-0">
        <h3>
            - ឈ្មោះម្ដាយ(Mother Name) ៖
        </h3>
        <P>{{$member_guardian->mother_name}}</P>
    </div>
    <div class="flex w-full md:w-1/2  mb-6 md:mb-0">
        <h3>
            &ensp; ថ្ងៃខែឆ្នាំកំណើត ៖
        </h3>
        <P>{{$member_guardian->mother_dob}}</P>
    </div>
    <div class="flex-1 w-full md:w-full md:mb-0">
        <h3>
            អាសយដ្ឋាន និងមុខរបរ (Current Address & Job) ៖
        </h3>
        <P>{{$member_guardian->mother_current_address}} {{$member_guardian->mother_occupation}}</P>

    </div>
    <div class="flex w-full md:w-full md:mb-0">
        <h3>
            - លេខទូរសព្ទអាណាព្យាបាល (Protector Number) ៖
        </h3>
        <P>{{$member_guardian->guardian_phone}}</P>
    </div>
</div>