<div class="flex flex-wrap mx-3 my-3">
    <div class="flex w-full md:w-1/2  mb-3">
        <h1>
            ឈ្មោះឪពុក(Father Name) ៖
        </h1>
        <P>{{$member_guardian->father_name}}</P>
    </div>
    <div class="flex w-full md:w-1/2  mb-3">
        <h1>
            ថ្ងៃខែឆ្នាំកំណើត ៖
        </h1>
        <P>{{$member_guardian->father_dob}}</P>
    </div>
    <div class="flex w-full md:w-full  mb-3">
        <h1>
            អាសយដ្ឋាន និងមុខរបរ (Current Address & Job) ៖
        </h1>
        <P>{{$member_guardian->father_current_address}} {{$member_guardian->father_occupation}}</P>
    </div>
    <div class="flex w-full md:w-1/2  mb-3">
        <h1>
            ឈ្មោះម្ដាយ(Mother Name) ៖
        </h1>
        <P>{{$member_guardian->mother_name}}</P>
    </div>
    <div class="flex w-full md:w-1/2  mb-3">
        <h1>
            ថ្ងៃខែឆ្នាំកំណើត ៖
        </h1>
        <P>{{$member_guardian->mother_dob}}</P>
    </div>
    <div class="flex-1 w-full md:w-full  mb-3">
        <h1>
            អាសយដ្ឋាន និងមុខរបរ (Current Address & Job) ៖
            <span>
                {{$member_guardian->mother_current_address}} {{$member_guardian->mother_occupation}}

            </span>
        </h1>

    </div>
    <div class="flex w-full md:w-full  mb-3">
        <h1>
            លេខទូរសព្ទអាណាព្យាបាល (Protector Number) ៖
        </h1>
        <P>{{$member_guardian->guardian_phone}}</P>
    </div>

</div>